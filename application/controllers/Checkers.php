<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkers extends CI_Controller{

    public function index(){
        
        if($this->session->userdata('logged_in')){

            $search = $this->input->get('search');

            $data['title'] = 'Attendance checkers';
            $data['count_all'] = $this->checkers_model->count_checkers();
            $data['checkers'] = $this->checkers_model->fetch_checkers($this->input->get('search'));

            $this->load->view('includes/header');
            $this->load->view('checkers/index',$data);
            $this->load->view('includes/footer');
        }else{

            redirect('login');
        }

        
       
    }

    public function login(){

        if($this->session->userdata('logged_in')){
            redirect('/');
        }else{
              // Validate form inputs
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
   
 
        if($this->form_validation->run() === FALSE){

            $this->load->view('includes/header');
            $this->load->view('pages/login');
            $this->load->view('includes/footer');

        }else{

             // Get user created e-mail
                $username = $this->input->post('username');
                // Get user created password and encrpyt
                $password = md5($this->input->post('password'));

                // Call login_user function from user_model
                $checker = $this->checkers_model->login_checker($username, $password);

                
                if($checker){

                    // Check if user exist from the database
                   
                    foreach($checker as $check){
                        $user_data = array(
                                'checker_id' => $check['checker_id'],
                                'checker_username' => $username,
                                'program_id' => $check['program_id'],
                                'logged_in' => true
                            );

                        $this->session->set_userdata($user_data);
                      
                         
                    }
                      redirect(base_url());
                  
                }
                else{
                    
                    // Else if e-mail and password is invalid return a messsage
                    $this->session->set_flashdata('invalid' ,'Invalid e-mail and password');;
                    redirect('login');
                }
             
        }
        }

       
    }

    public function add_checker(){

        if($this->session->userdata('logged_in')){
            
        $data['programs'] = $this->checkers_model->fetch_programs();

        // Validate form inputs
        $this->form_validation->set_rules('name', 'Checker name', 'required');
        $this->form_validation->set_rules('program', 'First name', 'required');
        $this->form_validation->set_rules('username', 'Last name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');
 

        if($this->form_validation->run() === FALSE){

            $this->load->view('includes/header');
            $this->load->view('checkers/add',$data);
            $this->load->view('includes/footer');

        }else{

            // Check if username existed
            $check = $this->checkers_model->check_username($this->input->post('username'));

            if($check){
                
                $this->session->set_flashdata('username_existed', 'Username '. $this->input->post('username').' already exist!');
                redirect('checkers/add_checker');
             
            }else{


                // If not
                $password = md5($this->input->post('password'));
                $checker = array(
                    'checker_name' => $this->input->post('name'),
                    'program_id' => $this->input->post('program'),
                    'checker_username' => $this->input->post('username'),
                    'checker_password' => $password
                );

                $this->checkers_model->insert_checker($checker);
                $this->session->set_flashdata('success', $this->input->post('name').' successfully added as a checker');
                redirect('checkers');


            }


        }
        }else{

            redirect('login');
        }


        

    }



    public function edit_checker($id){

        
        if($this->session->userdata('logged_in')){
                $data['programs'] = $this->checkers_model->fetch_programs();
        $data['profile'] = $this->checkers_model->checker_profile($id);

        // Validate form inputs
        $this->form_validation->set_rules('name', 'Checker name', 'required');
        $this->form_validation->set_rules('program', 'First name', 'required');
        $this->form_validation->set_rules('username', 'Last name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]');
    

        if($this->form_validation->run() === FALSE){

            $this->load->view('includes/header');
            $this->load->view('checkers/edit',$data);
            $this->load->view('includes/footer');

        }else{

            // Check if username existed
            $check_if_existed = $this->checkers_model->check_if_existed($id,$this->input->post('username'));

            if($check_if_existed){
                
                $this->session->set_flashdata('username_existed', 'Username '. $this->input->post('username').' already exist!');
                redirect('checkers/edit_checker/' .$id);
                
            }else{


                // If not
                $password = md5($this->input->post('password'));

                $checker = array(
                    'checker_name' => $this->input->post('name'),
                    'program_id' => $this->input->post('program'),
                    'checker_username' => $this->input->post('username'),
                    'checker_password' => $password
                );

                $this->checkers_model->update_checker($id,$checker);
                $this->session->set_flashdata('success', $this->input->post('name').' successfully updated');
                redirect('checkers');


            }


        }
        }else{

            redirect('login');
        }

        
    }

    public function remove_checker($id, $name){

        if($this->session->userdata('logged_in')){

            $data['id'] = $id;
            $data['name'] = $name;
    
            $this->load->view('includes/header');
            $this->load->view('checkers/remove',$data);
            $this->load->view('includes/footer');
            
        }else{

            redirect('login');
        }
   

    }

    public function remove(){

        if($this->session->userdata('logged_in')){
            $id = $this->input->get('checker_id');
            $name = $this->input->get('checker_name');

            $removed = $this->checkers_model->delete_checker($id);

            if($removed){
                $this->session->set_flashdata('success', $name.' successfully removed');
                redirect('checkers');
            }else{
                $this->session->set_flashdata('error', 'Unable to delete checker');
                redirect('checkers');
            }
        }else{
            redirect('login');
        }
    }

        // Logout the user 
    public function logout(){

    
        //Unset session datas
        $this->session->unset_userdata('checker_id');
        $this->session->unset_userdata('checker_username');
        $this->session->unset_userdata('program_id');
        $this->session->unset_userdata('logged_in');

        // and then redirect to login page
        redirect('login');

    }
}
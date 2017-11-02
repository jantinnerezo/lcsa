<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller{

    public function index(){

        if($this->session->userdata('logged_in')){

        	$date = $this->input->get('date');
        	$program = $this->input->get('program');

            $data['title'] = 'Attendance list';
            $data['programs'] = $this->attendance_model->fetch_program();
            $data['count_all'] = $this->attendance_model->count_attendance();
            $data['attendance'] = $this->attendance_model->fetch_attendance($date,$program);

            $this->load->view('includes/header');
            $this->load->view('attendance/index',$data);
            $this->load->view('includes/footer');
        }
        else{

            redirect('login');
        }

      
    }

    public function add_attendance(){

        if($this->session->userdata('logged_in')){
                    // Validate form inputs
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
             $this->form_validation->set_rules('attendance_type', 'Type', 'required');
          

            if($this->form_validation->run() === FALSE){

                $this->load->view('includes/header');
                $this->load->view('attendance/add_attendance');
                $this->load->view('includes/footer');

            }else{

        
                    $data = array(
                        'title' => $this->input->post('title'),
                        'description' => $this->input->post('description'),
                        'attendance_type' => $this->input->post('attendance_type'),
                        'program_id' => $this->input->post('program_id'),
                        'checker_id' => $this->input->post('checker_id'),
                        'status' => 1
                    );

                    $inserted = $this->attendance_model->inserted($data);
                    $date = Date('Y-m-d');
                    if($inserted){

                         $this->session->set_flashdata('success','New attendance successfully added!');
                         redirect('attendance?program=all&date='.$date);

                    }else{

                         $this->session->set_flashdata('error','Attendance not added successully');
                         redirect('attendance?program=all&date='.$date);
                    }
                   

            }
        }else{

            redirect('login');
        }

        
    }

    public function view_attendance($id){


        if($this->session->userdata('logged_in')){

            $search = $this->input->get('search');

            $data['details'] = $this->attendance_model->attendance_details($id);
            $data['students'] = $this->attendance_model->students_attendance($id,$search);

            $this->load->view('includes/header');
            $this->load->view('attendance/view_attendance',$data);
            $this->load->view('includes/footer');
        }
        else{

            redirect('login');
        }

    }

    public function activate(){
        $date = Date('Y-m-d');
        $id = $this->input->get('attendance_id');

        $data = array(
                'status' => 1
            );

        if($this->attendance_model->change_status($id,$data)){
            redirect('attendance?program=all&date='.$date);
        }else{
            redirect('attendance?program=all&date='.$date);
        }
    }

     public function deactivate(){
        $date = Date('Y-m-d');
        $id = $this->input->get('attendance_id');
         $data = array(
                'status' => 0
            );
        if($this->attendance_model->change_status($id,$data)){
            redirect('attendance?program=all&date='.$date);
        }else{
            redirect('attendance?program=all&date='.$date);
        }
    }


    public function onRemove($id){
        
        if($this->session->userdata('logged_in')){

            $data['id'] = $id;
          
            $this->load->view('includes/header');
            $this->load->view('attendance/remove',$data);
            $this->load->view('includes/footer');
            
        }else{

            redirect('login');
        }

        
    }

    public function remove_attendance(){


        $date = Date('Y-m-d');
        if($this->session->userdata('logged_in')){

            $id = $this->input->post('attendance_id');
            $username = $this->session->userdata('checker_username');
            $password = md5($this->input->post('password'));

            $checker = $this->checkers_model->login_checker($username, $password);

            if($checker){
                
                $removed = $this->attendance_model->delete_attendance($id);
    
                if($removed){

                    $this->session->set_flashdata('success', '1 attendance is removed');
                    redirect('attendance?program=all&date='.$date);
                    
                }else{

                    $this->session->set_flashdata('error', 'Unable to remove attendance');
                    redirect('attendance?program=all&date='.$date);
                }

            }else{

                $this->session->set_flashdata('error', 'Password is incorrect');
                redirect('attendance/on_remove/'.$id);
            }

        }else{
            redirect('login');
        }
    }

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller{


    public function index(){
        

         if($this->session->userdata('logged_in')){

            
            $data['title'] = 'Students';
            $data['count_all'] = $this->students_model->count_students();
            $data['students'] = $this->students_model->fetch_students($this->input->get('search'));

            $this->load->view('includes/header');
            $this->load->view('students/index',$data);
            $this->load->view('includes/footer');

         }else{
             redirect('login');

         }
        /*
        // Pagination config
        $config['base_url'] = base_url() . 'students';
        $config['total_rows'] = $this->students_model->count_students();
        $config['per_page'] = 50;
        $config['uri_segment'] = 2;
        $config['attributes'] = array('class' => 'pagination-links');

        // Init pagination
        $this->pagination->initialize($config);*/


    }


    public function edit($id = null){

        if($this->session->userdata('logged_in')){
             $id =  $this->uri->segment(3);
        $data['courses'] = $this->students_model->fetch_courses();
        $data['profile'] = $this->students_model->fetch_profile($id);

        // Validate form inputs
        $this->form_validation->set_rules('IdNos', 'Student ID', 'required');
        $this->form_validation->set_rules('firstname', 'First name', 'required');
        $this->form_validation->set_rules('lastname', 'Last name', 'required');
        $this->form_validation->set_rules('course', 'Course','required');
        $this->form_validation->set_rules('barcode', 'Barcode', 'required');
 

        if($this->form_validation->run() === FALSE){

            $this->load->view('includes/header');
            $this->load->view('students/edit',$data);
            $this->load->view('includes/footer');

        }else{

            // Process starts
            // First - Check if ID already exist
            $check_id = $this->students_model->check_if_exist($id,'IdNos',$this->input->post('IdNos'));
            if($check_id){

                // If ID existed then return a message to page
                $this->session->set_flashdata('id_existed','Student ID ' . $this->input->post('IdNos'). ' already exist!');
                redirect('students/edit_student/' .$id);

            }else{

                // ID Checked passed
                // Second - Check if Barcode already exist
                $check_barcode = $this->students_model->check_if_exist($id,'Barcode',$this->input->post('barcode'));

                if($check_barcode){
                    // If Barcode existed then return a message to page
                    $this->session->set_flashdata('barcode_existed','Student Barcode ' . $this->input->post('barcode'). ' already exist!');
                    redirect('students/edit_student/' .$id);

                }else{

                    //ID and Barcode passed!
                    //Store post data as an array
                    $student = array(
                        'IdNos' => $this->input->post('IdNos'),
                        'Name' => $this->input->post('firstname'),
                        'Lastname' => $this->input->post('lastname'),
                        'Course' => $this->input->post('course'),
                        'Barcode' => $this->input->post('barcode')
                    );

                    //Save the data to database
                    $this->students_model->save_changes($id,$student);


                    //Redirect to students page with message
                    $this->session->set_flashdata('success','You updated the student information of ' . $this->input->post('firstname') . ' ' . $this->input->post('lastname'));
                    redirect('students');



                }



            }
        }
        }else{

            redirect('login');

        }

       

     
    }


    public function view_student($id,$name){
        
        
        if($this->session->userdata('logged_in')){

            $data['student'] = $this->students_model->student_profile($id);
            $data['details'] = $this->students_model->student_attendance($id);

            $this->load->view('includes/header');
            $this->load->view('students/view_student',$data);
            $this->load->view('includes/footer');
        }
        else{

            redirect('login');
        }
        
    }

   
}
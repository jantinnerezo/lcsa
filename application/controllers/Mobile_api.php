<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mobile_api extends CI_Controller{

	public function __construct ()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-Auth-Token, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, HEAD, POST, OPTIONS, PUT, DELETE");
          $method = $_SERVER['REQUEST_METHOD'];
          if($method == "OPTIONS") {
           die();
          }
        parent::__construct();
     
    }

	// Test device to server connection
	public function test_connection(){

		// Get mobile api request
		echo 'connected!';


	}


	// Log the checker into the server
	public function mobile_login(){

		$postdata = file_get_contents("php://input");

		if (isset($postdata)) {
            $request = json_decode($postdata);
            $username = $request->username;
            $password = md5($request->password);

			//Call model
			echo json_encode($this->checkers_model->login($username,$password));
		}

	}

	// Add new attendance
	public function new_attendance(){

		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
            $request = json_decode($postdata);
            $title = $request->title;
            $description = $request->description;
            $program_id = $request->program_id;
            $type = $request->type;
            $checker_id = $request->checker_id;


            $data = array(
            		'title' => $title,
            		'description' => $description,
            		'program_id' => $program_id,
            		'attendance_type' => $type,
            		'checker_id' => $checker_id,
            		'status' => 1
            	);

			//Call model
			echo json_encode($this->attendance_model->insert_attendance($data));
		}
	}

	

	// Display attendance list by program
	public function mobile_attendance_list(){

		$program_id = $this->input->get('program_id');
		$search = $this->input->get('search');

		$attendance_list = $this->attendance_model->mobile_fetch_attendance($program_id,$search);

		if($attendance_list){

			$data = array();
			foreach($attendance_list  as $attendance){

				$created_time = date('F j, Y g:i A', strtotime($attendance['created_time']));
				$values = array(
						'id' => $attendance['id'],
						'title' => $attendance['title'],
						'description' => $attendance['description'],
						'program_id' => $attendance['program_id'],
						'created_time' => $created_time,
						'attendance_type' => $attendance['attendance_type'],
						'checker_id' => $attendance['checker_id'],
						'status' => $attendance['status'],
						'checker_name' => $attendance['checker_name'],
						'checker_username' => $attendance['checker_username'],
						'program' => $attendance['program']

					);
				$data[] = $values;
			}

			echo json_encode($data);

		}else{


			echo json_encode(false);
		}
		

		
	}

	public function fetch_id(){

		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
            $request = json_decode($postdata);
            $student_id = $request->student_id;
           
			//Call model
			echo json_encode($this->students_model->select_by_id($student_id));
		}

	}

	public function fetch_barcode(){

		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
            $request = json_decode($postdata);
            $barcode = $request->barcode;
           
			//Call model
			echo json_encode($this->students_model->select_by_barcode($barcode));
		}

	}


	public function signed_already(){

		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
            $request = json_decode($postdata);
            $attendance_id = $request->attendance_id;
            $student_id = $request->student_id;
         

			//Call model
			echo json_encode($this->students_model->already_signed($attendance_id, $student_id));
		}
	}

	public function sign_attendance(){

		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
            $request = json_decode($postdata);
            $attendance_id = $request->attendance_id;
            $student_id = $request->student_id;
            $checker_id = $request->checker_id;
           
            $data = array(
            		'attendance_id' => $attendance_id,
            		'student_id' => $student_id,
            		'checker_id' => $checker_id
            		
            	);

			//Call model
			echo json_encode($this->students_model->insert_to_db($data));
		}
	}

	public function checked(){

		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
            $request = json_decode($postdata);
            $attendance_id = $request->attendance_id;
          
        
			//Call model
			$checked = $this->students_model->select_checked($attendance_id);

			if($checked){


					$data = array();
					foreach($checked  as $check){

						$created_time = date('F j, Y g:i A', strtotime($check['attendance_time']));
						$values = array(
								'id' => $check['id'],
								'student_id' => $check['IdNos'],
								'name' => $check['Name'] . ' ' . $check['Lastname'],
								'course' => $check['Course'],
								'barcode' => $check['Barcode'],
								'attendance_time'=> $created_time,
								'checked_by' => $check['checker_name']

							);
						$data[] = $values;
					}

					echo json_encode($data);

			}else{


				echo json_encode(false);
			}
		}
	}

	public function checked_search(){

		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
            $request = json_decode($postdata);
            $attendance_id = $request->attendance_id;
            $search = $request->search;
           
          
			//Call model
			echo json_encode($this->students_model->select_checked($attendance_id,$search));
		}
	}

	public function remove_student(){


		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
            $request = json_decode($postdata);
            $attendance_id = $request->attendance_id;
            $student_id = $request->student_id;
           
         
			echo json_encode($this->students_model->remove_from_db($attendance_id,$student_id));
		}
	}

}


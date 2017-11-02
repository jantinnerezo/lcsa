<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller{

	 public function __construct (){

          parent::__construct();

     }

	 public function view($page = 'home'){

		if($this->session->userdata('logged_in')){
           	if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}

			$ip_address = $_SERVER['SERVER_ADDR']; // Get host IP
			$data['title'] = ucfirst($page);
			$data['ip'] = $ip_address;
		
			$this->load->view('includes/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('includes/footer');

        }else{

            redirect('login');
        }


		
	}
}


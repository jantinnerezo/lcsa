<?php

class Checkers_model extends CI_Model{

    // Count all students from the database
    public function count_checkers(){

        $rows = $this->db->count_all('checker');
        return $rows;

    }

    // Fetch all students from the database
    public function fetch_checkers($search = FALSE){

        if($search)
            $this->db->like('checker_name',$search);
            $this->db->or_like('checker_username',$search);



        $this->db->order_by('created_datetime','DESC');
        $this->db->limit('100');
        $this->db->select('*')
                 ->from('checker')
                 ->join('program','program.program_id = checker.program_id');

        
        $rows = $this->db->get();
                        
        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            return false;
        }

    }

    public function delete_checker($id){
        
      $this->db->query("DELETE FROM checker WHERE checker_id = $id");

        if($this->db->affected_rows() > 0){
            return true;
        
        }else{
            return false;
        }
        
    }


     // Get all programs
     public function fetch_programs(){
        
        $rows = $this->db->get('program');

        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            return false;
        }
        
    }

     // Check values existed
     public function check_username($username){
        
        $this->db->where('checker_username',$username);
        $row = $this->db->get('checker');

        if($row->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function insert_checker($data){

        $this->db->insert('checker',$data);
    }

     // Fetch checker profile
     public function checker_profile($id){
        
        $this->db->where('checker_id',$id);
        $this->db->select('*')
                 ->from('checker')
                 ->join('program','program.program_id = checker.program_id');

        $row = $this->db->get();

        if($row->num_rows() > 0){
            return $row->result_array();
        }else{
            return false;
        }
        
    }


     // Check values existed
     public function check_if_existed($id,$username){
        
        $this->db->where('checker_username',$username);
        $this->db->where('checker_id !=',$id);

        $row = $this->db->get('checker');

        if($row->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function update_checker($id, $data){

        $this->db->where('checker_id',$id);
		$this->db->update('checker', $data);
    }

     public function login_checker($username, $password){

        $this->db->where('checker_username',$username);
        $this->db->where('checker_password',$password);
        $this->db->from("checker");

        $checker = $this->db->get();


        if($checker->num_rows() > 0){

            return $checker->result_array();

        }else{

           
            return false;
        }
    }



    public function login($username, $password){

        $this->db->where('checker_username',$username);
        $this->db->where('checker_password',$password);
        $this->db->from("checker");

        $checker = $this->db->get();


        if($checker->num_rows() > 0){

            return $checker->result();

        }else{

            $response = array(
                'invalid' => true
                );
            return $response;
        }
    }

  
}
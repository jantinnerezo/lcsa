<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class attendance_model extends CI_Model{

    // Count all students from the database
    public function count_attendance(){

        $rows = $this->db->count_all('attendance');
        return $rows;

    }
  


    // Fetch all students from the database
    public function fetch_attendance($date = FALSE, $program = FALSE){

  
        if($date)
            $this->db->like('attendance.created_time',$date);
      

        if($program != 'all')
            $this->db->like('program.program',$program);
        else



        

      
        $this->db->order_by('created_time','DESC');
        $this->db->limit('100');
        $this->db->select('*')
                 ->from('attendance')
                 ->join('checker','checker.checker_id = attendance.checker_id')
                 ->join('program','program.program_id = attendance.program_id');

        
        $rows = $this->db->get();
                        
        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            return false;
        }

    }
      public function inserted($data){

        $this->db->insert('attendance',$data);

        if($this->db->affected_rows() > 0){
            return true;
        }else{
           return false;
        }
    }

    public function delete_attendance($id){
        
        $this->db->query("DELETE FROM attendance WHERE id = $id");

        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
        
    }


    public function insert_attendance($data){

        $this->db->insert('attendance',$data);

        if($this->db->affected_rows() > 0){
            $response = array(
                    'inserted' => true
                );
            return $response;
        }else{
            $response = array(
                    'inserted' => false
                );
            return $response;
        }
    }


     public function fetch_program(){


        $rows = $this->db->get('program');
                        
        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            return false;
        }

    }
    public function attendance_details($id){

        $this->db->where('id',$id);
        $rows = $this->db->get('attendance');
                        
        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            return false;
        }

    }

      public function change_status($id, $status){

        $this->db->where('id',$id);
        $this->db->update('attendance', $status);

         if($this->db->affected_rows() > 0){
            
            return true;
        }else{
           
            return false;
        }
    }


    // Fetch all students from the database
    public function students_attendance($id, $search = false){

        if($search)
            $this->db->like('students.IdNos',$search);
            $this->db->or_like('students.Barcode',$search);
            $this->db->or_like('students.Lastname',$search);
            $this->db->or_like('students.Name',$search);
            $this->db->or_like('students.Course',$search); 
   

        $this->db->where('student_attendance.attendance_id',$id);
        $this->db->order_by('student_attendance.attendance_time','DESC');
        $this->db->select('*')
                 ->from('student_attendance')
                 ->join('attendance','attendance.id = student_attendance.attendance_id')
                 ->join('students','students.id = student_attendance.student_id')
                 ->join('checker','checker.checker_id = student_attendance.checker_id');

        
        $rows = $this->db->get();
                        
        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            return false;
        }

    }

    // For mobile api --------------------------------------

  
     public function mobile_fetch_attendance($program_id, $search = FALSE){

        if($search)
            $this->db->like('created_time',$search);

        $this->db->where('attendance.program_id',$program_id);
        $this->db->where('status',1);
        $this->db->order_by('created_time','DESC');
        $this->db->limit('100');
        $this->db->select('*')
                 ->from('attendance')
                 ->join('checker','checker.checker_id = attendance.checker_id')
                 ->join('program','program.program_id = attendance.program_id');

        
        $rows = $this->db->get();
                        
        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            
            return false;
        }

    }



  
}
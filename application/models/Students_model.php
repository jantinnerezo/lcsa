<?php

class Students_model extends CI_Model{

    // Count all students from the database
    public function count_students(){

        $rows = $this->db->count_all('students');
        return $rows;
    }

    // Fetch all students from the database
    public function fetch_students($search = null){


    
        if(!IS_NULL($search))
            $this->db->like('IdNos',$search);
            $this->db->or_like('Barcode',$search);
            $this->db->or_like('Lastname',$search);
            $this->db->or_like('Name',$search);
            $this->db->or_like('Course',$search);
            


        $this->db->where('Barcode !=',' ');
        $this->db->order_by('Name','ASC');
        $this->db->limit('100');
        $rows = $this->db->get('students');
                        
        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            return false;
        }

    }

    // Fetch student profile
    public function fetch_profile($id){
        
        $this->db->where('id',$id);
        $row = $this->db->get('students');

        if($row->num_rows() > 0){
            return $row->result_array();
        }else{
            return false;
        }
        
    }

    // Get all courses
    public function fetch_courses(){

        $this->db->distinct('Course');
        $this->db->group_by('Course');
        $rows = $this->db->get('students');

        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            return false;
        }

    }

    // Check values existed
    public function check_if_exist($id,$field,$value){
        
        $this->db->where($field,$value);
        $this->db->where('id !=',$id);

        $row = $this->db->get('students');

        if($row->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function save_changes($id, $data){

        $this->db->where('id',$id);
		$this->db->update('students', $data);
    }

    public function student_profile($id){

        $this->db->where('id',$id);
        $rows = $this->db->get('students');
                
        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
                return false;
        }
    }

    public function student_attendance($id){

        $this->db->where('student_attendance.student_id',$id);
        $this->db->order_by('student_attendance.attendance_time','DESC');
        $this->db->select('*')
                ->from('student_attendance')
                ->join('attendance','attendance.id = student_attendance.attendance_id')
                ->join('checker','checker.checker_id = student_attendance.checker_id');

        $rows = $this->db->get();
                
        if($rows->num_rows() > 0){
             return $rows->result_array();
        }else{
                 return false;
        }
    }



    /* ------------------------------------------ */
    /* Mobile API's */

    public function select_by_id($student_id){

        $this->db->where('IdNos',$student_id);
        $row = $this->db->get('students');

        if($row->num_rows() > 0){
            return $row->result();
        }else{
              $response = array(
                'not_found' => true
                );
            return $response;
        }

    }

    public function select_by_barcode($barcode){

        $this->db->where('Barcode',$barcode);
        $row = $this->db->get('students');

        if($row->num_rows() > 0){
            return $row->result();
        }else{
              $response = array(
                'not_found' => true
                );
            return $response;
        }

    }

    public function already_signed($attendance_id, $student_id){

        $this->db->where('attendance_id',$attendance_id);
        $this->db->where('student_id',$student_id);
        $row = $this->db->get('student_attendance');

        if($row->num_rows() > 0){
              $response = array(
                'yes' => true
                );
            return $response;
        }else{
              $response = array(
                'no' => true
                );
            return $response;
        }

    }

    public function insert_to_db($data){

        $this->db->insert('student_attendance',$data);

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

    public function select_checked($attendance_id, $search = FALSE){

      
        $id = htmlentities($attendance_id);

       $rows = $this->db->query("SELECT * FROM `student_attendance` INNER JOIN students ON students.id = student_attendance.student_id INNER JOIN checker ON checker.checker_id = student_attendance.checker_id WHERE student_attendance.attendance_id = $id");

        /*$this->db->select('*')
                 ->from('student_attendance')
                 ->join('students','students.id = student_attendance.student_id')
                 ->join('checker','checker.checker_id = student_attendance.checker_id')
                 ->where('student_attendance.attendance_id',$attendance_id)
                 ->order_by('attendance_time','DESC');*/

        //$rows = $this->db->get();

        if($rows->num_rows() > 0){
            return $rows->result_array();
        }else{
            
            return false;
        }
    }
    public function remove_from_db($attendance_id, $student_id){

        $this->db->delete('student_attendance', array('attendance_id' => $attendance_id,'student_id' => $student_id)); 

         if($this->db->affected_rows() > 0){
            $response = array(
                    'removed' => true
                );
            return $response;
        }else{
            $response = array(
                    'removed' => false
                );
            return $response;
        }


    }


}
<?php
    class User_model extends CI_Model {
        function create($formArray){
            $this->db->insert("users",$formArray);
            $this->db->where($formArray);
            return $user=$this->db->get('users')->row_array();
            
        }
        function login($formArray){
            $this->db->where('email',$formArray['email']);
            return $user=$this->db->get('users')->row_array();
        }
        function updateUser($user_id,$formArray){
            $this->db->where('user_id',$user_id);
            $this->db->update('users',$formArray);
        }
        function getUser($user_id){
            $this->db->where('user_id',$user_id);
            return $user=$this->db->get('users')->row_array();//select * from users where user_id=?;
           }
    }
?>
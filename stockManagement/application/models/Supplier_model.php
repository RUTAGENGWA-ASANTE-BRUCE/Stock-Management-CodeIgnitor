<?php
    class Supplier_model extends CI_Model {
        function create($formArray){
            $this->db->insert("suppliers",$formArray);
            return $user=$this->db->get('suppliers')->row_array();
            
        }
        function login($formArray){
            $this->db->where('email',$formArray['email']);
            return $user=$this->db->get('suppliers')->row_array();
        }
    
        function updateUser($user_id,$formArray){
            $this->db->where('user_id',$user_id);
            $this->db->update('suppliers',$formArray);
        }
        function getSupplier($user_id){
            $this->db->where('user_id',$user_id);
            return $user=$this->db->get('suppliers')->row_array();//select * from suppliers where user_id=?;
           }
           function all(){
            return $suppliers=$this->db->get('suppliers')->result_array();//Select * from users'
        }
    }
?>
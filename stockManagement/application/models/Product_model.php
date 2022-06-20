<?php
    class Product_model extends CI_Model {
        function create($formArray){
            $this->db->insert("products",$formArray);
            return $user=$this->db->get('products')->row_array();
            
        }
        function updateProduct($user_id,$formArray){
            $this->db->where('user_id',$user_id);
            $this->db->update('products',$formArray);
        }
        function getProduct($user_id){
            $this->db->where('user_id',$user_id);
            return $product=$this->db->get('products')->row_array();//select * from products where user_id=?;
           }
           function all(){
            return $products=$this->db->get('products')->result_array();//Select * from users'
        }
    }
?>
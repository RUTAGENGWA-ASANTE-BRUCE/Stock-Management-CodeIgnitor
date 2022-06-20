<?php
    class Product_model extends CI_Model {
        function create($formArray){
            $this->db->insert("products",$formArray);
            return $user=$this->db->get('products')->row_array();
            
        }
        function updateProduct($product_id,$formArray){
            $this->db->where('product_id',$product_id);
            $this->db->update('products',$formArray);
        }
        function getProduct($product_id){
            $this->db->where('product_id',$product_id);
            return $product=$this->db->get('products')->row_array();//select * from products where user_id=?;
           }
           function all(){
            return $products=$this->db->get('products')->result_array();//Select * from users'
        }
        function delete($product_id){
            $this->db->where('product_id',$product_id);
            $this->db->delete('products');
        }
    }
?>
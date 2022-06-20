<?php
    class Inventory_model extends CI_Model {
        function create($formArray){
            $this->db->insert("inventories",$formArray);
            return $inventory=$this->db->get('inventories')->row_array();
            
        }
        function updateProduct($user_id,$formArray){
            $this->db->where('user_id',$user_id);
            $this->db->update('inventories',$formArray);
        }
        function getProduct($user_id){
            $this->db->where('user_id',$user_id);
            return $inventory=$this->db->get('inventories')->row_array();//select * from inventory where inventory_id=?;
           }
           function all(){
            return $inventories=$this->db->get('inventories')->result_array();//Select * from inventory'
        }
    }
?>
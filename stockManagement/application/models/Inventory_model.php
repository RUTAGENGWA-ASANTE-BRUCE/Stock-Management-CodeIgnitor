<?php
    class Inventory_model extends CI_Model {
        function create($formArray){
            $this->db->insert("inventories",$formArray);
            return $inventory=$this->db->get('inventories')->row_array();
            
        }
        function updateInventory($inventory_id,$formArray){
            $this->db->where('inventory_id',$inventory_id);
            $this->db->update('inventories',$formArray);
        }
        function getInventory($inventory_id){
            $this->db->where('inventory_id',$inventory_id);
            return $inventory=$this->db->get('inventories')->row_array();//select * from inventory where inventory_id=?;
           }
           function all(){
            return $inventories=$this->db->get('inventories')->result_array();//Select * from inventory'
        }
        function delete($inventory_id){
            $this->db->where('inventory_id',$inventory_id);
            $this->db->delete('inventories');
        }
    }
?>
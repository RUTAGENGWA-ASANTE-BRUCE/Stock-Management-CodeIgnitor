<?php
class Stock extends CI_Controller{
    function stockProducts($user_id){
        $this->load->model('User_model');
        $user=$this->User_model->getUser($user_id);
        $data=array();
        $data['user']=$user;
        
        $this->load->view('productsStock',$data);
    }
}
?>
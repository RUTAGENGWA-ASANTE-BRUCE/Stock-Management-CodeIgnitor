<?php
class User extends CI_Controller {
    function createUser(){
        $this->load->view('createUser');
    }
    function login(){
        $this->load->view('login');

    }
    function updateUser(){

    }
}
?>
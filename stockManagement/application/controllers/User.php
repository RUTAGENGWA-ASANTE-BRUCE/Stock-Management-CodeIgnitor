<?php
class User extends CI_Controller
{
    function createUser()
    {
        if (!$this->session->has_userdata('user_id')) {

            $this->load->model('User_model');
            $this->form_validation->set_rules('name', "Name", 'required');
            $this->form_validation->set_rules('email', "Email", 'required|valid_email');
            $this->form_validation->set_rules('gender', "Gender", 'required');
            $this->form_validation->set_rules('password', "Password", 'required');
            $this->form_validation->set_rules('nationality', "Nationality", 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('createUser');
            } else {
                $formArray = array();
                $formArray['name'] = $this->input->post('name');

                $formArray['email'] = $this->input->post('email');
                $formArray['gender'] = $this->input->post('gender');
                $formArray['nationality'] = $this->input->post('nationality');
                $formArray['password'] = hash("SHA512", $this->input->post('password'));
                $config = [
                    'file_name' => time(),
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path'    => 'public/images'
                ];
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('profilePicture')) {
                    $formArray['profilePicture'] = $this->upload->data('file_name');
                }
                $user = $this->User_model->create($formArray);
                $this->session->set_flashdata('success', 'User Registered successfully');
                $data['user'] = $user;
                redirect(base_url() . "Stock/stockProducts");
                $this->session->set_userdata($user);
            }
        } else {
            redirect(base_url() . 'User/userInfo');
            $this->session->set_flashdata('failure', 'You are already logged in!.');
        }
    }
    function login()
    {
        if (!$this->session->has_userdata('user_id')) {
            $this->load->model('User_model');
            $this->form_validation->set_rules('email', "Email", 'required|valid_email');
            $this->form_validation->set_rules('password', "Password", 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('login');
            } else {
                $formArray = array();
                $formArray['email'] = $this->input->post('email');
                $formArray['password'] = hash("SHA512", $this->input->post('password'));
                $user = $this->User_model->login($formArray);
                if (!$user) {
                    $this->load->view('login');
                } else {
                    $data['user'] = $user;
                    $this->session->set_flashdata('success', 'You logged in successfully');
                    $this->session->set_userdata($user);
                    redirect(base_url() . "Stock/stockProducts");
                }
            }
        } else {
            redirect(base_url() . 'User/userInfo');
            $this->session->set_flashdata('failure', 'You are already logged in!.');
        }
    }
    function userInfo()
    {
        if (!$this->session->has_userdata('user_id')) {
            redirect(base_url() . '/User/login');
        }

        $data = array();
        $data['user'] = $this->session->userdata;
        $this->load->view('user_info', $data);
    }
    function edit()
    {
        if (!$this->session->has_userdata('user_id')) {
            redirect(base_url() . '/User/login');
        }

        $this->load->model('User_model');
        $data = array();
        $data['user'] =  $this->session->userdata;
        $this->form_validation->set_rules("name", "Name", "required");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");
        $this->form_validation->set_rules('password', "Password", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('editProfile', $data);
        } else {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['email'] = $this->input->post('email');
            $formArray['password'] = hash("SHA512", $this->input->post('password'));
            $user = $this->User_model->updateUser($this->session->userdata['user_id'], $formArray);
            $this->session->set_flashdata('success', "Profile updated successfully!");
            $this->session->set_flashdata('userInfo',  $this->session->userdata);
            $this->session->set_userdata($user);
            redirect(base_url() . "User/userInfo");
        }
    }
    function logout()
    {
        if (!$this->session->has_userdata('user_id')) {
            redirect(base_url() . '/User/login');
        }
        $user_Info = array('user_id', 'name', 'email', 'gender', 'nationality', 'profilePicture', 'password');
        $this->session->unset_userdata($user_Info);
        redirect(base_url() . 'User/login');
    }
}

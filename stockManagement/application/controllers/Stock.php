<?php
class Stock extends CI_Controller
{
    function stockProducts($user_id)
    {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $data = array();
        $data['user'] = $user;
        $this->load->view('productsStock', $data);
    }
    function createProduct($user_id)
    {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $this->load->model('Supplier_model');
        $suppliers=$this->Supplier_model->all();
        $data = array();
        $data['user'] = $user;
        $data['suppliers'] = $suppliers;
        $this->load->model('Supplier_model');
        $this->form_validation->set_rules('name', "Name", 'required');
        $this->form_validation->set_rules('category', "Category", 'required');
        $this->form_validation->set_rules('price', "Price", 'required');
        $this->form_validation->set_rules('color', "Color", 'required');
        $this->form_validation->set_rules('supplier', "Supplier", 'required');
        $this->form_validation->set_rules('brand', "Brand", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('createProduct', $data);
        } else {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['category'] = $this->input->post('category');
            $formArray['price'] = $this->input->post('price');
            $formArray['color'] = $this->input->post('color');
            $formArray['supplier'] = $this->input->post('supplier');

            $config =[
                'allowed_types' => 'gif|jpg|png|jpeg',
                'upload_path'    => 'public/images'
            ];
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productPicture')) {
                $formArray['profilePicture'] = $this->upload->data('file_name');
            } else {
                $this->Supplier_model->create($formArray);
                $this->session->set_flashdata('success', 'Supplier Registered successfully');
                redirect(base_url() . "index.php/Stock/stockProducts/" . $user['user_id']);
            }

        
        }
    }

    function  productSuppliers($user_id)
    {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $data = array();
        $data['user'] = $user;
        $this->load->model('Supplier_model');
        $suppliers = $this->Supplier_model->all();
        $data['suppliers'] = $suppliers;
        $this->load->view('productSuppliers', $data);
    }

    function createSupplier($user_id)
    {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $data = array();
        $data['user'] = $user;
        $this->load->model('Supplier_model');
        $this->form_validation->set_rules('name', "Name", 'required');
        $this->form_validation->set_rules('email', "Email", 'required|valid_email');
        $this->form_validation->set_rules('gender', "Gender", 'required');
        $this->form_validation->set_rules('telephone', "Telephone", 'required');
        $this->form_validation->set_rules('location', "location", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('createSupplier', $data);
        } else {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['email'] = $this->input->post('email');
            $formArray['location'] = $this->input->post('location');
            $formArray['telephone'] = $this->input->post('telephone');
            $formArray['gender'] = $this->input->post('gender');

            $this->Supplier_model->create($formArray);
            $this->session->set_flashdata('success', 'Supplier Registered successfully');
            redirect(base_url() . "index.php/Stock/productSuppliers/" . $user['user_id']);
        }
    }

    function edit($user_id)
    {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $data = array();
        $data['user'] = $user;
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
            $this->User_model->updateUser($user_id, $formArray);
            $this->session->set_flashdata('success', "Profile updated successfully!");
            $this->session->set_flashdata('userInfo', $user);
            redirect(base_url() . "index.php/User/userInfo/" . $user_id);
        }
    }

    

}

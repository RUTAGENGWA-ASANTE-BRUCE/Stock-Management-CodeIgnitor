<?php
class Stock extends CI_Controller
{
    function stockProducts($user_id)
    {
        $this->load->model('User_model');
        $this->load->model('Product_model');
        $products=$this->Product_model->all();

        $user = $this->User_model->getUser($user_id);
        $data = array();
        $data['user'] = $user;
        $data['products'] = $products;

        $this->load->view('productsStock', $data);
    }
    function createProduct($user_id)
    {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $this->load->model('Supplier_model');
        $this->load->model('Product_model');
        $suppliers=$this->Supplier_model->all();
        $data = array();
        $data['user'] = $user;
        $data['suppliers'] = $suppliers;
        $this->load->model('Supplier_model');
        $this->form_validation->set_rules('name', "Name", 'required');
        $this->form_validation->set_rules('category', "Category", 'required');
        $this->form_validation->set_rules('price', "Price", 'required');
        $this->form_validation->set_rules('supplier', "Supplier", 'required');
        $this->form_validation->set_rules('brand', "Brand", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('createProduct', $data);
        } else {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['category'] = $this->input->post('category');
            $formArray['price'] = $this->input->post('price');
            $formArray['colors'] = join(",",$this->input->post('color'));
            $supplier=$this->input->post('supplier');
            $supplierInfo=explode(',',$supplier);
            $formArray['supplierName'] = $supplierInfo[0];
            $formArray['supplierId'] = $supplierInfo[1];

            $config =[
                'allowed_types' => 'gif|jpg|png|jpeg',
                'upload_path'    => 'public/images'
            ];
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productPicture')) {
                $formArray['productImage'] = $this->upload->data('file_name');
            } 

                $this->Product_model->create($formArray);
                $this->session->set_flashdata('success', 'Product Registered successfully');
                redirect(base_url() . "Stock/stockProducts/" . $user['user_id']);
            

        
        }
    }

    function editProduct($product_id){
        $this->load->model('Product_model');
        $this->load->model('Supplier_model');
        $product = $this->Product_model->getProduct($product_id);
        $data = array();
        $suppliers= $this->Supplier_model->all();
        $data['suppliers'] =$suppliers;
        $data['product'] = $product;
        $this->load->model('Supplier_model');
        $this->form_validation->set_rules('name', "Name", 'required');
        $this->form_validation->set_rules('category', "Category", 'required');
        $this->form_validation->set_rules('price', "Price", 'required');
        $this->form_validation->set_rules('supplier', "Supplier", 'required');
        $this->form_validation->set_rules('brand', "Brand", 'required');
        $user_id=$this->input->post('user_id');
        $data['user_id']=$user_id;

        if ($this->form_validation->run() == false) {
            $this->load->view('editProduct', $data);
        } else {
            $formArray = array();
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['category'] = $this->input->post('category');
            $formArray['price'] = $this->input->post('price');
            $formArray['brand'] = $this->input->post('brand');
            $formArray['colors'] = join(",",$this->input->post('color'));
            $supplier=$this->input->post('supplier');
            $supplierInfo=explode(',',$supplier);
            $formArray['supplierName'] = $supplierInfo[0];
            $formArray['supplierId'] = $supplierInfo[1];

            $config =[
                'allowed_types' => 'gif|jpg|png|jpeg',
                'upload_path'    => 'public/images'
            ];
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productPicture')) {
                $formArray['productImage'] = $this->upload->data('file_name');
            } 

                $this->Product_model->updateProduct($product_id,$formArray);
                $this->session->set_flashdata('success', 'Product Updated successfully');
                redirect(base_url() . "Stock/stockProducts/" . $this->input->post('user_id'));
                $this->session->set_flashdata('productInfo', $product);
        }
    }

    function deleteProduct($product_id){
        $this->load->model('Product_model');
        $user_id=$this->input->post('user_id');
        $this->load->model('User_model');
        $user= $this->User_model->getUser($user_id);
        $this->Product_model->delete($product_id);
        redirect(base_url() . "Stock/stockProducts/". $user['user_id']);
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
            redirect(base_url() . "Stock/productSuppliers/" .$this->input->post('user_id'));
        }
    }

    function editSupplier($supplier_id){
        $data = array();
        $user_id=$this->input->post('user_id');
        $data['user_id']=$user_id;
        $this->load->model('Supplier_model');
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $supplier = $this->Supplier_model->getSupplier($supplier_id);
        $data['supplier'] = $supplier;
        $data['user'] = $user;
        $this->form_validation->set_rules('name', "Name", 'required');
        $this->form_validation->set_rules('email', "Email", 'required|valid_email');
        $this->form_validation->set_rules('gender', "Gender", 'required');
        $this->form_validation->set_rules('telephone', "Telephone", 'required');
        $this->form_validation->set_rules('location', "location", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('editSupplier', $data);
        } else {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['email'] = $this->input->post('email');
            $formArray['location'] = $this->input->post('location');
            $formArray['telephone'] = $this->input->post('telephone');
            $formArray['gender'] = $this->input->post('gender');

            $this->Supplier_model->updateSupplier($supplier_id,$formArray);
            $this->session->set_flashdata('success', 'Supplier Updated successfully');
            redirect(base_url() . "Stock/productSuppliers/" . $user['user_id']);
        }
    }

    function deleteSupplier($supplier_id){
        $this->load->model('Supplier_model');
        $user_id=$this->input->post('user_id');
        $this->load->model('User_model');
        $user= $this->User_model->getUser($user_id);
        $this->Supplier_model->delete($supplier_id);
        redirect(base_url() . "Stock/productSuppliers/". $user['user_id']);
    }

    function  Inventories($user_id)
    {
        $this->load->model('User_model');
        $this->load->model('Inventory_model');
        $user = $this->User_model->getUser($user_id);
        $data = array();
        $data['user'] = $user;
        $this->load->model('Supplier_model');
        $suppliers = $this->Supplier_model->all();
        $inventories = $this->Inventory_model->all();
        $data['suppliers'] = $suppliers;
        $data['inventories'] = $inventories;
        $this->load->view('stockInventory', $data);
    }

    function createInventory($user_id)
    {
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $data = array();
        $data['user'] = $user;
        $this->load->model('Product_model');
        $products= $this->Product_model->all();
        $data['products']= $products;
        $this->form_validation->set_rules('product', "Product", 'required');
        $this->form_validation->set_rules('amount', "Amount", 'required');
        $this->form_validation->set_rules('color', "Color", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('createInventory', $data);
        } else {
            $formArray = array();
            $product= $this->input->post('product');
            $productInfo=explode(",",$product);
            $formArray['productId']=$productInfo[1];
            $formArray['productName']=$productInfo[0];
            $formArray['productImage']=$productInfo[2];
            $formArray['color'] = $this->input->post('color');
            $formArray['unitPrice']=$productInfo[3];
            $formArray['amount'] = $this->input->post('amount');
            $formArray['totalPrice']=$productInfo[3]*$formArray['unitPrice'];
            $formArray['supplierName']=$productInfo[4];
            $formArray['supplierId']=$productInfo[5];
            $this->load->model('Inventory_model');
            $this->Inventory_model->create($formArray);
            $this->session->set_flashdata('success', 'Inventory Registered successfully');
            redirect(base_url() . "Stock/Inventories/" . $user['user_id']);
        }
    }

    function editInventory($inventory_id){
        $data = array();
        $user_id=$this->input->post('user_id');
        $data['user_id']=$user_id;
        $this->load->model('Inventory_model');
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $products = $this->Product_model->all();
        $inventory = $this->Inventory_model->getInventory($inventory_id);
        $data['inventory'] = $inventory;
        $data['user'] = $user;
        $data['products'] = $products;
        $this->form_validation->set_rules('product', "Product", 'required');
        $this->form_validation->set_rules('amount', "Amount", 'required');
        $this->form_validation->set_rules('color', "Color", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('editInventory', $data);
        } else {
            $formArray = array();
            $product= $this->input->post('product');
            $productInfo=explode(",",$product);
            $formArray['productId']=$productInfo[1];
            $formArray['productName']=$productInfo[0];
            $formArray['productImage']=$productInfo[2];
            $formArray['color'] = $this->input->post('color');
            $formArray['unitPrice']=$productInfo[3];
            $formArray['amount'] = $this->input->post('amount');
            $formArray['totalPrice']=$productInfo[3]*$formArray['unitPrice'];
            $formArray['supplierName']=$productInfo[4];
            $formArray['supplierId']=$productInfo[5];
            $this->load->model('Inventory_model');
            $this->Inventory_model->updateInventory($inventory_id,$formArray);
            $this->session->set_flashdata('success', 'Inventory updated successfully');
            redirect(base_url() . "Stock/Inventories/" . $user['user_id']);
        }
    }

    function deleteInventory($inventory_id){
        $this->load->model('Inventory_model');
        $user_id=$this->input->post('user_id');
        $this->load->model('User_model');
        $user= $this->User_model->getUser($user_id);
        $this->Inventory_model->delete($inventory_id);
        redirect(base_url() . "Stock/inventories/". $user['user_id']);
    }
}

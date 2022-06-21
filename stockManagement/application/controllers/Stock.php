<?php
class Stock extends CI_Controller
{
    function stockProducts($user_id)
    {
        $this->load->model('User_model');
        $this->load->model('Product_model');
        $products = $this->Product_model->all();

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
        $suppliers = $this->Supplier_model->all();
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
            $formArray['colors'] = join(",", $this->input->post('color'));
            $supplier = $this->input->post('supplier');
            $supplierInfo = explode(',', $supplier);
            $formArray['supplierName'] = $supplierInfo[0];
            $formArray['supplierId'] = $supplierInfo[1];

            $config = [
                'file_name' => time(),
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

    function editProduct($product_id)
    {
        $this->load->model('Product_model');
        $this->load->model('Supplier_model');
        $product = $this->Product_model->getProduct($product_id);
        $data = array();
        $suppliers = $this->Supplier_model->all();
        $data['suppliers'] = $suppliers;
        $data['product'] = $product;
        $this->load->model('Supplier_model');
        $this->form_validation->set_rules('name', "Name", 'required');
        $this->form_validation->set_rules('category', "Category", 'required');
        $this->form_validation->set_rules('price', "Price", 'required');
        $this->form_validation->set_rules('supplier', "Supplier", 'required');
        $this->form_validation->set_rules('brand', "Brand", 'required');
        $user_id = $this->input->post('user_id');
        $data['user_id'] = $user_id;

        if ($this->form_validation->run() == false) {
            $this->load->view('editProduct', $data);
        } else {
            $formArray = array();
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['category'] = $this->input->post('category');
            $formArray['price'] = $this->input->post('price');
            $formArray['brand'] = $this->input->post('brand');
            $formArray['colors'] = join(",", $this->input->post('color'));
            $supplier = $this->input->post('supplier');
            $supplierInfo = explode(',', $supplier);
            $formArray['supplierName'] = $supplierInfo[0];
            $formArray['supplierId'] = $supplierInfo[1];

            $config = [
                'file_name' => time(),
                'allowed_types' => 'gif|jpg|png|jpeg',
                'upload_path'    => 'public/images'
            ];
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('productPicture')) {
                $formArray['productImage'] = $this->upload->data('file_name');
            }

            $this->Product_model->updateProduct($product_id, $formArray);
            $this->session->set_flashdata('success', 'Product Updated successfully');
            redirect(base_url() . "Stock/stockProducts/" . $this->input->post('user_id'));
            $this->session->set_flashdata('productInfo', $product);
        }
    }

    function deleteProduct($product_id)
    {
        $this->load->model('Product_model');
        $user_id = $this->input->post('user_id');
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $this->Product_model->delete($product_id);
        redirect(base_url() . "Stock/stockProducts/" . $user['user_id']);
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
            redirect(base_url() . "Stock/productSuppliers/" . $this->input->post('user_id'));
        }
    }

    function editSupplier($supplier_id)
    {
        $data = array();
        $user_id = $this->input->post('user_id');
        $data['user_id'] = $user_id;
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

            $this->Supplier_model->updateSupplier($supplier_id, $formArray);
            $this->session->set_flashdata('success', 'Supplier Updated successfully');
            redirect(base_url() . "Stock/productSuppliers/" . $user['user_id']);
        }
    }

    function deleteSupplier($supplier_id)
    {
        $this->load->model('Supplier_model');
        $user_id = $this->input->post('user_id');
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $this->Supplier_model->delete($supplier_id);
        redirect(base_url() . "Stock/productSuppliers/" . $user['user_id']);
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
        $products = $this->Product_model->all();
        $data['products'] = $products;
        $this->form_validation->set_rules('product', "Product", 'required');
        $this->form_validation->set_rules('amount', "Amount", 'required');
        $this->form_validation->set_rules('color', "Color", 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('createInventory', $data);
        } else {
            $formArray = array();
            $product = $this->input->post('product');
            $productInfo = explode(",", $product);
            $formArray['productId'] = $productInfo[1];
            $formArray['productName'] = $productInfo[0];
            $formArray['productImage'] = $productInfo[2];
            $formArray['color'] = $this->input->post('color');
            $formArray['unitPrice'] = $productInfo[3];
            $formArray['amount'] = $this->input->post('amount');
            $formArray['totalPrice'] = $productInfo[3] * $formArray['unitPrice'];
            $formArray['supplierName'] = $productInfo[4];
            $formArray['supplierId'] = $productInfo[5];
            $this->load->model('Inventory_model');
            $this->Inventory_model->create($formArray);
            $this->session->set_flashdata('success', 'Inventory Registered successfully');
            redirect(base_url() . "Stock/Inventories/" . $user['user_id']);
        }
    }

    function editInventory($inventory_id)
    {
        $data = array();
        $user_id = $this->input->post('user_id');
        $data['user_id'] = $user_id;
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
            $product = $this->input->post('product');
            $productInfo = explode(",", $product);
            $formArray['productId'] = $productInfo[1];
            $formArray['productName'] = $productInfo[0];
            $formArray['productImage'] = $productInfo[2];
            $formArray['color'] = $this->input->post('color');
            $formArray['unitPrice'] = $productInfo[3];
            $formArray['amount'] = $this->input->post('amount');
            $formArray['totalPrice'] = $productInfo[3] * $formArray['unitPrice'];
            $formArray['supplierName'] = $productInfo[4];
            $formArray['supplierId'] = $productInfo[5];
            $this->load->model('Inventory_model');
            $this->Inventory_model->updateInventory($inventory_id, $formArray);
            $this->session->set_flashdata('success', 'Inventory updated successfully');
            redirect(base_url() . "Stock/Inventories/" . $user['user_id']);
        }
    }

    function deleteInventory($inventory_id)
    {
        $this->load->model('Inventory_model');
        $user_id = $this->input->post('user_id');
        $this->load->model('User_model');
        $user = $this->User_model->getUser($user_id);
        $this->Inventory_model->delete($inventory_id);
        redirect(base_url() . "Stock/inventories/" . $user['user_id']);
    }

    function productsPdf()
    {
        require('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 23, true);
        $pdf->Cell(195, 20, 'Products', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 10, '', 0, 1, 'C');
        $pdf->Cell(10, 20, 'No', 1, 0, 'C');
        $pdf->Cell(20, 20, 'Name', 1, 0, 'C');
        $pdf->Cell(30, 20, 'Image', 1, 0, 'C');
        $pdf->Cell(30, 20, 'Category', 1, 0, 'C');
        $pdf->Cell(15, 20, 'Price', 1, 0, 'C');
        $pdf->Cell(30, 20, 'Color', 1, 0, 'C');
        $pdf->Cell(40, 20, 'Supplier', 1, 0, 'C');
        $pdf->Cell(20, 20, 'Brand', 1, 1, 'C');

        $this->load->model('Product_model');
        $products = $this->Product_model->all();
        $pdf->setFont('');
        $pdf->setFontSize(8);

        foreach ($products as $product) {
            $pdf->Cell(10, 20, $product['product_id'], 1, 0, 'C');
            $pdf->Cell(20, 20, $product['name'], 1, 0, 'C');
            $pdf->cell(30, 20, $pdf->image(base_url() . '/public/images/' . $product['productImage'], $pdf->GetX() + 7, $pdf->GetY() + 2, 15, 15), 1, 0, 'C');
            $pdf->Cell(30, 20, $product['category'], 1, 0, 'C');
            $pdf->Cell(15, 20, $product['price'], 1, 0, 'C');
            $pdf->Cell(30, 20, $product['colors'], 1, 0, 'C');
            $pdf->Cell(40, 20, $product['supplierName'], 1, 0, 'C');
            $pdf->Cell(20, 20, $product['brand'], 1, 1, 'C');
        }
        $pdf->Output('products.pdf', 'I');
    }

    function suppliersPdf()
    {
        require('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 23, true);
        $pdf->Cell(195, 20, 'Suppliers', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 10, '', 0, 1, 'C');
        $pdf->Cell(15, 20, 'No', 1, 0, 'C');
        $pdf->Cell(40, 20, 'Name', 1, 0, 'C');
        $pdf->Cell(40, 20, 'Email', 1, 0, 'C');
        $pdf->Cell(30, 20, 'location', 1, 0, 'C');
        $pdf->Cell(40, 20, 'Telephone', 1, 0, 'C');
        $pdf->Cell(30, 20, 'gender', 1, 1, 'C');

        $this->load->model('Supplier_model');
        $suppliers = $this->Supplier_model->all();
        $pdf->setFont('');
        $pdf->setFontSize(8);

        foreach ($suppliers as $supplier) {
            $pdf->Cell(15, 20, $supplier['user_id'], 1, 0, 'C');
            $pdf->Cell(40, 20, $supplier['name'], 1, 0, 'C');
            $pdf->Cell(40, 20, $supplier['email'], 1, 0, 'C');
            $pdf->Cell(30, 20, $supplier['location'], 1, 0, 'C');
            $pdf->Cell(40, 20, $supplier['telephone'], 1, 0, 'C');
            $pdf->Cell(30, 20, $supplier['gender'], 1, 1, 'C');
        }
        $pdf->Output('suppliers.pdf', 'I');
    }


    function inventoriesPdf()
    {
        require('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 23, true);
        $pdf->Cell(195, 20, 'Inventories', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(195, 10, '', 0, 1, 'C');
        $pdf->Cell(10, 20, 'No', 1, 0, 'C');
        $pdf->Cell(20, 20, 'Product', 1, 0, 'C');
        $pdf->Cell(30, 20, 'Image', 1, 0, 'C');
        $pdf->Cell(20, 20, 'color', 1, 0, 'C');
        $pdf->Cell(25, 20, 'Unit price', 1, 0, 'C');
        $pdf->Cell(20, 20, 'Amount', 1, 0, 'C');
        $pdf->Cell(30, 20, 'Total price', 1, 0, 'C');
        $pdf->Cell(40, 20, 'Supplier', 1, 1, 'C');

        $this->load->model('Inventory_model');
        $inventories = $this->Inventory_model->all();
        $pdf->setFont('');
        $pdf->setFontSize(8);

        foreach ($inventories as $inventory) {
            $pdf->Cell(10, 20, $inventory['inventory_id'], 1, 0, 'C');
            $pdf->Cell(20, 20, $inventory['productName'], 1, 0, 'C');
            $pdf->cell(30, 20, $pdf->image(base_url() . '/public/images/' . $inventory['productImage'], $pdf->GetX() + 7, $pdf->GetY() + 2, 15, 15), 1, 0, 'C');
            $pdf->Cell(20, 20, $inventory['color'], 1, 0, 'C');
            $pdf->Cell(25, 20, $inventory['unitPrice'], 1, 0, 'C');
            $pdf->Cell(20, 20, $inventory['amount'], 1, 0, 'C');
            $pdf->Cell(30, 20, $inventory['totalPrice'], 1, 0, 'C');
            $pdf->Cell(40, 20, $inventory['supplierName'], 1, 1, 'C');
        }
        $pdf->Output('inventories.pdf', 'I');
    }
}

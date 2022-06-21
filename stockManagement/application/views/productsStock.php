<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (!isset($SESSION['user_data'])){
        header(base_url().'/User/login');
    }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - Stock Products</title>
    <Link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap.css">
    <script src="https://kit.fontawesome.com/8d07e99402.js" crossorigin="anonymous"></script>
    <style>
        .sideBar {
            height: 790px;
            width: 20%;

            border-right: 1px solid black;
            float: left;
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
        }

        .mainBody {
            width: 80%;
            height: 790px;
            
            display: flex;
            flex-direction: column;
            background-color: whitesmoke;
            float: left;
        }
    </style>
</head>

<body>
    <div class="sideBar " class="">
        <h4 class="text-primary w-50 mt-2 mx-auto ">Bruce Store </h4>
        <div class="border-bottom d-flex flex-column pb-3">

            <div class="mt-4 ">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-primary"></div>
                <a class="btn btn-primary float-start ms-4">

                    <i class="fa-solid fa-truck-ramp-box"></i>
                    Products
                </a>
            </div>

            <div class="">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn bg-white  ms-4" href="<?php echo base_url() . 'Stock/productSuppliers' ; ?>">

                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    Suppliers
                </a>
            </div>
            <div class="mt-2">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn  float-start ms-4 bg-white" href="<?php echo base_url() . 'Stock/inventories' ; ?>">

                    <i class="fa-solid fa-truck-field"></i>
                    Inventory
                </a>
            </div>
            <div class="mt-2">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn bg-white  ms-4" href="<?php echo base_url() . 'User/userInfo' ; ?>">

                    <i class="fa-solid fa-user"></i>
                    User Info
                </a>
            </div>
        </div>
        <div class="mt-2">
            <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
            <a class="btn bg-white  ms-4" href="<?php echo base_url() . 'index.php/User/login'; ?>">

                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Log out
            </a>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="1" d="M0,256L48,224C96,192,192,128,288,106.7C384,85,480,107,576,101.3C672,96,768,64,864,90.7C960,117,1056,203,1152,208C1248,213,1344,139,1392,101.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    <div class="mainBody">
        <div class="w-100 bg-white p-2 d-flex justify-content-between" style="height:60px;margin-bottom: 10px;">
        <div class="d-flex flex-row  p-1 border col-3"  style="border-radius:25px;">
                    <i class="fa-solid fa-magnifying-glass fs-5 mt-2 ms-2"></i>
                    <input style="border:none;outline:none;flex:1;" type="text" name="search" />
                </div>
                <div class="col-2 text-right"><a href="<?php echo base_url() . 'Stock/productsPdf';?>" class="btn btn-secondary">View Poducts Pdf
                <i class="fa-solid fa-file-pdf"></i>
                    </a></div>
        <div class="d-flex">
            <img src="<?php echo base_url().'public/images/'.$user['profilePicture'];?>" style="width: 40px;height: 40px;object-fit: cover;border-radius:50%;"/>
            <div style="display:flex;flex-direction: column;margin-left: 5px;" >
                <p class="fs-6">  <?php echo $user['name'];?></p>
                <p class="fs-6" style="margin-top: -20px;">  <?php echo $user['email'];?></p>
            </div>
        </div>    
        </div>
        <div class="" style="padding-left: 20px;padding-right: 20px;display: flex;flex-direction: column;width: 100%;flex:1;">

            <?php
            $success = $this->session->userdata("success");
            if ($success != "") {
            ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                </div>
            <?php
            }
            ?>
            <?php
            $failure = $this->session->userdata('failure');
            if ($failure !=  "") {
            ?>
                <div class="alert alert-success"><?php echo $failure; ?></div>
            <?php
            }
            ?>

            <div class="d-flex justify-content-between mt-4 w-100">
                <h3>Products Stock</h3>
                <div class="col-2 text-right"><a href="<?php echo base_url() . 'Stock/createProduct' ?>" class="btn btn-primary">Add product
                        <i class="fa-solid fa-plus"></i>
                    </a></div>

            </div>
            <div class="table-responsive">

                <table class="table mt-4 w-100">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                        <th scope="col">Available Color</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)) {
                        foreach ($products as $product) { ?>
                            <tr class="bg-white" style="height:80px;">
                                <td><?php echo $product['product_id']; ?></td>
                                <td><img src="<?php echo base_url() . '/public/images/' . $product['productImage']; ?>" style="width:80px; height:60px; border-radius:10px;" /></td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['category']; ?></td>
                                <td><?php echo $product['price']; ?></td>
                                <td>
                                    <div class="d-flex mt-1">
                                        
                                        <?php $colors = explode(',', $product['colors']);
                                        foreach ($colors as $color) {
                                            ?>
                                            <div style="background-color:<?php echo $color; ?>;width:20px;height: 20px;border-radius:50%;margin-left: 3px;"></div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td><?php echo $product['supplierName']; ?></td>
                                <td><?php echo $product['brand']; ?></td>
                                
                                <td>
                                    <div class="d-flex">
                                        
                                        <button class="btn btn-primary">
                                                <a class="text-white" href="<?php echo base_url() . 'Stock/editProduct/' . $product['product_id'] ?>">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    Edit
                                                </a>
                                            </button>
                                        <button class="btn btn-danger ms-2">
                                        <a class="text-white"  href="<?php echo base_url() . 'Stock/deleteProduct/' . $product['product_id'] ?>">
                                            <i class="fa-solid fa-trash-can"></i>
                                            Delete
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else { ?>
                        <td colspan="5">No products found</td>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
            
        </div>
    </div>

</body>

</html>
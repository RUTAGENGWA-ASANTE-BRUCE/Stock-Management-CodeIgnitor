<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - Register User</title>
    <Link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/bootstrap.css">
    <style>
        .loginRegister {
            background-color: #8F21FF;
        }

        .form-part {
            display: flex;
            flex-direction: column;
            margin-bottom: 12px;
            position: relative;

        }

        label {
            /* margin-top: -10px; */
            position: absolute;
            top: -10px;
            margin-left: 35px;
            width: fit-content;
            padding-left: 3px;
            padding-right: 3px;
            background-color: white;
        }

        .form-input {
            margin-top: 3;
            border-radius: 25px;
            padding: 10px;
            width: 100%;
            padding-left: 10px;
            border: 1px solid gray;

        }

        form {
            padding-top: 20px;
            padding-left: 30px;
            padding-right: 30px;

        }

        .signup {
            font-size: 18px;
            font-weight: 400;
            border-radius: 25px;
            width: 100%;

            text-decoration: none;

        }

        .signin {
            font-size: 18px;
            font-weight: 400;
            border-radius: 25px;
            margin-top: 16px;
            width: 100%;


            text-decoration: none;
        }

        .describer {
            position: absolute;
            top: -10px;
            left: 210px;
        }
    </style>
</head>

<body class="loginRegister">
    <div class="border col-md-4 d-flex flex-column position-relative   bg-white my-auto border-primary rounded-3 mx-auto mt-3" style="height:760px">
        <h5 class="w-50 mx-auto describer text-white mt-4">Create Product</h5>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0d6efd" fill-opacity="1" d="M0,32L120,69.3C240,107,480,181,720,213.3C960,245,1200,235,1320,229.3L1440,224L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z">

            </path>
        </svg>
        <form method="POST" name="createUser" enctype="multipart/form-data" style="height:80%;" class="col-md-12" action="<?php echo base_url() .'Stock/createProduct/'.$user['user_id'];?>">
            <div class="form-part">
                <Label>Product Name</Label>
                <input required type="text" maxlength="60" name="name" class="form-input" />
                <p class="fs-6 text-danger"> <?php echo form_error('name'); ?></p>

            </div>
            <div class="form-part">
                <Label>Category</Label>
                <input required type="text" name="category" class="form-input" />
                <p class="fs-6 text-danger"> <?php echo form_error('category'); ?></p>

            </div>
            <div class="form-part">
                <Label>Price</Label>
                <input required type="number" name="price" class="form-input" />
            </div>
            <div class="form-part d-flex flex-column">
                <p>Color</p>
                <div class="d-flex justify-content-between">
                    <div class="d-flex">

                        <input type="checkbox" name="color[]" class="me-2 mt-2" value="red" checked> Red
                    </div>
                    <div class="d-flex">

                        <input type="checkbox" name="color[]" class="me-2 mt-2" value="black" checked> Black
                    </div>
                    <div class="d-flex">

                        <input type="checkbox" name="color[]" class="me-2 mt-2" value="green"> Green
                    </div>
                    <div class="d-flex">
                        <input type="checkbox" name="color[]" class="me-2 mt-2" value="Yellow"> Yellow

                    </div>
                </div>
                <p class="fs-6 text-danger"> <?php echo form_error('color'); ?></p>
            </div>
            <div class="form-part d-flex flex-column">
                <div class="d-flex">

                    <p class="col-5">Suppliers</p>
                    <select name="supplier">
                        <?php
                        if(!empty($suppliers)){
                            foreach($suppliers as $supplier){
                                ?>
                                <option value="<?php echo $supplier['name'].",".$supplier['user_id'];?>"><?php echo $supplier['name'];?></option>
                                <?php
                            }
                        }
                      ?>
                    </select>
                </div>
                <p class="fs-6 text-danger"> <?php echo form_error('supplier'); ?></p>
            </div>
            <div class="form-part d-flex flex-column">
                <div class="d-flex">

                    <p class="col-5">Product Picture</p>
                    <input required type="file" name="productPicture">
                </div>
                <p class="fs-6 text-danger"> <?php echo form_error('productPicture'); ?></p>
            </div>
            <div class="form-part">
                <Label>Brand</Label>
                <input required type="text" name="brand" class="form-input" />
                <p class="fs-6 text-danger"> <?php echo form_error('brand'); ?></p>

            </div>
           
            <button class="btn btn-primary bg-primary signup">Register Product</button>
            <a class="signin btn bg-dark text-white" href="<?php echo base_url() .'Stock/stockProducts/'.$user['user_id']; ?>">Cancel</a>
        </form>
    </div>
    </div>
</body>

</html>
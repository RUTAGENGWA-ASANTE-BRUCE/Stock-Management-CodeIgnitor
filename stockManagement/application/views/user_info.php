<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - User Info</title>
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

        .mainBody {
            height: 750px;
            padding-top: 10px;
            width: 80%;
    padding-right: 10px;
            float: left;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="sideBar " class="">
        <h4 class="text-primary w-50 mt-2 mx-auto ">Bruce Store</h4>
        <div class="border-bottom d-flex flex-column pb-4">

            <div class="mt-4 ">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn bg-white float-start ms-4" href="<?php echo base_url().'Stock/stockProducts/'.$user['user_id'];?>">

                    <i class="fa-solid fa-truck-ramp-box"></i>
                    Products
                </a>
            </div>
         
            <div class="">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn bg-white  ms-4" href="<?php echo base_url().'Stock/productSuppliers/'.$user['user_id'];?>">

                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    Suppliers
                </a>
            </div>
            <div class="mt-2">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn  float-start ms-4 bg-white" href="<?php echo base_url().'Stock/inventories/'.$user['user_id'];?>">
                    
                    <i class="fa-solid fa-truck-field"></i>
                    Inventory
                </a>
            </div>
            <div class="mt-2">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-primary"></div>
                <a class="btn btn-primary  ms-4">

                    <i class="fa-solid fa-user"></i>
                    User Info
                </a>
            </div>
        </div>
        <div class="mt-2">
            <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
            <a class="btn bg-white  ms-4" href="<?php echo base_url().'User/login';?>">

                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Log out
            </a>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="1" d="M0,256L48,224C96,192,192,128,288,106.7C384,85,480,107,576,101.3C672,96,768,64,864,90.7C960,117,1056,203,1152,208C1248,213,1344,139,1392,101.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    <div class="mainBody">
    <?php
            $success=$this->session->userdata("success");
            if($success!=""){
                ?>
                <div class="alert alert-success">
                    <?php echo $success;?>
                </div>
                <?php
            }
            ?>
            <?php
            $failure=$this->session->userdata('failure');
            if($failure !=  ""){
                ?>
                <div class="alert alert-success"><?php echo $failure;?></div>
                <?php
            }
            ?>
          <div class="col-md-8 ">
     
                <div class="row mt-2">
                    <div class="col-10">
                        <h3>User Profile</h3>
                    </div>
                    <div class="col-2 text-right"> <a href="<?php echo base_url().'User/edit/'.$user['user_id']?>" class="btn btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            Edit</a></div>
                </div>
                <hr/>
            </div>
                <div class="mt-4 d-flex"><p class="col-2">User Id: </p> <?php echo $user['user_id'] ?></div>
                <div class="mt-4 d-flex"><p class="col-2">User name: </p> <?php echo $user['name'] ?></div>
                <div class="mt-4 d-flex"><p class="col-2">Email: </p> <?php echo $user['email'] ?></div>
                <div class="mt-4 d-flex"><p class="col-2">Gender: </p> <?php echo $user['gender'] ?></div>
                <div class="mt-4 d-flex"><p class="col-2">Nationality: </p> <?php echo $user['nationality'] ?></div>
                <div class="mt-4 d-flex"><p class="col-2">profilePicture: </p> <img src="<?php echo base_url().'/public/images/'.$user['profilePicture'] ?>" style="width:100px;height:100px;border-radius:50%;"/></div>
                

    </div>

</body>

</html>
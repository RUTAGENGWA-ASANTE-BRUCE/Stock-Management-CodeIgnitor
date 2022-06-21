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
    <title>Stock Management - Products Suppliers</title>
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
        <h4 class="text-primary w-50 mt-2 mx-auto ">Bruce Store</h4>
        <div class="border-bottom d-flex flex-column pb-3">

            <div class="mt-4 ">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn bg-white float-start ms-4" href="<?php echo base_url() . 'Stock/stockProducts'  ; ?>">

                    <i class="fa-solid fa-truck-ramp-box"></i>
                    Products
                </a>
            </div>

            <div class="">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-primary"></div>
                <a class="btn btn-primary  ms-4">

                    <i class="fa-solid fa-hand-holding-dollar "></i>
                    Suppliers
                </a>
            </div>
            <div class="mt-2">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn  float-start ms-4 bg-white" href="<?php echo base_url() . 'Stock/inventories'; ?>">

                    <i class="fa-solid fa-truck-field"></i>
                    Inventory
                </a>
            </div>
            <div class="mt-2">
                <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
                <a class="btn bg-white  ms-4" href="<?php echo base_url() . 'User/userInfo' ?>">

                    <i class="fa-solid fa-user"></i>
                    User Info
                </a>
            </div>
        </div>
        <div class="mt-2">
            <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
            <a class="btn bg-white  ms-4" href="<?php echo base_url() . 'User/login'; ?>">

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
            <div class="d-flex flex-row  p-1 border col-3" style="border-radius:25px;">
                <i class="fa-solid fa-magnifying-glass fs-5 mt-2 ms-2"></i>
                <input style="border:none;outline:none;flex:1;" type="text" name="search" />
            </div>
            <div class="col-2 text-right"><a href="<?php echo base_url() . 'Stock/suppliersPdf';?>" class="btn btn-secondary">
                    <i class="fa-solid fa-file-pdf"></i>
                    View Suppliers Pdf
                    </a></div>
            <div class="d-flex">
                <img src="<?php echo base_url() . 'public/images/' . $user['profilePicture']; ?>" style="width: 40px;height: 40px;object-fit: cover;border-radius:50%;" />
                <div style="display:flex;flex-direction: column;margin-left: 5px;">
                    <p class="fs-6"> <?php echo $user['name']; ?></p>
                    <p class="fs-6" style="margin-top: -20px;"> <?php echo $user['email']; ?></p>
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

            <div class="d-flex mt-4 justify-content-between">
                <h3>Products Suppliers</h3>
                <div class="col-2 text-right"><a href="<?php echo base_url() . 'Stock/createSupplier'; ?>" class="btn btn-primary">Add supplier
                        <i class="fa-solid fa-plus"></i>
                    </a></div>
                
            </div>
            <div class="table-responsive">

            <table class="table mt-4">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Supplier Name</th>
                        <th scope="col">Supplier Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Location</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($suppliers)) {
                        foreach ($suppliers as $supplier) { ?>
                            <tr class="bg-white"  style="height:80px;">
                                <td><?php echo $supplier['user_id']; ?></td>
                                <td><?php echo $supplier['name']; ?></td>
                                <td><?php echo $supplier['email']; ?></td>
                                <td><?php echo $supplier['gender']; ?></td>
                                <td><?php echo $supplier['telephone']; ?></td>
                                <td><?php echo $supplier['location']; ?></td>
                                <td>
                                    <div class="d-flex">
                                        <form method="post" action="<?php echo base_url() . 'Stock/editSupplier/' . $supplier['user_id']; ?>"> <button class="btn btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </button>
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                        </form>
                                        <form action="<?php echo base_url() . 'Stock/deleteSupplier/' . $supplier['user_id'] ?>" method="post">
                                            <button class="btn btn-danger ms-2">
                                                <i class="fa-solid fa-trash-can"></i>
                                                Delete
                                            </button>
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else { ?>
                        <td colspan="5">No suppliers found</td>
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
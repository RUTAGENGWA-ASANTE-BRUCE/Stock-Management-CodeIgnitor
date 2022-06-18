<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - Stock Products</title>
    <Link rel="stylesheet"  href="<?php echo base_url();?>/public/css/bootstrap.css">
    <script src="https://kit.fontawesome.com/8d07e99402.js" crossorigin="anonymous"></script>
    <Link rel="stylesheet"  href="<?php echo base_url();?>/public/css/custom2.css" type="text/css">
    <style>
        .sideBar{
    height: 790px;
    width:20%;
    
    border-right:1px solid black;
    float:left;
    display:flex;
    flex-direction:column;
}
.mainBody{
    height: 750px;
    width:80%;
    float:left;
}

    </style>
</head>
<body>
    <div class="sideBar " class="">
        <h4 class="text-primary w-50 mt-2 mx-auto ">Bruce Store</h4>
        <div class="mt-4">
            <div style="width:7px;height:40px; " class="rounded-end float-start bg-primary"></div>
            <a class="btn btn-primary float-start ms-4">
                
                Inventory
                <i class="fa-solid fa-pallet-boxes"></i>
            </a>
        </div>
        <div class="">
            <div style="width:7px;height:40px; " class="rounded-end float-start bg-white"></div>
            <a class="btn bg-white  ms-4">
                
                Products
                <i class="fa-solid fa-pallet-boxes"></i>
            </a>
        </div>

    </div>
    <div class="mainBody"></div>
      
</body>
</html>
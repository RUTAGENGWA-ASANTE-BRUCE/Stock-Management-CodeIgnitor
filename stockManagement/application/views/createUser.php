<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - Register User</title>
    <Link rel="stylesheet"  href="<?php echo base_url();?>/public/css/bootstrap.css">
    <Link rel="stylesheet"  href="<?php echo base_url();?>/public/css/custom.css">
    
</head>
<body class="loginRegister">
        <div class="border col-md-4 d-flex flex-column   bg-white my-auto border-primary rounded-3 mx-auto mt-5" style="height:700px">
            <div class="col-md-12   bg-primary h-20 rounded-top" style="height: 30%;;">
            <img src="<?php echo base_url();?>/public/images/user.png" class="w-25   " style="height:150px;object-fit:contain;margin-left:35%;"/>
            <h5 class="w-25 mx-auto text-white">Welcome</h5>
        </div>
            <form method="POST" name="createUser" style="height:70%;" class="col-md-12" action="<?php echo base_url()?>index.php/User/create">
            <div class="form-part">
                <Label>Name</Label>
                <input type="text" name="email" class="form-input" />
            </div>
            <div class="form-part">
                <Label>Email</Label>
                <input type="email" name="email" class="form-input" />
            </div>
            <div class="form-part">
                <Label>Password</Label>
                <input type="password" name="password" class="form-input" />
            </div>
            <div class="form-part">
                <Label>Confirm Password</Label>
                <input type="cpassword" name="password" class="form-input" />
            </div>
            </form>
        </div>
        </div>
</body>
</html>
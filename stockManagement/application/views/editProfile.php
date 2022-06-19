<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management - Update User Info</title>
    <Link rel="stylesheet"  href="<?php echo base_url();?>/public/css/bootstrap.css">
    <Link rel="stylesheet"  href="<?php echo base_url();?>/public/css/custom2.css">
    
</head>
<body class="loginRegister">
        <div class="border col-md-4 d-flex flex-column position-relative   bg-white my-auto border-primary rounded-3 mx-auto mt-5" style="height:700px">
            <h5 class="w-50 mx-auto describer text-white mt-5">Update Profile</h5>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" ><path fill="#0d6efd" fill-opacity="1" d="M0,32L120,69.3C240,107,480,181,720,213.3C960,245,1200,235,1320,229.3L1440,224L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z">
            
            </path></svg>
            <form method="POST" name="createUser" style="height:80%;" class="col-md-12"  action="<?php echo base_url().'index.php/user/edit/'.$user['user_id'];?>">
            <div class="form-part">
                <Label>Name</Label>
                <input type="text" name="name" class="form-input"  value="<?php echo set_value('name',$user['name']);?>" />
                <?php echo form_error('name');?>

            </div>
            <div class="form-part">
                <Label>Email</Label>
                <input type="email" name="email" class="form-input"  value="<?php echo set_value('name',$user['email']);?>" />
                <?php echo form_error('email');?>

            </div>
            <div class="form-part">
                <Label>New Password</Label>
                <input type="password" name="password" class="form-input" />
                <?php echo form_error('password');?>

            </div>
            <div class="form-part">
                <Label>Confirm Password</Label>
                <input type="password" name="cpassword" class="form-input" />
            </div>
            <button class="btn btn-primary bg-primary signup">Update</button>
            <a class="signin btn text-white bg-dark" href="<?php echo base_url().'index.php/User/userInfo/'.$user['user_id']; ?>">Cancel</a>
           
            </form>
        </div>
        </div>
</body>
</html>
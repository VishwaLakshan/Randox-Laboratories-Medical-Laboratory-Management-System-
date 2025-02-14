<?php
use Classes\DbConnector;
use Classes\Customer;
require 'vendor/autoload.php';

if(isset($_GET['username'])){
    $username = $_GET['username'];
}else{
    header('location: user_Login.php');
    die();
}
$db = new DbConnector();
$conn = $db->getConnection();
$cus = new Customer();
if(isset($_POST['changepw'])){
    $username = $_POST['username'];
    $new = $_POST['new'];
    $confirm = $_POST['confirm'];
    $hashedPw = password_hash($new,PASSWORD_BCRYPT);
    if($cus->updatePassword($conn,$username,$hashedPw)){
        header('location: user_Login.php');
        die();
    }else{
        echo "Password Update failed!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Change Password</title>
    <style>
        body {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-image: url('https://img.freepik.com/free-vector/hand-drawn-international-nurses-day-background_23-2149341238.jpg?w=2000');





        }

        .container::before{
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 110%;
            z-index: -1;
            background-color: rgba(0, 0, 0, 0.4);
        }



        /* Responsive styles */
        @media (max-width: 480px) {
            .container {
                width: 90%;
            }
        }


        /* Forgot Password Link */
        .forgot_password {
            text-align: left;
            margin-top: -15px;
            margin-bottom: 20px;

        }

        .forgot_password a {
            color: black;
            text-decoration: none;
        }

        button{
            float: right;
            background: forestgreen;
            padding: 10px 15px;
            color: #fff;
            border-radius:5px;
            margin-right: 10px;
            border: none;
        }

        button:hover{
            opacity: .7;
            color: green;
        }

        .error {
            background: #F2DEDE;
            color: #A94442;
            padding: 10px;
            width: 95%;
            border-radius: 5px;
            margin:20px auto;
        }

        .logo {


            /* Initial styles for highlighting */
            border: 4px solid transparent; /* Add a transparent border */
            transition: border-color 0.3s, opacity 0.3s; /* Smooth transition effect */
        }

        .logo:hover {

            opacity: 0.9; /* Reduce opacity slightly on hover (optional) */
        }


    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<img src="assets/images/logo/logo.png" alt="Logo" class="logo">
<br><br><br><br>
<div class="container d-flex justify-content-center align-items-center">
    <form class="border shadow-lg p-3 rounded" action="" method="post" style="width: 600px;background-color: #ffffff;">
        <h2 class="text-center p-3">Change Password</h2><br>
        <input type="hidden" name="username" value="<?php echo $username; ?>">
        <div class="mb-3 d-flex align-items-center">
            <i class="fa fa-lock" aria-hidden="true" style="font-size: 30px; margin-right: 8px;"></i>
            <input type="password" name="new" class="form-control" placeholder="Enter Your New Password" style="width: 565px;">
        </div>
        <div class="mb-3 d-flex align-items-center">
            <i class="fa fa-lock" aria-hidden="true" style="font-size: 30px; margin-right: 8px;"></i>
            <input type="password" name="confirm" class="form-control" placeholder="Enter Your Confirm Password" style="width: 565px;">
        </div>
        <input type="submit" name="changepw" value="Update Password" class="btn btn-primary" style="float: right;">
        <br><br>
    </form>
</div>
</body>
</html>

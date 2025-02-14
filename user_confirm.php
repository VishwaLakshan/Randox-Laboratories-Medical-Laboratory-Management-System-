<?php
use Classes\DbConnector;
use Classes\Customer;
require 'vendor/autoload.php';

$cus = new Customer();
$db = new DbConnector();
$conn = $db->getConnection();
if(isset($_GET['username'])){
    $username =$_GET['username'];
}
if(isset($_POST['verify'])){
    $otp = $_POST['otp'];
    $username = $_POST['username'];
    $dbotp = $cus->getOTPByUsername($conn,$username);
    if ($otp == $dbotp){
        header('location: user_password_change.php?username='.$username);
        die();
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirm Password</title>
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

    <form class="border shadow-lg p-3 rounded" action="" method="post"  style="width: 600px;background-color: #ffffff;"">

        <div>
            <h2 class="text-center">Code Verification</h2><br>
            <h5 class="text-center"><b>Check your Mobile Phone</b></h5>
            <br><br>
            <input type="hidden" name="username" value="<?php echo $username ?? ''; ?>">
            <input type="text" name="otp" placeholder="Enter Received OTP Number" class="form-control ml-2" style="width: 565px;"><br>
            <input type="submit" name="verify" value="CONFIRM" class="btn btn-primary" style="float: right;">
        </div>
    </form>
</div>
</body>
</html>

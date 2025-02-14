<?php
session_start();
if(isset($_SESSION['AUTH_TOKEN'])){
    header('location: user_Home.php');
    die();
}
use Classes\Customer;
use Classes\DbConnector;
require_once 'vendor\autoload.php';

$db = new DbConnector();
$conn = $db->getConnection();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $customer =  new Customer();
    if($customer->authenticate($username,$password,$conn)){
        $token = $customer->generateAuthToken();
        $_SESSION['AUTH_TOKEN'] = $token;
        $customer->updateAuthToken($conn,$username,$token);
        header("location: user_Home.php");
    }else{
        header("location: user_Login.php?error=Username Password Incorrect");
    }
}
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Randox Login</title>
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
*/


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
                width: 50%;
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
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body style="background-color: #a7c8ff;">
    <img src="assets/images/logo/logo.png" alt="Logo" class="logo" >
    <br><br><br><br>
    <div class="container d-flex justify-content-center align-items-center">

        <form class="border shadow-lg p-3 rounded" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  style="width: 600px;background-color: #ffffff;border: 10px solid black; padding: 20px;">
            <h3 class="text-center p-3">Sign In</h3>
            <hr>
            <?php if (isset($_GET['error'])) {
                $error = $_GET['error'];?>
                <div class="alert alert-danger" role="alert" style="width: 100%; left: 5px;">
                    <?= $error ?>
                </div>
            <?php } ?>

            <div class="mb-3 d-flex align-items-center">
                <label for="username" class="form-label">
                    <i class="fa fa-user" aria-hidden="true" style="font-size: 30px; margin-right: 5px;"></i>
                </label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" style="width: 565px;">
            </div>

            <div class="mb-3 d-flex align-items-center">
                <label for="password" class="form-label">
                    <i class="fa fa-lock" aria-hidden="true" style="font-size: 30px; margin-right: 8px;"></i>
                </label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" style="width: 565px;">
            </div>

            <div class="forgot_password">
                <br>
                <a class="link" href="user_ForgetPW.php"><u><b>Forgot Password?</b></u></a>
            </div>

            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
        </div>
    </body>
    </html>

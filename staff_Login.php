<?php
session_start();

use Classes\Receptionist;
use Classes\DbConnector;
use Classes\Labtechnician;

require_once 'vendor\autoload.php';

$msg = null;

if (isset($_POST['login'])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];

    $db = new DbConnector();
    $conn = $db->getConnection();
    $re = new Receptionist();
    $labTec = new Labtechnician();

    if (ctype_alpha($uname)){
        if ($re->verifyAdmin($uname,$pass,$conn)){
            $_SESSION['Admin'] = $uname;
            header("location: receptionist_Dashboard.php?uname=$uname");
            die();
        }elseif ($re->verifyReceptionist($uname,$pass,$conn)){
            $_SESSION['Admin'] = $uname;
            header("location: receptionist_Dashboard.php?uname=$uname");
            die();
        }elseif ($labTec->verifyLabTech($uname,$pass,$conn) == "senior"){
            $_SESSION['Labtec'] = $uname;
            header("location: seniorLabTech_Dashboard.php");
            die();
        }elseif ($labTec->verifyLabTech($uname,$pass,$conn) == "junior") {
            $_SESSION['Labtec'] = $uname;
            header("location: assistantLabTech_Dashboard.php");
            die();
        }else{
            $msg = "<div class='bg-warning text-center mx-1'>Username or Password Invalid</div>";
        }
    }else{
        $msg = "<div class='bg-warning text-center mx-1'>Username or Password Invalid</div>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Randox-Laboratory | Staff Login</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/receptionist_Login_style.css" type="text/css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">


</head>

<body>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <div class="left">
        <img src="assets/images/Login/greenLogin.png"
             alt="Receptionist Image" width="500px">
    </div>

    <div class="col-md-6">
        <div class="login-box">
            <h2 class="header">Staff Login</h2>
            <?php echo $msg; ?>
            <br>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label"><i class="fas fa-user"></i> Username </label>
                    <input type="text" id="username" name="username" class="form-control"
                           placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="fas fa-lock"></i> Password </label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Enter your password" required>
                </div>

                <div class="forget-password mt-3">
                    <a href="staff_ForgetPassword.php">Forgot your password?</a>
                </div>
                <br>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </div>
            </form>

        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>

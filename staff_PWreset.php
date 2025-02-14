<?php

use Classes\DbConnector;
use Classes\Receptionist;
use Classes\Labtechnician;

require_once 'vendor/autoload.php';

$db = new DbConnector();
$conn = $db->getConnection();
$receptionist = new Receptionist();
$labTec = new Labtechnician();

if (isset($_POST['updatePW'])) {
    $username = $_POST['username'];
    $password = $_POST['newPassword'];
    $confPassword = $_POST['newPassword'];

    if ($password == $confPassword){
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        $re = $receptionist->updatePassword($conn,$username,$hashPassword);
        $lab = $labTec->updatePassword($conn,$username,$hashPassword);
        if ($re || $lab) {
            $receptionist->updateOTP($conn,$username,"");
            $labTec->updateOTP($conn,$username,"");
            header("location: staff_Login.php");
            die();
        }else{
            header("location: staff_ForgetPassword.php?msg=New Password and Confirm password doesn't match");
            die();
        }
    }else{
        header("location: staff_OTPverify.php?msg=New Password and Confirm password doesn't match");
        die();
    }
}

if(isset($_POST['verify'])){
    $username = $_POST['username'];
    $otp = $_POST['otp'];

    $receptionistOTP = $receptionist->getOTPByUsername($conn,$username);
    $labTecOTP = $labTec->getOTPByUsername($conn,$username);

    if (isset($receptionistOTP) || isset($labTecOTP)) {
        if ($otp == $receptionistOTP || $otp == $labTecOTP) {
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Randox-Laboratory | Change Password </title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/receptionist_Login_style.css" type="text/css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">


</head>

<body>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <div class="left">
        <img src="assets/images/Login/Reset%20password.png"
             alt="Receptionist Image" width="500px">
    </div>

    <div class="col-md-6">
        <div class="login-box">
            <h2 class="header">Reset Password</h2>

            <br>
            <form action="" method="post">
                <input type="hidden" name="username" value=" <?php echo $username; ?>">
                <div class="mb-3">
                    <label for="password_new" class="form-label"><i class="fas fa-lock"></i> New Password </label>
                    <input type="text" id="password_new" name="newPassword" class="form-control"
                           placeholder="Enter your new password" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="fas fa-lock"></i> Confirm Password </label>
                    <input type="password" id="password" name="confPassword" class="form-control"
                           placeholder="Enter your confirm password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="updatePW">Update Password</button>
                </div>
            </form>

        </div>
    </div>

</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

<?php
        }else {
            header("location: staff_OTPverify.php?username=$username&msg=OTP Invalid");
            die();
        }
    }else{
        header("location: staff_ForgetPassword.php?msg=Something is wrong!");
        die();
    }
}else{
    header("location: staff_Login.php");
    die();
}
?>

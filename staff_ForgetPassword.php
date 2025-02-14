<?php

use Classes\Receptionist;
use Classes\Labtechnician;
use Classes\DbConnector;
use Classes\Mail;

require_once 'vendor/autoload.php';

$msg = null;
$receptionist = new Receptionist();
$labTec = new Labtechnician();
$db = new DbConnector();
$mail = new Mail();
$conn = $db->getConnection();

function generateOTP(): string
{
    $otpLength = 6;

    $otp = "";
    for ($i = 0; $i < $otpLength; $i++) {
        $otp .= rand(0, 9);
    }

    return $otp;
}

if (isset($_POST['otp'])){
    $username = $_POST['username'];
    $receptionistEmail = $receptionist->getEmailByUsername($conn,$username);
    $labTecEmail = $labTec->getEmailByUsername($conn,$username);

    $otp = generateOTP();
    echo "recep".$receptionistEmail;
    echo "labtec".$labTecEmail;
    if (isset($receptionistEmail)){
        $receptionist->updateOTP($conn,$username,$otp);
        $mail->sendMail($receptionistEmail,"Password Reset OTP Code :: Randox-Laboratory","This is your OTP Code for your account Password Reset, <br><br>OTP Code: $otp <br><br>If you didnt request a password change contact system admin.");
        header("location: staff_OTPverify.php?uname=$username");
        die();
    }elseif (isset($labTecEmail)){
        $labTec->updateOTP($conn,$username,$otp);
        $mail->sendMail($receptionistEmail,"Password Reset OTP Code :: Randox-Laboratory","This is your OTP Code for your account Password Reset, <br><br>OTP Code: $otp <br><br>If you didnt request a password change contact system admin.");
        header("location: staff_OTPverify.php?uname=$username");
        die();
    }else{
        $msg = "<div class='bg-warning text-center mx-1'>Username Invalid</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Randox-Laboratory | Forgot Password</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/receptionist_Login_style.css" type="text/css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
</head>

<body>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <div class="left">
        <img src="assets/images/Login/fp.jpg"
             alt="Receptionist Image" width="500px">
    </div>

    <div class="col-md-6">
        <div class="login-box">
            <h2 class="header">Forget Password</h2>
            <?php echo $msg; ?>
            <br>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label"><i class="fas fa-user"></i> Username: </label>
                    <input type="text" id="username" name="username" class="form-control"
                           placeholder="Enter your username" required>
                </div>

                <br>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="otp">SEND OTP</button>
                </div>
            </form>

        </div>
    </div>

</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>


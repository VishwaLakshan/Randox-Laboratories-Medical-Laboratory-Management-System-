<?php

$msg=null;

if (isset($_GET['username'])){
    $username = $_GET['username'];
}else{
    header("location: staff_ForgetPassword.php");
    die();
}

if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
    $msg = "<div class='bg-danger text-white text-center'>$message</div>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Randox-Laboratory | OTP Verification </title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/receptionist_Login_style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <div class="left">
        <img src="assets/images/Login/Enter%20OTP.png" alt="Receptionist Image" width="500px">
    </div>

    <div class="col-md-6">
        <div class="login-box">
                <h2 class="header">Check your Email</h2>
                <br>
                <?php echo $msg; ?>
                <form action="staff_PWreset.php" method="post">
                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                    <div class="mb-3">
                        <label for="otp" class="form-label"><i class="bi bi-1-square-fill"></i> <i class="bi bi-3-square-fill"></i> OTP Code: </label>
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP Code" required>
                    </div>
                    <br>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="verify">CONFIRM</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>



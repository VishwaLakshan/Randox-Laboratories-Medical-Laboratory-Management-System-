<?php

use Classes\Customer;
use Classes\DbConnector;
use Classes\SMS;

require_once 'vendor/notifylk/notify-php/autoload.php';
require_once 'vendor/autoload.php';
$customer = new Customer();
$db = new DbConnector();
$sms = new SMS();
$conn = $db->getConnection();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $data = $customer->getCustomerData($conn,$username);
    if($data){
            $otp = $sms->generateOTP();
            $api_instance = new NotifyLk\Api\SmsApi();
            $user_id = "26122"; // string | API User ID - Can be found in your settings page.
            $api_key = "nqFF2I372eehSUiTY3oI"; // string | API Key - Can be found in your settings page.
            $message1 = "Randox Laboratory Badulla"."      ".$username . " your OTP " . $otp;
            // string | Text of the message. 320 chars max.

            $to = $data->getPhone(); // string | Number to send the SMS. Better to use 9471XXXXXXX format.
            $sender_id = "NotifyDEMO"; // string | This is the from name recipient will see as the sender of the SMS. Use \\\"NotifyDemo\\\" if you have not ordered your own sender ID yet.
            $contact_fname = ""; // string | Contact First Name - This will be used while saving the phone number in your Notify contacts (optional).
            $contact_lname = ""; // string | Contact Last Name - This will be used while saving the phone number in your Notify contacts (optional).
            $contact_email = ""; // string | Contact Email Address - This will be used while saving the phone number in your Notify contacts (optional).
            $contact_address = ""; // string | Contact Physical Address - This will be used while saving the phone number in your Notify contacts (optional).
            $contact_group = 0; // int | A group ID to associate the saving contact with (optional).
            $type = null; // string | Message type. Provide as unicode to support unicode (optional).
            $customer->updateOTP($conn,$username,$otp);
            try {
                $api_instance->sendSMS($user_id, $api_key, $message1, $to, $sender_id, $contact_fname, $contact_lname, $contact_email, $contact_address, $contact_group, $type);
                header("location: user_confirm.php?username=$username");
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    }

}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forget Password</title>
   <style>

body {
     background-image: url('https://img.freepik.com/free-vector/hand-drawn-international-nurses-day-background_23-2149341238.jpg?w=2000');
     background-size: cover;
     background-position: center;
     background-repeat: no-repeat;
     background-attachment: fixed;



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
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #a7c8ff;">
<img src="assets/images/logo/logo.png" alt="Logo" class="logo">
<br><br><br><br>
<div class="container d-flex justify-content-center align-items-center">

    <form class="border-4 shadow-lg p-3 rounded" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"  style="width: 600px;background-color: #ffffff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
        <h2 class="text-center p-3">Forgot Password</h2><br>

        <div class="mb-3 d-flex align-items-center">
            <i class="fa fa-user" aria-hidden="true" style="font-size: 30px; margin-right: 20px;"></i>
            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Your Username" style="width: 560px;">
        </div>
        <input type="submit" name="login" value="SEND OTP" class="btn btn-primary" style="float: right;">
        <br><br>

    </form>
</body>
</html>
<?php
use Classes\Payment;
use Classes\DbConnector;
use Classes\Appointment;
use Classes\SMS;
use Classes\UserAccount;
use Classes\Mail;

require_once 'vendor/autoload.php';

$db = new DbConnector();
$payment = new Payment();
$appointment = new Appointment();
$sms = new SMS();
$user = new UserAccount();
$mail = new Mail();

$conn = $db->getConnection();


if (isset($_POST['pay'])){
    $appointmentId = $_POST['appointmentId'];
    $customerId = $_POST['customerId'];
    $price = $_POST['price'];
    $cashAmount = $_POST['cashAmount'];

    $currentDateTime = new DateTime('now');
    $currentDate = $currentDateTime->format('Y-m-d');
    date_default_timezone_set("Asia/Colombo");
    $currentTime = date("H:i:s");

    $payment->addPaymentEntry($conn, $customerId, $appointmentId, $currentDate, $currentTime, $price);
    $paymentId = $payment->getPaymentID($conn,$appointmentId);
    $appointment->updatePaymentId($conn, $appointmentId, $paymentId);
    $userData=$user->getTemporaryUserData($conn, $customerId);
    if (isset($userData)){
        $phone=$appointment->getCustomerPhoneByAppointmentId($conn,$appointmentId);
        $customerEmail=$appointment->getCustomerEmailByAppointmentId($conn,$appointmentId);
        $username = $userData['username'];
        $password = $userData['password'];
        if(isset($customerEmail)){
            $mail->sendMail($customerEmail, "Your login credentials - Randox-Laboratory.com","Your login credentials,<br><br> <b>Username:</b> $username <br> <b>Password:</b> $password ");
        }
        if(isset($phone)){
            $sms->sendSMS($phone, "Your login credentials, Username: $username Password: $password ");
        }
        $user->deleteTemporarySaveUserData($conn, $customerId);
    }
    header('location: receptionist_Payment.php?msg=Payment Successful!');
    die();
}else{
    header('location: receptionist_Payment.php');
    die();
}

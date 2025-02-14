<?php

require_once 'vendor/autoload.php';

use Classes\Mail;

if (isset($_GET['email'])) {
    $mail = new Mail();
    $result = $mail->sendMail("{$_GET['email']}", "This is your Email and Password", "<html lang='en'><body><h3>Username: {$_GET['uname']}</h3><h3>Password: {$_GET['password']}</h3><h3>Appointment: {$_GET['appointmentID']}</h3></body></html>");
}



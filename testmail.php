<?php

require_once 'vendor/autoload.php';

use Classes\Mail;

$mail = new Mail();
$result = $mail->sendMail("251kalana@gmail.com", "hi this is a test", "<html lang='en'><body><h1>HI</h1></body></html>");

if ($result == 1) {
    echo "mail sent";
} else {
    echo $result;
}
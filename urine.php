<?php

require 'vendor/autoload.php';

use Classes\pdfGenerator;

$generator = new pdfGenerator();

$customer = "Kalana";
$appointmentNo = "845636911";
$data = array("urineR" => '3.87%', "urineP" => '4.56%', "urineG" => '45.5%', "urineGr" => '45.5%', "urineCo" =>'42.5%');

$generator->generatePDF($appointmentNo, $generator->generateUrineTemplate($customer, $data));

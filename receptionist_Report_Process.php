<?php

use Classes\Report;
use Classes\Appointment;
use Classes\DbConnector;
require_once 'vendor/autoload.php';

$db = new DbConnector();
$conn = $db->getConnection();

$report = new Report();
$appointment = new Appointment();

if(isset($_POST['search'])){
    $appointmentId = $_POST['id'];
    if ($appointment->isAppointmentIdTaken($conn,$appointmentId)){
        $fileName = $report->getReportFileNameByAppointmentID ($conn, $appointmentId);
        if ($fileName != null) {
            $filename = "storage/ReportStorage/$fileName";
            header("Content-type: application/pdf");
            header("Content-Length: " . filesize($filename));
            readfile($filename);
        }else{
            header('location: receptionist_Dashboard.php?msg=Sorry, Report is still not Available!');
            die();
        }
    }else{
        header('location: receptionist_Dashboard.php?msg=Appointment ID is Invalid!');
        die();
    }

}else{
    header('location: receptionist_Dashboard.php');
    die();
}

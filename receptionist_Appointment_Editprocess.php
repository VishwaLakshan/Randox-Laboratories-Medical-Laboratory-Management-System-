<?php

use Classes\Appointment;
use Classes\DbConnector;
use Classes\SMS;

require_once 'vendor/autoload.php';

$appointment = new Appointment();
$db = new DbConnector();
$sms = new SMS();

$conn = $db->getConnection();

if (isset($_POST['save'])) {
    $appointmentId = $_POST['id'];
    $date = $_POST['date'];
    $timeSlot = $_POST['timeslot'];
    $time=$appointment->getAppointmentTimeByAppointmentSlotId($timeSlot);
    $phone=$appointment->getCustomerPhoneByAppointmentId($conn,$appointmentId);
    $appointment->updateAppointment($conn, $appointmentId, $date, $timeSlot);
    $sms->sendSMS($phone,"Your Appointment ($appointmentId) Rescheduled Successfully! New Appointment Date: $date Time: $time - Randox-Laboratory");
    header("location: receptionist_Appointment.php?msg=Appointment Updated Successfully");
    die();

}elseif (isset($_POST['remove'])) {
    $appointmentId = $_POST['id'];
    $phone=$appointment->getCustomerPhoneByAppointmentId($conn,$appointmentId);
    $appointment->removeAppointment($appointmentId, $conn);

    $sms->sendSMS($phone,"Your Appointment ($appointmentId) canceled Successfully! - Randox-Laboratory");
    header("location: receptionist_Appointment.php?msg=Appointment Deleted Successfully");
    die();

}else{
    header("location: receptionist_Appointment.php");
    die();
}


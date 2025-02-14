<?php
include 'Common/receptionistValidate.php';

use Classes\Payment;
use Classes\DbConnector;
use Classes\Appointment;
use Classes\Customer;
use Classes\Report;

require_once 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RECEPTIONIST</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/receptionist_Dashboard_style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
<noscript>You need to enable JavaScript to run this app.</noscript>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<?php include 'Common/receptionistHeader.php' ?>

<br><br><br>

<?php
if (isset($_GET['msg'])) {
    ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3 border-warning">
        <div id="alert" class="toast" role="alert" aria-live="polite" aria-atomic="true" data-bs-autohide="false">
            <div class="toast-header bg-dark">
                <strong class="me-auto text-white">Randox-Laboratory.com</strong>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(document.getElementById('alert'));
        toastBootstrap.show();
    </script>
    <?php
}
?>

<div class="container">
    <div class="row g-4">
        <div class="col-md-6 p-3 d-flex justify-content-center align-items-center">
            <h1><b>Welcome to Randox-Laboratory!</b></h1>
        </div>
        <div class="col-md-6 p-0">
            <div class="container h-100">
                <div class="reports h-100 p-4">
                    <div class="reports-search text-center">
                        <h2 class="header" style="background-color: #004D61;">Search Reports</h2>
                        <form action="receptionist_Report_Process.php" method="post">
                            <div class="d-flex justify-content-center align-items-center my-3">
                                <input class="form-control me-2" type="text" placeholder="Search using Appointment ID" name="id"
                                       aria-label="Search">
                                <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<br><br><br>

<?php
    $db = new DbConnector();
    $conn = $db->getConnection();
    $payment = new Payment();
    $income = $payment->getMonthlyIncome($conn);
    $customer = new Customer();
    $customerCount = $customer->getCustomerCount($conn);
    $appointment = new Appointment();
    $todayAppointmentCount = $appointment->getTodayAppointmentCount($conn);
    $report = new Report();
    $reportCount = $report->getReportCount($conn);
?>

<div class="dashboard">
    <div class="header">
        <h1>Dashboard</h1>
    </div>
    <div class="content">
        <div class="card">
            <h2>Total Users:</h2>
            <h1><?php echo $customerCount; ?></h1>
        </div>
        <div class="card">
            <h2>Today Appointment Count:</h2>
            <h1><?php echo $todayAppointmentCount; ?></h1>
        </div>
        <div class="card">
            <h2>Handled Reports:</h2>
            <h1><?php echo $reportCount; ?></h1>
        </div>
        <div class="card">
            <h2>Income of the Month:</h2>
            <h1>Rs. <?php echo $income; ?></h1>
        </div>
    </div>
</div>

</body>

</html>

<?php
include 'Common/receptionistValidate.php';
require_once 'vendor/autoload.php';

use Classes\Appointment;
use Classes\DbConnector;
use Classes\Payment;

$appointmentNo = null;
$db = new DbConnector();
$appointment = new Appointment();
$payment = new Payment();
$conn = $db->getConnection();

if (isset($_GET['id'])){
    $appointmentNo = $_GET['id'];
    if (!$appointment->isAppointmentIdTaken($conn,$appointmentNo)) {
        header('location: receptionist_Payment.php?msg=Appointment ID invalid!');
        die();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PAYMENTS</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/receptionist_Payment_style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>
<noscript>You need to enable JavaScript to run this app.</noscript>
<script src="assets/js/bootstrap.bundle.min.js"></script>


<?php
include 'Common/receptionistHeader.php';
?>

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

<br><br>
<div class="container">
    <div class="payments">
        <div class="payment-entry-form">
            <h2 class="header">Payment</h2>

            <div class="my-5">
                <form method="get" action="">
                    <label for="AppointmentNumber" style="float: right;margin-right: 60px;">Please Enter Appointment No:</label><br><br>
                    <button class="btn btn-outline-success" title="Search Appointment Number for payment" type="submit" style="float: right; padding-left: 5px;">Search</button>
                    <input class="form-control me-2" id="AppointmentNumber" type="text" name="id" placeholder="" value="<?php echo $appointmentNo; ?>" aria-label="Search" style="float: right; width: auto;">
                </form>
            </div>
        <?php
        if ($appointmentNo != null) {
            if($payment->getPaymentID($conn,$appointmentNo) == null){
            $result = $appointment->getAppointmentInfoById($conn, $appointmentNo);
        ?>
            <table>
                <tr>
                    <th><h5>Customer Name:</h5></th>
                    <td><?php echo $result['customer_name']; ?></td>
                </tr>
                <tr>
                    <th><h5>Appointment Date:</h5></th>
                    <td><?php echo $result['date']; ?></td>
                </tr>
                <tr>
                    <th><h5>Appointment Time:</h5></th>
                    <td><?php echo $result['appointment_time']; ?></td>
                </tr>
                <tr>
                    <th><h5>Test:</h5></th>
                    <td><?php echo $result['test_name']; ?></td>
                </tr>
            </table>
                <?php
                include 'app/Config/priceList.php';
                $reportTypes = fetchReportTypesFromDatabase();
                $price = 0;

                foreach ($reportTypes as $reportTypeData) {
                    if ($reportTypeData['name'] == $result['test_name']) {
                        $price = $reportTypeData['price'];
                        break;
                    }
                }
                ?>
                <h3>Price: Rs. <?php echo $price; ?></h3>
            <form method="post" action="receptionist_Payment_Process.php">
                <input type="hidden" name="appointmentId" value="<?php echo $appointmentNo; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="customerId" value="<?php echo $result['customer_id']; ?>">
                <div class="form-group">
                    <label for="paymentAmount">Cash Amount:</label>
                    <input type="number" id="paymentAmount" name="cashAmount" placeholder="Enter payment amount">
                </div>
                <div class="fs-3">Balance: Rs.<span class="balance"></span> </div>
                <button type="submit" class="btn btn-primary" name="pay" style="float: right;">Submit Payment</button>
            </form>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Get references to the input field and the balance span
                    var paymentAmountInput = document.getElementById("paymentAmount");
                    var balanceSpan = document.querySelector(".balance");

                    // Get the initial price value from PHP
                    var initialPrice = <?php echo $price; ?>;

                    // Add an input event listener to the paymentAmount input
                    paymentAmountInput.addEventListener("input", function() {
                        // Get the entered payment amount
                        var paymentAmount = parseFloat(paymentAmountInput.value) || 0;

                        // Calculate the balance
                        var balance = paymentAmount - initialPrice;

                        // Update the balance span with the calculated balance
                        balanceSpan.textContent = balance.toFixed(2); // You can format it as needed

                        // You can also disable the submit button if the balance is negative
                        var submitButton = document.querySelector("button[type='submit']");
                        if (balance < 0) {
                            submitButton.disabled = true;
                        } else {
                            submitButton.disabled = false;
                        }
                    });
                });
            </script>
        <?php
            }else{
        ?>
                <div class="my-5 text-success text-center">
                    <h4>Payment had already completed.</h4>
                </div>
        <?php
            }
        }else{
        ?>
        <div class="my-5 text-danger text-center">
            <h5>Enter an appointment Number</h5>
        </div>
        <?php
        }
        ?>
        </div>
    </div>
</div>
</body>

</html>

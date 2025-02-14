<?php
session_start();
include 'app/Config/priceList.php';
$reportTypes = fetchReportTypesFromDatabase();

use Classes\{DbConnector, Payment, UserAccount, Appointment};

require_once 'vendor/autoload.php';

if (isset($_POST['pay'])) {
    if ($_POST['fname'] != '' && $_POST['bd'] != '' && $_POST['pnumber'] != '' && $_POST['appointDate'] != '' && $_POST['timeslot'] != '') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $nic = $_POST['nic'];
        $bd = $_POST['bd'];

        $pattern = '/^94\d{9}$/';

        if (preg_match($pattern, $_POST['pnumber'])) {
            $pnumber = $_POST['pnumber'];
        } else {
            header("location: user_Appointment.php?msg=Enter a Valid Phone Number");
            die();
        }

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['email'];
        } else {
            header("location: user_Appointment.php?msg=Enter a Valid Email");
            die();
        }

        $reporttype = $_POST['reporttype'];
        $date = $_POST['appointDate'];
        $timeslot = $_POST['timeslot'];
        $name = $fname . " " . $lname;

        $report = "";
        $amount = 0;

        foreach ($reportTypes as $reportTypeData) {
            if ($reportTypeData['id'] == $reporttype) {
                $report = $reportTypeData['name'];
                $amount = $reportTypeData['price'];
                break;
            }
        }

        if (empty($report)) {
            header("location: user_Appointment.php?msg=Some data are missing...");
            exit();
        }

        switch ($timeslot) {
            case 1:
                $timePeriod = "8.00 A.M - 10.00 A.M";
                break;
            case 2:
                $timePeriod = "10.00 A.M - 12.00 P.M";
                break;
            case 3:
                $timePeriod = "1.00 P.M - 3.00 P.M";
                break;
            default:
                header("location: user_Appointment.php?msg=Some data are missing...");
                exit();
        }

        $appointment = new Appointment();
        $account = new UserAccount();
        $db = new DbConnector();
        $payment = new Payment();
        $conn = $db->getConnection();

        $order_id = $appointment->getUniqueAppointmentID($conn);
        $hash = $payment->generateHash($order_id, $amount);
        $uname = $account->createUserName($fname);
        $password = $account->createPW();

        $options = [
            'cost' => 12,
        ];
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT, $options);

        if (!($account->addUser($conn, $name, $bd, $nic, $email, $pnumber, $uname, $hashedpassword))) {
            header("location: user_Appointment.php?msg=Something Wrong!");
            die();
        }

        $currentDateTime = new DateTime('now');
        $currentDate = $currentDateTime->format('Y-m-d');
        date_default_timezone_set("Asia/Colombo");
        $currentTime = date("H:i:s");

        $customerId = $account->getCustomerID($conn, $pnumber);
        if ($customerId != null) {
            if ($payment->getPaymentID($conn, $order_id) == null) {
                if (!$payment->addPaymentEntry($conn, $customerId, $order_id, $currentDate, $currentTime, $amount)) {
                    header("location: user_Appointment.php?msg=Something Wrong!");
                    die();
                }
            }
        }

        $customerId = $account->getCustomerID($conn, $pnumber);
        if ($customerId != null) {
            $paymentId = $payment->getPaymentID($conn, $order_id);
            if ($paymentId != null) {
                if (!$appointment->addAppointmentEntry($conn, $order_id, $paymentId, $customerId, $reporttype, $date, $timeslot)) {
                    header("location: user_Appointment.php?msg=Something Wrong!");
                    die();
                }
            }
        }

    } else {
        header("location: user_Appointment.php?msg=Some data are missing...");
        exit();
    }

?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/user_appointment_style.css">
        <title>Payment</title>
    </head>
    <body>
    <section class="appointment" id="appointment">

        <div class="row">

            <div class="image">
                <img src="assets/images/appointment/appointment-img.svg" alt="">
            </div>


            <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
                <div class="container">
                    <h3>Appointment Summery</h3>
                    <table>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Name:</b></td>
                            <td class="btn-left"><?php echo $name; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>N.I.C:</b></td>
                            <td class="btn-left"><?php echo $nic; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Birthday:</b></td>
                            <td class="btn-left"><?php echo $bd; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Phone Number:</b></td>
                            <td class="btn-left"><?php echo $pnumber; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Email:</b></td>
                            <td class="btn-left"><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Report Type:</b></td>
                            <td class="btn-left"><?php echo $report; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Appointment Date:</b></td>
                            <td class="btn-left"><?php echo $date; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Time Slot:</b></td>
                            <td class="btn-left"><?php echo $timePeriod; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Appointment ID:</b></td>
                            <td class="btn-left"><?php echo $order_id; ?></td>
                        </tr>
                        <tr>
                            <td class="btn-left mx-auto p-2"><b>Bill Value:</b></td>
                            <td class="btn-left">Rs.<?php echo number_format((float)$amount, 2, '.', ''); ?>/=</td>
                        </tr>
                    </table>
                </div>
                <input type="hidden" name="merchant_id" value="<?php echo $payment->getMerchantId(); ?>">
                <input type="hidden" name="return_url" value="<?php echo $payment->getReturnUrl(); ?>">
                <input type="hidden" name="cancel_url" value="<?php echo $payment->getCancelUrl(); ?>">
                <input type="hidden" name="notify_url" value="<?php echo $payment->getNotifyUrl(); ?>">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                <input type="hidden" name="items" value="<?php echo $report; ?>">
                <input type="hidden" name="currency" value="<?php echo $payment->getCurrency(); ?>">
                <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                <input type="hidden" name="first_name" value="<?php echo $fname; ?>">
                <input type="hidden" name="last_name" value="<?php echo $lname; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="phone" value="<?php echo $pnumber; ?>">
                <input type="hidden" name="address" value="">
                <input type="hidden" name="city" value="">
                <input type="hidden" name="country" value="Sri Lanka">
                <input type="hidden" name="hash" value="<?php echo $hash; ?>">
                <input type="submit" value="Pay Now" class="btn-red btn-proceed" onclick="sendEmail()">
            </form>
        </div>

    </section>

    <script>
        function sendEmail() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    // Handle the response from the server if needed
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "send_email.php?email=<?php echo $email; ?>&uname=<?php echo $uname; ?>&password=<?php echo $password; ?>&appointmentID=<?php echo $order_id; ?>", true);
            xhttp.send();
        }
    </script>
    </body>
    </html>
<?php
}
if (isset($_GET['order_id'])) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/user_appointment_style.css">
        <title>Payment Done!</title>
    </head>
    <body>
    <div>
        <form>
            <p>Your Payment is Processed! If Payment is completed successfully You will receive an SMS and Email.</p>
            <p>Appointment ID: <?php echo $_GET['order_id']; ?></p>
        </form>
    </div>
    </body>
    </html>

    <?php
}
?>
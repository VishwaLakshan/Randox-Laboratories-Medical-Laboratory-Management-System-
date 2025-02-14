<?php

use Classes\Appointment;
use Classes\DbConnector;

require_once 'vendor/autoload.php';

include 'Common/receptionistValidate.php';
include 'get_available_time_slots.php';
include 'app/Config/priceList.php';

if(isset($_GET['msg'])){
    $msg = htmlspecialchars($_GET['msg']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APPOINTMENTS</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="assets/css/receptionist_Appointment_style.css" type="text/css" rel="stylesheet">

</head>

<noscript>You need to enable JavaScript to run this app.</noscript>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<?php
include 'Common/receptionistHeader.php';
?>
<br><br>

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
    <div class="appointments">
        <h2 class="header bg-success">Appointments</h2>
        <br>
        <div class="input-group mb-3">
            <input type="text" id="searchInput" title="Search" class="form-control me-2" placeholder="Search by Appointment ID">
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="button" id="searchButton"><i class="bi bi-search"></i> Search</button>
            </div>
        </div>
        <button type="button" class="btn btn-success" title="New Appointment" data-bs-toggle="modal" data-bs-target="#newAppointmentModal">
            <i class="bi bi-plus-lg"></i> New Appointment
        </button>

        <!-- Modal -->
        <div class="modal fade" id="newAppointmentModal"  data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel">Add New Appointment</h1>
                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="appointmentForm" method="post" action="receptionist_Appointment_Process.php">
                    <div class="modal-body">
                        <label>Full Name:
                            <input type="text" name="fname" placeholder="First name" class="form-control mb-1" required>
                            <input type="text" name="lname" placeholder="Last name" class="form-control" required></label>
                        <label>N.I.C:
                            <input type="text" name="nic" placeholder="Your NIC" class="form-control" required></label>
                        <div class="my-1">
                        <label>Birthday:
                            <input type="date" name="bd" placeholder="Your Birthday" class="form-control" required></label>
                        <label>Phone No:
                            <input type="text" name="number" placeholder="[use 9471XXXXXXX format]" class="form-control" required></label>
                        </div>
                        <div class="my-1">
                        <label>Email:
                            <input type="email" name="email" placeholder="your email" class="form-control" required></label>
                        </div>
                        <hr>
                        <div class="my-1">
                        <label>Report:
                            <select name="reporttype" id="report" class="form-control" required>
                                <option value="default">Select Report Type</option>
                                <?php
                                $reportTypes = fetchReportTypesFromDatabase(); // Replace with your actual function
                                foreach ($reportTypes as $reportType) {
                                    echo "<option value='" . htmlspecialchars($reportType['id']) . "'>" . htmlspecialchars($reportType['name']) . "</option>";
                                }
                                ?>
                            </select>
                        </label>
                        </div>
                        <div class="my-1">
                        <label>Appointment Date:
                            <input type="date" name="appointDate" id="date_picker" placeholder="appointment date" class="form-control" required>
                        </label>
                        </div>
                        <div class="my-1">
                        <label>Appointment Time:
                            <select name="timeslot" id="time" class="form-control" required>
                                <option value="1">8.00 A.M - 10.00 A.M</option>
                                <option value="2">10.00 A.M - 12.00 P.M</option>
                                <option value="3">1.00 P.M - 3.00 P.M</option>
                            </select>
                        </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="skipPayment" class="btn btn-outline-success" >Skip Payment</button>
                        <button type="submit" name="proceedPayment" class="btn btn-success" >Goto Payment</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <button class="btn btn-outline-success" type="button" style="float: right; padding-left: 10px; margin-left: 2%;" onclick="applyFilter()">
            <i class="bi bi-filter-left"></i> Filter
        </button>
        <div class="form-group" style="float: right;">
            <select id="AppointmentMethod" name="filter" title="filter" onchange="applyFilter()">
                <option value="all">All</option>
                <option value="tomorrow">Tomorrow</option>
                <option value="today">Today</option>
                <option value="yesterday">Yesterday</option>
            </select>
        </div>

        <br><br><br>

        <div class="appointment-list table-responsive" style="max-height: 50vh;">
            <table class="table table-hover">
                <thead>
                <tr class="sticky-top">
                    <th>Date & Time</th>
                    <th>Patient Name</th>
                    <th>Appointment Type</th>
                    <th>Appointment ID</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody class="">
                <?php
                    $db = new DbConnector();
                    $conn = $db->getConnection();
                    $appointment = new Appointment();
                    $result = $appointment->getAppointmentData($conn);
                    if ($result == null) {
                ?>
                        <tr>
                            <td colspan="5">No Data Available!</td>
                        </tr>
                <?php
                    }else{
                        $currentDateTime = new DateTime('now');
                        $currentDate = $currentDateTime->format('Y-m-d');
                    foreach ($result as $row){
                        $appointmentDate = $row['date'];
                        if ($appointmentDate>=$currentDate){
                ?>
                <tr>
                    <td class="<?php if ($row['payment_id'] == 0){ echo "text-danger"; } ?>"><?php echo $row['date']." : ".getTimeSlotLabel($row['appointment_time']); ?></td>
                    <td class="<?php if ($row['payment_id'] == 0){ echo "text-danger"; } ?>"><?php echo $row['customer_name']; ?></td>
                    <td class="<?php if ($row['payment_id'] == 0){ echo "text-danger"; } ?>"><?php echo $row['test_name']; ?></td>
                    <td class="<?php if ($row['payment_id'] == 0){ echo "text-danger"; } ?>"><?php echo $row['appointment_id']; ?></td>
                    <td>
                        <button type="button" class="btn btn-outline-success" name="edit appointment" title="Edit Appointment" data-bs-toggle="modal" data-bs-target="#<?php echo $row['appointment_id']; ?>" style="margin-right: 10px;"><i class="bi bi-pen-fill"></i></button>
                    </td>
                </tr>
                        <div class="modal fade" id="<?php echo $row['appointment_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reschedule an Appointment</h1>
                                        <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="receptionist_Appointment_Editprocess.php">
                                    <div class="modal-body">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="id">Appointment ID:</label>
                                                <input name="id" id="id" class="form-control mb-4 disabled" type="text" value="<?php echo $row['appointment_id']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="customerName">Customer Name:</label>
                                                <input name="customerName" class="form-control mb-4 disabled" id="customerName" type="text" value="<?php echo $row['customer_name']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="test">Requested Test:</label>
                                                <input name="test" class="form-control mb-4 disabled" id="test" type="text" value="<?php echo $row['test_name']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="date">Appointment Date:</label>
                                                <input name="date" class="form-control mb-4" id="date" type="date" value="<?php echo $row['date']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Appointment Time:
                                                    <select name="timeslot" id="time" class="form-select form-control mb-4" required>
                                                        <option value="1" <?php if ($row['appointment_time'] == 1){ echo 'selected';} ?>>8.00 A.M - 10.00 A.M</option>
                                                        <option value="2" <?php if ($row['appointment_time'] == 2){ echo 'selected';} ?>>10.00 A.M - 12.00 P.M</option>
                                                        <option value="3" <?php if ($row['appointment_time'] == 3){ echo 'selected';} ?>>1.00 P.M - 3.00 P.M</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" name="remove" >REMOVE</button>
                                        <button type="submit" class="btn btn-success" name="save">Save Changes</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                        }}}
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const appointmentList = document.querySelector('.appointment-list table tbody');
    const allAppointments = document.querySelectorAll('.appointment-list table tbody tr');

    searchButton.addEventListener('click', function () {
        const searchTerm = searchInput.value.trim().toLowerCase();

        allAppointments.forEach(appointment => {
            const appointmentIdCell = appointment.querySelector('td:nth-child(4)');
            if (appointmentIdCell.textContent.trim().toLowerCase().includes(searchTerm)) {
                appointment.style.display = '';
            } else {
                appointment.style.display = 'none';
            }
        });
    });

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim().toLowerCase();

        allAppointments.forEach(appointment => {
            const appointmentIdCell = appointment.querySelector('td:nth-child(4)');
            if (appointmentIdCell.textContent.trim().toLowerCase().includes(searchTerm)) {
                appointment.style.display = '';
            } else {
                appointment.style.display = 'none';
            }
        });
    });

    function applyFilter() {
        const filterSelect = document.getElementById('AppointmentMethod');
        const selectedFilter = filterSelect.value;
        const appointmentList = document.querySelector('.appointment-list table tbody');
        const allAppointments = document.querySelectorAll('.appointment-list table tbody tr');
        const today = new Date();
        const currentDate = today.toISOString().split('T')[0];

        allAppointments.forEach(appointment => {
            const dateCell = appointment.querySelector('td:nth-child(1)').textContent.split(' : ')[0];

            if (selectedFilter === 'all') {
                appointment.style.display = '';
            } else if (selectedFilter === 'today' && dateCell === currentDate) {
                appointment.style.display = '';
            } else if (selectedFilter === 'tomorrow' && dateCell === addDays(currentDate, 1)) {
                appointment.style.display = '';
            } else if (selectedFilter === 'yesterday' && dateCell === addDays(currentDate, -1)) {
                appointment.style.display = '';
            } else {
                appointment.style.display = 'none';
            }
        });
    }

    function addDays(dateString, days) {
        const date = new Date(dateString);
        date.setDate(date.getDate() + days);
        return date.toISOString().split('T')[0];
    }

</script>

</body>

</html>

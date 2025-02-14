
<?php
include 'Common/labTecValidate.php';

use Classes\Labtechnician;
use Classes\DbConnector;
use Classes\pdfGenerator;

require_once 'vendor/autoload.php';

$labTec = new Labtechnician();
$db = new DbConnector();
$pdf = new pdfGenerator();

$conn = $db->getConnection();

$data = $labTec->getAllTemporyReportData($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/seniorLabTech_Dashboard_style.css">
    <title>Senior Lab Technician</title>
    <style>

    </style>

</head>

<body>
<header>
    <a href="#" class="brand"> <img src="assets/images/logo/logo.png" alt="Logo" width="250px" height="70px"></a>

    <div class="menu-btn"></div>
    <div class="navigation" style="height: 50px;">
        <div class="navigation-items" style="height: 50px;">
            <a href="seniorLabTech_Dashboard.php" class="nav-link"><b>Home</b></a>
            <a href="seniorLabTech_editProfile.php" class="nav-link"><b>Edit Profile</b></a>
            <a href="staff_Login.php"><button><b>Login</button></b></a>
        </div>
    </div>
</header><br><br><br>
<div class="modal-header">
    <h1><span style="font-size: 50px; color: orange;">C</span>onfirmation Details</h1>

</div>
<div class="container">
    <table>
        <thead>
        <tr>
            <th style=" width: 10%;">Report ID</th>
            <th style="width: 20%;">Patient Name</th>
            <th style="width: 20%;">Report Type</th>
            <th style="width: 30%;">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($data)){
            foreach ($data as $row){
                if ($row['report_type'] == 1) {
        ?>
                    <tr>
                        <td><?php echo $row['temp_id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['test_name']; ?></td>

                        <td>
                            <button class="edit-button btn btn-success" data-toggle="modal" data-target="#<?php echo $row['temp_id']; ?>">Edit Report</button>
                            <div class="modal" id="<?php echo $row['temp_id']; ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Red Blood Count Confirm Details</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for blood category, age, and name -->
                                            <form id="confirmForm">
                                                <div class="form-group">
                                                    <label for="Haemoglobin">Haemoglobin:</label>
                                                    <input type="text" class="form-control" id="Haemoglobin" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="whiteblood">White Blood Count x109/L:</label>
                                                    <input type="text" class="form-control" id="whiteblood" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Platelets">Platelets x109/L :</label>
                                                    <input type="text" class="form-control" id="Platelets" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mcv">MCV:</label>
                                                    <input type="text" class="form-control" id="mcv" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pcv">PCV:</label>
                                                    <input type="text" class="form-control" id="pcv" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rdw">RDW::</label>
                                                    <input type="text" class="form-control" id="rdw" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mch">MCH:</label>
                                                    <input type="text" class="form-control" id="mch" required>
                                                </div>
                                                <button type="button" class="btn btn-primary" onclick="submitConfirmForm()">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
        <?php
                }elseif ($row['report_type'] == 2){
                    $reportData = unserialize($row['data']);
        ?>
                    <tr>
                        <td><?php echo $row['temp_id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['test_name']; ?></td>

                        <td>
                            <button class="edit-button btn btn-success" data-toggle="modal" data-target="#<?php echo $row['temp_id']; ?>">Edit Report</button>
                            <div class="modal" id="<?php echo $row['temp_id']; ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Urine Report Confirm Details</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for blood category, age, and name -->
                                            <form id="confirmForm">
                                                <div class="form-group">
                                                    <label for="redblood">Red Blood Count:</label>
                                                    <input type="text" class="form-control" id="redblood" value="<?php echo $reportData['urineR']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="protein">Protein:</label>
                                                    <input type="text" class="form-control" id="protein" value="<?php echo $reportData['urineP']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="glucose">Glucose:</label>
                                                    <input type="text" class="form-control" id="glucose" value="<?php echo $reportData['urineG']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="specificgravity">Specific Gravity:</label>
                                                    <input type="text" class="form-control" id="specificgravity" value="<?php echo $reportData['urineGr']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Color:</label>
                                                    <input type="text" class="form-control" id="color" value="<?php echo $reportData['urineCo']; ?>" required>
                                                </div>

                                                <button type="button" class="btn btn-primary" onclick="submitConfirmForm()">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
        <?php
                }elseif ($row['report_type'] == 3){
        ?>
                    <tr>
                        <td><?php echo $row['temp_id']; ?></td>
                        <td><?php echo $row['customer_name']; ?></td>
                        <td><?php echo $row['test_name']; ?></td>

                        <td>
                            <button class="edit-button btn btn-success" data-toggle="modal" data-target="#<?php echo $row['temp_id']; ?>">Edit Report</button>
                            <div class="modal" id="<?php echo $row['temp_id']; ?>">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Lipid Profile Confirm Details</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form for blood category, age, and name -->
                                            <form id="confirmForm">
                                                <div class="form-group">
                                                    <label for="cholesteroll">Cholestrol-Total</label>
                                                    <input type="text" class="form-control" id="cholesteroll" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="trigleyecerides">Triglycerides</label>
                                                    <input type="text" class="form-control" id="trigleyecerides" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="hdl">Cholestrol - H.D.L:</label>
                                                    <input type="text" class="form-control" id="hdl" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ldl">Cholestrol - L.D.L:</label>
                                                    <input type="text" class="form-control" id="ldl" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="vldl">VLDL:</label>
                                                    <input type="text" class="form-control" id="vldl" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cho/hdl">Cho/HDL:</label>
                                                    <input type="text" class="form-control" id="cho/hdl" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ldl/hdl">LDL/HDL:</label>
                                                    <input type="text" class="form-control" id="ldl/hdl" required>
                                                </div>
                                                <button type="button" class="btn btn-primary" onclick="submitConfirmForm()">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
        <?php
                }
            }
        }
        ?>




        </tbody>
    </table>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    // Function to handle the submission of the confirm form
    function submitConfirmForm() {
        // Get values from the form
        var bloodCategory = document.getElementById("bloodCategory").value;
        var age = document.getElementById("age").value;
        var name = document.getElementById("name").value;

        // Display the values (you can customize this part based on your needs)
        alert("Confirmation Details:\nBlood Category: " + bloodCategory + "\nAge: " + age + "\nName: " + name);

        // Close the modal
        $('#confirmModal').modal('hide');
    }
</script>

</body>

</html>

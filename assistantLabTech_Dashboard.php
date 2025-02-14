<?php

include 'Common/labTecValidate.php';

use Classes\DbConnector;
use Classes\Appointment;
use Classes\Labtechnician;

require_once 'vendor/autoload.php';

$db = new DbConnector();
$conn = $db->getConnection();
$appointment = new Appointment();
$labTec = new Labtechnician();

if (isset($_POST['urineSave'])){
    $appointmentId = $_POST['appointmentId'];
    $testId = $_POST['testId'];
    $redblood = $_POST['RB'];
    $protein = $_POST['protein'];
    $glucose = $_POST['glucose'];
    $gravity = $_POST['specificgravity'];
    $color = $_POST['color'];

    $data = array("urineR" => $redblood, "urineP" => $protein, "urineG" => $glucose, "urineGr" => $gravity, "urineCo" =>$color);

    $labTec->temporaryAddReportData($conn,$appointmentId,$testId,$data);
}
if (isset($_POST['fullBloodSave'])){
    $appointmentId = $_POST['appointmentId'];
    $testId = $_POST['testId'];
    $haemoglobin = $_POST['haemoglobin'];
    $whitebloodcount = $_POST['whitebloodcount'];
    $platelets = $_POST['platelets'];
    $mcv = $_POST['mcv'];
    $mch = $_POST['mch'];
    $pcv = $_POST['pcv'];
    $rdw = $_POST['rdw'];

    $data = array("blood-haemoglobin" =>$haemoglobin, "wbc" =>$whitebloodcount , "platelets"=>$platelets, "mcv"=>$mcv, "pcv"=>$pcv,"rdw"=>$rdw,"mch"=>$mch);

    $labTec->temporaryAddReportData($conn,$appointmentId,$testId,$data);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab-Technician | Assistant</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/assistantLabTech_Dashboard_style.css">

</head>
<body>

<header>
    <a href="#" class="brand"> <img src="assets/images/logo/logo.png" alt="Logo" width="250px" height="70px"></a>

    <div class="menu-btn">

    </div>
    <div class="navigation">
        <div class="navigation-items">

            <a href="assistantLabTech_Dashboard.php" class="nav-link"><b>Home</b></a>
            <a href="assistantLabTech_editProfile.php" class="nav-link"><b>Edit Profile</b></a>

            <a href="staff_Login.php"><button><b>Login</button></b></a>
        </div>
    </div>
</header>
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="row text-center mt-col-3">
            <h1>Welcome !</h1>
        </div>

        <div class="col-md-8 mt-5" >
            <form action="" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="appointmentId" placeholder="Enter Appointment Number Here..">
                <div class="input-group-append ms-2">
                    <button class="btn btn-outline-secondary fw-bold" type="submit" name="search">Search</button>
                </div>
            </div>
            </form>
        </div>

        <?php
        if (isset($_POST['search'])) {
            $appointmentId = $_POST['appointmentId'];
            $appointmentData = $appointment->getAppointmentInfoById($conn, $appointmentId);
            if (is_array($appointmentData)){
            $name = $appointmentData['customer_name'];
            $testId = $appointment->getTestIdByAppointment($conn,$appointmentId);
            if ($testId == 2) {
        ?>
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-box">
                                <div id="urineTestForm" class="form-template" style="align-items: center;">
                                    <h2>Urine Test</h2>
                                    <form action="" method="POST">
                                        <input type="hidden" name="appointmentId" value="<?php echo $appointmentId; ?>"">
                                        <input type="hidden" name="testId" value="<?php echo $testId; ?>"">
                                    <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $name; ?>" required><br>
                                    <input type="text" name="RB" placeholder="Red Blood Count" class="form-control" required><br>
                                    <input type="text" name="protein" placeholder="Protein" class="form-control"><br>
                                    <input type="text" name="glucose" placeholder="Glucose" class="form-control"><br>
                                    <input type="text" name="specificgravity" placeholder="Specific Gravity" class="form-control"><br>
                                    <input type="text" name="color" placeholder="Color" class="form-control"><br>
                                    <button style="float:right;" class="btn btn-success" type="submit" name="urineSave">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }elseif ($testId == 1){
        ?>
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-box">
                                <div id="fullBloodTestForm" class="form-template" style="display: none;">
                                    <h2>Full Blood Test </h2><br>
                                     <form action="" method="POST">
                                         <input type="hidden" name="appointmentId" value="<?php echo $appointmentId; ?>"">
                                         <input type="hidden" name="testId" value="<?php echo $testId; ?>"">
                                    <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $name; ?>" required><br>
                                    <input type="text" name="haemoglobin" placeholder="Haemoglobin" class="form-control" required><br>
                                    <input type="text" name="whitebloodcount" placeholder="White Blood Count" class="form-control"><br>
                                    <input type="text" name="platelets" placeholder="Platelets" class="form-control"><br>
                                    <input type="text" name="mcv" placeholder="MCV" class="form-control"><br>
                                    <input type="text" name="pcv" placeholder="PCV" class="form-control"><br>
                                    <input type="text" name="rdw" placeholder="RDW" class="form-control"><br>
                                    <input type="text" name="mch" placeholder="MCH" class="form-control"><br>
                                    <button style="float:right;" class="btn btn-success" type="submit" name="fullBloodSave">Save</button>
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }elseif ($testId == 3) {
        ?>
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="form-box">
                                <div id="lipidTestForm" class="form-template" style="display: none;">
                                    <h2>Lipid profileTest</h2><br>
                                     <form action="" method="POST">
                                         <input type="hidden" name="appointmentId" value="<?php echo $appointmentId; ?>"">
                                         <input type="hidden" name="testId" value="<?php echo $testId; ?>"">
                                    <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $name; ?>" required><br>
                                    <input type="text" name="cholestrol-total " placeholder="Cholestrol-Total " class="form-control" required><br>
                                    <input type="text" name="triglycerides" placeholder="Triglycerides" class="form-control"><br>
                                    <input type="text" name="cholestrol - H.D.L " placeholder="Cholestrol - H.D.L " class="form-control"><br>
                                    <input type="text" name="cholestrol - L.D.L" placeholder="Cholestrol - L.D.L" class="form-control"><br>
                                    <input type="text" name="vldl" placeholder="VLDL" class="form-control"><br>
                                    <input type="text" name="cho/hdl" placeholder="Cho/HDl" class="form-control"><br>
                                    <input type="text" name="ldl/hdl" placeholder="LDL/HDL" class="form-control"><br>
                                    <button style="float:right;" class="btn btn-success" type="submit" name="save">Save</button>
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
            }
        }
        ?>

    </div>
</div>
</body>
</html>

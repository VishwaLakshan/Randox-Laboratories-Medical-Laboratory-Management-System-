<?php

include 'Common/labTecValidate.php';

use Classes\DbConnector;
use Classes\Labtechnician;

require_once 'vendor/autoload.php';

$labTec = new Labtechnician();
$db = new DbConnector();
$conn = $db->getConnection();

$username = $_SESSION['Labtec'];

$data = $labTec->getLabTecDataByUsername($conn, $username);

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
    } else {
        header("location: assistantLabTech_EditProfile.php?error=Enter a Correct Email");
        die();
    }
    $password = $_POST['newPW'];
    $confPassword = $_POST['confirmPW'];

    if ($name == "" || $email == "") {
        header("location: assistantLabTech_EditProfile.php?error=Fill Required Fields");
        die();
    } elseif (isset($name) && isset($email) && !isset($password)) {
        if ($labTec->editProfileWithoutPW($conn, $name, $email, $username)) {
            header("location: assistantLabTech_EditProfile.php?success=Details Update Success!");
            die();
        } else {
            header("location: assistantLabTech_EditProfile.php?error=Server Error!");
            die();
        }
    } elseif (isset($name) && isset($email) && isset($password) && isset($confPassword)) {
        if ($password == $confPassword) {
            $hashedPW = password_hash($password, PASSWORD_BCRYPT);
            if ($labTec->editProfileWithPW($conn, $name, $email, $hashedPW, $username)) {
                header("location: assistantLabTech_EditProfile.php?success=Details Update Success!");
                die();
            } else {
                header("location: assistantLabTech_EditProfile.php?error=Server Error!");
                die();
            }
        } else {
            header("location: assistantLabTech_EditProfile.php?error=Password Mismatch!");
            die();
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist | EditProfile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/assistantLabtec_editProfile_Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<?php
include 'Common/labTechHeader.php';
?>
<div class="body">
    <div class="image">
    <img src="assets/images/Profile/labtechnition_EditProfile.png" alt="img">
    </div>
    <section class="contain">
        <header>Lab Technician Edit Profile</header>
        <form action="" class="form" method="post" id="">

            <div class="input-box">
                <label for="name">Name</label>
                <input type="text" placeholder="Enter name" id="name" name="name" value="" required />
            </div>
            <div class="input-box">
                <label for="email_address">Email Address</label>
                <input type="text" placeholder="Enter email address" id="email_address" name="email" value=""  required />
            </div>

            <div class="input-box">
                <label for="newPW">Change Password</label>
                <input type="password" placeholder="New Password" id="newPW" name="newPW"/>
            </div>
            <div class="input-box">
                <input type="password" id="confirm" placeholder="Confirm Password" name="confirmPW"/>
            </div>
            <input name="edit" type="submit" value="EditProfile" id="edit">
        </form>
    </section>
</div>
</body>

</html>


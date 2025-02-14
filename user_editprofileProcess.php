<?php

use Classes\DbConnector;
use Classes\UserAccount;
require 'vendor/autoload.php';

session_start();

if(!isset($_SESSION['AUTH_TOKEN'])){
    header("location: user_login.php");
    die();
}

$authToken = $_SESSION['AUTH_TOKEN'];

$db = new DbConnector();
$conn = $db->getConnection();
$user = new UserAccount();

if(isset($_POST['edit'])){
    $name = $_POST['fname'].' '.$_POST['lname'];
    $bd = $_POST['bd'];
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
    } else {
        header("location: user_EditProfile.php?msg=Enter a Valid Email");
        die();
    }
    $pattern = '/^94\d{9}$/';

    if (preg_match($pattern, $_POST['phone'])) {
        $pnumber = $_POST['phone'];
    } else {
        header("location: user_EditProfile.php?msg=Enter a Valid Phone Number");
        die();
    }

    if(!empty($_POST['newPW']) && !empty($_POST['confirmPW'])){
        if($_POST['newPW'] == $_POST['confirmPW']){
            $password = $_POST['newPW'];
            $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

        }else{
            header("location: user_EditProfile.php?msg=Password Doesnt Match!");
            die();
        }
    }else{
        $hashedpassword = null;
    }
    if($user->updateUser($conn, $name, $bd, $email, $pnumber,$hashedpassword,$authToken)){
        header("location: user_EditProfile.php?msg=Data Saved Successful!");
    }else{
        header("location: user_EditProfile.php?msg=Something Wrong!");
    }
    die();
}
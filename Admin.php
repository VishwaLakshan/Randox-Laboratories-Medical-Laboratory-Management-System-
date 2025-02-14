<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/admin.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

<body>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<div class="container">
    <div class="admin">
        <div class="admin-entry-form">
            <h2 class="header">Staff Profile Setup</h2>
            <br>

            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" id="Name" placeholder="Ex:Dilshan Manahara">
            </div>
            <div class="form-group">
                <label for="nic">Employee NIC:</label>
                <input type="text" id="nic" placeholder="Ex:200012345V" name="nic" required>
            </div>
            <div class="form-group">
                <label for="email">Employee Email:</label>
                <input type="text" id="email" placeholder="Ex:abc@gmail.com" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone_no">Employee Phone:</label>
                <input type="text" id="contact" placeholder="Ex:077234563" name="contact" required>
            </div>
            <div class="form-group">
                <label for="Method">Employee Type:</label>
                <select id="Method">

                    <option value="receptionist">Receptionist</option>
                    <option value="slab">Senior Lab Technician</option>
                    <option value="alab">Assistant Lab Technician</option>
                </select>
            </div>
            <div class="form-group">
                <label for="user">Username:</label>
                <input type="text" id="user"  name="user" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>





            <button type="reset" class="btn btn-secondary" style="margin-left: 10px;float: right;">Reset Account</button>
            <button type="submit" class="btn btn-primary" style="float: right;">Create Account</button>


        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<!--
<div class="appointment-list">


    <table>
        <thead>
        <tr>
            <th>Date & Time</th>
            <th>Patient Name</th>
            <th>Appointment Type</th>
            <th>Appointment ID</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>2023-10-25 10:00 AM</td>
            <td>Kamal Liyanage</td>
            <td>Online</td>
            <td>001</td>
            <td>
                <button class="btn btn-success" style="margin-right: 10px;">EDIT</button>
                <button class="btn btn-danger">REMOVE</button>
            </td>
        </tr>
        <tr>
            <td>2023-10-25 11:30 AM</td>
            <td>Sanath Jayasuriya</td>
            <td>On Walk</td>
            <td>002</td>
            <td>
                <button class="btn btn-success" style="margin-right: 10px;">EDIT</button>
                <button class="btn btn-danger">REMOVE</button>
            </td>
        </tr>
        <tr>
            <td>2023-10-25 13:30 AM</td>
            <td>Amal Shantha</td>
            <td>On Walk</td>
            <td>003</td>
            <td> <button class="btn btn-success" style="margin-right: 10px;">EDIT</button>
                <button class="btn btn-danger">REMOVE</button>
            </td>
        </tr>
        <tr>
            <td>2023-10-25 14:30 AM</td>
            <td>Kamal Shantha</td>
            <td>On Call</td>
            <td>004</td>
            <td> <button class="btn btn-success" style="margin-right: 10px;">EDIT</button>
                <button class="btn btn-danger">REMOVE</button>
            </td>
        </tr>
        <tr>
            <td>2023-10-25 15:30 AM</td>
            <td>Angelo Mathews</td>
            <td>On Walk</td>
            <td>005</td>
            <td> <button class="btn btn-success" style="margin-right: 10px;">EDIT</button>
                <button class="btn btn-danger">REMOVE</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
 <div class="today-appointments">
<h3>Today's Appointments</h3>
<ul>
    <li>Patient 1 - 10:00 AM (Online)</li>
    <li>Patient 2 - 11:30 AM (On Walk)</li>

</ul>
</div>-
</div>
</div>-->
</body>

</html>

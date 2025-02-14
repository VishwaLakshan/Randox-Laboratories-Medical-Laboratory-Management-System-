<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>download for test result report</title>
        <link rel="stylesheet" href="assets/css/user_webNavbar_style.css">
        <link rel="stylesheet" href ="assets/css/user_downloadStyle.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    </head>
    <body style="background-color: #a7c8ff;">
    <?php include 'Common/webHeader.php'?>
        <div class="container text-center">
            <div class="row">
                <div class="col">

                    <!--                    <div class="container"style ="display: flex; justify-content: center; align-items: center; ">-->
                    <div class="card" style="width: 15rem;">
                        <div class="card-body">
                            <div style="display: flex; justify-content: center; align-items: center; ">
                                <img src="assets/images/Download/profile.png" class="img-fluid rounded-start" alt="" style="width: 50%; height: 50%;" >
                            </div>
                            <p class="card-text">Kamal Nawarathne</p><br>
                            <p class="card-text">Customer since: 2022/09/17</p><br>
                        </div>
                    </div>
                    <!--                        </div>-->
                </div>
                <div class="col">
                    <div class="right-container" style="background-color: #CAE9F5;">
                        <h1 class="gradienttext">Downloads</h1>
                        <table class="table table-success table-striped" style="background-color: #CAE9F5;">
                            <thead>
                            <th> ID</th>
                            <th> File name</th>
                            <th> size (in MB)</th>
                            <th> Downloads</th>
                            <th> Action</th>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>23456</td>
                                        <td>23456_urine.pdf</td>
                                        <td>10.8Kb</td>
                                        <td>0</td>
                                        <td>
                                            <a class="btn btn-primary" href="index.php?file_id=" role="button" >Download</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>28956</td>
                                        <td>28956_urine.pdf</td>
                                        <td>12.8Kb</td>
                                        <td>0</td>
                                        <td>
                                            <a class="btn btn-primary" href="index.php?file_id=" role="button" >Download</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>23456</td>
                                        <td>23456_urine.pdf</td>
                                        <td>10.8Kb</td>
                                        <td>0</td>
                                        <td>
                                            <a class="btn btn-primary" href="index.php?file_id=" role="button" >Download</a>
                                        </td>
                                    </tr>
                            </tbody>
                        </table> 
                    </div>  
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</html>

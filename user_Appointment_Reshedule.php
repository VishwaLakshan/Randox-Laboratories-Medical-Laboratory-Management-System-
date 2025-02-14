<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reschedule Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="assets/css/user_AppointmentReschedule.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/user_webNavbar_style.css">

</head>

<body class="">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<?php
include 'Common/webHeader.php'
?>

<div class="container">

    <h2 class="text-center">Reschedule Appointments</h2>

    <br>

    <div class="list align-items-center">

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Report type</th>
                <th scope="col">Appointed Time</th>
                <th scope="col">Appointed Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr scope="row">
                <td>Urine Report</td>
                <td>10.20 a.m</td>
                <td>20th November 2023</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                        Reshedule
                    </button>

                </td>
            </tr>
            <tr scope="row">
                <td>Urine Report</td>
                <td>11.20 a.m</td>
                <td>20th November 2023</td>

                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                        Reshedule
                    </button>

                </td>
            </tr>
            <tr scope="row">
                <td>Lipid Profile Test</td>
                <td>11.40 a.m</td>
                <td>20th November 2023</td>

                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                        Reshedule
                    </button>
                </td>
            </tr>

            <tr scope="row">
                <td>Full Blood Count Test</td>
                <td>12.20 p.m</td>
                <td>20th November 2023</td>

                <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                        Reshedule
                    </button>

                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel" style="text-align: center;color: darkred;"> Resheduling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="background">
                    <div class="reshedule-form">
                        <h2>Reshedule Your Appointment here</h2><br><br>
                        <form action="reshedule1.php" method="post">
                            <label for="name">Customer Name:</label>
                            <input type="text" name="name" id="name" required>

                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required>

                            <label for="report">Report type</label>
                            <input type="text" name="report" id="report" required>

                            <label  for="time">Appointed Time</label>
                            <input type="text" name="time" id="time" required>

                            <label for="appointed-date">Appointed Date :</label>
                            <input type="date" name="appointed-date" id="appointed-date" required>

                            <label for="resheduled-date">Reshedule Date:</label>
                            <input type="date" name="resheduled-date" id="resheduled-date" required><br>

                            <button type="submit">Reshedule Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>


    // Javascript code
    $(document).ready(function () {
        $('#replyForm').submit(function (e) {
            e.preventDefault();

            // hide
            $('#replyModal').modal('hide');
        });
    });
</script>

</body>
</html>

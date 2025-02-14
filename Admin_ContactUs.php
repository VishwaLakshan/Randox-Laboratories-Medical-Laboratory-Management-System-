<?php
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact-Us Response</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="assets/css/admin_contact.css" type="text/css" rel="stylesheet">

</head>

<body>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<h2 style="text-align: center; margin-left: 500px;" class="header">CONTACT US RESPONSE</h2>

<div class="container">

    <div class="list">

            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Contact Id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr scope="row">
                    <td>C001</td>
                    <td>iit20049@std.ac.lk</td>
                    <td>Hi how are you?</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                          Reply
                         </button>

                    </td>
                </tr>
                <tr scope="row">
                    <td>C002</td>
                    <td>manahara@gmail.com</td>
                    <td>I want appointment no</td>

                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                            Reply
                        </button>

                    </td>
                </tr>
                <tr scope="row">
                    <td>C003</td>
                    <td>Amal@gmail.com</td>
                    <td>How to On Walk appointment booking </td>

                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                            Reply
                        </button>
                    </td>
                </tr>

                <tr scope="row">
                    <td>C004</td>
                    <td>dmsi@gmail.com</td>
                    <td>Please give me password and username </td>

                    <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#replyModal">
                            Reply
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
                <h5 class="modal-title" id="replyModalLabel" style="text-align: center;color: darkred;"> Response Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Customer Message:</strong> Hi how are You? </p>

                <form id="replyForm">
                    <div class="form-group">
                        <label for="replyMessage">Your Message:</label>
                        <textarea class="form-control" id="replyMessage" name="replyMessage" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="float: right;">Send Reply</button>
                </form>
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

<?php
session_start();
include('checkemail.php');
require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="script.js"></script>
    <script>
        function showHint(str) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "gethint.php?q=" + str, true);
                xmlhttp.send();
            }
        }
  </script>


</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register_db.php" method="post">
            <div id="error_message"></div>
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);
                    ?>
                </div>
            <?php } ?>

            <!--------------------------------------------------------------------------------------------------------------------------------->


            <hr>

            <div class="mb-3">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Firstname</span>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" aria-describedby="firstname" onkeyup="showHint(this.value)">
                </div>
                <span id="txtHint"></span>
            </div>
            <div class="mb-3">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Lastname</span>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" aria-describedby="lastname">
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group flex-nowrap">
                    <span></span>
                    <span class="input-group-text" id="addon-wrapping">@Email</span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" aria-describedby="email">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Password</span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="ความยาวไม่เกิน 20 ตัวอักษร" aria-describedby="password" maxlength="20">
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Confirm Password</span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="ความยาวไม่เกิน 20 ตัวอักษร" aria-describedby="confirm_password" onblur="checkPasswordMatch()">
                </div>
            </div>
            <button type="submit" id="reg_btn" name="register" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Register</button>
        </form>
        <hr>
        <span class="text-muted">Already have an account?
            <a href="login_form.php" class="btn btn-dark">Login</a></p>
        </span>

    </div>

</body>

</html>
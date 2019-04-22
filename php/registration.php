<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link href="../css/temp.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script src="main.js"></script>

    <style>

    .email-taken{
        color: red;
    }

    .email-ok{
        color: green;
    }
    </style>
    <script>
        function getUserType() {
            jQuery.ajax({
                url: "getUserType.php",

                success: function (data) {
                    $("#userType").html(data);
                }
            });
        }

        function checkEmail() {
            jQuery.ajax({
                url: "checkEmail.php",
                data: 'email='+$("#email").val(),
                type: "POST",

                success: function (data) {
                    $("#checkEmail").html(data);
                },
                error:function(){
                    $("#checkEmail").html("error");
                }
            });
        }

        $(document).ready(function () {
            getUserType();
        });
    </script>
</head>

<body>
<?php
include_once 'navbar.php';
?>
    <div id="regForm">
        <form name="registration" id="registrationForm" action="registrationController.php" method="POST">
            First Name: <input type="text" name="fName"><br>
            Last Name: <input type="text" name="lName"><br>
            Email: <input type="text" name="email" id="email" onBlur="checkEmail()"><div id="checkEmail"></div><br>
            Password: <input type="password" name="pass"><br>
            Confirm Password: <input type="password" name="confirmPass"><br>
            Date of Birth: <input type="date" name="DoB"><br>
            Telephone: <input type="text" name="tel"><br>
            SSN: <input type="text" name="ssn"><br>
            <!-- Address: <input type="text" name="add"><br> -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION['userType']) && $_SESSION['userType'] == 1) {
    echo '<div id="userType"></div><br>';
}
?>
            <input type="submit" name="submit">
        </form>
    </div>

</body>

</html>
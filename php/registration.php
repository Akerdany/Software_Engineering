<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    <script type="text/javascript">
        // Form validation:
        var fcheck = false;
        var lcheck = false;
        var ncheck = false;
        var pcheck = false;
        var scheck = false
        var echeck = false;
        var dcheck = false;
        var pacheck = false;
        var ccheck = false;

        function checkFName() {
            document.getElementById("fNameError").innerHTML = null;
            var fName = document.getElementById("firstName");
            var letters = /^[A-Za-z]+$/;

            if (!fName.value.match(letters)) {
                error = "Please first name must be only alphabets";
                document.getElementById("fNameError").innerHTML = error;
                fName = null;
                return false;
            }

            if ((fName.value.length) < 2) {
                error = "First Name is too short";
                document.getElementById("fNameError").innerHTML = error;
                fName = null;
                return false;
            }
            fcheck = true;
            return true;
        }

        function checkLName() {
            document.getElementById("lNameError").innerHTML = null;
            var lName = document.getElementById("lastName");
            var letters = /^[A-Za-z]+$/;

            if (!lName.value.match(letters)) {
                error = "Please last name must be only alphabets";
                document.getElementById("lNameError").innerHTML = error;
                lName = null;
                return false;
            }

            if ((lName.value.length) < 2) {
                error = "Last Name is too short";
                document.getElementById("lNameError").innerHTML = error;
                lName = null;
                return false;
            }
            lcheck = true;
            return true;
        }

        function checkPhonenumber() {
            document.getElementById("phoneNumberError").innerHTML = null;
            var phoneNumber = document.getElementById("phoneNumber");
            var numbers = /^[+]?[0-9]+$/;

            if (!phoneNumber.value.match(numbers)) {
                error = "Please enter a correct phone number";
                document.getElementById("phoneNumberError").innerHTML = error;
                phoneNumber = null;
                return false;
            }

            if (!((phoneNumber.value.length) == 11)) {
                error = "Please enter a correct phone number";
                document.getElementById("phoneNumberError").innerHTML = error;
                phoneNumber = null;
                return false;
            }
            pcheck = true;
            return true;
        }

        function checkSSN() {
            document.getElementById("ssnError").innerHTML = null;
            var ssn = document.getElementById("ssn");
            var numbers = /^[+]?[0-9]+$/;

            if (!ssn.value.match(numbers)) {
                error = "Please enter a correct SSN";
                document.getElementById("ssnError").innerHTML = error;
                ssn = null;
                return false;
            }

            if (!((ssn.value.length) == 14)) {
                error = "Please enter a valid SSN";
                document.getElementById("ssnError").innerHTML = error;
                ssn = null;
                return false;
            }
            scheck = true
            return true;
        }

        function checkEmail() {
            document.getElementById("emailError").innerHTML = null;
            var ssn = document.getElementById("email");
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            if (!email.value.match(mailformat)) {
                error = "Please enter a valid email";
                document.getElementById("emailError").innerHTML = error;
                email = null;
                return false;
            }
            echeck = true;
            return true;
        }

        function checkDOB() {
            document.getElementById("dateError").innerHTML = null;
            var dateOfBirth = document.getElementById("dateOfBirth").value;
            var today = new Date();
            var myDOB = new Date(dateOfBirth);

            if (myDOB > today) {
                error = "Invalid date of birth";
                document.getElementById("dateError").innerHTML = error;
                dateOfBirth = null;
                today = null;
                myDOB = null;
                return false;
            }
            today.setFullYear((today.getFullYear() - 100));
            if (myDOB < today) {
                error = "Invalid date of birth";
                document.getElementById("dateError").innerHTML = error;
                dateOfBirth = null;
                today = null;
                myDOB = null;
                return false;
            }
            dcheck = true;
            return true;
        }

        function checkPassword() {
            document.getElementById("passwordError").innerHTML = null;
            var password = document.getElementById("password");

            if ((password.value.length) < 8) {
                error = "Password should be at least 8 characters";
                document.getElementById("passwordError").innerHTML = error;
                password = null;
                return false;
            }
            pacheck = true;
            return false;
        }

        function checkConfirmPassword() {
            document.getElementById("confirmPasswordError").innerHTML = null;
            var password = document.getElementById("password");
            var confirmPassword = document.getElementById("confirmPassword");

            if (confirmPassword.value != password.value) {
                error = "Please enter the password confirmation right";
                document.getElementById("confirmPasswordError").innerHTML = error;
                password = null;
                confirmPassword = null;
                return false;
            }
            ccheck = true;
            return true;
        }

        function registrationValidate() {

            if (fcheck && lcheck && pcheck && scheck && echeck && dcheck && pacheck && ccheck) {
                return true;
            } else {
                return false;
            }
        }

        function getUserType() {
            jQuery.ajax({
                url: "getUserType.php",

                success: function (data) {
                    $("#userType").html(data);
                }
            });
        }

        function checkEmailAvailabilty() {
            jQuery.ajax({
                url: "checkEmail.php",
                data: 'email=' + $("#email").val(),
                type: "POST",

                success: function (data) {
                    $("#checkEmail").html(data);
                },
                error: function () {
                    $("#checkEmail").html("error");
                }
            });
        }

        function myEmailCheckFunc() {
            checkEmail();
            checkEmailAvailabilty();
        }

        $(document).ready(function () {
            getUserType();
        });
    </script>
</head>

<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <!-- <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div> -->

                <div class="login-form">
                    <form name="registration" id="registrationForm" action="userController.php" method="POST"
                        autocomplete="off" onsubmit="return registrationValidate();">
                        <fieldset>
                            <legend>Personal Information</legend>

                            <div class="form-group">
                                <label>FIRST NAME</label>
                                <input type="text" class="form-control" placeholder="First Name" id="fName"
                                    name="firstName" onblur="checkFName()" required>
                                <p id="fNameError"></p>
                            </div>
                            <div class="form-group">
                                <label>LAST NAME</label>
                                <input type="text" class="form-control" placeholder="Last Name" id="lastName"
                                    name="lName" onblur="checkLName()" required>
                                <p id="lNameError"></p>
                            </div>
                            <div class="form-group">
                                <label>DATE OF BIRTH</label>
                                <input type="date" id="dateOfBirth" class="form-control" name="DoB" onblur="checkDOB()"
                                    required>
                                <p id="dateError">
                                </p>
                            </div>
                            <div class="form-group">
                                <label>PHONE NUMBER</label>
                                <input type="text" class="form-control" placeholder="Phone Number" id="phoneNumber"
                                    name="tel" onblur="checkPhonenumber()" required>
                                <p id="phoneNumberError">
                                </p>
                            </div>
                            <div class="form-group">
                                <label>SOCIAL SECURITY NUMBER</label>
                                <input type="text" class="form-control" placeholder="SSN" id="ssn" name="ssn"
                                    onblur="checkSSN()" required>
                                <p id="ssnError">
                                </p>
                            </div>
                        </fieldset>
                        <hr>
                        <fieldset>
                            <legend>Account Information</legend>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="text" class="form-control" placeholder="Email" id="email" name="email"
                                    onblur="myEmailCheckFunc()" required>
                                <div id="checkEmail"></div>
                                <p id="emailError">
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" id="password"
                                    name="pass" onkeyup="checkPassword()" required>
                                <p id="passwordError">
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" placeholder="Confirm Password"
                                    id="confirmPassword" name="confirmPass" onkeyup="checkConfirmPassword()" required>
                                <p id="confirmPasswordError">
                                </p>
                            </div>
                            <?php
if (!empty($_SESSION['userType']) && $_SESSION['userType'] == 1) {
    echo '<div id="userType"></div><br>';
} else {
    echo '<input type="hidden" name="userType" value="2"';
}
?>
                        </fieldset>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Agree the terms and policy
                            </label>
                        </div>
                        <input type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" value="Register"
                            name="register">

                        <!-- <div class="social-login-content">
                            <div class="social-button">
                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i
                                        class="ti-facebook"></i>Register with facebook</button>
                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i
                                        class="ti-twitter"></i>Register with twitter</button>
                            </div>
                        </div> -->
                        <div class="register-link m-t-15 text-center">
                            <p>Already have account ? <a href="logIn.php"> Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="../assets/js/main.js"></script>

</body>

</html>
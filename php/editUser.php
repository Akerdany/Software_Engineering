<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/temp.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>
<script type="text/javascript">
    $(document).ready(function () {
        $("#pass").click(function () {
            $("#editForm").hide();
            $("#passwordForm").fadeIn(1000);
        });
    });

    $(document).ready(function () {
        $("#delAccount").click(function () {
            $("#editForm").hide();
            $("#deleteForm").fadeIn(1000);
        });
    });

    $(document).ready(function () {
        $("#backP").click(function () {
            $("#passwordForm").fadeOut("fast");
            $("#editForm").fadeIn(3000);
        });
    });

    $(document).ready(function () {
        $("#backD").click(function () {
            $("#deleteForm").fadeOut("fast");
            $("#editForm").fadeIn(3000);
        });
    });

    var fName = false;
    var lName = false;
    var email = false;
    var telephone = false;

    function userEdit() {
        if (fName && lName && email && telephone) {
            return true;
        } else {
            return false;
        }
    }

    function checkFName() {
        document.getElementById("fNameError").innerHTML = null;
        var firstName = document.getElementById("firstName");
        var letters = /^[A-Za-z]+$/;

        if ((firstName.value.length) < 2) {
            error = "First Name is too short";
            document.getElementById("fNameError").innerHTML = error;
            firstName = null;
            return false;
        }

        if (!firstName.value.match(letters)) {
            error = "Please first name must be only alphabets";
            document.getElementById("fNameError").innerHTML = error;
            firstName = null;
            return false;
        }

        firstName = null;
        fName = true;
        return true;
    }

    function checkLName() {
        document.getElementById("lNameError").innerHTML = null;
        var lastName = document.getElementById("lastName");
        var letters = /^[A-Za-z]+$/;

        if ((lastName.value.length) < 2) {
            error = "Last Name is too short";
            document.getElementById("lNameError").innerHTML = error;
            lastName = null;
            return false;
        }

        if (!lastName.value.match(letters)) {
            error = "Please last name must be only alphabets";
            document.getElementById("lNameError").innerHTML = error;
            lastName = null;
            return false;
        }

        lastName = null;
        lName = true;
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
        telephone = true;
        return true;
    }

    function checkEmail() {
        document.getElementById("emailError").innerHTML = null;
        var emailAdd = document.getElementById("email");
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if (!emailAdd.value.match(mailformat)) {
            error = "Please enter a valid email";
            document.getElementById("emailError").innerHTML = error;
            emailAdd = null;
            return false;
        }
        email = true;
        return true;
    }

    function checkPassword() {
        document.getElementById("passError").innerHTML = null;
        var password = document.getElementById("newPass");

        if ((password.value.length) < 8) {
            error = "Password should be at least 8 characters";
            document.getElementById("passError").innerHTML = error;
            password = null;
            return false;
        }
        pacheck = true;
        return false;
    }

    function checkNewPass(){
        document.getElementById("confirmPassError").innerHTML = null;
        var password = document.getElementById("newPass");

        if ((password.value.length) < 8) {
            error = "Password should be at least 8 characters";
            document.getElementById("confirmPassError").innerHTML = error;
            password = null;
            return false;
        }
        npacheck = true;
        return false;
    }

    $(document).ready(function () {
            checkFName();
            checkLName();
            checkEmail();
            checkPhonenumber();
        });
</script>

<body>
    <?php
include_once 'navbar.php';
require_once 'factoryClass.php';

$editUser = factoryClass::create("Model", "User", null);

if ($editUser->userQuery($_SESSION['id'])) {
    echo '<div id="editForm">';
    echo '<form name="editUser" action="userController.php" method="POST" onsubmit="return userEdit();">';
    echo "First Name: <input type='text' id='firstName' name='fName' value='" . $editUser->firstName . "' onblur='checkFName()' required><br>";
    echo '<p id="fNameError"></p>';
    echo "Last Name: <input type='text' id='lastName' name='lName' value='" . $editUser->lastName . "' onblur='checkLName()' required><br>";
    echo '<p id="lNameError"></p>';
    echo "Email: <input type='text' id='email' name='email' value='" . $editUser->email . "' onblur='checkEmail()' required><br>";
    echo '<p id="emailError"></p>';
    echo "Telephone: <input type='text' id='phoneNumber' name='tel' value='" . $editUser->telephone . "' onblur='checkPhonenumber()' required><br>";
    echo '<p id="phoneNumberError"></p>';
    echo '<input type="submit" name="editUserbtn">';
    echo "</form>";
    echo "<button name='pass' id='pass'> Change Password  </button> <button name='delAccount' id='delAccount'> Delete Account </button> ";
    echo '</div>';

    echo '<div id="passwordForm" style="display:none;">';
    echo '<form name="changePassword" action="userController.php" method="POST">';
    echo "Old Password: <input type='password' name='oldPass' placeholder='Old Password' required><br>";
    echo "New Password: <input type='password' name='newPass' placeholder='New Password' minlength='8' required><br>";
    echo "Confirm New Password: <input type='password' name='confirmNewPass' placeholder='Confirm New Password' minlength='8' required><br>";
    echo '<input type="submit" name="passSubmit">';
    echo "</form>";
    echo "<button name='backP' id='backP'> Back </button>";
    echo '</div>';

    echo '<div id="deleteForm" style="display:none;">';
    echo '<form name="deleteAccount" action="userController.php" method="POST">';
    echo "Password: <input type='password' name='pass' placeholder='Enter Your Password' required><br>";
    echo "Confirm Password: <input type='password' name='confirmPass' placeholder='Confirm Your Password' required><br>";
    echo "<input type='submit' name='delSubmit'>";
    echo "</form>";
    echo "<button name='backD' id='backD'> Back </button>";
    echo '</div>';
} else {
    echo "We Might Have a Problem Right Now, Try Again Later";
}
include 'footer.html';
?>

</body>

</html>
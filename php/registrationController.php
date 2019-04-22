<?php

require "connection.php";
include "classes.php";
session_start();

if (isset($_POST['submit'])) {

    //Security:
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $pass  = $_POST['pass'];
    $DoB   = $_POST['DoB'];
    $tel   = $_POST['tel'];
    $ssn   = $_POST['ssn'];

    if (!empty($_SESSION['userType']) && $_SESSION['userType'] == 1) {
        $userType = $_POST['userType'];
    } else {
        $userType = 2;
    }

    if (!empty($fName) && !empty($lName) && !empty($email) && !empty($pass) && !empty($DoB) && !empty($tel) && !empty($ssn)) {

        if (filter_var($tel, FILTER_VALIDATE_INT) && filter_var($ssn, FILTER_VALIDATE_INT) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $user = New User();

            $fName           = $user->checkData($fName);
            $user->firstName = $fName;

            $lName          = $user->checkData($lName);
            $user->lastName = $lName;

            $email       = $user->checkData($email);
            $user->email = $email;

            $pass           = $user->checkData($pass);
            $pass           = $pass . $email;
            $pass           = password_hash($pass, PASSWORD_DEFAULT);
            $user->password = $pass;

            $user->dateOfBirth = $DoB;

            $tel             = $user->checkData($tel);
            $user->telephone = $tel;

            $ssn       = $user->checkData($ssn);
            $user->ssn = $ssn;

            $user->addressId = 3;

            $user->userTypeId = $userType;

            if ($user->insertUser($user)) {

                header("Location: ../php/index.php");
            } else {
                echo "An error occured, please try again later";
            }
        } else {
            echo "Please enter the data correctly";
        }
    } else {
        echo "Please fill all the fields";
    }
}
?>

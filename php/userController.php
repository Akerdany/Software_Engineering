<?php

require "connection.php";
require_once "factoryClass.php";
session_start();

if (isset($_POST['register'])) {

    $fName    = $_POST['fName'];
    $lName    = $_POST['lName'];
    $email    = $_POST['email'];
    $pass     = $_POST['pass'];
    $DoB      = $_POST['DoB'];
    $tel      = $_POST['tel'];
    $ssn      = $_POST['ssn'];
    $userType = $_POST['userType'];

    $user = factoryClass::create("Model", "User", null);

    //SQL Injection:
    $fName = $user->checkData($fName);
    $lName = $user->checkData($lName);
    $email = $user->checkData($email);
    $pass  = $user->checkData($pass);
    $tel   = $user->checkData($tel);
    $ssn   = $user->checkData($ssn);

    $user->firstName   = $fName;
    $user->lastName    = $lName;
    $user->email       = $email;
    $pass              = $pass . $email;
    $pass              = password_hash($pass, PASSWORD_DEFAULT);
    $user->password    = $pass;
    $user->dateOfBirth = $DoB;
    $user->telephone   = $tel;
    $user->ssn         = $ssn;
    $user->addressId   = 3;
    $user->userTypeId  = $userType;

    if ($user->insertUser($user)) {

        header("Location: ../php/index.php");
    } else {
        echo "An error occured, please try again later";
    }
}
?>
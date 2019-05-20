<?php

if (isset($_POST['submit'])) {
    // require_once "connection.php";
    require_once "factoryClass.php";
    include 'navbar.php';

    $email = $_POST['username'];
    $pass  = $_POST['password'];

    $tempUser = factoryClass::create("Model", "User", null);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //Security:
        $email = $tempUser->checkData($email);
        $pass  = $tempUser->checkData($pass);
        $pass  = $pass . $email;

        if ($tempUser->logIn($email, $pass)) {
            // $tempUser->userQuery($_SESSION['id']);
            // $tempUser->printo($_SESSION['id']);

            header("Location: ../php/index.php");
        } else {
            echo "Username or Password invalid";
            echo "<br>";
        }
    } else {
        echo "Username or Password invalid";
        echo "<br>";
    }
}

?>
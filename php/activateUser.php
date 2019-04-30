<?php
require_once 'factoryClass.php';

if (isset($_POST['activateUserButton'])) {
    $tempUser = factoryClass::create("Model", "User", null);
    $tempUser->activateUser($_POST['activateUserButton']);

    header('Location: displayUsers.php');
}

?>
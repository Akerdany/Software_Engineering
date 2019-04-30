<?php
require_once 'factoryClass.php';

if (isset($_POST['deleteUserButton'])) {
    $tempUser = factoryClass::create("Model", "User", null);

    $tempUser->deleteUser($_POST['deleteUserButton']);

    header('Location: displayUsers.php');
}

?>
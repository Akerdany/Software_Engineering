<?php
require_once 'factoryClass.php';

if (isset($_POST['editUserButton'])) {
    $userType = $_POST['userType'];
    $tempUser = factoryClass::create("Model", "User", null);

    $tempUser->editUserType($_POST['editUserButton'], $userType);

    header('Location: displayUsers.php');
}

?>
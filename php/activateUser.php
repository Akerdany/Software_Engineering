<?php
    require('classes.php');

    if (isset($_POST['activateUserButton'])){
        $tempUser = new User();
        $tempUser->activateUser($_POST['activateUserButton']);

        header('Location: displayUsers.php');
    }

?>
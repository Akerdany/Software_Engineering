<?php
    require('classes.php');

    if (isset($_POST['deleteUserButton'])){
        $tempUser = new User();
        $tempUser->deleteUser($_POST['deleteUserButton']);

        header('Location: displayUsers.php');
    }

?>
<?php
    require('classes.php');

    if (isset($_POST['editUserButton'])){
        $userType = $_POST['userType'];
        $tempUser = new User();
        $tempUser->editUserType($_POST['editUserButton'], $userType);

        header('Location: displayUsers.php');
    }

?>
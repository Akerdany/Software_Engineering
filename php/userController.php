<?php

require_once "factoryClass.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['register'])) {

    $fName    = $_POST['fName'];
    $lName    = $_POST['lName'];
    $email    = $_POST['email'];
    $pass     = $_POST['pass'];
    $DoB      = $_POST['DoB'];
    $tel      = $_POST['tel'];
    $ssn      = $_POST['ssn'];
    $userType = $_POST['userType'];
    $notifier = $_POST['notifier'];

    $user = factoryClass::create("Model", "User", null);

    //SQL Injection:
    $fName = $user->checkData($fName);
    $lName = $user->checkData($lName);
    $email = $user->checkData($email);
    $pass  = $user->checkData($pass);
    $tel   = $user->checkData($tel);
    $ssn   = $user->checkData($ssn);

    $user->userData(null, $fName, $lName, $email, password_hash($pass, PASSWORD_DEFAULT), $DoB, $tel, $ssn, 3, $userType, $notifier);

    if ($user->insertUser($user)) {

        header("Location: ../php/index.php");
    } else {
        echo "An error occured, please try again later";
    }
} elseif (isset($_POST['editUserbtn'])) {
    $editUser = factoryClass::create("Model", "User", null);
    $editUser->userQuery($_SESSION['id']);

    $fistName = $editUser->checkData($_POST['fName']);
    $lastName = $editUser->checkData($_POST['lName']);
    $email    = $editUser->checkData($_POST['email']);
    $tel      = $editUser->checkData($_POST['tel']);

    $editUser->firstName = $fistName;
    $editUser->lastName  = $lastName;
    $editUser->email     = $email;
    $editUser->telephone = $tel;

    if ($editUser->updateUser($editUser)) {
        header("Location: editUser.php");
    } else {
        header("Location: editUser.php");
    }
} else if (isset($_POST['passSubmit'])) {
    $editUser = factoryClass::create("Model", "User", null);
    $editUser->userQuery($_SESSION['id']);

    $oldPass        = $editUser->checkData($_POST['oldPass']);
    $newPass        = $editUser->checkData($_POST['newPass']);
    $confirmNewPass = $editUser->checkData($_POST['confirmNewPass']);

    $oldPass = $oldPass . $_SESSION['email'];

    if (password_verify($oldPass, $editUser->password)) {

        if ($newPass == $confirmNewPass) {

            $newPass = $newPass . $_SESSION['email'];
            $newPass = password_hash($newPass, PASSWORD_DEFAULT);

            $editUser->password = $newPass;

            if ($editUser->updateUser($editUser)) {
                header("Location: editUser.php");
            } else {
                header("Location: editUser.php");
                echo "new passwords does not match";
            }
        }
    } else {
        header("Location: editUser.php");
        echo "Old password is wrong";
    }
} else if (isset($_POST['delSubmit'])) {
    $editUser = factoryClass::create("Model", "User", null);
    $editUser->userQuery($_SESSION['id']);

    $pass        = $editUser->checkData($_POST['pass']);
    $confirmPass = $editUser->checkData($_POST['confirmPass']);

    if ($pass == $confirmPass) {

        $pass = $pass . $_SESSION['email'];

        if (password_verify($pass, $editUser->password)) {
            if ($editUser->deleteUser($_SESSION['id'])) {
                session_destroy();
                header("Location: index.php");
            } else {
                header("Location: editUser.php");
            }
        } else {
            header("Location: editUser.php");
            echo "Wrong Password";
        }
    } else {
        header("Location: editUser.php");
        echo "Passwords does not match";
    }
} elseif (isset($_POST['deleteUserButton'])) {
    $tempUser = factoryClass::create("Model", "User", null);

    $tempUser->deleteUser($_POST['deleteUserButton']);

    header('Location: displayUsers.php');
} elseif (isset($_POST['activateUserButton'])) {
    $tempUser = factoryClass::create("Model", "User", null);
    $tempUser->activateUser($_POST['activateUserButton']);

    header('Location: displayUsers.php');
} elseif (isset($_POST['editUserTypeButtonOnly'])) {
    $userType = $_POST['userType'];
    $tempUser = factoryClass::create("Model", "User", null);

    $tempUser->editUserType($_POST['editUserTypeButtonOnly'], $userType);

    header('Location: displayUsers.php');
} elseif (isset($_POST['newUsertype'])) {
    $tempUser = factoryClass::create("Model", "User", null);
    $userType = $tempUser->checkdata($_POST['name']);

    if ($tempUser->addUserType($userType)) {
        header('Location: userCRUD.php');
    } else {
        header('Location: userCRUD.php');
        echo "Error occured";
    }
}

class userController {
    public function __contruct() {

    }
    public function displayUsers() {
        $user = factoryClass::create("Model", "User", null);
        $data = $user->displayAllUsers();
        return $data;
    }
    public function getPermission($name) {
        $user = factoryClass::create("Model", "User", null);
        return $user->getPermission($name);
    }
    public function getUsertypeName($id) {
        $user = factoryClass::create("Model", "User", null);
        return $user->getUserTypeName($id);
    }
    public function getAllUserTypes() {
        $user = factoryClass::create("Model", "User", null);
        return $user->getUserTypes();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <?php
        session_start();
        require_once('connection.php');
        require('classes.php');

        $editUser = new User();

        if($editUser->userQuery($_SESSION['id'])){
            echo '<form name="editUser" action="" method="POST">';
            echo "First Name: <input type='text' name='fName' value='".$editUser->firstName."'><br>";
            echo "Last Name: <input type='text' name='lName' value='".$editUser->lastName."'><br>";
            echo "Email: <input type='text' name='email' value='".$editUser->email."'><br>";
            echo "Password: <input type='button' name='password'><br>";
            echo "Telephone: <input type='text' name='tel' value='".$editUser->telephone."'><br>";
            echo '<input type="submit" name="submit">';
            echo "</form>";
        }

        if(isset($_POST['submit'])){
            $editUser->firstName = $_POST['fName'];
            $editUser->lastName = $_POST['lName'];
            $editUser->email = $_POST['email'];
            $editUser->telephone = $_POST['tel'];

            if($editUser->updateUser($editUser)){
                mysqli_close($connection);
                header("Location: ../php/welcome.php");    
            }
        }

    ?>

</body>
</html>

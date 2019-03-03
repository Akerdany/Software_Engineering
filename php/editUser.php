<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
</head>
<script>
    $(document).ready(function(){
        $("#pass").click(function(){
            $("#editForm").hide();
            $("#passwordForm").fadeIn(1000);
        });
    });

    $(document).ready(function(){
        $("#delAccount").click(function(){
            $("#editForm").hide();
            $("#deleteForm").fadeIn(1000);
        });
    });

    $(document).ready(function(){
        $("#backP").click(function(){
            $("#passwordForm").fadeOut("fast");
            $("#editForm").fadeIn(3000);
        });
    });

    $(document).ready(function(){
        $("#backD").click(function(){
            $("#deleteForm").fadeOut("fast");
            $("#editForm").fadeIn(3000);
        });
    });
</script>

<body>
    <?php
        session_start();
        require_once('connection.php');
        require('classes.php');

        $editUser = new User();

        if($editUser->userQuery(5)){
            echo '<div id="editForm">';
            echo '<form name="editUser" action="" method="POST">';
            echo "First Name: <input type='text' name='fName' value='".$editUser->firstName."'><br>";
            echo "Last Name: <input type='text' name='lName' value='".$editUser->lastName."'><br>";
            echo "Email: <input type='text' name='email' value='".$editUser->email."'><br>";
            echo "Telephone: <input type='text' name='tel' value='".$editUser->telephone."'><br>";
            echo '<input type="submit" name="submit">';
            echo "</form>";  
            echo "<button name='pass' id='pass'> Change Password  </button> <button name='delAccount' id='delAccount'> Delete Account </button> ";  
            echo '</div>';   
            
            echo '<div id="passwordForm" style="display:none;';
            echo '<form name="changePassword" action="" method="POST">';
            echo "Old Password: <input type='password' name='oldPass' placeholder='Old Password'><br>";
            echo "New Password: <input type='password' name='newPass' placeholder='New Password'><br>";
            echo "Confirm New Password: <input type='password' name='confirmNewPass' placeholder='Confirm New Password'><br>";
            echo '<input type="submit" name="passSubmit">';
            echo "</form>";    
            echo "<button name='backP' id='backP'> Back </button>";  
            echo '</div>';   

            echo '<div id="deleteForm" style="display:none;';
            echo '<form name="deleteAccount" action="" method="POST">';
            echo "Password: <input type='password' name='pass' placeholder='Enter Your Password'><br>";
            echo "Confirm Password: <input type='password' name='confirmPass' placeholder='Confirm Your Password'><br>";
            echo "<input type='submit' name='delSubmit'>";
            echo "</form>";    
            echo "<button name='backD' id='backD'> Back </button>";  
            echo '</div>';   
        }
        else{
            echo "We Might Have a Problem Right Now, Try Again Later";
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

        else if(isset($_POST['passSubmit'])){
            $oldPass = $_POST['oldPass'];
            $newPass = $_POST['newPass'];
            $confirmNewPass = $_POST['confirmNewPass'];

            if($newPass == $confirmNewPass){
                $newPass = strip_tags(mysqli_real_escape_string($connection, trim($_POST['pass'])));
                $newPass = password_hash($pass, PASSWORD_DEFAULT);

                if(password_verify($oldPass, $editUser->password)){
                    $editUser->password = $newPass;

                    if($editUser->updateUser($editUser)){
                        mysqli_close($connection);
                        header("Location: ../php/welcome.php");    
                    }
                }
                else{
                    echo "Old password is wrong";
                }
            }
            else{
                echo "You have the enter the confirmation correctly";
            }
        }

        else if(isset($_POST['delSubmit'])){
            $pass = $_POST['pass'];
            $confirmPass = $_POST['confirmPass'];

            if($pass == $onfirmPass){
                $pass = strip_tags(mysqli_real_escape_string($connection, trim($_POST['pass'])));
                $pass = password_hash($pass, PASSWORD_DEFAULT);

                if(password_verify($pass, $editUser->password)){
                    $editUser->deleteUser($_SESSION['id']);
                }
                else{
                    echo "Wrong Password";
                }
            }
            else{
                echo "Wrong Password";
            }
        }
    ?>

</body>
</html>

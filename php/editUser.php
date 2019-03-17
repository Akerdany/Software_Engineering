<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/temp.css" rel="stylesheet" type="text/css">
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
        include('navbar.php');
        require('classes.php');

        $editUser = new User();

        if($editUser->userQuery($_SESSION['id'])){
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
            
            echo '<div id="passwordForm" style="display:none;">';
            echo '<form name="changePassword" action="" method="POST">';
            echo "Old Password: <input type='password' name='oldPass' placeholder='Old Password'><br>";
            echo "New Password: <input type='password' name='newPass' placeholder='New Password'><br>";
            echo "Confirm New Password: <input type='password' name='confirmNewPass' placeholder='Confirm New Password'><br>";
            echo '<input type="submit" name="passSubmit">';
            echo "</form>";    
            echo "<button name='backP' id='backP'> Back </button>";  
            echo '</div>';   

            echo '<div id="deleteForm" style="display:none;">';
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
            $fistName = $editUser->checkData($_POST['fName']);
            $editUser->firstName = $fistName;

            $lastName = $editUser->checkData($_POST['lName']);
            $editUser->lastName = $lastName;

            $email = $editUser->checkData($_POST['email']);
            $editUser->email = $email;

            $tel = $editUser->checkData($_POST['tel']);
            $editUser->telephone = $tel;

            if(!empty($fistName) && !empty($lastName) && !empty($email) && !empty($tel)){
                
                if (filter_var($tel, FILTER_VALIDATE_INT) && filter_var($email, FILTER_VALIDATE_EMAIL)){

                    if($editUser->updateUser($editUser)){
                
                        mysqli_close($connection);
                        header("Location: ../php/index.php");    
                    }
                }
                else{
                    echo "You must enter the data correctly";
                }
            }
            else{
                echo "You must fill all the fields";
            }
        }

        else if(isset($_POST['passSubmit'])){

            $oldPass = $editUser->checkData($_POST['oldPass']);
            $newPass = $editUser->checkData($_POST['newPass']);
            $confirmNewPass = $editUser->checkData($_POST['confirmNewPass']);

            if(!empty($oldPass) && !empty($newPass) && !empty($confirmNewPass)){

                if($newPass == $confirmNewPass){
                    
                    $newPass = $newPass.$_SESSION['email'];
                    $newPass = password_hash($newPass, PASSWORD_DEFAULT);

                    $oldPass = $oldPass.$_SESSION['email'];

                    if(password_verify($oldPass, $editUser->password)){

                        $editUser->password = $newPass;

                        if($editUser->updateUser($editUser)){

                            mysqli_close($connection);
                            session_destroy();
                            header("Location: ../php/index.php");    
                        }
                    }
                    else{
                        echo "Old password is wrong";
                    }
                }
                else{
                    echo "You have the enter the confirmation incorrect";
                }
            }
            else{
                echo "You must fill all the fields";
            }
        }

        else if(isset($_POST['delSubmit'])){

            $pass = $editUser->checkData($_POST['pass']);
            $confirmPass = $editUser->checkData($_POST['confirmPass']);

            if(!empty($pass) && !empty($confirmPass)){

                if($pass == $confirmPass){
                    $pass = strip_tags(mysqli_real_escape_string($connection, trim($_POST['pass'])));
                    $pass = $pass.$_SESSION['email'];
                    // $pass = password_hash($pass, PASSWORD_DEFAULT);
                    // echo $_SESSION['email'];
                    // echo "<br>";
                    // echo $pass;
                    // echo"<br>";
                    echo $editUser->password;

                    if(password_verify($pass, $editUser->password)){
                        $editUser->deleteUser($_SESSION['id']);

                        mysqli_close($connection);
                        header("Location: ../php/index.php");    
                    }
                    else{
                        echo "Wrong Password";
                    }
                }
                else{
                    echo "Wrong Password";
                }
            }else{
                echo "You must fill all the fields";

            }
        }
    ?>

</body>
</html>

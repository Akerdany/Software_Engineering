<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link href="../css/temp.css" rel="stylesheet" type="text/css">
    <script src="main.js"></script>
</head>
<body>

    <?php 
        require("connection.php");
        include("classes.php");
        session_start();

        if(isset($_POST['submit'])){

            //Security:
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $DoB = $_POST['DoB'];
            $tel = $_POST['tel'];
            $ssn = $_POST['ssn'];
            $userType = $_POST['userType'];
            
            if(!empty($fName) && !empty($lName) && !empty($email) && !empty($pass) && !empty($DoB) && !empty($tel) && !empty($ssn)){
                
                if (filter_var($tel, FILTER_VALIDATE_INT) && filter_var($ssn, FILTER_VALIDATE_INT) && filter_var($email, FILTER_VALIDATE_EMAIL)){
                    
                    $user = New User();
                    
                    $fName = $user->checkData($fName);
                    $user->firstName = $fName;
        
                    $lName = $user->checkData($lName);
                    $user->lastName = $lName;     
        
                    $email = $user->checkData($email);
                    $user->email = $email;
        
                    $pass = $user->checkData($pass);
                    $pass = $pass.$email;
                    $pass = password_hash($pass, PASSWORD_DEFAULT);
                    $user->password = $pass;
        
                    $user->dateOfBirth = $DoB;
        
                    $tel = $user->checkData($tel);
                    $user->telephone = $tel;
        
                    $ssn = $user->checkData($ssn);
                    $user->ssn = $ssn;
                    
                    $user->addressId = 3;
        
                    if($_SESSION['userType'] != 1){
                        $user->userTypeId = 2;
                    }
                    else{
                        $user->userTypeId = $userType;
                    }
        
                    if($user->insertUser($user)){
                        
                        mysqli_close($connection);
                        header("Location: ../php/index.php");    
                    }
                    else{
                        echo "An error occured, please try again later";
                    }
                }
                else{
                    echo "Please enter the data correctly";
                }
            }
            else{
                echo "Please fill all the fields";
            }
        }
    ?>
<div id = "regForm">
    <form name="registration" id = "registrationForm" action="" method="POST">
        First Name: <input type="text" name="fName"><br>
        Last Name: <input type="text" name="lName"><br>
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="pass"><br>
        Confirm Password: <input type="password" name="confirmPass"><br>
        Date of Birth: <input type="date" name="DoB"><br>
        Telephone: <input type="text" name="tel"><br>
        SSN: <input type="text" name="ssn"><br>
        <!-- Address: <input type="text" name="add"><br> -->
        <?php
            if(!empty($_SESSION['userType']) && $_SESSION['userType'] == 1){
                echo"User Type: ";
                echo"<select name='userType'>";
                    echo"<option value=0>Choose</option>";

                        $sql = mysqli_query($connection, "SELECT * FROM usertype");
                        while($row = mysqli_fetch_array($sql)){
                            $valueId = $row['id'];
                            $value = $row['userTypeName'];
                            echo '<option value="' . $valueId . '">' . $value . '</option>';
                        }
                echo"</select><br>";
            }
        ?>
        <input type="submit" name="submit">
    </form>
</div>
    
</body>
</html>
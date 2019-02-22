<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <script src="main.js"></script>
</head>
<body>

    <?php 
        require("connection.php");
        include("classes.php");

        if(isset($_POST['submit'])){
            echo"HELLOOOOOOOOOOOOOOOOOOOOOO";

            // //Security:
            // $fName = strip_tags(mysqli_real_escape_string($connection, trim($_POST['fName'])));
            // $lName = strip_tags(mysqli_real_escape_string($connection, trim($_POST['lName'])));
            // $email = strip_tags(mysqli_real_escape_string($connection, trim($_POST['email'])));
            // $pass = strip_tags(mysqli_real_escape_string($connection, trim($_POST['pass'])));
            // $pass = password_hash($pass, PASSWORD_DEFAULT);
            // $DoB = strip_tags(mysqli_real_escape_string($connection, trim($_POST['DoB'])));
            // $userType = strip_tags(mysqli_real_escape_string($connection, trim($_POST['userType'])));
            // $addressId = strip_tags(mysqli_real_escape_string($connection, trim($_POST['fName'])));
            // $fName = strip_tags(mysqli_real_escape_string($connection, trim($_POST['fName'])));
            // $fName = strip_tags(mysqli_real_escape_string($connection, trim($_POST['fName'])));
            // $fName = strip_tags(mysqli_real_escape_string($connection, trim($_POST['fName'])));

            // // $fName = $_POST['fName'];
            // // $lName = $_POST['lName'];
            // // $email = $_POST['email'];
            // // $pass = $_POST['pass'];
            // // $pass = password_hash($pass, PASSWORD_DEFAULT);

            // // $DoB = $_POST['DoB'];
            // // $userType = $_POST['userType'];

            // $user = New User();
            // $user->firstName =$_POST['fName'];
            // echo $_POST['fName'];
            // echo"<br>";
            // echo $user->firstName;
            // $user->lastName = $_POST['lName'];
            // $user->email = $_POST['email'];
            // $user->password = $pass;
            // $user->dateOfBirth = $_POST['DoB'];
            // $user->addressId = 3;
            // $user->userTypeId = $_POST['userType'];

            // $user->insertUser($user);

            // // if($fName != "" && $lName != "" && $email != "" && $pass != "" && $DoB != ""){
            // //     if($userType != 0){
            // //         $sql1 = "INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `userTypeId`)
            // //         VALUES (NULL,'".$fName."','".$lName."','".$email."','".$pass."','".$DoB."','".$userType."')";

            // //         if(mysqli_query($connection, $sql1)){
            // //             header("location: ../php/logIn.php");
            // //         }
            // //         else{
            // //             echo "SQL: ".$sql1;
            // //             echo"<br>";
            // //             printf("Errormessage: %s\n", mysqli_error($connection));
            // //         }
            // //     }
            // //     else{
            // //         echo"Please choose a user type";
            // //         echo "<br>";
            // //     }
            // // }
            // // else{
            // //     echo "Please fill all the data<br>";
            // //     echo "<br>";
            // // }
        }
    ?>

    <form name="registration" action="" method="POST">
        First Name: <input type="text" name="fName"><br>
        Last Name: <input type="text" name="lName"><br>
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="pass"><br>
        Confirm Password: <input type="password" name="confirmPass"><br>
        Date of Birth: <input type="date" name="DoB"><br>
        Telephone: <input type="number" name="tel"><br>
        SSN: <input type="number" name="ssn"><br>
        Address: <input type="text" name="add"><br>
        <?php
            if($_SESSION['userType'] = 1){
                echo"User Type: ";
                echo"<select name='userType'>";
                    echo"<option value=0>Choose</option>";

                        $sql = mysqli_query($connection, "SELECT * FROM userType");
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
    
</body>
</html>
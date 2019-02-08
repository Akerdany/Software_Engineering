<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

    <?php 
        require("Connection.php");

        if(isset($_POST['submit'])){
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $DoB = $_POST['DoB'];
            $userType = $_POST['userType'];

            if($fName != "" && $lName != "" && $email != "" && $pass != "" && $DoB != ""){
                if($userType != 0){
                    $sql1 = "INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `date`, `userTypeId`)
                    VALUES (NULL,'".$fName."','".$lName."','".$email."','".$pass."','".$DoB."','".$userType."')";

                    if(mysqli_query($conn, $sql1)){
                        header("location:logIn.php");
                    }
                    else{
                        echo "SQL: ".$sql1;
                        echo"<br>";
                        printf("Errormessage: %s\n", mysqli_error($conn));
                    }
                }
                else{
                    echo"Please choose a user type";
                    echo "<br>";
                }
            }
            else{
                echo "Please fill all the data<br>";
                echo "<br>";
            }
        }
    ?>

    <form name="registration" action="" method="POST">
        First Name: <input type="text" name="fName"><br>
        Last Name: <input type="text" name="lName"><br>
        Email: <input type="text" name="email"><br>
        Password: <input type="password" name="pass"><br>
        Date of Birth: <input type="date" name="DoB"><br>
        User Type: 
        <select name="userType">
            <option value="0">Choose</option>

            <?php
                $sql = mysqli_query($conn, "SELECT * FROM userType");
                while($row = mysqli_fetch_array($sql)){
                    $valueId = $row['id'];
                    $value = $row['userTypeName'];
                    echo '<option value="' . $valueId . '">' . $value . '</option>';
                }
            ?>
        </select><br>
        <input type="submit" name="submit">
    </form>
    
</body>
</html>
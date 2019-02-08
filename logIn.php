<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LogIn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php
        require("Connection.php");
        session_start();

        $sql="SELECT * FROM user WHERE email='".$_POST['username']."' AND password='".$_POST['password']."'";
        $result = mysqli_query($conn, $sql);      

        if(mysqli_num_rows($result) > 0 && $row = mysqli_fetch_array($result)){
            $_SESSION['fName']=$row['firstName'];
            $_SESSION['userType']=$row['userTypeId'];

            header("Location: Welcome.php");
        }
        else{
            echo "Username or Password invalid";
            echo "<br>";
        }
    ?>

    <form name="logIn" action="" method="POST">
        <input type="text" name="username" placeholder="Username"><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <a href='registration.php'>Register</a><br><br>
            
        <input type="submit" name="submit">
    </form>    
</body>
</html>
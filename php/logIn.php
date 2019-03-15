<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LogIn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="../css/temp.css">    
    <script src="main.js"></script>
</head>
<body>
    <?php        
        if(isset($_POST['submit'])){
            require("connection.php");
            require("classes.php");

            $email = $_POST['username'];
            $pass = $_POST['password'];
    
            $tempUser = new User();

            //Security:
            $email = $tempUser->checkData($email);
            $pass = $tempUser->checkData($pass);
            $pass = $pass.$email;
          
            if($tempUser->logIn($email, $pass)){
                // $tempUser->userQuery($_SESSION['id']);
                // $tempUser->printo($_SESSION['id']);

                mysqli_close($connection);
                header("Location: ../php/index.php");    
            }
            else{
                echo "Username or Password invalid";
                echo "<br>";
            }    
            mysqli_close($connection);
        }
    ?>
<div id = "logInForm">
  <form name="logInForm" action="" method="POST">
    <input id="username" name="username" type="text" class="input" placeholder="Username"><br>
    <input id="password" name="password" type="password" class="input" placeholder="Password" data-type="password"><br><br>
    <a href="registration.php">Log In</a><br>
    <input type="submit" class="button" value="Sign In" name="submit">
  </form>  
</div>  

</body>
</html>
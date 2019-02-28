<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LogIn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
    <link rel="stylesheet" href="../css/logInStyle.css">    
    <script src="main.js"></script>
</head>
<body>
    <?php        
        if(isset($_POST['submit'])){
            require("connection.php");
            require("classes.php");

            $email = $_POST['username'];
            $pass = $_POST['password'];
    
            //Security:
            $email = strip_tags(mysqli_real_escape_string($connection, trim($email)));
            $pass = strip_tags(mysqli_real_escape_string($connection, trim($pass)));
    
            $tempUser = new User();
            $pass=$pass.$email;
            if($tempUser->logIn($email, $pass)){
                $tempUser->userQuery($_SESSION['id']);
                // $tempUser->print($_SESSION['id']);

                mysqli_close($connection);
                header("Location: ../php/welcome.php");    
            }
            else{
                echo "Username or Password invalid";
                echo "<br>";
            }    
            mysqli_close($connection);
        }
    ?>
  <div class="login-wrap">
  <div class="login-html">
    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
    <div class="login-form">
      <form class="sign-in-htm" action="" method="POST">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="username" name="username" type="text" class="input">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="password" name="password" type="password" class="input" data-type="password">
        </div>
        <!-- <div class="group">
          <input id="check" type="checkbox" class="check" checked>
          <label for="check"><span class="icon"></span> Keep me Signed in</label>
        </div> -->
        <div class="group">
          <input type="submit" class="button" value="Sign In" name="submit">
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <a href="#forgot">Forgot Password?</a>
        </div>
      </form>
      
      <form class="sign-up-htm" action="registration.php" method="POST">
        <div class="group">
          <label for="user" class="label">Username</label>
          <input id="username" name="username" type="text" class="input">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="password" name="password" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="pass" class="label">Confirm Password</label>
          <input id="pass" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <input type="submit" class="button" value="Sign Up">
        </div>
        <div class="hr"></div>
        <div class="foot-lnk">
          <label for="tab-1">Already Member?</a>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
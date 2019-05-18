<!DOCTYPE html>
<html>
<?php include_once 'navbar.php'; ?>
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
<div id = "logInForm">
  <form name="logInForm" action="logInController.php" method="POST">
    <input id="username" name="username" type="text" class="input" placeholder="Username"><br>
    <input id="password" name="password" type="password" class="input" placeholder="Password" data-type="password"><br><br>
    <input type="submit"  value="Sign In" name="submit">
    <button><a href="registration.php"> Register </a><br>  </button>
  </form>
</div>

</body>
</html>
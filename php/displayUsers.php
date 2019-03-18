<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/temp.css" rel="stylesheet" type="text/css">
    <script src="main.js"></script>
</head>
<body>
    <?php
        require("connection.php");
        require("classes.php");
        include("navbar.php");
        
        $myUser = new User();

        $myUser->displayAllUsers();
    ?>
</body>
</html>
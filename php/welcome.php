<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    Welcome 

    <?php 
        require("connection.php");
        require("classes.php");
        session_start();

        $tempUser = new User();
        $tempUser->print($_SESSION['id']);
        // echo $_SESSION['fName'];
        // echo "<br><br>";
        // echo "Here are your pages:";
        // echo "<br>";

        $userType = $_SESSION['userType'];
        $sql = "SELECT * FROM pages WHERE userTypeId = $userType";
        $result = mysqli_query($connection, $sql);      

        while($row = mysqli_fetch_array($result)){
            echo '<a href="'.$row['link'].'">' . $row['pageName'] . '</a><br />';            
        }
        
        mysqli_close($connection);

    ?>    

</body>
</html>
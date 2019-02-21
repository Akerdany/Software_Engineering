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
        session_start();
        // echo $_SESSION['fName'];
        echo "<br><br>";
        echo "Here are your pages:";
        echo "<br>";

        $userType = $_SESSION['userType'];
        $sql="SELECT * FROM pages WHERE userTypeId = $userType";
        $result = mysqli_query($connection, $sql);      

        while($row = mysqli_fetch_array($result)){
            echo '<a href="'.$row['link'].'">' . $row['pageName'] . '</a><br />';            
        }
      
        $sql="SELECT id,address,parent_id FROM address Where id= ".$_SESSION['addressID'];
        $result = mysqli_query($connection, $sql);  
       
        if ($row = mysqli_fetch_array($result))
           $id=$row['id'];
        
     
        getaddress($id,$connection);
        function getaddress($id,$connection)
        {
            if ($id>1)
            {
                $sql="SELECT id,address,parent_id FROM address Where id=".$id;
                  $result = mysqli_query($connection, $sql);  
                  if($row = mysqli_fetch_array($result))
                  {
                      $id=$row['parent_id'];
                      echo "<p> ".$row['address']."</p>";
                  } 
              getaddress($id,$connection);
            }
        }
    ?>    

</body>
</html>
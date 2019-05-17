<?php
require_once('connection.php');
echo '<link rel="stylesheet"href="../css/style5.css">';
    echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
    if (isset($_POST['submit'])) { 
      $code=$_POST['code'];
      $value=$_POST['value'];
      $ED=$_POST['Edate'];
      $DB     = DbConnection::getInstance();
      $date = date("Y-m-d");
      $sql = 'SELECT * FROM `promo` Where code="'.$code.'" And end <=" '.$ED.'"';
      $r=mysqli_query($DB->getdbconnect(), $sql);
      
      if($r->num_rows==0)
      {
        $sql1='INSERT INTO `promo` (`code`, `value`, `start`, `end`) VALUES ( "'.$code.'", "'.$value.'", CURRENT_TIMESTAMP, "'.$ED.'") ';
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
          }
        $_SESSION['promoc']=$code;
        $_SESSION['promov']=$value;
        mysqli_query($DB->getdbconnect(), $sql1);
        echo '<button style="margin:auto;" onclick="location.href='."'notification.php'".'">Notyify users</button>';
        echo "     ";
        echo '<button  onclick="location.href='."'Index.php'".'">home</button>';
      }else {
        echo "<script> alert(' Code already exist in this time interval'); </script>";
        echo("<script>window.location = 'addpromo.php';</script>");
      }
    } 
    

?>

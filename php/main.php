<?php

       //insert in mySQL here 
      $test= $_POST['output'];
      // var_dump($test);
      $token = strtok( $test, "/");
      $time=array();
      while ($token !== false)
      {
      array_push($time,$token);

      $token = strtok("/");
      } 
      
      
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
       echo $_SESSION["STime"] = $time[0];
      $z = end($time);
      
      if($z[3]=='3')
      {
        $x = $z[0].$z[1].$z[2];
        $x =(int)$x + 1;
        $y = (String)$x.".00";
        echo $_SESSION["ETime"] = $y;
      }
      else
      {
        $x = (float)end($time)+0.30;
        $y = (String)$x."0";
        echo $_SESSION["ETime"] = $y;
      }
       
        
      
      echo $_SESSION["NH"] = count($time)/2;
      header('Location: checkout.php');
  ?>
  

<?php

       //insert in mySQL here 
      $test= $_POST['output'];
      var_dump($test);
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
      echo $_SESSION["ETime"] = end($time);
      echo $_SESSION["NH"] = count($time)/2;
      header('Location: checkout.php');
  ?>
  

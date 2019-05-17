<?php
require_once("connection.php");
require_once("Isubject.php");
$DB = DbConnection::getInstance();
$gun = new subject();
      $conn=$DB->getdbconnect();
      $Q="SELECT user_notifiers.details d,notifiers.id t FROM `user_notifiers`LEFT JOIN `notifiers` ON notifiers.id=user_notifiers.notifiersID   ";
         $result = mysqli_query( $conn, $Q);
        $array=array();
         while($row = mysqli_fetch_array($result))
         {
            // echo $row['t'];
            //  echo $row['d'];
             if($row['t']==1){
                $n = new SMS($row['d']);
                $gun->AddObserver($n);

             }
             elseif($row['t']==2){
                $n = new Email($row['d']);
                $gun->AddObserver($n);
             }

         }
    $gun->fireobserver();
    echo("<script>window.location = 'index.php';</script>");
?>
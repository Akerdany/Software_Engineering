<?php
require_once("connection.php");
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
if(isset($_GET["c"]) )
    {
        $data = $_GET["c"];
      
       $DB = DbConnection::getInstance();
       $conn=$DB->getdbconnect();
       $Q="SELECT reservation.id,court.courtNumber,user.firstName,user.lastName,reservationdetails.startTime,reservationdetails.endTime,reservationdetails.status,reservationdetails.date
       FROM reservation 
       INNER JOIN user ON reservation.userId=user.id 
       INNER JOIN court ON reservation.courtId=court.id 
       INNER JOIN reservationdetails ON reservation.reservationDetailsId=reservationdetails.id
       WHERE reservation.code='".$data."'";
       $result = mysqli_query( $conn, $Q);
      
       if($row = mysqli_fetch_array($result)){
        echo '<table class = "displaytables">';
        echo '<tr>'
            .'<th>Court Number</th>'
            .'<th>Date</th>'
            .'<th>Reserver First name</th>'
            .'<th>Reserver Last name</th>'
            .'<th>Start time</th>'
            .'<th>End time</th>'
            .'<th>status </th>'
            .'</tr>';           
           echo '<tr>'
               .'<td>'.$row['courtNumber'].'</td>'
               .'<td>'.$row['date'].'</td>'
               .'<td>'.$row['firstName'].'</td>'
               .'<td>'.$row['lastName'].'</td>'
               .'<td>'.$row['startTime'].'</td>'
               .'<td>'.$row['endTime'].'</td>';
              if($row['status']){
                  echo '<td> Aprroved </td>';
              }else{
                echo '<td> appending </td>';
              }
           
               echo '</tr>';
       
       echo '</table>';
       }
    }
?>
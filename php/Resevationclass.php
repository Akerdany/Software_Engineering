<?php
require_once("connection.php");
 class reservation 
 {
    public $ID;
    public $UID;
    public $courtID;
    public $RDID;
    public $date;
    public $startTime;
    public $endTime;
    public $type;
    public $cost;
    public $supervisorId;
    function __construct($ID)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
         $Q = "SELECT * FROM reservation WHERE id='".$ID."'";
         $r=mysqli_query($conn,$Q);
         if($row=mysqli_fetch_array($r))
         {
             $this->UID=$row['userId'];
             $this->courtID=$row['courtId'];
             $this->RDID=$row['reservationDetailsId'];
         }
         $Q2 = "SELECT * FROM reservationdetails WHERE id='".$ID."'";
         $r=mysqli_query($conn,$Q2);
         if($row=mysqli_fetch_array($r))
         {
             $this->date=$row['date'];
             $this->startTime=$row['startTime'];
             $this->endTime=$row['endTime'];
             $this->supervisorId=$row['supervisorId'];
             $this->type=$row['type'];
             $this->cost=$row['cost'];
         }
    }
     public static function insertReserve($R)
     {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();

         $Q1 = "INSERT INTO `reservationdetails` (`date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`) VALUES ( '$R->date', '$R->startTime', '$R->endTime', '$R->supervisorId', '$R->type', '$R->cost') ";
         mysqli_query($conn, $Q1);
         $Q2 ="SELECT MAX(id) from reservationdetails";
         $r=mysqli_query($conn,$Q2);
         if($row=mysqli_fetch_assoc($r))
         { 
            $this->RDID=$row;
         }
         $Q3="INSERT INTO `reservation` ( `userId`, `courtId`, `reservationDetailsId`) VALUES ( '$R->UID', '$R->courtID', '$R->RDID')";
         mysqli_query($conn, $Q3);
     }
     public static function updateR()
     {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();

        $Q1="UPDATE `users` SET `userId` = '$this->UID', `courtId` = '$this->courtID', `reservationDetailsId` = '$this->RDID' WHERE `ID` = '$this->ID' ";
        $Q2="UPDATE `reservationdetails` SET `date`=$this->date,`startTime`=$this->startTime,`endTime`=$this->endTime,`supervisorId`=$this->supervisorId,`type`=$this->type,`cost`=$this->cost WHERE `ID` = '$this->RDID'";
     }
     public static function Delete()
     {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="DELETE FROM `reservation` WHERE `ID` = '$this->ID'";
        $Q1="DELETE FROM `reservationdetails` WHERE `ID` = '$this->RDID'";
        mysqli_query($conn,$Q);
        mysqli_query($conn,$Q1);
     }
     public static function Display()
     {
      $DB = new DbConnection();
      $conn=$DB->getdbconnect();
      $Q="SELECT court.courtNumber,user.firstName,user.lastName,reservationdetails.startTime,reservationdetails.endTime,reservationdetails.supervisorId 
      FROM reservation 
      INNER JOIN user ON reservation.userId=user.id 
      INNER JOIN court ON reservation.courtId=court.id 
      INNER JOIN reservationdetails ON reservation.reservationDetailsId=reservationdetails.id";
         $result = mysqli_query( $conn, $Q);
         echo '<table id = "courtstable">';
         echo '<tr>'
             .'<th>Court Number</th>'
             .'<th>Reserver First name</th>'
             .'<th>Reserver Last name</th>'
             .'<th>Start time</th>'
             .'<th>End time</th>'
             .'<th>Suppervisor first name</th>'
             .'<th>Suppervisor Lastname name</th>'
             .'</tr>';
         while($row = mysqli_fetch_array($result))
         {
            $Q1="SELECT `firstName`,`lastName` FROM `user` WHERE `id`=".$row['supervisorId'];
            $result1 = mysqli_query( $conn, $Q1);
            $row1 = mysqli_fetch_array($result1);
            echo '<tr>'
                .'<td>'.$row['courtNumber'].'</td>'
                .'<td>'.$row['firstName'].'</td>'
                .'<td>'.$row['lastName'].'</td>'
                .'<td>'.$row['startTime'].'</td>'
                .'<td>'.$row['endTime'].'</td>'
                .'<td>'.$row1['firstName'].'</td>'
                .'<td>'.$row1['lastName'].'</td>'
                .'<td> <form action = "editCourt.php" method = "POST">'
                .'<button type = "submit" name = "editButton" value = "1">Edit</button>'
                .'</form>'
                .'</tr>';
        }
        echo '</table>';
     }
 }

?>
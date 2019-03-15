<?php
require("connection.php");
class paymentMethod 
{
    public $pmID;
    public $optionsID;
    public $optionsName;
    public $optionsType;
    public $methodName;
    public $isDeleted;
    public $creationDate;
    public $Type;
    public $priority;
    public $soID;
    function __construct($pmID)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
         $Q = "SELECT * FROM paymentmethod WHERE isDeleted=0 AND id='".$pmID."'";
         $r=mysqli_query($conn,$Q);
         if($row=mysqli_fetch_array($r))
         {
             $this->methodName=$row['name'];
             $this->isDeleted=$row['isDeleted'];
             $this->creationDate=$row['creationDate'];
         }
    }
    static function displayMethods()
    {
        $DB = new DbConnection();
        $conn = $DB->getdbconnect();
        $sql2='SELECT pm.name,pm.id FROM paymentmethod pm Where  isDeleted=0';
        $result2 = mysqli_query($conn, $sql2);

        echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
        echo '<table class = "displaytables">';
        echo '<tr>'
            .'<th>Payment Method</th>'
            .'<th>Constraints</th>'
            .'<th>Edit Method</th>'
            .'<th>Delete Method</th>'
            .'</tr>';
            while ($row2 = mysqli_fetch_array($result2))
            {
                echo '<tr>'
                .'<td>'.$row2['name'].'</td>';
                echo '<td>';
                $sql = 'SELECT pm.id pmID, pm.name pmname, pm.isDeleted, pm.creationDate,o.name constraints,so.priority FROM paymentmethod pm 
                INNER JOIN selectedoptions so ON so.paymentid=pm.id
                Inner JOin options o ON o.id=so.optionId
                Where  isDeleted=0 AND so.paymentid='.$row2['id'].'
                ORDER BY so.priority ASC';
                $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result))    
                    echo $row['constraints'].'<br>';
        
            echo '</td>'
                    .'<td> <form action = "editPm.php" method = "POST">'
                    .'<button type = "submit" name = "editButton" value = "'.$row2['id'].'">Edit</button>'
                    .'</form>'
                    .'<td> <form action = "deletePm.php" method = "POST">'
                    .'<button class = "button" type = "submit" name = "deleteButton" value = "'.$row2['id'].'">Delete </button>'
                    .'</form>'
                    .'</tr>';
           }
            echo '</table>';
            echo '<a href= "addpm.php" class="button">Add Method</a><br><br>';
    }
    public static function addMethod($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $sql="INSERT INTO `paymentmethod` (`name`, `isDeleted`) VALUES ('$E->methodName', 0)";
        mysqli_query($conn,$sql);
       header('Location: displaypm.php');
    }
    public static function insertSelectedoptions($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $sql="INSERT INTO `selectedoptions` ( `paymentId`, `optionId`, `priority`) VALUES ( '$E->pmID', '$E->optionsID', '$E->priority')";
        mysqli_query($conn,$sql);
        header('Location: displaypm.php');
    }
    // public static function insertoptions($E)
    // {
    //     $DB = new DbConnection();
    //     $conn=$DB->getdbconnect();
    // //     $sql2="Select Max(id) id from paymentmethod";
    // //     $result2=mysqli_query($conn,$sql2);
    // //  if($row=mysqli_fetch_assoc($result2))
    // //  { 
    // //     $E->pmID=$row['id'];
    // //  }
    //     $sql="INSERT INTO `options` ( `name`, `type`) VALUES ( '$E->optionsName', '$E->optionsType')";
    //     mysqli_query($conn,$sql);
    // }
    public static function updateMethod($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="UPDATE `paymentmethod` SET `name` = '$E->methodName' WHERE `id` = '$E->pmID' ";
        mysqli_query($conn,$Q);
    }
    public static function updateSelectedoptions($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $sql="UPDATE `selectedoptions` SET `priority` = '$E->priority' WHERE  `paymentId` = '$E->pmID' AND `id` = '$E->soID'";
        mysqli_query($conn,$sql);
    }
    public static function DeleteSelectedoptions($E)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="DELETE FROM `selectedoptions` WHERE `paymentId` = '$E->pmID' AND `id` = '$E->soID' ";
        mysqli_query($conn,$Q);
        header('Location: displayPm.php');
    }
    public static function DeleteMethod($paymentID)
    {
        $DB = new DbConnection();
        $conn=$DB->getdbconnect();
        $Q="DELETE FROM `selectedoptions` WHERE `paymentId` = '$paymentID'";
        mysqli_query($conn,$Q);
        $Q="UPDATE `paymentmethod`  SET `isDeleted`= 1 WHERE `id` = '$paymentID'";
        mysqli_query($conn,$Q);
        header('Location: displaypm.php');
    }
}
?>
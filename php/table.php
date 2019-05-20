<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
 
  <style>
  ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
  }

  li {
    float: left;
  }

  li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }

  li a:hover {
    background-color: #111;
  }
    #feedback { font-size: 1.4em; }
    #selectable .ui-selecting { background: #FECA40; }
    #selectable .ui-selected { background: #F39814; color: white; }
    #selectable .selected { background: #4CAF50; color: white; }
    #selectable {  list-style-type: none; margin: 0; padding: 0;width:200% }
    #selectable ol{background-color:red}
    #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; }
    /* #test {background-color:black;height:100px;} */
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    var output="";
    $( function() {
      $( "#selectable" ).selectable({
        stop: function() {
          // var result = $( "#select-result" ).empty();
          if($( ".ui-selected", this ).hasClass('selected')){
            $(".ui-selected", this).removeClass('ui-selected');
            var index = "Sorry";
            result.append( ( index ) );
          }else{
          $( ".ui-selected", this ).each(function() {
            var index = this.id;
            output +=( index+"/" );
            // result.append( output );
            document.getElementById("output").value=output;
          });
          
    output="";
    //window.location.replace("checkout.php");
        }
      
      }
      });
      
    } );
    


    </script>
</head>
<body>
<?php
echo '<link href="../css/temp.css" rel="stylesheet" type="text/css">';
require_once('CourtModel.php');
$court = CourtModel::getCourtDetails($_POST["court"]);


$date=$_POST["Rdate"];
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$_SESSION["date"] = $date;
$_SESSION["cID"] = $court->id;
echo"<H2>Court number  ".$court->courtNumber." On ".$date."</H2>";
?>
<div id="test">
<ol id="selectable">
 <?php
  $court=$_POST["court"];
  $date=$_POST["Rdate"];
  
 $conn = mysqli_connect("localhost", "root", "", "Database");
 $sql = "SELECT `startTime`, `endTime` FROM `reservationdetails` WHERE `date`='$date' AND reservationdetails.id IN(SELECT reservation.reservationDetailsId FROM reservation WHERE reservation.courtId='$court') ";
 $sql1="SELECT `hours`,`state` FROM `time`";
 $result1 = mysqli_query($conn, $sql);
 $result = mysqli_query($conn, $sql1);
 $sql2="SELECT `courtNumber`,`price` FROM `court` WHERE id='$court' ";
 $result2 = mysqli_query($conn, $sql2);
 $out=mysqli_fetch_assoc($result2);
 $CN = $out["courtNumber"];
 $P = $out["price"];
 $_SESSION["CN"] = $CN;
 $_SESSION["price"] =  $P;
 $_SESSION["cID"] = $court;
 $row;
 $H=array() ;
 $state=array();
 
 while($hours = mysqli_fetch_array($result)){
   
   array_push($H,$hours["hours"]);
   array_push($state,$hours["state"]);
 }

while($row = mysqli_fetch_array($result1))
{
  

    $start=$row['startTime']; 
    $end=$row['endTime'];
    $SI=array_search($start,$H);
    if(isset($SI)){
      $state[$SI]=1;
      while($H[$SI]!=$end){
        $state[$SI]=1;
        $SI++;
      }
    }

}
for ($i=0; $i < count($H) ; $i++) { 
  if ($state[$i]==1)
  echo ' <li id="'.$H[$i].'" class="ui-widget-content selected">'.$H[$i].'</li>';
  else
  echo ' <li id="'.$H[$i].'" class="ui-widget-content ">'.$H[$i].'</li>';
}
  
 ?>
 </ol>
 <form action = "main.php" onsubmit="return validateForm()"  method = "POST">
 <input style="Display:none" value="" type="text" id="output" name="output">
  <input type = "submit" name = "submit" value = "Next">
 </form>
 </div>
 <script>
 function validateForm() {
  var x =  document.getElementById("output").value;
  if (x == "") {
    alert("No time selected");
    return false;
  }
} 
 </script>




 

 
 
</body>
</html>
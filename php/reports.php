
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>
  <body>
  <form method="POST" action="">
  <select name="chart">
  <option name="barChart" value="barChart"> Bar Chart </option>
  <option name="pieChart" value="pieChart"> Pie Chart </option>
  <input name="month" id="monthID" type="month"> 
  <input type=submit value=ok>
  </select>
  
  </form>
    <div id="top_x_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>


<?php
require_once('connection.php');
require_once('Ireports.php');

abstract class absreports
{
    public $reports;
    public $js;
    function  __construct()
    {
        $this->reports = new Ireports();
        $this->js="";
    }
    function display()
    {
        $this->reports->displayReports($this->js);
    }
    function setDisplayMethod($obj)
    {
        $this->reports=$obj;
    }
}
class countUserType extends absreports
{
    function  __construct()
    {
      $this->js=$this->getusersCount();
      $this->reports= new displayBarCharts();
    }
    function getusersCount()
    {
      $DB = new DbConnection();
      $sql = 'SELECT COUNT(user.id) ucount, ut.userTypeName utname from user
      Inner join usertype ut ON ut.id = user.userTypeId
      WHERE isDeleted = 0
      GROUP BY user.userTypeId
      ORDER BY  ucount asc';
      $result = mysqli_query($DB->getdbconnect(), $sql);
      $str='';
      while ($row= mysqli_fetch_assoc($result))
      {
        $str.=', ["'.$row['utname'].'", '.$row['ucount'].'] ';
      } 
    
    $js='
      var data = new google.visualization.arrayToDataTable([
      ["User Type", "Number of Users"] '.$str. '
    ]); ';
return $js;
    }
}
class countReservation extends absreports
{
    function  __construct()
    {
      $this->js=$this->getReservationCount();
      $this->reports= new displayBarCharts();
    }
    function getReservationCount()
    {
      $DB = DbConnection::getInstance();
      $month="";
      $month= substr($_POST['month'],5);
      $year= substr($_POST['month'],0,4);
      $Days=cal_days_in_month(CAL_GREGORIAN,$month,$year);
      $str='';
      for ($i=1;$i<$Days+1;$i++)
      {
        $sql = 'SELECT COUNT(id) FROM `reservationdetails` Where Day(date)='.$i.' AND Month(date)='.$month;
        $result = mysqli_query($DB->getdbconnect(), $sql);
       
        while ($row= mysqli_fetch_assoc($result))
        {
          $str.=', ["Day '.$i.'", '.$row['COUNT(id)'].'] ';
        } 
      }
      $monthName=date('F', strtotime("2012-$month-01"));
    $js='
      var data = new google.visualization.arrayToDataTable([
      ["'.$monthName.' '.$year.'", "Number of Reservations"] '.$str. '
    ]); ';
return $js;
    }
}

$CountUsers=new countUserType();
$CountUsers->display();
if(isset($_POST['chart']))
{
  if($_POST['chart']=="pieChart")
  {
    $CountUsers->setDisplayMethod(new displayPieCharts());
    $CountUsers->display();

    if (isset($_POST['month']) && !empty($_POST['month']))
    {
      $CountReservations=new countReservation();
      $CountReservations->setDisplayMethod(new displayPieCharts());
      $CountReservations->display();
    }
    
  }
  else if ($_POST['chart']=="barChart")
  {
    $CountUsers->setDisplayMethod(new displayBarCharts());
    $CountUsers->display();
    if (isset($_POST['month']) && !empty($_POST['month']))
    {
      $CountReservations=new countReservation();
      $CountReservations->setDisplayMethod(new displayBarCharts());
      $CountReservations->display();
    }
  }
}
?>
<!-- function getCourtReservations($courtId){
    $DB = new DbConnection();
    $sql = 'SELECT COUNT(id) from reservation where courtId = "'.$courtId.'" AND isDeleted = 0';
    $result = mysqli_query($DB->getdbconnect(), $sql);
    $reservationCount = mysqli_fetch_array($result);

    return $reservationCount['COUNT(id)'];
}

function getTotalCourts()
{
    $DB = new DbConnection();
    $sql = 'SELECT COUNT(id) from court where isDeleted = 0';
    $result = mysqli_query($DB->getdbconnect(), $sql);
    $courtCount = mysqli_fetch_array($result);

    return $courtCount['COUNT(id)'];
}

function getCourtPrice($courtId)
{
    $DB = new DbConnection();
    $sql = 'SELECT price from court where id = "'.$courtId.'" AND isDeleted = 0';
    $result = mysqli_query($DB->getdbconnect(), $sql);
    $courtPrice = mysqli_fetch_array($result);

    return $courtPrice['price'];
}

function getAveragePrice(){
    $DB = new DbConnection();
    $sql = 'SELECT AVG(price) from court where isDeleted = 0';
    $result = mysqli_query($DB->getdbconnect(), $sql);
    $avgPrice = mysqli_fetch_array($result);
    
    return $avgPrice['AVG(price)'];
}

function getTotalEarnings(){
    $DB = new DbConnection();
    $sql = 'SELECT SUM(cost) from reservationdetails';
    $result = mysqli_query($DB->getdbconnect(), $sql);
    $totalEarnings = mysqli_fetch_array($result);

    return $totalEarnings['SUM(cost)'];
}

function getTotalCourtEarnings($courtId){
    $DB = new DbConnection();
    $sql = 'SELECT SUM(cost) from reservationdetails 
    INNER JOIN reservation on reservation.reservationDetailsId = reservationdetails.id
    WHERE reservation.courtId = "'.$courtId.'"';
    $result = mysqli_query($DB->getdbconnect(), $sql);
    $totalCourtEarnings = mysqli_fetch_array($result);

    return $totalCourtEarnings['SUM(cost)'];
} -->

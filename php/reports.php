
<?php 
require_once 'navbar.php';
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>
  <body>
<div id = "content">
  <div id="top_x_div" style="width: 900px; height: 500px;  float:left; "></div>
  <div style=" float:left; ">
  <form method="POST" action="">
  <label> Choose Report: </label>
  <select class="form-control" id="reportTypelist" name="reportType" onchange="ShowMonth()" >
<option value="UserType">Number of User Types</option>
<option value="reservations">Number of Reservations/Month <option>
</select>
<label> Choose Shape: </label>
  <select class="form-control" name="chart" >
  <option name="barChart" value="barChart"> Bar Chart </option>
  <option name="pieChart" value="pieChart"> Pie Chart </option>
  </select>
  <label id="monthLabel" style="display:none;"> Choose Month: </label>
  <input class="form-control" name="month" id="monthID" type="month" style="display:none; ">

<input class="btn btn-primary pb-20" type=submit value=GO>

  </form>
  </div>
</div>
</div>
<?php //require_once 'footer.html'; ?>
  </body>

</html>
<script>
function ShowMonth()
{
    if (document.getElementById('reportTypelist').value=="reservations")
    {
        document.getElementById('monthID').style.display="inline-block";
        document.getElementById('monthLabel').style.display="inline-block";
    }
    else
    {
        document.getElementById('monthID').style.display="none";
        document.getElementById('monthLabel').style.display="none";
    }
}
</script>
<?php
require_once 'connection.php';
require_once 'Ireports.php';

abstract class absreports {
    public $reports;
    public $js;
    function __construct() {
        $this->reports = new Ireports();
        $this->js      = "";
    }
    function display() {
        $this->reports->displayReports($this->js);
    }
    function setDisplayMethod($obj) {
        $this->reports = $obj;
    }
}
class countUserType extends absreports {
    function __construct() {
        $this->js      = $this->getusersCount();
        $this->reports = new displayBarCharts();
    }
    function getusersCount() {
        $DB  = new DbConnection();
        $sql = 'SELECT COUNT(user.id) ucount, ut.userTypeName utname from user
      Inner join usertype ut ON ut.id = user.userTypeId
      WHERE isDeleted = 0
      GROUP BY user.userTypeId
      ORDER BY  ucount asc';
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $str    = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $str .= ', ["' . $row['utname'] . '", ' . $row['ucount'] . '] ';
        }

        $js = '
      var data = new google.visualization.arrayToDataTable([
      ["User Type", "Number of Users"] ' . $str . '
    ]); ';
        return $js;
    }
}
class countReservation extends absreports {
    function __construct() {
        $this->js      = $this->getReservationCount();
        $this->reports = new displayBarCharts();
    }
    function getReservationCount() {
        $DB    = DbConnection::getInstance();
        $month = "";
        $month = substr($_POST['month'], 5);
        $year  = substr($_POST['month'], 0, 4);
        $Days  = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $str   = '';
        for ($i = 1; $i < $Days + 1; $i++) {
            $sql    = 'SELECT COUNT(id) FROM `reservationdetails` Where Day(date)=' . $i . ' AND Month(date)=' . $month.' AND Year(date)='. $year;
            $result = mysqli_query($DB->getdbconnect(), $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $str .= ', ["Day ' . $i . '", ' . $row['COUNT(id)'] . '] ';
            }
        }
        $monthName = date('F', strtotime("$year-$month-01"));
        $js        = '
      var data = new google.visualization.arrayToDataTable([
      ["' . $monthName . ' ' . $year . '", "Number of Reservations"] ' . $str . '
    ]); ';
        return $js;
    }
}

$CountUsers = new countUserType();
$CountUsers->display();
if (isset($_POST['chart']) && isset($_POST['reportType'])) {
    if ($_POST['chart'] == "pieChart" )
    {
        if($_POST['reportType']=="UserType") {
            $CountUsers->setDisplayMethod(new displayPieCharts());
            $CountUsers->display();
        }
        else if($_POST['reportType']=="reservations"){
            
            if (isset($_POST['month']) && !empty($_POST['month'])) {
            $CountReservations = new countReservation();
            $CountReservations->setDisplayMethod(new displayPieCharts());
            $CountReservations->display();
            echo "<script> document.getElementById('monthID').style.display='inline-block';
            document.getElementById('reportTypelist').value='reservations';
            document.getElementById('monthLabel').style.display='inline-block';
            document.getElementById('monthID').value='".$_POST['month']."';
            </script>";
                }
            else if ((empty($_POST['month'])))
            {
                    echo "<script> alert('choose Month'); </script>";
            }
        }
    }
    else if ($_POST['chart'] == "barChart") 
    {
        if($_POST['reportType']=="UserType") {
            $CountUsers->setDisplayMethod(new displayBarCharts());
            $CountUsers->display();
        }
        else if($_POST['reportType']=="reservations"){
            
            if (isset($_POST['month']) && !empty($_POST['month'])) {
            $CountReservations = new countReservation();
            $CountReservations->setDisplayMethod(new displayBarCharts());
            $CountReservations->display();
            echo"<script> document.getElementById('monthID').style.display='inline-block';
            document.getElementById('reportTypelist').value='reservations';
            document.getElementById('monthLabel').style.display='inline-block';
            document.getElementById('monthID').value='".$_POST['month']."';
            </script>";
        }
        else if ((empty($_POST['month'])))
        {
            echo "<script> alert('choose Month'); </script>";
        }
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

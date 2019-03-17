<?php
require_once('connection.php');

function getTotalUsers(){
    $DB = new DbConnection();
    $sql = 'SELECT COUNT(id) from user where userTypeId = 2 AND isDeleted = 0';
    $result = mysqli_query($DB->getdbconnect(), $sql);
    $userCount = mysqli_fetch_array($result);

    return $userCount['COUNT(id)'];
}

function getCourtReservations($courtId){
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
}

echo getCourtReservations(1);
echo getTotalCourts();
echo getCourtPrice(1);
echo getAveragePrice();
echo getTotalEarnings();
echo getTotalCourtEarnings(1);
echo getTotalUsers();


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawPriceChart);
        google.charts.setOnLoadCallback(drawReservationChart);

        
        // Draw the chart and set the chart values
        function drawPriceChart() {
          var data = google.visualization.arrayToDataTable([
          ["Court No.", "Price Per Hour"],

          <?php
          $DB = new DbConnection();
          $sql = 'select * from court where isDeleted = 0';
          $result = mysqli_query($DB->getdbconnect(), $sql);
          while($row = mysqli_fetch_array($result)){
              echo '["Court No. '.$row['courtNumber'].'", '.getCourtPrice($row['id']).'],';
          }
          ?>
        ]);
        
          // Optional; add a title and set the width and height of the chart
          var options = {'title':'Court Prices', 'width':550, 'height':400};
        
          // Display the chart inside the <div> element with id="piechart"
          var chart = new google.visualization.PieChart(document.getElementById('courtprices'));
          chart.draw(data, options);
        }

        function drawReservationChart() {
          var data2 = google.visualization.arrayToDataTable([
          ["Court No.", "Reservations"],

          <?php
          $DB = new DbConnection();
          $sql = 'select * from court where isDeleted = 0';
          $result = mysqli_query($DB->getdbconnect(), $sql);
          while($row = mysqli_fetch_array($result)){
              echo '["Court No. '.$row['courtNumber'].'", '.getCourtReservations($row['id']).'],';
          }
          ?>
        ]);
        
          // Optional; add a title and set the width and height of the chart
          var options2 = {'title':'Court Reservations', 'width':550, 'height':400};
        
          // Display the chart inside the <div> element with id="piechart"
          var reservationchart = new google.visualization.PieChart(document.getElementById('courtres'));
          reservationchart.draw(data2, options2);
        }
        </script>
</head>
<body>

<div id = 'courtprices'></div>
<div id = 'courtres'></div>


</body>
</html>



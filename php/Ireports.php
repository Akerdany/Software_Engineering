<?php
interface Ireport {
    public function displayReports($x);
}

class displayBarCharts implements Ireport {
    public function displayReports($js) {
        echo '<script>
       google.charts.load("current", {"packages":["bar"]});
       google.charts.setOnLoadCallback(drawStuff);

       function drawStuff() {
        ' . $js . '
        var options = {

          width: 900,
          legend: { position: "none" },
          bars: "vertical", // Required for Material Bar Charts.
          hAxis: { format:"decimal"},
          vAxis: { format:"decimal"},
          axes: {
            x: {
              0: { side: "top" } // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };
         var chart = new google.charts.Bar(document.getElementById("top_x_div"));
         chart.draw(data, options);
       };
     </script> ';
    }
}

class displayPieCharts implements Ireport {
    public function displayReports($js) {
        echo '<script >
       google.charts.load("current", {"packages":["corechart"]});
       google.charts.setOnLoadCallback(drawChart);

       function drawChart() {
        ' . $js . '

         var options = {
           is3D: "true"
         };

         var chart = new google.visualization.PieChart(document.getElementById("top_x_div"));
         chart.draw(data, options);
       }
     </script>';
    }
}

?>
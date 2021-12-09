<?php
$mysqli = new mysqli("localhost", "dbuser", "dbpassword", "nse2021");
$rs=$mysqli->query("SELECT TDATE,HIGH,OPEN,CLOSE,LOW FROM eqcoalindia;"); 
?>
<?php
$rows=[];
while($row = $rs->fetch_array(MYSQLI_NUM))
{
    array_push($rows, $row);
}
//print_r($rows);
foreach($rows as $line) {
  $ln="[";
foreach($line as $col) {
  $ln.=$col.",";
} 
$lin=rtrim($ln,',');
$lin.="],"; 
//$flin=rtrim($lin,',');
echo $lin;
} ?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
<?php  
foreach(stockvals as stockval) {
?>


      ['<?php echo $stockval['TDATE']; ?>', <?php echo $stockval['LOW']; ?>, <?php echo $stockval['OPEN']; ?>, <?php echo $stockval['CLOSE']; ?>, <?php echo $stockval['HIGH']; ?>],


<?php
}
?>
      // Treat first row as data as well.
    ], true);

    var options = {
      legend:'none'
    };

    var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));

    chart.draw(data, options);
  }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>

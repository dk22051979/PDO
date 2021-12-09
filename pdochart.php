<?php
$dsn = "mysql:host=localhost;dbname=nse2021;charset=UTF8";
$dsnnl = "mysql:host=localhost;dbname=nolimit;charset=UTF8";
$pdo = new PDO($dsn, "dbuser", "dbpassword");
$pdonl = new PDO($dsnnl, "dbuser", "dbpassword");
$arr = [];
$arrnl=[];

$sym="";
$tbl="";
$days="";
$type="stock";
if(isset($_GET['sym'])){
$sym=$_GET['sym'];
$tbl="eq".preg_replace('/[^A-Za-z0-9]/', '', $sym);
}else{
$sym="ACC"; 
$tbl="eqacc";
}

$sql="SELECT * FROM {$tbl} WHERE SYMBOL=? ORDER BY TDATE";
$sqlnl="SELECT * FROM futureoption WHERE type=? ORDER BY fostocks";
if(isset($_GET['days'])){
$sql.=" LIMIT ".$_GET['days'];
}else{
$sql.="";
}
$stmt = $pdo->prepare($sql);
$stmtnl = $pdonl->prepare($sqlnl);
$stmt->execute([$sym]);
$stmtnl->execute([$type]);


while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $arr[] = $row;
}
if(!$arr) exit('No rows in db nse2021');
//var_export($arr);
$stmt = null;

while ($rownl = $stmtnl->fetch(PDO::FETCH_ASSOC)) {
  $arrnl[] = $rownl;
}
if(!$arrnl) exit('No rows in db nolimit');



foreach($arrnl as $stock) {
  ?>
[<a href='http://localhost/ohlc/pdochart.php?sym=<?php echo str_replace('&', '%26', $stock["fostocks"]); ?>'><?php echo $stock["fostocks"]; ?></a>]<a href='https://www1.nseindia.com/companytracker/cmtracker.jsp?symbol=<?php echo str_replace('&', '%26', $stock["fostocks"]); ?>&cName=cmtracker_nsedef.css' target='_blank'>$</a>&nbsp;
<?php
}
$stmtnl = null;
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
<?php  
foreach($arr as $stockval) {
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
    <div id="chart_div" style="width: 100%; height: 420px;"></div>
  </body>
</html>

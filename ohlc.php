<?php
//ini_set('max_execution_time', '0');
$fn="2021/cm08DEC2021bhav.csv";
$mysqli = new mysqli("localhost", "dbuser", "dbpassword", "nse2021");
$myday=substr($fn, 7, 2);
$mymon=substr($fn, 9, 3);
$myyr=substr($fn, 12, 4); 
$mymn="";
if($mymon=="JAN"){
	$mymn="01";
}elseif ($mymon=="FEB") {
	$mymn="02";
}elseif ($mymon=="MAR") {
	$mymn="03";
}elseif ($mymon=="APR") {
	$mymn="04";
}elseif ($mymon=="MAY") {
	$mymn="05";
}elseif ($mymon=="JUN") {
	$mymn="06";
}elseif ($mymon=="JUL") {
	$mymn="07";
}elseif ($mymon=="AUG") {
	$mymn="08";
}elseif ($mymon=="SEP") {
	$mymn="09";
}elseif ($mymon=="OCT") {
	$mymn="10";
}elseif ($mymon=="NOV") {
	$mymn="11";
}elseif ($mymon=="DEC") {
	$mymn="12";
}

if (($open = fopen($fn, "r")) !== FALSE)
{

	while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
	{		
	$array[] = $data;
	}

	fclose($open);
}

$trdate=$myyr.'-'.$mymn.'-'.$myday;
$row=0;

foreach ($array as $lineidx => $linear) {
	if (($lineidx > 0)  && ($linear[1]=="EQ"))
	{
	$row++;
	
	echo "<pre>";
	    $ctsql="CREATE TABLE IF NOT EXISTS ".preg_replace('/[^A-Za-z0-9]/', '', $linear[1].$linear[0])." (TDATE date, SYMBOL varchar(100), SERIES  varchar(10), OPEN decimal(15,2), HIGH  decimal(15,2), LOW decimal(15,2), CLOSE  decimal(15,2), LAST  decimal(15,2), PREVCLOSE decimal(15,2), TOTTRDQTY bigint, TOTTRDVAL  decimal(15,2), TIMESTAMP  varchar(100), TOTALTRADES bigint, ISIN  varchar(100), BLANK varchar(100));";
    //echo $row.$ctsql;
	$colval="";
    foreach ($linear as $idx => $value) {

    	$colval .= "'$value', ";
    	
    }
    $iisql="INSERT INTO ".preg_replace('/[^A-Za-z0-9]/', '', $linear[1].$linear[0])." VALUES('".$trdate."', ".rtrim($colval, ', ').");";
	//echo $iisql;



	$mysqli->query($ctsql);
	$mysqli->query($iisql);



	//echo "\n</pre>";
	echo $row;
	}
		//printf("New record has ID %d.\n", $mysqli->insert_id);
}


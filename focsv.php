<?php
//ini_set('max_execution_time', '0');
$fn="fo.csv";
$mysqli = new mysqli("localhost", "dbuser", "dbpassword", "nolimit");


if (($open = fopen($fn, "r")) !== FALSE)
{

	while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
	{		
	$array[] = $data;
	}

	fclose($open);
}


$row=0;

foreach ($array as $lineidx => $linear) {
	if ($lineidx > 4)
	{
	$row++;
	echo "<pre>";
    $iisql="INSERT INTO futureoption(fostocks,lot) VALUES('".trim($linear[1])."', ".trim($linear[2]).");";
	//echo $iisql;

//print_r($linear);

	$mysqli->query($iisql);



	//echo "\n</pre>";
	echo $row;
	}
		
}


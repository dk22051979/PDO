<?php
$fn="cm05DEC2021bhav.csv";
$myday=substr($fn, 2, 2);
$mymon=substr($fn, 4, 3);
$myyr=substr($fn, 7, 4); 
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

echo $myyr.'-'.$mymn.'-'.$myday;


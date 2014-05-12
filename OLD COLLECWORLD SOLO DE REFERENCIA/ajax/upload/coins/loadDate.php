<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/ICalendar.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/ICalendar.php';
	
}

$acalend = new ICalendar();

$type = $_REQUEST['type'];

if($type == 1){

	$GDay=1;
	$GMonth=12;
	$GYear=$_REQUEST['date'];

	$acdate=$acalend->GregorianToIslamic($GYear, $GMonth, $GDay);  
	echo $AYear = $acdate[year];
	
}else{
	
	$IDay=1;
	$IMonth=10;
	$IYear=$_REQUEST['date'];
	
	$acdate_g=$acalend->IslamicToGregorian($IYear, $IMonth, $IDay);
	echo $AYear = $acdate_g[year];

}


?>
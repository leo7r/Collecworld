<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$company = $_REQUEST['abbr'];
$catalog = $_REQUEST['catalog'];
$system = $_REQUEST['system'];

$catalog_sql = '';
$system_sql = '';

if ( strlen($catalog) > 0 ){

	switch( (int) $catalog ){
		
		case 0:
			$catalog_sql = ' AND p.order_date <> "Unknown" ';
			break;
		case 1:
			$catalog_sql = ' AND p.order_date = "Unknown" ';
			break;
		case 2:
			$catalog_sql = ' AND p.not_emmited = 1 ';
			break;
		case 3:
			$catalog_sql = ' AND p.especial = 1 ';
			break;
		
	}
}

if ( strlen($system) > 0 ){
	
	switch( (int) $system ){
		
		case 0:
			$system_sql = ' AND p.id_phonecards_systems = 1';
			break;
		case 1:
			$system_sql = ' AND p.id_phonecards_systems = 2';
			break;
		case 2:
			$system_sql = ' AND p.id_phonecards_systems = 3';
			break;
		case 3:
			$system_sql = ' AND p.id_phonecards_systems = 4';
			break;
		case 4:
			$system_sql = ' AND p.id_phonecards_systems = 5';
			break;
	}
	
}

$sql = 'SELECT p.order_date FROM phonecards p , phonecards_companies pc WHERE pc.abbreviation = "'.$company.'" and pc.id_phonecards_companies = p.id_phonecards_companies '.$catalog_sql.' '.$system_sql.' group by p.order_date;';

$cursor = mysql_query($sql);

$years = array();

for( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){
	
	$datos = mysql_fetch_array($cursor);
	$year = $datos['order_date'];
	
	if ( strcmp($year,"Unknown") != 0 ){
		$year = explode('/',$year);
		$year = $year[0];
		
		if ( !in_array($year, $years)){
			$years[] = $year;
		}
	}
}

$years = array_unique($years);

$years = implode(",",$years);

echo $years;

?>
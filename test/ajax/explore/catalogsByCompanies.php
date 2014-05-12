<?php



if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';

}

else{

	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';

}



$company = $_REQUEST['abbr'];

$serie = $_REQUEST['serie'];

$system = $_REQUEST['system'];



$serie_sql = '';

$system_sql = '';



if ( strlen($serie) > 0 ){

	$serie_sql = ' AND p.id_phonecards_series = '.$serie;

}



if ( strlen($system) > 0 ){

	$system_sql = ' AND p.id_phonecards_systems = '.$system;	

}



$unknown_sql = 'SELECT COUNT(*) as count FROM phonecards p , phonecards_companies pc WHERE pc.abbreviation = "'.$company.'" and pc.id_phonecards_companies = p.id_phonecards_companies and p.order_date = "Unknown" and p.especial = 0 and p.not_emmited = 0'.$serie_sql.$system_sql;

$unknown_cursor = mysql_query($unknown_sql);



//echo $unknown_sql;



$known_sql = 'SELECT COUNT(*) as count FROM phonecards p , phonecards_companies pc WHERE pc.abbreviation = "'.$company.'" and pc.id_phonecards_companies = p.id_phonecards_companies and p.order_date <> "Unknown" and p.especial = 0 and p.not_emmited = 0'.$serie_sql.$system_sql;

$known_cursor = mysql_query($known_sql);



$especial_sql = 'SELECT COUNT(*) as count FROM phonecards p , phonecards_companies pc WHERE pc.abbreviation = "'.$company.'" and pc.id_phonecards_companies = p.id_phonecards_companies and p.especial = 1'.$serie_sql.$system_sql;

$especial_cursor = mysql_query($especial_sql);



$notE_sql = 'SELECT COUNT(*) as count FROM phonecards p , phonecards_companies pc WHERE pc.abbreviation = "'.$company.'" and pc.id_phonecards_companies = p.id_phonecards_companies and p.not_emmited = 1'.$serie_sql.$system_sql;

$notE_cursor = mysql_query($notE_sql);



$unknown = mysql_fetch_array($unknown_cursor);

$known = mysql_fetch_array($known_cursor);

$especial = mysql_fetch_array($especial_cursor);

$notE = mysql_fetch_array($notE_cursor);



echo $known['count'].','.$unknown['count'].','.$especial['count'].','.$notE['count'];



?>
<?php



if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';

}

else{

	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';

}



$company = $_REQUEST['abbr'];

$catalog = $_REQUEST['catalog'];

$serie = $_REQUEST['serie'];



$serie_sql = '';

if ( strlen($serie) > 0 ){

	$serie_sql = ' AND p.id_phonecards_series = '.$serie;

}



if ( strlen($catalog) == 0 ){

	$sql = 'SELECT p.id_phonecards_systems , COUNT(*) count FROM phonecards p , phonecards_companies pc WHERE pc.abbreviation = "'.$company.'" and pc.id_phonecards_companies = p.id_phonecards_companies '.$serie_sql.' group by p.id_phonecards_systems;';

}

else{

	$catalog = (int) $catalog;

	switch( $catalog ){

	

	case 0:

		$catalog_sql = ' AND p.order_date <> "Unknown"';

		break;

	case 1:

		$catalog_sql = ' AND p.order_date = "Unknown"';

		break;

	case 2:

		$catalog_sql = ' AND p.not_emmited = 1';

		break;

	case 3:

		$catalog_sql = ' AND p.especial = 1';

		break;

	

	}



	$sql = 'SELECT p.id_phonecards_systems , COUNT(*) count FROM phonecards p , phonecards_companies pc WHERE pc.abbreviation = "'.$company.'" and pc.id_phonecards_companies = p.id_phonecards_companies '.$catalog_sql.' '.$serie_sql.' group by p.id_phonecards_systems;';

}

//echo $sql;



$cursor = mysql_query($sql);



$ret = '';



for ( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){

	$sys = mysql_fetch_array($cursor);

	$ret = $ret.$sys['id_phonecards_systems'].'_'.$sys['count'].',';

}



echo substr($ret,0,strlen($ret)-1);



?>
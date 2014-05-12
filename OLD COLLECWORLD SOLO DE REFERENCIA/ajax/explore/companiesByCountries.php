<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$countries = $_REQUEST['abbr'];

$sql = 'SELECT pc.* , COUNT(pc.id_phonecards_companies) as num FROM phonecards p, phonecards_companies pc , countries c WHERE c.abbreviation = "'.$countries.'" AND pc.id_countries = c.id_countries AND p.id_phonecards_companies = pc.id_phonecards_companies GROUP BY pc.id_phonecards_companies HAVING num > 0 ORDER BY pc.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="com-'.$datos['abbreviation'].'" onClick="explore_company(this,\''.$datos['abbreviation']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
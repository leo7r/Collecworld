<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$countries = $_REQUEST['abbr'];

$sql = 'SELECT ct.* , COUNT(ct.id_coins_title) as num FROM coins coin, coins_title ct , countries c WHERE c.abbreviation = "'.$countries.'" AND ct.id_countries = c.id_countries AND coin.id_coins_title = ct.id_coins_title GROUP BY ct.id_coins_title HAVING num > 0 ORDER BY ct.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="ti-'.$datos['id_coins_title'].'" onClick="explore_title_coin(this,\''.$datos['id_coins_title']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
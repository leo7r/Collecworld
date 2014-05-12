<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$id = $_REQUEST['id'];

$sql = 'SELECT cv.* , COUNT(cv.id_coins_value) as num FROM coins coin, coins_value cv, coins_denomination_value cdv WHERE cdv.id_coins_denomination = "'.$id.'" AND coin.id_coins_value = cdv.id_coins_value AND coin.id_coins_denomination = cdv.id_coins_denomination AND coin.id_coins_value = cv.id_coins_value GROUP BY cv.id_coins_value HAVING num > 0 ORDER BY cv.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="den-'.$datos['id_coins_value'].'" onClick="explore_value_coin(this,\''.$datos['id_coins_value']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$id = $_REQUEST['id'];

$sql = 'SELECT cd.* , COUNT(cd.id_coins_denomination) as num FROM coins coin, coins_denomination cd, coins_subtitle_denomination cstd WHERE cstd.id_coins_subtitle = "'.$id.'" AND coin.id_coins_denomination = cstd.id_coins_denomination AND coin.id_coins_subtitle = cstd.id_coins_subtitle AND coin.id_coins_denomination = cd.id_coins_denomination GROUP BY cd.id_coins_denomination HAVING num > 0 ORDER BY cd.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="den-'.$datos['id_coins_denomination'].'" onClick="explore_denomination_coin(this,\''.$datos['id_coins_denomination']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
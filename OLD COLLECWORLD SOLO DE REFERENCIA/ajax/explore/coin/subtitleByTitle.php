<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$id = $_REQUEST['id'];

$sql = 'SELECT cst.* , COUNT(cst.id_coins_title) as num FROM coins coin, coins_subtitle cst WHERE cst.id_coins_title = "'.$id.'" AND coin.id_coins_subtitle= cst.id_coins_subtitle GROUP BY cst.id_coins_subtitle HAVING num > 0 ORDER BY cst.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="subt-'.$datos['id_coins_subtitle'].'" onClick="explore_subtitle_coin(this,\''.$datos['id_coins_subtitle']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
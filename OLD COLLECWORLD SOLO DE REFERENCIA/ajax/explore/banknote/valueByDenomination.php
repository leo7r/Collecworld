<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$id = $_REQUEST['id'];

$sql = 'SELECT bv.* , COUNT(bv.id_banknotes_value) as num FROM banknotes b, banknotes_value bv, banknotes_denomination_value bdv WHERE bdv.id_banknotes_denomination = "'.$id.'" AND b.id_banknotes_value = bdv.id_banknotes_value AND b.id_banknotes_denomination = bdv.id_banknotes_denomination AND b.id_banknotes_value = bv.id_banknotes_value GROUP BY bv.id_banknotes_value HAVING num > 0 ORDER BY bv.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="den-'.$datos['id_coins_value'].'" onClick="explore_value_banknote(this,\''.$datos['id_banknotes_value']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
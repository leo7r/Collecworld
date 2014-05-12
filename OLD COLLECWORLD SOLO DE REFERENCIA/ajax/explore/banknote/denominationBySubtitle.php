<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$id = $_REQUEST['id'];

$sql = 'SELECT bd.* , COUNT(bd.id_banknotes_denomination) as num FROM banknotes b, banknotes_denomination bd, banknotes_subtitle_denomination bstd WHERE bstd.id_banknotes_subtitle = "'.$id.'" AND b.id_banknotes_denomination = bstd.id_banknotes_denomination AND b.id_banknotes_subtitle = bstd.id_banknotes_subtitle AND b.id_banknotes_denomination = bd.id_banknotes_denomination GROUP BY bd.id_banknotes_denomination HAVING num > 0 ORDER BY bd.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="den-'.$datos['id_banknotes_denomination'].'" onClick="explore_denomination_banknote(this,\''.$datos['id_banknotes_denomination']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
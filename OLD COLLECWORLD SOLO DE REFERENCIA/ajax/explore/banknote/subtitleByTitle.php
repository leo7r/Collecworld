<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$id = $_REQUEST['id'];

$sql = 'SELECT bst.* , COUNT(bst.id_banknotes_title) as num FROM banknotes b, banknotes_subtitle bst WHERE bst.id_banknotes_title = "'.$id.'" AND b.id_banknotes_subtitle= bst.id_banknotes_subtitle GROUP BY bst.id_banknotes_subtitle HAVING num > 0 ORDER BY bst.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="subt-'.$datos['id_banknotes_subtitle'].'" onClick="explore_subtitle_banknote(this,\''.$datos['id_banknotes_subtitle']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
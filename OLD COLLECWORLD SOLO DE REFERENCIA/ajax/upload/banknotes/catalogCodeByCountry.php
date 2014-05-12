<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$id_c = $_REQUEST['country'];

$sql = 'SELECT * FROM banknotes_catalog_code WHERE id_countries = '.$id_c;

$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) == 1 ){
	$datos = mysql_fetch_array($cursor);
	echo $datos['catalog_initials'].':&nbsp;';
}

?>
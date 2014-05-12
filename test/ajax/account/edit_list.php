<?php 
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$name = $_REQUEST['name'];
$priv = $_REQUEST['priv'];
$id_user = $_REQUEST['id_user'];
$name_old = $_REQUEST['name_old'];

$sql = 'UPDATE lists set name="'.$name.'", status='.$priv.' WHERE id_users='.$id_user.' AND name="'.$name_old.'" ';
mysql_query($sql);

	echo $name;


?>
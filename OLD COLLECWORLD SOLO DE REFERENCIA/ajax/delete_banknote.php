<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

@session_start();

$id_bn = $_REQUEST['id'];
$sql = 'SELECT * FROM banknotes WHERE id_banknotes = '.$id_bn;
$cursor = mysql_query($sql);

/*$users_allowed = array('antonio','ricardo','leo','victorsrz3');*/

if ( mysql_num_rows($cursor) == 1 && (($_SESSION['status'] == 1)||($_SESSION['status'] == 2) ) ){
	
	mysql_query('DELETE FROM banknotes WHERE id_banknotes = '.$id_bn.' LIMIT 1');	
	echo 'OK';
}
else{
	echo 'ERROR';	
}
	
?>
<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

@session_start();

$id_pc = $_REQUEST['id'];
$sql = 'SELECT * FROM phonecards WHERE id_phonecards = '.$id_pc;
$cursor = mysql_query($sql);

/*$users_allowed = array('antonio','ricardo','leo','victorsrz3');*/

if ( mysql_num_rows($cursor) == 1 && (($_SESSION['status'] == 1)||($_SESSION['status'] == 2) ) ){
	
	mysql_query('DELETE FROM phonecards WHERE id_phonecards = '.$id_pc.' LIMIT 1');	
	echo 'OK';
}
else{
	echo 'ERROR';	
}
	
?>
<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

@session_start();

$user2 = $_REQUEST['user2'];

if ( isset($_SESSION['id_users']) ){
	$user1 = $_SESSION['id_users'];
}
else{
	echo 'error';
	return;
}

$sql = 'SELECT * FROM friends WHERE id_users1 = '.$user2.' AND id_users2 = '.$user1.' AND status = 0';
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) == 1 ){
	
	$sql1 = 'UPDATE friends SET status = 1 WHERE id_users1 = '.$user2.' AND id_users2 = '.$user1.' AND status = 0 LIMIT 1';
	mysql_query($sql1);
	
	echo 'ok';
}
else{
	echo 'error';
}

?>
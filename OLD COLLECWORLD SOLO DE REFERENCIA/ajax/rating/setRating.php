<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

@session_start();

$cat = $_REQUEST['cat'];
$id_item = $_REQUEST['id_item'];
$score = $_REQUEST['score'];

if ( !isset($_SESSION['id_users']) ){
	echo 'error';
	return;
}

$user = $_SESSION['id_users'];

$sql = 'SELECT * FROM ratings WHERE id_users = '.$user.' AND id_categories = '.$cat.' AND id_item = '.$id_item;
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) == 1 ){
	
	$datos = mysql_fetch_array($cursor);
	$sql2 = 'UPDATE ratings SET rating = '.$score.' WHERE id_ratings = '.$datos['id_ratings'];
	mysql_query($sql2);
	
	echo 'ok';
}
else{
	
	$sql2 = 'INSERT INTO ratings (id_categories,id_item,id_users,rating) VALUES ('.$cat.','.$id_item.','.$user.','.$score.')';
	mysql_query($sql2);
	
	echo 'ok';	
}


?>
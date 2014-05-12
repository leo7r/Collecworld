<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

@session_start();

if ( !isset($_SESSION['id_users']) ){
	echo 'error';
	return;
}

$event = $_REQUEST['evnt'];
$comment = $_REQUEST['comment'];
$user = $_SESSION['id_users'];

$sql = 'SELECT * FROM event_comments WHERE id_users = '.$user.' AND comment = "'.$comment.'" AND id_events = '.$event;
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) == 0 ){
	
	$sql2 = 'INSERT INTO event_comments (id_users,comment,id_events,date) VALUES ('.$user.',"'.$comment.'",'.$event.','.time().')';
	mysql_query($sql2);
	echo 'ok';	
}
else{
	echo 'duplicate';
	return;
}

?>
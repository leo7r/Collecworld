<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$item = $_REQUEST['itm'];
$sender = $_REQUEST['sender'];
$comment = trim($_REQUEST['comment']);

$sql0 = 'SELECT * FROM comment WHERE id_categories = 1 AND id_item = '.$item.' AND comment = "'.$comment.'" AND id_users = '.$sender;
$cursor = mysql_query($sql0);

if ( mysql_num_rows($cursor) > 0 ){
	echo 'error';
	return;
}

if ( strcmp($item,"") == 0 or strcmp($sender,"") == 0 or strlen($comment) < 10 ){
	echo "error";
}
else{
	
	$sql = 'INSERT INTO comment (id_categories,id_item,comment,id_users,date) VALUES (1,'.$item.',"'.$comment.'",'.$sender.',"'.time().'")';
	mysql_query($sql);
	echo "ok";
}
?>
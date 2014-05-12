<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$user = $_REQUEST['user'];
$user = trim(strtolower($user));

$sql = 'SELECT * FROM users WHERE user = "'.$user.'"';
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) == 0 ){
	echo '0';
}
else{
	echo '-1';
}

?>
<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$usr = $_REQUEST['user'];
$txt = $_REQUEST['text'];

$cursor = mysql_query('SELECT * FROM feedback WHERE user = "'.$usr.'" AND status = 0');

if ( strlen($txt) < 10 or mysql_num_rows($cursor) > 10 ){
	echo ' ERROR ';
	return;
}

mysql_query('INSERT INTO feedback (user,idea,date) VALUES ("'.$usr.'","'.$txt.'",'.time().')');
echo ' OK ';
return;
?>
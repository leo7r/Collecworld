<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';

}

else{

	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';

}



@session_start();



$user = $_REQUEST['user'];

$type = $_REQUEST['type'];



$get_sql = 'SELECT * FROM users WHERE id_users = '.$user;

$get_cursor = mysql_query($get_sql);

$get_info = mysql_fetch_array($get_cursor);



if ( $get_info['email_'.$type] == 0 ){

	$set = 1;	

}

else{

	$set = 0;	

}



$sql='UPDATE users SET email_'.$type.' = '.$set.' WHERE id_users = '.$user;

mysql_query($sql);



echo $set;



?>
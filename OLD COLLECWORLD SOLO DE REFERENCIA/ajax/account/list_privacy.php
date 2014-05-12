<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';

}

else{

	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';

}



@session_start();



$sel = $_REQUEST['sel'];

$user = $_REQUEST['user'];





$sql="update users set list_privacy='".$sel."' where id_users='".$user."'";

mysql_query($sql);



echo 'ok';



?>
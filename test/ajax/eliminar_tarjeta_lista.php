<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
}

@session_start();

$user = $_SESSION['id_users'];
$id = $_REQUEST['id']; 
$list = $_REQUEST['list'];

if ( $user and $id and $list ){
	 
		
		$run = 'DELETE FROM phonecards_users WHERE id_users = '.$user.' AND id_phonecards = '.$id.' AND id_lists = '.$list;
		mysql_query($run);
		 
		return;
}

?>
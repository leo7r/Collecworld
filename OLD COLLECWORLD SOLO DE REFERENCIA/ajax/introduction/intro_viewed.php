<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

session_start();

if ( !isset($_SESSION['id_users']) ){
	die('Log in first, please.');
}

$user = $_REQUEST['user'];
$type = $_REQUEST['type'];

if ( !$type || !$user ){
	die('error');
}
else{
		
	switch( $type ){
		
		case 1:{
			$sql = 'UPDATE users SET intro_explore=1 WHERE user ="'.$user.'"';
			$cursor = mysql_query($sql);
			
			echo 'ok';
			
			
		}break;
		
		case 2:{
			$sql = 'UPDATE users SET intro_show_phonecard=1 WHERE user ="'.$user.'"';
			$cursor = mysql_query($sql);
			
			echo 'ok';
			
			
		}break;
		
		case 3:{
			$sql = 'UPDATE users SET intro_upload=1 WHERE user ="'.$user.'"';
			$cursor = mysql_query($sql);
			
			echo 'ok';
			
			
		}break;
		
		case 4:{
			$sql = 'UPDATE users SET intro_event=1 WHERE user ="'.$user.'"';
			$cursor = mysql_query($sql);
			
			echo 'ok';
			
			
		}break;
		
		case 5:{
			$sql = 'UPDATE users SET intro_create_event=1 WHERE user ="'.$user.'"';
			$cursor = mysql_query($sql);
			
			echo 'ok';
			
			
		}break;
		
		case 6:{
			$sql = 'UPDATE users SET intro_profile=1 WHERE user ="'.$user.'"';
			$cursor = mysql_query($sql);
			
			echo 'ok';
			
			
		}break;
		
		case 7:{
			$sql = 'UPDATE users SET intro_exchange=1 WHERE user ="'.$user.'"';
			$cursor = mysql_query($sql);
			
			echo 'ok';
			
			
		}break;
		
		case 8:{
			$sql = 'UPDATE users SET intro_buy=1 WHERE user ="'.$user.'"';
			$cursor = mysql_query($sql);
			
			echo 'ok';
			
			
		}break;
	}
}
?>
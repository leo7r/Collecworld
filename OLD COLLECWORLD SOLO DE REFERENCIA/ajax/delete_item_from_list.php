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

$category = $_REQUEST['category'];
$user = $_SESSION['id_users'];
$id = $_REQUEST['id']; 
$list = $_REQUEST['list'];

if ( $user && $id && $list && $category ){
	
	$category_var = '';
	
	switch( $category ){
		case 1:
			$category_var = 'phonecards';
			break;
		case 2:
			$category_var = 'coins';
			break;
		case 3:
			$category_var = 'banknotes';
			break;
	}
	
	if ( $list == 3 || $list == 5 ){
		
		if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
			$include_ruta = $_SERVER['DOCUMENT_ROOT'].'upload/trade_'.$category_var.'/';
		}
		else{
			$include_ruta = $_SERVER['DOCUMENT_ROOT'].'collecworld/upload/trade_'.$category_var.'/';
		}
		
		$sql = 'SELECT * FROM '.$category_var.'_users WHERE id_users = '.$user.' AND id_'.$category_var.' = '.$id.' AND id_lists = '.$list;
		$cursor = mysql_query($sql);
		
		for ( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){
			$datos = mysql_fetch_array($cursor);
			
			@unlink($include_ruta.$datos['image']);
		}
			
	}
		
	$run = 'DELETE FROM '.$category_var.'_users WHERE id_users = '.$user.' AND id_'.$category_var.' = '.$id.' AND id_lists = '.$list;
	mysql_query($run);
}

?>
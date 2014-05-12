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
$id_item = $_REQUEST['id_item']; 
$category = $_REQUEST['category']; 
$list = $_REQUEST['list'];

switch( $category ){

case 1: 
	$cat_name = 'phonecards';
	break;
case 2: 
	$cat_name = 'coins';
	break;	
case 3: 
	$cat_name = 'banknotes';
	break;	
}

if ( $user and $id_item and $list ){
	$sql = 'SELECT * FROM '.$cat_name.'_users WHERE id_users = '.$user.' AND id_'.$cat_name.' = '.$id_item.' AND id_lists = '.$list;
	$cursor = mysql_query($sql);
	
	if ($num = mysql_num_rows($cursor)) {
		
		$datos = mysql_fetch_array($cursor);
		
		$run = 'DELETE FROM '.$cat_name.'_users WHERE id_users = '.$user.' AND id_'.$cat_name.' = '.$id_item.' AND id_lists = '.$list;
		mysql_query($run);
		
		echo 'false$'.$num;
		
	}else{
		
		$run = 'INSERT INTO '.$cat_name.'_users (id_users,id_'.$cat_name.',id_lists) VALUES ('.$user.','.$id_item.','.$list.')';
		mysql_query($run);
		
		echo 'true';
	
	}
}
else{
	
	if ( !$user )
		echo "false$<div class='list-row'>".$lang['debes_iniciar_sesion']."</div>";
	else{
		echo "false$<div class='list-row'>".$lang['error']."</div>";
	}
	
}

?>
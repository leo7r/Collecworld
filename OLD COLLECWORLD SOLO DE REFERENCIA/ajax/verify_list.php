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
$category = $_REQUEST['category'];
$item_id = $_REQUEST['item_id']; 
$list = $_REQUEST['list'];

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

if ( $user and $item_id and $list ){

	$sql = 'SELECT * FROM '.$category_var.'_users WHERE id_users = '.$user.' AND id_'.$category_var.' = '.$item_id.' AND id_lists = '.$list;	
	$cursor = mysql_query($sql);
	
	if ($num = mysql_num_rows($cursor)) {
		echo $num;		
	}else{		
		echo 'true';	
	}
}
else{
	if ( !$user )
		echo "error$".$lang['debes_iniciar_sesion']." ";
	else{
		echo "error$".$lang['error']." ";
	}	
}

?>
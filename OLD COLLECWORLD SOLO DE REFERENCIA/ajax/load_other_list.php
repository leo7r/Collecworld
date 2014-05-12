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
$item_id = $_REQUEST['item_id'];

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

if ( $_SESSION['id_users'] ){
	
	$sql = "SELECT * FROM lists WHERE id_users = ".$_SESSION['id_users']." AND id_categories = ".$category;
	$cursor = mysql_query($sql);
	
	$num = mysql_num_rows($cursor);
	
	if($num){
		
		$lists = "<div id='modal-close' class='close-note' title='".$lang['cerrar']."' onClick='CloseOtherList()'></div>
<br>";
		$i=1;
		while($datos = mysql_fetch_array($cursor)){
			if (($i % 2) == 1){
				$color = '#ddd';
			}else{
				$color = '#f5f5f5';			
			}
			
			$list = "SELECT id_lists FROM ".$cat_name."_users WHERE id_users = ".$_SESSION['id_users']." AND id_lists = ".$datos['id_lists']." AND id_".$cat_name." = ".$item_id;
			
			$cursor_list = mysql_query($list);

			$num_list = mysql_num_rows($cursor_list);
			
			if($num_list){
			
				$lists .= "<div class='list-row have-this-in-list' id='list".$datos['id_lists']."'><div style='float:left';><input id='check".$datos['id_lists']."' type='checkbox' checked='checked' onClick='addItemOtherList(".$category.",".$datos['id_lists'].",".$item_id.")' /></div><div class='list-name'>".$datos['name']."</div><div style='clear:both'></div></div>";
			
			}else{
				
				$lists .= "<div class='list-row' style='background-color:".$color."' id='list".$datos['id_lists']."'><div style='float:left';><input id='check".$datos['id_lists']."' type='checkbox' onClick='addItemOtherList(".$category.",".$datos['id_lists'].",".$item_id.")'/></div><div class='list-name'>".$datos['name']."</div><div style='clear:both'></div></div>";
				
			}
			
			$i++;
		}
		
		echo $lists;
		
	}else{
		
		echo "error$<div class='list-row'>".$lang['no_tienes_listas']."</div>";
		
	}
	
}else{
	
	if ( !$_SESSION['id_users'] )
		echo "error$<div class='list-row'>".$lang['debes_iniciar_sesion']."</div>";
	else{
		echo "error$<div class='list-row'>".$lang['error']."</div>";
	}
	
}

?>
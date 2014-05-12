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

$container_id = $_REQUEST['container_id'];
$category = $_REQUEST['category'];
$list = $_REQUEST['list'];
$item_id = $_REQUEST['item_id'];
$type = $_REQUEST['type'];
$num_items = $_REQUEST['num_items'];
$list_name = '';

switch($list){

	case 1: 
		$list_name = $lang['coleccion'];
		break;
	case 2:
		$list_name = $lang['deseo'];
		break;
	case 3:
		$list_name = $lang['intercambio'];
		break;
	case 5:
		$list_name = $lang['venta'];
		break;
}

?>

<div id='modal-close' class='close-note' title='"+translation.cerrar+"' onClick='CloseOtherList();'></div>
<p style='color:#000;'>¿Do you want delete <?php echo $num_items; ?> articles from <?php echo $list_name; ?>?</p>
<span style='float:left' class='google-button ' onclick='CloseOtherList();'><?php echo $lang['cancelar']; ?></span>
<span style='float:right' class='google-button google-button-red' onclick="DeleteFromList('<?php echo $container_id; ?>',<?php echo $category; ?>,<?php echo $list; ?>,<?php echo $item_id; ?>,<?php echo $type; ?>);"><?php echo $lang['eliminar']; ?></span>


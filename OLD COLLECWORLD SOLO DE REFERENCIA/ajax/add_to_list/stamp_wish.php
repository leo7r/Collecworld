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
$item_id = $_REQUEST['item_id'];
$type = $_REQUEST['type'];

?>
<div id='modal-close' class='close-note' title="<?php echo $lang['cerrar']; ?>" onClick="CloseOtherList()"></div>
<br>
<div id="alert"></div>
<input type="text" id="note" class="note-input" placeholder="<?php echo $lang['escribe_una_nota']; ?>" autofocus />
<br><br>
<span style="float:right" class="google-button google-button-blue" onclick="save_note('<?php echo $container_id; ?>',4,<?php echo $item_id; ?>,2,<?php echo $type; ?>, 1);"><?php echo $lang['listo']; ?></span>
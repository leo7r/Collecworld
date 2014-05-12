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
<select id="status" class="note-select" >
	<option value=""><?php echo $lang['estado_tarjeta']; ?></option>
	<option value="New"><?php echo $lang['nueva']; ?></option>
	<option value="Used (Perfect)"><?php echo $lang['usada_perfecta']; ?></option>
	<option value="Used (Good)"><?php echo $lang['usada_buena']; ?></option>
	<option value="Used (Damaged)"><?php echo $lang['usada_danada']; ?></option>
</select>
<input type="text" id="price" class="note-input" style="width:50px;" placeholder="<?php echo $lang['precio']; ?>" />
<select id="currencies" class="note-select" />
<br><br>
<div id="feedback-content-middle">
	<span class="google-button" onclick="$('#image-note').click();" ><?php echo $lang['imagen']; ?></span>
	<span id="feedback-file-name"></span>
</div>
<br>
<input style="display:none;" type="file" id="image-note" name="image-note" onchange="feedback_file(this);" accept="image/*" />
<br>
<span style="float:left" class="google-button google-button-red" onclick="save_note('<?php echo $container_id; ?>',3,<?php echo $item_id; ?>,5,<?php echo $type; ?>, 0)"><?php echo $lang['agregar_otra']; ?></span>
<span style="float:right" class="google-button google-button-blue" onclick="save_note('<?php echo $container_id; ?>',3,<?php echo $item_id; ?>,5,<?php echo $type; ?>, 1);"><?php echo $lang['listo']; ?></span>			

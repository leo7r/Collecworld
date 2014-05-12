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

$id_user = $_REQUEST['u'];
$cat = $_REQUEST['cat'];

$sql = 'SELECT * FROM lists WHERE id_users = '.$id_user.' AND id_categories = '.$cat.' AND status = 0';
$cursor = mysql_query($sql);

?>
<option value="-1" selected="selected" ><?php echo $lang['seleccione']; ?></option>
<option value="<?php echo $cat; ?>,1"><?php echo $lang['coleccion']; ?></option>
<option value="<?php echo $cat; ?>,2"><?php echo $lang['deseo']; ?></option>
<option value="<?php echo $cat; ?>,3"><?php echo $lang['intercambio']; ?></option>
<option value="<?php echo $cat; ?>,5"><?php echo $lang['venta']; ?></option>
<?php
	for ( $i=0 ; $i < mysql_num_rows($cursor) ; $i++ ){
		$datos = mysql_fetch_array($cursor);
										
		?>
		<option value="<?php echo $cat; ?>,<?php echo $datos['id_lists']; ?>"><?php echo $datos['name']; ?></option>
		<?php
	}
?>
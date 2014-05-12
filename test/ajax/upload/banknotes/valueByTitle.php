<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 
	
$id_t = $_REQUEST['title'];

$sql = 'SELECT * FROM banknotes_value WHERE id_banknotes_title = '.$id_t;
//echo $sql;
$cursor = mysql_query($sql);
?>

<select id="value" name="value" onchange="setSubTitle(this);">
	<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
	<?php
					
		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
			$datos = mysql_fetch_array($cursor);
			echo '<option value="'.$datos['id_banknotes_value'].'" >'.$datos['name'].'</option>';
		}
	?>
</select>
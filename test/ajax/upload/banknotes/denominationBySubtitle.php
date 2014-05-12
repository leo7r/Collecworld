<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 
	
$id_s = $_REQUEST['subtitle'];

$sql = 'SELECT * FROM banknotes_denomination bd, banknotes_subtitle_denomination bsd WHERE bsd.id_banknotes_subtitle = '.$id_s.' AND bsd.id_banknotes_denomination = bd.id_banknotes_denomination GROUP BY bd.id_banknotes_denomination ';
//echo $sql;
$cursor = mysql_query($sql); 
?>

<select id="denomination" name="denomination" onChange="setValue(this);" >
	<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option> 
	<?php
					
		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
			$datos = mysql_fetch_array($cursor);
			echo '<option value="'.$datos['id_banknotes_denomination'].'" >'.$datos['name'].'</option>';
		}
	?>
</select>
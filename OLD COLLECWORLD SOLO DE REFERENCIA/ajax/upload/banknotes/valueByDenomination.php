<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 
	
$id_d = $_REQUEST['denomination'];

$sql = 'SELECT * FROM banknotes_value bv, banknotes_denomination_value bdv WHERE bdv.id_banknotes_denomination = '.$id_d.' AND bdv.id_banknotes_value = bv.id_banknotes_value GROUP BY bv.id_banknotes_value';
//echo $sql;
$cursor = mysql_query($sql); 
?>

<select id="value" name="value" >
	<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option> 
	<?php
					
		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
			$datos = mysql_fetch_array($cursor);
			echo '<option value="'.$datos['id_banknotes_value'].'" >'.$datos['name'].'</option>';
		}
	?>
</select>
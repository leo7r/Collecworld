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

$sql = 'SELECT * FROM coins_denomination cd, coins_subtitle_denomination csd WHERE csd.id_coins_subtitle = '.$id_s.' AND csd.id_coins_denomination = cd.id_coins_denomination GROUP BY cd.id_coins_denomination ';
//echo $sql;
$cursor = mysql_query($sql); 
?>

<select id="denomination" name="denomination" onChange="setValue(this);" >
	<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option> 
	<?php
					
		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
			$datos = mysql_fetch_array($cursor);
			echo '<option value="'.$datos['id_coins_denomination'].'" >'.$datos['name'].'</option>';
		}
	?>
</select>
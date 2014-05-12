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

$sql = 'SELECT * FROM coins_value cv, coins_denomination_value cdv WHERE cdv.id_coins_denomination = '.$id_d.' AND cdv.id_coins_value = cv.id_coins_value GROUP BY cv.id_coins_value';
//echo $sql;
$cursor = mysql_query($sql); 
?>

<select id="value" name="value" >
	<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option> 
	<?php
					
		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
			$datos = mysql_fetch_array($cursor);
			echo '<option value="'.$datos['id_coins_value'].'" >'.$datos['name'].'</option>';
		}
	?>
</select>
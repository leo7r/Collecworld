<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 
	
$id_c = $_REQUEST['country'];

$sql = 'SELECT * FROM phonecards_companies WHERE id_countries = '.$id_c;
//echo $sql;
$cursor = mysql_query($sql);
?>

<select id="companies" name="companies" onchange="setSerie(this);">
	<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
	<?php
					
		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
			$datos = mysql_fetch_array($cursor);
			echo '<option value="'.$datos['id_phonecards_companies'].'" >'.$datos['name'].'</option>';
		}
	?>
</select>
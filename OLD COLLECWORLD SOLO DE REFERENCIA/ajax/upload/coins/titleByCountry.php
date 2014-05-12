<?php

$category=$_REQUEST['category'];

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 
	
$id_c = $_REQUEST['country'];

$sql = 'SELECT * FROM coins_title WHERE id_countries = '.$id_c;
//echo $sql;
$cursor = mysql_query($sql);
?>

<select id="title" name="title" onchange="setSubtitle(this);">
	<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
	<?php
				$datos = mysql_fetch_array($cursor);	
		for ($i=0 ; $i <$datos ; $i++){
			
			echo '<option value="'.$datos['id_coins_title'].'" >'.$datos['name'].'</option>';
			$datos = mysql_fetch_array($cursor);
		}
	?>
</select>
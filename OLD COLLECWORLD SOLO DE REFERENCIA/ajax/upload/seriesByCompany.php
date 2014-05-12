<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$id_c = $_REQUEST['company'];

$sql = 'SELECT * FROM phonecards_series WHERE id_phonecards_companies = '.$id_c;
//echo $sql;
$cursor = mysql_query($sql);
?>

<select id="serie" name="serie" style="width:150px;">
	<option selected="selected" value="-1">Select</option>
	<?php
					
		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
			$datos = mysql_fetch_array($cursor);
			echo '<option value="'.$datos['id_phonecards_series'].'" >'.$datos['name'].'</option>';
		}
	?>
</select>
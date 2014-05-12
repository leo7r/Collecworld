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

$sql = 'SELECT * FROM currencies WHERE id_countries = '.$id_c;
//echo $sql;
$cursor = mysql_query($sql);
?>

<select id="currency" name="currency">
	<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
	<?php
					
		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
			$datos = mysql_fetch_array($cursor);
			echo '<option value="'.$datos['id_currencies'].'" >'.$datos['name'].'</option>';
		}
	?>
</select>

<script>
	var g_currency = $(document).getUrlParam("cur");
	var saveInfo = $(document).getUrlParam("sav");
	
	c_input = document.getElementById("currency");
	opts = c_input.getElementsByTagName('option');
	
	for ( i=0 ; i< opts.length ; i++ ){
		
		if ( opts[i].value == g_currency.toString() ){
			c_input.selectedIndex = i;
			break;
		}
	}
	
	if ( saveInfo==1 ){
		$("#currency").prop('disabled',true);
	}
</script>
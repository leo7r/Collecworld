<?php


if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$sys = $_REQUEST['system'];
$cou = $_REQUEST['country'];

if ( !$sys || !$cou ){
	echo 'error';
	return;
}

?>

<table id="variation1_table" style="margin:0;">

	<?php
	
	$stype = 'SELECT ps.* FROM phonecards_systems ps , phonecards_systems_countries psc WHERE ps.id_system = '.$sys.' AND psc.id_countries = '.$cou.' AND psc.id_phonecards_systems = ps.id_phonecards_systems ORDER BY ps.order_number , ps.name ASC';
	$scursor = mysql_query($stype);
	
	if ( mysql_num_rows($scursor) == 0 ){
	
		$stype = 'SELECT * FROM phonecards_systems ps WHERE ps.id_system = '.$sys.' ORDER BY ps.order_number , ps.name ASC';
		$scursor = mysql_query($stype);
	}
	
	for ($i=0 ; $i < mysql_num_rows($scursor) ; $i++){
		$sdatos = mysql_fetch_array($scursor);
		?>
		
		<tr <?php echo $i % 2 == 0 ? '':'class="odd"'; ?> >
			<td><input onchange="allowOne('variation1_list',this);" type="checkbox" value="<?php echo $sdatos['id_phonecards_systems']; ?>" name="sys_type<?php echo $i; ?>" /></td>
			<td><?php echo $sdatos['name']; ?></td>
			<td>
				<img class="variation_table_images" src="<?php echo $path.'upload/'.$sdatos['image']; ?>" onmouseover="showInfo3(this,0,<?php echo $sdatos['id_phonecards_systems']; ?>,1);" />
			</td>
		</tr>
		<?php
	}
		?>
	
	<input type="hidden" value="" id="var1" name="var1" />
	
</table>
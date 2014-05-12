<?php
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 


$id = $_REQUEST['id'];

$sql = 'SELECT * FROM phonecards WHERE id_phonecards = '.$id;
$cursor = mysql_query($sql);

if ( !mysql_num_rows($cursor) ){
	die('error');
}

$pc = mysql_fetch_array($cursor);

session_start();
?>
<div>
	<ul id="show-tabs">
		<li class="box1" onClick="showPhonecardTab(0,<?php echo $id; ?>);"><?php echo $lang['informacion']; ?></li>
		<li class="box1" onClick="showPhonecardTab(1,<?php echo $id; ?>);"><?php echo $lang['coleccionistas']; ?></li>
		<li class="box1 selected" onClick="showPhonecardTab(2,<?php echo $id; ?>);"><?php echo $lang['relacionadas']; ?></li>
		<li class="box1" onClick="showPhonecardTab(3,<?php echo $id; ?>);"><?php echo $lang['comentarios']; ?></li>
	</ul>
</div>
<div id="related-pc">
	<table cellpadding="3" cellspacing="0">
		<?php
		$related = 'SELECT p.* , c.name as company FROM phonecards p , phonecards_companies c WHERE c.id_phonecards_companies = p.id_phonecards_companies AND p.id_phonecards_companies = '.$pc['id_phonecards_companies'].' AND p.id_phonecards_series = '.$pc['id_phonecards_series'].' AND p.name <> "'.$pc['name'].'" AND id_phonecards_systems = '.$pc['id_phonecards_systems'].' AND p.not_emmited = '.$pc['not_emmited'].' AND p.especial = '.$pc['especial'].' GROUP BY p.name ORDER BY order_date';
		$res0 = mysql_query($related);
		$i = 0;
		
		while ( $related = mysql_fetch_array($res0) ){
			
			if ( $i % 3 == 0 ){
				echo '<tr>';
			}
			?>
			<td>
				<img title="<?php echo $related['name']; ?>" src="<?php echo $path.'upload/img/'.$related['image']; ?>" <?php echo $related['vertical_anverse'] == 1 ? 'width="64" height="85"' : 'width="85" height="64"' ?> onclick="modalPhonecard(<?php echo $related['id_phonecards']; ?>);" />
			</td>
			<?php
			
			if ( $i % 3 == 2 ){
				echo '</tr>';
			}
			
			$i++;
		}
		?>
	</table>
</div>

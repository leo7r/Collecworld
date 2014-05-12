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

$sql = 'SELECT * FROM coins WHERE id_coins = '.$id;
$cursor = mysql_query($sql);

if ( !mysql_num_rows($cursor) ){
	die('error');
}

$pc = mysql_fetch_array($cursor);

session_start();
?>
<div>
	<ul id="show-tabs">
		<li class="box1" onClick="showCoinTab(0,<?php echo $id; ?>);"><?php echo $lang['informacion']; ?></li>
		<li class="box1" onClick="showCoinTab(1,<?php echo $id; ?>);"><?php echo $lang['coleccionistas']; ?></li>
		<li class="box1 selected" onClick="showCoinTab(2,<?php echo $id; ?>);"><?php echo $lang['relacionadas']; ?></li>
		<li class="box1" onClick="showCoinTab(3,<?php echo $id; ?>);"><?php echo $lang['comentarios']; ?></li>
	</ul>
</div>
<div id="related-pc">
	<table cellpadding="3" cellspacing="0">
		<?php
		$related = 'SELECT c.*, cv.name as name FROM coins c, coins_value cv WHERE c.id_coins_title = '.$pc['id_coins_title'].' AND c.id_coins != '.$pc['id_coins'].' and c.id_coins_value = cv.id_coins_value GROUP BY c.id_coins ORDER BY c.issued_on';
		$res0 = mysql_query($related);
		$i = 0;
		
		while ( $related = mysql_fetch_array($res0) ){
			
			if ( $i % 3 == 0 ){
				echo '<tr>';
			}
			?>
			<td>
            	<?php if ($related['image']!=''){ ?>
				<img title="<?php echo $related['name']; ?>" src="<?php echo $path.'upload/coin/'.$related['image']; ?>" <?php echo $related['vertical_anverse'] == 1 ? 'width="64" height="85"' : 'width="85" height="64"' ?> onclick="modalCoin(<?php echo $related['id_coins']; ?>);" />
                <?php }else{ ?>
                <img title="<?php echo $related['name']; ?>" src="<?php echo $path; ?>img/default_coin.jpg" <?php echo $related['vertical_anverse'] == 1 ? 'width="64" height="85"' : 'width="85" height="64"' ?> onclick="modalCoin(<?php echo $related['id_coins']; ?>);" />
                
                <?php } ?>
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

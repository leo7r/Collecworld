<div id="explore-in">

<script>

$(document).ready(function(){
	$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
	$('#modal-close').click(function(){
		$("#lean_overlay").click();
	});
	
	$(".explore-item-info").hover(
		function () {
			$(this).animate({opacity:1},150);
		},
		function () {
			$(this).animate({opacity:0},400);
		}
	);
	
});

function modalPhonecard( _p ){

	$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,backs:'../'},function(){
		$("#modalP").click();
	});

}


function modalTradePhonecard( p , trade_type ){
	$("#modal-phonecard").load(path+'ajax/showTradePhonecard.php',{p:p,type:trade_type,button:1},function(){
		$("#modalP").click();
	});
	
	
}

</script>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>

<?php

$compare_title['wish'] = $this->lang->line('comparar_deseo').' '.$compareTo['name']; 
$compare_title['sell'] = $this->lang->line('comparar_ventas').' '.$compareTo['name'];


?>

<div class="title4"><?php echo $compare_title[$method]; ?></div>

<?php

if (count($compare[$method])==0){
	echo "<h1>".$this->lang->line("no_existe_tajetas")."</h1>";

}

for ( $i=0 ; $i < count($compare[$method]) ; $i++ ){
	
	if ( $i % 3 == 0 ){
		
		$vertical0 = $compare[$method][$i]['vertical_anverse'] == 1;
		
		if ( $i+1 < count($compare[$method]) ){
			$vertical1 = $compare[$method][$i+1]['vertical_anverse'] == 1;
		}
		if ( $i+2 < count($compare[$method]) ){
			$vertical2 = $compare[$method][$i+2]['vertical_anverse'] == 1;
		}
		
		$bool = $vertical0;
		
		if ( isset($vertical1) )
			$bool = $bool or $vertical1;
		if ( isset($vertical2) )
			$bool = $bool or $vertical2;
		
		?>
		<div class="item-content" <?php if ( !$bool ) echo 'style="height:270px;"' ?> >
		<?php
	}

	if ( $_SESSION['id_users'] ){
		$lists = "select id_lists from phonecards_users WHERE id_users = ".$_SESSION['id_users']." AND id_phonecards = ".$compare[$method][$i]['id_phonecards'];
		$cursor4 = mysql_query($lists);
		$list = '';
		for ($j=0 ; $j < mysql_num_rows($cursor4) ; $j++){
			$pcs = mysql_fetch_row($cursor4);
			$list = $list.' '.$pcs[0].' ';
		}	
	}
	
	?>
		<div class="explore-item" >
			
			<div class="explore-item-title" onClick="modalPhonecard(<?php echo $compare[$method][$i]['id_phonecards']; ?>);">
				<?php echo trimm($compare[$method][$i]['Name'],60); ?>
			</div>
			<div onClick="modalPhonecard(<?php echo $compare[$method][$i]['id_phonecards']; ?>);">
				<div id="item_i<?php echo $i; ?>" class="explore-item-info" style="opacity:0;">
				<table cellpadding="7">
					<tr>
						<td><strong><?php echo $this->lang->line('pais'); ?>:</strong><td>
						<td><?php echo trimm($compare[$method][$i]['Country'],17); ?></td>
					</tr>
					<tr>
						<td><strong><?php echo $this->lang->line('compania'); ?>:</strong><td>
						<td><?php echo trimm($compare[$method][$i]['Company'],17); ?></td>
					</tr>
					<tr>
						<td><strong><?php echo $this->lang->line('serie'); ?>:</strong><td>
						<td><?php echo trimm($compare[$method][$i]['Serie'],17); ?></td>
					</tr>
					<tr>
						<?php
							if ( $compare[$method][$i]['issued_on'] ){
								?>
								<td><strong><?php echo $this->lang->line('emitida'); ?>:</strong><td>
								<td><?php echo $compare[$method][$i]['issued_on']; ?></td>
								<?php
							}
							else{
								if ( $compare[$method][$i]['known_date'] ){
								?>
									<td><strong><?php echo $this->lang->line('fecha_conocida'); ?>:</strong><td>
									<td><?php echo $compare[$method][$i]['known_date']; ?></td>
								<?php
								}
								else{
									if ( $compare[$method][$i]['exp_date'] ){
									?>
										<td><strong><?php echo $this->lang->line('fecha_vencimiento'); ?>:</strong><td>
										<td><?php echo $compare[$method][$i]['exp_date']; ?></td>
									<?php
									}
								}
							}
						?>
					</tr>
					<tr>
						<td><strong><?php echo $this->lang->line('sistema'); ?>:</strong><td>
						<td>
							<?php
								switch ( $compare[$method][$i]['System'] ){
									case 1:
										echo $this->lang->line('chip');
										break;
									case 2:
										echo $this->lang->line('banda_magnetica');
										break;
									case 3:
										echo $this->lang->line('sistema_optico');
										break;
									case 4:
										echo $this->lang->line('memoria_remota');
										break;
									case 5:
										echo 'Induced system';
										break;
									default:
										echo $this->lang->line('explore_phonecards_desconocido');
										break;
								}
							?>
						</td>
					</tr>
				</table>
				</div>
				<div style="text-align:center;">
					<img src="<?php echo $compare[$method][$i]['image'] ? base_url().'upload/img/'.$compare[$method][$i]['image'] : base_url().'img/default_phonecard.jpg'; ?>" 
					height="<?php if ( intval($compare[$method][$i]['vertical_anverse']) == 1 ) echo '305'; else echo '194'; ?>" width="<?php if ( intval($compare[$method][$i]['vertical_anverse']) == 1 ) echo '194'; else echo '305'; ?>" />
				</div>
			</div>
				
				<div class="item-foot">
					
					<div class="item-code">
						<span class="code-num"><?php echo $compare[$method][$i]['code']; ?></span>
					</div>
					
					<div class="item-control" >
						<img onClick="modalTradePhonecard(<?php echo$compare[$method][$i]['id_phonecards_users'] ?>,35);" src="<?php echo base_url(); ?>img/buy<?php if ( strpos($list,'4') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'4') ) echo 'checked'; ?>"   title="<?php echo $this->lang->line('compro_esta'); ?>" />
					</div>
				</div>
			</div>
	<?php
	
	if ( $i % 3 == 2 or $i == (count($compare[$method])-1)  )
		echo '</div>';
}
?>

<?php
function trimm( $str , $num ){
	
	if ( strlen($str) > $num ){
		$ret = substr($str,0,$num);
		$ret = $ret.'...';
		return $ret;
	}
	
	return $str;
}
?>
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

</script>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>

<?php

for ( $i=0 ; $i < count($phonecards) ; $i++ ){
	
	if ( $i % 3 == 0 ){
		
		$vertical0 = $phonecards[$i]['vertical_anverse'] == 1;
		
		if ( $i+1 < count($phonecards) ){
			$vertical1 = $phonecards[$i+1]['vertical_anverse'] == 1;
		}
		
		if ( $i+2 < count($phonecards) ){
			$vertical2 = $phonecards[$i+2]['vertical_anverse'] == 1;
		}
		
		$bool = $vertical0;
		
		if ( isset($vertical1) )
			$bool = $bool || $vertical1;
		if ( isset($vertical2) )
			$bool = $bool || $vertical2;
		
		?>
		<div class="item-content" <?php if ( !$bool ) echo 'style="height:270px;"' ?> >
		<?php
	}
	
	if ( isset($_SESSION['id_users']) ){
		$lists = "select id_lists from phonecards_users WHERE id_users = ".$_SESSION['id_users']." AND id_phonecards = ".$phonecards[$i]['id_phonecards'];
		$cursor4 = mysql_query($lists);
		$list = '';
		for ($j=0 ; $j < mysql_num_rows($cursor4) ; $j++){
			$pcs = mysql_fetch_row($cursor4);
			$list = $list.' '.$pcs[0].' ';
		}	
	}
	else{
		$list = '';
	}
	
	?>
		<div class="explore-item" >
			
			<div class="explore-item-title" onClick="modalPhonecard(<?php echo $phonecards[$i]['id_phonecards']; ?>);">
				<?php echo trimm($phonecards[$i]['Name'],60); ?>
			</div>
			<div onClick="modalPhonecard(<?php echo $phonecards[$i]['id_phonecards']; ?>);">
				<div id="item_i<?php echo $i; ?>" class="explore-item-info" style="opacity:0;">
				<table cellpadding="7">
					<tr>
						<td><strong><?php echo $this->lang->line('pais'); ?>:</strong><td>
						<td><?php echo trimm($phonecards[$i]['Country'],17); ?></td>
					</tr>
					<tr>
						<td><strong><?php echo $this->lang->line('compania'); ?>:</strong><td>
						<td><?php echo trimm($phonecards[$i]['Company'],17); ?></td>
					</tr>
					<tr>
						<td><strong><?php echo $this->lang->line('serie'); ?>:</strong><td>
						<td><?php echo trimm($phonecards[$i]['Serie'],17); ?></td>
					</tr>
					<tr>
						<?php
							if ( $phonecards[$i]['issued_on'] ){
								?>
								<td><strong><?php echo $this->lang->line('fecha_de_emision'); ?>:</strong><td>
								<td><?php echo $phonecards[$i]['issued_on']; ?></td>
								<?php
							}
							else{
								if ( $phonecards[$i]['known_date'] ){
								?>
									<td><strong><?php echo $this->lang->line('fecha_conocida'); ?>:</strong><td>
									<td><?php echo $phonecards[$i]['known_date']; ?></td>
								<?php
								}
								else{
									if ( $phonecards[$i]['exp_date'] ){
									?>
										<td><strong><?php echo $this->lang->line('fecha_vencimiento'); ?>:</strong><td>
										<td><?php echo $phonecards[$i]['exp_date']; ?></td>
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
								switch ( $phonecards[$i]['System'] ){
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
										echo $this->lang->line('sistema_inducido');
										break;
									default:
										echo $this->lang->line('desconocido');
										break;
								}
							?>
						</td>
					</tr>
				</table>
				</div>
				<div style="text-align:center;">
					<img src="<?php echo $phonecards[$i]['image'] ? base_url().'upload/img/'.$phonecards[$i]['image'] : base_url().'img/default_phonecard.jpg'; ?>" 
					height="<?php if ( intval($phonecards[$i]['vertical_anverse']) == 1 ) echo '305'; else echo '194'; ?>" width="<?php if ( intval($phonecards[$i]['vertical_anverse']) == 1 ) echo '194'; else echo '305'; ?>" />
				</div>
			</div>
				
				<div class="item-foot">
					
					<div class="item-code">
						<span class="code-num"><?php echo strtoupper($phonecards[$i]['code']); ?></span>
					</div>
					
					<div class="item-control" >
						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="location.href='<?php echo base_url(); ?>index.php/trade/phonecard/<?php  echo $phonecards[$i]['id_phonecards'];  ?>'"<?php }else{ ?>onclick="showGlobalInfo('Must be logged');"<?php } ?> src="<?php echo base_url(); ?>img/trade.png" title="<?php echo $this->lang->line('comercio_esta'); ?>" />
                        
                        <div id="wish_cont<?php echo $i; ?>">
						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,5,<?php echo $phonecards[$i]['id_phonecards']; ?>);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/sell<?php if ( strpos($list,'5') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'5') ) echo 'checked'; ?>" title="<?php echo $this->lang->line('vendo_esta'); ?>" />
                        </div>
                        
                        <div id="swap_cont<?php echo $i; ?>">
						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,3,<?php echo $phonecards[$i]['id_phonecards']; ?>);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/exchange<?php if ( strpos($list,'3') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'3') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('cambio_esta'); ?>" />
                        </div>
                        
                        <div id="sell_cont<?php echo $i; ?>">
						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,2,<?php echo $phonecards[$i]['id_phonecards']; ?>);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/seek<?php if ( strpos($list,'2') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'2') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('quiero_esta'); ?>" />
                        </div>
                        
                        <div id="col_cont<?php echo $i; ?>">
						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,1,<?php echo $phonecards[$i]['id_phonecards']; ?>);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/own<?php if ( strpos($list,'1') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'1') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('tengo_esta'); ?>" />
                        </div>
					</div>
				</div>
			</div>
	<?php
	
	if ( $i % 3 == 2 or $i == (count($phonecards)-1)  )
		echo '</div>';
}
?>

<div id="pagination">

<?php

$num_pags = $num_rows / 12;

if ( $num_pags > intval($num_pags) ){
	$num_pags = $num_pags+1;
}

// antes de la pagina seleccionada

$url = base_url().'index.php/search/phonecards/'.str_replace(' ','+',$query);

if ( $pag > 1 ){
?>
<a class="pag-button current-page" href="<?php echo $url.'/'.($pag-1); ?>" ><?php echo $this->lang->line('anterior'); ?></a>
<?php
}

for ($i=($pag-4) ; $i < $pag ; $i++ ){
	
	if ( $i > 0 ){
		?>
			<a class="pag-button" href="<?php echo $url.'/'.$i; ?>" ><?php echo $i; ?></a>
		<?php
	}
}

?>
<a class="pag-button current-page" href="<?php echo $url.'/'.$pag; ?>" ><?php echo $pag; ?></a>
<?php

// despues de la pagina seleccionada
for ($i=($pag+1) ; $i < $pag+5 ; $i++ ){
	
	if ( $i >= $num_pags )
		break;
	
	?>
		<a class="pag-button" href="<?php echo $url.'/'.$i; ?>" ><?php echo $i; ?></a>
	<?php
}

if ( $pag+1 < $num_pags ){
?>
<a class="pag-button current-page" href="<?php echo $url.'/'.($pag+1); ?>" ><?php echo $this->lang->line('siguiente'); ?></a>
<?php
}
?>	
</div>
<div id="un_pagination">
<?php
$first_pc = (($pag-1)*12)+1;
$last_pc = $first_pc-1+count($phonecards);

echo $this->lang->line('mostrando').':'.' '.$first_pc.'-'.$last_pc.' '.$this->lang->line('de').' '.strval($num_rows);
?>
</div>

</div>
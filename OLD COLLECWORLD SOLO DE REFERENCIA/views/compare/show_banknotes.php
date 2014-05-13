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

function modalBanknote( _p ){

	$("#modal-phonecard").load(path+'ajax/showbanknote.php',{p:_p,backs:'../'},function(){
		$("#modalP").click();
	});

}
function modalTradeBanknote( p , trade_type ){
	$("#modal-phonecard").load(path+'ajax/showTradeBanknote.php',{p:p,type:trade_type,button:1},function(){
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
	echo "<h1>".$this->lang->line("no_existe_Billetes")."</h1>";
}

for ( $i=0 ; $i < count($compare[$method]) ; $i++ ){
	

	if ( $_SESSION['id_users'] ){
		$lists = "select id_lists from banknotes_users WHERE id_users = ".$_SESSION['id_users']." AND id_banknotes = ".$compare[$method][$i]['id_banknotes'];
		$cursor4 = mysql_query($lists);
		$list = '';
		for ($j=0 ; $j < mysql_num_rows($cursor4) ; $j++){
			$pcs = mysql_fetch_row($cursor4);
			$list = $list.' '.$pcs[0].' ';
		}	
	}
	
	?>
		<div class="explore-item" >
			
			<div class="explore-item-title" onClick="modalBanknote(<?php echo $compare[$method][$i]['id_banknotes']; ?>);">
				<?php echo trimm($compare[$method][$i]['value'],60); ?>
			</div>
			<div onClick="modalBanknote(<?php echo $compare[$method][$i]['id_banknotes']; ?>);">
				<div id="item_i<?php echo $i; ?>" class="explore-item-info" style="opacity:0;">
				<table cellpadding="7">
					<tr>
						<td><strong><?php echo $this->lang->line('pais'); ?>:</strong><td>
						<td><?php echo trimm($compare[$method][$i]['Country'],17); ?></td>
					</tr>
					<tr>
						<td><strong><?php echo $this->lang->line('titulo'); ?>:</strong><td>
						<td><?php echo trimm($compare[$method][$i]['title'],17); ?></td>
					</tr>
					<tr>
						<td><strong><?php echo $this->lang->line('valor'); ?>:</strong><td>
						<td><?php echo trimm($compare[$method][$i]['value'],17); ?></td>
					</tr>
					                    <tr>

						<td><strong><?php echo $this->lang->line('subtitulo'); ?>:</strong><td>

						<td><?php if(isset($banknotes[$i]['subtitle'])!= ''){
									echo trimm($banknotes[$i]['subtitle'],17);
								  }else{
									echo "Ninguno";   
								  }
						?></td>

					</tr>
					<tr>

								<td><strong><?php echo $this->lang->line('emitida'); ?>:</strong><td>
								<td><?php echo $compare[$method][$i]['issued_on']; ?></td>

					</tr>
				</table>
				</div>
				<div style="text-align:center;">
					<img src="<?php echo $compare[$method][$i]['image'] ? base_url().'upload/banknotes/'.$compare[$method][$i]['image'] : base_url().'img/default_banknote.jpg'; ?>" 
					height="194" width="305"/>
				</div>
			</div>
				
				<div class="item-foot">
					
					<div class="item-code">
						<span class="code-num"><?php echo $compare[$method][$i]['id_banknotes']; ?></span>
					</div>
					
					<div class="item-control" >
						<img onClick="modalTradeBanknote(<?php echo$compare[$method][$i]['id_banknotes_users'] ?>,35);" src="<?php echo base_url(); ?>img/buy<?php if ( strpos($list,'4') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'4') ) echo 'checked'; ?>"   title="<?php echo $this->lang->line('compro_esta'); ?>" />
					</div>
				</div>
			</div>
	<?php
	
	if ( $i % 3 == 2 or $i == (count($compare[$method])-1)  )
		echo '</div>';
}
?>

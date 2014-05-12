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



function modalCoin( _p ){

	url = $("#url").val();
	url = url.split('index.php/')[1];
	
	$("#modal-coin").load(path+'ajax/showCoin.php',{p:_p,url:url},function(){

		$("#modalC").click();

	});


}



</script>



<a id="modalC" style="display:none;" rel="leanModal" href="#modal-coin">a</a>

<div id="modal-coin"></div>
<input type="hidden" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />


<?php



for ( $i=0 ; $i < count($coins) ; $i++ ){

	

	if ( $i % 3 == 0 ){

		

		$vertical0 = $coins[$i]['image'] == 1;

		

		if ( $i+1 < count($coins) ){

			$vertical1 = $coins[$i+1]['image'] == 1;

		}

		if ( $i+2 < count($coins) ){

			$vertical2 = $coins[$i+2]['image'] == 1;

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

		$lists = "select id_lists from coins_users WHERE id_users = ".$_SESSION['id_users']." AND id_coins = ".$coins[$i]['id_coins'];

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

			<div class="explore-item-title" onClick="modalCoin(<?php echo $coins[$i]['id_coins']; ?>);">

				<?php echo trimm($coins[$i]['value'],60); ?>

			</div>

			<div onClick="modalCoin(<?php echo $coins[$i]['id_coins']; ?>);">

				<div id="item_i<?php echo $i; ?>" class="explore-item-info" style="opacity:0;">

				<table cellpadding="7">

					<tr>

						<td><strong><?php echo $this->lang->line('pais'); ?>:</strong><td>

						<td><?php echo trimm($coins[$i]['Country'],17); ?></td>

					</tr>

					<tr>

						<td><strong><?php echo $this->lang->line('titulo'); ?>:</strong><td>

						<td><?php echo trimm($coins[$i]['title'],17); ?></td>

					</tr>
                    
                    <tr>

						<td><strong><?php echo $this->lang->line('valor'); ?>:</strong><td>

						<td><?php echo trimm($coins[$i]['value'],17); ?></td>

					</tr>
                    
                    <tr>

						<td><strong><?php echo $this->lang->line('subtitulo'); ?>:</strong><td>

						<td><?php //echo trimm($coins[$i]['subtitle'],17);
						echo "Ninguno"; ?></td>

					</tr>
                    
                    <tr>

						<td><strong><?php echo $this->lang->line('emitida'); ?>:</strong><td>

						<td><?php echo trimm($coins[$i]['issued_on'],17); ?></td>

					</tr>
                    
				</table>

				</div>

				<div style="text-align:center;">

					<img src="<?php echo $coins[$i]['image'] ? base_url().'upload/coins/'.$coins[$i]['image'] : base_url().'img/default_coin.jpg'; ?>" 

					height="194" width="305" />

				</div>

			</div>

				

				<div class="item-foot">

					

					<div class="item-code">

						<span class="code-num"><?php echo strtoupper($coins[$i]['id_coins']); ?></span>

					</div>

					

					<div class="item-control" >

					

                    	

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="location.href='<?php echo base_url(); ?>index.php/trade/coin/<?php  echo $coins[$i]['id_coins'];  ?>'"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/trade.png" title="<?php echo $this->lang->line('comercio_esta'); ?>" />

                        

                        <div id="wish_cont">

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,5,<?php echo $coins[$i]['id_coins']; ?>);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/sell<?php if ( strpos($list,'5') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'5') ) echo 'checked'; ?>" title="<?php echo $this->lang->line('vendo_esta'); ?>" />

                        </div>

                        

                        <div id="swap_cont">

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,3,<?php echo $coins[$i]['id_coins']; ?>);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/exchange<?php if ( strpos($list,'3') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'3') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('cambio_esta'); ?>" />

                        </div>

                        

                        <div id="sell_cont">

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,2,<?php echo $coins[$i]['id_coins']; ?>);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/seek<?php if ( strpos($list,'2') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'2') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('quiero_esta'); ?>" />

                        </div>

                        

                        <div id="col_cont<?php echo $i; ?>">

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,1,<?php echo $coins[$i]['id_coins']; ?>);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/own<?php if ( strpos($list,'1') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'1') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('tengo_esta'); ?>" />

                        </div>

					</div>
				</div>

			</div>

	<?php

	

	if ( $i % 3 == 2 or $i == (count($coins)-1)  )

		echo '</div>';

}

?>



<div id="pagination">



<?php

$num_pags = $coins_num / 12;

if ( $num_pags > intval($num_pags) ){
	$num_pags = $num_pags+1;
}

// antes de la pagina seleccionada

$url = base_url().'index.php/search/coins/'.str_replace(' ','+',$query);

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
$last_pc = $first_pc-1+count($coins);

echo $this->lang->line('mostrando').':'.' '.$first_pc.'-'.$last_pc.' '.$this->lang->line('de').' '.strval($coins_num);
?>

</div>



</div>
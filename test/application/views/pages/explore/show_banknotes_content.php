
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

	url = $("#url").val();
	url = url.split('index.php/')[1];
	
	$("#modal-banknote").load(path+'ajax/showBanknote.php',{p:_p,url:url},function(){

		$("#modalB").click();

	});


}



</script>



<a id="modalB" style="display:none;" rel="leanModal" href="#modal-banknote">a</a>

<div id="modal-banknote"></div>
<input type="hidden" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />


<?php



for ( $i=0 ; $i < count($banknotes) ; $i++ ){

	

	if ( $i % 3 == 0 ){

		

		$vertical0 = $banknotes[$i]['image'] == 1;

		

		if ( $i+1 < count($banknotes) ){

			$vertical1 = $banknotes[$i+1]['image'] == 1;

		}

		if ( $i+2 < count($banknotes) ){

			$vertical2 = $banknotes[$i+2]['image'] == 1;

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

		$lists = "select id_lists from banknotes_users WHERE id_users = ".$_SESSION['id_users']." AND id_banknotes = ".$banknotes[$i]['id_banknotes'];

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

			<div class="explore-item-title" onClick="modalBanknote(<?php echo $banknotes[$i]['id_banknotes']; ?>);">

				<?php echo trimm($banknotes[$i]['value'],10).' '.trimm($banknotes[$i]['denomination'],40); ?>

			</div>

			<div onClick="modalBanknote(<?php echo $banknotes[$i]['id_banknotes']; ?>);">

				<div id="item_i<?php echo $i; ?>" class="explore-item-info" style="opacity:0;">

				<table cellpadding="7"> 

					<tr>

						<td><strong><?php echo $this->lang->line('titulo'); ?>:</strong><td>

						<td><?php echo trimm($banknotes[$i]['title'],17); ?></td>

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

						<td><?php echo trimm($banknotes[$i]['issued_on_gre'],17); ?></td>

					</tr>
                    
				</table>

				</div>

				<div style="text-align:center;">

					<img src="<?php echo $banknotes[$i]['image'] ? base_url().'upload/banknotes/'.$banknotes[$i]['image'] : base_url().'img/default_coin.jpg'; ?>" 

					height="194" width="305" />

				</div>

			</div>

				

				<div class="item-foot">

					

					<div class="item-code">

						<span class="code-num"><?php echo strtoupper($banknotes[$i]['id_banknotes']); ?></span>

					</div>

					

					<div class="item-control" >

					

                    	

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="location.href='<?php echo base_url(); ?>index.php/trade/banknote/<?php  echo $banknotes[$i]['id_banknotes'];  ?>'"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/trade.png" title="<?php echo $this->lang->line('comercio_esta'); ?>" />

                        

                        <div id="wish_cont">

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setItemInList(this,3,5,<?php echo $banknotes[$i]['id_banknotes']; ?>,0);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/sell<?php if ( strpos($list,'5') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'5') ) echo 'checked'; ?>" title="<?php echo $this->lang->line('vendo_esta'); ?>" />

                        </div>

                        

                        <div id="swap_cont">

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setItemInList(this,3,3,<?php echo $banknotes[$i]['id_banknotes']; ?>,0);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/exchange<?php if ( strpos($list,'3') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'3') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('cambio_esta'); ?>" />

                        </div>

                        

                        <div id="sell_cont">

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setItemInList(this,3,2,<?php echo $banknotes[$i]['id_banknotes']; ?>,0);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/seek<?php if ( strpos($list,'2') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'2') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('quiero_esta'); ?>" />

                        </div>

                        

                        <div id="col_cont<?php echo $i; ?>">

						<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setItemInList(this,3,1,<?php echo $banknotes[$i]['id_banknotes']; ?>,0);"<?php }else{ ?>onclick="location.href='<?php echo base_url(); ?>index.php/login'"<?php } ?> src="<?php echo base_url(); ?>img/own<?php if ( strpos($list,'1') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'1') ) echo 'checked'; ?>"  title="<?php echo $this->lang->line('tengo_esta'); ?>" />

                        </div>

					</div>
				</div>

			</div>

	<?php

	

	if ( $i % 3 == 2 or $i == (count($banknotes)-1)  )

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



$url = base_url().'index.php/explore/banknote/'.$catalog.'/'.$country.'/'.$titleb.'/'.$subtitle.'/'.$denomination.'/'.$value.'/'.$year;

$last_piece = '';

if ( $order ){

    $last_piece = '/'.$order;

}

if ( $no_variations ){

    $last_piece = (isset($last_piece) ? $last_piece : "").'/'.'no_variations';

}



if ( $pag > 1 ){

?>

<a class="pag-button current-page" href="<?php echo $url.'/'.($pag-1).( isset($last_piece) ? $last_piece : "" ); ?>" ><?php echo $this->lang->line('anterior'); ?></a>

<?php

}



for ($i=($pag-4) ; $i < $pag ; $i++ ){

    

    if ( $i > 0 ){

        ?>

            <a class="pag-button" href="<?php echo $url.'/'.$i.( isset($last_piece) ? $last_piece : "" ); ?>" ><?php echo $i; ?></a>

        <?php

    }

}



?>

<a class="pag-button current-page" href="<?php echo $url.'/'.$pag.( isset($last_piece) ? $last_piece : "" ); ?>" ><?php echo $pag; ?></a>

<?php



// despues de la pagina seleccionada

for ($i=($pag+1) ; $i < $pag+5 ; $i++ ){

    

    if ( $i > $num_pags )

        break;

    

    ?>

        <a class="pag-button" href="<?php echo $url.'/'.$i.( isset($last_piece) ? $last_piece : "" ); ?>" ><?php echo $i; ?></a>

    <?php

}



if ( $pag+1 < $num_pags ){

?>

<a class="pag-button current-page" href="<?php echo $url.'/'.($pag+1).( isset($last_piece) ? $last_piece : "" ); ?>" ><?php echo $this->lang->line('siguiente'); ?></a>

<?php

}

?>	

</div>

<div id="un_pagination">

<?php

$first_pc = (($pag-1)*12)+1;

$last_pc = $first_pc-1+count($banknotes);



echo $this->lang->line('mostrando').' '.$first_pc.'-'.$last_pc.' '.$this->lang->line('de').' '.strval($num_rows);

?>

</div>



</div>
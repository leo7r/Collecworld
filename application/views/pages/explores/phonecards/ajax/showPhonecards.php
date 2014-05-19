<script>

	$(document).ready(function(){

		var id = <?php echo $phonecards[0]['id_phonecards']; ?>;

		$("#show-right").load(path+'showPhonecards/information/'+id);

		$("#lean_overlay").click( function(){
			$(".zoomContainer").remove();	
		});	


	});



</script>


<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.raty.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.elevateZoom-3.0.7.min.js"></script>

<div id="fb-root"></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=40975373617";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>

<div id="show-pc">

	<div id="modal-close" class="modal-close" onClick="closeSignin();">

		<img src="<?php  echo base_url(); ?>img/modal-close.png" height="16" width="16" />

	</div>

		<script>
            <?php
                if ( $phonecards[0]['image'] ){
                ?>
                $("#show-image").elevateZoom({
                  zoomType : "lens",
                  lensShape : "round",
                  lensSize    : 250
                });
                <?php	
                }
            ?>
        </script>

		<table id="showPcTable">

			<tr>

				<td valign="top">
                	
					<div id='show-left'>

						<div id="show-title"><?php echo $phonecards[0]['phonecards_name'].(strcmp($phonecards[0]['serie_number'],'0') == 0 ? '':' - '.$phonecards[0]['serie_number']); ?></div>

						<div id="show-img">

							<span class="show-img-arrow" onclick="flipImage(document.getElementById('show-image'));" >&laquo;</span>

							<img id="show-image" onclick="flipImage(this);" src="<?php echo $phonecards[0]['image'] ? base_url().'upload/img/'.$phonecards[0]['image'] : base_url().'img/default_phonecard.jpg'; ?>" height="<?php  echo '305'; ?>" width="<?php echo '194'; ?>" data-zoom-image="<?php echo $phonecards[0]['image'] ? base_url().'upload/img/'.$phonecards[0]['image'] : base_url().'img/default_phonecard.jpg'; ?>" />

							<img style="display:none;" id="show-image-rev" onclick="flipImage(this);" src="<?php echo $phonecards[0]['image_reverse'] ? base_url().'upload/img/'.$phonecards[0]['image_reverse'] : base_url().'img/default_phonecard.jpg'; ?>" height="<?php  echo '305'?>" width="<?php echo '194';?>" data-zoom-image="<?php echo $phonecards[0]['image_reverse'] ? base_url().'upload/img/'.$phonecards[0]['image_reverse'] : base_url().'img/default_phonecard.jpg'; ?>" />

							

							<span onclick="launch_upload_image();" id="upload-new-img" <?php if ( $phonecards[0]['image'] ) echo 'style="display:none;"'; ?> ><?php echo $lang['cargar_imagen']; ?></span>

							

							<form style="display:none;" id="new-image-form" action="<?php echo base_url(); ?>index.php/edit/phonecard/new_image" method="post" enctype="multipart/form-data">

								<input type="hidden" name="image-face" id="image-face" value="0" />

								<input type="hidden" id="id-pc" name="id-pc" value="<?php echo $phonecards[0]['id_phonecards']; ?>" />

								<input type="hidden" id="onFinish" name="onFinish" />

								<input style="display:none;" type="file" id="new-image" name="new-image" onchange="launch_new_image_upload(this);" />

							</form>

							<span class="show-img-arrow" onclick="flipImage(document.getElementById('show-image'));">&raquo;</span>

							

						</div>

						<div id="show-img-info"><?php echo $this->lang->line('anverso'); ?></div>

									

						<div id="pc-info">

							<div id="show-lists">

							

								<div id="show-control">

								

									<div class="show-control-pack">

										<div class="show-control-item " id="col_cont">

											<img onclick="setItemInList(this,1,1,<?php echo $phonecards[0]['id_phonecards']; ?>,1);" src="<?php echo base_url(); ?>img/own<?php  echo '2'; ?>.png" class="<?php echo 'checked'; ?>"  title="<?php echo $this->lang->line('tengo_esta'); ?>" />

											<?php echo $this->lang->line('coleccion'); ?>

										</div>

										<div class="show-control-item <?php  echo 'checked'; ?>" id="wish_cont">

											<img onclick="setItemInList(this,1,2,<?php echo $phonecards[0]['id_phonecards']; ?>,1);" src="<?php echo base_url(); ?>img/seek<?php echo '2'; ?>.png" class="<?php  echo 'checked'; ?>"  title="<?php echo $this->lang->line('quiero_esta'); ?>" />

											<?php echo $this->lang->line('deseo'); ?>

										</div>

										<div class="show-control-item <?php echo 'checked'; ?>" id="swap_cont">

											<img onclick="setItemInList(this,1,3,<?php echo $phonecards[0]['id_phonecards']; ?>,1);" src="<?php echo base_url(); ?>img/exchange<?php  echo '2'; ?>.png" class="<?php  echo 'checked'; ?>"  title="<?php echo $this->lang->line('cambio_esta'); ?>" />

											<?php echo $this->lang->line('intercambio'); ?>

										</div>

									</div>

									<div class="show-control-pack">

										<div class="show-control-item <?php  echo 'checked'; ?>" id="sell_cont">

											<img onclick="setItemInList(this,1,5,<?php echo $phonecards[0]['id_phonecards']; ?>,1);"; ?> src="<?php echo base_url(); ?>img/sell<?php  echo '2'; ?>.png" class="<?php  echo 'checked'; ?>" title="<?php echo $this->lang->line('vendo_esta'); ?>" />

											<?php echo $this->lang->line('venta'); ?>

										</div>

										<div class="show-control-item <?php  echo 'checked'; ?>" >

											<img onclick="location.href='<?php echo base_url(); ?>index.php/trade/phonecard/<?php echo $phonecards[0]['id_phonecards']; ?>'";  src="<?php echo base_url(); ?>img/trade.png"  title="<?php echo $this->lang->line('comercio_esta'); ?>" />

											<?php echo $this->lang->line('comercio'); ?>

										</div>

										<div class="show-control-item" id="other-list-box">

											<div id="other-list-icon">
				
												<img src="<?php echo base_url(); ?>img/book.png"  onclick="showOtherList(this,1,<?php echo $phonecards[0]['id_phonecards']; ?>);"  />

												<?php echo $this->lang->line('mis_listas'); ?>
                                                
											</div>

										</div>

									</div>

								</div>

							</div>

							<div id="show-social">

								<?php

									$uri = $phonecards[0]['id_phonecards'].'-'.str_replace(" ","-",$phonecards[0]['phonecards_name']);

								?> 


								<input type="hidden" id="pc-name" value="<?php echo $phonecards[0]['phonecards_name']; ?>" />

								<ul id="share-list">

									<li id="share-list-share"><?php echo $this->lang->line('compartir'); ?>: </li>

									<li onclick="fb_click();"><img src="<?php echo base_url(); ?>img/share-fb.png" width="24" height="24" /></li>

									<li onclick="tw_click();"><img src="<?php echo base_url(); ?>img/share-tw.png" width="24" height="24" /></li>

									<li onclick="gp_click();"><img src="<?php echo base_url(); ?>img/share-gp.png" width="24" height="24" /></li>

								</ul>

							</div>

						</div>

					</div>

				</td>

				<td valign="top">

					<div id='show-right'>

						

					</div>

				</td>

			</tr>

		</table>

	

</div>
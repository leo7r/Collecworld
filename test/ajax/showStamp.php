<script>


		var id = <?php echo $_REQUEST['p']; ?>;
		 
		$("#show-right").load(path+'ajax/showStamp/information.php',{id:id,url:'<?php echo $_REQUEST['url']; ?>'});

		$("#lean_overlay").click( function(){
			$(".zoomContainer").remove();	

		});
		showUploadImage();

	

</script>

<script>

function fb_click(){

	

	u=document.getElementById('share-url').value;

	t=document.title;

	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'Collecworld sharer','toolbar=0,status=0,width=626,height=436');

	

}



function tw_click(){

	

	url = document.getElementById('share-url').value;

	name = document.getElementById('pc-name').value;

	

	u = 'https://twitter.com/share?text=Collect '+name+' on Collecworld.com'+'&url=http://'+url;

	

	window.open(u,'Collecworld sharer','toolbar=0,status=0,width=626,height=436');

}



function gp_click(){

	

	url = document.getElementById('share-url').value;

	

	u = 'https://plus.google.com/share?url=http://'+url;

	

	window.open(u,'Collecworld sharer','toolbar=0,status=0,width=626,height=436');

}

</script>

<?php

function curPageURL() {

 $pageURL = 'http';

 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

 $pageURL .= "://";

 if ($_SERVER["SERVER_PORT"] != "80") {

  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

 } else {

  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

 }

 return $pageURL;

}

?>



<?php



$id = $_REQUEST['p'];


if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
}


?>

<script type="text/javascript" src="<?php echo $path; ?>js/jquery.raty.min.js"></script>
<script type="text/javascript" src="<?php echo $path; ?>js/jquery.elevateZoom-3.0.7.min.js"></script>

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

		<img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />

	</div>

	<?php

	

	//INFORMACI�N ESTAMPILLA

	

	$sql="select b.*, bv.name as value from banknotes b, banknotes_value bv where id_banknotes=".$id." AND b.id_banknotes_value = bv.id_banknotes_value";

	$cursor=mysql_query($sql);

	$num=mysql_num_rows($cursor);

	

	if($num){

		$datos=mysql_fetch_array($cursor); 

		$id_banknotes=$datos['id_banknotes'];


		?>
		<script>
            <?php
                if ( $datos['image'] ){
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

						<div id="show-title"><?php echo $datos['value'];?></div>

						<div id="show-img">

							<span class="show-img-arrow" onclick="flipImage(document.getElementById('show-image'));" >&laquo;</span>

							<img id="show-image" onclick="flipImage(this);" src="<?php echo $datos['image'] ? $path.'upload/banknotes/'.$datos['image'] : $path.'img/default_coin.jpg'; ?>" height="<?php if ( intval($datos['vertical_anverse']) == 1 ) echo '305'; else echo '194'; ?>" width="<?php if ( intval($datos['vertical_anverse']) == 1 ) echo '194'; else echo '305'; ?>" data-zoom-image="<?php echo $datos['image'] ? $path.'upload/coins/'.$datos['image'] : $path.'img/default_coin.jpg'; ?>" />

							<img style="display:none;" id="show-image-rev" onclick="flipImage(this);" src="<?php echo $datos['image_reverse'] ? $path.'upload/banknotes/'.$datos['image_reverse'] : $path.'img/default_coin.jpg'; ?>" height="<?php if ( intval($datos['vertical_reverse']) == 1 ) echo '305'; else echo '194'; ?>" width="<?php if ( intval($datos['vertical_reverse']) == 1 ) echo '194'; else echo '305'; ?>" data-zoom-image="<?php echo $datos['image_reverse'] ? $path.'upload/banknote/'.$datos['image_reverse'] : $path.'img/default_coin.jpg'; ?>" />

							

							<span onclick="launch_upload_image();" id="upload-new-img" <?php if ( $datos['image'] ) echo 'style="display:none;"'; ?> ><?php echo $lang['cargar_imagen']; ?></span>

							

							<form style="display:none;" id="new-image-form" action="<?php echo $path; ?>index.php/edit/banknote/new_image" method="post" enctype="multipart/form-data">

								<input type="hidden" name="image-face" id="image-face" value="0" />

								<input type="hidden" id="id-bn" name="id-bn" value="<?php echo $datos['id_banknotes']; ?>" />

								<input type="hidden" id="onFinish" name="onFinish" />

								<input style="display:none;" type="file" id="new-image" name="new-image" onchange="launch_new_image_upload(this);" />

							</form>

							<span class="show-img-arrow" onclick="flipImage(document.getElementById('show-image'));">&raquo;</span>

							

						</div>

						<div id="show-img-info"><?php echo $lang['anverso']; ?></div>

									

						<div id="pc-info">

							<div id="show-lists">

								<?php

									session_start();

									if ( $_SESSION['id_users'] ){

										$lists = "select id_lists from banknotes_users WHERE id_users = ".$_SESSION['id_users']." AND id_banknotes = ".$datos['id_banknotes'];

										$cursor4 = mysql_query($lists);

										$list = '';

										for ($j=0 ; $j < mysql_num_rows($cursor4) ; $j++){

											$datos4 = mysql_fetch_row($cursor4);

											$list = $list.' '.$datos4[0].' ';

										}	
										

									}

								?>

								

								<?php

									if ( $backs == '' ){

										$_backs = 'explore/';

									}

									else{

										$_backs = '../explore/';

									}

								?>

								

								<div id="show-control">

								

									<div class="show-control-pack">

										<div class="show-control-item <?php if ( strpos($list,'1') ) echo 'checked'; ?>" id="col_cont">

											<img <?php if ( $_SESSION['id_users'] ){ ?>onclick="setItemInList(this,4,1,<?php echo $datos['id_banknotes']; ?>,1);"<?php }else{ ?>onclick="location.href='<?php echo $path; ?>index.php/login'"<?php } ?> src="<?php echo $path; ?>img/own<?php if ( strpos($list,'1') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'1') ) echo 'checked'; ?>"  title="<?php echo $lang['tengo_esta']; ?>" />

											<?php echo $lang['coleccion']; ?>

										</div>

										<div class="show-control-item <?php if ( strpos($list,'2') ) echo 'checked'; ?>" id="wish_cont">

											<img <?php if ( $_SESSION['id_users'] ){ ?>onclick="setItemInList(this,4,2,<?php echo $datos['id_banknotes']; ?>,1);"<?php }else{ ?>onclick="location.href='<?php echo $path; ?>index.php/login'"<?php } ?> src="<?php echo $path; ?>img/seek<?php if ( strpos($list,'2') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'2') ) echo 'checked'; ?>"  title="<?php echo $lang['quiero_esta']; ?>" />

											<?php echo $lang['deseo']; ?>

										</div>

										<div class="show-control-item <?php if ( strpos($list,'3') ) echo 'checked'; ?>" id="swap_cont">

											<img <?php if ( $_SESSION['id_users'] ){ ?>onclick="setItemInList(this,4,3,<?php echo $datos['id_banknotes']; ?>,1);"<?php }else{ ?>onclick="location.href='<?php echo $path; ?>index.php/login'"<?php } ?> src="<?php echo $path; ?>img/exchange<?php if ( strpos($list,'3') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'3') ) echo 'checked'; ?>"  title="<?php echo $lang['cambio_esta']; ?>" />

											<?php echo $lang['intercambio']; ?>

										</div>

									</div>

									<div class="show-control-pack">

										<div class="show-control-item <?php if ( strpos($list,'5') ) echo 'checked'; ?>" id="sell_cont">

											<img <?php if ( $_SESSION['id_users'] ){ ?>onclick="setItemInList(this,4,5,<?php echo $datos['id_banknotes']; ?>,1);"<?php }else{ ?>onclick="location.href='<?php echo $path; ?>index.php/login'"<?php } ?> src="<?php echo $path; ?>img/sell<?php if ( strpos($list,'5') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'5') ) echo 'checked'; ?>" title="<?php echo $lang['vendo_esta']; ?>" />

											<?php echo $lang['venta']; ?>

										</div>

										<div class="show-control-item <?php if ( strpos($list,'4') ) echo 'checked'; ?>" >

											<img <?php if ( $_SESSION['id_users'] ){ ?>onclick="location.href='<?php echo $path; ?>index.php/trade/stamp/<?php echo $datos['id_banknotes']; ?>'"<?php }else{ ?>onclick="location.href='<?php echo $path; ?>index.php/login'"<?php } ?> src="<?php echo $path; ?>img/trade.png"  title="<?php echo $lang['comercio_esta']; ?>" />

											<?php echo $lang['comercio']; ?>

										</div>

										<div class="show-control-item" id="other-list-box">

											<div id="other-list-icon">
				
												<img src="<?php echo $path; ?>img/book.png"  <?php if ( $_SESSION['id_users'] ){ ?>onclick="showOtherList(this,3,<?php echo $datos['id_banknotes']; ?>);"<?php }else{ ?>onclick="showGlobalInfo('Must be logged');"<?php } ?>  />

												<?php echo $lang['mis_listas']; ?>
                                                
											</div>

										</div>

									</div>

								</div>

							</div>

							<div id="show-social">

								<?php

									$uri = $datos['id_banknotes'].'-'.str_replace(" ","-",$datos['value']);

								?> 
								<input type="hidden" id="share-url" value="www.collecworld.com/index.php/banknote/<?php echo $uri; ?>" />

								<input type="hidden" id="pc-name" value="<?php echo $datos['value']; ?>" />

								<ul id="share-list">

									<li id="share-list-share"><?php echo $lang['compartir']; ?>: </li>

									<li onclick="fb_click();"><img src="<?php echo $path; ?>img/share-fb.png" width="24" height="24" /></li>

									<li onclick="tw_click();"><img src="<?php echo $path; ?>img/share-tw.png" width="24" height="24" /></li>

									<li onclick="gp_click();"><img src="<?php echo $path; ?>img/share-gp.png" width="24" height="24" /></li>

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

		

		

		

	<?php

		}

	?>

</div>
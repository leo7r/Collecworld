<?php

function ago($time)

{

   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

   $lengths = array("60","60","24","7","4.35","12","10");



   $now = time();



       $difference     = $now - $time;

       $tense         = "ago";



   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {

       $difference /= $lengths[$j];

   }



   $difference = round($difference);



   if($difference != 1) {

       $periods[$j].= "s";

   }



   return "$difference $periods[$j] ago ";

}

?>

<!-- jQuery UI -->

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css" type="text/css" />



<!-- Google maps -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOLpCu5-EeM9et2fCu5309Mfo2XqNvVgE&sensor=false"></script>



<!-- Share -->

<script>

function fb_click(){

	

	u=document.getElementById('share-url').value;

	t=document.title;

	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'Collecworld sharer','toolbar=0,status=0,width=626,height=436');

	

}



function tw_click(){

	

	url = document.getElementById('share-url').value;

	

	u = 'https://twitter.com/share?text=View event "<?php echo $event['name']; ?>" on Collecworld.com'+'&url=http://'+url;

	

	window.open(u,'Collecworld sharer','toolbar=0,status=0,width=626,height=436');

}



function gp_click(){

	

	url = document.getElementById('share-url').value;

	

	u = 'https://plus.google.com/share?url=http://'+url;

	

	window.open(u,'Collecworld sharer','toolbar=0,status=0,width=626,height=436');

}



function invite_all(){

	$("#event-invite-friends input:checkbox").prop('checked',true);

}

</script>





<!--To Start-->

<script type="text/javascript">

	

	$(document).ready(function(){

		

		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });

		$('#modal-close').click(function(){

			$("#lean_overlay").click();

		});

		

		setPlaceHolder('event-new-comment');

		

	});

	

	var map;

	var geocoder;

	

	function initialize() {

		geocoder = new google.maps.Geocoder();

		

		var mapOptions = {

		  zoom: 17,

		  mapTypeId: google.maps.MapTypeId.ROADMAP

		}

		map = new google.maps.Map(document.getElementById("event-map"), mapOptions);

		

		codeAddress("<?php echo $event['place']; ?>");

	}

	

	function codeAddress( address ) {

	

		geocoder.geocode( { 'address': address}, function(results, status) {

		  if (status == google.maps.GeocoderStatus.OK) {

			map.setCenter(results[0].geometry.location);

			

			var latitude = results[0].geometry.location.toString();

			ll = latitude.split(',');

			lat = ll[0].replace('(','').replace(' ','');

			long = ll[1].replace(')','').replace(' ','');

			

			document.getElementById("extend_map").href = 'https://maps.google.com/maps?ll='+lat+','+long+'&z=17&t=m&hl=es&mapclient=apiv3';

			

			var marker = new google.maps.Marker({

				map: map,

				position: results[0].geometry.location

			});

		  } else {

			//alert("Geocode was not successful for the following reason: " + status);

			$("#event-map").html('<img src="<?php echo base_url(); ?>img/no_place.jpg" />');

			$("#extend_map_div").remove();

		  }

		});

	  }

	  

	function send_comment(){

		comment = $("#event-new-comment").val();

		

		if ( comment.length < 5 || comment == 'Write your comment' ){

			showGlobalInfo('Your comment is too short');

			return;

		}

		

		evnt = $("#event-id").val();

		div = document.createElement('div');

		$(div).load(path+'ajax/event/send_comment.php',{comment:comment,evnt:evnt},function(){

			$("#event-new-comment").val('');

			

			if ( div.innerHTML.search('ok') != -1 ){

				location.reload(true);

			}

		

		});

		

	}

	

	google.maps.event.addDomListener(window, 'load', initialize);

	

</script>



<!-- Google -->

<script type="text/javascript">

	

	function google1(){

		var _gaq = _gaq || [];

		_gaq.push(['_setAccount', 'UA-35549594-1']);

		_gaq.push(['_trackPageview']);

		

		(function() {

			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

		})();

	}

	

	function googleTranslateElementInit() {

		new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');

	}

	

	$(window).ready(function(){

		setTimeout(function(){

			google1();

		},1000);

	});

	

</script>

<div id="content">

	<div id="toolbar">

		<div class="in">

			<div id="toolbar-left">

				<div class="item location">

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('evento'); ?> <b><?php echo $event['name']; ?></b></a>&nbsp;&raquo;

				</div>

			</div>

			

			<?php

			if ( isset($_SESSION['user']) ){

			?>

			

			<div id="user-in" >

				<div class="separator-left"></div>

				

				<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png" <?php if ( isset($_SESSION['user']) ) echo 'onclick="launchMenu();"'; ?> />

				

				<span id="user-name">

					<?php 

						echo $_SESSION['name'];

												

						if ( $notifications ){

							?>

							<span class="notification-out">

								<a href="<?php echo base_url(); ?>index.php/account/#sec=4">

									<span title="<?php echo $this->lang->line('nueva_notificacion'); ?>" class="notification"><?php echo count($notifications); ?></span>

								</a>

							</span>

							<?php

						}

					?>

				</span>

				

				<img height="35" width="35" id="user-image" alt="user image" src="<?php echo base_url(); ?>users/img/<?php echo $_SESSION['img']; ?>" />	

			</div>

		<?php

			}

			else{

		?>

			<div id="signin">

				<a id="go" rel="leanModal" href="#modal-signin" class="google-button google-button-blue"><?php echo $this->lang->line('iniciar_sesion'); ?></a>

			</div>

		

		<?php

			}

		?>

			

		</div>

	</div>

						

	<div id="modal-signin">

		<script>

			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php');

		</script>					

	</div>

	

	<div id="content-in">

		<div class="box1" id="event-container">

			<div class="title4">

				<?php 

					echo $event['name'];

					if ( isset($_SESSION['id_users']) && $_SESSION['id_users'] == $event['id_users'] ){

						?>

							<a class="google-button" href="<?php echo base_url(); ?>index.php/event/edit/<?php echo $event['id_events']; ?>"><?php echo $this->lang->line('event_editar_evento'); ?></a>

						<?php

					}

					

					if ( $event['private'] == 0 ){

						?>

						<a href="#invite-friends" id="event-invite" class="google-button google-button-green" onclick="invite_friends()"><?php echo $this->lang->line('invitar_amigos'); ?></a>

						<?php

					}		

				?>

				

			</div>

			<table>

				<tr>

					<td valign="top">

						<div id="event-map">

						

						</div>

                        <div id="extend_map_div">

                        	<a id="extend_map" target="_blank"><?php echo $this->lang->line('event_expandir_mapa'); ?></a>

                        </div>

						<?php

							if ( $event['private'] == 0 ){

							?>

							<div id="event-share">

								<ul id="share-list">

									<li id="share-list-share"><?php echo $this->lang->line('compartir'); ?>: </li>

									<li onclick="fb_click();"><img src="<?php echo base_url(); ?>img/share-fb.png" width="24" height="24" /></li>

									<li onclick="tw_click();"><img src="<?php echo base_url(); ?>img/share-tw.png" width="24" height="24" /></li>

									<li onclick="gp_click();"><img src="<?php echo base_url(); ?>img/share-gp.png" width="24" height="24" /></li>

								</ul>

								<input type="hidden" id="share-url" value="www.collecworld.com/index.php/event/<?php echo $event['id_events'].'-'.$event['name']; ?>" />

								<input type="hidden" id="event-id" value="<?php echo $event['id_events']; ?>" />

							</div>

							<?php

							}

						?>

					</td>

					<td valign="top">

						<table cellpadding="5">

							<tr>

								<td class="title31"><?php echo $this->lang->line('organizador'); ?>: </td>

								<td>

									<table>

										<tr>

											<td>

												<a href="<?php echo base_url(); ?>index.php/<?php echo $event['uuser']; ?>">

													<img class="user_image" src="<?php echo base_url(); ?>users/img/<?php echo $event['image']; ?>" />

												</a>

											</td>

											<td valign="top">

												<a href="<?php echo base_url(); ?>index.php/<?php echo $event['uuser']; ?>"><?php echo $event['uname']; ?></a>

												<br />

												<?php echo $event['country'] ?>

											</td>

										</tr>

									</table>

								</td>

							</tr>

							<tr>

								<td class="title31"><?php echo $this->lang->line('pais'); ?>: </td>

								<td><?php echo $event['event_country']; ?></td>

							</tr>

							<tr>

								<td class="title31"><?php echo $this->lang->line('lugar'); ?>: </td>

								<td><?php echo $event['place']; ?></td>

							</tr>

							<tr>

								<td class="title31"><?php echo $this->lang->line('fecha'); ?>: </td>

								<td>

									<?php

										//$timestamp = strtotime($event['date']);

										echo date('l, d F Y',$event['date']);

									?>

								</td>

							</tr>

							<tr id="event_category">

								<td class="title31"><?php echo $this->lang->line('event_categoria'); ?>: </td>
								<?php
								
                                	switch ($event['category']) {
										
										case 'phonecards':
											$cat_name = $this->lang->line('tarjetas_telefonicas');
											break;
										case 'coins':
											$cat_name = $this->lang->line('monedas');
											break;	
										case 'banknotes':
											$cat_name = $this->lang->line('billetes');
											break;											
										
									}
                                
                                ?>
								<td><?php echo $cat_name; ?></td>

							</tr>

							<tr>

								<td class="title31"><?php echo $this->lang->line('descripcion'); ?>: </td>

								<td><?php echo $event['description']; ?></td>

							</tr>

							<tr>

								<td class="title31"><?php echo $this->lang->line('coleccionistas_invitados'); ?>: </td>

								<td>

									<?php

										if ( count($invited) > 0 ){

									?>

									<ul id="event_invited">

										<?php

											for ( $i = 0 ; $i < count($invited) ; $i++ ){

												?>

												<li title="<?php echo $invited[$i]['name'].' (@'.$invited[$i]['user'].')'; ?>">

													<a href="<?php echo base_url(); ?>index.php/<?php echo $invited[$i]['user']; ?>">

														<img class="user_image" src="<?php echo base_url(); ?>users/img/<?php echo $invited[$i]['image']; ?>" />

													</a>

												</li>

												<?php

											}

										?>

									</ul>

									<?php

										}

										else{

											?>

											<span>

												<?php echo $this->lang->line('event_ningun_coleccionista_invitado'); ?>

												<?php

													if ( $event['private'] == 0 ){

													?>

													<a href="#invite-friends" onclick="invite_friends()"><?php echo $this->lang->line('event_invita_a_tus_amigos'); ?></a>

													<?php

													}

												?>

											</span>

											<?php

										}

									?>

								</td>

							</tr>

						</table>

					</td>

				</tr>

			</table>

		</div>

		<div id="invite-friends"></div>

		<div class="box1" id="event-comments">

			<div class="title4"><?php echo $this->lang->line('comentarios'); ?></div>

			<div id="comments-list">

				<table cellpadding="5">

				<?php

					for ( $i = 0 ; $i < count($comments) ; $i++ ){

						?>

						<tr>

							<td>

								<a href="<?php echo base_url(); ?>index.php/<?php echo $comments[$i]['user']; ?>">

									<img class="user_image" src="<?php echo base_url(); ?>users/img/<?php echo $comments[$i]['image']; ?>" />

								</a>

							</td>

							<td style="width:100%">

								<?php echo $comments[$i]['comment']; ?>

								<br />

								<span class="comment-date" onmouseover="showInfo(this,'<?php echo date('l, d F Y',$comments[$i]['date']) ?>')">

									<?php echo ago($comments[$i]['date']); ?>

								</span>

							</td>

						</tr>

						<?php

					}

				?>

				</table>

				<?php

					if ( count($comments) == 0 ){

						?>

						<span class="title3"><?php echo $this->lang->line('event_no_comentarios'); ?></span>

						<?php

					}

				?>

			</div>

			<?php

				if ( isset($_SESSION['id_users']) ){

			?>

			<div id="my-comment">

				<table>

					<tr>

						<td><img class="user_image" src="<?php echo base_url(); ?>users/img/<?php echo $_SESSION['img']; ?>" /></td>

						<td>

							<textarea class="upload-input" id="event-new-comment"><?php echo $this->lang->line('escribir_comentario'); ?></textarea>

						</td>

						<td valign="bottom"><span onclick="send_comment()" class="google-button google-button-blue"><?php echo $this->lang->line('enviar'); ?></span></td>

					</tr>

				</table>

			</div>

			<?php

				}

			?>

		</div>

	</div>
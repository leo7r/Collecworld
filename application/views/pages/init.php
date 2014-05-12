<!--To Start-->

<script type="text/javascript">

	

	function modalPhonecard( _p ){

		$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,backs:backs},function(){

			$("#modalP").click();

		});

	

	}

	

	$(document).ready(function(){

	

		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });

		$('.input0').click(function(){					

			//

		});

		

		$('#modal-close').click(function(){

			$("#lean_overlay").click();

		});

		

		$("#lean_overlay").click(function(){

			deleteHash('sig');

		});

		

						

		$("#content-in,#top").click(function(){

			closeMenu();

		});

		

		var showPc =  parseInt($(document).getUrlParam("showPhonecard"));

		

		if ( showPc ){

			modalPhonecard(showPc);

			showGlobalInfo('New image uploaded!');

		}

		

		var err = parseInt($(document).getUrlParam("err"));

		

		switch ( err ){

			case 0:

				showGlobalInfo('User or password not valid.');

				break;

			case 1:

				showGlobalInfo('The email you submited is already registered.');

				break;

		}

		

		query = getHash('q');

		

		if ( query ){

			q2 = query.replace('+',',');

			document.getElementById('search').value = q2;

			searchTop( 'search' , '' );

		}

		

	});

	

	$(window).ready(function(){

	

		if ( getHash('sig') ){

			setTimeout(function(){$("#go").click();},500);

		}

		

		

		

	});

	

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

		document.getElementById('main-activity-content').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';



		setInterval(function(){
			$("#main-activity-content").load(path+'ajax/user_activity.php');
			google1();

		},1000);

	});

	

	function sendFb( user ){

		

		text = $("#feedback-content-in").val();

		

		if ( text.length > 10 ){

			url = document.URL.split('?');

			url = url[0];

			$("#onFinish").val(url);

			document.getElementById('feedback-form').submit();

		}

		else{

			alert('Feedback too short');

		}

		

	}

	

</script>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>

<div id="modal-phonecard"></div>

		<div id="content">

			<div id="toolbar">

				<div class="in">

					<div id="toolbar-left">

						<div class="item location">

							&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;

						</div>

					</div>

					

					<?php					

					

					if ( isset($_SESSION['user']) ){

				?>

			  		

					<div id="user-in"<?php if ( isset($_SESSION['user']) ) echo 'onclick="launchMenu();"'; ?> >

						<div class="separator-left"></div>

						<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png"  />

						<span id="user-name">

							<?php 

								echo $_SESSION['name'];

								

								if ( $notifications ){

								?>

									<span class="notification-out">

								<a href="<?php echo base_url(); ?>index.php/account/#sec=6">

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

					}

				?>

					

				</div>

			</div>

								

				<div id="modal-signin">

					<script>

						$("#modal-signin").load(path+'ajax/signup/index.php',{path:path});

					</script>

				</div>

				

				<div id="content-in">

					<div id="top-content">

						<div id="top-content-left" class="box0">

							

						</div>

						<div id="top-content-right">

						

							<?php

								if ( !$_SESSION['user'] ){

									?>

										<div id="fast-signin" class="box1">

											

											<div id="r-title">

												<span class="title4"><?php echo $this->lang->line('init_conectar'); ?></span>

											</div>

											

											<div id="fast-signin-form">

												<form action="" method="post">

													<table cellpadding="10">

														<tr>

															<td><?php echo $this->lang->line('usuario'); ?></td>

															<td><input type="text" name="user" class="input0" /></td>

														</tr>

														<tr>

															<td><?php echo $this->lang->line('contrasena'); ?></td>

															<td><input type="password" id="pass" name="pass" class="input0" /></td>

														</tr>

														<tr>

															<td><a href="<?php echo base_url(); ?>index.php/forgot_password"><?php echo $this->lang->line('olvidar_contrasena'); ?></a></td>

															<td><input type="submit" value="<?php echo $this->lang->line('iniciar_sesion'); ?>" class="google-button google-button-blue" /></td>

														</tr>

													</table>

												</form>

											</div>

											

											<div id="fast-signin-footer">

												<div class="title0"><?php echo $this->lang->line('init_registrate_gratis'); ?></div>

												<div style="margin-top:10px;">

													<a rel="leanModal" href="#modal-signin" class="google-button google-button-red">

														<?php echo $this->lang->line('init_registrarse_collecworld'); ?>

													</a>

												</div>

											</div>

											

										</div>

									<?php

								}

								else{

							?>

								<div id="r-title">

									<span class="title1"><?php echo $this->lang->line('init_todas_tus_colecciones'); ?></span>

								</div>

								

								<div id="r-info">

									<a href="<?php echo base_url(); ?>index.php/explore">

										<div class="r-info-item box1">

											<img src="<?php echo base_url(); ?>img/organize.png" height="32" width="32" />

											<span class="r-info-item-text"><?php echo $this->lang->line('init_gestiona_colecciones'); ?></span>

										</div>

									</a>

									<a href="<?php echo base_url(); ?>index.php/upload">

										<div class="r-info-item box1">

											<img src="<?php echo base_url(); ?>img/contribute.png" height="32" width="32" />

											<span class="r-info-item-text"><?php echo $this->lang->line('init_contribuye_nuevo_coleccionable'); ?></span>

										</div>

									</a>

									<a href="<?php echo base_url(); ?>index.php/event/events_list">

										<div class="r-info-item box1">

											<img src="<?php echo base_url(); ?>img/event.png" height="32" width="32" />

											<span class="r-info-item-text"><?php echo $this->lang->line('init_eventos'); ?></span>

										</div>

									</a>

									<a href="<?php echo base_url(); ?>index.php/help">

										<div class="r-info-item box1">

											<img src="<?php echo base_url(); ?>img/help3.png" height="32" width="32" />

											<span class="r-info-item-text"><?php echo $this->lang->line('init_necesitas_ayuda'); ?></span>

										</div>

									</a>

								</div>

							<?php

								}

							?>						

						</div>

					</div>

					

					<div id="categories">

						<div id="cat-left">

							<div id="cat-title">

								<?php echo $this->lang->line('init_categorias'); ?>

							</div>

							<br />

							<a href="explore/phonecard">				

								<div class="cat-img-holder">

									<div><img src="<?php echo base_url(); ?>img/phonecards.jpg" /></div>

									<div class="cat-img-info"><?php echo $this->lang->line('init_tarjetas_telefonicas'); ?></div>

								</div>

							</a>

							<a href="explore/coin">

								<div class="cat-img-holder">

									<div><img src="<?php echo base_url(); ?>img/coins.jpg" /></div>

									<div class="cat-img-info"><?php echo $this->lang->line('init_monedas'); ?></div>

								</div>

							</a>

							<a href="explore/banknote">						

								<div class="cat-img-holder">

									<div><img src="<?php echo base_url(); ?>img/banknotes.jpg" /></div>

									<div class="cat-img-info"><?php echo $this->lang->line('init_billetes'); ?></div>

								</div>

							</a>

							<a href="explore/stamp">

								<div class="cat-img-holder">

									<div><img src="<?php echo base_url(); ?>img/stamps.jpg" /></div>

									<div class="cat-img-info"><?php echo $this->lang->line('init_estampillas'); ?></div>

								</div>

							</a>

							

							<a href="#">

								<div class="cat-img-holder">

									<div><img src="<?php echo base_url(); ?>img/caps.jpg"/></div>

									<div class="cat-img-info"><?php echo $this->lang->line('init_tapas_botella'); ?></div>

								</div>

							</a>


							<a href="#">

								<div class="cat-img-holder">

									<div><img src="<?php echo base_url(); ?>img/tradingcards.jpg" /></div>

									<div class="cat-img-info"><?php echo $this->lang->line('init_cartas_coleccionables'); ?></div>

								</div>

							</a>

							

							<a href="#">

								<div class="cat-img-holder">

									<div><img src="<?php echo base_url(); ?>img/sugar.jpg" /></div>

									<div class="cat-img-info"><?php echo $this->lang->line('init_azucar'); ?></div>

								</div>

							</a>

							

							<a href="#">

								<div class="cat-img-holder">

									<div><img src="<?php echo base_url(); ?>img/stickers.jpg"/></div>

									<div class="cat-img-info"><?php echo $this->lang->line('init_calcomanias'); ?></div>

								</div>

							</a>

                            <br />



							<div id="cat-bottom-title">

                            	<?php echo $this->lang->line('init_trabajando'); ?> <a href="upload"><?php echo $this->lang->line('init_trabajando_cargalo'); ?></a>

							</div>

							

						</div>

						<div class="title4"><?php echo $this->lang->line('init_nuevos_coleccionables'); ?></div>

						<div id="cat-right" class="box1">

							<div id="main-activity">

								<div id="main-activity-content"></div>

							</div>

							 <!--<div id="activity-refresh"><span class="google-button"><?php echo $this->lang->line('init_actualizar'); ?></span></div>		-->

						</div>

					</div>

                    

                        <div style="clear:both"></div>

					

				</div>

			

		</div>
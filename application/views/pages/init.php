<!--To Start-->
<script type="text/javascript">
	modalInit();
	errorInit();
</script>
<!-- Google -->

<script type="text/javascript">

	$(window).ready(function(){
		
		$("#modal-signin").load(path+'modal_signup');
		
		return; // Comentar para hacer la actividad
		
		document.getElementById('main-activity-content').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	
		 
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

							&nbsp;<a href="<?php echo base_url(); ?>init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;

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

								<a href="<?php echo base_url(); ?>account/#sec=6">

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

								

				<div id="modal-signin"></div>

				<div id="content-in">

					<div id="top-content">

						<div id="top-content-left" class="box0">

							

						</div>

						<div id="top-content-right">

						

							<?php

								if ( !isset($_SESSION['user']) ){

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

															<td><a href="<?php echo base_url(); ?>forgot_password"><?php echo $this->lang->line('olvidar_contrasena'); ?></a></td>

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

									<a href="<?php echo base_url(); ?>explore">

										<div class="r-info-item box1">

											<img src="<?php echo base_url(); ?>img/organize.png" height="32" width="32" />

											<span class="r-info-item-text"><?php echo $this->lang->line('init_gestiona_colecciones'); ?></span>

										</div>

									</a>

									<a href="<?php echo base_url(); ?>upload">

										<div class="r-info-item box1">

											<img src="<?php echo base_url(); ?>img/contribute.png" height="32" width="32" />

											<span class="r-info-item-text"><?php echo $this->lang->line('init_contribuye_nuevo_coleccionable'); ?></span>

										</div>

									</a>

									<a href="<?php echo base_url(); ?>event/events_list">

										<div class="r-info-item box1">

											<img src="<?php echo base_url(); ?>img/event.png" height="32" width="32" />

											<span class="r-info-item-text"><?php echo $this->lang->line('init_eventos'); ?></span>

										</div>

									</a>

									<a href="<?php echo base_url(); ?>help">

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

							<a href="explore/phonecards">				

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

							<!--

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
                            --> 



							<div id="cat-bottom-title">

                            	<?php echo $this->lang->line('init_trabajando'); ?> <a href="upload"><?php echo $this->lang->line('init_trabajando_cargalo'); ?></a>

							</div>

							

						</div>

						<div class="title4"><?php echo $this->lang->line('init_nuevos_coleccionables'); ?></div>

						<div id="cat-right" class="box1">

							<div id="main-activity">

								<div id="main-activity-content"></div>

							</div>

						</div>

					</div>
                    <div style="clear:both"></div>

				</div>

		</div>
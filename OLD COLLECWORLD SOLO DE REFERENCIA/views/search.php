<!--To Start-->

<script type="text/javascript">



	function modalPhonecard( _p ){

		url = $("#url").val();
		url = url.split('index.php/')[1];
		
		$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,url:url},function(){

			$("#modalP").click();

		});

	

	}

	function modalCoin( _p ){

	url = $("#url").val();
	url = url.split('index.php/')[1];
	
	$("#modal-phonecard").load(path+'ajax/showCoin.php',{p:_p,url:url},function(){

		$("#modalP").click();

	});


	}

	function modalBanknote( _p ){

	url = $("#url").val();
	url = url.split('index.php/')[1];
	
	$("#modal-phonecard").load(path+'ajax/showBanknote.php',{p:_p,url:url},function(){

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

						

		$("#content-in,#top").click(function(){

			closeMenu();

		});

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

		

		setTimeout(function(){

			google1();

		},1000);

	});

	

</script>



<body>


<input type="hidden" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>


<div id="content">

	<div id="toolbar">

		<div class="in">

			<div id="toolbar-left">

				<div class="item location">

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('buscar'); ?> <b><?php echo $query; ?></b></a>&nbsp;&raquo;

				</div>

			</div>

			

			<?php

			@session_start();

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

		?>

			<div id="signin">

				<a id="go" onClick="setHash('sig=1');" rel="leanModal" href="#modal-signin" class="google-button google-button-blue"><?php echo $this->lang->line('iniciar_sesion'); ?></a>

			</div>

		

		<?php

			}

		?>

			

		</div>

	</div>

						

	<div id="modal-signin">

		<script>

			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{path:path});

		</script>					

	</div>

	

	<div id="content-in">

		<div>

			<table>

				<tr>

					<td valign="top">

						<div class="search-result-left">

							<div class="title3 search-title"><?php echo $this->lang->line('resultados_para'); ?> <b><?php echo $query; ?></b></div>

							<table cellpadding="5" >

								<tr>

									<td>

										<div class="box1 search-container">

											<div class="title4"><?php echo $this->lang->line('tarjetas_telefonicas'); ?></div>

											<?php

												if ( !$phonecards_num ){

													?>

														<div style="text-align:center; color:#555">

															<img src="<?php echo base_url(); ?>img/not_found.png" />

															<br>

															<?php echo $this->lang->line('no_se_encontraron_tarjetas_telefonicas'); ?>

														</div>

													<?php

												}

												else{

											?>

											<table cellpadding="5">

												<?php

													for ( $i = 0 ; $i < count($phonecards) ; $i++ ){

														

														$width = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 38:61;

														$height = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 61:38;

														

														if ( strcmp($phonecards[$i]['image'],'') != 0 ){

															$img = base_url().'upload/img/'.$phonecards[$i]['image'];

														}

														else{

															$img = base_url().'img/default_phonecard.jpg';

														}

													?>

														<tr>

															<td>

																<a onClick="modalPhonecard(<?php echo $phonecards[$i]['id_phonecards']; ?>);">

																<img onClick="modalPhonecard(<?php echo $phonecards[$i]['id_phonecards']; ?>);" src="<?php echo $img; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

																</a>

															</td>

															<td>

																<a onClick="modalPhonecard(<?php echo $phonecards[$i]['id_phonecards']; ?>);" >

																	<?php echo utf8_encode($phonecards[$i]['name']); ?>

                                                                </a>

																<br>

																<?php echo utf8_encode($phonecards[$i]['Company']); ?> / <?php echo $phonecards[$i]['Country']; ?>

															</td>

														</tr>

													<?php

													}

												?>

											</table>


											<?php

												}

											if ( $phonecards_num > 6 ){

											?>

											<div style="float:right;">

											<a href="<?php echo base_url(); ?>index.php/search/phonecards/<?php echo str_replace(' ','+',$query); ?>/1"><?php echo $this->lang->line('mostar_todos'); ?>&nbsp; <?php echo $phonecards_num; ?>&nbsp;<?php echo $this->lang->line('tarjetas_telefonicas'); ?> </a>

											</div>

											<?php

											}

											?>

										</div>

										<div class="box1 search-container">

											<div class="title4"><?php echo $this->lang->line('monedas'); ?></div>

											<?php

												if ( !$coins_num ){

													?>

														<div style="text-align:center; color:#555">

															<img src="<?php echo base_url(); ?>img/not_found.png" />

															<br>

															<?php echo $this->lang->line('no_se_encontraron_monedas'); ?>

														</div>

													<?php

												}

												else{

											?>

											<table cellpadding="5">

												<?php

													for ( $i = 0 ; $i < count($coins) ; $i++ ){

														

														//$width = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 38:61;

														//$height = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 61:38;

														

														if ( strcmp($coins[$i]['image'],'') != 0 ){

															$img = base_url().'upload/coins/'.$coins[$i]['image'];

														}

														else{

															$img = base_url().'img/default_coin.jpg';

														}

													?>

														<tr>

															<td>

																<a onClick="modalCoin(<?php echo $coins[$i]['id_coins']; ?>);">

																<img onClick="modalCoin(<?php echo $coins[$i]['id_coins']; ?>);" src="<?php echo $img; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

																</a>

															</td>

															<td>

																<a onClick="modalCoin(<?php echo $coins[$i]['id_coins']; ?>);" >

																	<?php echo utf8_encode($coins[$i]['value']); ?>

                                                                </a>

																<br>

																<?php echo utf8_encode($coins[$i]['mint_house']); ?> / <?php echo $coins[$i]['Country']; ?>

															</td>
															
														</tr>

													<?php

													}

												?>

											</table>


											<?php

												}

											if ( $coins_num > 6 ){

											?>

											<div style="float:right;">

											<a href="<?php echo base_url(); ?>index.php/search/coins/<?php echo str_replace(' ','+',$query); ?>/1"><?php echo $this->lang->line('mostar_todos'); ?>&nbsp; <?php echo $coins_num; ?>&nbsp;<?php echo $this->lang->line('monedas'); ?> </a>

											</div>

											<?php

											}

											?>

										</div>

										<div class="box1 search-container" style="margin-top:20px;">

											<div class="title4"><?php echo $this->lang->line('billetes'); ?></div>

											<?php

												if ( !$banknotes_num ){

													?>

														<div style="text-align:center; color:#555">

															<img src="<?php echo base_url(); ?>img/not_found.png" />

															<br>

															<?php echo $this->lang->line('no_se_encontraron_billetes'); ?>

														</div>

													<?php

												}

												else{

											?>

											<table cellpadding="5">

												<?php

													for ( $i = 0 ; $i < count($banknotes) ; $i++ ){

														

														//$width = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 38:61;

														//$height = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 61:38;

														

														if ( strcmp($banknotes[$i]['image'],'') != 0 ){

															$img = base_url().'upload/banknotes/'.$banknotes[$i]['image'];

														}

														else{

															$img = base_url().'img/default_coin.jpg';

														}

													?>

														<tr>

															<td>

																<a onClick="modalBanknote(<?php echo $banknotes[$i]['id_banknotes']; ?>);">

																<img onClick="modalBanknote(<?php echo $banknotes[$i]['id_banknotes']; ?>);" src="<?php echo $img; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />

																</a>

															</td>

															<td>

																<a onClick="modalBanknote(<?php echo $banknotes[$i]['id_banknotes']; ?>);" >

																	<?php echo utf8_encode($banknotes[$i]['value']); ?>

                                                                </a>

																<br>

																<?php echo $banknotes[$i]['Country']; ?>

															</td>
															
														</tr>

													<?php

													}

												?>

											</table>


											<?php

												}

											if ( $banknotes_num > 6 ){

											?>

											<div style="float:right;">

											<a href="<?php echo base_url(); ?>index.php/search/banknotes/<?php echo str_replace(' ','+',$query); ?>/1"><?php echo $this->lang->line('mostar_todos'); ?>&nbsp; <?php echo $banknotes_num; ?>&nbsp;<?php echo $this->lang->line('billetes'); ?> </a>

											</div>

											<?php

											}

											?>

										</div>




									</td>

									<!-- <td valign="top">

										<div class="box1 search-container">

											<div class="title4">Coins</div>

											<div style="text-align:center; color:#555">

												<img src="<?php echo base_url(); ?>img/not_found.png" />

												<br>

												No coins found

											</div>

										</div>

									</td>

                                    -->

								</tr>

							</table>

						</div>

					</td>

					<td  valign="top"><div class="search-result-right">

						<div class="search-title"><?php echo $this->lang->line('coleccionistas'); ?></div>

							<div>

								<div><?php echo $this->lang->line('busqueda'); ?> / <b><?php echo $query; ?></b></div>

								<?php

									if ( count($users) == 0 ){

										echo $this->lang->line('no_hay_usuarios_encontrados');

									}

								?>

								<table cellpadding="5" >

								<?php

									for ($i = 0 ; $i < count($users) and $i < 5 ; $i++ ){

									

									?>

										<tr>

											<td valign="top">

												<a href="<?php echo base_url(); ?>index.php/<?php echo $users[$i]['user']; ?>">

													<img src="<?php echo base_url(); ?>users/img/<?php echo $users[$i]['image']; ?>" width="32" height="32" />

												</a>

											</td>

											<td>

												<div style="width:200px;">

													<a href="<?php echo base_url(); ?>index.php/<?php echo $users[$i]['user']; ?>"><?php echo $users[$i]['name']; ?></a>

													<br>

													<?php echo $users[$i]['country']; ?>

												</div>

											</td>

										</tr>

									<?php

									}

								?>

								</table>

								<?php

								if ( count($users) > 5 ){

								?>

									<a style="float:right;" href="<?php echo base_url(); ?>index.php/search/users/<?php echo $query; ?>"><?php echo $this->lang->line('mostrar_todos'); ?>&nbsp; <?php echo count($users); ?> &nbsp; <?php echo $this->lang->line('usuarios'); ?></a>

								<?php

								}

								?>

								<br>

								<div>

									<?php

										 if ( isset($users_recomended) ){

										 ?>

										 	<div><?php echo $this->lang->line('proveniente_de'); ?> &nbsp; <b><?php echo $logged['Country']; ?></b></div>

										 <?php

										 

										 	if ( count($users_recomended) == 0 ){

												echo $this->lang->line('no_hay_usuarios_encontrados');

											}

										?>

										<table cellpadding="5">

										<?php

											for ($i = 0 ; $i < count($users_recomended) ; $i++ ){

																						

											?>

												<tr>

													<td valign="top">

														<a href="<?php echo base_url(); ?>index.php/<?php echo $users_recomended[$i]['user']; ?>">

															<img src="<?php echo base_url(); ?>users/img/<?php echo $users_recomended[$i]['image']; ?>" width="32" height="32" />

														</a>

													</td>

													<td>

														<div style="width:200px;">

															<a href="<?php echo base_url(); ?>index.php/<?php echo $users_recomended[$i]['user']; ?>"><?php echo $users_recomended[$i]['name']; ?></a>

															<br>

															<?php echo $users_recomended[$i]['country']; ?>

														</div>

													</td>

												</tr>

											<?php

											}

										?>

										</table>

										<?php

										

										 }

									?>

								</div>

							</div>

						</div>

					</td>

				</tr>

			</table>

		</div>

		

	</div>	

</div>
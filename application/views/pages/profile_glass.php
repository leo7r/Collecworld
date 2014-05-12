<!--To Start-->

<script type="text/javascript">

$(document).ready(function() {

	function getvalues(){
		var usuario = $("#valuetosearch").val();
		var GroupUser = $("#GroupUser:checked").val();
		var BeginDate = $("#BeginDate").val();
		var FinalDate = $("#FinalDate").val();
		if(FinalDate==''){
			showGlobalInfo("<?php echo $this->lang->line('necesitas_fecha_fin'); ?>");
		}else if(new Date(FinalDate) < new Date(BeginDate)){
			showGlobalInfo("<?php echo $this->lang->line('fecha_fin_mayor_inio'); ?>");
		}else{
		$(".glob-info").remove();
		 $("#search_visit").load(path+"ajax/profileglass.php?usuario="+usuario+"&GroupUser="+GroupUser+"&BeginDate="+BeginDate+"&FinalDate="+FinalDate);
		}
	}

	$("#valuetosearch").keyup(function(){
		getvalues();
	});

		$("#GroupUser").click(function(){
			getvalues();
		});
		$("#BeginDate").change(function(){
			getvalues();
		});
		$("#FinalDate").change(function(){
			getvalues();
		});

})

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

<div id="content">

	<div id="toolbar">

		<div class="in">

			<div id="toolbar-left">

				<div class="item location">

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('visitas_a_mi_perfil'); ?></a>&nbsp;&raquo;

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
			      <div id="explore_sort" class="box1">
                        <table width="100%">
                            <tr>
                                <td>
                                    <?php echo $this->lang->line('buscar')." ".$this->lang->line('usuario'); ?>:&nbsp;
                                    <input type="text" placeholder="Usuario, nombre" id="valuetosearch" >
                                </td>
                                <td>
                                    <input type="checkbox" onChange="showVariations(this);" id="GroupUser" value="user" />
                                    <?php echo $this->lang->line('agrupar_por_usuario'); ?>
                                </td>
								 <td>
								    <?php echo "Rango de Fechas"; ?>:<br>
                                    Inicio <input type="date" id="BeginDate"><br> Fin <input type="date" id="FinalDate" value="<?php echo date('Y-m-d'); ?>">
                                </td>
                            </tr>
                        </table>			
                    </div>

			<table>

				<tr>

					<td valign="top">

						<div class="search-result-left">

							<div class="title3 search-title"><?php echo $this->lang->line('resultados_para')." ".$_SESSION['user']; ?></div>

							<table cellpadding="5" >

								<tr>

									<td>

									<div class="box1 search-container" style="margin-top:20px;" id="search_visit">

											<div class="title4"><?php echo $this->lang->line('usuarios_que_visitaron'); ?></div>

											<?php

												if ( !$users_num ){

													?>

														<div style="text-align:center; color:#555">

															<img src="<?php echo base_url(); ?>img/not_found.png" />

															<br>

															<?php echo $this->lang->line('nadie_te_visito'); ?>

														</div>

													<?php

												}

												else{

											?>

											<table cellpadding="5">

												<?php

													for ( $i = 0 ; $i < count($users_profile) ; $i++ ){

														

														//$width = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 38:61;

														//$height = strcmp($phonecards[$i]['vertical_anverse'],'1') == 0 ? 61:38;

														

														if ( strcmp($users_profile[$i]['image'],'') != 0 ){

															$img = base_url().'users/img/'.$users_profile[$i]['image'];

														}

														else{

															$img = base_url().'img/default_coin.jpg';

														}

													?>

														<tr>

														<td valign="top">

																	<a href="<?php echo base_url(); ?>index.php/<?php echo $users_profile[$i]['user']; ?>">

																	<img src="<?php echo base_url(); ?>users/img/<?php echo $users_profile[$i]['image']; ?>" width="32" height="32" />

																	</a>

																</td>

															<td>

																<a href="<?php echo base_url(); ?>index.php/<?php echo $users_profile[$i]['user']; ?>">

																<img onClick="modalBanknote(<?php echo $users_profile[$i]['name']; ?>);" />

																</a>

															</td>

															<td>

																<a href="<?php echo base_url(); ?>index.php/<?php echo $users_profile[$i]['user']; ?>" >

																	<?php echo utf8_encode($users_profile[$i]['name']); ?>

                                                                </a>

																<br>

																<?php echo $users_profile[$i]['country']."/".$this->lang->line('genero').": ".$users_profile[$i]['gender']; ?>

															</td>
															<td>		

																	<?php echo $this->lang->line('fecha')."<br>"; ?>
																	<?php echo gmdate('r',$users_profile[$i]['date']); ?>

															</td>

															
														</tr>

													<?php

													}

												?>

											</table>


											<?php

												}

											if ( $users_num > 6 ){

											?>

											<div style="float:right;">

											<a href="<?php echo base_url(); ?>index.php/search/banknotes/<?php echo str_replace(' ','+',$_SESSION['user']); ?>/1"><?php echo $this->lang->line('mostar_todos'); ?>&nbsp; <?php echo $users_num; ?>&nbsp;<?php echo $this->lang->line('coleccionistas'); ?> </a>

											</div>

											<?php

											}

											?>

										</div>

									</td>

								</tr>

							</table>

						</div>

					</td>
				</tr>

			</table>

		</div>

		

	</div>	

</div>
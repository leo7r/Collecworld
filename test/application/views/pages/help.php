<!--To Start-->

<script type="text/javascript">

	

	$(document).ready(function(){

		

		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });

		

		sec = getHash('sec');

		

		if ( sec ){

			accountMenu(parseInt(sec));

		}

		

		don = getHash('don');

		

		if ( don ){

			showGlobalInfo('Account information updated successfully');

		}

		

		newmsg = $(document).getUrlParam('new-message');

		

		if ( newmsg ){

			$("#user-send-new").click();

		}

	

	});

	

</script>

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

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('centro_ayuda'); ?></a>&nbsp;&raquo;

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

				<a id="go" rel="leanModal" href="#modal-signin" class="google-button google-button-blue"><?php echo $this->lang->line('iniciar_sesion'); ?></a>

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

		<div id="account-title" >

			<?php echo $this->lang->line('centro_ayuda'); ?>

		</div>

		<div id="account-content">

			

            	<table border="0" cellspacing="30" cellpadding="5" align="center">

                    <tr>

                        <td valign="top">

                            <div class="help_cont">

                                <h1>

                                    <a href="<?php echo base_url(); ?>index.php/help/get_started"><?php echo $this->lang->line('help_comenzar'); ?></a>

                                </h1>

                               <ul>

                                    <li>

                                        <a href="<?php echo base_url(); ?>index.php/help/get_started#about"><?php echo $this->lang->line('help_acerca'); ?></a>

                                    </li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/get_started#create"><?php echo $this->lang->line('help_porque_como_crear_cuenta'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/get_started#personal"><?php echo $this->lang->line('help_tu_coleccion_personal'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/get_started#collectors"><?php echo $this->lang->line('help_listados_coleccionistas'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/get_started#search_exp"><?php echo $this->lang->line('help_busqueda_explorar'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/get_started#swap"><?php echo $this->lang->line('help_intercambio_compra_venta'); ?></a></li>

                                </ul>
                            </div> 

                        </td>

                        <td valign="top">

                            <div class="help_cont">

                                <h1>

                                    <a href="<?php echo base_url(); ?>index.php/help/upload/phonecards"><?php echo $this->lang->line('help_como_cargar_coleccionable'); ?></a>

                                </h1>

                                <ul>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/upload/phonecards"><?php echo $this->lang->line('tarjetas_telefonicas'); ?></a></li>

                                </ul>

                            </div> 

                        </td>

                    </tr>

                    <tr>

                    <td valign="top">

                            <div class="help_cont">

                                <h1>

                                    <a href="<?php echo base_url(); ?>index.php/help/account"><?php echo $this->lang->line('help_mi_cuenta'); ?></a>

                                </h1>

                                <ul>

                                    

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#profile_pic"><?php echo $this->lang->line('help_foto_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#profile_info"><?php echo $this->lang->line('help_informacion_editar_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#overview"><?php echo $this->lang->line('help_overview_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#mycollections"><?php echo $this->lang->line('help_mis_colecciones_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#friends"><?php echo $this->lang->line('help_amigos_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#events"><?php echo $this->lang->line('help_eventos_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#trades"><?php echo $this->lang->line('help_comercio_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#messages"><?php echo $this->lang->line('help_mensajes_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#notifications"><?php echo $this->lang->line('help_notificaciones_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/account#settings"><?php echo $this->lang->line('help_configuracion_titulo'); ?></a></li>

                                </ul>

                            </div> 

                        </td>

                        <td valign="top">

                            <div class="help_cont">

                                <h1>

                                    <a href="<?php echo base_url(); ?>index.php/help/tools"><?php echo $this->lang->line('herramientas'); ?></a>

                                </h1>

                                <ul>

                                    

                                    <li><a href="<?php echo base_url(); ?>index.php/help/tools#personal_listing"><?php echo $this->lang->line('help_listados_personales_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/tools#notes"><?php echo $this->lang->line('help_notas_listados_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/tools#comparison"><?php echo $this->lang->line('help_comparacion_listados_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/tools#export"><?php echo $this->lang->line('help_exportar_titulo'); ?></a></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/tools#events"><?php echo $this->lang->line('help_eventos_titulo'); ?></a></li>

                                </ul>

                            </div> 

                        </td>

                        

                    </tr>

                    <tr>

                         <td valign="top">

                            <div class="help_cont">

                                <h1>

                                    <a href="<?php echo base_url(); ?>index.php/help/collecworld_community"><?php echo $this->lang->line('help_comunidad_collecworld_titulo'); ?></a>

                                </h1>

                                <ul>

                                    

                                    <li><a href="<?php echo base_url(); ?>index.php/help/collecworld_community#ranking"><?php echo $this->lang->line('help_rating_coleccionistas_titulo'); ?></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/collecworld_community#contributions"><?php echo $this->lang->line('help_contribuciones_titulo'); ?></li>

                                    <li><a href="<?php echo base_url(); ?>index.php/help/collecworld_community"><?php echo $this->lang->line('help_mas_articulos_titulo'); ?></li>

                                </ul>

                            </div> 

                        </td>

                        

                    </tr>

                

                

                </table>

                

		</div>

	</div>
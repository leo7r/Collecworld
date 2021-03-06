<!--To Start-->

<script type="text/javascript">

				

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

		

		setPlaceHolder('country-search');

		setPlaceHolder('title-search');

		setPlaceHolder('subtitle-search');
		
		setPlaceHolder('denomination-search');
		
		setPlaceHolder('value-search');
		
		setPlaceHolder('composition-search');

		

		

		

		// Set country

		country = $(document).getUrlParam('country');

		if ( country ){

			cou = $("#cou-"+country);

			$("#country-search").val(cou.html());

			filter_explore(document.getElementById("country-search"),'explore-country-list');

			explore_country(cou,country);

		}

		else{

			$("#selected-country").val('');

		}

		/*

		// Set catalog

		catalog = $(document).getUrlParam('catalog');

		if ( catalog ){

			

			switch( catalog ){

				case 'dated':

					explore_catalog($("#explore-catalog-table td")[0],0);

					break;

				case 'undated':

					explore_catalog($("#explore-catalog-table td")[1],1);

					break;

				case 'not-emmited':

					explore_catalog($("#explore-catalog-table td")[2],2);

					break;

				case 'especial':

					explore_catalog($("#explore-catalog-table td")[3],3);

					break;

			}

		}

		else{

			$("#selected-catalog").val('');

		}*/

		
		<?php
			if ( isset($intro_explore) && $intro_explore == 0 ){
				?>
				modalIntroduction(1);
				<?php
			}
		?>
		

		// Set system

		/*system = $(document).getUrlParam('system');

		if ( system ){

			

			switch( system ){

				case 'chip':

					explore_system($("#explore-system-table td")[3],0);

					break;

				case 'magnetic-band':

					explore_system($("#explore-system-table td")[0],1);

					break;

				case 'optical':

					explore_system($("#explore-system-table td")[1],2);

					break;

				case 'remote-memory':

					explore_system($("#explore-system-table td")[4],3);

					break;

				case 'induced':

					explore_system($("#explore-system-table td")[2],4);

					break;

			}

		}

		else{

			$("#selected-system").val('');

		}*/

		

		

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

<div id="content">

	<div id="toolbar">

		<div class="in">

			<div id="toolbar-left">

				<div class="item location">

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/explore/coin"><?php echo $this->lang->line('header_explorar_monedas'); ?></a>&nbsp;&raquo;

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
        
		<input type="hidden" id="selected-catalog" name="selected-catalog" value="0" />
    
		<input type="hidden" id="selected-country" name="selected-country" /> 

		<input type="hidden" id="selected-year" name="selected-year" value="AllYears" />
        
		<input type="hidden" id="selected-title" name="selected-title" />
        
		<input type="hidden" id="selected-subtitle" name="selected-subtitle" />
        
		<input type="hidden" id="selected-denomination" name="selected-denomination" />
        
		<input type="hidden" id="selected-value" name="selected-value" />
        
		<input type="hidden" id="selected-composition" name="selected-composition" value="All" />

		

		<div class="obb">* &mdash; <?php echo $this->lang->line('explore_phonecards_campo_requerido'); ?></div>

		

		<div>

			<table cellpadding="10">
            
            	<tr>
					
                    <td colspan="3">

                        <!-- Explore catalog -->
    
                        <div class="title4"><span class="obb">*</span><?php echo $this->lang->line('seleccionar_catalogo'); ?></div>
    
                        <div id="explore-catalog" >
    
                            <table id="explore-catalog-table" cellspacing="10">
    
                                <tr>
                                	<td id="circulationF" class="box1 selected" onClick="explore_catalog_coin(this,0);">
    
                                        <div><?php echo $this->lang->line('circulacion_total'); ?></div>
    
                                    </td>
    
                                    <td id="circulationN" class="box1" onClick="explore_catalog_coin(this,1);">
    
                                        <div><?php echo $this->lang->line('circulacion_normal'); ?></div>
    
                                    </td>
    
                                    <td id="circulationC" class="box1" onClick="explore_catalog_coin(this,2);">
    
                                        <div><?php echo $this->lang->line('conmemorativas_numismaticas'); ?></div>
    
                                    </td>
    
                                    <td id="circulationO" class="box1" onClick="explore_catalog_coin(this,3);" >
    
                                        <div><?php echo $this->lang->line('ensayos_pruebas_otras'); ?></div>
    
                                    </td>
    
    
                                </tr>
    
                            </table>
    
                        </div>
    
                    </td>
                </tr>
                

				<tr>

					<td>

						<!-- Explore country -->

						<div class="title4"><span class="obb">*</span><?php echo $this->lang->line('seleccionar_pais'); ?></div>

						<div class="box1 explore-step">

							<div class="explore-step-search">

								<input type="text" class="step-search" id="country-search" onKeyUp="filter_explore(this,'explore-country-list');" value="<?php echo $this->lang->line('explore_phonecards_buscar_pais'); ?>" />

								<img src="<?php echo base_url(); ?>img/modal-close.png" onClick="clear_filter('country');" title="<?php echo $this->lang->line('explore_phonecards_limpiar_pais'); ?>" />

							</div>

							<div class="explore-step-content">

								<ul id="explore-country-list">

									<?php

										for ( $i = 0 ; $i < count($countries) ; $i++ ){

											?>

											<li id="cou-<?php echo $countries[$i]['abbreviation']; ?>" onClick="explore_country_coin(this,'<?php echo $countries[$i]['abbreviation']; ?>');" ><?php echo $countries[$i]['name'].' ('.$countries[$i]['num'].')'; ?></li>

											<?php

										}

									?>

								</ul>

							</div>

						</div>

					</td>
                    
                    <td>

						<!-- Explore title -->

						<div class="title4"><?php echo $this->lang->line('seleccionar_titulo'); ?></div>

						<div class="box1 explore-step">

							<div class="explore-step-search">

								<input type="text" class="step-search" id="title-search" onKeyUp="filter_explore(this,'explore-title-list');" value="<?php echo $this->lang->line('buscar_titulo'); ?>" />

								<img src="<?php echo base_url(); ?>img/modal-close.png" onClick="clear_filter('title');" title="<?php echo $this->lang->line('limpiar_titulo'); ?>" />

							</div>

							<div class="explore-step-content">

								<ul id="explore-title-list">

									

								</ul>

							</div>

						</div>

					</td>
                    
                     <td>

						<!-- Explore subtitle -->

						<div class="title4"><?php echo $this->lang->line('seleccionar_subtitulo'); ?></div>

						<div class="box1 explore-step">

							<div class="explore-step-search">

								<input type="text" class="step-search" id="subtitle-search" onKeyUp="filter_explore(this,'explore-subtitle-list');" value="<?php echo $this->lang->line('buscar_subtitulo'); ?>" />

								<img src="<?php echo base_url(); ?>img/modal-close.png" onClick="clear_filter('subtitle');" title="<?php echo $this->lang->line('limpiar_subtitulo'); ?>" />

							</div>

							<div class="explore-step-content">

								<ul id="explore-subtitle-list">

									

								</ul>

							</div>

						</div>

					</td>
                    
                </tr>
                
                <tr>   
                
                    <td>

						<!-- Explore Denomination   -->

						<div class="title4"><?php echo $this->lang->line('seleccionar_denominacion'); ?></div>

						<div class="box1 explore-step">

							<div class="explore-step-search">

								<input type="text" class="step-search" id="denomination-search" onKeyUp="filter_explore(this,'explore-denomination-list');" value="<?php echo $this->lang->line('buscar_denominacion'); ?>" />

								<img src="<?php echo base_url(); ?>img/modal-close.png" onClick="clear_filter('denomination');" title="<?php echo $this->lang->line('limpiar_denominacion'); ?>" />

							</div>

							<div class="explore-step-content">

								<ul id="explore-denomination-list">

									

								</ul>

							</div>

						</div>

					</td>
                    
                     
                     <td>

						<!-- Explore value   -->

						<div class="title4"><?php echo $this->lang->line('seleccionar_valor'); ?></div>

						<div class="box1 explore-step">

							<div class="explore-step-search">

								<input type="text" class="step-search" id="value-search" onKeyUp="filter_explore(this,'explore-value-list');" value="<?php echo $this->lang->line('buscar_valor'); ?>" />

								<img src="<?php echo base_url(); ?>img/modal-close.png" onClick="clear_filter('value');" title="<?php echo $this->lang->line('limpiar_valor'); ?>" />

							</div>

							<div class="explore-step-content">

								<ul id="explore-value-list">

									

								</ul>

							</div>

						</div>

					</td>
                    
                     <td>

						<!-- Explore value   -->

						<div class="title4"><?php echo $this->lang->line('seleccionar_aleacion'); ?></div>

						<div class="box1 explore-step">

							<div class="explore-step-search">

								<input type="text" class="step-search" id="composition-search" onKeyUp="filter_explore(this,'explore-composition-list');" value="<?php echo $this->lang->line('buscar_aleacion'); ?>" />

								<img src="<?php echo base_url(); ?>img/modal-close.png" onClick="clear_filter('composition');" title="<?php echo $this->lang->line('limpiar_aleacion'); ?>" />

							</div>

							<div class="explore-step-content">

								<ul id="explore-composition-list">

									

								</ul>

							</div>

						</div>

					</td>
                    
                </tr>
                
                <tr>             
                    
					<td>

						<div class="title4"><?php echo $this->lang->line('explore_phonecards_seleccionar_ano'); ?></div>

                            <div id="year-container">
    
                                <select id="explore-year" onChange="explore_year(this);" >
    
                                    <option value="AllYears"><?php echo $this->lang->line('explore_phonecards_todos_ano'); ?></option>
    
                                    <option value="Unknown"><?php echo $this->lang->line('explore_phonecards_desconocido'); ?></option>
    
                                    <?php
    
                                        for ( $i = 0 ; $i < count($years) ; $i++ ){
    
                                            ?>
    
                                            <option value="<?php echo $years[$i]; ?>" ><?php echo $years[$i]; ?></option>
    
                                            <?php
    
                                        }
    
                                    ?>
    
                                </select>
    
                            </div>

						<div>

					</td> 
                    
                    <td>
                    	<div id="explore-go">

                            <!-- Explore year -->
    
                            
    
                                <span id="test0"></span>
    
                                <span class="google-button google-button-blue" onClick="send_explore_coin();" >
    
                                    <img id="explore-img" src="<?php echo base_url(); ?>img/explore2.png" width="16" height="16" />
    
                                    <?php echo $this->lang->line('explore_phonecards_explorar_tarjetas'); ?>!
    
                                </span>
    
                            </div>
    
                        </div>
                    </td>

				</tr>

			</table>

		</div>

         

	</div>	

</div>
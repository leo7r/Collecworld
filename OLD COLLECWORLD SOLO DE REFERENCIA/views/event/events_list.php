<!--To Start-->
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});
		
		<?php
			if ( isset($intro_event) && $intro_event == 0 ){
				?>
				modalIntroduction(4);
				<?php
			}
		?>
		
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
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('event_listado_eventos'); ?></a>&nbsp;&raquo;
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
    	
        <div style="float:right;">
			<a class="google-button google-button-blue" href="<?php echo base_url(); ?>index.php/event/create"><?php echo $this->lang->line('event_crear_evento'); ?></a>
        </div>
    
		<div class="title4"><?php echo $this->lang->line('event_eventos_en'); ?> <?php echo $logged_user['Country']; ?></div>
		<div>
			<?php
				$country_category = 0;				
				
				if ( count($country_events) == 0 ){
					?>
                    <div class="title41"><?php echo $this->lang->line('event_no_existen_eventos_en_tu_pais'); ?></div>
                    <?php	
				}
				else{
					for ( $i = 1 ; $i <= count($country_events) ; $i++ ){
						?>
                        <table cellpadding="10">
                        <?php
						for ( $j = 0 ; $j < count($country_events[$i]) ; $j++ ){
							
							if ( $j == 0 ){
								switch($country_events[$i][$j]['id_categories']){
								
								case 1:
									$cat_name = $this->lang->line('tarjetas_telefonicas');
									break;
								case 2:
									$cat_name = $this->lang->line('monedas');
									break;
								case 3:
									$cat_name = $this->lang->line('billetes');
									break;
								case 4:
									$cat_name = $this->lang->line('estampillas');
									break;
								}
								
								echo '<div class="title42">'.$cat_name.'</div>';
							}
							
							if ( $j % 3 == 0 ){
								echo '<tr>';	
							}
							
							$map_center = str_replace(' ','+',$country_events[$i][$j]['place']);
							
							$map_url = 'http://maps.googleapis.com/maps/api/staticmap?center='.$map_center.'&zoom=14&size=300x200&maptype=roadmap&sensor=false';
							
							?>
								<td class="event_box">
									<a href="<?php echo base_url(); ?>index.php/event/<?php echo $country_events[$i][$j]['id_events']; ?>">
									<div class="box1" style="width:300px;">
										<img src="<?php echo $map_url; ?>" width="300px" height="200px" />
										<table cellpadding="5">
											<tr>
												<td><b><?php echo $this->lang->line('nombre'); ?>:</b></td>
												<td><?php echo $country_events[$i][$j]['name']; ?></td>
											</tr>
											<tr>
												<td><b><?php echo $this->lang->line('pais'); ?>:</b></td>
												<td><?php echo $country_events[$i][$j]['event_country']; ?></td>
											</tr>
											<tr>
												<td><b><?php echo $this->lang->line('lugar'); ?>:</b></td>
												<td><?php echo $country_events[$i][$j]['place']; ?></td>
											</tr>
											<tr>
												<td><b><?php echo $this->lang->line('fecha'); ?>:</b></td>
												<td><?php echo date('l, d F Y',$country_events[$i][$j]['date']); ?></td>
											</tr>
										</table>
									</div>
									</a>
								</td>
							<?php
							
							if ( $j % 3 == 2 || $j == count($country_events[$i])-1 ){
								echo '</tr>';
							}
							
						}
						?>
                        </table>
                        <?php
					}
				}
				
			?>
		</div>
		<div class="title4"><?php echo $this->lang->line('event_eventos_otros_paises'); ?></div>
		<div>
        	<table>
			<?php
				$other_category = 0;
			
				if ( count($other_events) == 0 ){
					?>
                    <div class="title41"><?php echo $this->lang->line('event_no_eventos_otros_paises'); ?></div>
                    <?php
				}
				else{
					
					for ( $i = 1 ; $i <= count($other_events) ; $i++ ){
						
						?>
                        <table cellpadding="10">
                        <?php
						for ( $j = 0 ; $j < count($other_events[$i]) ; $j++ ){
							
							if ( $j == 0 ){
								switch($other_events[$i][$j]['id_categories']){
								
								case 1:
									$cat_name = $this->lang->line('tarjetas_telefonicas');
									break;
								case 2:
									$cat_name = $this->lang->line('monedas');
									break;
								case 3:
									$cat_name = $this->lang->line('billetes');
									break;
								case 4:
									$cat_name = $this->lang->line('estampillas');
									break;
								}
								
								echo '<div class="title42">'.$cat_name.'</div>';
							}
							
							if ( $j % 3 == 0 ){
								echo '<tr>';	
							}
							
							$map_center = str_replace(' ','+',$other_events[$i][$j]['place']);
							
							$map_url = 'http://maps.googleapis.com/maps/api/staticmap?center='.$map_center.'&zoom=14&size=300x200&maptype=roadmap&sensor=false';
							
							?>
								<td class="event_box">
									<a href="<?php echo base_url(); ?>index.php/event/<?php echo $other_events[$i][$j]['id_events']; ?>">
									<div class="box1" style="width:300px;">
										<img src="<?php echo $map_url; ?>" width="300px" height="200px" />
										<table cellpadding="5">
											<tr>
												<td><b><?php echo $this->lang->line('nombre'); ?>:</b></td>
												<td><?php echo $other_events[$i][$j]['name']; ?></td>
											</tr>
											<tr>
												<td><b><?php echo $this->lang->line('pais'); ?>:</b></td>
												<td><?php echo $other_events[$i][$j]['event_country']; ?></td>
											</tr>
											<tr>
												<td><b><?php echo $this->lang->line('lugar'); ?>:</b></td>
												<td><?php echo $other_events[$i][$j]['place']; ?></td>
											</tr>
											<tr>
												<td><b><?php echo $this->lang->line('fecha'); ?>:</b></td>
												<td><?php echo date('l, d F Y',$other_events[$i][$j]['date']); ?></td>
											</tr>
										</table>
									</div>
									</a>
								</td>
							<?php
							
							if ( $j % 3 == 2 || $j == count($other_events[$i])-1 ){
								echo '</tr>';
							}
							
						}
						?>
                        </table>
                        <?php
					}	
				}
				
			?>
            </table>
		</div>
	</div>
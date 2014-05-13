<!-- jQuery UI -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css" type="text/css" />

<!-- Google maps -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyDOLpCu5-EeM9et2fCu5309Mfo2XqNvVgE"></script>

<!--To Start-->
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});
		
		err = $(document).getUrlParam('err');
		if ( err ){
			showGlobalInfo('Event is already created, please try again.');
		}
		
		$("#datepicker").datepicker({
			minDate : 0,
			altField : "#date",
			altFormat : "yy-mm-dd"
		});
		
		
		<?php
			if ( isset($intro_create_event) && $intro_create_event == 0 ){
				?>
				modalIntroduction(5);
				<?php
			}
		?>
		
	});
	
	function send(){

		name = document.getElementById('event-name').value;
		place = document.getElementById('event-place').value;
		description = document.getElementById('event-description').value;
		country = document.getElementById('event-country').value;
		category = document.getElementById('event-category').value;
		showAlert="";
		if ( name.length == 0){ 
			showAlert+="<?php echo $this->lang->line('nombre_no_valido').'<br>'; ?>";
		}
		if ( country == -1){
			showAlert+="<?php echo $this->lang->line('pais_no_valido').'<br>'; ?>";
		} 
		if (  place.length == 0){
			showAlert+="<?php echo $this->lang->line('lugar_no_valido').'<br>'; ?>";
		}
		if (category == -1 ){
			showAlert+="<?php echo $this->lang->line('categoria_no_valida').'<br>'; ?>";
 		}		
 		if ( description.length == 0){
			showAlert+="<?php echo $this->lang->line('descripcion_no_valido').'<br>'; ?>";
		} 
		
			if(showAlert==""){
			document.getElementById('event_form').submit();
			}else{
			 	showGlobalInfo(showAlert);
			}
	}
	
	function invite_all(){
		$("#event-invite-friends input:checkbox").prop('checked',true);
	}
	
	function initialize() {
		var input = document.getElementById('event-place');
		var autocomplete = new google.maps.places.Autocomplete(input);
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
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('event_crear_evento'); ?> </a>&nbsp;&raquo;
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
			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{backs:'../',done:'../account'});
		</script>					
	</div>
	
	<div id="content-in">
		<div class="box1" style="width:500px; margin-left:auto; margin-right:auto;">
			<div class="title4"><?php echo $this->lang->line('nuevo_evento_titulo'); ?></div>
			<form id="event_form" method="post" action="create_go">
				<table cellpadding="10">
					<tr>
						<td class="title42"><?php echo $this->lang->line('organizador'); ?></td>
						<td>
							<table>
								<tr>
									<td><img class="user_image" src="<?php echo base_url(); ?>users/img/<?php echo $_SESSION['img']; ?>" /></td>
									<td><?php echo $_SESSION['name']; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('nombre_evento'); ?></td>
						<td><input id="event-name" name="name" type="text" class="upload-input" /></td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('pais'); ?></td>
						<td>
							<select id="event-country" name="country">
								<option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>
								<?php
									for ( $i = 0 ; $i < count($countries) ; $i++ ){
										?>
										<option value="<?php echo $countries[$i]['id_countries']; ?>"><?php echo $countries[$i]['name']; ?></option>
										<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('lugar'); ?></td>
						<td><input id="event-place" name="place" type="text" class="upload-input" /></td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('fecha'); ?></td>
						<td><div id="datepicker"></div></td>
						<input type="hidden" id="date" name="date" />
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('event_categoria'); ?></td>
						<td>
							<select id="event-category" name="category">
								<option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>
								<?php
									for ( $i = 0 ; $i < count($categories) ; $i++ ){
										$selected = $categories[$i]['id_categories'] == $event['id_categories'];
										$cat_trad = '';
										
										switch( $categories[$i]['id_categories'] ){
										
										case 1:
											$cat_trad =$this->lang->line('tarjetas_telefonicas');
											break;
										case 2:
											$cat_trad =$this->lang->line('monedas');
											break;
										case 3:
											$cat_trad =$this->lang->line('billetes');
											break;
										case 4:
											$cat_trad =$this->lang->line('estampillas');
											break;
										}
										
										
										?>
										<option <?php if ( $selected ) echo 'selected="selected"'; ?> value="<?php echo $categories[$i]['id_categories']; ?>">
											<?php echo $cat_trad; ?>
										</option>
										<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('descripcion'); ?></td>
						<td><textarea id="event-description" name="description" class="upload-input"></textarea></td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('invitar_amigos'); ?></td>
						<td>
							<a onClick="invite_all();"><?php echo $this->lang->line('invitar_todos'); ?></a>
							<div id="event-invite-friends" >
								<table>
									<?php										
										
										for ( $i = 0 ; $i < count($friends) ; $i++ ){
											
											if ( $i % 2 == 0 ){
												echo '<tr>';
											}
											?>
											<td>
												<table>
													<tr>
														<td>
															<input type="checkbox" id="friend<?php echo $i; ?>" name="friends[]" value="<?php echo $friends[$i]['id_users']; ?>" />
														</td>
														<td onClick="document.getElementById('friend<?php echo $i; ?>').click();">
															<img class="user_image" src="<?php echo base_url(); ?>users/img/<?php echo $friends[$i]['image']; ?>" />
														</td>
														<td onClick="document.getElementById('friend<?php echo $i; ?>').click();">
															<?php echo $friends[$i]['name']; ?>
														</td>
													</tr>
												</table>
											</td>
											<?php
										
											if ( $i % 2 == 1 ){
												echo '</tr>';
											}
											
										}										
										
									?>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td class="title42">
							<input type="checkbox" name="private" />
							<span onMouseOver="showInfo(this,'<?php echo $this->lang->line('evento_privado_ayuda'); ?>.')"><?php echo $this->lang->line('event_evento_privado'); ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="button" class="google-button google-button-blue" value="<?php echo $this->lang->line('crear_evento'); ?>" onClick="send();" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
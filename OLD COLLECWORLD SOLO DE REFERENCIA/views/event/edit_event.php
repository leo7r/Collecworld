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
				
		$("#datepicker").datepicker({
			minDate : "<?php echo date('Y-m-d',time()); ?>",
			altField : "#date",
			altFormat : "yy-mm-dd",
			dateFormat : "yy-mm-dd"
		});
		
		$("#datepicker").datepicker("setDate","<?php echo date('Y-m-d',$event['date']); ?>");
		
	});
	
	function send(){
	
		name = document.getElementById('event-name').value;
		place = document.getElementById('event-place').value;
		description = document.getElementById('event-description').value;
		country = document.getElementById('event-country').value;
		category = document.getElementById('event-category').value;
		
		if ( name.length > 0 && place.length > 0 && description.length > 0 && country != -1 && category != -1 ){
			
			document.getElementById('event_form').submit();
		}
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
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('editar'); ?> <b><?php echo $event['name']; ?></b></a>&nbsp;&raquo;
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
			<form id="event_form" method="post" action="edit_go">
				<input type="hidden" value="<?php echo $event['id_events']; ?>" name="id_event" />
				<table cellpadding="10">
					<tr>
						<td class="title42"><?php echo $this->lang->line('organizador'); ?></td>
						<td>
							<table>
								<tr>
									<td><img class="user_image" src="<?php echo base_url(); ?>users/img/<?php echo $event['image']; ?>" /></td>
									<td><?php echo $event['uname']; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('nombre_evento'); ?></td>
						<td><input id="event-name" name="name" type="text" class="upload-input" value="<?php echo $event['name']; ?>" /></td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('pais'); ?></td>
						<td>
							<select id="event-country" name="country">
								<option value="-1">Select</option>
								<?php
									for ( $i = 0 ; $i < count($countries) ; $i++ ){
										?>
										<option <?php if ( $countries[$i]['id_countries'] == $event['id_countries'] ) echo 'selected="selected"'; ?> value="<?php echo $countries[$i]['id_countries']; ?>">
											<?php echo $countries[$i]['name']; ?>
										</option>
										<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('lugar'); ?></td>
						<td><input id="event-place" name="place" type="text" class="upload-input" value="<?php echo $event['place']; ?>" /></td>
					</tr>
					<tr>
						<td class="title42"><?php echo $this->lang->line('fecha'); ?></td>
						<td><div id="datepicker"></div></td>
						<input type="hidden" id="date" name="date" value="<?php echo $event['date']; ?>" />
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
						<td><textarea id="event-description" name="description" class="upload-input" ><?php echo $event['description']; ?></textarea></td>
					</tr>
					<tr>
						<td class="title42">
							<input type="checkbox" name="private" <?php if ( $event['private'] == 1 ) echo 'checked="checked"'; ?> />
							<span onmouseover="showInfo(this,'Only visible for friends you invited')"><?php echo $this->lang->line('event_evento_privado'); ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="button" class="google-button google-button-blue" value="<?php echo $this->lang->line('event_editar_evento'); ?>" onClick="send();" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
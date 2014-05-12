<!--To Start-->
<script type="text/javascript">
	
	$(document).ready(function(){
		
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
<script>
		
	var b_0 = false;
	var b_1 = false;
	var b_2 = false;
	var b_3 = false;

	function check( id , num ){
	
		info = document.getElementById(id+'_i');
		switch( num ){
			
			case 0:
				
				inp = document.getElementById(id);
				
				if ( inp.value.length == 0 ){
					info.innerHTML = '<?php echo $this->lang->line('escribir_nombre'); ?>';
					info.className = 'reg_info';
					b_0 = false;
				} 
				else{
					if ( inp.value.search("[A-za-z]+") == -1 ){
						info.innerHTML = '<?php echo $this->lang->line('escribir_nombre'); ?>';
						info.className = 'reg_info0';
						b_0 = false;
					}
					else{
						info.innerHTML = '<?php echo $this->lang->line('tu_nombre_esta_genial'); ?>';
						info.className = 'reg_info1';
						b_0 = true;
					}
				}
				
				break;
				
			case 1:
				
				inp = document.getElementById(id);
				
				
				if ( inp.value.length == 0 ){
					info.innerHTML = '<?php echo $this->lang->line('direccion_correo_electronico'); ?>';
					info.className = 'reg_info';
					b_1 = false;
				} 
				else{
					if ( inp.value.search("[a-zA-Z0-9]+@[a-zA-Z0-9]+[\.][a-zA-Z]{2,}") == -1 ){
						info.innerHTML = '<?php echo $this->lang->line('correo_electronico_invalido'); ?>';
						info.className = 'reg_info0';
						b_1 = false;
					}
					else{
						info.innerHTML = '<?php echo $this->lang->line('enviaremos_correo_confirmacion'); ?>';
						info.className = 'reg_info1';
						b_1 = true;
					}
				}
				
				break;
				
			case 2:
				
				inp = document.getElementById(id);
								
				if ( inp.value.length < 4 ){
					info.innerHTML = '<?php echo $this->lang->line('al_menos_4_caracteres'); ?>';
					info.className = 'reg_info0';
					b_2 = false;
				}
				else{
					if ( inp.value.search("[A-Z. \\/~!@#$%&*()`\^\<\>\:\;\']") != -1 ){
						info.className = "reg_info0";
						info.innerHTML = "<?php echo $this->lang->line('nombre_usuario_sin_mayusculas_espacios'); ?>";
						b_2 = false;
					}
					else{
						info.innerHTML = 'Checking...';
						user_val(inp.value , id );
					}
				}
				
				break;
				
			case 3:
				
				inp = document.getElementById(id);
				
				if ( inp.value.length == 0 ){
					info.innerHTML = '<?php echo $this->lang->line('al_menos_6_caracteres'); ?>';
					info.className = 'reg_info';
					b_3 = false;
				} 
				else{
					if ( inp.value.search(".{6,}") == -1 ){
						info.innerHTML = '<?php echo $this->lang->line('al_menos_6_caracteres'); ?>';
						info.className = 'reg_info0';
						b_3 = false;
					}
					else{
						info.innerHTML = '<?php echo $this->lang->line('contrasena_cumple_requisitos'); ?>';
						info.className = 'reg_info1';
						b_3 = true;
					}
				}
				
				break;			
			
			
		}
	}
	
	function send(){
		
		email = document.getElementById('email').value;
		email2 = document.getElementById('email2').value;
		
		if ( b_0 && b_1 && b_2 && b_3 && country != -1 && ( email == email2 ) ){ 
			document.getElementById('signup-form').submit();
		}
		else{
			if ( email == email2 ){
				showGlobalInfo('<?php echo $this->lang->line('completa_todos_los_campos'); ?>');
			}
			else{
				showGlobalInfo('<?php echo $this->lang->line('correo_electronico_invalido'); ?>');
			}
		}
		
	}
	
	function user_val( user , id ){
		
		
		if ( user.length < 4 ){
			return;
		}
		
		div = document.createElement('div');
		$(div).load(path+'ajax/signup/valid.php',{user:user},function(){
			
			info = document.getElementById(id+'_i');
			
			if ( parseInt(div.innerHTML) == 0 ){
				info.className = 'reg_info1';
				info.innerHTML = user+' <?php echo $this->lang->line('esta_disponible'); ?>';
				b_2 = true;
			}
			else{
				info.className = 'reg_info0';
				info.innerHTML = user+' <?php echo $this->lang->line('actualmente_en_uso'); ?>';
				b_2 = false;
			}
			
		});
	}

</script>

<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('acceder'); ?></a>&nbsp;&raquo;
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
							<a href="<?php echo base_url(); ?>index.php/account/#sec=3">
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
		?>
			
		</div>
	</div>
				
	<div id="content-in">
		<div id="info-info">
			<?php echo $this->lang->line('para_visualizar_esta_pagina'); ?> <span style="color:#06f;"><?php echo $this->lang->line('iniciar_sesion'); ?> </span> <?php echo $this->lang->line('o'); ?> <span style="color:#FF3300"><?php echo $this->lang->line('crear_una_cuenta'); ?></span>
		</div>
		<table id="login-table">
			<tr>
				<td valign="top" style="width:500px">
					<div id="fast-signin" class="box1">
						<div id="r-title">
							<span class="title4"><?php echo $this->lang->line('conectar'); ?></span>
						</div>
						
						<div id="fast-signin-form" style="border-bottom:none;">
							<form action="<?php echo base_url(); ?>index.php/init" method="post">
								<table cellpadding="10">
									<tr>
										<td><?php echo $this->lang->line('usuario'); ?></td>
										<td><input type="text" name="user" class="input0" /></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('contrasena'); ?></td>
										<td><input type="password" name="pass" class="input0" /></td>
									</tr>
									<tr>
										<td><a href="#"><?php echo $this->lang->line('olvidar_contrasena'); ?></a></td>
										<td><input type="submit" value="<?php echo $this->lang->line('acceder'); ?>" class="google-button google-button-blue" /></td>
									</tr>
								</table>
							</form>
						</div>						
					</div>
				</td>
				<td valign="top">
					<div id="fast-signup" class="box1">
						<div id="r-title">
							<span class="title41"><?php echo $this->lang->line('registrarse'); ?></span>
						</div>
						<div id="fast-signup-form">
							<form id="signup-form" action="<?php echo base_url(); ?>index.php/signup" method="post">
								<table id="reg_usr" cellspacing="15px">
									<tr>
										<td><?php echo $this->lang->line('nombre'); ?>: </td>
										<td><input type="text" id="name" name="name" onkeyup="check('name',0)" onblur="check('name',0);" class="input0" /></td>
										<td class="reg_info" id="name_i"><?php echo $this->lang->line('escribir_nombre'); ?>.</td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('correo_electronico'); ?>: </td>
										<td><input class="input0" type="text" id="email" name="email" onkeyup="check('email',1);" onblur="check('email',1);" /></td>
										<td class="reg_info"  id="email_i"><?php echo $this->lang->line('direccion_correo_electronico'); ?>.</td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('confirmar_correo_electronico'); ?>: </td>
										<td><input class="input0" type="text" id="email2" name="email2" /></td>
										<td class="reg_info"  id="email2_i"><?php echo $this->lang->line('repetir_correo_electronico'); ?>.</td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('usuario'); ?>: </td>
										<td><input class="input0" type="text" id="user" name="user" onkeyup="check('user',2);" onblur="check('user',2);" /></td>
										<td class="reg_info"  id="user_i"><?php echo $this->lang->line('nombre_de_usuario'); ?>.</td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('contrasena'); ?>: </td>
										<td><input class="input0" type="password" id="pass" name="pass" onkeyup="check('pass',3);" onblur="check('pass',3);" /></td>
										<td class="reg_info"  id="pass_i"><?php echo $this->lang->line('al_menos_6_caracteres'); ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('pais'); ?>: </td>
										<td>
											<select id="country" name="country">
												<option selected="selected" value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>
												<?php
													for ($i=0 ; $i < count($countries) ; $i++){
														echo '<option value="'.$countries[$i]['id_countries'].'" >'.$countries[$i]['name'].'</option>';
													}
												?>							
											</select>
										</td>
									</tr>
									<tr>
										<td><input type="button" value="<?php echo $this->lang->line('registrarse'); ?>" onclick="send();" class="google-button google-button-red" /></td>
									</tr>
								</table>
							</form>
						</div>						
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
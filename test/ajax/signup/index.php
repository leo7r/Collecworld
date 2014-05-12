<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 

?>
<script>
	
	var path = "<?php echo $_REQUEST['path']; ?>";
		
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
					info.innerHTML = '<?php echo $lang['escribir_nombre']; ?>.';
					info.className = 'reg_info';
					b_0 = false;
				} 
				else{
					if ( inp.value.search("[A-za-z]+") == -1 ){
						info.innerHTML = '<?php echo $lang['escribir_nombre']; ?>.';
						info.className = 'reg_info0';
						b_0 = false;
					}
					else{
						info.innerHTML = '<?php echo $lang['tu_nombre_esta_genial']; ?>.';
						info.className = 'reg_info1';
						b_0 = true;
					}
				}
				
				break;
				
			case 1:
				
				inp = document.getElementById(id);
				
				
				if ( inp.value.length == 0 ){
					info.innerHTML = '<?php echo $lang['direccion_correo_electronico']; ?>.';
					info.className = 'reg_info';
					b_1 = false;
				} 
				else{
					if ( inp.value.search("[a-zA-Z0-9]+@[a-zA-Z0-9]+[\.][a-zA-Z]{2,}") == -1 ){
						info.innerHTML = '<?php echo $lang['correo_electronico_invalido']; ?>.';
						info.className = 'reg_info0';
						b_1 = false;
					}
					else{
						info.innerHTML = '<?php echo $lang['enviaremos_correo_confirmacion']; ?>.';
						info.className = 'reg_info1';
						b_1 = true;
					}
				}
				
				break;
				
			case 2:
				
				inp = document.getElementById(id);
								
				if ( inp.value.length < 4 ){
					info.innerHTML = '<?php echo $lang['al_menos_4_caracteres']; ?>.';
					info.className = 'reg_info';
					b_2 = false;
				}
				else{
					if ( inp.value.search("[A-Z. \\/~!@#$%&*()`\^\<\>\:\;\']") != -1 ){
						info.className = "reg_info0";
						info.innerHTML = "<?php echo $lang['nombre_usuario_sin_mayusculas_espacios']; ?>.";
						b_2 = false;
					}
					else{
						info.innerHTML = '<?php echo $lang['revisando']; ?>';
						user_val(inp.value , id );
					}
				}
				
				break;
				
			case 3:
				
				inp = document.getElementById(id);
				
				if ( inp.value.length == 0 ){
					info.innerHTML = '<?php echo $lang['al_menos_6_caracteres']; ?>.';
					info.className = 'reg_info';
					b_3 = false;
				} 
				else{
					if ( inp.value.search(".{6,}") == -1 ){
						info.innerHTML = '<?php echo $lang['al_menos_6_caracteres']; ?>.';
						info.className = 'reg_info0';
						b_3 = false;
					}
					else{
						info.innerHTML = '<?php echo $lang['contrasena_cumple_requisitos']; ?>.';
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
			document.getElementById('signup_form').submit();
		}
		else{
			if ( email == email2 ){
				showGlobalInfo('Please, fill all the fields.');
			}
			else{
				showGlobalInfo('Invalid Email address.');
			}
		}
		
	}
	
	function user_val( user , id ){
	
		if ( user.length < 4 )
			return;
		
		div = document.createElement('div');
		$(div).load(path+'ajax/signup/valid.php',{user:user},function(){
			
			info = document.getElementById(id+'_i');
		
			if ( parseInt(div.innerHTML) == 0 ){
				info.className = 'reg_info1';
				info.innerHTML = user+' <?php echo $lang['esta_disponible']; ?>.';
				b_2 = true;
			}
			else{
				info.className = 'reg_info0';
				info.innerHTML = user+' <?php echo $lang['actualmente_en_uso']; ?>.';
				b_2 = false;
			}
			
		});
	}

</script>



<div id="modal-header">
	<div id="modal-in">
		<span class="title0"><span onClick="toSignin();" class="modal-back">&nbsp;&laquo;&nbsp;</span><?php echo $lang['registrarse']; ?></span>
		
		<div id="modal-close" class="modal-close" onClick="closeSignin();">
			<img src="<?php echo $_REQUEST['path']; ?>img/modal-close.png" height="16" width="16" />
		</div>
	</div>
</div>

<div id="modal-content">
	<form id="signup_form" action="signup" method="post">
		<table id="reg_usr" cellspacing="15px">
			<tr>
				<td><?php echo $lang['nombre']; ?>: </td>
				<td><input type="text" id="name" name="name" onkeyup="check('name',0);" onblur="check('name',0);" class="input0" /></td>
				<td class="reg_info" id="name_i"><?php echo $lang['escribir_nombre']; ?>.</td>
			</tr>
			<tr>
				<td><?php echo $lang['correo_electronico']; ?>: </td>
				<td><input class="input0" type="text" id="email" name="email" onkeyup="check('email',1);" onblur="check('email',1);" /></td>
				<td class="reg_info"  id="email_i"><?php echo $lang['direccion_correo_electronico']; ?>.</td>
			</tr>
			<tr>
				<td><?php echo $lang['confirmar_correo_electronico']; ?>: </td>
				<td><input class="input0" type="text" id="email2" name="email2" /></td>
				<td class="reg_info"  id="email2_i"><?php echo $lang['repetir_correo_electronico']; ?>.</td>
			</tr>
			<tr>
				<td><?php echo $lang['usuario']; ?>: </td>
				<td><input class="input0" type="text" id="user" name="user" onkeyup="check('user',2);" onblur="check('user',2);" /></td>
				<td class="reg_info"  id="user_i"><?php echo $lang['nombre_de_usuario']; ?>.</td>
			</tr>
			<tr>
				<td><?php echo $lang['contrasena']; ?>: </td>
				<td><input class="input0" type="password" id="pass" name="pass" onkeyup="check('pass',3);" onblur="check('pass',3);" /></td>
				<td class="reg_info"  id="pass_i"><?php echo $lang['al_menos_6_caracteres']; ?>!</td>
			</tr>
			<tr>
				<td><?php echo $lang['pais']; ?>: </td>
				<?php
					$sql = 'SELECT * FROM countries ORDER BY name';
					$cursor = mysql_query($sql);
				?>
				<td>
					<select id="country" name="country">
						<option selected="selected" value="-1" ><?php echo $lang['seleccione']; ?></option>
						<?php
							for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
								$datos = mysql_fetch_array($cursor);
								echo '<option value="'.$datos['id_countries'].'" >'.$datos['name'].'</option>';
							}
						?>							
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="button" value="<?php echo $lang['registrarse']; ?>" onclick="send();" class="google-button google-button-blue" /></td>
			</tr>
		</table>
		
	</form>
</div>

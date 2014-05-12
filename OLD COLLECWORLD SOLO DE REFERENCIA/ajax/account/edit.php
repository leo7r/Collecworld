

<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 
@session_start();

$sql = 'SELECT * FROM users WHERE id_users = '.$_SESSION['id_users'];
$cursor = mysql_query($sql);
$datos = mysql_fetch_array($cursor);

?>
<script>

function browseImg(){

	$("#edit-image").click();


}
function img_loaded(){
				name = document.getElementById('edit-image').value;

			name = name.replace('C:\\fakepath\\','');

			document.getElementById('i_info').innerHTML='<span style="color:#0c3;">'+name+' <?php echo $lang['cargada'] ; ?>.</span>';
}

</script>

<div class="title4">
	<?php echo $lang['profile_editar_perfil']; ?>
</div>

<form method="post" action="edit_user" enctype="multipart/form-data" >
	<input type="hidden" name="id" value="<?php echo $datos['id_users']; ?>" />
	<input type="hidden" name="username" value="<?php echo $datos['user']; ?>" />
	<table id="edit-table" cellspacing="10">
		<tr>
			<td><?php echo $lang['nombre_completo']; ?>:</td>
			<td><input type="text" name="name" class="edit-input" value="<?php echo $datos['name']; ?>" /></td>
		</tr>
		<tr>
			<td><?php echo $lang['genero']; ?>:</td>
			<td>
                <select name="gender" id="edit-country" >
					<?php
						if($datos['gender']){
							switch($datos['gender']){
							default: echo "<option>".$lang['seleccione']."</option><option value='Male'>".$lang['masculino']."</option><option value='Female'>".$lang['femenino']."</option>"; break;
							case 'Male': echo "<option value='Male'>".$lang['masculino']."</option><option value='Female'>".$lang['femenino']."</option>"; break;
							case 'Female': echo "<option value='Female'>".$lang['femenino']."</option><option value='Male'>".$lang['masculino']."</option>"; break;
							}
						} else{
							echo "<option>".$lang['seleccione']."</option><option value='Male'>".$lang['masculino']."</option><option value='Female'>".$lang['femenino']."</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $lang['fecha_nacimiento']; ?>:</td>
			<td>
				<select name="day" id="edit-day" >
					<option value="0" selected="selected"><?php echo $lang['dia']; ?></option>
					<?php
						for ($i=1 ; $i < 31 ; $i++){
							?>
								<option <?php echo $datos['date_born_day'] == $i ? 'selected="selected"' : '';  ?> ><?php echo $i; ?></option>
							<?php
						} 
					?>
				</select>
				
				<select name="month" id="edit-month">
					<option value="0" selected="selected"><?php echo $lang['mes']; ?></option>
					<?php
						$countries = array('January','February','March','April','May','June','July','August','September','October','November','Dicember');
						
						for ($i=0 ; $i < count($countries) ; $i++){
							?>
								<option value="<?php echo ($i+1); ?>" <?php echo $datos['date_born_month'] == ($i+1) ? 'selected="selected"' : '';  ?> ><?php echo $countries[$i]; ?></option>
							<?php
						}
					?>
				</select>
				
				<select name="year" id="edit-year">
					<option value="0" selected="selected"><?php echo $lang['ano']; ?></option>
					<?php
						for ($i = (intval(date('Y',time()))-18) ; $i > 1900 ; $i--){
							?>
								<option <?php echo $datos['date_born_year'] == $i ? 'selected="selected"' : '';  ?> ><?php echo $i; ?></option>
							<?php
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $lang['correo_electronico']; ?>:</td>
			<td><input type="text" name="email" class="edit-input" value="<?php echo $datos['email']; ?>" /></td>
		</tr>
		<tr>
			<td><?php echo $lang['pais']; ?>:</td>
			<td>
				<select id="edit-country" name="country">
					<?php
						
						$cou = 'SELECT * FROM countries';
						$couc = mysql_query($cou);
						
						for ($i=0 ; $i<mysql_num_rows($couc) ; $i++){
							$coud = mysql_fetch_array($couc);
							
							if ( $datos['id_countries'] == $coud['id_countries'] ){
								echo '<option value="'.$coud['id_countries'].'" selected="selected" >'.$coud['name'].'</option>';
							}
							else{
								echo '<option value="'.$coud['id_countries'].'" >'.$coud['name'].'</option>';
							}						
						}
					?>
				</select>
			</td>
		</tr>
		<tr id="chg-pass" >
			<td><?php echo $lang['contrasena']; ?>:</td>
			<td><span class="google-button" onclick="setNewPass();" ><?php echo $lang['cambiar_contrasena']; ?></span></td>
		</tr>
		
		<tr id="new-pass1" style="display:none;">
			<td><?php echo $lang['nueva_contrasena']; ?>:</td>
			<td><input type="password" class="edit-input" name="pass1" /></td>
		</tr>
		
		<tr id="new-pass2" style="display:none;">
			<td><?php echo $lang['repite_contrasena']; ?>:</td>
			<td><input type="password" class="edit-input" name="pass2" /></td>
		</tr>
		
		<tr>
			<td><?php echo $lang['sobre_mi']; ?>:</td>
			<td>
				<textarea name="about" id="edit-about"><?php echo $datos['about']; ?></textarea>
			</td>
		</tr>
		<tr>
			<td><?php echo $lang['moneda_corriente_defecto']; ?>:</td>
			<td>
				<select id="default-currency" name="default_currency">
					<?php
						$sql_cur = 'SELECT * FROM currencies ORDER BY name';
						$cursor_cur = mysql_query($sql_cur);
												
						for ($i=0 ; $i<mysql_num_rows($cursor_cur) ; $i++){
							$coud = mysql_fetch_array($cursor_cur);
							
							if ( $datos['id_currencies'] == $coud['id_currencies'] ){
								echo '<option value="'.$coud['id_currencies'].'" selected="selected" >'.$coud['name'].'</option>';
							}
							else{
								echo '<option value="'.$coud['id_currencies'].'" >'.$coud['name'].'</option>';
							}						
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo $lang['imagen_perfil']; ?>:</td>
			<td>
				<div><input type="file" id="edit-image" onchange="img_loaded();" name="image" accept="image/*" style="display:none;" />
				<span class="google-button" onclick="browseImg();" ><?php echo $lang['cambiar_imagen']; ?></span>
				</di><div id="i_info"></div>
			</td>
		</tr>
		<tr>
			<td><input type="submit" class="google-button google-button-blue" value="<?php echo $lang['enviar']; ?>" /></td>
			<td></td>
		</tr>
	</table>
</form>

<div id="info-info" style="margin-top:10px;">
	<?php echo $lang['informacion_no_visible_usuarios']; ?>
</div>
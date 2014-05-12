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

<div id="modal-header">
	<div id="modal-in">
		<span class="title0"><?php echo $lang['iniciar_sesion']; ?></span>
		
		<div id="modal-close" class="modal-close" onClick="closeSignin();">
			<img src="<?php echo $_REQUEST['path']; ?>img/modal-close.png" height="16" width="16" />
		</div>
	</div>
</div>

<div id="modal-loading">
	<img src="<?php echo $_REQUEST['path']; ?>img/ajax-loader.gif" height="32" width="32" />
</div>

<div id="modal-content">
	<form action="<?php echo $_REQUEST['path']; ?>index.php/signin" method="post">
    	<input type="hidden" value="<?php echo $_SERVER["REQUEST_URI"]; ?>" name="url" />
		<table id="reg_usr" cellspacing="15px">
			<tr>
				<td><?php echo $lang['usuario']; ?>: </td>
				<td><input class="input0" type="text" id="user" name="user"/></td>
				<td class="reg_info" id="name_i"><?php echo $lang['nombre_de_usuario']; ?>.</td>
			</tr>
			<tr>
				<td><?php echo $lang['contrasena']; ?>: </td>
				<td><input class="input0" type="password" id="pass" name="pass" /></td>
				<td class="reg_info"  id="email_i"><?php echo $lang['tu_contrasena']; ?></td>
			</tr>
			<input type="hidden" name="done" value="<?php echo $_REQUEST['done']; ?>" />
		</table>
		
		<div id="signup_forgot">
			<a href="#"><?php echo $lang['olvidar_contrasena']; ?></a>
		</div>
		
		<div id="signup_s">
			<input type="button" value="<?php echo $lang['registrarse']; ?>" onclick="setSignup();" class="google-button google-button-red" />
		</div>
		
		<div id="sign_s">
			<input type="submit" value="<?php echo $lang['iniciar_sesion']; ?>" class="google-button google-button-blue" />
		</div>
		
	</form>
</div>
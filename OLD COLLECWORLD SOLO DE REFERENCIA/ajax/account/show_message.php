<script>
	$(document).ready(function(){
		setPlaceHolder('quick-reply-text');
	});
</script>
<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 

session_start();

$id = $_REQUEST['id'];

$sql = "SELECT m.* , u.name , u.image , u.user , u.id_users , c.name as country FROM message m , users u , countries c WHERE m.id_message = ".$id." and m.id_sender = u.id_users and c.id_countries = u.id_countries";
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) > 0 ){
	$datos = mysql_fetch_array($cursor);
	
	if ( strcmp($datos['readed'],"0") == 0 ){
		mysql_query("UPDATE message set readed = 1 WHERE id_message = ".$id);
	}
	
	?>
	<div>
		<span onClick="accountMenu(5);" class="google-button"><?php echo $lang['atras']; ?></span>
	</div>
		<div id="message_sender">
			<a href="<?php echo $path.'index.php/'.$datos['user']; ?>">
				<img src="<?php echo $path.'users/img/'.$datos['image']; ?>" width="48" height="48" />
			</a>
			
			<span id="message_date"><?php echo date('d/m/Y h:m a',$datos['date']); ?></span>
			<span id="info_sender" class="title4">
				<a href="<?php echo $path.'index.php/'.$datos['user']; ?>"><?php echo $datos['name']; ?> (@<?php echo $datos['user']; ?>)</a>
				<span id="info_sender_country">
					<br>
					<?php echo $datos['country']; ?>
				</span>
			</span>
		</div>
	<div id="message_content">
		<p><?php echo $datos['message']; ?></p>
	</div>
	<div id="user-interaction">
		<div id="quick-reply">
			<img src="<?php echo $path.'users/img/'.$_SESSION['img']; ?>" width="32" height="32" />
			<input type="hidden" id="from" name="from" value="<?php echo $_SESSION['id_users']; ?>">
			<input type="hidden" id="to" name="to" value="<?php echo $datos['id_users']; ?>">
			<textarea id="quick-reply-text" ><?php echo $lang['respuesta_rapida']; ?></textarea>
			<br />
			<span class="google-button" id="send-reply" onclick="sendMessage('quick-reply-text')"><?php echo $lang['enviar']; ?></span>
		</div>
	</div>
	<?php
}

?>
<script>

function hideSendMessage(){
	$("#user-interaction").css({display:'none'});	
}

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


@session_start();

$sql = 'SELECT * FROM users WHERE user = "'.$_REQUEST['to'].'"';
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) !=  1 ){
	die("error");
}
else{
	$to = mysql_fetch_array($cursor);
?>

<div id="sendMessageContent" class="box1">
	<div id="sendMessageBar">
		<span class="google-button" onClick="hideSendMessage();"><?php echo $lang['cancelar']; ?></span>
		<span class="title4"><?php echo $lang['mensaje_nuevo']; ?></span>
	</div>
	<div id="sendMessageFromTo">
		<table>
			<tr>
				<td><?php echo $lang['proveniente_de']; ?>:</td>
				<td>
					<img src="<?php echo $path.'users/img/'.$_SESSION['img']; ?>" width="40" height="40" />
					<span><?php echo $_SESSION['name'].' (@'.$_SESSION['user'].')'; ?></span>
				</td>
			</tr>
			<tr>
				<td><?php echo $lang['para']; ?>:</td>
				<td>
					<img src="<?php echo $path.'users/img/'.$to['image']; ?>" width="40" height="40" />
					<span><?php echo $to['name'].' (@'.$to['user'].')'; ?></span>
				</td>
			</tr>
		</table>
	</div>
	<div id="sendMessageMessage">
		<input type="hidden" id="from" name="from" value="<?php echo $_SESSION['id_users']; ?>" />
		<input type="hidden" id="to" name="to" value="<?php echo $to['id_users']; ?>" />
		<textarea id="message"></textarea>
		<span style="margin-top:10px;" class="google-button google-button-blue" onClick="sendMessage('message');"><?php echo $lang['enviar']; ?></span>
	</div>
</div>
<?php
}
?>
<script>
function rate_user_final( option , trade , trade_user ){

	div = document.createElement('div');
	comments = $("#rate-comments").val();
	
	$(div).load(path+'ajax/trade/rate_user.php',{trade:trade,option:option,trade_user:trade_user,comments:comments},function(){
	
		if ( div.innerHTML.search('OK') != -1 ){
			document.location.reload(true);
		}
		else{
			alert(div.innerHTML);
		}
		
	});
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


$option = (int) $_REQUEST['option'];
$trade = $_REQUEST['trade'];
$trade_user = $_REQUEST['trade_user'];

switch( $option ){
	
	case 0:
		$rate_text = $lang['este_usuario_no_cumplio'];
		$rate_color = '#FF4538';
		break;
	case 1:
		$rate_text = $lang['este_usuario_cumplio'];
		$rate_color = '#18DB5C';
		break;
}

$user_sql = 'SELECT * FROM users where id_users = '.$trade_user;
$user_cursor = mysql_query($user_sql);
$user_info = mysql_fetch_array($user_cursor);

?>

<div id="show-rate">
	<div id="modal-close" class="modal-close" onClick="closeSignin();">
		<img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />
	</div>
	
	<div>
		<div class="title4"><?php echo $lang['calificar_usuario']; ?></div>
		<table cellpadding="10">
			<tr>
				<td><?php echo $lang['usuario_a_calificar']; ?>:</td>
				<td><?php echo $user_info['name']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['calificacion']; ?>:</td>
				<td style="color:<?php echo $rate_color; ?>"><?php echo $rate_text; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['comentarios_adicionales']; ?>:</td>
				<td><textarea id="rate-comments"></textarea></td>
			</tr>
			<tr>
				<td>
					<span class="google-button google-button-blue" onClick="rate_user_final(<?php echo $option; ?>,<?php echo $trade; ?>,<?php echo $trade_user; ?>)"><?php echo $lang['calificar']; ?></span>
				</td>
			</tr>
		</table>
	</div>
	
</div>
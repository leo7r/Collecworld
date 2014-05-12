<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 


function ago($time)
{
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago ";
}


session_start();

if ( !isset($_SESSION['id_users']) ){
	die('Log in first, please.');
}

$sql = 'SELECT n.* , u.* FROM notifications n , users u WHERE n.id_users = '.$_SESSION['id_users'].' AND n.id_users2 = u.id_users ORDER BY n.date DESC';

// set all notifications viewed
mysql_query('UPDATE notifications SET status = 1 WHERE id_users = '.$_SESSION['id_users']);

$cursor = mysql_query($sql);
?>

<div>
	<span class="title4"><?php echo $lang['notificaciones']; ?></span>
</div>
<div id="notification-list">

<?php
if ( mysql_num_rows($cursor) == 0 ){
	echo $lang['notifications_no_tienes_notificaciones'];
	return;
}
else{
	?>
	<table id="notification-table" cellpadding="5">
		<?php
			for ( $i=0 ; $i < mysql_num_rows($cursor) ; $i++ ){
				$datos = mysql_fetch_array($cursor);
				
				switch( $datos['type'] ){
					case 1:
						$click = 'location.href=\''.$path.'index.php/'.$datos['user'].'\'';
						$img = $path.'img/add_friend.png';
						$desc = $datos['name'].' (@'.$datos['user'].') '.$lang['notifications_ser_tu_amigo'].'.';
						break;
					case 2:
						$click = 'accountMenu(5);';
						$img = $path.'img/notif_msg.png';
						$desc = $datos['name'].' (@'.$datos['user'].') '.$lang['notifications_enviado_mensaje'].': "'.$datos['description'].'".';
						break;
					case 3:
						$click = 'location.href=\''.$path.'index.php/event/'.$datos['info'].'\'';
						$img = $path.'img/event_invitation.png';
						$desc = $datos['name'].' (@'.$datos['user'].') '.$lang['notifications_invitado_evento'].' "'.$datos['description'].'".';
						break;
					case 4:
						$click = 'accountMenu(4);';
						$img = $path.'img/trade_notification.png';
						$desc = $datos['name'].' (@'.$datos['user'].') '.$lang['notifications_quiere_comercio_compra'].'.';
						break;
					case 5:
						$click = 'accountMenu(4);';
						$img = $path.'img/trade_notification.png';
						$desc = $datos['name'].' (@'.$datos['user'].') '.$lang['notifications_quiere_comercio_intercambio'].'.';
						break;
					case 6:
						$click = 'accountMenu(4);';
						$img = $path.'img/trade_notification.png';
						$desc = $datos['name'].' (@'.$datos['user'].') '.$lang['notifications_acepto_comercio'].'.';
						break;
					case 7:
						$click = 'accountMenu(4);';
						$img = $path.'img/trade_notification.png';
						$desc = $datos['name'].' (@'.$datos['user'].') '.$lang['notifications_rechazo_comercio'].'.';
						break;
				}
				
				?>
				<tr onClick="<?php echo $click; ?>">
					<td><img src="<?php echo $path; ?>users/img/<?php echo $datos['image']; ?>" width="50" height="50" /></td>
					<td style="width:100%" valign="top">
						<?php echo $desc; ?>
						<br>
						<br>
						<img src="<?php echo $img; ?>" />
						<span onMouseOver="showInfo(this,'<?php echo date('l, d F Y',$datos['date']); ?>')" class="notification-time"><?php echo ago( $datos['date'] ); ?></span>
					</td>
				</tr>
				<?php
			}
		?>
	</table>
	<?php
}
?>
</div>
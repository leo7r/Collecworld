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
$sql = 'SELECT u.* , c.name as country from users u , friends f , countries c WHERE (f.id_users1 = '.$_SESSION['id_users'].' OR f.id_users2 = '.$_SESSION['id_users'].') AND ( f.id_users1 = u.id_users OR f.id_users2 = u.id_users ) AND c.id_countries = u.id_countries AND u.id_users <> '.$_SESSION['id_users'].' AND f.id_users1 != '.$_SESSION['id_users'].' AND f.status =0 ORDER BY f.id_friends';

$cursor = mysql_query($sql);

?>
<?php
	if ( mysql_num_rows($cursor) == 0 ){
		
	}else{
?>

<div>
	<span class="title4"><?php echo $lang['solicitudes_amistad']; ?></span>
</div>
<div id="account-friend-list">
	
	<table cellspacing="10">
	<?php
		for ( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){
			$datos = mysql_fetch_array($cursor);
			?>
			<tr>
				<td class="friend-list-img">
					<a href="<?php echo $path ?>index.php/<?php echo $datos['user']; ?>">
						<img src="<?php echo $path.'users/img/'.$datos['image']; ?>" width="50" height="50">
					</a>
				</td>
				<td valign="top">
					<a href="<?php echo $path ?>index.php/<?php echo $datos['user']; ?>"><?php echo $datos['name']; ?></a>
					<br>
					<?php echo $datos['country']; ?>
				</td>
				<td>
					<span class="google-button google-button-blue" onclick="confirm_friend(<?php echo $datos['id_users']; ?>)"><?php echo $lang['friends_confirmar_solicitud_amistad']; ?></span>
				</td>
                <td>
					<span class="google-button google-button-red" onclick="cancel_friend(<?php echo $datos['id_users']; ?>)"><?php echo $lang['friends_cancelar_solicitud_amistad']; ?></span>
				</td>
				<td>
					
				</td>
			</tr>
			<?php
		}
	?>
	</table>
<?php
	}

$sql2 = 'SELECT u.* , c.name as country from users u , friends f , countries c WHERE (f.id_users1 = '.$_SESSION['id_users'].' OR f.id_users2 = '.$_SESSION['id_users'].') AND ( f.id_users1 = u.id_users OR f.id_users2 = u.id_users ) AND c.id_countries = u.id_countries AND u.id_users <> '.$_SESSION['id_users'].' AND f.status =1 ORDER BY f.id_friends';

$cursor2 = mysql_query($sql2);

?>

<div>
	<span class="title4"><?php echo $lang['amigos']; ?></span>
</div>
<div id="account-friend-list">
	<?php
	if ( mysql_num_rows($cursor2) == 0 ){
	
	echo '<br>'.$lang['friends_sin_amigos']; 
	return;
}

	?>
	<table cellspacing="10">
	<?php
		for ( $i = 0 ; $i < mysql_num_rows($cursor2) ; $i++ ){
			$datos2 = mysql_fetch_array($cursor2);
			?>
			<tr>
				<td class="friend-list-img">
					<a href="<?php echo $path ?>index.php/<?php echo $datos2['user']; ?>">
						<img src="<?php echo $path.'users/img/'.$datos2['image']; ?>" width="50" height="50">
					</a>
				</td>
				<td valign="top">
					<a href="<?php echo $path ?>index.php/<?php echo $datos2['user']; ?>"><?php echo $datos2['name']; ?></a>
					<br>
					<?php echo $datos2['country']; ?>
				</td>
				<td>
					<span class="google-button google-button-green" onclick="delete_friend(<?php echo $datos2['id_users']; ?>,'<?php echo $datos2['user']; ?>')"><?php echo $lang['amigos']; ?></span>
				</td>
				<td>
					<a class="google-button" href="<?php echo $path; ?>index.php/<?php echo $datos2['user']; ?>?new-message=1"><?php echo $lang['enviar_mensaje']; ?></a>
				</td>
			</tr>
			<?php
		}
	?>
	</table>
</div>
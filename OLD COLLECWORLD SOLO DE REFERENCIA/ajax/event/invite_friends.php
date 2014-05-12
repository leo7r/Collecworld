<script>
	function send_invite(){
		
		num = $("#event-invite-friends input:checked").length;
		
		if ( num > 0 ){
			document.getElementById('send_invite').submit();
		}
		
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

$event = $_REQUEST['evnt'];

$sql = 'SELECT * FROM events WHERE id_events = '.$event.' LIMIT 1';
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) == 0 || !isset($_SESSION['id_users']) ){
	echo 'error';
	return;
}
else{
	
	$evnt = mysql_fetch_array($cursor);
	
	if ( $evnt['private'] == 1 ){
		echo 'error';
		return;
	}
	else{
		
		$sql_f = 'SELECT u.* FROM friends f , users u , events e WHERE f.status = 1 AND (( f.id_users1 = '.$_SESSION['id_users'].' AND u.id_users = f.id_users2 ) OR ( f.id_users2 = '.$_SESSION['id_users'].' AND u.id_users = f.id_users1 )) AND e.id_events = '.$event.' AND u.id_users <> e.id_users AND u.id_users NOT IN ( SELECT id_users FROM event_invitation WHERE id_events = '.$event.' )';
		$cursor_f = mysql_query($sql_f);
		
		?>
		<div id="event-invite-friends" class="box1" >
			<div class="title42" id="title-invite">
				<?php echo $lang['invitar_amigos']; ?>
			</div>
			<?php
				if ( mysql_num_rows($cursor_f) > 0 ){
			?>
			<a style="margin-left:5px" onclick="invite_all();"><?php echo $lang['invitar_todos']; ?></a>
			<form id="send_invite" action="<?php echo $path; ?>index.php/event/<?php echo $event; ?>/invite" method="post">
				<table>
					<?php										
						
						for ( $i = 0 ; $i < mysql_num_rows($cursor_f) ; $i++ ){
							
							$friend = mysql_fetch_array($cursor_f);					
							if ( $i % 2 == 0 ){
								echo '<tr>';
							}
							?>
							<td>
								<table>
									<tr>
										<td>
											<input type="checkbox" id="friend<?php echo $i; ?>" name="friends[]" value="<?php echo $friend['id_users']; ?>" />
										</td>
										<td onclick="document.getElementById('friend<?php echo $i; ?>').click();">
											<img class="user_image" src="<?php echo $path; ?>users/img/<?php echo $friend['image']; ?>" />
										</td>
										<td onclick="document.getElementById('friend<?php echo $i; ?>').click();">
											<?php echo $friend['name']; ?>
										</td>
									</tr>
								</table>
							</td>
							<?php
						
							if ( $i % 2 == 1 ){
								echo '</tr>';
							}
							
						}										
						
					?>
				</table>
			</form>
			<?php
				}
				else{
					?>
					<div class="title31"><?php echo $lang['no_hay_amigos_para_invitar']; ?></div>
					<?php
				}
			?>
		</div>
		<?php
			if ( mysql_num_rows($cursor_f) > 0 ){
		?>
		<div style="margin-top:5px;">
			<span onClick="send_invite()" class="google-button google-button-blue"><?php echo $lang['invitar']; ?></span>
		</div>
		<?php
			}
	}
	
}

?>
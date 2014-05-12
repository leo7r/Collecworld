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

function trimm( $str , $num ){
	
	if ( strlen($str) > $num ){
		$ret = substr($str,0,$num);
		$ret = $ret.'...';
		return $ret;
	}
	
	return $str;
}

$num_unread = mysql_query('SELECT * FROM message WHERE id_receiver = '.$_SESSION['id_users'].' AND readed = 0');

$sql = 'SELECT m.* , u.name FROM message m , users u where m.id_receiver = '.$_SESSION['id_users'].' and m.id_sender = u.id_users ORDER BY date desc';
$cursor = mysql_query($sql);

?>

<div id="message_container">
	<div>
		<span class="title4"><?php echo $lang['mensajes']; ?> (<?php echo mysql_num_rows($num_unread); ?>)</span>
	</div>
	<div id="message_list">
		<ul>
		<?php
			for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
				$datos = mysql_fetch_array($cursor);
				?>
				<li onclick="showMessage(<?php echo $datos['id_message']; ?>);" >
					<?php
						if ( strcmp($datos['readed'],"0") == 0 ){
							?>
							<img class="not_readed" src="<?php echo $path; ?>img/not_readed.png" width="16" height="16" title="<?php echo $lang['sin_leer']; ?>" />
							<?php
						}
					?>
					<span class="message_sender"><?php echo $datos['name']; ?></span>
					<span class="message_description"><?php echo trimm($datos['message'],40); ?></span>
					<span class="message_date"><?php echo date('d/m/Y h:m a',$datos['date']); ?></span>
				</li>
				<?php			
			}
		?>
		</ul>
	</div>
</div>
<?php
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 

function getMonth( $month ){

	

	switch( $month ){

		case 1:

			return 'jan';

		case 2:

			return 'feb';

		case 3:

			return 'mar';

		case 4:

			return 'apr';

		case 5:

			return 'may';

		case 6:

			return 'jun';

		case 7:

			return 'jul';

		case 8:

			return 'ago';

		case 9:

			return 'sep';

		case 10:

			return 'oct';

		case 11:

			return 'nov';

		case 12:

			return 'dec';

	}

}

session_start();



if ( !isset($_SESSION['id_users']) ){

	die('Log in first, please.');

}



$sql = 'SELECT * FROM events WHERE id_users = '.$_SESSION['id_users'].' ORDER BY date DESC';

$cursor = mysql_query($sql);





	?>

	<div class="title4"><?php echo $lang['eventos']; ?></div>

	<div id="event-list">

   

    <br />

	<div class="title4"><?php echo $lang['mis_eventos']; ?></div>

	<table class="myEvents" cellpadding="5">

	<?php

	

	if ( mysql_num_rows($cursor) > 0 ){

	for ( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){

		$myEvent = mysql_fetch_array($cursor);

		

		$inv_sql = 'SELECT u.* FROM users u , event_invitation e WHERE u.id_users = e.id_users AND e.id_events = '.$myEvent['id_events'].' LIMIT 6';

		$inv_cur = mysql_query($inv_sql);

		

		?>

		<tr>

			<td class="event-date">

				<span onmouseover="showInfo(this,'<?php echo $myEvent['date']; ?>')">

					<?php

						$date = explode('-',$myEvent['date']);

						echo $date[2].'<br>'.getMonth($date[1]);

					?>

				</span>

			</td>

			<td style="width:300px;">

				<a href="<?php echo $path; ?>index.php/event/<?php echo $myEvent['id_events']; ?>">

                	<b><?php echo utf8_encode($myEvent['name']); ?></b>

                </a>

				<br>

				<?php echo utf8_encode($myEvent['place']); ?>

			</td>

			<td style="width:310px;">

				<ul id="event_invited">

					<?php

						for ( $j = 0 ; $j < mysql_num_rows($inv_cur) ; $j++ ){

							$invited = mysql_fetch_array($inv_cur);

							

							?>

							<li title="<?php echo $invited['name'].' (@'.$invited['user'].')'; ?>">

								<a href="<?php echo $path; ?>index.php/<?php echo $invited['user']; ?>">

									<img class="user_image" src="<?php echo $path; ?>users/img/<?php echo $invited['image']; ?>" />

								</a>

							</li>

							<?php

						}

					?>

				</ul>

			</td>

		</tr>

		<?php

	}

	?>

	</table>

	<?php

}



$sql = 'SELECT e.* FROM event_invitation i , events e WHERE i.id_users = '.$_SESSION['id_users'].' AND e.id_events = i.id_events ORDER BY e.date DESC';

$cursor = mysql_query($sql);



if ( mysql_num_rows($cursor) > 0 ){

	?>

    <br />

	<div class="title4"><?php echo $lang['eventos_que_te_invitaron']; ?></div>

	<table class="myEvents" cellpadding="5">

	<?php



	for ( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){

		$Event = mysql_fetch_array($cursor);

		

		$inv_sql = 'SELECT u.* FROM users u , event_invitation e WHERE u.id_users = e.id_users AND e.id_events = '.$Event['id_events'].' LIMIT 6';

		$inv_cur = mysql_query($inv_sql);

		

		?>

		<tr>

			<td class="event-date">

				<span onmouseover="showInfo(this,'<?php echo $Event['date']; ?>')">

					<?php

						$date = explode('-',$Event['date']);

						echo $date[2].'<br>'.getMonth($date[1]);

					?>

				</span>

			</td>

			<td style="width:300px;">

				<a href="<?php echo $path; ?>index.php/event/<?php echo $Event['id_events']; ?>"><b><?php echo $Event['name']; ?></b></a>

				<br>

				<?php echo $Event['place']; ?>

			</td>

			<td style="width:310px;">

				<ul id="event_invited">

					<?php

						for ( $j = 0 ; $j < mysql_num_rows($inv_cur) ; $j++ ){

							$invited = mysql_fetch_array($inv_cur);

							

							?>

							<li title="<?php echo $invited['name'].' (@'.$invited['user'].')'; ?>">

								<a href="<?php echo $path; ?>index.php/<?php echo $invited['user']; ?>">

									<img class="user_image" src="<?php echo $path; ?>users/img/<?php echo $invited['image']; ?>" />

								</a>

							</li>

							<?php

						}

					?>

				</ul>

			</td>

		</tr>

		<?php

	}

	?>

	</table>

	<?php

}



?></div>
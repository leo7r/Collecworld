<?php



if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 

	

$sql = 'SELECT a.* , u.user , u.name , u.image FROM activity a , users u WHERE u.id_users = a.id_users ORDER BY a.date DESC LIMIT 20';

$cursor = mysql_query($sql);



?>

<table id="user_activity_table" cellpadding="4">

<?php

for ($i=0 ; $i< mysql_num_rows($cursor) ; $i++){



	$datos = mysql_fetch_array($cursor);

	

	switch ( intval($datos['contribution']) ){

		

		case 0:

			$action = $lang['a_cargado_una_nueva'];

			break;

		case 1:

			$action = $lang['a_editado_una'];

			break;

		case -1:

			$action = $lang['a_creado_un'];

			break;

	}

	

	switch ( intval($datos['id_categories']) ){

		case 1:

			$category = $lang['tarjeta_telefonica'];

			$modalB = true;

			$modal = 'modalPhonecard('.$datos['id_item'].')';

			$sql2 = 'SELECT * FROM phonecards WHERE id_phonecards = '.$datos['id_item'];

			break;

		case 2:

			$category = $lang['moneda'];

			break;

		case -1:

			$category = $lang['evento'];

			$modalB = false;

			$modal = $path.'index.php/event/'.$datos['id_item'];

			$sql2 = 'SELECT * FROM events WHERE id_events = '.$datos['id_item'];

			break;

	}

	

	$cursor2 = mysql_query($sql2);

	//echo $sql2;

	

	if ( @mysql_num_rows($cursor2) > 0 ){

		$item = mysql_fetch_array($cursor2);

	

		?>

			<tr>

				<td valign="top" class="main-activity-img">

					<a href="<?php echo $path.'index.php/'.$datos['user']; ?>">

						<img src="<?php echo $path.'users/img/'.$datos['image']; ?>" />

					</a>

				</td>

				<td valign="top">

					<span class="main-activity-title">

						<a href="<?php echo $path.'index.php/'.$datos['user']; ?>"><?php echo $datos['name']; ?></a>

					</span>

					<br />

					<span class="main-activity-info">

						<?php echo $action; ?> <b><?php echo $category; ?>: </b>

                        <?php

							if ( $modalB ){

								?>

                                <a href="javascript:<?php echo $modal; ?>"><?php echo $item['name'] ?></a>

                                <?php

							}

							else{

								?>

                                <a href="<?php echo $modal; ?>"><?php echo $item['name'] ?></a>

                                <?php

							}

						?>

					</span>

				</td>

			</tr>

		<?php

	}

}

?>

</table>
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



@session_start();

$sql = 'SELECT u.* , c.name as Country FROM users u , countries c WHERE u.id_users = '.$_SESSION['id_users'].' AND c.id_countries = u.id_countries';
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) == 0 ){
	die('error');
}

$datos = mysql_fetch_array($cursor);

?>
<div class="account-separator"><?php echo $lang['informacion']; ?></div>
<div id="user-info">
	<table cellspacing="0" cellpadding="10">
		<tr>
			<td><strong><?php echo $lang['nombre']; ?>:</strong></td>
			<td><?php echo $datos['name']; ?></td>
		</tr>
		<tr>
			<td><strong><?php echo $lang['pais']; ?>:</strong></td>
			<td><img id="user-flag" src="<?php echo $path; ?>img/flag-1.png"/><?php echo $datos['Country']; ?></td>
		</tr>
		<tr>
			<td><strong><?php echo $lang['correo_electronico']; ?>:</strong></td>
			<td><?php echo $datos['email']; ?></td>
		</tr>
		<tr>
			<td><strong><?php echo $lang['fecha_registro']; ?>:</strong></td>
			<td><?php echo date('l, d F Y',$datos['registration_date']); ?></td>
		</tr>
		<tr>
			<td><strong><?php echo $lang['sobre_mi']; ?>:</strong></td>
			<td><?php echo $datos['about']; ?></td>
		</tr>
	</table>
</div>

<div class="account-separator"><?php echo $lang['actividad_reciente']; ?></div>
<div id="account-activity">
	<table cellpadding="5">
		<?php
			
			$sql2 = 'SELECT * FROM activity WHERE id_users = '.$datos['id_users'].' ORDER BY date DESC LIMIT 11';
			$cursor2 = mysql_query($sql2);
		
			for ($i = 0 ; $i< mysql_num_rows($cursor2) ; $i++){
			
				$activity = mysql_fetch_array($cursor2);
				
				switch ( intval($activity['contribution']) ){
					
					// Eventos
					case -1:
						$action = $lang['profile_creado_una'];
						$img0 = 'new_event.png';
						break;
					case 0:
						$action = $lang['profile_cargado_una_nueva']; 
						$img0 = 'upload_item.png';
						break;
					case 1:
						$action = $lang['profile_editado_una']; 
						$img0 = 'edit_item.png';
						break;
				}
				
				switch ( intval($activity['id_categories']) ){
					
					// Eventos
					case -1:
						$category = $lang['evento'];
						$modal = 'location.href=\''.$path.'index.php/event/'.$activity['id_item'].'\'';
						$sql3 = 'SELECT * FROM events WHERE id_events = '.$activity['id_item'];
						break;
					case 1:
						$category = $lang['tarjeta_telefonica'];
						$modal = 'modalPhonecard('.$activity['id_item'].')';
						$sql3 = 'SELECT * FROM phonecards WHERE id_phonecards = '.$activity['id_item'];
						break;
					case 2:
						$category = $lang['moneda'];
						break;
				}
				
				$cursor3 = mysql_query($sql3);
				
				if ( mysql_num_rows($cursor3) > 0 ){
					$item = mysql_fetch_array($cursor3);
					
					?>
						<tr>
							<td class="activity-img">
								<img src="<?php echo $path; ?>img/<?php echo $img0; ?>" height="16" width="16" />
							</td>
							<td>
								<span onmouseover="showInfo(this,'<?php echo date('l, d F Y',$activity['date']); ?>')">
									<?php 
									
										 echo ago($activity['date']);
									
										
									?>
								</span>
							</td>
							<td style="width:520px;">
								<?php echo $lang['tu']; ?> <?php echo $action.' '.$category; ?>
								<a href="javascript:<?php echo $modal; ?>">
									<b><?php echo $item['name']; ?></b>
								</a>
							</td>
						</tr>
					<?php
				}
			}
		?>
	</table>
</div>

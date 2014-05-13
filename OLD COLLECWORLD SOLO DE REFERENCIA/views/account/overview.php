<?php
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


if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

@session_start();

?>
<div class="account-separator">Information</div>
<div id="user-info">
	<table cellspacing="0" cellpadding="10">
		<tr>
			<td>Name: </td>
			<td><?php echo $user0['name']; ?></td>
		</tr>
		<tr>
			<td>Country: </td>
			<td><img id="user-flag" src="<?php echo base_url(); ?>img/flag-1.png"/><?php echo $user0['Country']; ?></td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><?php echo $user0['email']; ?></td>
		</tr>
		<tr>
			<td>Registration date: </td>
			<td><?php echo date('l, d F Y',$user0['registration_date']); ?></td>
		</tr>
	</table>
</div>

<div class="account-separator">Activity</div>
<div id="account-activity">
	<table cellpadding="5">
		<?php			
			for ($i = 0 ; $i< count($activity) ; $i++){
				
				switch ( intval($activity[$i]['contribution']) ){
					case 0:
						$action = 'uploaded a new ';
						break;
					case 1:
						$action = 'edited a ';
						break;
				}
				
				switch ( intval($activity[$i]['id_categories']) ){
					case 1:
						$category = 'phonecard';
						$modal = 'modalPhonecard('.$activity[$i]['id_item'].')';
						$sql2 = 'SELECT * FROM phonecards WHERE id_phonecards = '.$activity[$i]['id_item'];
						break;
					case 2:
						$category = 'coin';
						break;
				}
				
				$cursor2 = mysql_query($sql2);
				
				if ( mysql_num_rows($cursor2) > 0 ){
					$item = mysql_fetch_array($cursor2);
					
					?>
						<tr>
							<td class="activity-img">
								<img src="<?php echo base_url(); ?>img/activity<?php echo $activity[$i]['contribution']; ?>.png" height="16" width="16" />
							</td>
							<td>
								<?php echo ago($activity[$i]['date']); ?>
							</td>
							<td>
								<a href="javascript:<?php echo $modal; ?>">
									You <?php echo $action.' '.$category; ?> <b><?php echo $item['name']; ?></b>
								</a>
							</td>
						</tr>
					<?php
				}
			}
		?>
	</table>
</div>

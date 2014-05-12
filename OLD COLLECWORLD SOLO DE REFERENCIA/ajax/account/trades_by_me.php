<?php
if ( mysql_num_rows($myTrade_cursor) == 0 ){
	return;
}
?>

<div class="title4"><?php echo $lang['trade_comercio_solicitado_por_mi']; ?></div>

<?php

for ( $i = 0 ; $i < mysql_num_rows($myTrade_cursor) ; $i++ ){
	
	$datos = mysql_fetch_array($myTrade_cursor);
	
	$exchange_title = false;
	$buy_title = false;
	
	switch ( (int) $datos['id_categories'] ){
	
	case 1:
		$cat = $lang['tarjetas_telefonicas'];
		break;
	case 2:
		$cat = $lang['monedas'];
		break; 
	}
	
	switch ( (int) $datos['status'] ){
	
	case 0:
		$status_name = $lang['enviado'];
		$status_color = '#51CCE8';
		break;
	case 1:
		$status_name = $lang['comercio_aceptado'];
		$status_color = '#18DB5C';
		break;
	case 2:
		$status_name = $lang['comercio_rechazado'];
		$status_color = '#FF4538';
		break;
	default:
		$status_name = $lang['sin_estado'];
		$status_color = '#FF4538';
		break;	
	}
	
	if ( $datos['type'] == 1 ){
		$trade_name = $lang['compra'];
	} 
	else{
		$trade_name = $lang['intercambio'];
	}
	
	$trade_items_cursor = mysql_query($trade_items_sql);
	
	?>
	<div class="trade_items">
		<table cellpadding="5" style="width:100%; margin:0;">
			<tr>
				<td style="width:50px;">
					<img class="user_image" src="<?php echo $path.'users/img/'.$datos['image']; ?>" />
				</td>
				<td style="width:180px">
					<a href="<?php echo $path.'index.php/'.$datos['user']; ?>"><?php echo $datos['user_name']; ?></a>
					<br>
					<?php echo $datos['country']; ?>
				</td>
				<td style="width:250px; text-align:center;">
					<?php echo $lang['trade_solicitud_para'].' '.$trade_name.' ('.$cat.')'; ?>
					<br />
					<a href="<?php echo $path; ?>index.php/trade/trade_details/<?php echo $datos['id_trade']; ?>"><?php echo $lang['ver_detalle']; ?></a>
				</td>
				<td style="color:<?php echo $status_color; ?>; text-align:right;" >
					<?php echo $status_name; ?>
				</td>
			</tr>
		</table>
	</div>
	<?php
}

?>
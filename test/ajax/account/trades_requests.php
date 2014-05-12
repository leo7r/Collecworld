<script>

function answerTrade( id_trade , type ){
	
	div = document.createElement('div');
	$(div).load(path+'ajax/account/answer_trade.php',{id:id_trade,type:type},function(){
		
		if ( div.innerHTML.search('OK') != -1 ){
			accountMenu( 4 );
		}
		else{
			alert(div.innerHTML);
		}
		
	});
	
}

</script>

<?php
if ( mysql_num_rows($tradeRequest_cursor) == 0 ){
	return;
}
?>

<div class="title4"><?php echo $lang['solicitudes_comercio']; ?></div>

<?php

for ( $i = 0 ; $i < mysql_num_rows($tradeRequest_cursor) ; $i++ ){
	
	$datos = mysql_fetch_array($tradeRequest_cursor);
	
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
				<td style="width:150px">
					<a href="<?php echo $path.'index.php/'.$datos['user']; ?>"><?php echo $datos['user_name']; ?></a>
					<br>
					<?php echo $datos['country']; ?>
				</td>
				<td style="width:250px; text-align:center;">
					<?php echo $lang['trade_solicitud_para'].' '.$trade_name.' ('.$cat.')'; ?>
					<br />
					<a href="<?php echo $path; ?>index.php/trade/trade_details/<?php echo $datos['id_trade']; ?>"><?php echo $lang['ver_detalle']; ?></a>
				</td>
				<?php
					if ( $datos['status'] == 0 ){
					?>
					<td style="text-align:right;" >
						<div class="google-button google-button-blue" onClick="answerTrade(<?php echo $datos['id_trade']; ?>,1)"><?php echo $lang['aceptar']; ?></div>
						<div class="google-button google-button-red" onclick="answerTrade(<?php echo $datos['id_trade']; ?>,2)"><?php echo $lang['rechazar']; ?></div>
					</td>
					<?php
					}
					else{
					?>
					<td style="color:<?php echo $status_color; ?>; text-align:right;" >
						<?php echo $status_name; ?>
					</td>
					<?php
					}
				?>
			</tr>
		</table>
	</div>
	<?php
}

?>
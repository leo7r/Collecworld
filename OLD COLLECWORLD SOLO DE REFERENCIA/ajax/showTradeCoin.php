<script>

$(document).ready(function(){

	var id = $("#id-coin").val();
	$("#show-rightT").load(path+'ajax/showTradeCoin/information.php',{id:id});

});
	

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


$id = $_REQUEST['p'];
$type = $_REQUEST['type'];
$trade_button = $_REQUEST['button'] == 1;

$cu_sql = 'SELECT cu.* , u.name , u.image , u.user , c.name as country , cur.name as currency FROM coins_users cu , users u , countries c , currencies cur WHERE cu.id_coins_users = '.$id.' AND cu.id_users = u.id_users AND u.id_countries = c.id_countries AND cu.id_currencies = cur.id_currencies';
$cu_cursor = mysql_query($cu_sql);
$coin_user = mysql_fetch_array($cu_cursor);

if ( mysql_num_rows($cu_cursor) == 0 ){
	echo 'ERROR';
	return;	
}


?>

<div id="show-pc">

	<div id="modal-close" class="modal-close" onClick="closeSignin();">

		<img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />

	</div>

	<?php

	

	//INFORMACI�N TARJETA

	

	$sql="select * from coins where id_coins = ".$coin_user['id_coins'];

	$cursor=mysql_query($sql);

	$num=mysql_num_rows($cursor);

	

	if($num){

		$datos = mysql_fetch_array($cursor);
		$id_coins = $datos['id_coins'];		

		?>

		<table id="showPcTable">

			<tr>

				<td valign="top">

					<div id='show-left'>

						<div id="show-title"><?php echo $datos['name']; ?></div>

						<div id="show-img">
							<img id="show-image" src="<?php echo $datos['image'] ? $path.'upload/coins/'.$datos['image'] : $path.'img/default_coin.jpg'; ?>" height="196" width="300" data-zoom-image="<?php echo $datos['image'] ? $path.'upload/coins/'.$datos['image'] : $path.'img/default_coin.jpg'; ?>" />
                            
                            <form style="display:none;" id="new-image-form" action="<?php echo $path; ?>index.php/edit/coin/new_image" method="post" enctype="multipart/form-data">
								<input type="hidden" name="image-face" id="image-face" value="0" />
								<input type="hidden" id="id-coin" name="id-coin" value="<?php echo $datos['id_coins']; ?>" />
								<input type="hidden" id="onFinish" name="onFinish" />
								<input style="display:none;" type="file" id="new-image" name="new-image" onchange="launch_new_image_upload(this);" />
							</form>
                            
                        </div>

						<div id="show-img-info"><?php echo $lang['anverso']; ?></div>
						
						<div id="pc-info">
                        	<div class="title4"></div>
							<table cellpadding="10">
                            	<tr>
                                	<td>
                                    	<img src="<?php echo $path.'users/img/'.$coin_user['image']; ?>" class="user-image" />
                                    </td>
                                    <td>
                                    	<table cellpadding="3">
                                        	<tr>
                                            	<td><b><?php echo $lang['nombre_de_usuario']; ?>:</b></td>
                                                <td><?php echo $coin_user['name']; ?></td>
                                            </tr>
                                            <tr>
                                            	<td><b><?php echo $lang['pais']; ?>:</b></td>
                                                <td><?php echo $coin_user['country']; ?></td>
                                            </tr>
                                            <tr>
                                            	<td><b><?php echo $lang['estado']; ?>:</b></td>
                                                <td>
												<?php
													echo $coin_user['status_coin'] ? $coin_user['status_coin'] : $lang['no_disponible'];
												?>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td><b><?php echo $lang['precio']; ?> (<?php echo $coin_user['currency']; ?>):</b></td>
                                                <td>
												<?php
													echo $coin_user['price'] ? $coin_user['price'] : $lang['no_disponible'];
												?>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td><b><?php echo $lang['descripcion']; ?>:</b></td>
                                                <td>
												<?php
													echo $coin_user['description'] ? $coin_user['description'] : $lang['no_disponible'];
												?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <?php
                                switch( $type ){
                                
                                case 5:
                                    $trade_text = $lang['comprar_esta_tarjeta'];
									$trade_url = 'buy';
                                    break;
                                    
                                case 3:
                                    $trade_text = $lang['intercambiar_esta_tarjeta'];
									$trade_url = 'exchange';
                                    break;

                               case 35:
                               		$trade_text1 = $lang['comprar_esta_tarjeta'];
									$trade_url1 = 'buy';
                                    $trade_text2 = $lang['intercambiar_esta_tarjeta'];
									$trade_url2 = 'exchange';
                                    break;
                                }
                            ?>
                            <?php
								if ( $trade_button ){
										if($type!=35){
								?>
                                <a class="google-button google-button-red" href="<?php echo $path.'index.php/trade/'.$trade_url.'/coin/'.$id_coins.'/'.$coin_user['id_coins_users'].'/'.$coin_user['user'];?>">
                                <?php echo $trade_text; ?>
                            	</a>
                            	 <?php
                                }else{?>
                                <a class="google-button google-button-red" href="<?php echo $path.'index.php/trade/'.$trade_url1.'/coin/'.$id_coins.'/'.$coin_user['id_coins_users'].'/'.$coin_user['user'];?>">
                                <?php echo $trade_text1; ?>
                            	</a>
                            	<a class="google-button google-button-red" href="<?php echo $path.'index.php/trade/'.$trade_url2.'/coin/'.$id_coins.'/'.$coin_user['id_coins_users'].'/'.$coin_user['user'];?>">
                                <?php echo $trade_text2; ?>
                            	</a>
                                <?php	
								}
							}
							?>
                            
                            
						</div>

					</div>

				</td>

				<td valign="top">
					<div id='show-rightT'></div>
				</td>

			</tr>

		</table>
	<?php

		}

	?>

</div>
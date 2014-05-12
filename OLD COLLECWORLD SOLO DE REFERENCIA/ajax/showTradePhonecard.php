<script>

$(document).ready(function(){

	var id = $("#id-pcT").val();
	$("#show-rightT").load(path+'ajax/showTradePhonecard/information.php',{id:id});

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

$pu_sql = "SELECT pu.* , u.name , u.image , u.user , c.name as country , cu.name as currency FROM phonecards_users pu , users u , countries c , currencies cu WHERE pu.id_phonecards_users = ".$id." AND pu.id_users = u.id_users AND u.id_countries = c.id_countries AND pu.id_currencies = cu.id_currencies";
$pu_cursor = mysql_query($pu_sql);
$phonecard_user = mysql_fetch_array($pu_cursor);

if ( mysql_num_rows($pu_cursor) == 0 ){
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

	

	$sql="select * from phonecards where id_phonecards=".$phonecard_user['id_phonecards'];

	$cursor=mysql_query($sql);

	$num=mysql_num_rows($cursor);

	

	if($num){

		$datos=mysql_fetch_array($cursor);

		

		$id_phonecards=$datos['id_phonecards'];

		$id_phonecards_series=$datos['id_phonecards_series'];

		

		?>

		<table id="showPcTable">

			<tr>

				<td valign="top">

					<div id='show-left'>

						<div id="show-title"><?php echo $datos['name'].(strcmp($datos['serie_number'],'0') == 0 ? '':' - '.$datos['serie_number']); ?></div>

						<div id="show-img">

							<img id="show-image" src="<?php echo $datos['image'] ? $path.'upload/img/'.$datos['image'] : $path.'img/default_phonecard.jpg'; ?>" height="<?php if ( intval($datos['vertical_anverse']) == 1 ) echo '305'; else echo '194'; ?>" width="<?php if ( intval($datos['vertical_anverse']) == 1 ) echo '194'; else echo '305'; ?>" />
							<form style="display:none;" id="new-image-form" action="<?php echo $path; ?>index.php/edit/phonecard/new_image" method="post" enctype="multipart/form-data">

								<input type="hidden" name="image-face" id="image-face" value="0" />
								<input type="hidden" id="id-pcT" name="id-pc" value="<?php echo $datos['id_phonecards']; ?>" />
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
                                    	<img src="<?php echo $path.'users/img/'.$phonecard_user['image']; ?>" class="user-image" />
                                    </td>
                                    <td>
                                    	<table cellpadding="3">
                                        	<tr>
                                            	<td><b><?php echo $lang['nombre_de_usuario']; ?>:</b></td>
                                                <td><?php echo $phonecard_user['name']; ?></td>
                                            </tr>
                                            <tr>
                                            	<td><b><?php echo $lang['pais']; ?>:</b></td>
                                                <td><?php echo $phonecard_user['country']; ?></td>
                                            </tr>
                                            <tr>
                                            	<td><b><?php echo $lang['estado']; ?>:</b></td>
                                                <td>
												<?php
													echo $phonecard_user['status_phonecard'] ? $phonecard_user['status_phonecard'] : $lang['no_disponible'];
												?>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td><b><?php echo $lang['precio']; ?> (<?php echo $phonecard_user['currency']; ?>):</b></td>
                                                <td>
												<?php
													echo $phonecard_user['price'] ? $phonecard_user['price'] : $lang['no_disponible'];
												?>
                                                </td>
                                            </tr>
                                            <tr>
                                            	<td><b><?php echo $lang['descripcion']; ?>:</b></td>
                                                <td>
												<?php
													echo $phonecard_user['description'] ? $phonecard_user['description'] : $lang['no_disponible'];
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
                                <a class="google-button google-button-red" href="<?php echo $path.'index.php/trade/'.$trade_url.'/phonecard/'.$id_phonecards.'/'.$phonecard_user['id_phonecards_users'].'/'.$phonecard_user['user'];?>">
                                <?php echo $trade_text; ?>
                            	</a>
                                <?php
                                }else{?>
                                <a class="google-button google-button-red" href="<?php echo $path.'index.php/trade/'.$trade_url1.'/phonecard/'.$id_phonecards.'/'.$phonecard_user['id_phonecards_users'].'/'.$phonecard_user['user'];?>">
                                <?php echo $trade_text1; ?>
                            	</a>
                            	<a class="google-button google-button-red" href="<?php echo $path.'index.php/trade/'.$trade_url2.'/phonecard/'.$id_phonecards.'/'.$phonecard_user['id_phonecards_users'].'/'.$phonecard_user['user'];?>">
                                <?php echo $trade_text2; ?>
                            	</a>
                               <?php }	
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
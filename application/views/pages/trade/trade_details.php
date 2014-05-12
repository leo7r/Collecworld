<!--To Start-->
<script type="text/javascript">
	
	$(document).ready(function(){
		$('a[rel*=leanModalTP]').leanModal({ top : 40, closeButton: ".modal-close" });
		$('a[rel*=leanModal]').leanModal({ top : 62, closeButton: ".modal-close" });
		$('.input0').click(function(){					
			//
		});
		
		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});
		
	});
	
	function modalPhonecard( _p ){
	
		$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,backs:'../'},function(){
			$("#modalP").click();
		});
	}
	
	function modalRate( option , trade , trade_user ){
	
		$("#modal-rate").load(path+'ajax/showRate.php',{option:option,trade:trade,trade_user:trade_user},function(){
			$("#modalR").click();
		});
	}
	
	function modalTradePhonecard( p , trade_type ){
		$("#modal-trade-phonecard").load(path+'ajax/showTradePhonecard.php',{p:p,type:trade_type,button:0},function(){
			$("#modalTP").click();
		});
		
		
	}
	
</script>

<script type="text/javascript">
	
	function google1(){
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-35549594-1']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	}
	
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
	}
	
	$(window).ready(function(){
		
		setTimeout(function(){
			google1();					
		},1000);
	});
	
	function rate_user( option , trade , trade_user ){
		modalRate( option , trade , trade_user );
	}
	
</script>

<?php
	if ( !isset($_SESSION['id_users']) ){
		echo 'asd';
		header('Location: '.base_url().'index.php/init');
		return;
	}
?>

<a id="modalTP" style="display:none;" rel="leanModalTP" href="#modal-trade-phonecard">a</a>
<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<a id="modalR" style="display:none;" rel="leanModal" href="#modal-rate">a</a>
<div id="modal-phonecard"></div>
<div id="modal-rate"></div>
<div id="modal-trade-phonecard"></div>
	
	<div id="content">
		
		<div id="toolbar">
			<div class="in">
				<div id="toolbar-left">
					<div class="item location">
						&nbsp;<a href="<?php echo base_url().'index.php/init'; ?>"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('detalles_comercio'); ?></a>&nbsp;&raquo;
					</div>
				</div>
				
				<?php
				@session_start();
				if ( $_SESSION['user'] ){
			?>
				
				<div id="user-in" >
					<div class="separator-left"></div>
					<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png" <?php if ( isset($_SESSION['user']) ) echo 'onclick="launchMenu();"'; ?> />
					<span id="user-name">
					<?php 
						echo $_SESSION['name'];
						
						if ( $notifications ){
						?>
							<span class="notification-out">
								<a href="<?php echo base_url(); ?>index.php/account/#sec=5">
									<span title="<?php echo $this->lang->line('nueva_notificacion'); ?>" class="notification"><?php echo count($notifications); ?></span>
								</a>
							</span>
						<?php
						}
					?>
					</span> 
					<img height="35" width="35" id="user-image" alt="user image" src="<?php echo base_url(); ?>users/img/<?php echo $_SESSION['img']; ?>" />	
				</div>
			<?php
				}
				else{
			?>
				<div id="signin">
					<a id="go" onClick="setHash('sig=1');" rel="leanModal" href="#modal-signin" class="google-button google-button-blue"><?php echo $this->lang->line('iniciar_sesion'); ?></a>
				</div>
			
			<?php
				}
			?>
				
			</div>
		</div>
							
			<div id="modal-signin">
				<script>
					$("#modal-signin").load(path+'ajax/signin/index.php',{path:path});
				</script>					
			</div>
			
			<?php
				switch( $trade['type'] ){
					
				case 1:
					$trade_name = $this->lang->line('compra');
					break;
				case 2:
					$trade_name = $this->lang->line('intercambio');
					break;
					
				}
				
				switch( $trade['id_categories'] ){
					
				case 1:
					$trade_cat = $this->lang->line('tarjetas_telefonicas');
					break;
				case 2:
					$trade_cat = $this->lang->line('monedas');
					break;
					
				}
				
				switch( $trade['status'] ){
				
				case 0:
					$trade_status = $this->lang->line('enviado');
					$status_color = '#51CCE8';
					break;
				case 1:
					$trade_status = $this->lang->line('aceptado');
					$status_color = '#18DB5C';
					break;
				case 2:
					$trade_status = $this->lang->line('rechazado');
					$status_color = '#FF4538';
					break;
				default:
					$trade_status = $this->lang->line('sin_estado');
					$status_color = '#FF4538';
					break;
					
				}
				
			?>
			
			<div id="content-in">
				<div id="trade_fields" class="box1" >
					<table cellpadding="7" id="trade_field_table">
						<tr>
							<td><b><?php echo $this->lang->line('tipo'); ?>:</b></td>
							<td><?php echo $trade_name; ?> (<?php echo $trade_cat; ?>)</td>
						</tr>
						<tr>
							<td><b><?php echo $this->lang->line('fecha'); ?>:</b></td>
							<td><?php echo date('l, d F Y',$trade['date']) ?></td>
						</tr>
						<tr>
							<td><b><?php echo $this->lang->line('estado'); ?>:</b></td>
							<td style="color:<?php echo $status_color; ?>"><?php echo $trade_status; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $this->lang->line('proveniente_de'); ?>:</b></td>
							<td><?php echo $trade_user['name']; ?></td>
						</tr>
						<tr>
							<td><b><?php echo $this->lang->line('para'); ?>:</b></td>
							<td><?php echo $to_user['name']; ?></td>
						</tr>
					</table>
					<?php 
						if ( $trade['status'] == 1 && $not_rated && ( $trade_user['id_users'] == $_SESSION['id_users'] || $to_user['id_users'] == $_SESSION['id_users'] ) ){
							
							$rate_info = $this->lang->line('debes_calificar_a').' ';
													
							if ( (int) $_SESSION['id_users'] == (int) $trade_user['id_users'] ){
								$rate_info.= $to_user['name'];
								$rate_user = $to_user['id_users'];
							}
							else{
								$rate_info.= $trade_user['name'];
								$rate_user = $trade_user['id_users'];
							}
							
							$rate_info.= ' '.$this->lang->line('para_completar_este_trato');
						
							?>
							<div>
								<div id="info-info" style="margin-top:10px;">
									<?php echo $rate_info; ?>
								</div>
								<table style="margin-left:auto; margin-right:auto;">
									<tr>
										<td>
											<div class="trade-option" onClick="rate_user( 1 , <?php echo $trade['id_trade']; ?> , <?php echo $rate_user; ?> )">
												<img src="<?php echo base_url(); ?>img/rate_good.png" width="32" height="32" />
												<br>
												<?php echo $this->lang->line('bueno'); ?>
											</div>
										</td>
										<td>
											<div class="trade-option" onClick="rate_user( 0 , <?php echo $trade['id_trade']; ?> , <?php echo $rate_user; ?> )">
												<img src="<?php echo base_url(); ?>img/rate_bad.png" width="32" height="32" />
												<br>
												<?php echo $this->lang->line('malo'); ?>
											</div>
										</td>
									</tr>
								</table>
							</div>
							<?php
						}
						
						if ( $trade_users && $trade['status'] == 1 ){
						
							?>
							
							<div class="title4">
								<?php echo $this->lang->line('calificaciones'); ?>
							</div>
							
							<table cellpadding="5">
							<?php
							
							for ( $i = 0 ; $i < count($trade_users) ; $i++ ){
								
								switch( $trade_users[$i]['calification'] ){
									
									case 0:
										$calif_img = 'rate_bad.png';
										break;
									case 1:
										$calif_img = 'rate_good.png';
										break;
								}
								?>
								<tr>
									<td><?php echo $trade_users[$i]['name']; ?></td>
									<td><img src="<?php echo base_url().'img/'.$calif_img; ?>" width="32" height="32" /></td>
								</tr>
								<?php
							}
							?>
							</table>
							<?php
						}
					?>
				</div>
				<div id="trade_items">
					<?php
						if ( $trade['type'] == 2 ){
					?>
					<table id="trade_items_table" cellpadding="5" cellspacing="10">
						<tr>
							<td width="400px" valign="top">
								<div class="box1">
									<table width="100%" cellpadding="5">
									<tr>
										<td class="title4">
											<?php
												echo $this->lang->line('parte_de').' '.$trade_user['name'];
											?>
										</td>
									</tr>
									<?php
										for ( $i = 0 ; $i < count($items0) ; $i++ ){
											
											$item = $items0[$i];
											
											switch( $trade['id_categories'] ){
											
											case 1:
												$item_click = "javascript:modalTradePhonecard(".$item['id_phonecards_users'].",1)";
												break;
											}
										
											?>
											<tr>
												<td><a href="<?php echo $item_click; ?>"><?php echo $item['name']; ?></a></td>
												<td><?php echo $item['company']; ?></td>
												<td><?php echo $item['country']; ?></td>
											</tr>
											<?php
										}
									?>
									</table>
								</div>
							</td>
							<td width="400px" valign="top">
								<div class="box1">
									<table width="100%" cellpadding="5">
									<tr>
										<td class="title4">
											<?php
												echo $this->lang->line('parte_de').' '.$to_user['name'];
											?>
										</td>
									</tr>
									<?php
										for ( $i = 0 ; $i < count($items1) ; $i++ ){
											$item = $items1[$i];
											
											switch( $trade['id_categories'] ){
											
											case 1:
												$item_click = "javascript:modalTradePhonecard(".$item['id_phonecards_users'].",1)";
												break;
											}
											
											?>
											<tr>
												<td><a href="<?php echo $item_click; ?>"><?php echo $item['name']; ?></a></td>
												<td><?php echo $item['company']; ?></td>
												<td><?php echo $item['country']; ?></td>
											</tr>
											<?php
										}
									?>
									</table>
								</div>
							</td>
						</tr>
					</table>
					<?php
					}
					else{
					?>
						<table id="trade_items_table2" cellpadding="5" cellspacing="10">
							<tr>
								<td>
									<div class="box1">
										<table width="100%" cellpadding="5">
										<tr>
											<td class="title4">
												<?php echo $this->lang->line('solicitud_compra'); ?>
											</td>
										</tr>
										<?php
											for ( $i = 0 ; $i < count($items0) ; $i++ ){
												
												$item = $items0[$i];
												
												switch( $trade['id_categories'] ){
												
												case 1:
													$item_click = "javascript:modalTradePhonecard(".$item['id_phonecards_users'].",1)";
													break;
												}
												
												?>
												<tr>
													<td><a href="<?php echo $item_click; ?>"><?php echo $item['name']; ?></a></td>
													<td><?php echo $item['company']; ?></td>
													<td><?php echo $item['country']; ?></td>
												</tr>
												<?php
											}
										?>
										</table>
									</div>
								</td>
							</tr>
						</table>
					<?php
					}
					?>
				</div>
				
                <div id="user-interaction">
                	<div id="sendMessageContent2" class="box1" style="margin-top:50px;">
                        <div id="sendMessageBar">
                            <span class="title4"><?php echo $this->lang->line('mensaje_nuevo'); ?></span>
                        </div>
                        <div id="sendMessageFromTo">
                            <table>
                                <tr>
                                    <td><?php echo $this->lang->line('para'); ?>:</td>
                                    <td>
                                        <img src="<?php echo base_url().'users/img/'.$to_user['image']; ?>" width="40" height="40" />
                                        <span><?php echo $to_user['name'].' (@'.$to_user['user'].')'; ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <input type="hidden" id="from" name="from" value="<?php echo $_SESSION['id_users']; ?>" />
                            <input type="hidden" id="to" name="to" value="<?php echo $to_user['id_users']; ?>" />
                            <textarea id="message2"></textarea>
                            <span style="margin-top:10px;" class="google-button google-button-blue" onClick="sendMessage('message2');"><?php echo $this->lang->line('enviar'); ?></span>
                    </div>
                </div>
                
            </div>
            
	</div>
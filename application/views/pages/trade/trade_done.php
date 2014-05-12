
<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('comercio_completado'); ?></a>
				</div>
			</div>
			
			<?php
			@session_start();
			if ( isset($_SESSION['user']) ){
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
							<a href="<?php echo base_url(); ?>index.php/account/#sec=3">
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
				<a id="go" rel="leanModal" href="#modal-signin" class="google-button google-button-blue"><?php echo $this->lang->line('iniciar_sesion'); ?></a>
			</div>
		
		<?php
			}
		?>
			
		</div>
	</div>
						
	<div id="modal-signin">
		<script>
			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{path:path});
		</script>
	</div>
	
	<div id="content-in">
		<div class="info-green" style="text-align:center;">
			<?php echo $this->lang->line('tu_comercio_con'); ?> <?php echo $trade_user['name']; ?> <?php echo $this->lang->line('ha_sido_enviado'); ?>,<br>
			<?php echo $this->lang->line('si'); ?> <?php echo $trade_user['name']; ?> <?php echo $this->lang->line('acepta_seras_informado'); ?>.<br><br>
			<a href="<?php echo base_url(); ?>index.php/trade/trade_details/<?php echo $trade_id; ?>"><?php echo $this->lang->line('ver_comercio'); ?></a>
		</div>
	</div>
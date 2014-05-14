<script type="text/javascript" src="<?php echo base_url(); ?>js/functions/functions_upload_and_edit.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css" />

<!--To Start-->
<script type="text/javascript">

	modalInit();
	errorInit();
	
	$(document).ready(function(){
		
		var g_category = $(document).getUrlParam("cat");
		
		// Colocar categoria
		if ( g_category ){
			var cat_input = document.getElementById("category-sel");
			cat_input.selectedIndex = g_category;
			loadCategory(cat_input);
		}
		
		if ( getHash('sig') ){
			setTimeout(function(){$("#go").click();},500);
		}
		
		<?php
			if ( isset($intro_upload) && $intro_upload == 0 ){
				?>
				modalIntroduction(3);
				<?php
			}
		?>
		
	});
	
</script>
	<div id="content">
		
		<div id="toolbar">
			<div class="in">
				<div id="toolbar-left">
					<div class="item location">
						&nbsp;<a href="<?php echo base_url().'index.php/init'; ?>"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url().'index.php/upload/'; ?>"><?php echo $this->lang->line('cargar'); ?></a>&nbsp;&raquo;
					</div>
				</div>
				
				<?php
				@session_start();
				if ( $_SESSION['user'] ){
			?>
				
				<div id="user-in"<?php if ( isset($_SESSION['user']) ) echo 'onclick="launchMenu();"'; ?> >

						<div class="separator-left"></div>

						<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png"  />
					<span id="user-name">
					<?php 
						echo $_SESSION['name'];
						
						if ( $notifications ){
						?>
							<span class="notification-out">
								<a href="<?php echo base_url(); ?>index.php/account/#sec=6">
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
			
			<div id="content-in">
				<?php
					include 'upload/upload-content.php';
				?>
			</div>
	</div>
<!-- Google -->
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
	
	
	$(document).ready(function(){
		<?php
			if ( strcmp($type,'exchange')==0 ){
				
				if ( isset($intro_exchange) && $intro_exchange == 0 ){
				?>
					modalIntroduction(7);
				<?php
				}
			}
			else if( strcmp($type,'buy')==0){
				if ( isset($intro_buy) && $intro_buy == 0 ){
				?>
					modalIntroduction(8);
				<?php
				}
			}
			
		?>	
	});
	
	
</script>
<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="javascript:window.history.back();"><?php echo $this->lang->line('comercio'); ?></a>&nbsp;&raquo;<?php if ( strcmp($type,"buy") == 0 ){?> <a href=""><?php echo $this->lang->line('compra'); ?></a>&nbsp;&raquo; <?php }else{ ?> <a href=""><?php echo $this->lang->line('intercambio'); ?></a>&nbsp;&raquo; <?php } ?>
				</div>
			</div>
			
			<?php
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
								<a href="<?php echo base_url(); ?>index.php/account/#sec=4">
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
			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{backs:'../',done:'../account'});
		</script>					
	</div>
	<div id="content-in">
    <span class="google-button google-button-red" style="margin-bottom:3px;" onClick="location.href='javascript:window.history.back();'"><?php echo $this->lang->line('regresar'); ?></span>
	<?php
		if ( isset($trade_user) ){
		?>
			<input type="hidden" id="id" value="<?php echo $user0['id_users']; ?>" />
			<input type="hidden" id="u" value="<?php echo $user0['user']; ?>" />
			<div class="box1">
				<table cellspacing="10">
					<tr>
						<td><?php echo $this->lang->line('con'); ?>:</td>
						<td><img src="<?php echo base_url().'users/img/'.$trade_user['image']; ?>" class="user_image" /></td>
						<td><?php echo $trade_user['name'].' (@'.$trade_user['user'].')'; ?></td>
					</tr>
				</table>
			</div>
			<div class="title4" style="margin-top:5px;" >
				<?php 
					if ( strcmp($type,"buy") == 0 ){
						echo  $this->lang->line('seleccionar_articulos_comprar');
					}
					else{
						if ( isset($step) ){
							echo $this->lang->line('paso_2').':'.' '.$this->lang->line('seleccionar_articulo_de_tu_coleccion').'.';
						}
						else{
							echo $this->lang->line('paso_1').':'.' '.$this->lang->line('seleccionar_articulo_de_la_coleccion_de').' '.$trade_user['name'];
						}
					} 
				?>
			</div>
			<div id="mini-explore-content">
				<?php
					
					if ( isset($category) ){
						switch( $category ){
							case 'phonecard':
								$cat_id = 1;
								$mini_explore = 'phonecards/mini-explore.php';
								break;
							case 'coin':
								$cat_id = 2;
								$mini_explore = 'coins/mini-explore.php';
								break;	
						}
					}
					
					
				?>
				<script>
					$("#mini-explore-content").load(path+'ajax/mini-explore/<?php echo $mini_explore; ?>',
						{	<?php if ( isset($cat_id) ) echo 'category:'.$cat_id.','; ?>
							type:'<?php echo $type; ?>',
							user_id:<?php echo $trade_user['id_users'] ?>
							<?php if ( isset($step) ) echo ', step:'.$step; ?>
							<?php if ( isset($trade_article) ) echo ',pre:'.$trade_article; ?>
							<?php if ( isset($trade_article) ) echo ',pre2:'.$trade_users_id; ?>
							<?php if ( isset($step) ) echo ', selected_items1:"'.$selected_items1.'"'; ?>
						}
					);
				</script>
			</div>
		<?php
		}
		else{
			$userj = json_encode($user0);
			?>
			<div id="select-user">
				<script>
					var trade_article = <?php echo $trade_article; ?>;
					var category = "<?php echo $category; ?>";
					var type = "<?php echo $type; ?>";
					var user = <?php echo $userj; ?>;
					
					$('#select-user').load(path+'ajax/trade/select_user_country.php',{path:path, trade_article:trade_article, category:category, user:user, type:type});
					
					function show_user_trade (option){
						
						var show = parseInt(document.getElementById('show_user_trade').value);
						
						switch ( show  ){
							
							case 1:
							$('#select-user').load(path+'ajax/trade/select_user_country.php',{path:path, trade_article:trade_article, category:category, user:user, type:type, show:show});
							break;
							
							case 2:
							$('#select-user').load(path+'ajax/trade/select_user_price.php',{path:path, trade_article:trade_article, category:category, user:user, type:type, show:show});
							break;
							
							case 3:
							$('#select-user').load(path+'ajax/trade/select_user_reputation.php',{path:path, trade_article:trade_article, category:category, user:user, type:type, show:show});
							break;
							
						}
					}
				</script>
			</div>
		<?php
		}
		?>
	</div>
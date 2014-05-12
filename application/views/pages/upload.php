<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css" />

<!--To Start-->
<script type="text/javascript">
	
	$(document).ready(function(){
		$('a[rel*=leanModal]').leanModal({ top : 62, closeButton: ".modal-close" });
		$('.input0').click(function(){					
			//
		});
		
		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});
		
		$("#lean_overlay").click(function(){
			deleteHash('sig');
		});
						
		$("#content-in,#top").click(function(){
			closeMenu();
		});
		
		var g_category = $(document).getUrlParam("cat");
		
		if ( g_category ){
			// Set category
			var cat_input = document.getElementById("category-sel");
			cat_input.selectedIndex = g_category;
			upload0(cat_input);
		}
		
		if ( getHash('sig') ){
			setTimeout(function(){$("#go").click();},500);
		}
		
		query = getHash('q');
		
		if ( query ){
			q2 = query.replace('+',',');
			document.getElementById('search').value = q2;
			searchTop( 'search' , '../' );
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
					include 'upload-content.php';
				?>
			</div>
	</div>
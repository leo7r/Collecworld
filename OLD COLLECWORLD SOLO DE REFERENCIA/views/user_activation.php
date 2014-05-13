<!--To Start-->
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
		
		sec = getHash('sec');
		
		if ( sec ){
			accountMenu(parseInt(sec));
		}
		
		don = getHash('don');
		
		if ( don ){
			showGlobalInfo('Account information updated successfully');
		}
		
		newmsg = $(document).getUrlParam('new-message');
		
		if ( newmsg ){
			$("#user-send-new").click();
		}
	
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
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('usuario_activacion'); ?></a>&nbsp;&raquo;
				</div>
			</div>
			
			<?php
			@session_start();
			if ( isset($_SESSION['user']) ){
		?>
        
			
			<div id="user-in"  onclick="<?php echo $_SESSION['user'] ? 'launchMenu(this);' : '' ?>">
				<div class="separator-left"></div>
				<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png"/>
				<span id="user-name"><?php echo $_SESSION['name']; ?></span> 
				<img height="35" width="35" id="user-image" alt="user image" src="<?php echo base_url(); ?>users/img/<?php echo $_SESSION['img']; ?>" />	
			</div>
		<?php
			}
			else{
			
			}
		?>
			
		</div>
	</div>		
		<div id="content-in">
			<div id="welcome-page" class="box1">
				<div id="welcome-img" >
					<img src="<?php echo base_url(); ?>img/check.jpg" width="150" />
				</div>
				<div id="welcome-title">
					<?php echo $this->lang->line('usuario_activacion'); ?>
				</div>
				<div id="welcome-info">
					<p><?php echo $this->lang->line('registro_collecworld_completado'); ?>.</p>
					<p><?php echo $this->lang->line('presiona_el_boton_para_disfrutar_collecworld'); ?>!</p>
                    <div align="center"><input type="button" value="<?php echo $this->lang->line('acceder'); ?>" class="google-button google-button-blue" onclick="location.href='<?php echo base_url(); ?>index.php/init'"></div>
                    <br />

				</div>
			</div>
		</div>
</div>

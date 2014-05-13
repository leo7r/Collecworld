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
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('confirmacion_correo_electronico'); ?></a>&nbsp;&raquo;
				</div>
			</div>
			
			
		</div>
	</div>
						
	<div id="modal-signin">
		<script>
			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{path:path});
		</script>
	</div>
    
            <div id="content-in">
                <div id="welcome-page" class="box1">
                    <div id="welcome-img" >
                        <img src="<?php echo base_url(); ?>img/mail-confirm.png" />
                    </div>
                    <div id="welcome-title">
                        <?php echo $this->lang->line('te_enviamos_correo_electronico_confirmacion'); ?>
                    </div>
                    <div id="welcome-info">
                        <p><?php echo $this->lang->line('para_completar_registro_confimar_correo_electronico'); ?>.</p>
                        <p><?php echo $this->lang->line('revisa_tu_correo_electronico'); ?> > <span style="color:#06f"><?php echo $email; ?></span> <?php echo $this->lang->line('para_confirmaar_tienes_algun_problema'); ?> <a href="javascript:modalFeedback()"><?php echo $this->lang->line('contactanos'); ?></a>.</p>
                    </div>
                </div>
            </div>
    </div>

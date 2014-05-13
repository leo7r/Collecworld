<!--To Start-->
<script type="text/javascript">

	function modalPhonecard( _p ){
		
		url = $("#url").val();
		url = url.split('index.php/')[1];
		
		$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,url:url},function(){
			$("#modalP").click();
		});
	
	}
				
	$(document).ready(function(){
		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
		$('.input0').click(function(){					
			//
		});
		
		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});
						
		$("#content-in,#top").click(function(){
			closeMenu();
		});
	});
	
</script>

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
	
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
	}
	
	$(window).ready(function(){
		
		setTimeout(function(){
			
			var gt = document.createElement('script'); gt.type = 'text/javascript'; gt.async = true;
			gt.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gt, s);
			google1();
		},1000);
	});
	
</script>

<body>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>
<input type="hidden" id="url" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />

<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/search/<?php echo str_replace(' ','+',$query); ?>"><?php echo $this->lang->line('busqueda'); ?> <b><?php echo $query; ?></b></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('tarjetas_telefonicas'); ?></a>
				</div>
			</div>
			
			<?php
			@session_start();
			if ( isset($_SESSION['user']) ){
		?>
			
			<div id="user-in" <?php if ( isset($_SESSION['user']) ) echo 'onclick="launchMenu(this);"'; ?> >
				<div class="separator-left"></div>
				<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png"/>
				<span id="user-name">
				<?php 
					echo $_SESSION['name'];
					if ( isset($not_readed) and $not_readed > 0 ){
						?>
						&nbsp;
						<img class="not_readed2" src="<?php echo base_url(); ?>img/not_readed.png" width="16" height="16" />
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
			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{path:path});
		</script>					
	</div>
	
	<div id="content-in">
		<?php
			include 'show_phonecards_content.php';
		?>
	</div>	
</div>
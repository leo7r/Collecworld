<?php
function trimm( $str , $num ){
	
	if ( strlen($str) > $num ){
		$ret = substr($str,0,$num);
		$ret = $ret.'...';
		return $ret;
	}
	
	return $str;
}
?>
<!--To Start-->
<script type="text/javascript">
				
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

			google1();

		},1000);

	});

	

</script>



<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/compare/<?php echo $compareTo['user']; ?>"><?php echo $this->lang->line('comparar_con'); ?> <?php echo $compareTo['name']; ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/compare/<?php echo $compareTo['user']; ?>/phonecards"><?php echo $this->lang->line('tarjetas_telefonicas'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php  if(ucfirst($method)=="Wish"){echo $this->lang->line('deseo');}else{echo $this->lang->line('venta'); } ?></a>
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
				<a id="go" onClick="setHash('sig=1');" rel="leanModal" href="#modal-signin" class="google-button google-button-blue">Sign in</a>
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
			include 'show_phonecards.php';
		?>
	</div>	
</div>
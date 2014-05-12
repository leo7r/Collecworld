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
		
		$("#lean_overlay").click(function(){
			deleteHash('sig');
		});
						
		$("#content-in,#top").click(function(){
			closeMenu();
		});
		
		if ( getHash('sig') ){
			setTimeout(function(){$("#go").click();},500);
		}
		
		query = getHash('q');
		
		if ( query ){
			q2 = query.replace('+',',');
			document.getElementById('search').value = q2;
			searchTop( 'search' , '../' );
		}
		
		
		cat = getHash('cat');
		
		if ( cat ){
			sel = document.getElementById('step0');
			sel.selectedIndex = cat;
			exploreSteps(sel);
		}
		
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

<div id="top">
	<div class="in">
		<a href="<?php echo base_url(); ?>index.php/init"><img id="logo" src="<?php echo base_url(); ?>img/logo.png" height="61" width="100" alt="logo" /></a>
		
		<div id="translate">
			<div id="google_translate_element"></div>
		</div>
		<div id="account" >
			<div id="search-top">
				<img id="search-go" src="<?php echo base_url(); ?>img/search.png" height="20" width="20" onClick="searchTop('search','../');" />
				<input type="text" id="search" class="input1" value="<?php echo $this->lang->line('header_busqueda'); ?>" onKeyUp="searchInput();" />
			</div>
	  
		</div>
	</div>
</div>

<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/explore"><?php echo $this->lang->line('explore_phonecards_explorar_tarjetas'); ?></a>&nbsp;&raquo;
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
		
		<div id="explore-bar" class="box1">
		
			<div class="item">
				<span class="google-button" onClick="exploreSteps(document.getElementById('step0'));window.location.hash='';"><?php echo $this->lang->line('restablecer'); ?></span>
				
				<select id="step0" onChange="exploreSteps(this);">
					<option selected="selected"><?php echo $this->lang->line('categorias'); ?></option>
					<?php
						for ($i=0 ; $i<count($categories) ; $i++){
							?>
							<option><?php echo $categories[$i]['cat_name']; ?></option>
							<?php
						}
					?>
				</select>
				
				<span id="explore-info"></span>
				
			</div>
		</div>
		
		<div id="explore-content">
		</div>
		
	</div>	
</div>
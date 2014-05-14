<script>
function fb_click(){
	
	u=document.getElementById('share-url').value;
	t=document.title;
	window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'Collecworld sharer','toolbar=0,status=0,width=626,height=436');
	
}

function tw_click(){
	
	url = document.getElementById('share-url').value;
	
	u = 'https://twitter.com/share?text=Visit my profile on Collecworld.com'+'&url=http://'+url;
	
	window.open(u,'Collecworld sharer','toolbar=0,status=0,width=626,height=436');
}

function gp_click(){
	
	url = document.getElementById('share-url').value;
	
	u = 'https://plus.google.com/share?url=http://'+url;
	
	window.open(u,'Collecworld sharer','toolbar=0,status=0,width=626,height=436');
}
</script>
<!--To Start-->
<script type="text/javascript">

	function modalPhonecard( _p ){
	
		$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,path:path},function(){
			$("#modalP").click();
		});
	}
	
	$(document).ready(function(){
		
		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});
		
		sec = getHash('sec');
		
		if ( sec ){
			profileMenu(parseInt(sec));
		}
		else{
			profileMenu(1);
		}
		
		don = getHash('don');
		
		if ( don ){
			showGlobalInfo('Account information updated successfully');
		}
		
		evnt = $(document).getUrlParam('event_done');
		if ( evnt ){
			evnt = evnt.replace(/%20/g," ");
			showGlobalInfo('Event "'+evnt+'" have been created');
		}
		
		<?php
			if ( isset($intro_profile) && $intro_profile == 0 ){
				?>
				modalIntroduction(6);
				<?php
			}
		?>
	
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/functions/functions_user.js"></script>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>

<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $_SESSION['user']; ?></a>&nbsp;&raquo;
				</div>
			</div>
			
			<?php
			if ( isset($_SESSION['user']) ){
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

								<a href="<?php echo base_url(); ?>account/#sec=6">

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
	
	<input type="hidden" id="share-url" value="www.collecworld.com/<?php echo $_SESSION['user']; ?>" />
	<?php
		/*				
		if ( $user['num_trades'] > 0 ){
			$user_rating = ($user['good_trades'] / $user['num_trades'])*100;
		}
		else{
			$user_rating = 0;	
		}
		
		if ( $user_rating > 70 ){
			$rating = 'good';
		}
		else{
			if ( $user_rating > 40 ){
				$rating = 'medium';
			}
			else{
				$rating = 'bad';
			}
		}*/		
	?>	
	<div id="content-in">
		<div id="account-title" >
			<?php echo $user['name']; ?>
			<?php
				/*if ( $notifications ){
					?>
					<span onClick="accountMenu(6)" title="<?php echo $this->lang->line('nueva_notificacion'); ?>" style="position:relative; top:-4px;" class="notification"><?php echo count($notifications); ?></span>
					<?php
				}*/
			?>
		</div>
		<div id="account-content">
			<div id="account-content-left">
				<a href="<?php echo base_url(); ?>index.php/<?php echo $_SESSION['user']; ?>">
               		<!-- <div onMouseOver="showInfo( this , '<?php echo $this->lang->line('numero_de_comercios_hechos'); ?>: <?php echo $user['num_trades']; ?> | <?php echo $this->lang->line('numero_de_comercios_exitosos'); ?>: <?php echo $user['good_trades']; ?>' )"> -->
                		<img id="account-img" src="<?php echo base_url(); ?>users/img/<?php echo $user['image']; ?>" />
                      <!--  <div id="account-rating" class="account-rating-<?php echo $rating; ?>">
                            <span id="account-rating-num"><?php echo round($user_rating); ?></span>
                        </div>
                    </div> -->
                </a>
				<div id="account-edit"><span class="google-button" onClick="profileMenu(9);"><?php echo $this->lang->line('profile_editar_perfil'); ?></span></div>
				<br />
				<ul id="share-list">
					<li id="share-list-share"><?php echo $this->lang->line('compartir'); ?>: </li>
					<li onClick="fb_click();"><img src="<?php echo base_url(); ?>img/share-fb.png" width="24" height="24" /></li>
					<li onClick="tw_click();"><img src="<?php echo base_url(); ?>img/share-tw.png" width="24" height="24" /></li>
					<li onClick="gp_click();"><img src="<?php echo base_url(); ?>img/share-gp.png" width="24" height="24" /></li>
				</ul>
				
				<div class="account-menu-item menu-item-active"  onclick="profileMenu(1);"><?php echo $this->lang->line('vision_general'); ?></div>
				<div class="account-menu-item" onClick="profileMenu(2);"><?php echo $this->lang->line('mis_colecciones'); ?></div>
				<div class="account-menu-item" onClick="profileMenu(3);"><?php echo $this->lang->line('amigos'); ?></div>
				<div class="account-menu-item" onClick="profileMenu(4);"><?php echo $this->lang->line('eventos'); ?></div>
				<div class="account-menu-item" onClick="profileMenu(5);"><?php echo $this->lang->line('comercios'); ?></div>
				<div class="account-menu-item" onClick="profileMenu(6);"><?php echo $this->lang->line('mensajes'); ?> (<?php // echo $not_readed; ?>)</div>
				<div class="account-menu-item" onClick="profileMenu(7);"><?php echo $this->lang->line('notificaciones'); ?></div>
				<div class="account-menu-item" onClick="profileMenu(8);"><?php echo $this->lang->line('configuracion'); ?></div>
			</div>
			<div id="account-content-right">
			</div>
		</div>
	</div>
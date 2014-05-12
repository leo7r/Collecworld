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

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>

<div id="content">

	<div id="toolbar">

		<div class="in">

			<div id="toolbar-left">

				<div class="item location">

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/help"><?php echo $this->lang->line('centro_ayuda'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('help_mas_articulos_titulo'); ?><?php echo $this->lang->line('help_comunidad_collecworld_titulo'); ?></a>&nbsp;&raquo;

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

		<div id="account-title" >

			<span style="text-indent:0; color:#000; cursor:pointer;" onclick="location.href='javascript:window.history.back();'">&laquo;<?php echo $this->lang->line('regresar'); ?></span><span style="float:right"><?php echo $this->lang->line('centro_ayuda'); ?> &raquo; <?php echo $this->lang->line('help_comunidad_collecworld_titulo'); ?> </span>

		</div>

		<div id="account-content">

			

            	<style>



.content-in{

	width:800px;

	margin-left:auto;

	margin-right:auto;

	padding:10px;

	line-height:30px;

	text-align:justify;

	text-indent:1.5em;	

}



</style>



	<div class="content-in">

    	<div id="rating">

            <h1><?php echo $this->lang->line('help_rating_coleccionistas_titulo'); ?></h1>

           <?php echo $this->lang->line('help_rating_coleccionistas_contenido'); ?> 

    

  

        </div>

        <div id="contributions">

            <h1><?php echo $this->lang->line('help_contribuciones_titulo'); ?></h1>

           <?php echo $this->lang->line('help_contribuciones_contenido'); ?> 

        </div>

        <div id="more">

            <h1><?php echo $this->lang->line('help_mas_articulos_titulo'); ?></h1>

         <?php echo $this->lang->line('help_mas_articulos_contenido'); ?>   

        </div>

        

         </div>

            

    </div>

 </div>

 </div>


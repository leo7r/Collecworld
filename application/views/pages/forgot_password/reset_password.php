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

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('escoge_nueva_contrasena'); ?></a>&nbsp;&raquo;

				</div>

			</div>

			

			<?php

			@session_start();

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

			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{path:path});

		</script>

	</div>

			

	<div id="content-in" style="min-height:400px;">

		<div id="account-title" >

			<?php echo $this->lang->line('escoge_nueva_contrasena'); ?>

		</div>

		<div id="account-content" style="min-height:300px !important; ">
        	<?php if(!$ok){ ?>
			<form method="post" action="<?php echo base_url(); ?>index.php/reset_password/<?php echo $user['id_users']; ?>/<?php echo $user['user']; ?>">
            <input type="hidden" name="send" value="1">
			<table width="700" style="margin:25px;">
            	<tr>
                	<td width="400px"><p style="width:400px"><?php echo $this->lang->line('coloca_nueva_contrasena_desc'); ?></p></td>
                    <td>
                        <div style="border-left:1px solid #ccc; height:250px;">
                        	<table cellpadding="5" style="position:absolute; margin:40px;">

                                <tr> 
                                    <td><?php echo $this->lang->line('nueva_contrasena'); ?></td>
                                </tr>
                                <tr>
                                    <td><input type="password" name="pass" class="input0" style="width:250px;"/></td> 
                                </tr>
                                <tr> 
                                    <td><?php echo $this->lang->line('repite_contrasena'); ?></td>
                                </tr>
                                <tr>
                                    <td><input type="password" name="pass2" class="input0" style="width:250px;"/></td> 
                                </tr> 
                                <?php if(isset($error)){ ?> 
                                <tr>
                                    <td><span style="color:#FF0004">
                                    <?php
									 switch($error){
										
										case 1 : echo $this->lang->line('complete_contrasena');
										break;
										
										case 2 : echo $this->lang->line('minimo_seis_caracteres');
										break;
										
										case 3 : echo $this->lang->line('contrasena_no_coinciden');
										break;
										
										case 4 : echo $this->lang->line('error').' '.$this->lang->line('intentalo_de_nuevo');
										break;
										
									 }
									?></span>
                                    </td> 
                                </tr>  
                                <?php } ?>
                                <tr>  
                                    <td><input type="submit" value="<?php echo $this->lang->line('cambiar'); ?>" class="google-button google-button-blue" /></td> 
                                </tr>
                                
                        	</table>
                        </div>
                    </td>
                </tr>
            </table>
			</form>
            <?php }else{
				?>
				<h1 align="center" style="width:700px; margin:100px;"><?php echo $this->lang->line('contrasena_cambiada'); ?></h1>
				<?php
			}
			?>
		</div>

	</div>
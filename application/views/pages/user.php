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

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $user['user']; ?></a>&nbsp;&raquo;

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

				

	<div id="content-in">

    	

        <?php

			if ( $user['view_privacy'] == 1 && !isset($_SESSION['id_users']) ){

				$link = base_url().'index.php/login';

				header("Location: ".$link);

			}

			else{

			?>

            <input type="hidden" id="id" value="<?php echo $user['id_users']; ?>" />

            <input type="hidden" id="u" value="<?php echo $user['user']; ?>" />

            <div id="user-title" >

                <?php echo '@'.$user['user']; ?>

                <?php

                    if ( isset($isFriend) ){

                                            

                        if ( $isFriend['friends']['status'] == 0 ){

                            

                            if ( $isFriend['request'] == 1 ){

                                ?>

                                    <span class="google-button friend-button"><?php echo $this->lang->line('solicitud_amistad_enviada'); ?></span>

                                <?php

                            }

                            else{

                                ?>

                                    <span class="google-button google-button-blue friend-button" onclick="confirm_friend(<?php echo $user['id_users']; ?>)"><?php echo $this->lang->line('friends_confirmar_solicitud_amistad'); ?></span>&nbsp;<span class="google-button google-button-red friend-button" onclick="cancel_friend(<?php echo $user['id_users']; ?>)"><?php echo $this->lang->line('friends_cancelar_solicitud_amistad'); ?></span>

                                <?php

                            }

                            

                        }

                        elseif( $isFriend['friends']['status'] == 1 ){

                            ?>

                                <span class="google-button google-button-green friend-button" onclick="delete_friend(<?php echo $user['id_users']; ?>,'<?php echo $user['user']; ?>')"><?php echo $this->lang->line('amigos'); ?></span>

                            <?php

                        }

                        

                    }

                    else{

                        if ( isset($_SESSION['user']) ){

                            ?>

                            <span class="google-button google-button-red friend-button" onclick="add_friend(<?php echo $user['id_users']; ?>)">+ <?php echo $this->lang->line('anadir_a_amigos'); ?></span>

                            <?php

                        }

                    }

                ?>

            </div>

            <div id="user-content" class="box1">

                <div id="user-content-left">
					<?php
						
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
						}
						
					?>
                    <div onMouseOver="showInfo( this , '<?php echo $this->lang->line('numero_de_comercios_hechos'); ?>: <?php echo $user['num_trades']; ?> | <?php echo $this->lang->line('numero_de_comercios_exitosos'); ?>: <?php echo $user['good_trades']; ?>' )">
                    	<img id="account-img" src="<?php echo base_url(); ?>users/img/<?php echo $user['image']; ?>" >
                        <div id="account-rating" class="account-rating-<?php echo $rating; ?>">
                        	
                        	<span id="account-rating-num"><?php echo round($user_rating); ?></span>
                        </div>
                    </div>
                    <?php

                    if ( isset($isFriend) ){ 

                        if( $user['profile_privacy']==0 || ($user['profile_privacy']==1) && ( $isFriend['friends']['status'] == 1 ) ) { ?>

                    <br />

                    <span id="user-send-new" style="margin-top:2px;" class="google-button" onclick="showSendMessage('<?php echo $user['user']; ?>')"> <?php echo $this->lang->line('enviar_mensaje'); ?></span>

                    <br />

                    <a href="<?php echo base_url(); ?>index.php/compare/<?php echo $user['user']; ?>" style="margin-top:2px;" class="google-button"><?php echo $this->lang->line('comparar_con'); ?> <?php echo $user['name']; ?></a>

                    <br />

                    <a href="<?php echo base_url(); ?>index.php/trade/<?php echo $user['user']; ?>" style="margin-top:2px;" class="google-button"><?php echo $this->lang->line('comerciar'); ?></a>

                    <?php }

                    }

                    ?>

                </div>

                <div id="user-content-right">

                    <?php

                        include 'user/overview.php';

                    ?>

                </div>

                <?php

                 if ( (isset($isFriend) && $user['list_privacy']==1) && ( $isFriend['friends']['status'] == 1 )

                    || $user['list_privacy'] == 0  ){

                    ?>

                    <div id="user-content-right2">

                        <div id="cat0" class="user-collection-item" onclick="showUserCollection(0,this)">

                            <div><img src="<?php echo base_url(); ?>img/account-pc.png"  /></div>

                            <div><?php echo $this->lang->line('tarjetas_telefonicas'); ?></div>

                        </div>

                        <div id="cat1" class="user-collection-item" onclick="showUserCollection(1,this)">

                            <div><img src="<?php echo base_url(); ?>img/account-coin.png"  /></div>

                            <div><?php echo $this->lang->line('monedas'); ?></div>

                        </div>

                        <div id="cat2" class="user-collection-item" onclick="showUserCollection(2,this)">

                            <div style="height:64px; width:64px;"><img src="<?php echo base_url(); ?>img/account-banknote.png"  height="42" width="42" style="margin:10px; margin-left:50px;" /></div>

                            <div><?php echo $this->lang->line('billetes'); ?></div>

                        </div>

                        <div id="cat3" class="user-collection-item" onclick="showUserCollection(3,this)">

                            <div><img src="<?php echo base_url(); ?>img/account-stamp.png"  /></div>

                            <div><?php echo $this->lang->line('estampillas'); ?></div>

                        </div>



                    </div>

                    <?php 

                    }

                    ?>

            </div>

            

            <div id="user-interaction"></div>

            

            <div id="user-collection">

                <div id="collection-lists">

                    <span class="collection-lists-item"><?php echo $this->lang->line('coleccion'); ?></span>

                    <span class="collection-lists-item"><?php echo $this->lang->line('deseo'); ?></span>

                    <span class="collection-lists-item"><?php echo $this->lang->line('intercambio'); ?></span>

                    <span class="collection-lists-item"><?php echo $this->lang->line('venta'); ?></span>

                </div>

                

                <div id="user-collection-list">

                

                </div>

            </div>

            <?php	

			}

		?>

		

        </div>
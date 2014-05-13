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

					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="#"><?php echo $this->lang->line('comercio'); ?></a>&nbsp;&raquo;&nbsp;<a href="#"><?php echo $this->lang->line('seleccionar_tipo_de_comercio'); ?></a>&nbsp;&raquo;

				</div>

			</div>

			

			<?php

			@session_start();

			if ( isset($_SESSION['user']) ){

		?>

			

			<div id="user-in" >

				<div class="separator-left"></div>

				<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png" <?php if ( isset($_SESSION['user']) ) echo 'onclick="launchMenu();"'; ?> />

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

			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{path:path});

		</script>					

	</div>

	

	<div id="content-in">
		<input type="hidden" id="id" value="<?php echo $user0['id_users']; ?>" />
		<input type="hidden" id="u" value="<?php echo $user0['user']; ?>" />
		<div id="user-title" >
			<?php echo $this->lang->line('seleccionar_tipo_de_comercio'); ?>
		</div>
		<div id="user-content-pad" class="box1">
			<table class="trade-type-table" align="center">
                <tr>
                    <td>
                    	<div id="trade-type-buy" onClick="<?php if( isset($trade_user) ){?>location.href='<?php echo base_url(); ?>index.php/trade/buy/<?php echo $trade_user['user']; ?>'<?php }else{?>location.href='<?php echo base_url(); ?>index.php/trade/buy/<?php echo $category; ?>/<?php echo $trade_article; ?>' <?php }?>">
                       		<div id="trade-type-title"><?php echo $this->lang->line('compra'); ?></div>
                        </div>              
					</td>
                    <td>
                    	<?php echo $this->lang->line('o_mayuscula'); ?>         
					</td>
                    <td>
                    	<div id="trade-type-exchange" onClick="<?php if( isset($trade_user) ){?>location.href='<?php echo base_url(); ?>index.php/trade/exchange/<?php echo $trade_user['user']; ?>'<?php }else{?>location.href='<?php echo base_url(); ?>index.php/trade/exchange/<?php echo $category; ?>/<?php echo $trade_article; ?>' <?php }?>">
                        <div id="trade-type-title"><?php echo $this->lang->line('intercambio'); ?></div>
                        </div>              
					</td>
                </tr>
                <tr>
                	<td colspan="3" align="center"><br />
<span class="google-button google-button-red" onClick="location.href='javascript:window.history.back();'"><?php echo $this->lang->line('regresar'); ?></span></td>
                </tr>
            </table>
            
  		</div>
	</div>	

</div>
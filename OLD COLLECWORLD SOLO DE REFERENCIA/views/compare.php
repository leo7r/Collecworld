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
		
		<?php
			if ( isset($category) )
				echo 'var category = '.$category;
		?>
		
		if ( category != 0 ){
			$("#compare-category-table td")[category-1].click();
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
			
			google1();
		},1000);
	});
	
</script>

<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url(); ?>index.php/compare/<?php echo $compareTo['user']; ?>"><?php echo $this->lang->line('comparar_con'); ?> <?php echo $compareTo['name']; ?></a>&nbsp;&raquo;
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
								<span title="You have new notifications" class="notification"><?php echo count($notifications); ?></span>
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
		
		<input type="hidden" id="compare-category" />
		<input type="hidden" id="compare-method" />
		<input type="hidden" id="compare-user" value="<?php echo $compareTo['user']; ?>" />
		
		<div class="title4"><?php echo $this->lang->line('selecciona_una_categoria_comparar'); ?></div>
		<div id="compare-category" >
			<table id="compare-category-table" cellspacing="10">
				<tr>
					<td class="box1" onClick="set_compare_category(this,1)" >
						<div>
							<?php echo $this->lang->line('tarjetas_telefonicas'); ?>
						</div>
					</td>
					<td class="box1" onClick="set_compare_category(this,2)" >
						<div>
							<?php echo $this->lang->line('monedas'); ?>
						</div>
					</td>
					<td class="box1" onClick="set_compare_category(this,3)" >
						<div>
							<?php echo $this->lang->line('billetes'); ?>
						</div>
					</td>
					<td  class="box1" onClick="set_compare_category(this,4)" >
						<div>
							<?php echo $this->lang->line('estampillas'); ?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		
		<div class="title4"><?php echo $this->lang->line('selecciona_metodo_comparacion'); ?></div>
		<div id="compare-method" >
			<table id="compare-method-table" cellspacing="10">
				<tr>
					<td class="box1" onClick="set_compare_method(this,1)"
						onmouseover="showInfo(this,'<?php echo $this->lang->line('en_mi_lista_de_deseos_en').' '.$this->lang->line('Intercambio_lista_de_ventas').$compareTo['name']; ?>')"
					 >
						<div>
							<?php echo $this->lang->line('en_mi_lista_de_deseos'); ?>
						</div>
					</td>
					<td  class="box1" onClick="set_compare_method(this,4)"
						onmouseover="showInfo(this,'<?php echo $this->lang->line('en_mi_lista_de_ventas_en').' '.$this->lang->line('lista_de_compras').$compareTo['name']; ?>')"
					 >
						<div>
							<?php echo $this->lang->line('en_mi_lista_de_ventas'); ?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		
	</div>	
</div>
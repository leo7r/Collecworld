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
<script>
	$(document).ready(function(){
		var showPc =  parseInt($(document).getUrlParam("showPhonecard"));
		
		if ( showPc ){
			modalPhonecard(showPc);
			showGlobalInfo("<?php echo $this->lang->line('nueva_imagen_cargada'); ?>");
		}
		
		<?php
			if ( isset($intro_show_phonecard) && $intro_show_phonecard == 0 ){
				?>
				modalIntroduction(2);
				<?php
			}
		?>
		
	});
	
	function showVariations( dom ){
		
		url = $("#explore_url").val();
		
		last_piece = url.split('/')
		last_piece = last_piece[last_piece.length-1];
		
		//alert( last_piece );
		
		if ( dom.checked ){
			location.href = url+'/no_variations';
			//alert(url+'/no_variations');
		}
		else{
			location.href = url;
		}
	}
	
	function onlyNumbers(evt) {
	
	  var theEvent = evt || window.event;
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode( key );
	  var regex = /[0-9]|\./;
	  
	  if( !regex.test(key) ) {
		
		if ( evt.keyCode == 13 ){
			goToPage();
		}
		else{
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
		
		
	  }
	  
	}
	
	function goToPage(){
		
		pag = $("#go_to_page").val();
		
		if ( pag.length > 0 ){
			
			go_url = $("#go_url").val()+"/";
			last_piece = $("#last_piece").val();
			
			//alert(go_url+pag+last_piece);
			location.href = go_url+pag+last_piece;	
		}
			
	}
	
	
	
</script>
<?php
	
	
?>
<div id="content">
	
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url().'index.php/init'; ?>"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;
					<a href="<?php echo base_url().'index.php/explore/phonecard'; ?>"><?php echo $this->lang->line('header_explorar_tarjetas_telefonicas'); ?></a>&nbsp;&raquo;&nbsp;
					
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
			$("#modal-signin").load(path+'ajax/signin/index.php',{path:path});
		</script>					
	</div>

	<div id="content-in">
		<input type="hidden" id="explore_url" value="" />
        
      <table width="100%">
        	<tr>
            	<td>
                	<div id="explore_sort" class="box1">
                        <table width="100%">
                            <tr>
                                <td>
                                    <?php echo $this->lang->line('ordenar_tarjetas_telefonicas_por'); ?>:&nbsp;
                                    <select style="width:150px;" onChange="location = this.options[this.selectedIndex].value;">
                                        <option <?php if ( !$order ) echo 'selected="selected"'; ?> value="<?php echo $url.'/by_catalog' ?>" ><?php echo $this->lang->line('numero_catalogo'); ?></option>
                                        <?php
											if ( $ref_catalog ){
											?>
                                            <option <?php if ( strcmp($order,'by_reference') == 0 ) echo 'selected="selected"'; ?> value="<?php echo $url.'/by_reference' ?>"><?php echo $this->lang->line('catalogo_referencia'); ?></option>
                                            <?php	
											}
										?>
                                        <option <?php if ( strcmp($order,'by_face_value') == 0 ) echo 'selected="selected"'; ?> value="<?php echo $url.'/by_face_value' ?>"><?php echo $this->lang->line('valor_nominal'); ?></option>
                                        <option <?php if ( strcmp($order,'by_serie') == 0 ) echo 'selected="selected"'; ?> value="<?php echo $url.'/by_serie' ?>"><?php echo $this->lang->line('serie'); ?></option>
                                    </select>
                                </td>
                                <td>
                                    <input type="checkbox" onChange="showVariations(this);" <?php if ( $no_variations == 1 ) echo 'checked="checked"'; ?> />
                                    <?php echo $this->lang->line('no_mostrar_variantes'); ?>
                                </td>
                                <td style="width:160px;">
                                	<input type="button"  value="<?php echo $this->lang->line('marcado_rapido'); ?>" onclick="fast_marking()"/><br>

                     
						<img  src="<?php echo base_url(); ?>img/own.png" title="<?php echo $this->lang->line('tengo_esta'); ?>"  id="buttons" class="fast_marquing" onclick="modalItemList(<?php echo count($phonecards); ?>,1,1,0,'')" />
					
						<img  src="<?php echo base_url(); ?>img/seek.png"  title="<?php echo $this->lang->line('quiero_esta'); ?>"  id="buttons" class="fast_marquing" />

						<img src="<?php echo base_url(); ?>img/exchange.png"  title="<?php echo $this->lang->line('cambio_esta'); ?>"  id="buttons" class="fast_marquing" />

						<img  src="<?php echo base_url(); ?>img/sell.png"title="<?php echo $this->lang->line('vendo_esta'); ?>"  id="buttons" class="fast_marquing" />

						<br>


                        <div  class="fast_marquing" > <?php echo $this->lang->line('seleccionar_todos'); ?>: <input type="checkbox" onclick="checked_all('<?php echo count($phonecards); ?>')"  value="<?php echo $this->lang->line('marcado_rapido'); ?>" onclick="fast_marking()"/></div>
                                </td>
                            </tr>
                        </table>			
                    </div>
                </td>
                <td style="width:470px;">
                	<div id="pagination_top">
						<?php
                        
                        $num_pags = $num_rows / 12;
                        
                        if ( $num_pags > intval($num_pags) ){
                            $num_pags = $num_pags+1;
                        }
                        
                        // antes de la pagina seleccionada
                        
                        $url = base_url().'index.php/explore/phonecard/';
                        
                        if ( $order ){
                            $last_piece = '/'.$order;
                        }
                        if ( $no_variations ){
                            $last_piece = (isset($last_piece) ? $last_piece : "").'/'.'no_variations';
                        }
						?>
                        
                        <input type="hidden" id="go_url" value="<?php echo $url; ?>" />
                        <input type="hidden" id="last_piece" value="<?php echo isset($last_piece) ? $last_piece : ""; ?>" />
                        <?php
                        
                        if ( $pag > 1 ){
                        ?>
                        <a class="pag-button current-page" href="<?php echo $url.'/'.($pag-1).( isset($last_piece) ? $last_piece : "" ); ?>" >&lt;</a>
                        <?php
                        }
                        
                        for ($i=($pag-4) ; $i < $pag ; $i++ ){
                            
                            if ( $i > 0 ){
                                ?>
                                    <a class="pag-button" href="<?php echo $url.'/'.$i.( isset($last_piece) ? $last_piece : "" ); ?>" ><?php echo $i; ?></a>
                                <?php
                            }
                        }
                        
                        ?>
                        <a class="pag-button current-page" href="<?php echo $url.'/'.$pag.( isset($last_piece) ? $last_piece : "" ); ?>" ><?php echo $pag; ?></a>
                        <?php
                        
                        // despues de la pagina seleccionada
                        for ($i=($pag+1) ; $i < $pag+5 ; $i++ ){
                            
                            if ( $i > $num_pags )
                                break;
                            
                            ?>
                                <a class="pag-button" href="<?php echo $url.'/'.$i.( isset($last_piece) ? $last_piece : "" ); ?>" ><?php echo $i; ?></a>
                            <?php
                        }
                        
                        if ( $pag+1 < $num_pags ){
                        ?>
                        <a class="pag-button current-page" href="<?php echo $url.'/'.($pag+1).( isset($last_piece) ? $last_piece : "" ); ?>" >&gt;</a>
                        <?php
                        }
                        ?>
                        <br>
                        <?php echo $this->lang->line('ir_a_la_pagina'); ?>:
                        <input onKeyPress="onlyNumbers(event)" type="text" id="go_to_page" />
                        <img onClick="goToPage()" id="go_to_page_img" src="<?php echo base_url(); ?>img/go_to_page.png" width="16" height="16" />
                    </div>
                </td>
            </tr>
        </table>
        <?php
			if ( isset($pc_explanation) ){
			?>
            <table cellpadding="3" style="margin-left:10px;">
            	<tr>
                	<td><img src="<?php echo base_url(); ?>img/flag-1.png" /></td>
                    <td><a rel="leanModal" href="#modal-explanation"><?php echo $this->lang->line('quieres_saber_mas_sobre_tarjetas_telefonicas'); ?>&nbsp;<?php echo $pc_explanation['country']['name']; ?>?</a></td>
                </tr>
            </table>
            <div id="modal-explanation">
                <img id="modal-close" src="<?php echo base_url().'img/modal-close.png'; ?>" width="16" height="16" />
                <div>
                    <table id="explanation-flag">
                        <tr>
                            <td style="background:#ff0"></td>
                            <td style="background:#00f"></td>
                            <td style="background:#f00"></td>
                        </tr>
                    </table>
                </div>
                <div id="explanation_title">
                    <?php echo $this->lang->line('tarjetas_telefonicas_de'); ?> <?php echo $pc_explanation['country']['name']; ?>
                </div>
              <div id="explanation">
                	
                <table cellpadding="15" style="margin-right:20px;">
                    	<tr>
                        	<td><img src="<?php echo $pc_explanation['first_image'] ?>" width="200" height="120" /></td>
                            <td>
                            	<div class="explanation_title"><?php echo $pc_explanation['first_title']; ?></div>
								<?php echo $pc_explanation['first_explanation']; ?>
                          </td>
                        </tr>
                        <tr>
                        	<td><img src="<?php echo $pc_explanation['code_image'] ?>" width="200" height="120" /></td>
                            <td>
                            <div class="explanation_title"><?php echo $pc_explanation['code_title']; ?></div>
                            	<?php echo $pc_explanation['code_explanation']; ?>
                            </td>
                        </tr>
                    </table>
                    
                <div class="explanation_title2"><?php echo $this->lang->line('rarezas_de'); ?>&nbsp;<?php echo $pc_explanation['country']['name']; ?></div>
                <table width="100%" style="text-align:center">
                    	<?php
							$explanation_pcs = $pc_explanation['rare_phonecards'];
							
							for ( $i = 0 ; $i < count($explanation_pcs) ; $i++ ){
								
								$pc = $explanation_pcs[$i];
								
								if ( $i % 2 == 0 ){
									echo '<tr>';	
								}
								?>
                                <td>
                               	  <img src="<?php echo base_url().'img/explanation/'.$pc['image']; ?>" width="200" height="120" />
                                </td>
                                <?php
								if ( $i % 2 == 1 ){
									echo '</tr>';	
								}
								
							}
						?>
                </table>
                </div>
      </div>
            <?php
			}
		?>
        
		<?php
			include 'show_phonecards_content.php';
		?>
	</div>
</div>
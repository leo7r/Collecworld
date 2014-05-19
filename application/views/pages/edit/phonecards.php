<script language="javascript" src="<?php echo base_url().'js/functions/functions_upload_and_edit.js'; ?>"></script>
<script>
		
	function img_loaded( num ){
		
		if ( num == 0 ){
			name = document.getElementById('i_file').value;
			name = name.replace('C:\\fakepath\\','');
			document.getElementById('i_info').innerHTML='<span style="color:#0c3;">'+name+' loaded.</span>';
		}
		else{
			name = document.getElementById('i_file_r').value;
			name = name.replace('C:\\fakepath\\','');
			document.getElementById('i_info-r').innerHTML='<span style="color:#0c3;">'+name+' loaded.</span>';
		}
		
	}
	
	// To start
	$(document).ready(function(){
		pForm = document.getElementById('form0');
		pForm.setAttribute('enctype', 'multipart/form-data');
		pForm.setAttribute('encoding', 'multipart/form-data');
		
	});
	
</script>

<?php

function isIE(){
	if (isset($_SERVER['HTTP_USER_AGENT']) && 
	(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
		return true;
	else
		return false;
}

@session_start();

?>
<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<a id="modalF" style="display:none;" rel="leanModal" href="#modal-feedback">a</a>
<div id="modal-phonecard"></div>
<div id="modal-feedback"></div>
<?php
	var_dump($phonecard);
?>

<div id="content">
		
		<div id="toolbar">
			<div class="in">
				<div id="toolbar-left">
					<div class="item location">
						&nbsp;<a href="<?php echo base_url().'index.php/init'; ?>"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href=""><?php echo $this->lang->line('editar'); ?></a>&nbsp;&raquo;
					</div>
				</div>
				
				<?php
				@session_start();
				if ( $_SESSION['user'] ){
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
          		<div id="info-info" >
                    - <?php echo $this->lang->line('rellena_los_campos_con_la_informacion'); ?>.
                    <br />
                    <br />
                    - <?php echo $this->lang->line('si_algun_campo_no_existe'); ?>.
                </div>
                
                <div id="upload-error" style="display:none;">
                    <div id="warning-in">
                        <div class="title_warning">
                            <img src="<?php echo base_url(); ?>img/alert.png" height="16" width="16" />
                            <?php echo $this->lang->line('tu_tarjeta_telefonica'); ?> <span style="text-decoration:underline;"><?php echo $this->lang->line('no_pudo'); ?></span> <?php echo $this->lang->line('ser_cargada'); ?>
                        </div>
                    </div>
                    <div id="warning-info">
                        <?php echo $this->lang->line('diculpa_tuvimos_un_problema_cargando_tu'); ?> <b><?php echo $this->lang->line('tarjeta_telefonica'); ?></b>. <?php echo $this->lang->line('intentalo_mas_tarde'); ?>.
                        <br />
                        <br />
                        <a href="#"> <?php echo $this->lang->line('contactanos'); ?></a>
                    </div>
                </div>
                
                <div id="upload-done" style="display:none;">
                    <div id="done-in">
                        <div class="title_warning">
                            <img src="<?php echo base_url(); ?>img/done.png" height="16" width="16" />
                            <?php echo $this->lang->line('tu_tarjeta_ha_sido_cargada'); ?>!
                        </div>
                    </div>
                    <div id="done-info">
                        <span class="google-button" onclick="modalPhonecard('don');"><?php echo $this->lang->line('ver'); ?></span>
                        &nbsp;&nbsp;&nbsp;
                        <span class="google-button" onclick="setFormVisible();"><?php echo $this->lang->line('cargar_nueva_tarjeta_telefonica'); ?></span>
                    </div>
                </div>
                
                <div id="upload-pc" class="box1">
                    
                    <form id="form0" action="<?php echo base_url(); ?>upload/phonecard_upload_go" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
                        <div id="upload-title">
                            <span><?php echo $this->lang->line('editar_tarjeta_telefonica'); ?></span>
                            <img id="upload-help" src="<?php echo base_url(); ?>img/help2.png" height="20" width="20" onmouseover="showInfo( this , '<?php echo $this->lang->line('antes_de_cargar_una_tarjeta_telefonica'); ?>.' )">
                            <input type="reset" value="<?php echo $this->lang->line('restablecer'); ?>" id="upload-colab" class="google-button" >
                        </div>
                        <div id="upload-required">
                            * &mdash; <?php echo $this->lang->line('campos_obligatorios'); ?>
                        </div>	
                        <table cellspacing="5px">
                            <tr>
                                <td><span class="obb">* </span><?php echo $this->lang->line('pais'); ?>: </td>
                                <td>
                                    <select id="countries" name="countries" onChange="phonecard_onCountrySelected(this);">
                                        <option value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>
                                        <?php
                                            for ($i=0 ; $i < count($countries) ; $i++){
												
												$selected = $countries[$i]['id_categories_countries'] == $phonecard['id_categories_countries'] ? 'selected="selected"':'';												
                                                echo '<option '.$selected.' value="'.$countries[$i]['id_categories_countries'].'" >'.$countries[$i]['countries'].'</option>';
                                            }
                                        ?>							
                                    </select>
                                </td>
                                <td><a href="javascript:modalFeedbackCountry()"><?php echo $this->lang->line('tu_pais_no_aparece'); ?></a></td>
                            </tr>
                            <tr>
                                <td><span class="obb">* </span><?php echo $this->lang->line('circulacion'); ?>:</td>
                                <td>
                                    <input type="radio" name="circulation" value="0" <?php echo $phonecard['phonecards_circulation'] == 0 ? 'checked="checked"':'' ?> ><?php echo $this->lang->line('normal'); ?>&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="circulation" value="1" <?php echo $phonecard['phonecards_circulation'] == 1 ? 'checked="checked"':'' ?>><?php echo $this->lang->line('especial'); ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><span class="obb">* </span><?php echo $this->lang->line('compania'); ?>: </td>
                                <td id="s_comp">
                                    <select id="company" name="company">
                                        <option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>
                                        <?php
											 for ($i=0 ; $i < count($companies) ; $i++){
												
												$selected = $companies[$i]['id_phonecards_companies'] == $phonecard['id_phonecards_companies'] ? 'selected="selected"':'';												
                                                echo '<option '.$selected.' value="'.$companies[$i]['id_phonecards_companies'].'" >'.$companies[$i]['companies'].'</option>';
                                            }
										?>
                                    </select>
                                </td>
                                <td class="reg_info"><?php echo $this->lang->line('compania_emisora_tarjeta'); ?></td>
                            </tr>
                            <tr id="system_tr">
                                <td><span class="obb">* </span><?php echo $this->lang->line('sistema'); ?>: </td>
                                <td>
                                    <select id="system" name="system" style="width:150px;" onchange="setSystemType(this);"  >
                                        <option value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>
                                        <option <?php echo $phonecard['id_phonecards_systems'] == 1 ? 'selected="selected"':''; ?> value="1" ><?php echo $this->lang->line('chip'); ?></option>
                                        <option <?php echo $phonecard['id_phonecards_systems'] == 2 ? 'selected="selected"':''; ?> value="2" ><?php echo $this->lang->line('banda_magnetica'); ?></option>
                                        <option <?php echo $phonecard['id_phonecards_systems'] == 3 ? 'selected="selected"':''; ?> value="3" ><?php echo $this->lang->line('sistema_optico'); ?></option>
                                        <option <?php echo $phonecard['id_phonecards_systems'] == 4 ? 'selected="selected"':''; ?> value="4" ><?php echo $this->lang->line('memoria_remota'); ?></option>
                                        <option <?php echo $phonecard['id_phonecards_systems'] == 5 ? 'selected="selected"':''; ?> value="5" ><?php echo $this->lang->line('sistema_inducido'); ?></option>		
                                    </select>
                                </td>
                                <td><a href="javascript:modalFeedbackSystem()"><?php echo $this->lang->line('tu_sistema_no_aparece'); ?></a></td>
                            </tr>
                            <tr>
                                <td><span class="obb">* </span><?php echo $this->lang->line('nombre'); ?>: </td>
                                <td><input type="text" id="phonecard_name" value="<?php echo $phonecard['phonecards_name']; ?>" name="phonecard_name" class="upload-input"></td>
                                <td class="reg_info"><?php echo $this->lang->line('nombre_tarjeta_telefonica'); ?></td>
                            </tr>
                            <tr id="catalog-tr">
                                <td><?php echo $this->lang->line('catalogo_referencia'); ?>: </td>
                                <td>
                                    <select onChange="loadCatalogSection(1)" disabled="disabled" class="catalog-select" id="catalog" name="catalog">
                                        <option selected="selected" value="-1"><?php echo $this->lang->line('seleccione'); ?></option>                    	
                                    </select>
                                </td>
                                <td><a href="javascript:modalFeedbackReferenceCatalog()"><?php echo $this->lang->line('problemas_catalogo_referencia'); ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('serie'); ?>: </td>
                                <td id="s_ser">
                                    <div class="reg_info">
                                        <span><?php echo $this->lang->line('nombre'); ?></span>
                                        <span style="float:right; margin-right:5px;"><?php echo $this->lang->line('numero'); ?></span>
                                    </div>
                                    <input type="text" id="serie" name="serie" value="<?php echo $phonecard['series']; ?>" class="upload-input2">
                                    &nbsp;&nbsp;
                                    <input type="text" id="serie_n" name="serie_n" class="upload-num" value="<?php echo $phonecard['serie_number']; ?>" onkeypress="onlyNumbers(event)" >
                                </td>
                                <td class="reg_info"><?php echo $this->lang->line('impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
                            </tr>            
                            <tr>
                                <td><?php echo $this->lang->line('moneda'); ?>: </td>
                                <td id="s_curr">
                                    <select id="currency" name="currency">
                                        <option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>
                                        <?php
										 for ($i=0 ; $i < count($denominations) ; $i++){
											
											$selected = $denominations[$i]['id_phonecards_denomination'] == $phonecard['id_phonecards_denomination'] ? 'selected="selected"':'';												
											echo '<option '.$selected.' value="'.$denominations[$i]['id_phonecards_denomination'].'" >'.$denominations[$i]['denomination'].'</option>';
										}
										
										?>
                                    </select>
                                </td>
                                <td><a href="javascript:modalFeedbackCurrency()"><?php echo $this->lang->line('tu_moneda_no_aparece'); ?></a></td>
                            </tr>            
                            <tr>
                                <td><?php echo $this->lang->line('valor_nominal'); ?>: </td>
                                <td><input type="text" id="faceValue" name="faceValue" value="<?php echo $phonecard['face_value']; ?>" onkeypress="onlyNumbers(event)"  class="upload-input"></td>
                                <td class="reg_info"><?php echo $this->lang->line('ejemplo_20000'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('emitida'); ?>: </td>
                                <td id="upload-date">
                                	<?php
										// Hago split de la fecha por '/'
										$date_token = explode('/',$phonecard['issued_on']);
																				
										if ( $date_token and count($date_token) > 1 ){
											$year = $date_token[0];
											$month = $date_token[1];
											$day = $date_token[2];
										}
										else{
											$year = '';
											$month = '';
											$day = '';	
										}
										
									?>                                
                                    <div>&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('ano'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('mes'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('dia'); ?></div>
                                    <div>
                                        <input type="text" id="date_year" name="date_year" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn(this,4,0);onlyOneDate(this,'date_known');" onkeypress="onlyNumbers(event)" maxlength="4" value="<?php echo $year; ?>" >
                                        /
                                        <input type="text" id="date_month" name="date_month" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2"  value="<?php echo $month; ?>">
                                        /
                                        <input type="text" id="date_day" name="date_day" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' );"  maxlength="2"  value="<?php echo $day; ?>">
                                    </div>
                                </td>
                                <td class="reg_info"><?php echo $this->lang->line('deje_en_blanco'); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="checkbox" name="date_known" checked="checked" /><?php echo $this->lang->line('impreso_en_tarjeta'); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('fecha_vencimiento'); ?>: </td>
                                <td id="upload-date_ex">
                                	<?php
										// Hago split de la fecha por '/'
										$date_token = explode('/',$phonecard['exp_date']);
																				
										if ( $date_token and count($date_token) > 1 ){
											$year = $date_token[0];
											$month = $date_token[1];
											$day = $date_token[2];
										}
										else{
											$year = '';
											$month = '';
											$day = '';	
										}
										
									?>
                                
                                    <div>
                                        <input type="text" id="date_ex_year" name="date_ex_year" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn2(this,4,0);" onkeypress="onlyNumbers(event)"  maxlength="4" value="<?php echo $year; ?>">
                                        /
                                        <input type="text" id="date_ex_month" name="date_ex_month" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn2(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2" value="<?php echo $year; ?>">
                                        /
                                        <input type="text" id="date_ex_day" name="date_ex_day" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' )"  maxlength="2" value="<?php echo $year; ?>">
                                    </div>
                                </td>
                                <td class="reg_info"><?php echo $this->lang->line('no_impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
                            </tr>
                            <tr>
                                <td onmouseover="showInfo(this,'Manual sort field, only in the absence of dates')"><?php echo $this->lang->line('numero_de_orden'); ?>: </td>
                                <td><input type="text" id="order_n" name="order_n" class="upload-num" onkeypress="onlyNumbers(event)" value="<?php echo $phonecard['order_n']; ?>"  /></td>
                                <td class="reg_info"><?php echo $this->lang->line('numero_de_orden_explicacion'); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('tiraje'); ?>: </td>
                                <td><input type="text" id="printRun" name="printRun" onkeypress="onlyNumbers(event);" class="upload-input" value="<?php echo $phonecard['print_run']; ?>" ></td>
                                <td class="reg_info"><?php echo $this->lang->line('ejemplo_20000'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
                            </tr>
                            <tr id="variation1" style="display:none;">
                                <td><?php echo $this->lang->line('variante_1_chip'); ?>: </td>
                                <td>
                                    <span class="google-button" onclick="showSystemTypes();">
                                        <?php echo $this->lang->line('seleccione'); ?>
                                        <img style="position:relative; top:4px; left:4px;" src="<?php echo base_url(); ?>img/arrow-down.png" width="16" height="16"/>
                                    </span>
                                    <div id="variation1_list" style="display:none;">
                                        
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:modalFeedbackSystemType()"><?php echo $this->lang->line('tu_chip_no_aparece'); ?></a>
                                </td>
                            </tr>
                            <tr id="variation2" style="display:none;">
                                <td><?php echo $this->lang->line('variante_2_logo'); ?>: </td>
                                <td>
                                    <span class="google-button" onclick="showLogoTypes();">
                                        <?php echo $this->lang->line('seleccione'); ?>
                                        <img style="position:relative; top:4px; left:4px;" src="<?php echo base_url(); ?>img/arrow-down.png" width="16" height="16"/>
                                    </span>
                                    <div id="variation2_list" style="display:none">
                                        <table id="variation2_table" style="margin:0;">
                                        
                                            <?php
                                                                        
                                            for ($i=0 ; $i < count($logos_list) ; $i++){
                                                ?>
                                                
                                                <tr <?php echo $i % 2 == 0 ? '':'class="odd"'; ?> >
                                                    <td><input onchange="allowOne('variation2_list',this);"  type="checkbox" value="<?php echo $logos_list[$i]['id_phonecards_logos']; ?>" name="variation2_<?php echo $i; ?>" /></td>
                                                    <td><?php echo $logos_list[$i]['name']; ?></td>
                                                    <td><img class="variation_table_images" src="<?php echo base_url(); ?>upload/logo/<?php echo $logos_list[$i]['id_phonecards_logos']; ?>.jpg" onmouseover="showInfo3(this,1,<?php echo $logos_list[$i]['id_phonecards_logos']; ?>,1);" /></td>
                                                </tr>
                                                <?php
                                            }
                                                ?>
                                            
                                            <input type="hidden" value="" id="var2" name="var2" />
                                            
                                        </table>
                                    </div>
                                </td>
                                <td><a href="javascript:modalFeedbackLogo()"><?php echo $this->lang->line('tu_logo_no_aparece'); ?></a></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('imagen_anverso'); ?>: </td>
                                <td id="i_img">
                                    <input type="file" style="display:none;" id="i_file" name="i_file" accept="image/*" onchange="img_loaded(0);" />
                                    <input class="google-button" type="button" value="<?php echo $this->lang->line('examinar'); ?>" onclick="document.getElementById('i_file').click();" />
                                    <span id="upload-img-info"></span>
                                </td>
                                <td id="i_info" class="reg_info"><?php echo $this->lang->line('por_lo_menos_600_300'); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('imagen_reverso'); ?>: </td>
                                <td id="i_img_r">
                                    <input type="file" style="display:none;" id="i_file_r" name="i_file_r" accept="image/*" onchange="img_loaded(1);" />
                                    <input class="google-button" type="button" value="<?php echo $this->lang->line('examinar'); ?>" onclick="document.getElementById('i_file_r').click();" />
                                    <span id="upload-img-info-r"></span>
                                </td>
                                <td id="i_info-r" class="reg_info"><?php echo $this->lang->line('por_lo_menos_600_300'); ?></td>
                            </tr>
                            <?php
                                $tags = '';
                                
                                for ( $i = 0 ; $i < count($tags_list) ; $i++ ){
                                    $tags = $tags.'<option value="'.$tags_list[$i]['id_tags'].'">'.$tags_list[$i]['name'].'</option>';
                                }
                            ?>
                            <tr>
                                <td><?php echo $this->lang->line('tematica'); ?>: </td>
                                <td>
                                    <select id="tag0" name="tag0" onchange="setTag(0);" >
                                        <option value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>
                                        <?php echo $tags; ?>
                                    </select>
                                </td>
                                <td class="reg_info"><?php echo $this->lang->line('opcional'); ?></td>
                            </tr>
                            <tr id="tag_tr1" style="display:none;">
                                <td></td>
                                <td>
                                    <select id="tag1" name="tag1" onchange="setTag(1);" >
                                        <option value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>
                                        <?php echo $tags; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr id="tag_tr2" style="display:none;">
                                <td></td>
                                <td>
                                    <select id="tag2" name="tag2" onchange="setTag(2);" >
                                        <option value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>
                                        <?php echo $tags; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr id="tag_tr3" style="display:none;">
                                <td></td>
                                <td>
                                    <select id="tag3" name="tag3" onchange="setTag(3);" >
                                        <option value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>
                                        <?php echo $tags; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr id="variation3">
                                <td id="variation3_text"><?php echo $this->lang->line('variacion_descriptiva'); ?>:</td>
                                <td>
                                    <textarea class="input1" name="var3" style="height:100px;" ></textarea>
                                </td>
                                <td id="variation3_info" class="reg_info"><?php echo $this->lang->line('ayuda_variante_descriptiva'); ?></td>
                            </tr>			
                            <tr>
                                <td><?php echo $this->lang->line('precio_estimado_dol'); ?>: </td>
                                <td>
                                    <table>
                                        <?php
                                            for ( $i = 0 ; $i < count($prices_list) ; $i++ ){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $prices_list[$i]['name']; ?>:
                                                </td>
                                                <td>
                                                    $&nbsp;<input type="text" id="price_<?php echo $prices_list[$i]['id_status']; ?>" name="price_<?php echo $prices_list[$i]['id_status']; ?>" class="upload-num"  onkeypress="onlyNumbers(event)" maxlength="6" autocomplete="off">
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        ?>
                                    </table> 
                                </td>
                                <td class="reg_info"></td>
                            </tr> 			
                        </table>
                        
                        <div style="margin-top:10px; margin-bottom:10px; margin-left:15px;">
                            <input type="hidden" id="saveInfo" name="saveInfo" value="" />
                            <span onclick="phonecard_sendForm();" class="google-button google-button-blue"><?php echo $this->lang->line('cargar'); ?></span>
                            <span onclick="phonecard_sendForm(2);" class="google-button google-button-red" onmouseover="showInfo( this , '<?php echo $this->lang->line('opcion_para_cargar_variante'); ?>' )" ><?php echo $this->lang->line('cargar_y_salvar_informacion'); ?></span>
                            <div id="uploading-images" >
                                <table>
                                    <tr>
                                        <td><img src="<?php echo base_url(); ?>img/ajax-loader.gif" /></td>
                                        <td><?php echo $this->lang->line('cargando_imagenes'); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                    </form>
                </div>  	
			</div>
	</div>
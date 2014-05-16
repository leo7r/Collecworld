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
	
	function setChipImg( dom ){
	
		id = dom.selectedIndex;
		
		if ( id != 0 ){
			if ( id % 2 == 0 )
				document.getElementById('chip-img').src = '../img/chip2.jpg';
			else
				document.getElementById('chip-img').src = '../img/chip1.jpg';
			
			$("#chip-img").css({display:''});
		}
		else{
			$("#chip-img").css({display:'none'});
		}
	
	}
	
	// To start
	$(document).ready(function(){
		
		pForm = document.getElementById('form0');
		pForm.setAttribute('enctype', 'multipart/form-data');
		pForm.setAttribute('encoding', 'multipart/form-data');
		var saveInfo = $(document).getUrlParam("sav");
		
		
		var err = $(document).getUrlParam("err");
		var don = $(document).getUrlParam("don");
		
		if ( don ){
			$("#upload-done").css({display:''});
			$("#upload-pc").css({display:'none'});
		}
		
		if ( err ){
			
			err = parseInt(err);
			$("#upload-error").css({display:''});
			
			if ( err >= 0 ){
				
				var img_status = $(document).getUrlParam("img");
				
				if ( err > 0 ){
					document.getElementById("warning-info").innerHTML = '<?php echo $this->lang->line('error_tarjeta_repetida'); ?><br /><br />';
					document.getElementById("warning-info").innerHTML+= '<span class="google-button" onclick="modalPhonecard(\'err\');" ><?php echo $this->lang->line('ver'); ?></span>';
					
					if ( img_status == -1 ){
						document.getElementById("warning-info").innerHTML+= "<br><?php echo $this->lang->line('error_tarjeta_sin_imagen'); ?><span class=\"google-button\" ><?php echo $this->lang->line('error_agregar_imagen'); ?></span>";
					}
					
				}
				else{
					document.getElementById("warning-info").innerHTML = '<?php echo $this->lang->line('error_cargando_tarjetas'); ?>';
				}	
			}
			else{
				if ( err == -1 ){
					document.getElementById("warning-info").innerHTML = '<?php echo $this->lang->line('error_imagenes'); ?>';
				}
			}
		}
		
		var g_country = $(document).getUrlParam("cou");
		var g_currency = $(document).getUrlParam("cur");
		var g_company = $(document).getUrlParam("com");
		var g_serie = $(document).getUrlParam("ser");
		var g_serie2 = $(document).getUrlParam("ser2");
		var g_serie_n = $(document).getUrlParam("sen");
		var g_serie2_n = $(document).getUrlParam("sen2");
		var g_name = $(document).getUrlParam("nam");
		var g_issued_on = $(document).getUrlParam("iss");
		var g_exp_date = $(document).getUrlParam("exp");
		var g_known_date = $(document).getUrlParam("kno");
		
		var g_system = $(document).getUrlParam("sys");
		var g_faceValue = $(document).getUrlParam("fav");
		var g_printRun = $(document).getUrlParam("prr");
		var g_printRun2 = $(document).getUrlParam("prr2");
		var g_tags = $(document).getUrlParam("tag");
		
		var g_order_n = $(document).getUrlParam("orn");
		
		var g_not_emmited = $(document).getUrlParam("noe");
		var g_especial = $(document).getUrlParam("esp");		
		
		// Set Country
		var c_input = document.getElementById("country");
		var country_opt = c_input.getElementsByTagName('option');
		
		for ( i=0 ; i < country_opt.length ; i++ ){
			
			if ( country_opt[i].value == g_country ){
				c_input.selectedIndex = i;
				break;
			}
		}
		
		//c_input.selectedIndex = g_country;
		phonecard_onCountrySelected(c_input);
		
		
		// Set Name
		c_input = document.getElementById("name");
		if ( g_name != null )
			c_input.value = g_name.toString().replace(/%20/g,' ');
		
		// Set Company
		c_input = document.getElementById("companies");
		if ( g_company != null )
			c_input.value = g_company.toString().replace(/%20/g,' ');;
		
		// Set not emmited
		c_input = document.getElementById('not_emmited');
		if ( g_not_emmited == 1 ){
			c_input.checked = "checked";
		}
		
		// Set especial
		c_input = document.getElementById('especial');
		if ( g_especial == 1 ){
			c_input.checked = "checked";
		}
		
		if ( g_especial || g_not_emmited ){
			$("#especial,#not_emmited").prop("disabled",true);
		}
		
		// Set Serie
		c_input = document.getElementById("serie");
		if ( g_serie != null )
			c_input.value = g_serie.toString().replace(/%20/g,' ');
		
		// Set Serie number
		c_input = document.getElementById('serie_n');
		if ( g_serie_n != null )
			c_input.value = g_serie_n;
			
		// Set Serie2
		c_input = document.getElementById("serie2");
		if ( g_serie2 != null )
			c_input.value = g_serie2.toString().replace(/%20/g,' ');
			
		// Set Serie number
		c_input = document.getElementById('serie_n2');
		if ( g_serie2_n != null )
			c_input.value = g_serie2_n;
		
		if ( g_system ){
			// Set System
			c_input = document.getElementById("system");
			c_input.selectedIndex = g_system;
			setSystemType(c_input);
		}
		
		// Set Face Value
		c_input = document.getElementById("faceValue");
		c_input.value = g_faceValue;
		
		// Set Print run
		c_input = document.getElementById("printRun");
		c_input.value = g_printRun;
		
		// Set Print run
		c_input = document.getElementById("printRun2");
		c_input.value = g_printRun2;
		
		c_input = document.getElementById("order_n");
		c_input.value = g_order_n;
		
		// Set Date
		try{
			c_input = document.getElementById("date_year");
			c_input1 = document.getElementById("date_month");
			c_input2 = document.getElementById("date_day");
			
			g_issued_on = g_issued_on.split('/');
			
			if ( g_issued_on.length == 3 ){
				c_input.value = g_issued_on[0];
				c_input1.value = g_issued_on[1];
				c_input2.value = g_issued_on[2];
			}
		}
		catch(e){
			
		}
		
		// Set Known Date
		try{
			c_input = document.getElementById("date_known_year");
			c_input1 = document.getElementById("date_known_month");
			c_input2 = document.getElementById("date_known_day");
			
			g_known_date = g_known_date.split('/');
			
			if ( g_known_date.length == 3 ){
				c_input.value = g_known_date[0];
				c_input1.value = g_known_date[1];
				c_input2.value = g_known_date[2];
			}
		}
		catch(e){
			
		}
		
		// Set Expiration Date
		try{
			c_input = document.getElementById("date_ex_year");
			c_input1 = document.getElementById("date_ex_month");
			c_input2 = document.getElementById("date_ex_day");
			
			g_exp_date = g_exp_date.split('/');
			
			if ( g_exp_date.length == 3 ){
				c_input.value = g_exp_date[0];
				c_input1.value = g_exp_date[1];
				c_input2.value = g_exp_date[2];
			}
		}
		catch(e){
			
		}
		
		// Set tags
		if ( g_tags ){
			g_tags = g_tags.split(',');
			
			for ( i=0 ; i < g_tags.length ; i++ ){
				
				tag = g_tags[i].toString().replace(/%20/g,' ');
				opts = document.getElementById('tag'+i).getElementsByTagName('option');
				for ( k=1 ; k<opts.length ; k++ ){
				
					opt = opts[k].value;
					if ( opt == tag ){
						document.getElementById('tag'+i).selectedIndex = k;
						setTag(i);
						break;
					}
				}
			}
		}
		
		if ( saveInfo==1 ){
			$("#name,#country,#companies,#system,#serie,#serie_n,#serie2,#serie_n2,#printRun,#printRun2,#faceValue,#tag0,#tag1,#tag2,#tag3,#order_n").prop('disabled', true);
			$("#date_year,#date_month,#date_day,#date_known_year,#date_known_month,#date_known_day,#date_ex_year,#date_ex_month,#date_ex_day").prop('disabled',true);
			showSystemTypes();
			showLogoTypes();
		}
		
		$( "#companies" ).autocomplete({
            source: path+'ajax/upload/autocomplete.php?table=phonecards_companies'
        });
		
		$( "#serie" ).autocomplete({
            source: path+'ajax/upload/autocomplete.php?table=phonecards_series'
        });
		
	});
	
	function setFormVisible(){
		$("#upload-pc").css({display:''});	
	}

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

<div id="info-info" >
	- <?php echo $this->lang->line('rellena_los_campos_con_la_informacion'); ?>.
	<br />
    <br />
	- <?php echo $this->lang->line('si_algun_campo_no_existe'); ?>.
</div>

<div id="upload-error" style="display:none;">
	<div id="warning-in">
		<div class="title_warning">
			<img src="<?php echo $path; ?>img/alert.png" height="16" width="16" />
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
			<img src="<?php echo $path; ?>img/done.png" height="16" width="16" />
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
	
	<form id="form0" action="<?php echo $path; ?>upload/phonecard_upload_go" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
        <div id="upload-title">
            <span><?php echo $this->lang->line('cargar_tarjeta_telefonica'); ?></span>
            <img id="upload-help" src="<?php echo $path; ?>img/help2.png" height="20" width="20" onmouseover="showInfo( this , '<?php echo $this->lang->line('antes_de_cargar_una_tarjeta_telefonica'); ?>.' )">
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
								echo '<option value="'.$countries[$i]['id_categories_countries'].'" >'.$countries[$i]['countries'].'</option>';
							}
						?>							
					</select>
				</td>
				<td><a href="javascript:modalFeedbackCountry()"><?php echo $this->lang->line('tu_pais_no_aparece'); ?></a></td>
			</tr>
            <tr>
            	<td><span class="obb">* </span><?php echo $this->lang->line('circulacion'); ?>:</td>
                <td>
                	<input type="radio" name="circulation" value="0" checked="checked"><?php echo $this->lang->line('normal'); ?>&nbsp;&nbsp;&nbsp;
					<input type="radio" name="circulation" value="1"><?php echo $this->lang->line('especial'); ?>
                </td>
                <td></td>
            </tr>
            <tr>
				<td><span class="obb">* </span><?php echo $this->lang->line('compania'); ?>: </td>
				<td id="s_comp">
					<select disabled="disabled" id="company" name="company">
						<option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>
					</select>
				</td>
				<td class="reg_info"><?php echo $this->lang->line('compania_emisora_tarjeta'); ?></td>
			</tr>
            <tr id="system_tr">
				<td><span class="obb">* </span><?php echo $this->lang->line('sistema'); ?>: </td>
				<td>
					<select disabled="disabled" id="system" name="system" style="width:150px;" onchange="setSystemType(this);"  >
						<option selected="selected" value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>
						<option value="1" ><?php echo $this->lang->line('chip'); ?></option>
						<option value="2" ><?php echo $this->lang->line('banda_magnetica'); ?></option>
						<option value="3" ><?php echo $this->lang->line('sistema_optico'); ?></option>
						<option value="4" ><?php echo $this->lang->line('memoria_remota'); ?></option>
						<option value="5" ><?php echo $this->lang->line('sistema_inducido'); ?></option>		
					</select>
				</td>
				<td><a href="javascript:modalFeedbackSystem()"><?php echo $this->lang->line('tu_sistema_no_aparece'); ?></a></td>
			</tr>
			<tr>
				<td><span class="obb">* </span><?php echo $this->lang->line('nombre'); ?>: </td>
				<td><input type="text" id="phonecard_name" name="phonecard_name" class="upload-input"></td>
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
					<input type="text" id="serie" name="serie" value="" class="upload-input2">
                    &nbsp;&nbsp;
					<input type="text" id="serie_n" name="serie_n" class="upload-num" onkeypress="onlyNumbers(event)" >
				</td>
				<td class="reg_info"><?php echo $this->lang->line('impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
			</tr>            
			<tr>
				<td><?php echo $this->lang->line('moneda'); ?>: </td>
				<td id="s_curr">
					<select disabled="disabled" id="currency" name="currency">
						<option selected="selected" value="-1"><?php echo $this->lang->line('seleccione'); ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackCurrency()"><?php echo $this->lang->line('tu_moneda_no_aparece'); ?></a></td>
			</tr>            
			<tr>
				<td><?php echo $this->lang->line('valor_nominal'); ?>: </td>
				<td><input type="text" id="faceValue" name="faceValue" onkeypress="onlyNumbers(event)"  class="upload-input"></td>
				<td class="reg_info"><?php echo $this->lang->line('ejemplo_20000'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
			</tr>
            <tr>
				<td><?php echo $this->lang->line('emitida'); ?>: </td>
				<td id="upload-date">
					<div>&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('ano'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('mes'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('dia'); ?></div>
					<div>
						<input type="text" id="date_year" name="date_year" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn(this,4,0);onlyOneDate(this,'date_known');" onkeypress="onlyNumbers(event)" maxlength="4">
						/
						<input type="text" id="date_month" name="date_month" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2">
						/
						<input type="text" id="date_day" name="date_day" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' );"  maxlength="2">
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
					<div>
						<input type="text" id="date_ex_year" name="date_ex_year" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn2(this,4,0);" onkeypress="onlyNumbers(event)"  maxlength="4">
						/
						<input type="text" id="date_ex_month" name="date_ex_month" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn2(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2">
						/
						<input type="text" id="date_ex_day" name="date_ex_day" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' )"  maxlength="2">
					</div>
				</td>
				<td class="reg_info"><?php echo $this->lang->line('no_impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
			</tr>
			<tr>
				<td onmouseover="showInfo(this,'Manual sort field, only in the absence of dates')"><?php echo $this->lang->line('numero_de_orden'); ?>: </td>
				<td><input type="text" id="order_n" name="order_n" class="upload-num" onkeypress="onlyNumbers(event)"  /></td>
				<td class="reg_info"><?php echo $this->lang->line('numero_de_orden_explicacion'); ?></td>
			</tr>
			<tr>
				<td><?php echo $this->lang->line('tiraje'); ?>: </td>
				<td><input type="text" id="printRun" name="printRun" onkeypress="onlyNumbers(event);" class="upload-input" ></td>
				<td class="reg_info"><?php echo $this->lang->line('ejemplo_20000'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
			</tr>
            <tr id="variation1" style="display:none;">
				<td><?php echo $this->lang->line('variante_1_chip'); ?>: </td>
				<td>
					<span class="google-button" onclick="showSystemTypes();">
						<?php echo $this->lang->line('seleccione'); ?>
						<img style="position:relative; top:4px; left:4px;" src="<?php echo $path; ?>img/arrow-down.png" width="16" height="16"/>
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
						<img style="position:relative; top:4px; left:4px;" src="<?php echo $path; ?>img/arrow-down.png" width="16" height="16"/>
					</span>
					<div id="variation2_list" style="display:none">
						<table id="variation2_table" style="margin:0;">
						
							<?php
														
							for ($i=0 ; $i < count($logos_list) ; $i++){
								?>
								
								<tr <?php echo $i % 2 == 0 ? '':'class="odd"'; ?> >
									<td><input onchange="allowOne('variation2_list',this);"  type="checkbox" value="<?php echo $logos_list[$i]['id_phonecards_logos']; ?>" name="variation2_<?php echo $i; ?>" /></td>
									<td><?php echo $logos_list[$i]['name']; ?></td>
									<td><img class="variation_table_images" src="<?php echo $path; ?>upload/logo/<?php echo $logos_list[$i]['id_phonecards_logos']; ?>.jpg" onmouseover="showInfo3(this,1,<?php echo $logos_list[$i]['id_phonecards_logos']; ?>,1);" /></td>
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
					$tags = $tags.'<option value="'.$tags_list[$i]['id_tag'].'">'.$tags_list[$i]['name'].'</option>';
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
						<td><img src="<?php echo $path; ?>img/ajax-loader.gif" /></td>
						<td><?php echo $this->lang->line('cargando_imagenes'); ?></td>
					</tr>
				</table>
			</div>
		</div>
		
	</form>
</div>
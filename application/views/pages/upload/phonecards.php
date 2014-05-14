<script>

	var file = -1;

	function send(){
		name = document.getElementById('name').value;
		serie = document.getElementById('serie').value;
		country = document.getElementById('country').value;
		
		companies = document.getElementById('companies').value;
		
		system = document.getElementById('system').value;
		
		date_year = parseInt(document.getElementById('date_year').value);
		date_month = parseInt(document.getElementById('date_month').value);
		date_day = parseInt(document.getElementById('date_day').value);
		
		date_year = (date_year < 2013 && date_year > 1000 );
		date_month = (date_month < 13 && date_month > 0 );
		date_day = (date_day < 32 && date_day > 0 );
		
		date = date_year && date_month && date_day;
		
		faceValue = document.getElementById('faceValue').value;
		currency = document.getElementById('currency').value;
		printRun = document.getElementById('printRun').value;
		
		//alert(currency);
		alert(name+' | '+serie+' | '+country+' | '+companies+' | '+system+' | '+date+' | '+faceValue+' | '+currency+' | '+printRun+' | '+file);
		
		if ( name.length != 0 && serie.length != 0 && country != -1 
		&& companies.length != 0 && system != -1 && date
		&& faceValue.length != 0 && currency != -1 && printRun.length != 0 && file != -1 ){
			
			//insertPhonecard( name , serie , companies , country , system , date , faceValue , currency , printRun );
			
			alert('done');
			//document.getElementById('#form0').submit();
			
		}
		
	}
	
	function setComp( dom ){
	
		index = dom.selectedIndex;
		id_c = dom.options[index].value;
		
		if ( id_c != -1 ){
			$('#s_curr').load(path+'ajax/upload/currenciesByCountry.php', {country:id_c});
			
			catalog_code = document.getElementById('catalog-code');
			
			$(catalog_code).load(path+'ajax/upload/catalogCodeByCountry.php',{country:id_c} , function(){
				
				if ( catalog_code.innerHTML.length > 0 ) 
					$("#catalog-tr").css({display:'table-row'});
				else
					$("#catalog-tr").css({display:'none'});
			});
			
			$('#system').prop('disabled',false);
			setSystemType( document.getElementById('system') );
		}
		else{
			document.getElementById('s_curr').innerHTML = '<select disabled="disabled" id="currency" name="currency"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
		}
		
	}
	
	function setSerie( dom ){
	
		index = dom.selectedIndex;
		id_c = dom.options[index].value;
		
		if ( id_c != -1 ){
			$('#s_ser').load('seriesByCompany.php', {company:id_c});
		}
		else{
			document.getElementById('s_ser').innerHTML = '<select disabled="disabled" id="serie" name="serie"><option selected="selected" value="-1">Seleccionar</option></select>';
		}
	
	}
	
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
	
	function setSystemType( dom ){
		
		index = dom.selectedIndex;
		index_c = document.getElementById('country').selectedIndex;
		
		
		id_s = parseInt(dom.options[index].value);
		id_c = parseInt(document.getElementById('country').options[index_c].value);
		
		switch ( id_s ){
			
			case 1:
				$("#variation1_list").load(path+'ajax/upload/typesBySystem.php',{system:id_s,country:id_c});
				$("#variation1").css({display:'table-row'});
				$("#variation2").css({display:'table-row'});
				$("#variation3_text").html('<?php echo $lang['variacion_descriptiva']; ?>:');				
				$("#variation3_info").html('<?php echo $lang['ayuda_variante_descriptiva']; ?>');
				break;
			case 2:
			case 4:
				$("#variation1 , #variation2").css({display:'none'});
				$("#variation3_text").html('<?php echo $lang['variacion_descriptiva']; ?>:');				
				$("#variation3_info").html('<?php echo $lang['ayuda_variante_descriptiva']; ?>');
				break;
				
			default:
				$("#variation1 , #variation2").css({display:'none'});
				break;
			
		}
		
	}
	
	function inputNumber( dom ){
	
		/*if ( event.keyCode != 8 && ( event.keyCode < 48 || event.keyCode > 57 ) ){
			dom.value = dom.value.substring(0,dom.value.length-2);
		}*/
		
		last = dom.value.substring(dom.value.length-1);
		
		num = parseInt(last);
		
		if ( num != 0 && !num ){
			dom.value = dom.value.substring(0,dom.value.length-1);
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
	
	function onlyNumbers(evt) {
	
	  var theEvent = evt || window.event;
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode( key );
	  var regex = /[0-9]|\./;
	  
	  if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	  }
	}
	
	function verifyDate( evt , dom , type ){
		var theEvent = evt || window.event;
		
		value = $(dom).val();
		var type_regex;
		
		switch( type ){
		
		case 'year':
			type_regex = /^(?:1|2)[\d]{0,3}$/;
			break;
		case 'month':
			type_regex = /^0[1-9]|1[012]|0|1$/;
			break;
		case 'day':
			type_regex = /^0?[1-9]$|^[12][0-9]$|^3[01]$/;
			break;
		}
		
		//alert(value+' => '+type_regex.test(value));
		
		if( !type_regex.test(value) ) {
			$(dom).val(value.substr(0,value.length-1));
		}
	}
	
	function nextIn( dom , num , code ){
		
		if ( code == 0 ){
			if ( dom.value.length >= num ){
				$("#date_month").focus();
			}
		}
		else{
			if ( dom.value.length >= num ){
				$("#date_day").focus();
			}
		}
		
	}
	
	function nextIn2( dom , num , code ){
		
		if ( code == 0 ){
			if ( dom.value.length >= num ){
				$("#date_ex_month").focus();
			}
		}
		else{
			if ( dom.value.length >= num ){
				$("#date_ex_day").focus();
			}
		}
		
	}
	
	function nextIn3( dom , num , code ){
		
		if ( code == 0 ){
			if ( dom.value.length >= num ){
				$("#date_known_month").focus();
			}
		}
		else{
			if ( dom.value.length >= num ){
				$("#date_known_day").focus();
			}
		}
		
	}
	
	function setTag( num ){
		
		sel = document.getElementById('tag'+num);
		
		if ( num > 0 ){
			
			sel = document.getElementById('tag'+num);
			sel1 = document.getElementById('tag'+(num-1));
			
			cond = false;
			
			for ( i = 0 ; i < num ; i++ ){
				cond = cond || ( sel.selectedIndex == document.getElementById('tag'+parseInt(i)).selectedIndex );
			}
			
			if ( cond ){
				sel.selectedIndex = 0;
				return;
			}
			
		}
		
		if ( num < 3 )
			$('#tag_tr'+(num+1)).css({display:''});
		
	}
	
	function modalPhonecard( param ){
	
		_p = $(document).getUrlParam(param);
		_p = parseInt(_p);
		
		if ( !_p )
			_p = param;
	
		$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,backs:'../'},function(){
			$("#modalP").click();
		});
	}
	
	function allowOne( id , dom ){
		
		bool = dom.checked;
		checks = document.getElementById(id).getElementsByTagName('input');
		
		for ( i=0 ; i<checks.length ; i++){
			checks[i].checked = false;
		}
		
		dom.checked = bool;
		
		if ( id == 'variation1_list' ){
			if ( bool )
				document.getElementById('var1').value = dom.value;
			else
				document.getElementById('var1').value = '';
		}
		else{
			if ( bool )
				document.getElementById('var2').value = dom.value;
			else
				document.getElementById('').value = '';
		}
		
		$("#"+id).css({display:'none'});
	
	}
	
	function sendForm( num ){
		var values = $("#form0").serialize();
		$.post(path+"index.php/upload/restriction", values, function(data) {
		text = '';
		
		if ( $("#name").val().length == 0 ){
			
			text+='-<?php echo $lang[nombre_no_valido]."</br>"; ?>';
		}
		if ( $("#companies").val().length == 0 ){
			text+='-<?php echo $lang[compania_no_valida]."</br>"; ?>';
		}
		if ( document.getElementById('country').selectedIndex == -1 || $("#country").val() == -1 ){
			text+='-<?php echo $lang[pais_no_valido]."</br>"; ?>';
		}
		if ( $("#currency").val() == -1 ){
			text+='-<?php echo $lang[moneda_no_valida]."</br>"; ?>';
		}
		if ( $("#system").val() == -1 ){
			text+='-<?php echo $lang[sistema_no_valido]."</br>"; ?>';
		}
		if ( $("#date_year").val().length == 0 && $("#date_ex_year").val().length == 0 && $("#date_known_year").val().length == 0 ){
			if ( $("#order_n").val().length == 0 ){
				text+='-<?php echo $lang[numero_de_pedido_o_fecha]."</br>"; ?>';
			}
		}
		text+=data;	
		
		if ( text.length == 0 ){
			if ( num == 1 ){
				$("#saveInfo").val('1');
			}else if(num == 2){
				$("#saveInfo").val('2');
			}
			
			$("#name,#country,#companies,#currency,#system,#serie,#serie_n,#serie2,#serie_n2,#printRun,#printRun2,#faceValue,#tag0,#tag1,#tag2,#tag3").prop('disabled', false);
			$("#date_year,#date_month,#date_day,#date_known_year,#date_known_month,#date_known_day,#date_ex_year,#date_ex_month,#date_ex_day,#order_n").prop('disabled',false);
			
			$("#uploading-images").css({ display: 'inherit' });
			$("#form0").submit();
		}
		else{
			showGlobalInfo(text);
		}
	},'json');
	}
	
	function onlyOneInput( dom , id ){
		
		if ( dom.value.length == 0 ){
			$(document.getElementById(id)).prop('disabled',false);
		}
	
		if ( dom.value.length > 0 ){
			dom2 = document.getElementById(id);
			dom2.value = '';
			$(dom2).prop('disabled',true);
		}
		
	}
	
	function onlyOneDate( dom , id ){
	
		if ( dom.value.length == 0 ){
			$("#"+id+"_day").prop('disabled',false);
			$("#"+id+"_month").prop('disabled',false);
			$("#"+id+"_year").prop('disabled',false);
			
			$("#order_n").prop('disabled',false);
		}
		
		if ( dom.value.length > 0 ){
			$("#"+id+"_year").prop('disabled',true);
			$("#"+id+"_month").prop('disabled',true);
			$("#"+id+"_day").prop('disabled',true);
			
			$("#order_n").val("");
			$("#order_n").prop('disabled',true);
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
					document.getElementById("warning-info").innerHTML = '<?php echo $lang['error_tarjeta_repetida']; ?><br /><br />';
					document.getElementById("warning-info").innerHTML+= '<span class="google-button" onclick="modalPhonecard(\'err\');" ><?php echo $lang['ver']; ?></span>';
					
					if ( img_status == -1 ){
						document.getElementById("warning-info").innerHTML+= "<br><?php echo $lang['error_tarjeta_sin_imagen']; ?><span class=\"google-button\" ><?php echo $lang['error_agregar_imagen']; ?></span>";
					}
					
				}
				else{
					document.getElementById("warning-info").innerHTML = '<?php echo $lang['error_cargando_tarjetas']; ?>';
				}	
			}
			else{
				if ( err == -1 ){
					document.getElementById("warning-info").innerHTML = '<?php echo $lang['error_imagenes']; ?>';
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
		setComp(c_input);
		
		
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
$countries = $_SESSION['countries'];
$tags_list = $_SESSION['tags'];
$logos_list = $_SESSION['logos'];

?>
<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<a id="modalF" style="display:none;" rel="leanModal" href="#modal-feedback">a</a>
<div id="modal-phonecard"></div>
<div id="modal-feedback"></div>

<div id="info-info" >
	- <?php echo $lang['rellena_los_campos_con_la_informacion']; ?>.
	<br />
    <br />
	- <?php echo $lang['si_algun_campo_no_existe']; ?>.
</div>

<div id="upload-error" style="display:none;">
	<div id="warning-in">
		<div class="title_warning">
			<img src="<?php echo $path; ?>img/alert.png" height="16" width="16" />
			<?php echo $lang['tu_tarjeta_telefonica']; ?> <span style="text-decoration:underline;"><?php echo $lang['no_pudo']; ?></span> <?php echo $lang['ser_cargada']; ?>
		</div>
	</div>
	<div id="warning-info">
		<?php echo $lang['diculpa_tuvimos_un_problema_cargando_tu']; ?> <b><?php echo $lang['tarjeta_telefonica']; ?></b>. <?php echo $lang['intentalo_mas_tarde']; ?>.
		<br />
		<br />
		<a href="#"> <?php echo $lang['contactanos']; ?></a>
	</div>
</div>

<div id="upload-done" style="display:none;">
	<div id="done-in">
		<div class="title_warning">
			<img src="<?php echo $path; ?>img/done.png" height="16" width="16" />
			<?php echo $lang['tu_tarjeta_ha_sido_cargada']; ?>!
		</div>
	</div>
	<div id="done-info">
		<span class="google-button" onclick="modalPhonecard('don');"><?php echo $lang['ver']; ?></span>
        &nbsp;&nbsp;&nbsp;
        <span class="google-button" onclick="setFormVisible();"><?php echo $lang['cargar_nueva_tarjeta_telefonica']; ?></span>
	</div>
</div>

<div id="upload-pc" class="box1">

	<form id="form0" action="<?php echo $path; ?>index.php/upload/upload_go" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
        <div id="upload-title">
            <span><?php echo $lang['cargar_tarjeta_telefonica']; ?></span>
            <img id="upload-help" src="<?php echo $path; ?>img/help2.png" height="20" width="20" onmouseover="showInfo( this , '<?php echo $lang['antes_de_cargar_una_tarjeta_telefonica']; ?>.' )">
            <input type="reset" value="<?php echo $lang['restablecer']; ?>" id="upload-colab" class="google-button" >
        </div>
        <div id="upload-required">
            * &mdash; <?php echo $lang['campos_obligatorios']; ?>
        </div>	
		<table cellspacing="5px">
			<tr>
				<td><span class="obb">* </span><?php echo $lang['pais']; ?>: </td>
				<td>
					<select id="country" name="country" onChange="setComp(this);">
						<option selected="selected" value="-1" ><?php echo $lang['seleccione']; ?></option>
						<?php
							for ($i=0 ; $i < count($countries) ; $i++){
								echo '<option value="'.$countries[$i]['id_countries'].'" >'.$countries[$i]['name'].'</option>';
							}
						?>							
					</select>
				</td>
				<td><a href="javascript:modalFeedbackCountry()"><?php echo $lang['tu_pais_no_aparece']; ?></a></td>
			</tr>
			<tr>
				<td><span class="obb">* </span><?php echo $lang['moneda']; ?>: </td>
				<td id="s_curr">
					<select disabled="disabled" id="currency" name="currency">
						<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackCurrency()"><?php echo $lang['tu_moneda_no_aparece']; ?></a></td>
			</tr>
			<tr>
				<td><span class="obb">* </span><?php echo $lang['compania']; ?>: </td>
				<td id="s_comp">
					<input type="text" id="companies" name="companies" class="upload-input">
				</td>
				<td class="reg_info"><?php echo $lang['compania_emisora_tarjeta']; ?> <?php echo $lang['se_recomienda_el_autocompletar']; ?></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span onmouseover="showInfo( this , '<?php echo $lang['ayuda_tarjetas_uso_interno']; ?>' )" style="font-size:14px; cursor:default;">
						<input type="checkbox" name="not_emmited" id="not_emmited" onclick="catalog_allow_one(this);" />
						<span><?php echo $lang['tarjetas_compania_uso_interno']; ?></span>
					</span>
				</td>
				<td class="reg_info"><?php echo $lang['pruebas_demostraciones_licitaciones']; ?></td>
			</tr>                 

			<tr id="system_tr">
				<td><span class="obb">* </span><?php echo $lang['sistema']; ?>: </td>
				<td>
					<select disabled="disabled" id="system" name="system" style="width:150px;" onchange="setSystemType(this);"  >
						<option selected="selected" value="-1" ><?php echo $lang['seleccione']; ?></option>
						<option value="1" ><?php echo $lang['chip']; ?></option>
						<option value="2" ><?php echo $lang['banda_magnetica']; ?></option>
						<option value="3" ><?php echo $lang['sistema_optico']; ?></option>
						<option value="4" ><?php echo $lang['memoria_remota']; ?></option>
						<option value="5" ><?php echo $lang['sistema_inducido']; ?></option>		
					</select>
				</td>
				<td><a href="javascript:modalFeedbackSystem()"><?php echo $lang['tu_sistema_no_aparece']; ?></a></td>
			</tr>
			<tr>
				<td><span class="obb">* </span><?php echo $lang['nombre']; ?>: </td>
				<td><input type="text" id="name" name="name" class="upload-input"></td>
				<td class="reg_info"><?php echo $lang['nombre_tarjeta_telefonica']; ?></td>
			</tr>
			<tr id="catalog-tr" style="display:none">
				<td><?php echo $lang['catalogo_referencia']; ?>: </td>
				<td>
					<span id="catalog-code"></span>
					<input type="text" id="reference" name="reference" class="catalog-input" />
				</td>
				<td><a href="javascript:modalFeedbackReferenceCatalog()"><?php echo $lang['problemas_catalogo_referencia']; ?></a></td>
			</tr>
			<tr>
				<td><?php echo $lang['serie_1']; ?>: </td>
				<td id="s_ser">
					<div class="reg_info">
						<span><?php echo $lang['nombre']; ?></span>
						<span style="float:right; margin-right:5px;"><?php echo $lang['numero']; ?></span>
					</div>
					<input type="text" id="serie" name="serie" value="" class="upload-input2" onkeyup="onlyOneInput(this,'serie2');onlyOneInput(this,'serie_n2');">
					<input type="text" id="serie_n" name="serie_n" class="upload-num" onkeyup="onlyOneInput(this,'serie_n2');onlyOneInput(this,'serie2');" >
				</td>
				<td class="reg_info"><?php echo $lang['impreso_en_tarjeta_telefonica']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
			<tr>
				<td>Serie 2: </td>
				<td id="s_ser2">
					<div class="reg_info">
						<span><?php echo $lang['nombre']; ?></span>
						<span style="float:right; margin-right:5px;"><?php echo $lang['numero']; ?></span>
					</div>
					<input type="text" id="serie2" name="serie2" value="" class="upload-input2" onkeyup="onlyOneInput(this,'serie');onlyOneInput(this,'serie_n');" >
					<input type="text" id="serie_n2" name="serie_n2" class="upload-num" onkeyup="onlyOneInput(this,'serie_n');onlyOneInput(this,'serie');" >
				</td>
				<td class="reg_info"><?php echo $lang['no_impreso_en_tarjeta_telefonica']; ?><br /><?php echo $lang['conocimiento_general']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['tiraje_1']; ?>: </td>
				<td><input type="text" id="printRun" name="printRun" onkeypress="onlyNumbers(event);onlyOneInput(this,'printRun2');" class="upload-input" ></td>
				<td class="reg_info"><?php echo $lang['ejemplo_20000']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['tiraje_2']; ?>: </td>
				<td><input type="text" id="printRun2" name="printRun2" onkeypress="onlyNumbers(event);onlyOneInput(this,'printRun');" class="upload-input" ></td>
				<td class="reg_info"><?php echo $lang['no_impreso_en_tarjeta_telefonica']; ?><br /><?php echo $lang['valor_aproximado_conocido']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['emitida']; ?>: </td>
				<td id="upload-date">
					<div>&nbsp;&nbsp;&nbsp;<?php echo $lang['ano']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['mes']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['dia']; ?></div>
					<div>
						<input type="text" id="date_year" name="date_year" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn(this,4,0);onlyOneDate(this,'date_known');" onkeypress="onlyNumbers(event)" maxlength="4">
						/
						<input type="text" id="date_month" name="date_month" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2">
						/
						<input type="text" id="date_day" name="date_day" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' );"  maxlength="2">
					</div>
				</td>
				<td class="reg_info"><?php echo $lang['impreso_en_tarjeta_telefonica']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['fecha_vencimiento']; ?>: </td>
				<td id="upload-date_ex">
					<div>
						<input type="text" id="date_ex_year" name="date_ex_year" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn2(this,4,0);" onkeypress="onlyNumbers(event)"  maxlength="4">
						/
						<input type="text" id="date_ex_month" name="date_ex_month" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn2(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2">
						/
						<input type="text" id="date_ex_day" name="date_ex_day" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' )"  maxlength="2">
					</div>
				</td>
				<td class="reg_info"><?php echo $lang['no_impreso_en_tarjeta_telefonica']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['fecha_conocida']; ?>: </td>
				<td id="upload-date_kwown">
					<div>
						<input type="text" id="date_known_year" name="date_known_year" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn3(this,4,0);onlyOneDate(this,'date');" onkeypress="onlyNumbers(event)"  maxlength="4">
						/
						<input type="text" id="date_known_month" name="date_known_month" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn3(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2">
						/
						<input type="text" id="date_known_day" name="date_known_day" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' )"  maxlength="2">
					</div>
				</td>
				<td class="reg_info"><?php echo $lang['fecha_conocida_no_impresa']; ?></td>
			</tr>
			<tr>
				<td onmouseover="showInfo(this,'Manual sort field, only in the absence of dates')"><?php echo $lang['numero_de_orden']; ?>: </td>
				<td><input type="text" id="order_n" name="order_n" class="upload-num" onkeypress="onlyNumbers(event)"  /></td>
				<td class="reg_info"><?php echo $lang['numero_de_orden_explicacion']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['valor_nominal']; ?>: </td>
				<td><input type="text" id="faceValue" name="faceValue" onkeypress="onlyNumbers(event)"  class="upload-input"></td>
				<td class="reg_info"><?php echo $lang['ejemplo_20000']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['imagen_anverso']; ?>: </td>
				<td id="i_img">
					<input type="file" style="display:none;" id="i_file" name="i_file" accept="image/*" onchange="img_loaded(0);" />
					<input class="google-button" type="button" value="<?php echo $lang['examinar']; ?>" onclick="document.getElementById('i_file').click();" />
					<span id="upload-img-info"></span>
				</td>
				<td id="i_info" class="reg_info"><?php echo $lang['por_lo_menos_600_300']; ?></td>
			</tr>
			<tr>
				<td><?php echo $lang['imagen_reverso']; ?>: </td>
				<td id="i_img_r">
					<input type="file" style="display:none;" id="i_file_r" name="i_file_r" accept="image/*" onchange="img_loaded(1);" />
					<input class="google-button" type="button" value="<?php echo $lang['examinar']; ?>" onclick="document.getElementById('i_file_r').click();" />
					<span id="upload-img-info-r"></span>
				</td>
				<td id="i_info-r" class="reg_info"><?php echo $lang['por_lo_menos_600_300']; ?></td>
			</tr>
			<?php
				$tags = '';
				
				for ( $i = 0 ; $i < count($tags_list) ; $i++ ){
					$tags = $tags.'<option>'.$tags_list[$i]['name'].'</option>';
				}
			?>
			<tr>
				<td><?php echo $lang['tematica']; ?>: </td>
				<td>
					<select id="tag0" name="tag0" onchange="setTag(0);" >
						<option value="-1" ><?php echo $lang['seleccione']; ?></option>
						<?php echo $tags; ?>
					</select>
				</td>
				<td class="reg_info"><?php echo $lang['opcional']; ?></td>
			</tr>
			<tr id="tag_tr1" style="display:none;">
				<td></td>
				<td>
					<select id="tag1" name="tag1" onchange="setTag(1);" >
						<option value="-1" ><?php echo $lang['seleccione']; ?></option>
						<?php echo $tags; ?>
					</select>
				</td>
			</tr>
			<tr id="tag_tr2" style="display:none;">
				<td></td>
				<td>
					<select id="tag2" name="tag2" onchange="setTag(2);" >
						<option value="-1" ><?php echo $lang['seleccione']; ?></option>
						<?php echo $tags; ?>
					</select>
				</td>
			</tr>
			<tr id="tag_tr3" style="display:none;">
				<td></td>
				<td>
					<select id="tag3" name="tag3" onchange="setTag(3);" >
						<option value="-1" ><?php echo $lang['seleccione']; ?></option>
						<?php echo $tags; ?>
					</select>
				</td>
			</tr>
			<tr id="variation1" style="display:none;">
				<td><?php echo $lang['variante_1_chip']; ?>: </td>
				<td>
					<span class="google-button" onclick="showSystemTypes();">
						<?php echo $lang['seleccione']; ?>
						<img style="position:relative; top:4px; left:4px;" src="<?php echo $path; ?>img/arrow-down.png" width="16" height="16"/>
					</span>
					<div id="variation1_list" style="display:none;">
						
					</div>
				</td>
				<td>
					<a href="javascript:modalFeedbackSystemType()"><?php echo $lang['tu_chip_no_aparece']; ?></a>
				</td>
			</tr>
			<tr id="variation2" style="display:none;">
				<td><?php echo $lang['variante_2_logo']; ?>: </td>
				<td>
					<span class="google-button" onclick="showLogoTypes();">
						<?php echo $lang['seleccione']; ?>
						<img style="position:relative; top:4px; left:4px;" src="<?php echo $path; ?>img/arrow-down.png" width="16" height="16"/>
					</span>
					<div id="variation2_list" style="display:none">
						<table id="variation2_table" style="margin:0;">
						
							<?php
														
							for ($i=0 ; $i < count($logos_list) ; $i++){
								?>
								
								<tr <?php echo $i % 2 == 0 ? '':'class="odd"'; ?> >
									<td><input onchange="allowOne('variation2_list',this);"  type="checkbox" value="<?php echo $logos_list[$i]['id_phonecards_logo']; ?>" name="variation2_<?php echo $i; ?>" /></td>
									<td><?php echo $logos_list[$i]['name']; ?></td>
									<td><img class="variation_table_images" src="<?php echo $path; ?>upload/logo/<?php echo $logos_list[$i]['id_phonecards_logo']; ?>.jpg" onmouseover="showInfo3(this,1,<?php echo $logos_list[$i]['id_phonecards_logo']; ?>,1);" /></td>
								</tr>
								<?php
							}
								?>
							
							<input type="hidden" value="" id="var2" name="var2" />
							
						</table>
					</div>
				</td>
				<td><a href="javascript:modalFeedbackLogo()"><?php echo $lang['tu_logo_no_aparece']; ?></a></td>
			</tr>
			<tr id="variation3">
				<td id="variation3_text"><?php echo $lang['variacion_descriptiva']; ?>:</td>
				<td>
					<textarea class="input1" name="var3" style="height:100px;" ></textarea>
				</td>
				<td id="variation3_info" class="reg_info"><?php echo $lang['ayuda_variante_descriptiva']; ?></td>
			</tr>
			
            <tr>
				<td><?php echo $lang['precio_estimado_dol']; ?>: </td>
				<td>
                	<table>
                    	<tr>
                        	<td>
                            	<div>&nbsp;&nbsp;&nbsp;N
                                <div>
                                    <input type="text" id="ep_n" name="ep_n" class="upload-date1"  onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;UN
                                <div>
                                    <input type="text" id="ep_uf" name="ep_uf" class="upload-date1" onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;UG 
                                <div>
                                    <input type="text" id="ep_ug" name="ep_ug" class="upload-date1"  onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;UD
                                <div>
                                    <input type="text" id="ep_ud" name="ep_ud" class="upload-date1"  onkeypress="onlyNumbers(event)"  maxlength="4" autocomplete="off"> 
                                </div> 
                            </td>
                        </tr>
                    </table> 
				</td>
				<td class="reg_info"></td>
			</tr> 			
		</table>
		
		<div style="margin-top:10px; margin-bottom:10px; margin-left:15px;">
			<input type="hidden" id="saveInfo" name="saveInfo" value="" />
			<span onclick="sendForm();" class="google-button google-button-blue"><?php echo $lang['cargar']; ?></span>
			<span onclick="sendForm(2);" class="google-button google-button-red" onmouseover="showInfo( this , '<?php echo $lang['opcion_para_cargar_variante']; ?>' )" ><?php echo $lang['cargar_y_salvar_informacion']; ?></span>
			<div id="uploading-images" >
				<table>
					<tr>
						<td><img src="<?php echo $path; ?>img/ajax-loader.gif" /></td>
						<td><?php echo $lang['cargando_imagenes']; ?></td>
					</tr>
				</table>
			</div>
		</div>
		
	</form>
</div>
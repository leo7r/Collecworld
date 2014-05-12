<?php
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
}
?>

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
	
	function setTitle( dom ){
	
		index = dom.selectedIndex;
		id_c = dom.options[index].value;
		
		if ( id_c != -1 ){
			$('#s_title').load(path+'ajax/upload/banknotes/titleByCountry.php', {country:id_c});
			
			$('#s_mint_house').load(path+'ajax/upload/banknotes/mintHouseByCountry.php', {country:id_c});
			
			catalog_code = document.getElementById('catalog-code');
			
			$(catalog_code).load(path+'ajax/upload/banknotes/catalogCodeByCountry.php',{country:id_c} , function(){
				
				if ( catalog_code.innerHTML.length > 0 ) 
					$("#catalog-tr").css({display:'table-row'});
				else
					$("#catalog-tr").css({display:'none'});
			});
			 		 
		}
		else{
			document.getElementById('s_title').innerHTML = '<select disabled="disabled" id="title" name="title"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
		}
		
	}
	
	function setSubtitle( dom ){
	
		index = dom.selectedIndex;
		id_t = dom.options[index].value;
		
		if ( id_t != -1 ){
			$('#s_subtitle').load(path+'ajax/upload/banknotes/subtitleByTitle.php', {title:id_t});
		}
		else{
			document.getElementById('s_subtitle').innerHTML = '<select disabled="disabled" id="subtitle" name="subtitle"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
		}
	
	}
	
	function setDenomination( dom ){
	
		index = dom.selectedIndex;
		id_s = dom.options[index].value;
		
		if ( id_s != -1 ){
			$('#s_denomination').load(path+'ajax/upload/banknotes/denominationBySubtitle.php', {subtitle:id_s});
		}
		else{
			document.getElementById('s_denomination').innerHTML = '<select disabled="disabled" id="denomination" name="denomination"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
		}
	
	}
	
	function setValue( dom ){
	
		index = dom.selectedIndex;
		id_d = dom.options[index].value;
		
		if ( id_d != -1 ){
			$('#s_value').load(path+'ajax/upload/banknotes/valueByDenomination.php', {denomination:id_d});
		}
		else{
			document.getElementById('s_value').innerHTML = '<select disabled="disabled" id="value" name="value"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
		}
	
	}
		
	function setSize( dom ){
		index = dom.selectedIndex;
		id_shape = dom.options[index].value;
		
		var id_shape = parseInt(id_shape);
		
		switch(id_shape){
			
			case 1 : 
				document.getElementById('size_d').style.display='table-row';
				document.getElementById('size_h').style.display='none';
				document.getElementById('size_w').style.display='none';
			break;
			
			case 2:
				document.getElementById('size_d').style.display='none';
				document.getElementById('size_h').style.display='table-row';
				document.getElementById('size_w').style.display='table-row';
			break;
				
			
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
	
	function modalBanknote( param ){
	
		_p = $(document).getUrlParam(param);
		_p = parseInt(_p);
		
		if ( !_p )
			_p = param; 
	
		$("#modal-banknote").load(path+'ajax/showBanknote.php',{p:_p,backs:'../'},function(){
			$("#modalB").click();
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
		
		text = '';
		 
		if ( document.getElementById('country').selectedIndex == -1 || $("#country").val() == -1 ){
			text+='-<?php echo $lang[pais_no_valido]."</br>"; ?>';
		}
		if ( $("#title").val() == -1 ){
			text+='-<?php echo $lang[titulo_no_valido]."</br>"; ?>';
		}
		if ( $("#value").val() == -1 ){
			text+='-<?php echo $lang[valor_no_valido]."</br>"; ?>';
		}
		if ( $("#subtitle").val() == -1 ){
			text+='-<?php echo $lang[subtitulo_no_valido]."</br>"; ?>';
		} 
		
		if ( text.length == 0 ){
			if ( num == 1 ){
				$("#saveInfo").val('1');
			}
			
			$("#country,#title,#value,#subtitle,#date_year,#printRun,#signature1,#signature2,#signature3,#size,#size2").prop('disabled', false); 
			
			$("#uploading-images").css({ display: 'inherit' });
			$("#form0").submit();
		}
		else{
			showGlobalInfo(text);
		}
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
		
		//$('#upload-pc').shadow({type:'sides', sides:'hz-2'});
		
		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});
		
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
		
		if ( saveInfo ){
			$("#country,#title,#value,#subtitle,#serie_n,#serie2,#serie_n2,#printRun,#printRun2,#faceValue,#tag0,#tag1,#tag2,#tag3,#order_n").prop('disabled', true);
			$("#date_year,#date_month,#date_day,#date_known_year,#date_known_month,#date_known_day,#date_ex_year,#date_ex_month,#date_ex_day").prop('disabled',true);
			showSystemTypes();
			showLogoTypes();
		}
		
		$( "#designer" ).autocomplete({
            source: path+'ajax/upload/autocomplete.php?table=coins_designer'
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
$shapes = $_SESSION['shapes'];
$edges = $_SESSION['edges'];
$designer = $_SESSION['designer'];
$countries = $_SESSION['countries']; 

?>
<a id="modalB" style="display:none;" rel="leanModal" href="#modal-banknote">a</a>
<a id="modalF" style="display:none;" rel="leanModal" href="#modal-feedback">a</a>
<div id="modal-banknote"></div>
<div id="modal-feedback"></div>

<div id="info-info" >
	- <?php echo $lang['rellena_los_campos_con_la_informacion_billete']; ?>.
	<br />
    <br />
	- <?php echo $lang['si_algun_campo_no_existe']; ?>.
</div>

<div id="upload-error" style="display:none;">
	<div id="warning-in">
		<div class="title_warning">
			<img src="<?php echo $path; ?>img/alert.png" height="16" width="16" />
			<?php echo $lang['tu_billete']; ?> <span style="text-decoration:underline;"><?php echo $lang['no_pudo']; ?></span> <?php echo $lang['ser_cargada']; ?>
		</div>
	</div>
	<div id="warning-info">
		<?php echo $lang['diculpa_tuvimos_un_problema_cargando_tu']; ?> <b><?php echo $lang['moneda']; ?></b>. <?php echo $lang['intentalo_mas_tarde']; ?>.
		<br />
		<br />
		<a href="#"> <?php echo $lang['contactanos']; ?></a>
	</div>
</div>

<div id="upload-done" style="display:none;">
	<div id="done-in">
		<div class="title_warning">
			<img src="<?php echo $path; ?>img/done.png" height="16" width="16" />
			<?php echo $lang['tu_billete_ha_sido_cargado']; ?>!
		</div>
	</div>
	<div id="done-info">
		<span class="google-button" onclick="modalBanknote('don');"><?php echo $lang['ver']; ?></span>
        &nbsp;&nbsp;&nbsp;
        <span class="google-button" onclick="setFormVisible();"><?php echo $lang['cargar_nuevo_billete']; ?></span>
	</div>
</div>

<div id="upload-pc" class="box1">
	<form id="form0" action="<?php echo $path; ?>index.php/upload/upload_banknote_go" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	<div id="upload-title">
		<span><?php echo $lang['cargar_billete']; ?></span>
		<img id="upload-help" src="<?php echo $path; ?>img/help2.png" height="20" width="20" onmouseover="showInfo( this , '<?php echo $lang['antes_de_cargar_un_billete']; ?>.' )">
		<input type="reset" id="upload-colab" class="google-button" value="<?php echo $lang['restablecer']; ?>"> 
	</div>
	<div id="upload-required">
		* &mdash; <?php echo $lang['campos_obligatorios']; ?>
	</div>
		
		<table cellspacing="5px">
			<tr>
				<td><span class="obb">* </span><?php echo $lang['pais']; ?>: </td>
				<td>
					<select id="country" name="country" onChange="setTitle(this);">
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
            <tr id="catalog-tr" style="display:none">
				<td><?php echo $lang['catalogo_referencia']; ?>: </td>
				<td>
					<span id="catalog-code"></span>
					<input type="text" id="reference" name="reference" class="catalog-input" />
				</td>
				<td><a href="javascript:modalFeedbackReferenceCatalog()"><?php echo $lang['problemas_catalogo_referencia']; ?></a></td>
			</tr>
			<tr>
				<td><span class="obb">* </span><?php echo $lang['titulo']; ?>: </td>
				<td id="s_title">
					<select disabled="disabled" id="title" name="title">
						<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackTitle()"><?php echo $lang['tu_titulo_no_aparece']; ?></a></td>
			</tr>
            <tr>
				<td><span class="obb">* </span><?php echo $lang['subtitulo']; ?>: </td>
				<td id="s_subtitle">
					<select disabled="disabled" id="subtitle" name="subtitle">
						<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackSubtitle('banknotes')"><?php echo  $lang['tu_subtitulo_no_aparece']; ?></a></td>
			</tr>
            <tr>
				<td><span class="obb">* </span><?php echo $lang['denominacion']; ?>: </td>
				<td id="s_denomination">
					<select disabled="disabled" id="denomination" name="denomination">
						<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackValue()"><?php echo $lang['tu_valor_no_aparece']; ?></a></td>
			</tr>
            <tr>
				<td><span class="obb">* </span><?php echo $lang['valor']; ?>: </td>
				<td id="s_value">
					<select disabled="disabled" id="value" name="value">
						<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackValue('banknotes')"><?php echo $lang['tu_valor_no_aparece']; ?></a></td>
			</tr>
            <tr>
				<td><span class="obb">* </span><?php echo $lang['circulacion']; ?>: </td>
				<td id="s_value">
					<select id="circulation" name="circulation">
						<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
						<option value="1"><?php echo $lang['circulacion_normal']; ?></option>
						<option value="2"><?php echo $lang['conmemorativas_numismaticas']; ?></option>
						<option value="3"><?php echo $lang['ensayos_pruebas_otras']; ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackValue()"><?php echo $lang['tu_valor_no_aparece']; ?></a></td>
			</tr>
            <tr>
				<td><?php echo $lang['emitida_greg']; ?>: </td>
				<td id="upload-date">
					<div>&nbsp;&nbsp;&nbsp;<?php echo $lang['ano']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['mes']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['dia']; ?></div>
					<div>
						<input type="text" id="date_year_greg" name="date_year_greg" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn(this,4,0);onlyOneDate(this,'date_known');" onkeypress="onlyNumbers(event)" maxlength="4">
						/
						<input type="text" id="date_month_greg" name="date_month_greg" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2">
						/
						<input type="text" id="date_day_greg" name="date_day_greg" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' );"  maxlength="2">
					</div>
				</td>
				<td class="reg_info"><?php echo $lang['impreso_en_tarjeta_telefonica']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
            <tr>
				<td><?php echo $lang['emitida_isla']; ?>: </td>
				<td id="upload-date">
					<div>&nbsp;&nbsp;&nbsp;<?php echo $lang['ano']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['mes']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['dia']; ?></div>
					<div>
						<input type="text" id="date_year_isla" name="date_year_isla" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );nextIn(this,4,0);onlyOneDate(this,'date_known');" onkeypress="onlyNumbers(event)" maxlength="4">
						/
						<input type="text" id="date_month_isla" name="date_month_isla" class="upload-date0" onkeyup="verifyDate( event , this , 'month' );nextIn(this,2,1);" onkeypress="onlyNumbers(event)"  maxlength="2">
						/
						<input type="text" id="date_day_isla" name="date_day_isla" class="upload-date0" onkeypress="onlyNumbers(event)" onKeyUp="verifyDate( event , this , 'day' );"  maxlength="2">
					</div>
				</td>
				<td class="reg_info"><?php echo $lang['impreso_en_tarjeta_telefonica']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
            <tr>
				<td><?php echo $lang['casa_moneda']; ?>: </td>
				<td id="s_mint_house">
					<select disabled="disabled" id="mint_house" name="mint_house">
						<option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackMintHouse()"><?php echo $lang['tu_casa_moneda_no_aparece']; ?></a></td>
			</tr>
            <tr>
				<td><?php echo $lang['tiraje']; ?>: </td>
				<td><input type="text" id="printRun" name="printRun" onkeypress="onlyNumbers(event);" class="upload-input" ></td>
				<td class="reg_info"><?php echo $lang['ejemplo_20000']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
            
            <tr>
				<td><?php echo $lang['numero_serie']; ?>: </td>
				<td id="upload-date">
					<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['serie']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang['numero_digitos']; ?></div>
					<div>
						<input type="text" id="num_serie" name="num_serie" class="upload-date1" style="width:50px;"maxlength="4">
						
						<input type="text" id="digit_serie" name="digit_serie" class="upload-date1" style="width:70px;"maxlength="9"> 
                        
					</div>
				</td>
				<td class="reg_info"><?php echo $lang['impreso_en_tarjeta_telefonica']; ?><br /><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>
              
			<tr id="signature1">
				<td><?php echo $lang['firma']; ?> 1:</td>
				<td>
					<input type="text" id="signature1" name="signature1" class="upload-input"  />
				</td>
                <td class="reg_info"><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>	
            
            <tr id="signature2">
				<td><?php echo $lang['firma']; ?> 2:</td>
				<td>
					<input type="text" id="signature2" name="signature2" class="upload-input"  />
				</td>
                <td class="reg_info"><?php echo $lang['deje_en_blanco']; ?></td>
			</tr>	
            
            <tr id="signature3">
				<td><?php echo $lang['firma']; ?> 3:</td>
				<td>
					<input type="text" id="signature3" name="signature3" class="upload-input"  />
				</td>
                <td class="reg_info"><?php echo $lang['deje_en_blanco']; ?></td>
  			</tr>	
            
			<tr id="size_h">
				<td><?php echo $lang['tamano']; ?> (<?php echo $lang['altura']; ?>):</td>
				<td>
					<input type="text" id="size" name="size" class="upload-num" onkeypress="onlyNumbers(event)" />
					<?php echo $lang['milimetro']; ?>
				</td>
			</tr>
			<tr id="size_w">
				<td><?php echo $lang['tamano']; ?> (<?php echo $lang['ancho']; ?>):</td>
				<td>
					<input type="text" id="size2" name="size2" class="upload-num" onkeypress="onlyNumbers(event)" />
					<?php echo $lang['milimetro']; ?>
				</td>
			</tr>
            <tr>
				<td><?php echo $lang['modelo']; ?>:</td>
				<td>
					<input type="text" id="model" name="model" class="upload-num"  />
				</td>
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
			<tr id="variation3">
				<td id="variation3_text"><?php echo $lang['variacion_descriptiva']; ?>:</td>
				<td>
					<textarea class="input1" name="descriptive_variation" style="height:100px;" ></textarea>
				</td>
				<td id="variation3_info" class="reg_info"><?php echo $lang['ayuda_variante_descriptiva']; ?></td>
			</tr> 
            <tr>
				<td><?php echo $lang['precio_estimado_dol']; ?>: </td>
				<td>
                	<table>
                    	<tr>
                        	<td>
                            	<div>&nbsp;&nbsp;&nbsp;G
                                <div>
                                    <input type="text" id="ep_g" name="ep_g" class="upload-date1"  onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;F
                                <div>
                                    <input type="text" id="ep_f" name="ep_f" class="upload-date1" onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;VF 
                                <div>
                                    <input type="text" id="ep_vf" name="ep_vf" class="upload-date1"  onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;UNC
                                <div>
                                    <input type="text" id="ep_unc" name="ep_unc" class="upload-date1"  onkeypress="onlyNumbers(event)"  maxlength="4" autocomplete="off"> 
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
			<span onclick="sendForm(1);" class="google-button google-button-red" onmouseover="showInfo( this , '<?php echo $lang['opcion_para_cargar_variante']; ?>' )" ><?php echo $lang['cargar_y_salvar_informacion']; ?></span>
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
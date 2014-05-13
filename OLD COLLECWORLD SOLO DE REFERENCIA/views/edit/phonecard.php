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

			//$('#s_comp').load('companiesByCountry.php', {country:id_c});

			$('#s_curr').load(path+'ajax/upload/currenciesByCountry.php', {country:id_c});

			

			catalog_code = document.getElementById('catalog-code');

			

			$(catalog_code).load(path+'ajax/upload/catalogCodeByCountry.php',{country:id_c} , function(){

				

				if ( catalog_code.innerHTML.length > 0 ) 

					$("#catalog-tr").css({display:'table-row'});

				else

					$("#catalog-tr").css({display:'none'});

			});

			

			//document.getElementById('s_ser').innerHTML = '<select disabled="disabled" id="serie" name="serie"><option selected="selected" value="-1">Seleccionar</option></select>';

		}

		else{

			//document.getElementById('s_comp').innerHTML = '<select disabled="disabled" id="companies" name="companies"><option selected="selected" value="-1">Seleccionar</option></select>';

			document.getElementById('s_curr').innerHTML = '<select disabled="disabled" id="currency" name="currency"><option selected="selected" value="-1">Seleccionar</option></select>';

			//document.getElementById('s_ser').innerHTML = '<select disabled="disabled" id="serie" name="serie"><option selected="selected" value="-1">Seleccionar</option></select>';

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

	

	

	function chg_img( num ){

		

		dom = document.getElementById('i_img');

		

		if ( num == -1 ){

			dom.innerHTML = '<input type="radio" onchange="chg_img(0);" /><span>Url</span><br /><input type="radio" onchange="chg_img(1);" /><span>File</span>';

			document.getElementById('i_info').innerHTML = '300x200 px';

			return;

		}

		

		if ( num == 0 ){

			

			dom.innerHTML = '<input type="text" id="i_url" name="i_url" class="upload-input" />';

			document.getElementById('i_info').innerHTML = '<a href="javascript:chg_img(-1);">Cancel</a>';

			file = 0;

			

		}

		else{

			file = 1;

			dom.innerHTML = '<input type="file" style="display:none;" id="i_file" name="i_file" accept="image/*" onchange="img_loaded(0);" /><input class="google-button" type="button" value="Seleccionar Imagen" onclick="document.getElementById(\'i_file\').click();" /><span id="upload-img-info"></span>';

			document.getElementById('i_info').innerHTML = '<a href="javascript:chg_img(-1);">Cancel</a>';

		

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

	

	function chg_img_r( num ){

		

		dom = document.getElementById('i_img_r');

		

		if ( num == -1 ){

			dom.innerHTML = '<input type="radio" onchange="chg_img_r(0);" /><span>Url</span><br /><input type="radio" onchange="chg_img_r(1);" /><span>File</span>';

			document.getElementById('i_info-r').innerHTML = 'Optional';

			return;

		}

		

		if ( num == 0 ){

			

			dom.innerHTML = '<input type="text" id="i_url_r" name="i_url_r" class="upload-input" />';

			document.getElementById('i_info-r').innerHTML = '<a href="javascript:chg_img_r(-1);">Cancel</a>';

			file = 0;

			

		}

		else{

			file = 1;

			dom.innerHTML = '<input type="file" style="display:none;" id="i_file_r" name="i_file_r" accept="image/*" onchange="img_loaded(1);" /><input class="google-button" type="button" value="Seleccionar Imagen" onclick="document.getElementById(\'i_file_r\').click();" /><span id="upload-img-info-r"></span>';

			document.getElementById('i_info-r').innerHTML = '<a href="javascript:chg_img_r(-1);">Cancel</a>';

		}

	

	}

	

	function setSystemType( dom , syst ){

		index = dom.selectedIndex;

		index_c = document.getElementById('country').selectedIndex;

		

		id_s = parseInt(dom.options[index].value)

		id_c = parseInt(document.getElementById('country').options[index_c].value);

		

		switch ( id_s ){

			

			case 1:

				$("#variation1_list").load(path+'ajax/edit/typesBySystem.php',{system:id_s,syst:syst,country:id_c});

				$("#variation1").css({display:'table-row'});

				$("#variation2").css({display:'table-row'});

				$("#variation3_text").html('Descriptive Variation:');				

				$("#variation3_info").html('Explain your Variation');

				break;				

			default:

				$("#variation1 , #variation2").css({display:'none'});

				$("#variation3_text").html('Descriptive Variation:');				

				$("#variation3_info").html('Explain your Variation');

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

	

	function modalPhonecard( _p ){

	

		$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,path:path},function(){

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

				document.getElementById('var2').value = '';

		}

		

		$("#"+id).css({display:'none'});

	}

	

	function sendForm( num ){

		

		text = '';

		

		if ( $("#name").val().length == 0 ){

			

			text+='-Name is not valid\n';

		}

		if ( $("#companies").val().length == 0 ){

			text+='-Company id not valid\n';

		}

		if ( document.getElementById('country').selectedIndex == -1 || $("#country").val() == -1 ){

			text+='-Country is not valid\n';

		}

		if ( $("#currency").val() == -1 ){

			text+='-Currency is not valid\n';

		}

		if ( $("#system").val() == -1 ){

			text+='-System is not valid\n';

		}

		

		

		if ( text.length == 0 ){

			if ( num == 1 ){

				$("#saveInfo").val('1');

			}

			

			$("#name,#country,#currency,#companies,#system,#serie,#serie_n").prop('disabled', false);

			

			$("#uploading-images").css({ display: 'inherit' });

			$("#form0").submit();

		}

		else{

			alert(text);

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

	

	function hideSystem( dom ){

	

		if ( dom.checked ){

			$("#system_tr").css({display:'none'});

			document.getElementById('system').selectedIndex = 1;

		}

		else{

			$("#system_tr").css({display:'table-row'});

			document.getElementById('system').selectedIndex = 0;

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

		

		var don = $(document).getUrlParam("don");

		

		if ( don ){

			$("#info-done").css({display:'inherit'});
			$("#upload-pc").css({display:'none'});

		}

		

		var err = $(document).getUrlParam("err");

		

		if ( err ){
			
			err = parseInt(err);
			
			if ( err >= 0 ){
				showGlobalInfo('<?php echo $this->lang->line('tarjeta_telefonica_no_se_puede_editar'); ?>.');	
			}
			else{
				$("#upload-error").css({display:''});
			}
			
		}

		

		tags = $("#tags").val().toString();

		$("#tags").remove();

		

		tags = tags.split(',');

		

		for ( i=0 ; i < tags.length ; i++ ){

			

			tag = tags[i].toString().replace('%20',' ');

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

		

		var id_c = parseInt($("#country").val());

		catalog_code = document.getElementById('catalog-code');

		

		$(catalog_code).load(path+'ajax/upload/catalogCodeByCountry.php',{country:id_c} , function(){

			

			if ( catalog_code.innerHTML.length > 0 ) 

				$("#catalog-tr").css({display:'table-row'});

			else

				$("#catalog-tr").css({display:'none'});

		});

		<?php
			if ( strlen($phonecard['known_date']) > 0 ){
				?>
				onlyOneDate( document.getElementById('date_known_year') , 'date' );
				<?php	
			}
			else{
				if ( strlen($phonecard['issued_on']) > 0 ){
					?>
					onlyOneDate( document.getElementById('date_year') , 'date_known' );
					<?php	
				}
			}
		?>
	

	});


	function doneEdit(){
		
		var onDone = $(document).getUrlParam("onDone");
		
		if ( onDone ){
			location.href = path+'index.php/'+onDone;	
		}
	}

</script>



<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>

<a id="modalF" style="display:none;" rel="leanModal" href="#modal-feedback">a</a>

<div id="modal-phonecard"></div>

<div id="modal-feedback"></div>

<div id="upload-error" style="display:none;">
	<div id="warning-in">
		<div class="title_warning">
			<img src="<?php echo base_url(); ?>img/alert.png" height="16" width="16" />
			<?php echo $this->lang->line('tu_tarjeta_telefonica'); ?> <span style="text-decoration:underline;"><?php echo $this->lang->line('no_pudo'); ?></span> <?php echo $this->lang->line('ser_cargada'); ?>
		</div>
	</div>
	<div id="warning-info">
		<?php echo $this->lang->line('diculpa_tuvimos_un_problema_cargando_tu'); ?> <b><?php echo $this->lang->line('tarjeta_telefonica'); ?></b>.
		<br />
        <br>
		<?php echo $this->lang->line('error_imagenes'); ?>
	</div>
</div>

<div style="display:none;" id="info-done" class="info-green">

	<img src="<?php echo base_url(); ?>img/done.png" />

	<?php echo $this->lang->line('tarjeta_telefonica'); ?> "<?php echo $phonecard['name']; ?>" <?php echo $this->lang->line('edit_tarjetas_modificada'); ?>.

	<br />
    <br>

	<span class="google-button" onClick="modalPhonecard(<?php echo $phonecard['id_phonecards']; ?>);" ><?php echo $this->lang->line('ver'); ?></span>
    <?php
		if ( $_REQUEST['onDone'] ){
			?>
			&nbsp;&nbsp;&nbsp;
			<span class="google-button" onClick="doneEdit();" ><?php echo $this->lang->line('regresar'); ?></span>
            <?php
		}
	?>
    
</div>



<div id="upload-pc" class="box1">

	<div id="upload-title">

		<span><?php echo $this->lang->line('editar_tarjetas_telefonicas'); ?></span>

	</div>

	<div id="upload-required">

		* &mdash; <?php echo $this->lang->line('campos_obligatorios'); ?>.

	</div>

	<form id="form0" action="edit_go" method="post">
    
    	<input type="hidden" name="onDone" value="<?php echo str_replace(' ','+',$_REQUEST['onDone']); ?>" />		

		<table cellspacing="5px">

			<tr>

				<td><span class="obb">* </span><?php echo $this->lang->line('pais'); ?>: </td>

				<td>

					<select id="country" name="country" onChange="setComp(this);">

						<option selected="selected" value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>

						<?php

							for ($i=0 ; $i < count($countries) ; $i++){								

								if ( strval($phonecard['id_countries']) == strval($countries[$i]['id_countries']) ){

									echo '<option selected="selected" value="'.$countries[$i]['id_countries'].'" >'.$countries[$i]['name'].'</option>';

									

								}

								else{ 

									echo '<option value="'.$countries[$i]['id_countries'].'" >'.$countries[$i]['name'].'</option>';

								}

							}

						?>							

					</select>

				</td>

				<td><a href="javascript:modalFeedback()"><?php echo $this->lang->line('tu_pais_no_aparece'); ?></a></td>

			</tr>

			<tr>

				<td><span class="obb">* </span><?php echo $this->lang->line('moneda_corriente'); ?>: </td>

				<td id="s_curr">

					<select id="currency" name="currency">

						<?php

							for ($i=0 ; $i < count($currencies) ; $i++){

								

								if ( strval($phonecard['id_currencies']) == strval($currencies[$i]['id_currencies']) ){

									echo '<option selected="selected" value="'.$currencies[$i]['id_currencies'].'" >'.$currencies[$i]['name'].'</option>';

								}

								else{ 

									echo '<option value="'.$currencies[$i]['id_currencies'].'" >'.$currencies[$i]['name'].'</option>';

								}

								

							}

						?>

					</select>

				</td>

				<td><a href="javascript:modalFeedback()"><?php echo $this->lang->line('tu_moneda_no_aparece'); ?></a></td>

			</tr>

			<tr>

				<td><span class="obb">* </span><?php echo $this->lang->line('compania'); ?>: </td>

				<td id="s_comp">

					<input type="text" id="companies" name="companies" class="upload-input" value="<?php echo $companies['name']; ?>" >

				</td>

				<td class="reg_info"><?php echo $this->lang->line('compania_emisora_tarjeta'); ?> <?php echo $this->lang->line('se_recomienda_el_autocompletar'); ?></td>

			</tr>

			<tr>

				<td></td>

				<td>

					<span onMouseOver="showInfo( this , '<?php echo $this->lang->line('explore_phonecards_tarjetas_uso_interno_explicacion') ?>' )" style="font-size:14px; cursor:default;">

						<input type="checkbox" <?php if ( $phonecard['not_emmited'] == 1 ) echo 'checked="checked"'; ?> name="not_emmited" id="not_emmited" onchange="catalog_allow_one(this);" />

						<span><?php echo $this->lang->line('tarjetas_compania_uso_interno'); ?></span>

					</span>

				</td>

				<td class="reg_info"><?php echo $this->lang->line('pruebas_demostraciones_licitaciones'); ?></td>

			</tr>


			<tr id="system_tr">

				<td><span class="obb">* </span><?php echo $this->lang->line('sistema'); ?>: </td>

				<td>

					<select id="system" name="system" style="width:150px;" onChange="setSystemType(this);"  >

						<option selected="selected" value="-1" >Select</option>

						<option value="1" <?php if ( strval($phonecard['id_phonecards_systems']) == 1 ) echo 'selected="selected"' ?> ><?php echo $this->lang->line('chip'); ?></option>

						<option value="2" <?php if ( strval($phonecard['id_phonecards_systems']) == 2 ) echo 'selected="selected"' ?> ><?php echo $this->lang->line('banda_magnetica'); ?></option>

						<option value="3" <?php if ( strval($phonecard['id_phonecards_systems']) == 3 ) echo 'selected="selected"' ?> ><?php echo $this->lang->line('sistema_optico'); ?></option>

						<option value="4" <?php if ( strval($phonecard['id_phonecards_systems']) == 4 ) echo 'selected="selected"' ?> ><?php echo $this->lang->line('memoria_remota'); ?></option>

						<option value="5" <?php if ( strval($phonecard['id_phonecards_systems']) == 5 ) echo 'selected="selected"' ?> ><?php echo $this->lang->line('sistema_inducido'); ?></option>			

					</select>

				</td>

				<td><a href="javascript:modalFeedback()"><?php echo $this->lang->line('tu_sistema_no_aparece'); ?></a></td>

			</tr>

			<tr>

				<td><span class="obb">* </span><?php echo $this->lang->line('nombre'); ?>: </td>

				<td><input type="text" id="name" name="name" class="upload-input" value="<?php echo $phonecard['name']; ?>" ></td>

				<td class="reg_info"><?php echo $this->lang->line('nombre_tarjeta_telefonica'); ?></td>

			</tr>

			<tr id="catalog-tr" style="display:none">

				<td><?php echo $this->lang->line('catalogo_referencia'); ?>: </td>

				<td>

					<span id="catalog-code"></span>

					<input type="text" id="reference" name="reference" class="catalog-input" value="<?php echo $phonecard['reference']; ?>" />

				</td>

				<td><a href="javascript:modalFeedback()"><?php echo $this->lang->line('problemas_catalogo_referencia'); ?></a></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('serie_1'); ?>: </td>

				<td id="s_ser">

					<div class="reg_info">

						<span><?php echo $this->lang->line('nombre'); ?></span>

						<span style="float:right; margin-right:5px;"><?php echo $this->lang->line('numero'); ?></span>

					</div>

					<input type="text" id="serie" name="serie" value="<?php if ( !$phonecard['serie_known'] ) echo $serie['name']; ?>" class="upload-input2" style="width:144px;" onKeyUp="onlyOneInput(this,'serie2');onlyOneInput(this,'serie_n2');" >

					<input type="text" id="serie_n" name="serie_n" class="upload-num" value="<?php if ( !$phonecard['serie_known'] ) echo $phonecard['serie_number']; ?>" onKeyUp="onlyOneInput(this,'serie_n2');" >

				</td>

				<td class="reg_info"><?php echo $this->lang->line('impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('serie_2'); ?>: </td>

				<td id="s_ser2">

					<div class="reg_info">

						<span><?php echo $this->lang->line('nombre'); ?></span>

						<span style="float:right; margin-right:5px;"><?php echo $this->lang->line('numero'); ?></span>

					</div>

					<input type="text" id="serie2" name="serie2" value="<?php if ( $phonecard['serie_known'] ) echo $serie['name']; ?>" class="upload-input2" style="width:144px;" onKeyUp="onlyOneInput(this,'serie');onlyOneInput(this,'serie_n');" >

					<input type="text" id="serie_n2" name="serie_n2" class="upload-num" value="<?php if ( $phonecard['serie_known'] ) echo $phonecard['serie_number']; ?>" onKeyUp="onlyOneInput(this,'serie_n');" >

				</td>

				<td class="reg_info"><?php echo $this->lang->line('no_impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('conocimiento_general'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('tiraje_1'); ?>: </td>

				<td><input type="text" id="printRun" name="printRun" value="<?php if ( !$phonecard['print_run_known'] ) echo $phonecard['print_run']; ?>" onkeypress="onlyNumbers(event);onlyOneInput(this,'printRun2');" class="upload-input"></td>

				<td class="reg_info"><?php echo $this->lang->line('ejemplo_20000'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('tiraje_2'); ?>: </td>

				<td><input type="text" id="printRun2" name="printRun2" onkeypress="onlyNumbers(event);onlyOneInput(this,'printRun');" value="<?php if ( $phonecard['print_run_known'] ) echo $phonecard['print_run']; ?>" class="upload-input" ></td>

				<td class="reg_info"><?php echo $this->lang->line('no_impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('valor_aproximado_conocido'); ?></td>

			</tr>

			<tr>

				<?php

					$date = $phonecard['issued_on'];

					

					if ( $date ){

						$date = explode('/',$date);

						$year = strval(trim($date[0]));

						$month = strval(trim($date[1]));

						$day = strval(trim($date[2]));

					}

					

				?>

			

				<td><?php echo $this->lang->line('emitida'); ?>: </td>

				<td id="upload-date">

					<div>&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('ano'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('mes'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('dia'); ?></div>

					<div>

						<input type="text" id="date_year" name="date_year" value="<?php echo $year; ?>" class="upload-date1" onKeyUp="verifyDate( event , this , 'year' );nextIn(this,4,0);onlyOneDate(this,'date_known');" maxlength="4">

						/

						<input type="text" id="date_month" name="date_month" value="<?php echo $month; ?>" class="upload-date0" onKeyUp="verifyDate( event , this , 'month' );nextIn(this,2,1);" maxlength="2">

						/

						<input type="text" id="date_day" name="date_day" value="<?php echo $day; ?>" class="upload-date0" maxlength="2" onKeyUp="verifyDate( event , this , 'day' );">

					</div>

				</td>

				<td class="reg_info"><?php echo $this->lang->line('impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>

			</tr>

			<tr>

				<?php

					$date = $phonecard['exp_date'];

					

					if ( $date ){

						$date = explode('/',$date);

						$year_ex = strval(trim($date[0]));

						$month_ex = strval(trim($date[1]));

						$day_ex = strval(trim($date[2]));

					}

					

				?>

			

				<td><?php echo $this->lang->line('fecha_vencimiento'); ?>: </td>

				<td id="upload-date_ex">

					<div>

						<input type="text" id="date_ex_year" name="date_ex_year" value="<?php echo $year_ex; ?>" class="upload-date1" onKeyUp="verifyDate( event , this , 'year' );nextIn2(this,4,0);" maxlength="4">

						/

						<input type="text" id="date_ex_month" name="date_ex_month" value="<?php echo $month_ex; ?>" class="upload-date0" onKeyUp="verifyDate( event , this , 'month' );nextIn2(this,2,1);" maxlength="2">

						/

						<input type="text" id="date_ex_day" name="date_ex_day"  value="<?php echo $day_ex; ?>" class="upload-date0" maxlength="2" onKeyUp="verifyDate( event , this , 'day' );">

					</div>

				</td>

				<td class="reg_info"><?php echo $this->lang->line('impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>

			</tr>

			<tr>

				

				<?php

					$date = $phonecard['known_date'];

					

					if ( $date ){

						$date = explode('/',$date);

						$year_kn = strval(trim($date[0]));

						$month_kn = strval(trim($date[1]));

						$day_kn = strval(trim($date[2]));

					}

					

				?>

			

				<td><?php echo $this->lang->line('fecha_conocida'); ?>: </td>

				<td id="upload-date_kwown">

					<div>

						<input type="text" id="date_known_year" name="date_known_year" value="<?php echo $year_kn; ?>" class="upload-date1" onKeyUp="verifyDate( event , this , 'year' );nextIn3(this,4,0);onlyOneDate(this,'date');" maxlength="4">

						/

						<input type="text" id="date_known_month" name="date_known_month" value="<?php echo $month_kn; ?>" class="upload-date0" onKeyUp="verifyDate( event , this , 'month' );nextIn3(this,2,1);" maxlength="2">

						/

						<input type="text" id="date_known_day" name="date_known_day" value="<?php echo $day_kn; ?>" class="upload-date0" maxlength="2" onKeyUp="verifyDate( event , this , 'day' );">

					</div>

				</td>

				<td class="reg_info"><?php echo $this->lang->line('fecha_conocida_no_impresa'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('numero_de_orden'); ?>: </td>

				<td><input type="text" id="order_n" name="order_n" class="upload-num" onKeyUp="onlyNumbers(event);" value="<?php echo $phonecard['order_n']; ?>" /></td>
                
                <td class="reg_info"><?php echo $this->lang->line('numero_de_orden_explicacion'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('valor_nominal'); ?>: </td>

				<td><input type="text" id="faceValue" name="faceValue" value="<?php echo $phonecard['face_value']; ?>" onkeypress="onlyNumbers(event);" class="upload-input"></td>

				<td class="reg_info"><?php echo $this->lang->line('ejemplo_20000'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('imagen_anverso'); ?>: </td>

				<td id="i_img">

					<span class="google-button" onClick="$(document.getElementById('i_file')).click();"><?php echo $this->lang->line('examinar'); ?></span>

					<input style="display:none;" type="file" id="i_file" name="i_file" accept="image/*" onChange="img_loaded(0);" />

				</td>

				<td id="i_info" class="reg_info"><?php echo $this->lang->line('por_lo_menos_600_300'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('imagen_reverso'); ?>: </td>

				<td id="i_img_r">

					<span class="google-button" onClick="$(document.getElementById('i_file_r')).click();"><?php echo $this->lang->line('examinar'); ?></span>

					<input style="display:none;" type="file" id="i_file_r" name="i_file_r" accept="image/*" onChange="img_loaded(1);" />

				</td>

				<td id="i_info-r" class="reg_info"><?php echo $this->lang->line('por_lo_menos_600_300'); ?></td>

			</tr>

			<?php

				$tags = '';

				

				for ( $i = 0 ; $i < count($tag) ; $i++ ){

					$tags = $tags.'<option>'.$tag[$i]['name'].'</option>';

				}

			?>

			<tr>

				<input type="hidden" id="tags" value="<?php echo $phonecard['tags']; ?>" />

				<td><?php echo $this->lang->line('tematica'); ?>: </td>

				<td>

					<select id="tag0" name="tag0" onChange="setTag(0);" >

						<option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>

						<?php echo $tags; ?>

					</select>

				</td>

			</tr>

			<tr id="tag_tr1" style="display:none;">

				<td></td>

				<td>

					<select id="tag1" name="tag1" onChange="setTag(1);" >

						<option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>

						<?php echo $tags; ?>

					</select>

				</td>

			</tr>

			<tr id="tag_tr2" style="display:none;">

				<td></td>

				<td>

					<select id="tag2" name="tag2" onChange="setTag(2);" >

						<option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>

						<?php echo $tags; ?>

					</select>

				</td>

			</tr>

			<tr id="tag_tr3" style="display:none;">

				<td></td>

				<td>

					<select id="tag3" name="tag3" onChange="setTag(3);" >

						<option value="-1"><?php echo $this->lang->line('seleccione'); ?></option>

						<?php echo $tags; ?>

					</select>

				</td>

			</tr>

			<tr id="variation1" style="display:none;">

				<td><?php echo $this->lang->line('variante_1_chip'); ?>: </td>

				<td>

					<span class="google-button" onClick="showSystemTypes();">

						<?php echo $this->lang->line('seleccione'); ?>

						<img style="position:relative; top:4px; left:4px;" src="<?php echo base_url(); ?>img/arrow-down.png" width="16" height="16"/>

					</span>

					<div id="variation1_list" style="display:none;"></div>

				</td>

			</tr>

			<?php

				$sys = intval($phonecard['id_phonecards_systems']);

				

				if ( $sys == 1 ){

					echo '<script>setSystemType( document.getElementById("system") , '.$phonecard['id_variation1'].' )</script>';

				}

			?>

			<tr id="variation2" <?php if ( $sys != 1 ) echo 'style="display:none;"'; ?> >

				<td><?php echo $this->lang->line('variante_2_logo'); ?>: </td>

				<td>

					<span class="google-button" onClick="showLogoTypes();">

						<?php echo $this->lang->line('seleccione'); ?>

						<img style="position:relative; top:4px; left:4px;" src="<?php echo base_url(); ?>img/arrow-down.png" width="16" height="16"/>

					</span>

					<div id="variation2_list" style="display:none">

						<table id="variation2_table" style="margin:0;">

						

							<?php							

							for ($i=0 ; $i < count($logos) ; $i++){

								?>								

								<tr <?php echo $i % 2 == 0 ? '':'class="odd"'; ?> >

									<td><input onChange="allowOne('variation2_list',this);" <?php if ( strval($phonecard['id_variation2']) == strval($logos[$i]['id_phonecards_logo']) ) echo 'checked="checked"' ?>  type="checkbox" value="<?php echo $logos[$i]['id_phonecards_logo']; ?>" name="logo_type<?php echo $i; ?>" /></td>

									<td><?php echo $logos[$i]['name']; ?></td>

									<td><img class="variation_table_images" src="<?php echo base_url(); ?>upload/logo/<?php echo $logos[$i]['id_phonecards_logo']; ?>.jpg" onMouseOver="showInfo3(this,1,<?php echo $logos[$i]['id_phonecards_logo']; ?>,1);" /></td>

								</tr>

								<?php

							}

								?>

							

							<input type="hidden" value="<?php echo $phonecard['id_variation2']; ?>" id="var2" name="var2" />							

						</table>

					</div>

				</td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('variacion_descriptiva'); ?>:</td>

				<td>

					<textarea class="input1" name="var3" style="height:100px;" ><?php echo $phonecard['descriptive_variation']; ?></textarea>

				</td>

				<td class="reg_info"><?php echo $this->lang->line('ayuda_variante_descriptiva'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('precio_estimado'); ?>:</td>

				<td>

					<input type="text" id="est_price" name="est_price" value="<?php echo $phonecard['est_price']; ?>" class="upload-num" />

					US$

				</td>

			</tr>	

			<input type="hidden" value="<?php echo $phonecard['id_phonecards']; ?>" name="id_pc" />

		</table>

		

		<div style="margin-top:10px; margin-bottom:10px; margin-left:15px;">

			<span onClick="sendForm();" class="google-button google-button-blue"><?php echo $this->lang->line('editar_tarjeta_telefonica'); ?></span>

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
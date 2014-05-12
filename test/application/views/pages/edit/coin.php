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
			$('#s_title').load(path+'ajax/upload/coins/titleByCountry.php', {country:id_c});
			
			$('#s_mint_house').load(path+'ajax/upload/coins/mintHouseByCountry.php', {country:id_c});
			
			catalog_code = document.getElementById('catalog-code');
			
			$(catalog_code).load(path+'ajax/upload/coins/catalogCodeByCountry.php',{country:id_c} , function(){
				
				if ( catalog_code.innerHTML.length > 0 ) {
					$("#catalog-tr").css({display:'table-row'});
					
					document.getElementById('reference').value='';
				}else{
					$("#catalog-tr").css({display:'none'});
				}
			});
			 
		}
		else{
			document.getElementById('s_title').innerHTML = '<select disabled="disabled" id="title" name="title"><option selected="selected" value="-1"><?php echo $this->lang->line('seleccione'); ?></option></select>';
		}
		
	}

	
	function setSubtitle( dom ){
	
		index = dom.selectedIndex;
		id_t = dom.options[index].value;
		
		if ( id_t != -1 ){
			$('#s_subtitle').load(path+'ajax/upload/coins/subtitleByTitle.php', {title:id_t});
		}
		else{
			document.getElementById('s_subtitle').innerHTML = '<select disabled="disabled" id="subtitle" name="subtitle"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
		}
	
	}
	
	function setDenomination( dom ){
	
		index = dom.selectedIndex;
		id_s = dom.options[index].value;
		
		if ( id_s != -1 ){
			$('#s_denomination').load(path+'ajax/upload/coins/denominationBySubtitle.php', {subtitle:id_s});
		}
		else{
			document.getElementById('s_denomination').innerHTML = '<select disabled="disabled" id="denomination" name="denomination"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
		}
	
	}
	
	
	function setValue( dom ){
	
		index = dom.selectedIndex;
		id_d = dom.options[index].value;
		
		if ( id_d != -1 ){
			$('#s_value').load(path+'ajax/upload/coins/valueByDenomination.php', {denomination:id_d});
		}
		else{
			document.getElementById('s_value').innerHTML = '<select disabled="disabled" id="value" name="value"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
		}
	
	}
	
	
	function load_date( type ){
		
		if(type == 1 ){
			var type_n = 'greg';
			var type_n_a = 'isla';
		}else{ 
			var type_n = 'isla';
			var type_n_a = 'greg'; 
		}
		
		var date = document.getElementById('date_year_'+type_n).value;
		 		
		div = document.createElement('div'); 
		
		$(div).load(path+'ajax/upload/coins/loadDate.php',{type:type, date:date} , function(){
			
			document.getElementById('date_year_'+type_n_a).value = div.innerHTML;
		});	
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

			case 2 : 
				document.getElementById('size_d').style.display='table-row';
				document.getElementById('size_h').style.display='none';
				document.getElementById('size_w').style.display='none';
			break;
			
			case 3 : 
				document.getElementById('size_d').style.display='table-row';
				document.getElementById('size_h').style.display='none';
				document.getElementById('size_w').style.display='none';
			break;
						
			default:
				document.getElementById('size_d').style.display='none';
				document.getElementById('size_h').style.display='table-row';
				document.getElementById('size_w').style.display='table-row';
			break;
				
			
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

	

	function modalCoin( _p ){

		$("#modal-coin").load(path+'ajax/showCoin.php',{p:_p,path:path},function(){

			$("#modalC").click();

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

		

		if ( document.getElementById('country').selectedIndex == -1 || $("#country").val() == -1 ){
			text+='-<?php echo $this->lang->line(pais_no_valido); ?>\n';
		}
		if ( $("#title").val() == -1 ){
			text+='-<?php echo $this->lang->line(titulo_no_valido); ?>\n';
		}
		if ( $("#subtitle").val() == -1 ){
			text+='-<?php echo $this->lang->line(subtitulo_no_valido); ?>\n';
		} 
		if ( $("#value").val() == -1 ){
			text+='-<?php echo $this->lang->line(valor_no_valido); ?>\n';
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
	
	function verifyDate2( evt , dom , type ){
		var theEvent = evt || window.event;
		
		value = $(dom).val();
		var type_regex;
		
		switch( type ){
		
		case 'year':
			type_regex = /^(?:1)[\d]{0,3}$/;
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



<a id="modalC" style="display:none;" rel="leanModal" href="#modal-coin">a</a>
<a id="modalF" style="display:none;" rel="leanModal" href="#modal-feedback">a</a>
<div id="modal-coin"></div>
<div id="modal-feedback"></div>

<div id="upload-error" style="display:none;">
	<div id="warning-in">
		<div class="title_warning">
			<img src="<?php echo base_url(); ?>img/alert.png" height="16" width="16" />
			<?php echo $this->lang->line('tu_moneda'); ?> <span style="text-decoration:underline;"><?php echo $this->lang->line('no_pudo'); ?></span> <?php echo $this->lang->line('ser_cargada'); ?>
		</div>
	</div>
	<div id="warning-info">
		<?php echo $this->lang->line('diculpa_tuvimos_un_problema_cargando_tu'); ?> <b><?php echo $this->lang->line('moneda'); ?></b>.
		<br />
        <br>
		<?php echo $this->lang->line('error_imagenes'); ?>
	</div>
</div>

<div style="display:none;" id="info-done" class="info-green">

	<img src="<?php echo base_url(); ?>img/done.png" />

	<?php echo $this->lang->line('moneda'); ?> "<?php echo $coin['name']; ?>" <?php echo $this->lang->line('edit_tarjetas_modificada'); ?>.

	<br />
    <br>

	<span class="google-button" onClick="modalCoin(<?php echo $coin['id_coins']; ?>);" ><?php echo $this->lang->line('ver'); ?></span>
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

		<span><?php echo $this->lang->line('editar_moneda'); ?></span>

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

					<select id="country" name="country" onChange="setTitle(this);">

						<option selected="selected" value="-1" ><?php echo $this->lang->line('seleccione'); ?></option>

						<?php

							for ($i=0 ; $i < count($countries) ; $i++){								

								if ( strval($coin['id_countries']) == strval($countries[$i]['id_countries']) ){

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
            
            <?php
				if($coin['reference']){
					
					$reference = explode('-',$coin['reference']);
			?> 
            
            <tr id="catalog-tr" >
				<td><?php echo $this->lang->line('catalogo_referencia'); ?>: </td>
				<td>
					<span id="catalog-code"><?php echo $reference[0].':'; ?></span>
					<input type="text" id="reference" name="reference" class="catalog-input" value="<?php echo $reference[1]; ?>" />
				</td>
				<td><a href="javascript:modalFeedbackReferenceCatalog()"><?php echo $this->lang->line('problemas_catalogo_referencia'); ?></a></td>
			</tr>
            
            <?php
				}
			?>

			<tr> 
				<td><span class="obb">* </span><?php echo $this->lang->line('titulo'); ?>: </td>
				<td id="s_title">
					<select id="title" name="title" onChange="setSubtitle(this)">

						<?php

							for ($i=0 ; $i < count($tittle) ; $i++){

								

								if ( strval($coin['id_coins_title']) == strval($tittle[$i]['id_coins_title']) ){

									echo '<option selected="selected" value="'.$tittle[$i]['id_coins_title'].'" >'.$tittle[$i]['name'].'</option>';

								}

								else{ 

									echo '<option value="'.$tittle[$i]['id_coins_title'].'" >'.$tittle[$i]['name'].'</option>';

								}

								

							}

						?>

					</select>
				</td>
				<td><a href="javascript:modalFeedbackTitle()"><?php echo $this->lang->line('tu_titulo_no_aparece'); ?></a></td>
			</tr>
            
            
            <tr>
				<td><span class="obb">* </span><?php echo $this->lang->line('subtitulo'); ?>: </td>
				<td id="s_subtitle">
					<select id="subtitle" name="subtitle" onChange="setDenomination(this)">
						<?php

							for ($i=0 ; $i < count($subtitle) ; $i++){

								

								if ( strval($coin['id_coins_subtitle']) == strval($subtitle[$i]['id_coins_subtitle']) ){

									echo '<option selected="selected" value="'.$subtitle[$i]['id_coins_subtitle'].'" >'.$subtitle[$i]['name'].'</option>';

								}

								else{ 

									echo '<option value="'.$subtitle[$i]['id_coins_subtitle'].'" >'.$subtitle[$i]['name'].'</option>';

								}

								

							}

						?>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackSubtitle()"><?php echo $this->lang->line('tu_subtitulo_no_aparece'); ?></a></td>
			</tr>
            
            <tr>
				<td><span class="obb">* </span><?php echo $this->lang->line('denominacion'); ?>: </td>
				<td id="s_denomination">
					<select id="denomination" name="denomination" onChange="setValue(this)">
						<?php

							for ($i=0 ; $i < count($denomination) ; $i++){

								

								if ( strval($coin['id_coins_denomination']) == strval($denomination[$i]['id_coins_denomination']) ){

									echo '<option selected="selected" value="'.$denomination[$i]['id_coins_denomination'].'" >'.$denomination[$i]['name'].'</option>';

								}

								else{ 

									echo '<option value="'.$denomination[$i]['id_coins_denomination'].'" >'.$denomination[$i]['name'].'</option>';

								}

								

							}

						?>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackValue()"><?php echo $this->lang->line('tu_valor_no_aparece'); ?></a></td>
			</tr>

			<tr>
				<td><span class="obb">* </span><?php echo $this->lang->line('valor'); ?>: </td>
				<td id="s_value">
					<select id="value" name="value" onClick="setSubTitle(this);">
						<?php

							for ($i=0 ; $i < count($value) ; $i++){

								

								if ( strval($coin['id_coins_value']) == strval($value[$i]['id_coins_value']) ){

									echo '<option selected="selected" value="'.$value[$i]['id_coins_value'].'" >'.$value[$i]['name'].'</option>';

								}

								else{ 

									echo '<option value="'.$value[$i]['id_coins_value'].'" >'.$value[$i]['name'].'</option>';

								}

								

							}

						?>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackValue('coins')"><?php echo $this->lang->line('tu_valor_no_aparece'); ?></a></td>
			</tr>

			
            <tr>
				<td><span class="obb">* </span><?php echo $this->lang->line('circulacion'); ?>: </td>
				<td id="s_value">
					<select id="circulation" name="circulation"> 
						<option value="1" <?php if($coin['circulation']==1) echo 'selected="selected"'; ?> ><?php echo $this->lang->line('circulacion_normal'); ?></option>
						<option value="2" <?php if($coin['circulation']==2) echo 'selected="selected"'; ?>><?php echo $this->lang->line('conmemorativas_numismaticas'); ?></option>
						<option value="3" <?php if($coin['circulation']==3) echo 'selected="selected"'; ?>><?php echo $this->lang->line('ensayos_pruebas_otras'); ?></option>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackValue()"><?php echo $this->lang->line('tu_valor_no_aparece'); ?></a></td>
			</tr>
            
            <tr>
				<td><?php echo $this->lang->line('emitida_greg'); ?>: </td>
				<td id="upload-date">
					<div>&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('ano'); ?> 
					<div>
						<input type="text" id="date_year_greg" name="date_year_greg" class="upload-date1" onkeyup="verifyDate( event , this , 'year' );" onkeypress="onlyNumbers(event)" onChange="load_date(1);" maxlength="4" autocomplete="off" value="<?php echo $coin['issued_on_gre']; ?>"> 
					</div>
				</td>
				<td class="reg_info"><?php echo $this->lang->line('impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
			</tr> 
            <tr>
				<td><?php echo $this->lang->line('emitida_isla'); ?>: </td>
				<td id="upload-date">
					<div>&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('ano'); ?> 
					<div>
						<input type="text" id="date_year_isla" name="date_year_isla" class="upload-date1" onkeyup="verifyDate2( event , this , 'year' );" onkeypress="onlyNumbers(event)" onChange="load_date(2);" maxlength="4" autocomplete="off" value="<?php echo $coin['issued_on_isl']; ?>">
					</div>
				</td>
				<td class="reg_info"><?php echo $this->lang->line('impreso_en_tarjeta_telefonica'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
			</tr> 
            
            <tr>
				<td><?php echo $this->lang->line('casa_moneda'); ?>: </td>
				<td id="s_mint_house">
					<select id="mint_house" name="mint_house">
						<?php

							for ($i=0 ; $i < count($mint_house) ; $i++){

								

								if ( strval($coin['id_coins_mint_house']) == strval($mint_house[$i]['id_coins_mint_house']) ){

									echo '<option selected="selected" value="'.$mint_house[$i]['id_coins_mint_house'].'" >'.$mint_house[$i]['name'].'</option>';

								}

								else{ 

									echo '<option value="'.$mint_house[$i]['id_coins_mint_house'].'" >'.$mint_house[$i]['name'].'</option>';

								}

								

							}

						?>
					</select>
				</td>
				<td><a href="javascript:modalFeedbackMintHouse()"><?php echo $this->lang->line('tu_casa_moneda_no_aparece'); ?></a></td>
			</tr>

			<tr>
				<td><?php echo $this->lang->line('tiraje'); ?>: </td>
				<td><input type="text" id="printRun" value="<?php echo $coin['print_run']; ?>" name="printRun" onkeypress="onlyNumbers(event);" class="upload-input" ></td>
				<td class="reg_info"><?php echo $this->lang->line('ejemplo_20000'); ?><br /><?php echo $this->lang->line('deje_en_blanco'); ?></td>
			</tr>
            
            
			<tr>
				<td><?php echo $this->lang->line('aleacion'); ?>: </td>
				<td> 
                	<select id="composition" name="composition">
						<?php

							for ($i=0 ; $i < count($composition) ; $i++){

								

								if ( strval($coin['id_coins_composition']) == strval($composition[$i]['id_coins_material']) ){

									echo '<option selected="selected" value="'.$composition[$i]['id_coins_material'].'" >'.$composition[$i]['name'].'</option>';

								}

								else{ 

									echo '<option value="'.$composition[$i]['id_coins_material'].'" >'.$composition[$i]['name'].'</option>';

								}

								

							}

						?>						
					</select> 
				</td>
				<td class="reg_info"><?php echo $this->lang->line('opcional'); ?></td>
			</tr>
            
			<tr>
				<td><?php echo $this->lang->line('forma'); ?>: </td>
				<td id="s_shape"> 
                	<select id="shape" name="shape" onChange="setSize(this);">
						<?php
							for ($i=0 ; $i < count($shapes) ; $i++){
								if ( strval($coin['id_coins_shape']) == strval($shapes[$i]['id_coins_shape']) ){
								echo '<option selected="selected" value="'.$shapes[$i]['id_coins_shape'].'" >'.$shapes[$i]['name'].'</option>';
							}else{
								echo '<option value="'.$shapes[$i]['id_coins_shape'].'" >'.$shapes[$i]['name'].'</option>';
							}
							}
						?>							
					</select> 
				</td>
				<td><a href="javascript:modalFeedbackFormCoin()"><?php echo $this->lang->line('tu_forma_no_aparece'); ?></a></td>
			</tr>
			
            <?php 
			if($coin['size2']==0){
			?>
            
			<tr id="size_d" >
				<td><?php echo $this->lang->line('tamano'); ?> (<?php echo $this->lang->line('diametro'); ?>):</td>
				<td>
					<input type="text" id="size1" name="size1" class="upload-num" onkeypress="onlyNumbers(event)" value="<?php echo $coin['size']; ?>" />
					<?php echo $this->lang->line('milimetro'); ?>
				</td>
			</tr>
			<?php }else{ ?>
            
			<tr id="size_h" >
				<td><?php echo $this->lang->line('tamano'); ?> (<?php echo $this->lang->line('altura'); ?>):</td>
				<td>
					<input type="text" id="size" name="size2" class="upload-num" onkeypress="onlyNumbers(event)" value="<?php echo $coin['size']; ?>" />
					<?php echo $this->lang->line('milimetro'); ?>
				</td>
			</tr>
            
			<tr id="size_w" >
				<td><?php echo $this->lang->line('tamano'); ?> (<?php echo $this->lang->line('ancho'); ?>):</td>
				<td>
					<input type="text" id="size2" name="size3" class="upload-num" onkeypress="onlyNumbers(event)" value="<?php echo $coin['size2']; ?>" />
					<?php echo $this->lang->line('milimetro'); ?>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td><?php echo $this->lang->line('peso'); ?>:</td>
				<td>
					<input type="text" value="<?php echo $coin['weight']; ?>" id="weight" name="weight" class="upload-num" onkeypress="onlyNumbers(event)" />
					<?php echo $this->lang->line('gramos'); ?>
				</td>
			</tr>

			<tr>
				<td><?php echo $this->lang->line('canto'); ?>: </td>
				<td id="s_edge">
					<select id="edge" name="edge" >
						<?php
							for ($i=0 ; $i < count($edges) ; $i++){
							if ( strval($coin['id_coins_edge']) == strval($edges[$i]['id_coins_edge']) ){
								echo '<option selected="selected" value="'.$edges[$i]['id_coins_edge'].'" >'.$edges[$i]['name'].'</option>';
							}else{
								echo '<option value="'.$edges[$i]['id_coins_edge'].'" >'.$edges[$i]['name'].'</option>';
							}
							}
						?>							
					</select> 
				</td>
				<td><a href="javascript:modalFeedbackEdge()"><?php echo $this->lang->line('tu_canto_no_aparece'); ?></a></td>
			</tr>

			<tr>
				<td><?php echo $this->lang->line('disenador'); ?>: </td>
				<td id="s_designer">
					<select id="designer" name="designer" >
						<?php
						for ($i=0 ; $i < count($designer) ; $i++){
							if ( strval($coin['id_coins_designer']) == strval($designer[$i]['id_coins_designer']) ){
								echo '<option selected="selected" value="'.$designer[$i]['id_coins_designer'].'" >'.$designer[$i]['name'].'</option>';
							}else{
								echo '<option value="'.$designer[$i]['id_coins_designer'].'" >'.$designer[$i]['name'].'</option>';
							}
						}
						?>							
					</select> 
				</td>
				<td><a href="javascript:modalFeedbackDesigner()"><?php echo $this->lang->line('tu_diseñador_no_aparece'); ?></a></td>
			</tr>

			<tr>

				<td><?php echo $this->lang->line('imagen_anverso'); ?>: </td>

				<td id="i_img">

					<span class="google-button" onClick="$(document.getElementById('i_file')).click();"><?php echo $this->lang->line('examinar'); ?></span>

					<input style="display:none;" type="file" id="i_file" name="i_file" accept="image/*" onChange="img_loaded(0);" />

				</td>

				<td id="i_info" class="reg_info"><?php echo $this->lang->line('por_lo_menos_150_150'); ?></td>

			</tr>

			<tr>

				<td><?php echo $this->lang->line('imagen_reverso'); ?>: </td>

				<td id="i_img_r">

					<span class="google-button" onClick="$(document.getElementById('i_file_r')).click();"><?php echo $this->lang->line('examinar'); ?></span>

					<input style="display:none;" type="file" id="i_file_r" name="i_file_r" accept="image/*" onChange="img_loaded(1);" />

				</td>

				<td id="i_info-r" class="reg_info"><?php echo $this->lang->line('por_lo_menos_150_150'); ?></td>

			</tr>

			

			<tr>

				<td><?php echo $this->lang->line('variacion_descriptiva'); ?>:</td>

				<td>

					<textarea class="input1" name="var3" style="height:100px;" ><?php echo $coin['descriptive_variation']; ?></textarea>

				</td>

				<td class="reg_info"><?php echo $this->lang->line('ayuda_variante_descriptiva'); ?></td>

			</tr>
            <tr>
				<td><?php echo $this->lang->line('precio_estimado_dol'); ?>: </td>
				<td>
                	<table>
                    	<tr>
                        	<td>
                            	<div>&nbsp;&nbsp;&nbsp;G
                                <div>
                                    <input type="text" id="ep_g" name="ep_g" class="upload-date1"  onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off" value="<?php echo $coin['ep_g']; ?>"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;F
                                <div>
                                    <input type="text" id="ep_f" name="ep_f" class="upload-date1" onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off" value="<?php echo $coin['ep_f']; ?>"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;VF 
                                <div>
                                    <input type="text" id="ep_vf" name="ep_vf" class="upload-date1"  onkeypress="onlyNumbers(event)" maxlength="4" autocomplete="off" value="<?php echo $coin['ep_vf']; ?>"> 
                                </div> 
                            </td>
                            <td>
                            	<div>&nbsp;&nbsp;&nbsp;UNC
                                <div>
                                    <input type="text" id="ep_unc" name="ep_unc" class="upload-date1"  onkeypress="onlyNumbers(event)"  maxlength="4" autocomplete="off" value="<?php echo $coin['ep_unc']; ?>"> 
                                </div> 
                            </td>
                        </tr>
                    </table> 
				</td>
				<td class="reg_info"></td>
			</tr> 


			<input type="hidden" value="<?php echo $coin['id_coins']; ?>" name="id_cn" />

		</table>

		

		<div style="margin-top:10px; margin-bottom:10px; margin-left:15px;">

			<span onClick="sendForm();" class="google-button google-button-blue"><?php echo $this->lang->line('editar_moneda'); ?></span>

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
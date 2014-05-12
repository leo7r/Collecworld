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
			$('#s_curr').load('currenciesByCountry.php', {country:id_c});
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
	
	function setSystemType( dom ){
		
		index = dom.selectedIndex;
		id_s = parseInt(dom.options[index].value);
		
		switch ( id_s ){
			
			case 1:
				$("#variation1_list").load('typesBySystem.php',{system:id_s});
				$("#variation1").css({display:'table-row'});
				$("#variation2").css({display:'table-row'});
				$("#variation3_text").html('Descriptive Variation:');				
				$("#variation3_info").html('Explain your Variation');
				break;
			case 2:
				$("#variation1 , #variation2").css({display:'none'});
				$("#variation3_text").html('Descriptive Variation:');				
				$("#variation3_info").html('Explain your Variation');
				break;
			case 4:
				$("#variation1 , #variation2").css({display:'none'});
				$("#variation3_text").html('Descriptive Variation:');				
				$("#variation3_info").html('Explain your Variation');
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
	
		$("#modal-phonecard").load('../search/showPhonecard.php',{p:_p,backs:'../'},function(){
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
			
			$("#name,#country,#companies,#currency,#system,#serie,#serie_n,#serie2,#serie_n2,#printRun,#printRun2,#faceValue,#tag0,#tag1,#tag2,#tag3").prop('disabled', false);
			$("#date_year,#date_month,#date_day,#date_known_year,#date_known_month,#date_known_day,#date_ex_year,#date_ex_month,#date_ex_day").prop('disabled',false);
			
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
	
	function onlyOneDate( dom , id ){
	
		if ( dom.value.length == 0 ){
			$("#"+id+"_day").prop('disabled',false);
			$("#"+id+"_month").prop('disabled',false);
			$("#"+id+"_year").prop('disabled',false);
		}
		
		if ( dom.value.length > 0 ){
			$("#"+id+"_year").prop('disabled',true);
			$("#"+id+"_month").prop('disabled',true);
			$("#"+id+"_day").prop('disabled',true);
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
		var saveInfo = $(document).getUrlParam("sav");
		
		
		var err = $(document).getUrlParam("err");
		var don = $(document).getUrlParam("don");
		
		if ( don ){
			$("#upload-done").css({display:''});
		}
		
		if ( err && err >= 0 ){
		
			$("#upload-error").css({display:''});
			
			var img_status = $(document).getUrlParam("img");
			
			err = parseInt(err);
			if ( err > 0 ){
				document.getElementById("warning-info").innerHTML = 'There is another <b>Phonecard</b> with that information.<br /><br />';
				document.getElementById("warning-info").innerHTML+= '<span class="google-button" onclick="modalPhonecard(\'err\');" >View Phonecard</span>';
				
				if ( img_status == -1 ){
					document.getElementById("warning-info").innerHTML+= '<br>Also this phonecard\'s image is missing. <span class="google-button" >Add new image</span>';
				}
				
			}
			else{
				document.getElementById("warning-info").innerHTML = 'Something is wrong with the information of the <b>Phonecard</b>. Try again.';
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
			$("#name,#country,#companies,#system,#serie,#serie_n,#serie2,#serie_n2,#printRun,#printRun2,#faceValue,#tag0,#tag1,#tag2,#tag3,#order_n").prop('disabled', true);
			$("#date_year,#date_month,#date_day,#date_known_year,#date_known_month,#date_known_day,#date_ex_year,#date_ex_month,#date_ex_day").prop('disabled',true);
			showSystemTypes();
			showLogoTypes();
		}
		
		$( "#companies" ).autocomplete({
            source: 'autocomplete.php?table=phonecards_companies'
        });
		
		$( "#serie" ).autocomplete({
            source: 'autocomplete.php?table=phonecards_series'
        });
		
		
	});

</script>

<?php
include '../signin/conexion.php';

function isIE(){
	if (isset($_SERVER['HTTP_USER_AGENT']) && 
	(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
		return true;
	else
		return false;
}
?>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<a id="modalF" style="display:none;" rel="leanModal" href="#modal-feedback">a</a>
<div id="modal-phonecard"></div>
<div id="modal-feedback"></div>

<div id="info-info" >
	- Fill in what is in your phonecard.
	<br />
	- If any field doesn't exist, leave it blank.
</div>

<div id="upload-error" style="display:none;">
	<div id="warning-in">
		<div class="title_warning">
			<img src="../img/alert.png" height="16" width="16" />
			Your phonecard <span style="text-decoration:underline;">has not</span> been uploaded!
		</div>
	</div>
	<div id="warning-info">
		Sorry! We had a problem uploading your <b>Phonecard</b>. Try again later please.
		<br />
		<br />
		<a href="#">Contact us</a>
	</div>
</div>

<div id="upload-done" style="display:none;">
	<div id="done-in">
		<div class="title_warning">
			<img src="../img/done.png" height="16" width="16" />
			Your phonecard has been uploaded!
		</div>
	</div>
	<div id="done-info">
		<span class="google-button" onclick="modalPhonecard('don');">View it</span>
	</div>
</div>

<div id="upload-pc" class="box1">
	<div id="upload-title">
		<span>Upload Phonecards</span>
		<img id="upload-help" src="../img/help2.png" height="20" width="20" onmouseover="showInfo( this , 'Before you upload a new Phonecard, search first to know if it\'s already uploaded.' )">
		<span id="upload-colab" class="google-button" onclick="resetUpload();">Reset</span>
	</div>
	<div id="upload-required">
		* &mdash; field is required.
	</div>
	<form id="form0" action="phonecards_i.php" method="post">		
		<table cellspacing="5px">
			<tr>
				<td><span class="obb">* </span>Country: </td>
				<?php
					$sql = 'SELECT * FROM countries';
					$cursor = mysql_query($sql);
				?>
				<td>
					<select id="country" name="country" onChange="setComp(this);">
						<option selected="selected" value="-1" >Select</option>
						<?php
							for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){
								$datos = mysql_fetch_array($cursor);
								echo '<option value="'.$datos['id_countries'].'" >'.$datos['name'].'</option>';
							}
						?>							
					</select>
				</td>
				<td><a href="javascript:modalFeedback()">Your country is not listed?</a></td>
			</tr>
			<tr>
				<td><span class="obb">* </span>Currency: </td>
				<td id="s_curr">
					<select disabled="disabled" id="currency" name="currency">
						<option selected="selected" value="-1">Select</option>
					</select>
				</td>
				<td><a href="javascript:modalFeedback()">Your currency is not listed?</a></td>
			</tr>
			<tr>
				<td><span class="obb">* </span>Company: </td>
				<td id="s_comp">
					<input type="text" id="companies" name="companies" class="upload-input">
				</td>
				<td class="reg_info">Company issuing the phonecard</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<span onmouseover="showInfo( this , 'Phonecards that were not sold to the public (Test,Demostration,Tender).' )" style="font-size:14px; cursor:default;">
						<input type="checkbox" name="not_emmited" id="not_emmited" onclick="hideSystem(this);" />
						<span>Card company's internal use.</span>
					</span>
				</td>
				<td class="reg_info">Test, Demostration, Tender</td>
			</tr>
			<tr id="system_tr">
				<td><span class="obb">* </span>System: </td>
				<td>
					<select id="system" name="system" style="width:150px;" onchange="setSystemType(this);"  >
						<option selected="selected" value="-1" >Select</option>
						<option value="1" >Chip</option>
						<option value="2" >Magnetic band</option>
						<option value="3" >Optical system</option>
						<option value="4" >Remote memory</option>
						<option value="5" >Induced system</option>		
					</select>
				</td>
				<td><a href="javascript:modalFeedback()">Your system is not listed?</a></td>
			</tr>
			<tr>
				<td><span class="obb">* </span>Name: </td>
				<td><input type="text" id="name" name="name" class="upload-input"></td>
				<td class="reg_info">Phonecard's name</td>
			</tr>
			<tr>
				<td>Order number: </td>
				<td><input type="text" id="order_n" name="order_n" class="upload-num" onkeyup="inputNumber(this);" /></td>
			</tr>
			<tr>
				<td>Serie 1: </td>
				<td id="s_ser">
					<div class="reg_info">
						<span>Name</span>
						<span style="float:right; margin-right:5px;">Number</span>
					</div>
					<input type="text" id="serie" name="serie" value="" class="upload-input2" onkeyup="onlyOneInput(this,'serie2');onlyOneInput(this,'serie_n2');">
					<input type="text" id="serie_n" name="serie_n" class="upload-num" onkeyup="onlyOneInput(this,'serie_n2');onlyOneInput(this,'serie2');" >
				</td>
				<td class="reg_info">Printed on phonecard.<br />If it doesn't exist, leave it blank.</td>
			</tr>
			<tr>
				<td>Serie 2: </td>
				<td id="s_ser2">
					<div class="reg_info">
						<span>Name</span>
						<span style="float:right; margin-right:5px;">Number</span>
					</div>
					<input type="text" id="serie2" name="serie2" value="" class="upload-input2" onkeyup="onlyOneInput(this,'serie');onlyOneInput(this,'serie_n');" >
					<input type="text" id="serie_n2" name="serie_n2" class="upload-num" onkeyup="onlyOneInput(this,'serie_n');onlyOneInput(this,'serie');" >
				</td>
				<td class="reg_info">NOT printed on phonecard.<br />General knowledge.</td>
			</tr>
			<tr>
				<td>Print run: </td>
				<td><input type="text" id="printRun" name="printRun" onkeyup="inputNumber(this);onlyOneInput(this,'printRun2');" class="upload-input" ></td>
				<td class="reg_info">Ex: 20000<br />If it doesn't exist, leave it blank.</td>
			</tr>
			<tr>
				<td>Print run 2: </td>
				<td><input type="text" id="printRun2" name="printRun2" onkeyup="inputNumber(this);onlyOneInput(this,'printRun');" class="upload-input" ></td>
				<td class="reg_info">NOT printed on phonecard.<br />Approximate value which is known.</td>
			</tr>
			<tr>
				<td>Issued on: </td>
				<td id="upload-date">
					<div>&nbsp;Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month&nbsp;&nbsp;&nbsp;&nbsp;Day</div>
					<div>
						<input type="text" id="date_year" name="date_year" class="upload-date1" onkeyup="nextIn(this,4,0);onlyOneDate(this,'date_known');" maxlength="4">
						/
						<input type="text" id="date_month" name="date_month" class="upload-date0" onkeyup="nextIn(this,2,1);" maxlength="2">
						/
						<input type="text" id="date_day" name="date_day" class="upload-date0" maxlength="2">
					</div>
				</td>
				<td class="reg_info">Printed on phonecard.<br />If it doesn't exist, leave it blank.</td>
			</tr>
			<tr>
				<td>Expiration date: </td>
				<td id="upload-date_ex">
					<div>
						<input type="text" id="date_ex_year" name="date_ex_year" class="upload-date1" onkeyup="nextIn2(this,4,0);" maxlength="4">
						/
						<input type="text" id="date_ex_month" name="date_ex_month" class="upload-date0" onkeyup="nextIn2(this,2,1);" maxlength="2">
						/
						<input type="text" id="date_ex_day" name="date_ex_day" class="upload-date0" maxlength="2">
					</div>
				</td>
				<td class="reg_info">Printed on phonecard.<br />If it doesn't exist, leave it blank.</td>
			</tr>
			<tr>
				<td>Known date: </td>
				<td id="upload-date_kwown">
					<div>
						<input type="text" id="date_known_year" name="date_known_year" class="upload-date1" onkeyup="nextIn3(this,4,0);onlyOneDate(this,'date');" maxlength="4">
						/
						<input type="text" id="date_known_month" name="date_known_month" class="upload-date0" onkeyup="nextIn3(this,2,1);" maxlength="2">
						/
						<input type="text" id="date_known_day" name="date_known_day" class="upload-date0" maxlength="2">
					</div>
				</td>
				<td class="reg_info">NOT printed on phonecard, but you know the date.</td>
			</tr>
			<tr>
				<td>Nominal value (price): </td>
				<td><input type="text" id="faceValue" name="faceValue" onkeyup="inputNumber(this);" class="upload-input"></td>
				<td class="reg_info">Ex: 2000<br />If it doesn't exist, leave it blank.</td>
			</tr>
			<tr>
				<td>Anverse image: </td>
				<td id="i_img">
					<?php
						if ( !isIE() ){
					?>
						<input type="radio" onchange="chg_img(0);" />
						<span>Url</span>
						<br />
						<input type="radio" onchange="chg_img(1);" />
						<span>File</span>
					<?php
						}
						else{
							?>
								<input type="file" id="i_file" name="i_file" accept="image/*" onchange="img_loaded(0);" />
							<?php
						}
					?>
				</td>
				<td id="i_info" class="reg_info">300x200 px</td>
			</tr>
			<tr>
				<td>Reverse image: </td>
				<td id="i_img_r">
					<?php
						if ( !isIE() ){
					?>
						<input type="radio" onchange="chg_img_r(0);" />
						<span>Url</span>
						<br />
						<input type="radio" onchange="chg_img_r(1);" />
						<span>File</span>
					<?php
						}
						else{
							?>
								<input type="file" id="i_file_r" name="i_file_r" accept="image/*" onchange="img_loaded(1);" />
							<?php
						}
					?>
				</td>
				<td id="i_info-r" class="reg_info">Optional</td>
			</tr>
			<?php
				$cursor = mysql_query('SELECT * FROM tags');
				$tags = '';
				
				for ( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){
					$res = mysql_fetch_array($cursor);
					$tags = $tags.'<option>'.$res['name'].'</option>';
				}
			?>
			<tr>
				<td>Thematics: </td>
				<td>
					<select id="tag0" name="tag0" onchange="setTag(0);" >
						<option value="-1" >Select</option>
						<?php echo $tags; ?>
					</select>
				</td>
			</tr>
			<tr id="tag_tr1" style="display:none;">
				<td></td>
				<td>
					<select id="tag1" name="tag1" onchange="setTag(1);" >
						<option value="-1" >Select</option>
						<?php echo $tags; ?>
					</select>
				</td>
			</tr>
			<tr id="tag_tr2" style="display:none;">
				<td></td>
				<td>
					<select id="tag2" name="tag2" onchange="setTag(2);" >
						<option value="-1" >Select</option>
						<?php echo $tags; ?>
					</select>
				</td>
			</tr>
			<tr id="tag_tr3" style="display:none;">
				<td></td>
				<td>
					<select id="tag3" name="tag3" onchange="setTag(3);" >
						<option value="-1" >Select</option>
						<?php echo $tags; ?>
					</select>
				</td>
			</tr>
			<tr id="variation1" style="display:none;">
				<td>Variation 1: </td>
				<td>
					<span class="google-button" onclick="showSystemTypes();">
						Select
						<img style="position:relative; top:4px; left:4px;" src="../img/arrow-down.png" width="16" height="16"/>
					</span>
					<div id="variation1_list" style="display:none;">
						
					</div>
				</td>
				<td><a href="javascript:modalFeedback()">Your system type is not listed?</a></td>
			</tr>
			<tr id="variation2" style="display:none;">
				<td>Variation 2: </td>
				<td>
					<span class="google-button" onclick="showLogoTypes();">
						Select
						<img style="position:relative; top:4px; left:4px;" src="../img/arrow-down.png" width="16" height="16"/>
					</span>
					<div id="variation2_list" style="display:none">
						<table id="variation2_table" style="margin:0;">
						
							<?php
							
							$ltype = 'SELECT * FROM phonecards_logos';
							$lcursor = mysql_query($ltype);
							
							for ($i=0 ; $i < mysql_num_rows($lcursor) ; $i++){
								$ldatos = mysql_fetch_array($lcursor);
								?>
								
								<tr <?php echo $i % 2 == 0 ? '':'class="odd"'; ?> >
									<td><input onchange="allowOne('variation2_list',this);"  type="checkbox" value="<?php echo $ldatos['id_phonecards_logo']; ?>" name="variation2_<?php echo $i; ?>" /></td>
									<td><?php echo $ldatos['name']; ?></td>
									<td><img src="logo/<?php echo $ldatos['id_phonecards_logo']; ?>.png" onmouseover="showInfo2(this,'asd',1);" /></td>
								</tr>
								<?php
							}
								?>
							
							<input type="hidden" value="" id="var2" name="var2" />
							
						</table>
					</div>
				</td>
				<td><a href="javascript:modalFeedback()">Your logo is not listed?</a></td>
			</tr>
			<tr id="variation3">
				<td id="variation3_text">Descriptive Variation:</td>
				<td>
					<textarea class="input1" name="comments" style="height:100px;" ></textarea>
				</td>
				<td id="variation3_info" class="reg_info">If your phonecard have another variation, explain it here.</td>
			</tr>
			<tr>
				<td>Estimated price:</td>
				<td>
					<input type="text" id="est_price" name="est_price" class="upload-num" />
					US$
				</td>
			</tr>			
		</table>
		
		<div style="margin-top:10px; margin-bottom:10px; margin-left:15px;">
			<input type="hidden" id="saveInfo" name="saveInfo" value="" />
			<span onclick="sendForm();" class="google-button google-button-blue">Upload</span>
			<span onclick="sendForm(1);" class="google-button google-button-red" onmouseover="showInfo( this , 'Option to upload variations.' )" >Upload & save information</span>
		</div>
		
	</form>
</div>
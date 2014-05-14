/*

AQUI VAN FUNCIONES DE SUBIR CATEGORIAS Y EDITAR

Happy coding


        ..-"""""-..
       .'    ___    '.
      /    ."\  `\    \
     ;    /, (    |    ;
    ;    /_   '._ /     ;
    |     |-  '._`)     |
    ;     '-;-'  \      ;
     ;      /    \\    ;
      \    '.__..-'   /
       '._ 1 9 9 9 _.'
          ""-----""
	   COLLECWORLD.COM
*/

// Funcion para cargar en la pagina la categoria que corresponda
function loadCategory( dom ){
	
	index = dom.selectedIndex;
	opt = dom.options[index];

	if ( opt.value != -1 ){
		
		document.getElementById('content-in').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
		
		switch(parseInt(opt.value)){
			
			case 1 : 	
				$("#content-in").load(path+'index.php/upload/phonecards');
				break;
			case 2 :
				$("#content-in").load(path+'upload/coins');
				break;				
			case 3 :
				$("#content-in").load(path+'upload/banknotes');
				break;
		}

	}
	else{
		document.getElementById('content-in').innerHTML = '';
	}
}

/* FUNCIONES PARA TARJETAS TELEFONICAS */

// Enviar formulario
function phonecard_sendForm( num ){
	
	text = '';
	
	if ( $("#name").val().length == 0 ){
		
		text+='-<?php echo $this->lang->line(nombre_no_valido)."</br>"; ?>';
	}
	if ( $("#companies").val().length == 0 ){
		text+='-<?php echo $this->lang->line(compania_no_valida)."</br>"; ?>';
	}
	if ( document.getElementById('country').selectedIndex == -1 || $("#country").val() == -1 ){
		text+='-<?php echo $this->lang->line(pais_no_valido)."</br>"; ?>';
	}
	if ( $("#currency").val() == -1 ){
		text+='-<?php echo $this->lang->line(moneda_no_valida)."</br>"; ?>';
	}
	if ( $("#system").val() == -1 ){
		text+='-<?php echo $this->lang->line(sistema_no_valido)."</br>"; ?>';
	}
	if ( $("#date_year").val().length == 0 && $("#date_ex_year").val().length == 0 && $("#date_known_year").val().length == 0 ){
		if ( $("#order_n").val().length == 0 ){
			text+='-<?php echo $this->lang->line(numero_de_pedido_o_fecha)."</br>"; ?>';
		}
	}	
	
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
}

function phonecard_onCountrySelected( dom ){
		
	index = dom.selectedIndex;
	id_c = dom.options[index].value;
	
	if ( id_c != -1 ){
		
		$('#s_curr').load(path+'index.php/upload/currenciesByCountry', {categories_countries:id_c , category: 1});
		
		/*
		$("#catalog-code").load(path+'ajax/upload/catalogCodeByCountry.php',{country:id_c} , function(){
			
			if ( catalog_code.innerHTML.length > 0 ) 
				$("#catalog-tr").css({display:'table-row'});
			else
				$("#catalog-tr").css({display:'none'});
		});
		
		$('#system').prop('disabled',false);
		setSystemType( document.getElementById('system') );
		*/
	}
	else{
		document.getElementById('s_curr').innerHTML = '<select disabled="disabled" id="currency" name="currency">';
		document.getElementById('s_curr').innerHTML += '<option selected="selected" value="-1"><?php echo $this->lang->line(\'seleccione\'); ?></option></select>';
	}
	
}
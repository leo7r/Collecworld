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
	
	if ( $("#countries").val() == -1 ){
		text+='-<?php echo $this->lang->line(pais_no_valido)."</br>"; ?>';
	}
	if ( $("#company").val() == -1 ){
		text+='-<?php echo $this->lang->line(compania_no_valida)."</br>"; ?>';
	}
	if ( $("#system").val() == -1 ){
		text+='-<?php echo $this->lang->line(sistema_no_valido)."</br>"; ?>';
	}
	if ( $("#phonecard_name").val().length == 0 ){
		
		text+='-<?php echo $this->lang->line(nombre_no_valido)."</br>"; ?>';
	}
	if ( $("#date_year").val().length == 0 && $("#date_ex_year").val().length == 0 ){
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
		
		$("#phonecard_name,#countries,#companies,#currency,#system,#serie,#serie_n,#serie2,#serie_n2,#printRun,#printRun2,#faceValue,#tag0,#tag1,#tag2,#tag3").prop('disabled', false);
		$("#date_year,#date_month,#date_day,#date_known_year,#date_known_month,#date_known_day,#date_ex_year,#date_ex_month,#date_ex_day,#order_n").prop('disabled',false);
		
		$("#uploading-images").css({ display: 'inherit' });
		$("#form0").submit();
	}
	else{
		showGlobalInfo(text);
	}
}

// Cosas que hacer una vez que seleccionas un pais, sirve para editar y para subir
function phonecard_onCountrySelected( dom ){
	
	id_c = $(dom).val();
	
	if ( id_c != -1 ){
		
		
		$('#company').load(path+'upload/phonecard_companyByCountry', { categories_countries:id_c },function(){
			$(this).prop('disabled',false);	
		});
		
		$('#currency').load(path+'upload/currenciesByCountry', {categories_countries:id_c , category: 1},function(){
			$(this).prop('disabled',false);
		});
		
		$('#system').prop('disabled',false);
		
		$("#catalog").load(path+'upload/phonecard_getCatalogsByCountry',{categories_countries:id_c},function(){
			$(this).prop("disabled",false);			
			loadCatalogSection( 1 , null );
		});
		
		/*		
		setSystemType( document.getElementById('system') );
		*/
	}
	
}

// Dado un sistema, cargar las variantes si son pertinentes
function setSystemType( dom ){
		
	index = dom.selectedIndex;
	index_c = document.getElementById('countries').selectedIndex;
	
	// Sistema
	id_s = parseInt(dom.options[index].value);
	
	// Pais
	id_c = parseInt(document.getElementById('countries').options[index_c].value);
	
	switch ( id_s ){
		
		case 1:
			$("#variation1_list").load(path+'upload/phonecard_typesBySystem',{system:id_s,country:id_c});
			$("#variation1").css({display:'table-row'});
			$("#variation2").css({display:'table-row'});
			//$("#variation3_text").html('<?php echo $this->lang->line("variacion_descriptiva"); ?>:');				
			//$("#variation3_info").html('<?php echo $this->lang->line("ayuda_variante_descriptiva"); ?>');
			break;
		case 2:
		case 4:
			$("#variation1 , #variation2").css({display:'none'});
			//$("#variation3_text").html('<?php echo $this->lang->line("variacion_descriptiva"); ?>:');				
			//$("#variation3_info").html('<?php echo $this->lang->line("ayuda_variante_descriptiva"); ?>');
			break;
			
		default:
			$("#variation1 , #variation2").css({display:'none'});
			break;
		
	}
	
}

// Mostrar la lista de variantes de sistema
function showSystemTypes(){

	if ( $("#variation1_list").css('display') == 'none' ){
		$("#variation1_list").css({ display:'' });
	}
	else{
		$("#variation1_list").css({ display:'none' });
	}
}

// Mostrar la lista de logos
function showLogoTypes(){

	if ( $("#variation2_list").css('display') == 'none' ){
		$("#variation2_list").css({ display:'' });
	}
	else{
		$("#variation2_list").css({ display:'none' });
	}
}

// Funcion que carga las secciones de un catalogo
function loadCatalogSection( level , parent ){
	
	sel = document.createElement('select');
	$(sel).addClass("catalog-select");
	$(sel).attr("name","section_"+level);
	$(sel).attr("id","section_"+level);
	
	// Si estoy seleccionando catalogo, borro todo lo que habia previamente
	if ( level == 1 && !parent ){
		for ( i = 1 ; i < 10 ; i++ ){
			$( "select[name^='section_"+(level+i)+"']" ).remove();
		}
		
		$( "input[name='catalog_code']" ).remove();
	}
	
	$(sel).load(path+'upload/phonecard_loadCatalogSection',{id_catalog:$("#catalog").val(),level:level,parent:parent},function(){
		
		$("#catalog").parent().append(this);
		
		// Si no tiene opciones, quiere decir que es final asi que muestro el codigo
		if ( $("select#section_"+level+" option").length  == 0 ){
			code = document.createElement('input');
			$(code).attr("type","text");
			$(code).attr("name","catalog_code");
			$(code).addClass("upload-num");
			$("#catalog").parent().append(code);
			$(this).remove();
			return;
		}
		
		$(this).change(function(){
			
			// Si estoy seleccionando, borro todo lo que habia que fuese de otra seccion mas adelante
			for ( i = 1 ; i < 10 ; i++ ){
				$( "select[name^='section_"+(level+i)+"']" ).remove();
			}
			
			$( "input[name='catalog_code']" ).remove();
			
			// Cargo las secciones
			loadCatalogSection(level+1,$(this).val());
		});
		
		// Si solo hay una opcion, selecciona de una vez.
		if ( $("select#section_"+level+" option").length  == 1 ){
			loadCatalogSection(level+1,$(this).val());
		}
				
	});
		
}

// Funcion para abrir el siguiente tag
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
	
	if ( num < 3 ){
		$('#tag_tr'+(num+1)).css({display:''});
	}
}

// Permite solo numeros en un input de texto
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

// Verifica que un campo de fecha sea coherente
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
	if( !type_regex.test(value) ) {
		$(dom).val(value.substr(0,value.length-1));
	}
}

// Pasa de input en fechas cuando ya esta llena
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

// Auxiliar para pasar de input en fechas cuando ya esta llena
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

// Auxiliar para pasar de input en fechas cuando ya esta llena
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

// Permite que selecciones una sola variante de la lista
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
/*

AQUI VAN FUNCIONES GENERALES

- Cosas que se utilizan en dos paginas o mas
- Funciones generales tipo header, footer

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

/* Variables globales */
var local = true;
var path = local ? 'http://localhost/collecworld/' : 'http://collecworld.com/';
var first = true;
var menu0;

// TRADUCCIONES
var translations = ['mi_cuenta','mis_colecciones','amigos','eventos','comercios','mensajes','configuracion','ayuda','cerrar_sesion','no_es_buena_idea','es_una_idea_corta','informacion_sistema_pronto_disponible','informacion_logo_pronto_disponible','gracias_por_suscribirte','correo_ya_suscrito','correo_invalido','pais_compania_sistema_campo_obligatorio','explorar_memoria_remota_ano_obligatorio','cerrar','error','articulo_agregado','escribe_una_nota','estado_tarjeta','nueva','usada_perfecta','usada_buena','usada_danada','agregar_otra','listo','imagen','coleccion','deseo','intercambio','venta','eliminar','cancelar','activado','desactivado','seguro_deseas_eliminar_a','de_tus_amigos','selecciona_categoria_primero','catalogo_sistema_pais_compania_obligatorio','memoria_remota','chip','sistema_inducido','sistema_optico','banda_magnetica','tarjetas_fecha','tarjetas_sin_fecha','tarjetas_uso_interno','tarjetas_especiales','explore_phonecards_todos_ano','explore_phonecards_desconocido','comentario_debe_tener','ya_escribiste_ese_comentario','escribe_mensaje','mensaje_enviado','editada','lista_no_puede_editar','lista_creada','lista_ya_existe','pais_titulo_obligatorio'];
var translation;
loadTranslation();

// Funcion que se llama en todas las paginas, maneja JS generales tipo el menu de usuario, etc.
// Agregar mas cosas si es necesario en todas las paginas
function pageInit(){
	$(document).ready(function(){
		
		// Poder cerrar el menu de usuario tocando en otro lado
		$("#content-in,#top").click(function(){
			closeMenu();
		});
		
		setPlaceHolder('search');
		
		// Notificacion de informacion
		var info = $(document).getUrlParam("info");		
		if ( info ){
			info = info.replace(/%20/g,' ');
			showGlobalInfo(info);
		}
	});
}

// Funcion que se llama antes de cualquier llamada JS para una pagina que lanza
// un modal de Feedback, Login o alguna categoria.
function modalInit(){
	
	$(document).ready(function(){

		$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });		

		$('#modal-close').click(function(){
			$("#lean_overlay").click();
		});					

		$("#content-in,#top").click(function(){
			closeMenu();
		});	

	});
}

// Funcion para iniciar un mensaje de error en una pagina que lo pueda generar, se deberia llamar en casi todas las paginas.
// Agregar mas tipos de errores si es necesario
function errorInit(){
	
		var err = parseInt($(document).getUrlParam("err"));

		switch ( err ){
			case 0:
				showGlobalInfo('User or password not valid.');
				break;
			case 1:
				showGlobalInfo('The email you submited is already registered.');
				break;
		}		
}

//Funcion que guarda el lenguaje seleccionado en session y luego traduce la pagina
function switch_language( dom ){
	
	lang = $(dom).val(); 
	
	$.ajax({
		type: "POST",
		url: path+"switch_language",
		data: { lang: lang }
	}).done(function( msg ) {
		//alert("MSG: " + msg); 
		
		location.href = path+'change_language';
		 
	});
	
}

// Funcion que genera el modal para Tarjetas telefonicas
function modalPhonecard( _p ){
	$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p},function(){
		$("#modalP").click();
	});
}

// Funcion que genera el modal para Feedback
function modalFeedback( ){
	
	$("#modal-feedback").load(path+'general_feedback',{},function(){
		$("#modalF").click();
	});
}

// Funcion para colocar el placeHolder de un campo de texto
function setPlaceHolder( id ){
	
	var standard_message = $('#'+id).val();
	$('#'+id).css({color:'#999'});
	
	$('#'+id).focus(
		function() {
			if ($(this).val() == standard_message)
				$(this).val("");
				$(this).css({color:'#333'});
		}
	);

	$('#'+id).blur(
		function() {
			if ($(this).val() == ""){
				$(this).val(standard_message);
				$(this).css({color:'#999'});
			}
		}
	);	

}

// Funcion para cerrar el menu de usuario
function closeMenu(){
	$(".menu-drop").fadeOut('fast');
}

// Funcion para cargar la traduccion de Google
function googleTranslateElementInit() {
	new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
}

// Funcion para enviar un feedback, debe estar abierto el modal de feedback
function sendFb( user ){
	text = $("#feedback-content-in").val();
	
	if ( text.length > 10 ){
		url = document.URL.split('?');
		url = url[0];
		$("#onFinish").val(url);
		document.getElementById('feedback-form').submit();
		
	}
	else{
		alert('Feedback too short');
	}
	
}

// Funcion para mostrar mensaje en el top de la pagina.
function showGlobalInfo( info ){

	div_out = document.createElement('div');
	div_out.className='glob';

	$(".glob").remove();

	div = document.createElement('div');
	div.innerHTML = info;
	div.className = 'glob-info';
	
	div_out.appendChild(div);
	document.getElementById('top').appendChild(div_out);
	
	$(div_out).css({top:-10});
	$(div_out).animate({top:+10},100);

	$(div_out).click(function(){
		$(".glob").animate({opacity:0},300,function(){

			$(this).remove();									 

		});
	});
}

// Funcion para mostrar el menu de usuario
function launchMenu(){
	
	dom = document.getElementById('user-in');

	if ( first ){
		
		first = false;
		var div = document.createElement('div');
		div.className = 'menu-drop';
		$(div).css({top:'30px',right:'80px'});
		$(div).animate({top:'40px'},150);

						

		for ( i=0  ; i < menu0.length ; i++ ){
			
			tok = menu0[i].split('$');
			var a_itm = document.createElement('a');
			a_itm.href = tok[1];
			var itm = document.createElement('div');

			itm.style.cursor = 'pointer';
			itm.className = 'menu-item';

			if ( i % 2 == 0 ){
				itm.className = itm.className+' odd';
			}
			itm.innerHTML = tok[0];
			a_itm.appendChild(itm);
			div.appendChild(a_itm);

		}
		
		dom.appendChild(div);
	}
	else{
		$(".menu-drop").fadeOut('fast');
		first = true;
	}

}

// Carga las traducciones para ser usadas en el js, genera el menu de usuario
function loadTranslation(){
	
	div = document.createElement('div');
	
	$.ajax({
		type: "POST",
		url: path+"loadTranslation",
		data: { trans: translations.join('$') }
	}).done(function( msg ) {
		translation = JSON.parse(msg);
		
		menu0 = [
			translation.mi_cuenta+"$"+path+"index.php/account",
			translation.mis_colecciones+"$"+path+"index.php/account/#sec=1",
			translation.amigos+"$"+path+"index.php/account/#sec=2",
			translation.eventos+"$"+path+"index.php/account/#sec=3",
			translation.comercios+"$"+path+"index.php/account/#sec=4",
			translation.mensajes+"$"+path+"index.php/account/#sec=5",
			translation.configuracion+"$"+path+"index.php/account/#sec=7",
			translation.ayuda+"$"+path+"index.php/help",
			translation.cerrar_sesion+"$"+path+"index.php/out"
			];
	});
}

// Funcion para obtener info pasada como Hash (#) por la barra del navegador
function getHash( id ){
	
	try {
		var hash = window.location.hash;
		ret = hash.split(id+"=");
		ret = ret[1];
		ret = ret.split("&");
		ret = ret[0];

		return ret;
	}
	catch( e ){
		return false;
	}
}

function showInfo( dom , info ){

	var x = $(dom).position().left;
	var y = $(dom).position().top;
	var height = $(dom).height();

	out_div = document.createElement('div');

	$(out_div).addClass('out-new-info');

	pointer = document.createElement('div');
	$(pointer).addClass('new-info-pointer');
	div = document.createElement('div');
	div.innerHTML = info;

	$(div).addClass('new-info');

	$(out_div).css({ position: 'absolute' , left: x , top: y+height+3});
	out_div.appendChild(pointer);
	out_div.appendChild(div);
	document.getElementById('content').appendChild(out_div);

	fun = function(){$(".out-new-info").animate({opacity:0},100,function(){$(this).remove();});}

	$(dom).mouseout( fun );
}


function showInfo3(dom , num , id , float){
		
	var x = $(dom).position().left;
	var y = $(dom).position().top;
		
	out_div = document.createElement('div');
	$(out_div).addClass('new-info2');
	$(out_div).addClass('out-new-info');
	
	$(out_div).load(path+'upload/info_chip_logo',{num:num,id:id,src:dom.src},function(){
		
		if ( float ){
			$(out_div).css({ position: 'absolute' , left: x+80 , top: y});
			dom.parentNode.appendChild(out_div);
		}
		else{
			dom.parentNode.appendChild(out_div);
		}
		
		fun = function(){$(".out-new-info").animate({opacity:0},300,function(){$(this).remove();});}
		$(dom).mouseout( fun );
	});
}


function showInfo2( dom , info , num ){

	var x = $(dom).position().left;
	var y = $(dom).position().top;
	out_div = document.createElement('div');

	$(out_div).addClass('out-new-info');

	if ( num == 2 || num == 3 )
		$(out_div).css({position:'fixed'});

	div = document.createElement('div');
	left = document.createElement('div');
	left.innerHTML = '<img src="'+dom.src+'" />';
	$(left).addClass('new-info2-left');

	if ( num == 1 || num == 3 )
		$(left).addClass('logo-img');

	right = document.createElement('div');

	if ( num == 0 || num == 2 )
		right.innerHTML = translation.informacion_sistema_pronto_disponible;
	else
		right.innerHTML = translation.informacion_logo_pronto_disponible;
	
	$(right).addClass('new-info2-right');
	
	div.appendChild(left);
	div.appendChild(right);
	$(div).addClass('new-info2');

	if ( num == 0 || num == 1 )
		$(out_div).css({ left: x+50 , top: y-(25+50) });
	else
		$(out_div).css({ left: x+300 , top: y-(25+10) });

	out_div.appendChild(div);

	document.getElementById('content').appendChild(out_div);
	fun = function(){$(".out-new-info").animate({opacity:0},300,function(){$(this).remove();});}

	$(dom).mouseout( fun );
}

function showInfoAndBanish( dom , top , left , title , info ){

	msg = '<strong>'+title+': </strong><br><p>'+info+'</p>';

	var x = $(dom).position().left;
	var y = $(dom).position().top;

	div = document.createElement('DIV');
	div.className = 'infoo alert n-info';
	div.innerHTML = msg;
	document.getElementById('content').appendChild(div);

	x0 = ( x > ($(window).width()/2) ) ?  (x+left)+'px' : (x+left)+'px' ;
	y0 = ( y > ($(window).height()/2) ) ? y-($(div).height()+top)+"px" : y+($(div).height()+top)+"px" ;

	$(div).css({ left: x0 , top: y0 });
	$(div).delay(4000).animate({opacity:0},500,function(){$(this).remove();});
}

function showInfoAndBanishAbsolute( _top , _right , title , info ){

	msg = '<strong>'+title+': </strong><br><p>'+info+'</p>';
	div = document.createElement('DIV');
	div.className = 'infoo alert n-info';
	div.innerHTML = msg;
	document.getElementById('content').appendChild(div);
	$(div).css({ right: _right , top: _top });
	$(div).delay(4000).animate({opacity:0},500,function(){$(this).remove();});
}

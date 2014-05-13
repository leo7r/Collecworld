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

// Funcion que genera el modal para Tarjetas telefonicas
function modalPhonecard( _p ){
	$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p},function(){
		$("#modalP").click();
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
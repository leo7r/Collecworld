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
				$("#content-in").load(path+'upload/phonecards');
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
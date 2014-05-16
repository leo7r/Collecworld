/*

AQUI VAN FUNCIONES DE USUARIOS

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

function profileMenu( index ){

	deleteHash('don');
	$(".menu-item-active").removeClass('menu-item-active');

	var divs = document.getElementById('account-content-left').getElementsByTagName('div');

	if ( index < 9 ){
		$(divs[index]).addClass('menu-item-active');
	}

	switch ( index ){

		case 1:
			$("#account-content-right").load(path+'ajax/account/overview.php');
			break;
		case 2:
			$("#account-content-right").load(path+'profile/collection');
			break;
		case 3:
			$("#account-content-right").load(path+'ajax/account/friends.php');
			break;
		case 4:
			$("#account-content-right").load(path+'ajax/account/events.php');
			break;
		case 5:
			$("#account-content-right").load(path+'ajax/account/trades.php');
			break;
		case 6:
			$("#account-content-right").load(path+'ajax/account/messages.php');
			break;
		case 7:
			$("#account-content-right").load(path+'ajax/account/notifications.php');
			break;
		case 8:
			$("#account-content-right").load(path+'ajax/account/settings.php');
			break;
		case 9:
			$("#account-content-right").load(path+'ajax/account/edit.php');
			break;
	}

	if ( index != 0 )

		setHash('sec='+index);

	else

		deleteHash('sec');

}


function setHash( hash ){

	tok = hash.split('=');

	if ( window.location.hash.search(tok[0]) != -1 )
		deleteHash(tok[0]);


	if ( window.location.hash )
		window.location.hash+="&"+hash;
	else
		window.location.hash+=hash;

}



function deleteHash( itm ){

	hash = window.location.hash;

	tok = hash.split('&');

	nhash = '';


	for ( i=0 ; i<tok.length ; i++ ){

		if ( tok[i].search(itm) == -1 ){

			nhash+=tok[i]+'&';

		}
	}
	nhash = nhash.substr(0,nhash.length-1);

	window.location.hash = nhash;

}


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

function newList( category ){
	$("#account-content-right").load(path+'profile/collection/new_list',{category:category});
}


function createList( category ){	

	var name = document.getElementById('list_name').value;
	var priv = document.getElementById('list_priv').value;
	var id_user = document.getElementById('id_user').value;
	
	var div = document.createElement('div');

	$(div).load(path+'profile/collection/insert_list',{category:category, name:name, priv:priv, id_user:id_user},function(){
	 
		if(div.innerHTML==false){
			
			showGlobalInfo(translation.lista_ya_existe);
			
		}else{ 
			
			$("#account-content-right").load(path+'profile/collection/view_list',{id_lists:div.innerHTML},function(){ 
				showGlobalInfo(translation.lista_creada);
			
			});
		} 

	});

}

function viewList( dom ){
	
	list = $(dom).val(); 
	
	$("#account-content-right").load(path+'profile/collection/view_list',{id_lists:list});
}

function editList(){	

	var name = document.getElementById('list_name').value;
	var privacy = document.getElementById('list_priv').selectedIndex;
	var id_lists = document.getElementById('id_lists').value;
	var id_users = document.getElementById('id_users').value;
	
	var div = document.createElement('div');
	 
	$(div).load(path+'profile/collection/edit_list',{name:name, privacy:privacy, id_lists:id_lists, id_users:id_users},function(){ 
	 	if(div.innerHTML==false){
			
			showGlobalInfo(translation.lista_ya_existe);
			
		}else{ 
		
			profileMenu(2);
	
			showGlobalInfo(div.innerHTML+' '+translation.editada);	
		}
	});

}

//EXPLORAR LISTAS
 
function collectionListShowCatalogs( id_lists, id_countries ){	
  	 
	$("#collection-list-content").load(path+'profile/collection/show_catalogs',{id_lists:id_lists, id_countries:id_countries});

}

function collectionListShowCirculations( id_lists, id_countries ){	
  	 
	$("#collection-list-content").load(path+'profile/collection/show_circulations',{id_lists:id_lists, id_countries:id_countries});

}

function collectionListShowCompanies( id_lists, id_countries, phonecards_circulation ){	
  	 
	$("#collection-list-content").load(path+'profile/collection/show_companies',{id_lists:id_lists, id_countries:id_countries, phonecards_circulation:phonecards_circulation});

}

function collectionListShowSystems( id_lists, id_countries, phonecards_circulation, id_phonecards_companies ){	
  	 
	$("#collection-list-content").load(path+'profile/collection/show_systems',{id_lists:id_lists, id_countries:id_countries, phonecards_circulation:phonecards_circulation});

}




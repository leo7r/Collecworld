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





var first = true;

var path = 'http://collecworld.com/';
var menu0;

var translations = ['mi_cuenta','mis_colecciones','amigos','eventos','comercios','mensajes','configuracion','ayuda','cerrar_sesion','no_es_buena_idea','es_una_idea_corta','informacion_sistema_pronto_disponible','informacion_logo_pronto_disponible','gracias_por_suscribirte','correo_ya_suscrito','correo_invalido','pais_compania_sistema_campo_obligatorio','explorar_memoria_remota_ano_obligatorio','cerrar','error','articulo_agregado','escribe_una_nota','estado_tarjeta','nueva','usada_perfecta','usada_buena','usada_danada','agregar_otra','listo','imagen','coleccion','deseo','intercambio','venta','eliminar','cancelar','activado','desactivado','seguro_deseas_eliminar_a','de_tus_amigos','selecciona_categoria_primero','catalogo_sistema_pais_compania_obligatorio','memoria_remota','chip','sistema_inducido','sistema_optico','banda_magnetica','tarjetas_fecha','tarjetas_sin_fecha','tarjetas_uso_interno','tarjetas_especiales','explore_phonecards_todos_ano','explore_phonecards_desconocido','comentario_debe_tener','ya_escribiste_ese_comentario','escribe_mensaje','mensaje_enviado','editada','lista_no_puede_editar','lista_creada','lista_ya_existe','pais_titulo_obligatorio'];
var translation;
loadTranslation();

function loadTranslation(){
	
	div = document.createElement('div');
	$(div).load(path+'ajax/loadTranslation.php',{ trans: translations.join('$') },function(){
		
		translation = JSON.parse(div.innerHTML);
		
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

			

			if ( i % 2 == 0 )

				itm.className = itm.className+' odd';

				

			

			itm.innerHTML = tok[0];

			

			a_itm.appendChild(itm);

			div.appendChild(a_itm);

		}

		

		dom.appendChild(div);

		

		//setTimeout("launchMenu(this);",5000);

		

	}

	else{

		$(".menu-drop").fadeOut('fast');

		first = true;

	}

}

function showUploadImage(){
		$("#show-img").hover(function(){

			$("#upload-new-img").animate({
 			width: "295px",
 			height:"40px",
   			opacity: 0.8,
    		fontSize: "2em",
			},100);
		});

		$("#show-img").mouseleave(function(){

			$("#upload-new-img").animate({
 			width: "150px",
 			height:"30px",
    		fontSize: "1.2em",
			},100);
		});
}

function closeMenu(){

	$(".menu-drop").fadeOut('fast');

	first = true;	

}



function setSignup( ){

	$("#modal-loading").css({display:"inherit"});

	$("#modal-loading").animate({opacity:1},300);

	$("#modal-signin").load(path+'ajax/signup/index.php',{path:path});

}



function toSignin( ){

	$("#modal-signin").load(path+'ajax/signin/index.php',{path:path});

}



function closeSignin(){

	$("#lean_overlay").click();

}



function feedbackText( ){

	

	text = document.getElementById('feedback-text');

	

	if( $(text).height() == 20 ){

		

		$(text).animate({color:"#fff"},300,function(){

											text.innerHTML='';

											$(text).animate({color:"#555"},100);

										});

		

		$(text).animate({

			height: '+=60'

		}, 500 );

	}

	else{

		

	}

	

}



function sendFeedback( _user ){

	

	text = document.getElementById('feedback-text');

	

	if ( text.value.length > 20 && text.value.search('What\'s on your mind?') == -1 ){

		

		div = document.getElementById('feedback');

		var old = div.innerHTML;

		$(div).animate({opacity:0},300,function(){

													$(div).load('p-feedback.php',{idea:text.value, fromuser:_user },function(){

																						$(div).animate({opacity:1},300);

																						});

													

												});	

		

		setTimeout(function(){div.innerHTML = old;},4000);

		

	}

	else{

		

		btn = document.getElementById('feedback-go');

		old = btn.value;

		

		if ( text.value.length > 20 ){

			btn.value = translation.no_es_buena_idea;

		}

		else{

			btn.value = translation.es_una_idea_corta;	

		}

		

		feedbackText();

		text.focus();

		

		setTimeout('btn.value=old',4000);

	}

}

function subscribe_key_up(){

	

	if ( event.keyCode == 13 ){

		subscribe();	

	}

}



function subscribe(){

	

	mail = document.getElementById('footer-subsrcibe-email');

	

	if ( mail.value.length > 0 && mail.value.search('[a-zA-Z]+[a-zA-Z0-9_\.]*@[a-zA-Z0-9]{3,}\.[a-zA-Z]{2,}') == 0  ){

		div = document.createElement('div');

		$(div).load(path+'ajax/subscribe.php',{mail:mail.value} , function(){

			

			if ( this.innerHTML.search('ok') != -1 ){

				showGlobalInfo(translation.gracias_por_suscribirte);

				$(mail).val('');

			}

			else{

				if ( this.innerHTML.search('duplicated') != -1 ){

					showGlobalInfo(translation.correo_ya_suscrito);

				}

				else{

					alert(translation.error);

				}

			}

			

		});

	}

	else{

		showGlobalInfo(translation.correo_invalido);

	}

	

}



var _cat = '';



function exploreSteps( dom ){

	

	$(".box2-pointer").remove();

	$("#explore-help").remove();

	_cat = dom.value;

	

	if ( dom.selectedIndex != 0 ){

		div = document.createElement('div');

		div.id = 'explore-help';

		$(div).addClass('box2');

		document.getElementById('explore-content').innerHTML = '<img src="'+path+'img/ajax-loader.gif" />';

		

		$(div).load(path+'ajax/explore/explore-phonecards.php' , { cat: dom.value } , function(){

													document.getElementById('explore-content').innerHTML = '';

													document.getElementById('explore-info').innerHTML = '';

													sql_phonecards = '';

													

													pointer = document.createElement('div');

													$(pointer).addClass('box2-pointer');

													

													document.getElementById('explore-content').innerHTML = '';

													document.getElementById('explore-content').appendChild(pointer);

												  	document.getElementById('explore-content').appendChild(div);

													

													setHash('cat='+dom.selectedIndex);

													

													cou = getHash('countries');

													if ( cou ){

														sel = document.getElementById('pc-countries');

														sel.selectedIndex = cou;

														

														exploreAddPhonecards(sel,'countries');

													}

													

													sys = getHash('systems');

			

													if ( sys ){

														sel = document.getElementById('pc-systems');

														sel.selectedIndex = sys;

														exploreAddPhonecards(sel,'systems');

													}

													

													years = getHash('years');

			

													if ( years ){

														sel = document.getElementById('pc-years');

														sel.selectedIndex = years;

														exploreAddPhonecards(sel,'years');

													}

												   

												   });

	}

}



var sql_phonecards = '';



function exploreAddPhonecards( dom , name ){

	

	info = document.getElementById('explore-info');

	txt = dom.value;

	

	opts = dom.getElementsByTagName('option');

	txt2 = '';

	

	for (i=0 ; i< opts.length ; i++){

		

		opt = opts[i].value;

		

		if ( opt == txt ){

			txt2 = opts[i].innerHTML;

			break;

		}

		

	}

	

	//txt2 = dom.innerHTML.split('<option value="'+txt+'">')[1].split('<')[0];



	info.innerHTML+='&nbsp;&nbsp;<b style="color:#06f">'+name+':</b> '+txt2+'&nbsp;&nbsp;';



	if ( name == 'years' ){

		if ( sql_phonecards.search('=') != -1 )

			sql_phonecards+=' AND '+name+' like "'+txt+'%" ';

		else

			sql_phonecards+=name+' like "'+txt+'%" ';

	}

	else{

		if ( sql_phonecards.search('=') != -1 || sql_phonecards.search('like') != -1 )

			sql_phonecards+=' AND '+name+' = '+txt+' ';

		else

			sql_phonecards+=name+' = '+txt+' ';

	

	}

	

	dom.parentNode.parentNode.parentNode.removeChild(dom.parentNode.parentNode);

	//info.innerHTML = sql_phonecards;

	//$(parent).remove();

	

	setHash(name+'='+dom.selectedIndex);

	

	if ( name == 'countries' ){

		$('#pc-companies').removeAttr('disabled');

		$('#pc-companies').load(path+'ajax/explore/companiesByCountries.php',{ id : txt });

	}

	

	if ( name == 'companies' ){

		$('#pc-series').removeAttr('disabled');

		$('#pc-series').load(path+'ajax/explore/seriesByCompanies.php',{ id : txt });

	}

	

}



/*function catalog_allow_one( dom ){

	

	ne = document.getElementById('not_emmited');

	es = document.getElementById('especial');

	

	if ( dom.id == "especial" ){

		

		if ( dom.checked ){

			ne.checked = false;

		}

		else{

			if ( !ne.checked )

				es.checked = false;

			else

				ne.checked = true;

		}

		

	}

	else{

		if ( dom.checked ){

			es.checked = false;

		}

		else{

			if ( !es.checked )

				ne.checked = false;

			else

				es.checked = true;

		}

	}

	

}
*/


function goPhonecards( pag ){

	

        try{

		notEmmited = document.getElementById("not_emmited").checked;

		if ( notEmmited ){

			notEmmited = '1';

                     

                }

                else{

                       notEmmited = "0";

                }

	}

	catch(err){

		notEmmited = '0';

	}

	

	/*try{

		esp = document.getElementById("especial").checked;

		if ( esp ){

			especial = '1';

		        notEmmited = '0';

                }

                else{

                       especial = "0"

                }

	}

	catch(err){

		especial = '0';

	}
*/


	setHash('pag='+pag); 

	if ( sql_phonecards.search('countries') == -1 || sql_phonecards.search('companies') == -1 || sql_phonecards.search('systems') == -1 ){

		alert(translation.pais_compania_sistema_campo_obligatorio);

		return;

	}

	

	if ( sql_phonecards.search('systems = 4') != -1 ){

		

		if ( sql_phonecards.search('years') == -1 ){

			alert(translation.explorar_memoria_remota_ano_obligatorio);


			return;

		}

		

	}



	document.getElementById('explore-content').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';

	$("#explore-content").load(path+'ajax/explore/goPhonecards.php',{where: sql_phonecards , not_emmited: notEmmited , especial:especial , pag: pag});



}

function showOtherList( dom , category , item_id ){
	
	$("#note-cont").remove();
	div = document.createElement('div');
	div.id = "note-cont";
	var container = dom.parentNode;
	
	$(div).load(path+'ajax/load_other_list.php',{category:category,item_id:item_id} , function(){
		container.appendChild(div);
	});
	
}

function  CloseOtherList(){
	$("#note-cont").remove();
}

function addItemOtherList( category , list , id_item ){
	
	div = document.createElement('div');
	
	$(div).load(path+'ajax/changeLists.php',{category:category,list:list,id_item:id_item},function(){

		if ( div.innerHTML == 'false' ){ 
		
		
			document.getElementById('list'+list).className = 'list-row';
		}else{
			document.getElementById('list'+list).className += ' have-this-in-list';
		}
	});
	
}

function save_note( dom , category , id , list , type , ex ){

	var note = document.getElementById('note').value;
	
	var status = '';	
	var currencies = '';
	var price = '';	

	switch(list){

		case 1 :{

			//Collection 
			
 			var status = document.getElementById('status').value;
			
		}

		break; 
		case 3:
		case 5:{

			//Swap and Sell

			status = document.getElementById('status').value;
			
			if ( list == 5 ){
				currencies = document.getElementById('currencies').value;
				price = document.getElementById('price').value;
			}
			
			var input = document.getElementById("image-note");
 			var image = input.files; 
			
			var data = new FormData();
			data.append('image[0]',image[0]);
			data.append('status',status);
			data.append('category',category);
			data.append('list',list);
			data.append('id',id);
			data.append('note',note);
			
			if ( list == 5 ){
				data.append('currencies',currencies);
				data.append('price',price);
			}
			
			$(div).load(path+'ajax/verify_list2.php',{category:category,id:id,list:list},function(){
				
				cont = document.getElementById(dom);
				dom = cont.childNodes[1];
				
				if ( dom.src.search('2.png') == -1 ){
					$(dom).addClass('checked');
					dom.src = dom.src.replace('.png','2.png');
					
					if ( type ){
						$(dom.parentNode).addClass('checked');
					} 
				}
								
			});

			$.ajax({
				url:path+'ajax/save_note.php', //Url a donde la enviaremos
				type:'POST', //Metodo que usaremos
				contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:data, //Le pasamos el objeto que creamos con los archivos
				processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false //Para que el formulario no guarde cache
			  }).done(function(msg){
				  
				if ( msg.search('true') == -1 ){ 
					//alert(msg);
					datos = msg.split('-');
					
					//alert(msg);
		
					document.getElementById('alert').innerHTML='<span class="AlertNote" style="color:#f00;">'+datos[1]+'</span>';	
						
					setTimeout( function( ){ 
				
						$(".AlertNote").animate({opacity:0},300,function(){
				
							$(this).remove();									 
				
						}); 
				
					} , 2000);
				 
				}else{
				
					if(ex == 1){
						
						cont = document.getElementById( 'note-cont' );
						cont.parentNode.removeChild( cont );
						
					}else{
						document.getElementById('alert').innerHTML='<span class="AlertNote" style="color:#04B404;">'+translation.articulo_agregado+'</span>';	 
						setTimeout( function( ){ 
							 
							$(".AlertNote").animate({opacity:0},300,function(){
					
								$(this).remove();									 
					
							});
					 
						} , 2000);	
								
						document.getElementById('note').value='';
						document.getElementById('status').value='';
						document.getElementById('image-note').value='';
						document.getElementById('feedback-file-name').innerHTML='';
												
					}
					
				}
				
			  });
			  
			return;
		}

		break;

	}

	

	div = document.createElement('div');	
	
	$(div).load(path+'ajax/verify_list2.php',{category:category,id:id,list:list},function(){
		
		//alert(div.innerHTML);
		
		cont = document.getElementById(dom);
		dom = cont.childNodes[1];
		
		if ( dom.src.search('2.png') == -1 ){
			$(dom).addClass('checked');
			dom.src = dom.src.replace('.png','2.png');
			
			if ( type ){
				$(dom.parentNode).addClass('checked');
			} 
		}
		
	});

	$(div).load(path+'ajax/save_note.php',{id:id, category:category, list:list, note:note, status:status, currencies:currencies, price:price },function(){ 
	 
		if ( div.innerHTML.search('true') == -1 ){ 
		
			datos = div.innerHTML.split('-');
		
			document.getElementById('alert').innerHTML='<span class="AlertNote" style="color:#f00;">'+datos[1]+'</span>';	
				
			setTimeout( function( ){
		
				
		
				$(".AlertNote").animate({opacity:0},300,function(){
		
					$(this).remove();									 
		
				});
		
				
		
			} , 2000);	
		
		
		}else{
			
			if(ex==1){
				
				cont = document.getElementById( 'note-cont' );
				cont.parentNode.removeChild( cont );
				
			}else{
				
				switch(list){

					case 1 :{
			
						document.getElementById('status').value='';
						
					}
			
					break; 
					case 3 :{
			
						document.getElementById('status').value='';
			
					}
			
					break; 
					case 5:{
			
						document.getElementById('status').value='';
			
						document.getElementById('currencies').value='';
		
						document.getElementById('price').value='';
			
			
					}
			
					break;
			
				}
				
				document.getElementById('note').value='';

				document.getElementById('alert').innerHTML='<span class="AlertNote" style="color:#04B404;">'+translation.articulo_agregado+'</span>';	
								
				setTimeout( function( ){
			
					
			
					$(".AlertNote").animate({opacity:0},300,function(){
			
						$(this).remove();									 
			
					});
			
					
			
				} , 2000);			
				
			}
			
		}

	});

	

}


function setItemInList( dom , category , list , item_id , type ){
	
	$("#note-cont").remove();

	div = document.createElement('div');
	
	$(div).load(path+'ajax/verify_list.php',{category:category,item_id:item_id,list:list},function(){
	
		var container = dom.parentNode;
		 
		if ( div.innerHTML.search('true') != -1 ){
			
			prefix = '';
			
			switch( category ){
				
				case 1:
					prefix = 'phonecard_';
					break;
				case 2:
					prefix = 'coin_';
					break;	
				case 3:
					prefix = 'banknote_';
					break;			
			}
			
			var inner = document.createElement("div");
			inner.id = "note-cont";
			container.appendChild(inner);
			
			fun = function(){
				$("#currencies").load(path+'ajax/explore/currencyNote.php');
			}
			
			var params = {
			container_id : container.id,
			item_id : item_id,
			type : type
			}
			
			switch( list ){
				
				case 1:
					$(inner).load(path+'ajax/add_to_list/'+prefix+'collection.php',params);
					break;
				case 2:
					$(inner).load(path+'ajax/add_to_list/'+prefix+'wish.php',params);
					break;
				case 3:
					$(inner).load(path+'ajax/add_to_list/'+prefix+'swap.php',params);
					break;
				case 5:
					$(inner).load(path+'ajax/add_to_list/'+prefix+'sell.php',params,fun);
					break;
			}
			
		}
		else{ 
		
			if ( div.innerHTML.search('error') == -1 ){
				
				var num_items = parseInt(div.innerHTML)
				
				if ( num_items < 2 ){
					DeleteFromList(container.id , category , list, item_id, type);
				}
				else{
				
					var inner = document.createElement("div");
					
					inner.id = "note-cont";
					$(inner).load(path+'ajax/add_to_list/delete_items.php',{container_id : container.id, category:category, item_id:item_id , type:type, list:list, num_items:num_items},function(){
						container.appendChild(inner);
					});
				}
			}
			else{
				alert(div.innerHTML);
				//location.href=path+'index.php/login';
			}
			
		}
	
	});
	
}

function DeleteFromList(dom, category , list, id, type){
	
	var div = document.createElement('div');
	
	$(div).load(path+'ajax/delete_item_from_list.php',{category:category,list:list, id:id},function(){
		
		cont = document.getElementById(dom);
	  
		dom = cont.childNodes[1];
		
		$(dom).removeClass('checked');  
		dom.src = dom.src.replace('2.png','.png');
		
		if ( type ){ 
		
			$(cont).removeClass('checked');

		}
		
		CloseOtherList();
		
	});
 	 
	
}


function upload0( dom ){

	index = dom.selectedIndex;

	opt = dom.options[index];

	

	if ( opt.value != -1 ){

		switch(parseInt(opt.value)){
			
			case 1 : 
				document.getElementById('content-in').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	
				$("#content-in").load(path+'ajax/upload/phonecards.php');
				break;
			
			case 2 :
			
				document.getElementById('content-in').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';

				$("#content-in").load(path+'ajax/upload/coins.php');
				break;
				
				
			case 3 :
			
				document.getElementById('content-in').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';

				$("#content-in").load(path+'ajax/upload/banknotes.php');
				break;
		}


	}

	else

		document.getElementById('content-in').innerHTML = '';

}



function resetUpload(){

	location.href = './';

}



function trm( str ){

	return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');

}



var backs = '';



function searchTop(){



	text = document.getElementById('search').value;

			

	if ( text.length < 3 ){

		showGlobalInfo("Agregar Palabra con mas de 3 Caracteres");

		return 'true';

	}

	

	s_text = text.split(' ').join('+');

	s_text = s_text.replace(/\+\+/g,'+');

	s_text = s_text.replace(/\+\+/g,'+');

	

	location.href = path+'index.php/search/'+s_text;

}



function searchInput( ){

	if ( event.keyCode == 13 ){

		searchTop();	

	}

}



function getVars() {

	

	qs = document.location.search;

	qs = qs.split("+").join(" ");

	

	var params = {},

		tokens,

		re = /[?&]?([^=]+)=([^&]*)/g;

		



	while (tokens = re.exec(qs)) {

		params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);

	}



	return params;

}



function flipImage( dom ){

	

	if ( $('#show-image').css('display') == 'inline-block' || $('#show-image').css('display') == 'inline' ){

		$("#show-image").css({display:'none'});
		$(".zoomContainer").remove();
		
		$("#show-image-rev").css({display:'inline-block'});
		
		if ( document.getElementById("show-image-rev").src.toString().search('default') == -1 ){
			$("#show-image-rev").elevateZoom({
			  zoomType : "lens",
			  lensShape : "round",
			  lensSize    : 250
			});	
		}
		
		$("#show-img-info").html('reverse');

		

		img = document.getElementById('show-image-rev').src;

		

		if (( img.search('default_phonecard') != -1 )||( img.search('default_coin') != -1)){

			$("#upload-new-img").css({display:'inline-block'});

			id_pc = $("#id-pc").val();

			$("#image-face").val(1);

		}

		else{

			$("#upload-new-img").css({display:'none'});

		}

		

	}

	else{

		$("#show-image-rev").css({display:'none'});
		$(".zoomContainer").remove();

		$("#show-image").css({display:'inline-block'});
		
		if ( document.getElementById("show-image").src.toString().search('default') == -1 ){
			$("#show-image").elevateZoom({
			  zoomType : "lens",
			  lensShape : "round",
			  lensSize    : 250
			});	
		}
		
		$("#show-img-info").html('anverse');

		

		img = document.getElementById('show-image').src;

		

		if (( img.search('default_phonecard') != -1 )||(img.search('default_coin') != -1 )){

			$("#upload-new-img").css({display:'inline-block'});

			id_pc = $("#id-pc").val();

			$("#image-face").val(0);

		}

		else{

			$("#upload-new-img").css({display:'none'});

		}

	}
	
	
}



function setSignup2( ){

	$("#go").click();

	setSignup(  );

}



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

	/*setTimeout( function( ){

		

		

		

	} , 2000);*/

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



function showSystemTypes( ){

	

	

	

	if ( $("#variation1_list").css('display') == 'none' )

		$("#variation1_list").css({ display:'' });

	else

		$("#variation1_list").css({ display:'none' });

}



function showLogoTypes(){



	if ( $("#variation2_list").css('display') == 'none' )

		$("#variation2_list").css({ display:'' });

	else

		$("#variation2_list").css({ display:'none' });

}



function addVariation( backs ){

	

	$("#pc-info").load(backs+'upload/variations.php');

}



function accountMenu( index ){

	deleteHash('don');
	$(".menu-item-active").removeClass('menu-item-active');

	var divs = document.getElementById('account-content-left').getElementsByTagName('div');

	if ( index < 9 ){
		$(divs[index+3]).addClass('menu-item-active');
	}

	switch ( index ){

		case 0:
			$("#account-content-right").load(path+'ajax/account/overview.php');
			break;
		case 1:
			$("#account-content-right").load(path+'ajax/account/collections.php');
			break;
		case 2:
			$("#account-content-right").load(path+'ajax/account/friends.php');
			break;
		case 3:
			$("#account-content-right").load(path+'ajax/account/events.php');
			break;
		case 4:
			$("#account-content-right").load(path+'ajax/account/trades.php');
			break;
		case 5:
			$("#account-content-right").load(path+'ajax/account/messages.php');
			break;
		case 6:
			$("#account-content-right").load(path+'ajax/account/notifications.php');
			break;
		case 7:
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

function itemCollection( category ){
	
	var _sel = '';
	var cat_name = '';
	
	switch( category ){
	
	case 1:
		_sel = 'pc';
		cat_name = 'phonecards';
		break;
	case 2:
		_sel = 'coin';
		cat_name = 'coins';
		break;	
	case 2:
		_sel = 'banknote';
		cat_name = 'banknotes';
		break;		
	}
	
	sel = document.getElementById(_sel+'-select').value;
	
	if ( sel != 0 ){
		$("#account-content-right").load(path+'ajax/account/collections/c_'+cat_name+'.php',{list:sel});
	}
}



function newList( category ){
	$("#account-content-right").load(path+'ajax/account/new_list.php',{category:category});
}



function createList( category ){	

	var list = document.getElementById('list_name').value;
	var priv = document.getElementById('list_priv').value;
	var id_user = document.getElementById('id_user').value;
	var div = document.createElement('div');

	$(div).load(path+'ajax/account/insert_list.php',{category:category,list:list, id_user:id_user, priv:priv},function(){

		if(div.innerHTML.search('error')!=-1){
			
			showGlobalInfo(translation.lista_ya_existe);
		}else{
			switch(category){
				case 1 : var category_name = 'phonecards';
				break;
				case 2 : var category_name = 'coins';
				break;
				case 3 : var category_name = 'banknotes';
				break;
				case 4 : var category_name = 'stamps';
				break;
				
			}
			$("#account-content-right").load(path+'ajax/account/collections/c_'+category_name+'.php',{list:div.innerHTML},function(){
				
				showGlobalInfo(translation.lista_creada);
			});

		}

	});

}



function editlist(){



	var id_user = document.getElementById('id_user').value;

	var name = document.getElementById('list_name').value;

	var name_old = document.getElementById('list_name_old').value;

	var priv = document.getElementById('list_priv').value;

	var div = document.createElement('div');

	

	

	$(div).load(path+'ajax/account/edit_list.php',{name:name, priv:priv, id_user:id_user, name_old:name_old},function(){

		

		if(div.innerHTML.search('error')!=-1){

			showGlobalInfo(translation.lista_no_puede_editar);

			

		}else{

		

			accountMenu(1);

			showGlobalInfo(div.innerHTML+' '+translation.editada);	


		}

		



		

	});



	

}


function showItemInfo( dom ){

	

	$(dom).animate({opacity:1},150);



	if ( parseInt($(dom).css('opacity')) == 1 ){

		$(dom).animate({opacity:0},400);

	}

	else{

		$(dom).animate({opacity:1},150);

	}

}



function setNewPass(){



	$("#chg-pass").css({display:'none'});

	$("#new-pass1 , #new-pass2").css({display:'table-row'});



}


function introViewed(type, user){	


	var div = document.createElement('div');

	$(div).load(path+'ajax/introduction/intro_viewed.php',{type:type, user:user},function(){
			
			closeSignin();
	});
	

}



function modalIntroduction( type ){

switch(type){
	
	case 1 :{
		$("#modal-intro").load(path+'ajax/introduction/explore_phonecards.php',{},function(){
		
				$("#modalI").click();
		
			});
		}
	
	break;
	
	case 2 :{
		$("#modal-intro").load(path+'ajax/introduction/show_phonecards.php',{},function(){
		
				$("#modalI").click();
		
			});
		}
	
	break;
	
	case 3 :{
		$("#modal-intro").load(path+'ajax/introduction/upload_phonecards.php',{},function(){
		
				$("#modalI").click();
		
			});
		}
	
	break;
	
	case 4 :{
		$("#modal-intro").load(path+'ajax/introduction/event.php',{},function(){
		
				$("#modalI").click();
		
			});
		}
	
	break;
	
	case 5 :{
		$("#modal-intro").load(path+'ajax/introduction/create_event.php',{},function(){
		
				$("#modalI").click();
		
			});
		}
	
	break;


	case 6 :{
		$("#modal-intro").load(path+'ajax/introduction/profile.php',{},function(){
		
				$("#modalI").click();
		
			});
		}
	
	break;
	
		case 7 :{
		$("#modal-intro").load(path+'ajax/introduction/exchange.php',{},function(){
		
				$("#modalI").click();
		
			});
		}
	
	break;
	
	case 8 :{
		$("#modal-intro").load(path+'ajax/introduction/buy.php',{},function(){
		
				$("#modalI").click();
		
			});
		}
	
	break;
}

}




function modalFeedback( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedback.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackFormCoin( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackFormCoin.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackDesigner( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackDesigner.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackEdge( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackEdge.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackCountry( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackCountry.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackTitle( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackTitle.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackValue( category){

//alert(category);

	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackValue.php?category='+category,{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackSubtitle( category){

//alert(category);

	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackSubtitle.php?category='+category,{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackCurrency( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackCurrency.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackMintHouse( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackMintHouse.php',{},function(){

		$("#modalF").click();

	});

}


function modalFeedbackSystem( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackSystem.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackReferenceCatalog( ){



	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackReferenceCatalog.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackSystemType( ){


	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackSystemType.php',{},function(){

		$("#modalF").click();

	});

}

function modalFeedbackLogo( ){


	$("#modal-feedback").load(path+'ajax/feedback/modalFeedbackLogo.php',{},function(){

		$("#modalF").click();

	});

}



function showUserCollection( category , dom ){

	

	document.getElementById("user-interaction").innerHTML = "";

	

	$(".user-collection-item").removeClass('selected');

	$(".collection-lists-item").removeClass('selected');

	

	$(dom).addClass('selected');

	

	spans = document.getElementById('collection-lists').getElementsByTagName('span');

	

	spans[0].onclick = function(){showUserCol(category,1,1)};

	spans[1].onclick = function(){showUserCol(category,2,1)};

	spans[2].onclick = function(){showUserCol(category,3,1)};

	//spans[3].onclick = function(){showUserCol(category,4,1)};

	spans[3].onclick = function(){showUserCol(category,5,1)};

	

	$('#user-collection').css({display:'inherit'});

	$('#user-collection-list').html('');

}



function showUserCol( cat , list , pag ){

	

	spans = document.getElementById('collection-lists').getElementsByTagName('span');

	$(".collection-lists-item").removeClass('selected');

	$(spans[(list-1)]).addClass('selected');

	

	id = $("#id").val();

	

	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';

	

	$("#user-collection-list").load(path+'ajax/user/list_countries.php',{cat:cat, list:list, id:id , pag:pag});

}



function showUserCol_step2( cat , list , cou ){

	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	u = $("#id").val();

	$("#user-collection-list").load(path+'ajax/user/list_companies.php',{cat:cat, list:list, u:u , cou:cou});
}

function showUserCol_step3( cat , list , cou , com ){

	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	u = $("#id").val();

	$("#user-collection-list").load(path+'ajax/user/list_systems.php',{cat:cat, list:list, u:u , cou:cou , com:com});
}

function showUserCol_step4( cat , list , cou , com , sys ){

	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	u = $("#id").val();

	$("#user-collection-list").load(path+'ajax/user/list_catalogs.php',{cat:cat, list:list, u:u , cou:cou , com:com , sys:sys});
}


function showUserCol_final( cat , list , cou , com , sys , catalog , pag ){
	
	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	u = $("#id").val();

	//alert(cat+' | '+list+' | '+cou+' | '+com+' | '+sys+' | '+catalog);

	switch( cat ){
		case 0:
			page = 'user_phonecards.php';
			break;
		case 1:
			page = 'user_coins.php';
			break;
		case 2:
			page = 'user_stamps.php';
			break;
		case 3:
			page = 'user_caps.php';
			break;
	}

	if ( !pag )
		pag = 1;

	$("#user-collection-list").load(path+'ajax/user/'+page,{cat:cat, list:list, id:u , cou:cou , com:com , sys:sys , catalog:catalog , pag:pag});
}



function showColList( num ){

	

	$(".collections-list:not(#list"+num+")").css({display:'none'});

	

	if ( $("#list"+num).css('display') == 'none' )

		$("#list"+num).css({display:'inherit'});

	else

		$("#list"+num).css({display:'none'});

}



function showSendMessage( to ){

	

	if ( logged_in ){

		$("#user-collection").css({display:'none'});

		$("#user-interaction").load(path+'ajax/user/sendMessage.php',{to:to},function(){
			$(this).css({display:'block'});	
		});

	}

	else{

		location.href = path+'index.php/login';

	}

	

}



function sendMessage( id_message ){

	

	var from = document.getElementById('from').value;

	var to = document.getElementById('to').value;

	var message = document.getElementById(id_message).value;

	

	if ( from != "" && to != "" && message.length > 2 ){

		

		var div = document.createElement('div');

		

		$(div).load(path+'ajax/user/send.php',{from:from,to:to,message:message} , function(){

			

			if ( div.innerHTML.search('ok') != -1 ){

				document.getElementById("user-interaction").innerHTML = '<div style="margin-top:10px;" id="info-info">'+translation.mensaje_enviado+'</div>';

			}

			else{

				alert(div.innerHTML);	

			}

		});

		

	}

	else{

		alert(translation.escribe_mensaje);	

	}

}



function showMessage( id ){

	

	$("#message_container").load(path+'ajax/account/show_message.php',{id:id});

	

}



function showPhonecardTab( index , id ){

	

	var tab = "";

	

	switch ( index ){

	

		case 0:

			tab = 'information'

			break;

		case 1:

			tab = 'collectors'

			break;

		case 2:

			tab = 'related'

			break;

		case 3:

			tab = 'comments'

			break;

	

	}

	

	$("#show-right").load(path+'ajax/showPhonecard/'+tab+'.php',{id:id});

}

function showCoinTab( index , id ){

	

	var tab = "";

	

	switch ( index ){

	

		case 0:

			tab = 'information'

			break;

		case 1:

			tab = 'collectors'

			break;

		case 2:

			tab = 'related'

			break;

		case 3:

			tab = 'comments'

			break;

	

	}

	

	$("#show-right").load(path+'ajax/showCoin/'+tab+'.php',{id:id});

}

function showBanknotesTab( index , id ){

	

	var tab = "";

	

	switch ( index ){

	

		case 0:

			tab = 'information'

			break;

		case 1:

			tab = 'collectors'

			break;

		case 2:

			tab = 'related'

			break;

		case 3:

			tab = 'comments'

			break;

	

	}

	

	$("#show-right").load(path+'ajax/showBanknote/'+tab+'.php',{id:id});

}



function sendComment(){

	

	var sender = document.getElementById('id_sender').value;

	var itm = document.getElementById('id_item').value;

	var comment = document.getElementById('comment').value;

	

	if ( comment == 'Write a comment' )

		return;

	

	if ( sender != "" && itm != "" && comment.length > 10 ){

		

		var div = document.createElement('div');

		

		$(div).load(path+'ajax/showPhonecard/send_comment.php',{sender:sender,itm:itm,comment:comment} , function(){

			

			if ( div.innerHTML.search('ok') != -1 ){

				showPhonecardTab(3,itm);

			}

			else{

				alert(translation.ya_escribiste_ese_comentario);	

			}

		});

		

	}

	else{

		alert(translation.comentario_debe_tener);	

	}

	

}



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



function showReport( num , show ){

	

	if ( show ){

		$("#report_"+num).animate({opacity:1},100);

	}

	else{

		$("#report_"+num).animate({opacity:0},100);

	}

}



function drop_share(){

	

	if ( $("#share-list").css('display') == 'none' ){

		$("#share-list").css({display:"block"});

	}

	else{

		$("#share-list").css({display:"none"});	

	}

}



function filter_explore( dom , id ){

	

	text = dom.value.split(' (');

	text = text[0];

	list = document.getElementById(id);

		

	lis = list.getElementsByTagName('li');

	

	for ( i = 0 ; i < lis.length ; i++ ){

		

		li = lis[i];

		

		var patt = new RegExp('^'+text.toLowerCase());

		var li_info = li.innerHTML.toLowerCase();

		li_info = li_info.replace(/<font>/g,'').replace(/<font class="">/g,'').replace(/<\/font>/g,'');		

		

		if ( li.innerHTML && patt.test(li_info) ){

			$(li).css({display:'list-item'});

		}

		else{

			$(li).css({display:'none'});

		}

	}

	

}



function clear_filter( category ){

	

	srch = document.getElementById(category+'-search');

	srch.value = "";

	

	switch( category ){

		

		case 'country':

			$("#explore-company-list").html('');

			$("#explore-serie-list").html('');

			$("#selected-country").val('');
			
			$("#explore-title-list").html(''); 
			
			$("#explore-subtitle-list").html(''); 
			
			$("#explore-denomination-list").html(''); 
			
			$("#explore-value-list").html('');
			
			$("#explore-composition-list").html('');

			break;

		case 'company':

			$("#explore-serie-list").html('');

			$("#selected-company").val('');

			break;

		case 'serie':

			$("#selected-serie").val('');

			break;
			
		case 'title':


			$("#selected-title").val('');
			
			$("#explore-subtitle-list").html('');
			
			$("#explore-denomination-list").html('');
			
			$("#explore-value-list").html('');

			break;
			
		case 'subtitle':


			$("#selected-subtitle").val(''); 
			
			$("#explore-denomination-list").html('');
			
			$("#explore-value-list").html('');

			break;
			
		case 'denomination':


			$("#selected-denomination").val('');
			
			$("#explore-value-list").html(''); 
			
			break;
			
		case 'value':
		
			$("#selected-value").val(''); 			

			break;
	}

	

	$("#explore-"+category+"-list li").removeClass('selected');

	filter_explore(srch,"explore-"+category+"-list");

	

}



function explore_catalog( dom , id_catalog ){

	

	if ( !$(dom).hasClass('disabled') ){

		$("#explore-catalog td").removeClass('selected');

		$(dom).addClass('selected');

		

		switch( id_catalog ){

			case 0:

				$("#explore-year").prop('disabled',false);

				document.getElementById('explore-year').getElementsByTagName('option')[1].style.display = 'none';

				document.getElementById('explore-year').selectedIndex = 0;

				break;

			case 1:

				document.getElementById('explore-year').selectedIndex = 1;

				$("#explore-year").prop('disabled',true);

				break;

			default:

				document.getElementById('explore-year').selectedIndex = 0;

				$("#explore-year").prop('disabled',false);

				document.getElementById('explore-year').getElementsByTagName('option')[1].style.display = 'inherit';

				break;

		}

		//li = $("#explore-company-list").find(".selected");

		//abbr_company = li[0].id.split('com-');
		
		
		abbr_company = $("#selected-company").val();//abbr_company[1];
		
		if ( !abbr_company ){
			abbr_company = $(document).getUrlParam('company');
		}
		
		li = $("#explore-serie-list").find(".selected");

		if ( li.length > 0 ){

			serie_id = li[0].id.split('ser-');

			serie_id = serie_id[1];

		}

		else{

			serie_id = null;	

		}
	
		//alert(abbr_company+" | "+id_catalog+" | "+serie_id);
		systems_numbers_by_company( abbr_company , id_catalog , serie_id );
		years_by_company( abbr_company , id_catalog , null );
		
		/*system = $(document).getUrlParam('system');
		
		if ( system ){
			
			switch( system ){
				case 'chip':
					explore_system($("#explore-system-table td")[3],0);
					break;
				case 'magnetic-band':
					explore_system($("#explore-system-table td")[0],1);
					break;
				case 'optical':
					explore_system($("#explore-system-table td")[1],2);
					break;
				case 'remote-memory':
					explore_system($("#explore-system-table td")[4],3);
					break;
				case 'induced':
					explore_system($("#explore-system-table td")[2],4);
					break;
			}
			
		}*/
		
		$("#selected-catalog").val(id_catalog);
	}

}



function explore_system( dom , id_system ){

	
	if ( !$(dom).hasClass('disabled') ){

		$("#explore-system td").removeClass('selected');

		$(dom).addClass('selected');

		

		$("#selected-system").val(id_system);

		

		sel_company = $("#selected-company").val();

		sel_catalog = $("#selected-catalog").val();
		
		sel_serie = $("#selected-serie").val();
		
		if ( !sel_serie ){
			sel_serie = null;
		}

		years_by_company( sel_company , sel_catalog , id_system );
		catalogs_numbers_by_company( sel_company , sel_serie , id_system+1 );
		
		/*catalog_id = $(document).getUrlParam('catalog');
		
		if ( catalog_id ){
			switch( catalog_id ){
				case 'dated':
					explore_catalog($("#explore-catalog-table td")[0],0);
					break;
				case 'undated':
					explore_catalog($("#explore-catalog-table td")[1],1);
					break;
				case 'not-emmited':
					explore_catalog($("#explore-catalog-table td")[2],2);
					break;
				case 'especial':
					explore_catalog($("#explore-catalog-table td")[3],3);
					break;
			}	
		}*/

	}

}



function explore_country( dom , abbr_country ){

	

	$("#explore-country-list li").removeClass('selected');

	$(dom).addClass('selected');

	$("#explore-serie-list").html('');

	

	$("#explore-company-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-company-list").load(path+'ajax/explore/companiesByCountries.php',{abbr:abbr_country}, function(){

		// Set company

		company = $(document).getUrlParam('company');

		if ( company ){

			com = $("#com-"+company);

			$("#company-search").val(com.html());

			filter_explore(document.getElementById("company-search"),'explore-company-list');

			explore_company(com,company);

		}	
		else{
			$("#selected-company").val('');	
		}

	});

	

	$("#selected-country").val(abbr_country);

}





function explore_company( dom , abbr_company ){

	

	$("#explore-company-list li").removeClass('selected');

	$(dom).addClass('selected');

	

	$("#explore-serie-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-serie-list").load(path+'ajax/explore/seriesByCompanies.php',{abbr:abbr_company}, function(){

		// Set serie

		serie = $(document).getUrlParam('serie');

		if ( serie ){

			ser = $("#ser-"+serie);

			$("#serie-search").val(ser.html());

			filter_explore(document.getElementById("serie-search"),'explore-serie-list');

			explore_serie(ser,serie);

		}
		else{
			$("#selected-serie").val('');
		}

	});

	

	catalogs_numbers_by_company( abbr_company , null , null );

	catalog_id = $(document).getUrlParam('catalog');
	
	if ( !catalog_id ){
		catalog_id = null;
	}
	else{
		switch( catalog_id ){
			case 'dated':
				catalog_id = 0;
				break;
			case 'undated':
				catalog_id = 1;
				break;
			case 'not-emmited':
				catalog_id = 2;
				break;
			/*case 'especial':
				catalog_id = 3;
				break;*/
		}	
	}

	systems_numbers_by_company( abbr_company , catalog_id , null );
	years_by_company( abbr_company , null , null );
	
	$("#selected-company").val(abbr_company);	

}



function years_by_company( abbr_company , catalog , system ){

	

	var div = document.createElement('div');

	$(div).load(path+'ajax/explore/yearsByCompanies.php',{abbr:abbr_company,catalog:catalog,system:system},function(){

				

		years = div.innerHTML.split(',');

		opts = '<option value="AllYears">'+translation.explore_phonecards_todos_ano+'</option>\n';

		opts+= '<option value="Unknown">'+translation.explore_phonecards_desconocido+'</option>\n';

		
		for ( i = 0 ; i < years.length ; i++ ){

			opts+='<option value="'+years[i]+'">'+years[i]+'</option>\n'	

		}

		

		$("#explore-year").html(opts);		

	});

	

}



function catalogs_numbers_by_company( abbr_company , serie , system ){

	

	var div2 = document.createElement('div');

	$(div2).load(path+'ajax/explore/catalogsByCompanies.php',{abbr:abbr_company , serie:serie , system:system },function(){

		res = div2.innerHTML;

		res = res.split(',');

		

		dated = parseInt(res[0]);

		undated = parseInt(res[1]);

		internal = parseInt(res[3]);

		/*especial = parseInt(res[2]);*/


		//alert(dated+" | "+undated+" | "+internal+" | "+especial);

		if ( dated > 0 ){

			
		$.post(path+'ajax/catalog_phonecard/valid_block.php',{abbr:abbr_company , system:system, date:'1', internal:'0' } , function(block) {

			$("#datedC").removeClass('disabled');

			inner = $("#datedC").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZáéíóúAÉÍÓÚÑñ ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.tarjetas_fecha+' ('+dated+')</div>');


			

			$("#datedC").html(inner);

			$("#datedCB1").remove();

			$("#datedC").append(block);

		if(system==null){
			$("#datedCB1").remove();
		}

		},'json');

		}

		else{

			$("#datedC").removeClass('selected');

			$("#datedC").addClass('disabled');

			$("#datedCB1").remove();
			

			inner = $("#datedC").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZáéíóúAÉÍÓÚÑñ ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.tarjetas_fecha+'</div>');

			

			$("#datedC").html(inner);

		}

					

		if ( undated > 0 ){

		$.post(path+'ajax/catalog_phonecard/valid_block.php',{abbr:abbr_company , system:system, date:'0', internal:'0' } , function(block) {

			$("#undatedC").removeClass('disabled');

			inner = $("#undatedC").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZáéíóúAÉÍÓÚÑñ ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.tarjetas_sin_fecha+' ('+undated+')</div>');

			

			$("#undatedC").html(inner);

			$("#datedCB0").remove();

			$("#undatedC").append(block);

		if(system==null){
			$("#datedCB0").remove();
		}

		},'json');

		}

		else{

			$("#undatedC").removeClass('selected');

			$("#undatedC").addClass('disabled');

			$("#datedCB0").remove();

			inner = $("#undatedC").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZáéíóúAÉÍÓÚÑñ ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.tarjetas_sin_fecha+'</div>');
		

			$("#undatedC").html(inner);

		}

		

		if ( internal > 0 ){

			$.post(path+'ajax/catalog_phonecard/valid_block.php',{abbr:abbr_company , system:system, date:'0', internal:'1' } , function(block) {

			$("#internalC").removeClass('disabled');

			inner = $("#internalC").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZáéíóúAÉÍÓÚÑñ ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.tarjetas_uso_interno+' ('+internal+')</div>');

			$("#internalC").html(inner);

			$("#datedCB2").remove();

			$("#internalC").append(block);

			if(system==null){
				$("#datedCB2").remove();
			}

			},'json');

		}

		else{

			$("#internalC").removeClass('selected');

			$("#internalC").addClass('disabled');

			$("#datedCB2").remove();

			inner = $("#internalC").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZáéíóúAÉÍÓÚÑñ ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.tarjetas_uso_interno+'</div>');

			$("#internalC").html(inner);

		}
	

	});	

}

function fast_marking(){

	$(".fast_marquing").toggle('fast');
	$(".item-control").toggle('fast');

}

function checked_all(total){

	for(i=0;i<total;i++){
		var check = $("#fast"+i).attr("checked");
		if(check){
			$("#fast"+i).attr("checked",false);
		}else{
			$("#fast"+i).attr("checked",true);
		}
	}

}

function modalItemList( total,category,list,type,title ){
var id_phonecards = [];
/*alert(title);*/
for(i=0;i<total;i++){
	var id_phonecard = $("#fast"+i+":checked").val();
	id_phonecards.push(id_phonecard);
}
	
	$("#modal-phonecard").load(path+'ajax/items/item1.php',{id_phonecards:id_phonecards,p:1058, category:category,list:list,type:type,title:title},function(){

		$("#modalP").click();

	});



}

function block_phonecard(country, company, system, date, internal, status, saved){

	$.post(path+'ajax/catalog_phonecard/block_phonecards.php',{country:country , company:company, system:system, date:date , internal:internal , status:status , saved:saved } , function(result) {
	systems=system-1;
	showGlobalInfo(result);

	if(systems==0){
		$("#explore-system-chip").click();
	}else if(systems==1){
		$("#explore-system-magnetic").click();
	}else if(systems==2){
		$("#explore-system-optical").click();
	}else if(systems==3){
		$("#explore-system-remote").click();
	}else if(systems==4){
		$("#explore-system-induced").click();
	}


	},'json');
}

function block_one_phonecard(id_phonecards, status){

$.post(path+'ajax/catalog_phonecard/block_one_phonecard.php',{id_phonecards:id_phonecards , status:status }, function(result) {
	showGlobalInfo(result);
	},'json');
	
	modalPhonecard(id_phonecards);

}

function systems_numbers_by_company( abbr_company , catalog , serie ){

	

	var div = document.createElement('div');

	$(div).load(path+'ajax/explore/systemsByCompanies.php',{abbr:abbr_company , catalog:catalog , serie:serie},function(){

				

		//$("#explore-system-table td").removeClass('selected');

		systems = div.innerHTML;
		//alert(abbr_company+' | '+catalog+' | '+serie);
		

		if ( systems.search('1_[0-9]+') == -1 ){

			$("#explore-system-chip").removeClass('selected');

			$("#explore-system-chip").addClass('disabled');

			

			inner = $("#explore-system-chip").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã± ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.chip+'</div>');

			

			$("#explore-system-chip").html(inner);

		}

		else{

			$("#explore-system-chip").removeClass('disabled');

			

			nums = systems.split('1_');

			nums = nums[1];

			nums = nums.split(',');

			nums = nums[0];

			

			inner = $("#explore-system-chip").html();

			//alert(inner);

			

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã± ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.chip+' ('+nums+')</div>');

			

			//alert(inner);

			$("#explore-system-chip").html(inner);

		}

		

		if ( systems.search('2_[0-9]+') == -1 ){

			$("#explore-system-magnetic").removeClass('selected');

			$("#explore-system-magnetic").addClass('disabled');

			

			inner = $("#explore-system-magnetic").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã± ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.banda_magnetica+'</div>');

			$("#explore-system-magnetic").html(inner);

		}

		else{

			$("#explore-system-magnetic").removeClass('disabled');

			

			nums = systems.split('2_');

			nums = nums[1];

			nums = nums.split(',');

			nums = nums[0];

			

			inner = $("#explore-system-magnetic").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã±é ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.banda_magnetica+' ('+nums+')</div>');

			

			$("#explore-system-magnetic").html(inner);

		}

		

		if ( systems.search('3_[0-9]+') == -1 ){

			$("#explore-system-optical").removeClass('selected');

			$("#explore-system-optical").addClass('disabled');

			

			inner = $("#explore-system-optical").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã± ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.sistema_optico+'</div>');

			$("#explore-system-optical").html(inner);

		}

		else{

			$("#explore-system-optical").removeClass('disabled');

			

			nums = systems.split('3_');

			nums = nums[1];

			nums = nums.split(',');

			nums = nums[0];

			

			inner = $("#explore-system-optical").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã±Ó ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.sistema_optico+' ('+nums+')</div>');

			

			$("#explore-system-optical").html(inner);

		}

		

		if ( systems.search('4_[0-9]+') == -1 ){

			$("#explore-system-remote").removeClass('selected');

			$("#explore-system-remote").addClass('disabled');

			

			inner = $("#explore-system-remote").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã± ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.memoria_remota+'</div>');

			$("#explore-system-remote").html(inner);

		}

		else{

			$("#explore-system-remote").removeClass('disabled');	

			

			nums = systems.split('4_');

			nums = nums[1];

			nums = nums.split(',');

			nums = nums[0];

			

			inner = $("#explore-system-remote").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã± ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.memoria_remota+' ('+nums+')</div>');

			

			$("#explore-system-remote").html(inner);

		}

		

		if ( systems.search('5_[0-9]+') == -1 ){

			$("#explore-system-induced").addClass('disabled');

			$("#explore-system-induced").removeClass('selected');

			

			inner = $("#explore-system-induced").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã± ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.sistema_inducido+'</div>');

			$("#explore-system-induced").html(inner);

		}

		else{

			$("#explore-system-induced").removeClass('disabled');

			

			nums = systems.split('5_');

			nums = nums[1];

			nums = nums.split(',');

			nums = nums[0];

			

			inner = $("#explore-system-induced").html();

			inner = inner.replace(/<div>\n?(?:<font>\n?)*[a-zA-ZÃ¡Ã©Ã­Ã³ÃºAÃ‰ÃÃ“ÃšÃ‘Ã± ]+ ?(?:\([0-9]+\))?\n?(?:<\/font>\n?)*<\/div>/g,'<div>'+translation.sistema_inducido+' ('+nums+')</div>');

			

			$("#explore-system-induced").html(inner);

		}

		system = $(document).getUrlParam('system');
	
		if ( system ){
			
			switch( system ){
				case 'chip':
					explore_system($("#explore-system-table td")[3],0);
					break;
				case 'magnetic-band':
					explore_system($("#explore-system-table td")[0],1);
					break;
				case 'optical':
					explore_system($("#explore-system-table td")[1],2);
					break;
				case 'remote-memory':
					explore_system($("#explore-system-table td")[4],3);
					break;
				case 'induced':
					explore_system($("#explore-system-table td")[2],4);
					break;
			}
		}

	});	

}



function explore_serie( dom , id_serie ){

	

	$("#explore-serie-list li").removeClass('selected');

	$(dom).addClass('selected');

	

	var div = document.createElement('div');

	$(div).load(path+'ajax/explore/systemsBySeries.php',{id_serie:id_serie},function(){

		

		$("#explore-system-table td").removeClass('selected');

		systems = div.innerHTML;

		

		if ( systems.search('1') == -1 ){

			$("#explore-system-chip").addClass('disabled');

		}

		else{

			$("#explore-system-chip").removeClass('disabled');	

		}

		

		if ( systems.search('2') == -1 ){

			$("#explore-system-magnetic").addClass('disabled');

		}

		else{

			$("#explore-system-magnetic").removeClass('disabled');	

		}

		

		if ( systems.search('3') == -1 ){

			$("#explore-system-optical").addClass('disabled');

		}

		else{

			$("#explore-system-optical").removeClass('disabled');	

		}

		

		if ( systems.search('4') == -1 ){

			$("#explore-system-remote").addClass('disabled');

		}

		else{

			$("#explore-system-remote").removeClass('disabled');	

		}

		

		if ( systems.search('5') == -1 ){

			$("#explore-system-induced").addClass('disabled');

		}

		else{

			$("#explore-system-induced").removeClass('disabled');	

		}

		

	});

	

	$("#selected-serie").val(id_serie);

	

	li = $("#explore-company-list").find(".selected");

	abbr_company = li[0].id.split('com-');

	abbr_company = abbr_company[1];

	

	catalogs_numbers_by_company( abbr_company , id_serie , null );
	
	catalog = $("#selected-catalog").val();

	

	if ( catalog.length == 0 ){

		catalog = null;	

	}

	systems_numbers_by_company( abbr_company , catalog , id_serie );

	

}



function explore_year( dom ){

	

	$("#selected-year").val(dom.value);	

}



function send_explore(){

	

	catalog = parseInt(document.getElementById('selected-catalog').value);

	system = parseInt(document.getElementById('selected-system').value);

	country = document.getElementById('selected-country').value;

	company = document.getElementById('selected-company').value;

	serie = document.getElementById('selected-serie').value;

	year = document.getElementById('selected-year').value;

	

	switch ( catalog ){

		case 0:

			catalog = 'dated';

			break;

		case 1:

			catalog = 'undated';

			break;

		case 2:

			catalog = 'not-emmited';

			break;

		/*case 3:

			catalog = 'especial';

			break;*/

		default:

			catalog = null;

			break;

	}

	

	switch ( system ){

		case 0:

			system = 'chip';

			break;

		case 1:

			system = 'magnetic-band';

			break;

		case 2:

			system = 'optical';

			break;

		case 3:

			system = 'remote-memory';

			break;

		case 4:

			system = 'induced';

			break;

		default:

			system = null;

	}

	

	url = catalog+'/'+system+'/'+country+'/'+company;

	

	if ( serie )

		url+= '/'+serie;

	else

		url+= '/0';

		

	url+='/'+year;

	

	if ( catalog && system && country && company ){

		toGo = (path+'index.php/explore/phonecard/'+url+'/1').toLowerCase();

		location.href = toGo;

	}

	else{

		alert(translation.catalogo_sistema_pais_compania_obligatorio);

	}

}



function set_compare_category( dom , cat ){

	

	$("#compare-category-table td").removeClass('selected');

	$(dom).addClass('selected');

	$("#compare-category").val(cat);

	

	$("#compare-method").val('');

	$("#compare-method-table td").removeClass('selected');

	

}



function set_compare_method( dom , met ){

	

	$("#compare-method-table td").removeClass('selected');

	$(dom).addClass('selected');

	$("#compare-method").val(met);

	

	category = parseInt($("#compare-category").val());

	

	if ( !category ){

		$("#compare-method-table td").removeClass('selected');

		showGlobalInfo(translation.selecciona_categoria_primero);

		return;

	}



	switch( category ){

		case 1:

			category = 'phonecards';

			break;

		case 2:

			category = 'coins';

			break;

		case 3:

			category = 'banknotes';

			break;

		case 4:

			category = 'stamps';

			break;

		default:

			return;

	}

	

	switch( met ){

		case 1:

			met = 'wish';

			break;

		case 2:

			met = 'swap';

			break;

		case 3:

			met = 'buy';

			break;

		case 4:

			met = 'sell';

			break;

		default:

			return;

	}

	

	user = $("#compare-user").val();

	

	//alert(path+'index.php/compare/'+user+'/'+category+'/'+met);

	location.href = path+'index.php/compare/'+user+'/'+category+'/'+met;

}



function launch_upload_image(){

	

	$("#new-image").click();

}



function launch_new_image_upload( dom ){

	

	if ( dom.value ){

		id = $("#id-pc").val();

		url = document.URL.split('?');

		url = url[0];

		

		$("#onFinish").val(url+'?showPhonecard='+id);

		document.getElementById('new-image-form').submit();

	}

	

}

function launch_new_image_upload1( dom ){

	

	if ( dom.value ){

		id = $("#id-cn").val();

		url = document.URL.split('?');

		url = url[0];

		

		$("#onFinish").val(url+'?showCoin='+id);

		document.getElementById('new-image-form').submit();

	}

	

}



function feedback_file( dom ){

	

	if ( dom.value ){

		name = dom.value.replace('C:\\fakepath\\','');

		$("#feedback-file-name").html(name);	

	}

	

}



function confirm_friend( user2 ){

	

	div = document.createElement('div');

	$(div).load(path+'ajax/friends/confirmFriend.php',{user2:user2},function(){

		

		if ( div.innerHTML.search('ok') != -1 ){

			location.reload();

		}

		else{

			alert('error');	

		}

		

	});

	

}



function cancel_friend( user2 , user ){



	div = document.createElement('div');

	

	$(div).load(path+'ajax/friends/deleteFriend.php',{user2:user2},function(){

		

		if ( div.innerHTML.search('ok') != -1 ){

			location.reload();

		}

		else{

			alert(translation.error);	

		}

		

	});	

	

}







function delete_friend( user2 , user ){

	

	

	

	if ( confirm('Are you sure you want to remove '+user+' from your friends?') ){

		div = document.createElement('div');

		$(div).load(path+'ajax/friends/deleteFriend.php',{user2:user2},function(){

			

			if ( div.innerHTML.search('ok') != -1 ){

				location.reload();

			}

			else{

				alert(translation.error);	

			}

			

		});	

	}

	

}



function add_friend( user2 ){

	

	div = document.createElement('div');

	$(div).load(path+'ajax/friends/addFriend.php',{user2:user2},function(){

		

		if ( div.innerHTML.search('ok') != -1 ){

			location.reload();

		}

		else{

			alert(translation.error);	

		}

		

	});

	

}



function invite_friends(){

	

	evnt = document.getElementById('event-id').value;

	

	div = document.getElementById('invite-friends');

	div.innerHTML = '<img src="'+path+'img/ajax-loader.gif" />';

	$(div).css('text-align','center');

	

	$(div).load(path+'ajax/event/invite_friends.php',{evnt:evnt} , function(){

		$(div).css('text-align','inherit');

	});

	

}



function change_email( user , type , dom ){

	

	div = document.createElement('div');

	$(div).load(path+'ajax/account/change_email_setting.php',{user:user , type:type},function(){

		

		if ( div.innerHTML.search('1') != -1 ){

			$(dom).html(translation.desactivado);

			$(dom).removeClass('google-button-green');

			$(dom).addClass('google-button-red');

		}

		else{

			$(dom).html(translation.activado);

			$(dom).removeClass('google-button-red');

			$(dom).addClass('google-button-green');	

		}

		

	});

	

}





function list_privacy(user){



	sel = document.getElementById('list-privacy').value;

	div = document.createElement('div');

	

	$(div).load(path+'ajax/account/list_privacy.php',{user:user, sel:sel},function(){

		

		if ( div.innerHTML.search('ok') == -1 ){

			alert(translation.error);	

		}

		

	});

	

}

function view_privacy(user){

	sel = document.getElementById('view-privacy').value;

	div = document.createElement('div');
	$(div).load(path+'ajax/account/view_privacy.php',{user:user, sel:sel},function(){

		if ( div.innerHTML.search('ok') == -1 ){
			alert(translation.error);	
		}

	});
}



function profile_privacy(user){



	sel = document.getElementById('profile-privacy').selectedIndex;

	div = document.createElement('div');

	$(div).load(path+'ajax/account/profile_privacy.php',{user:user, sel:sel},function(){

		if ( div.innerHTML.search('ok') == -1 ){

			alert(translation.error);	

		}

		

	});

	

}

function phonecards_collections_select( id_users , list , id_countries , id_companies , system , catalog , no_variations  ){
	

	if ( id_companies && system && catalog ){

		$("#collections_content").load(path+'ajax/account/collections/c_phonecards_list.php',
			{ id_users:id_users , list:list , id_countries:id_countries , catalog:catalog , id_companies:id_companies , system:system , no_variations:no_variations  } );
	}
	else{

		if ( id_companies ){

			if ( system ){
				
				$("#collections_content").load(path+'ajax/account/collections/c_phonecards_catalogs.php',
				{ id_users:id_users , list:list , id_countries:id_countries , id_companies:id_companies , system:system } );
			}
			else{
				
				$("#collections_content").load(path+'ajax/account/collections/c_phonecards_systems.php',
				{ id_users:id_users , list:list , id_countries:id_countries , id_companies:id_companies } );
			}
		}
		else{

			$("#collections_content").load(path+'ajax/account/collections/c_phonecards_companies.php',
			{ id_users:id_users , list:list , id_countries:id_countries } );
		}
	}
}

function phonecards_collections_select_minus( id_users , list , id_countries , id_companies , system , catalog , no_variations  ){
 
		$("#collections_content").load(path+'ajax/account/c_phonecards_list_minus.php',

			{ id_users:id_users , list:list , id_countries:id_countries , catalog:catalog , id_companies:id_companies , system:system , no_variations:no_variations  } );


}

function coins_collections_select( id_users , list , id_countries , id_title , id_value , id_subtitle , no_variations  ){
	

	if ( id_title && id_value && id_subtitle ){

		$("#collections_content").load(path+'ajax/account/collections/c_phonecards_list.php',
			{ id_users:id_users , list:list , id_countries:id_countries , catalog:catalog , id_companies:id_companies , system:system , no_variations:no_variations  } );
	}
	else{

		if ( id_title ){

			if ( id_value ){
				
				$("#collections_content").load(path+'ajax/account/collections/c_coins_subtitle.php',
				{ id_users:id_users , list:list , id_countries:id_countries , id_title:id_title , id_value:id_value } );
			}
			else{
				
				$("#collections_content").load(path+'ajax/account/collections/c_coins_values.php',
				{ id_users:id_users , list:list , id_countries:id_countries , id_title:id_title } );
			}
		}
		else{

			$("#collections_content").load(path+'ajax/account/collections/c_coins_titles.php',
			{ id_users:id_users , list:list , id_countries:id_countries } );
		}
	}
}

function switch_languaje( dom ){
	
	val = $(dom).val();
	
	var div = document.createElement('div');
	
	$(div).load(path+'ajax/switch_languaje.php',{lang:val},function(){
		location.href = path+'index.php/change_language';
	});
	
}

function explore_catalog_coin( dom , id_catalog ){

	

	if ( !$(dom).hasClass('disabled') ){

		$("#explore-catalog td").removeClass('selected');

		$(dom).addClass('selected');
		
		
			
		$("#explore-title-list").html(''); 
		
		$("#explore-subtitle-list").html(''); 
		
		$("#explore-denomination-list").html(''); 
		
		$("#explore-value-list").html('');
		
		$("#explore-composition-list").html('');
		
		
		$("#explore-country-list").html('<img src="'+path+'img/ajax-loader.gif" />');
		

		$("#explore-country-list").load(path+'ajax/explore/coin/countryByCatalog.php',{id:id_catalog}, function(){
	
			// Set country
	
			country = $(document).getUrlParam('country');
	
			if ( country ){
	
				coun = $("#coun-"+country);
	
				$("#title-search").val(coun.html());
	
				filter_explore(document.getElementById("country-search"),'explore-country-list');
	
				explore_title(coun,country);
	
			}	
			else{
				$("#selected-country").val('');	
			}
	
		});
		
		$("#selected-catalog").val(id_catalog);
	}

}


function explore_country_coin( dom , abbr_country ){

	

	$("#explore-country-list li").removeClass('selected');

	$(dom).addClass('selected');

	$("#explore-title-list").html('');
	
	$("#explore-subtitle-list").html('');
	
	$("#explore-denomination-list").html('');
	
	$("#explore-value-list").html('');

	

	$("#explore-title-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-title-list").load(path+'ajax/explore/coin/titlesByCountries.php',{abbr:abbr_country}, function(){

		// Set title

		title = $(document).getUrlParam('title');

		if ( title ){

			ti = $("#ti-"+title);

			$("#title-search").val(ti.html());

			filter_explore(document.getElementById("title-search"),'explore-title-list');

			explore_title(ti,title);

		}	
		else{
			$("#selected-title").val('');	
		}

	});
	years_for_coin(abbr_country, null, null, null, null);
	composition_for_coin(abbr_country, null, null, null, null);

	$("#selected-country").val(abbr_country);

}

function explore_title_coin( dom , id ){

	

	$("#explore-title-list li").removeClass('selected');

	$(dom).addClass('selected');

	$("#explore-subtitle-list").html('');
	
	$("#explore-denomination-list").html('');
	
	$("#explore-value-list").html('');

	

	$("#explore-subtitle-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-subtitle-list").load(path+'ajax/explore/coin/subtitleByTitle.php',{id:id}, function(){

		// Set value

		subtitle = $(document).getUrlParam('subtitle');

		if ( subtitle ){

			ti = $("#subt-"+subtitle);

			$("#subtitle-search").val(subt.html());

			filter_explore(document.getElementById("subtitle-search"),'explore-subtitle-list');

			explore_subtitle(subt,subtitle);

		}	
		else{
			$("#selected-subtitle").val('');	
		}

	});
	
	abbr_country = document.getElementById('selected-country').value;
	years_for_coin(abbr_country, id, null, null, null);
	composition_for_coin(abbr_country, id, null, null, null);
	
	$("#selected-title").val(id);

}

function explore_subtitle_coin( dom , id ){

	

	$("#explore-subtitle-list li").removeClass('selected');

	$(dom).addClass('selected');

	$("#explore-denomination-list").html('');

	$("#explore-value-list").html('');
	

	$("#explore-denomination-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-denomination-list").load(path+'ajax/explore/coin/denominationBySubtitle.php',{id:id}, function(){

		// Set denomination

		denom = $(document).getUrlParam('denomination');

		if ( denom ){

			den = $("#den-"+denom);

			$("#denomination-search").val(st.html());

			filter_explore(document.getElementById("value-denomination"),'explore-denomination-list');

			explore_value(den,denom);

		}	
		else{
			$("#selected-denomination").val('');	
		}

	});
	
	abbr_country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	years_for_coin(abbr_country, title, id, null, null);
	composition_for_coin(abbr_country, title, id, null, null);


	$("#selected-subtitle").val(id);

}

function explore_denomination_coin( dom , id ){

	

	$("#explore-denomination-list li").removeClass('selected');

	$(dom).addClass('selected');

	$("#explore-value-list").html('');

	

	$("#explore-value-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-value-list").load(path+'ajax/explore/coin/valueByDenomination.php',{id:id}, function(){

		// Set value

		valu = $(document).getUrlParam('value');

		if ( valu ){

			val = $("#val-"+valu);

			$("#value-search").val(st.html());

			filter_explore(document.getElementById("value-value"),'explore-value-list');

			explore_value(val,valu);

		}	
		else{
			$("#selected-value").val('');	
		}

	}); 
	
	abbr_country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	subtitle = document.getElementById('selected-subtitle').value;
	years_for_coin(abbr_country, title, subtitle, id, null);
	composition_for_coin(abbr_country, title, subtitle, id, null);
	
	$("#selected-denomination").val(id);

}

function explore_value_coin( dom , id ){
 

	$("#explore-value-list li").removeClass('selected');

	$(dom).addClass('selected');
	
	abbr_country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	subtitle = document.getElementById('selected-subtitle').value;
	denomination = document.getElementById('selected-denomination').value;
	years_for_coin(abbr_country, title, subtitle, denomination, id);
	composition_for_coin(abbr_country, title, subtitle, denomination, id);
	
	
	$("#selected-value").val(id);

}

function explore_composition_coin( dom , id ){

	$("#explore-composition-list li").removeClass('selected'); 

	$(dom).addClass('selected');
	 
	$("#selected-composition").val(id);

}


function years_for_coin( country , title , subtitle , denomination , value ){

	

	var div = document.createElement('div');

	$(div).load(path+'ajax/explore/coin/yearsForCoin.php',{country:country,title:title,subtitle:subtitle,denomination:denomination,value:value},function(){
 

		years = div.innerHTML.split(',');

		opts = '<option value="AllYears">'+translation.explore_phonecards_todos_ano+'</option>\n';

		opts+= '<option value="Unknown">'+translation.explore_phonecards_desconocido+'</option>\n';

		
		for ( i = 0 ; i < years.length ; i++ ){

			opts+='<option value="'+years[i]+'">'+years[i]+'</option>\n'	

		} 

		$("#explore-year").html(opts);		

	});
 
}

function composition_for_coin( country , title , subtitle , denomination , value ){

	

	$("#explore-composition-list li").removeClass('selected');
	

	$("#explore-composition-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-composition-list").load(path+'ajax/explore/coin/compositionForCoin.php',{country:country,title:title,subtitle:subtitle,denomination:denomination,value:value}, function(){

		// Set composition

		composition = $(document).getUrlParam('composition');

		if ( composition ){

			comp = $("#comp-"+composition);

			$("#composition-search").val(st.html());

			filter_explore(document.getElementById("value-composition"),'explore-composition-list');

			explore_composition(comp,composition);

		}	
		else{
			$("#selected-composition").val('All');	
		}

	}); 
	
	abbr_country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	subtitle = document.getElementById('selected-subtitle').value;
	denomination = document.getElementById('selected-denomination').value;
	value = document.getElementById('selected-value').value;
	years_for_coin(abbr_country, title, subtitle, denomination, value);
	 

}


function send_explore_coin(){
 
 	catalog = document.getElementById('selected-catalog').value;
	country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	subtitle = document.getElementById('selected-subtitle').value;
	denomination = document.getElementById('selected-denomination').value;
	value = document.getElementById('selected-value').value;
	composition = document.getElementById('selected-composition').value;
	year = document.getElementById('selected-year').value;

	switch(parseInt(catalog)){
		case 1 : url = 'normal';
		break;
		case 2 : url = 'special';
		break;
		case 3 : url = 'other';
		break;
		default : url = 'total';
		break;
	}
	
	url+= '/'+country ;
	
	if ( title )

		url+= '/'+title;

	else

		url+= '/0';
		
	if ( subtitle )

		url+= '/'+subtitle;

	else

		url+= '/0';
	
	if ( denomination )

		url+= '/'+denomination;

	else

		url+= '/0';
		
	if ( value )

		url+= '/'+value;

	else

		url+= '/0';
		
	url+='/'+composition;
	
	url+='/'+year;
	
	if ( country && catalog && year ){

		toGo = (path+'index.php/explore/coin/'+url+'/1').toLowerCase();
		location.href = toGo;

	}

	else{

		alert(translation.pais_catalogo_obligatorio);

	}

}

function explore_catalog_banknote( dom , id_catalog ){

	

	if ( !$(dom).hasClass('disabled') ){

		$("#explore-catalog td").removeClass('selected');

		$(dom).addClass('selected');
		 
			
		$("#explore-title-list").html(''); 
		
		$("#explore-subtitle-list").html(''); 
		
		$("#explore-denomination-list").html(''); 
		
		$("#explore-value-list").html('');
		 
		
		
		$("#explore-country-list").html('<img src="'+path+'img/ajax-loader.gif" />');
		

		$("#explore-country-list").load(path+'ajax/explore/banknote/countryByCatalog.php',{id:id_catalog}, function(){
	
			// Set country
	
			country = $(document).getUrlParam('country');
	
			if ( country ){
	
				coun = $("#coun-"+country);
	
				$("#title-search").val(coun.html());
	
				filter_explore(document.getElementById("country-search"),'explore-country-list');
	
				explore_title(coun,country);
	
			}	
			else{
				$("#selected-country").val('');	
			}
	
		});
		
		$("#selected-catalog").val(id_catalog);
	}

}


function explore_country_banknote( dom , abbr_country ){

	$("#explore-country-list li").removeClass('selected');

	$(dom).addClass('selected');
	
	$("#explore-title-list").html(''); 

	$("#explore-subtitle-list").html('');
	
	$("#explore-denomination-list").html('');
	
	$("#explore-value-list").html('');

	

	$("#explore-title-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-title-list").load(path+'ajax/explore/banknote/titlesByCountries.php',{abbr:abbr_country}, function(){

		// Set title

		title = $(document).getUrlParam('title');

		if ( title ){

			ti = $("#ti-"+title);

			$("#title-search").val(ti.html());

			filter_explore(document.getElementById("title-search"),'explore-title-list');

			explore_title(ti,title);

		}	
		else{
			$("#selected-title").val('');	
		}

	});

	$("#selected-country").val(abbr_country);

}


function explore_title_banknote( dom , id ){

	$("#explore-title-list li").removeClass('selected');

	$(dom).addClass('selected');

	$("#explore-subtitle-list").html('');
	
	$("#explore-denomination-list").html('');
	
	$("#explore-value-list").html('');

	

	$("#explore-subtitle-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-subtitle-list").load(path+'ajax/explore/banknote/subtitleByTitle.php',{id:id}, function(){

		// Set subtitle

		subtitle = $(document).getUrlParam('subtitle');

		if ( subtitle ){

			st = $("#subt-"+subtitle);

			$("#subtitle-search").val(st.html());

			filter_explore(document.getElementById("subtitle-search"),'explore-subtitle-list');

			explore_value(st,subtitle);

		}	
		else{
			$("#selected-subtitle").val('');	
		}

	});
	
	$("#selected-title").val(id); 
	
	abbr_country = document.getElementById('selected-country').value;
	years_for_banknote(abbr_country, id, null, null, null);
}


function explore_subtitle_banknote( dom , id ){

	
	$("#explore-subtitle-list li").removeClass('selected');

	$(dom).addClass('selected');

	$("#explore-denomination-list").html('');

	$("#explore-value-list").html('');
	

	$("#explore-denomination-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-denomination-list").load(path+'ajax/explore/banknote/denominationBySubtitle.php',{id:id}, function(){

		// Set denomination

		denom = $(document).getUrlParam('denomination');

		if ( denom ){

			den = $("#den-"+denom);

			$("#denomination-search").val(st.html());

			filter_explore(document.getElementById("value-denomination"),'explore-denomination-list');

			explore_value(den,denom);

		}	
		else{
			$("#selected-denomination").val('');	
		}

	});
	
	abbr_country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	years_for_banknote(abbr_country, title, id, null, null);


	$("#selected-subtitle").val(id);

}


function explore_denomination_banknote( dom , id ){

	$("#explore-denomination-list li").removeClass('selected');

	$(dom).addClass('selected');

	$("#explore-value-list").html('');

	

	$("#explore-value-list").html('<img src="'+path+'img/ajax-loader.gif" />');

	$("#explore-value-list").load(path+'ajax/explore/banknote/valueByDenomination.php',{id:id}, function(){

		// Set denomination

		valu = $(document).getUrlParam('value');

		if ( valu ){

			val = $("#val-"+valu);

			$("#value-search").val(st.html());

			filter_explore(document.getElementById("value-value"),'explore-value-list');

			explore_value(val,valu);

		}	
		else{
			$("#selected-value").val('');	
		}

	}); 
	
	abbr_country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	subtitle = document.getElementById('selected-subtitle').value;
	years_for_banknote(abbr_country, title, subtitle, id, null);
	
	$("#selected-denomination").val(id);

}

function explore_value_banknote( dom , id ){
 
	$("#explore-value-list li").removeClass('selected');

	$(dom).addClass('selected');
	
	abbr_country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	subtitle = document.getElementById('selected-subtitle').value;
	denomination = document.getElementById('selected-denomination').value;
	years_for_banknote(abbr_country, title, subtitle, denomination, id); 
	
	$("#selected-value").val(id);

}


function years_for_banknote( country , title , subtitle , denomination , value ){

	

	var div = document.createElement('div');

	$(div).load(path+'ajax/explore/banknote/yearsForBanknote.php',{country:country,title:title,subtitle:subtitle,denomination:denomination,value:value},function(){
 

		years = div.innerHTML.split(',');

		opts = '<option value="AllYears">'+translation.explore_phonecards_todos_ano+'</option>\n';

		opts+= '<option value="Unknown">'+translation.explore_phonecards_desconocido+'</option>\n';

		
		for ( i = 0 ; i < years.length ; i++ ){

			opts+='<option value="'+years[i]+'">'+years[i]+'</option>\n'	

		} 

		$("#explore-year").html(opts);		

	});
 
}


function send_explore_banknote(){
 
	catalog = document.getElementById('selected-catalog').value;
	country = document.getElementById('selected-country').value;
	title = document.getElementById('selected-title').value;
	subtitle = document.getElementById('selected-subtitle').value;
	denomination = document.getElementById('selected-denomination').value;
	value = document.getElementById('selected-value').value;
	year = document.getElementById('selected-year').value;

	switch(parseInt(catalog)){
		case 1 : url = 'normal';
		break;
		case 2 : url = 'special';
		break;
		case 3 : url = 'other';
		break;
		default : url = 'total';
		break;
	}
	
	url+= '/'+country ;
	
	if ( title )

		url+= '/'+title;

	else

		url+= '/0';
		
	if ( subtitle )

		url+= '/'+subtitle;

	else

		url+= '/0';
	
	if ( denomination )

		url+= '/'+denomination;

	else

		url+= '/0';
		
	if ( value )

		url+= '/'+value;

	else

		url+= '/0'; 
	
	url+='/'+year;
	
	if ( country && catalog && year ){

		toGo = (path+'index.php/explore/banknote/'+url+'/1').toLowerCase();
		location.href = toGo;

	}

	else{

		alert(translation.pais_catalogo_obligatorio);

	}

}

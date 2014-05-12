<script>

var selectedCategory = -1;
var selectedCountry = -1;
var selectedList = -1;
var selectedItems = new Array();

function send(){
	
	type = $("#type").val();
	trade_user = $("#trade_user").val();
	id_user = $("#id_user").val();
	category = $("#category").val();
	step = parseInt($("#step").val());
	
	form = document.getElementById('trade-form');
	
	if ( selectedItems.length > 0 && trade_user.length > 0 && id_user.length > 0 && category.length > 0 ){
		
		if ( type == "buy" ){
			form.action = path+'index.php/trade/trade_buy';
			form.submit();
		}
		else{
			if ( step == 1 ){
				username = $("#trade_username").val();
				form.action = path+'index.php/trade/exchange/'+username+"/step_2";
				form.submit();
			}
			else{
				
				selected_items1 = $("#selected_items1").val();
				
				if ( selected_items1.length > 0 ){
					form.action = path+'index.php/trade/trade_exchange';
					form.submit();
				}
			}
		}
		
	}
	else{
		alert('You must select an article');
	}
}

function showCategories( ){
	
	if ( $("#step").val() == "2" ){
		
		category = parseInt($("#category").val());
		list = parseInt($("#list").val());
		showList( category , list , 1 );
		return;
	}
	
	if ( selectedItems.length > 0 ){
		
		if ( confirm('Selected items will be cleared. Continue?') ){
			selectedItems = new Array();
			refreshSelectedList();
		}
		else{
			return;
		}
	}
	
	$("#mini-explore-lists").prop('disabled',true);
	selectedCategory = -1;
	selectedCountry = -1;
	selectedList = -1;
	
	if ( $("#step").val() == "2" ){
		id = $("#id_user").val();
	}
	else{
		id = $("#trade_user").val();
	}
	list = $("#list").val();
	
	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	
	$("#user-collection-list").load(path+'ajax/mini-explore/coins/list_categories.php',{id:id,list:list});
}

function showList( cat , list , pag ){
	
	if ( $("#step").val() == "2" ){
		id = $("#id_user").val();
	}
	else{
		id = $("#trade_user").val();
	}
	
	selectedCategory = cat;
	$("#category").val(cat);
	selectedList = list;
	$("#list").val(list);
	selectedCountry = -1;
	
	setUserLists();
	
	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	
	$("#user-collection-list").load(path+'ajax/mini-explore/coins/list_countries.php',{cat:cat, list:list, id:id , pag:pag});
}

function showList_step2( cat , list , cou ){
	
	selectedCategory = cat;
	selectedList = list;
	selectedCountry = cou;
	
	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	
	if ( $("#step").val() == "2" ){
		u = $("#id_user").val();
	}
	else{
		u = $("#trade_user").val();
	}
	
	$("#user-collection-list").load(path+'ajax/mini-explore/coins/list_titles.php',{cat:cat, list:list, u:u , cou:cou});
}

function showList_final( cat , list , cou , title , pag ){
	
	selectedCategory = cat;
	selectedCountry = cou;
	selectedList = list;
	
	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	
	if ( $("#step").val() == "2" ){
		u = $("#id_user").val();
	}
	else{
		u = $("#trade_user").val();
	}
	
	if ( !pag ){
		pag = 1;
	}
	
	$("#user-collection-list").load(path+'ajax/mini-explore/coins/user_coins.php',{cat:cat, list:list, id:u , cou:cou , title:title , pag:pag });
	
}

function showList_search( cat , list , cou , pag , query ){

	document.getElementById('user-collection-list').innerHTML = '<div id="loading_div"><img src="'+path+'img/ajax-loader.gif" /></div>';
	
	if ( $("#step").val() == "2" ){
		u = $("#id_user").val();
	}
	else{
		u = $("#trade_user").val();
	}
	
	switch( cat ){
		case 1:
			page = 'search_phonecards.php';
			break;
	}
	
	if ( !pag )
		pag = 1;
		
	if ( !page ){
		alert('error en categoria');
	}
	
	$("#user-collection-list").load(path+'ajax/mini-explore/'+page,{cat:cat, list:list, id:u , cou:cou , pag:pag , query:query });
}

$(document).ready(function(){
	$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
	$('a[rel*=leanModalTP]').leanModal({ top : 40, closeButton: ".modal-close" });

	$('#modal-close').click(function(){
		$("#lean_overlay").click();
	});
	
	
	cat = $("#category").val();
	list = $("#list").val();
	
	if ( cat.length > 0 ){
		showList( parseInt(cat) , parseInt(list) , 1 );
	}
	else{
		showCategories();
	}
	
});

function modalCoin( _p ){

	$("#modal-coin").load(path+'ajax/showCoin.php',{p:_p},function(){
		$("#modalC").click();
	});
	
	return false;
}

function modalTradeCoin( p , trade_type ){
	$("#modal-trade-coin").load(path+'ajax/showTradeCoin.php',{p:p,type:trade_type,button:0},function(){
		$("#modalTC").click();
	});
	
	
}

Array.prototype.contains = function( newItem ) {
    for (var i = 0; i < this.length; i++) {
        if (this[i].id === newItem.id && this[i].id_coins_users === newItem.id_coins_users ) {
            return i;
        }
    }
    return -1;
}

function Item(id,id_coins_users,value,issued_on,checkbox){
	this.id=id;
	this.id_coins_users=id_coins_users;
	this.value=value;
	this.issued_on = issued_on;
	this.checkbox = checkbox;
}

function checkItem( p , id_coins_users, value , issued_on , checkbox ){
	
	var newItem = new Item(p,id_coins_users,value,issued_on,checkbox);
	
	index = selectedItems.contains(newItem);
	
	if ( index != -1 ){
		try{
			selectedItems[index].checkbox.checked = false;
		}
		catch( e ){
		}
		selectedItems.splice(index,1);
	}
	else{
		selectedItems.push(newItem);
	}
	
	refreshSelectedList();
	//alert(selectedItems.join("\n"));
}

function refreshSelectedList(){
	
	selectedDiv = document.getElementById('mini-explore-selected');
	selectedDiv.innerHTML = '';
	$("#selected_items").val('');
	var trade_type = $("#trade_type").val();
	
	for ( i = 0 ; i < selectedItems.length ; i++ ){
		
		div = document.createElement('div');
		div.className = 'mini-explore-selected-item';
		div.innerHTML = '<img onClick="checkItem('+selectedItems[i].id+','+selectedItems[i].id_coins_users+',\'\',\'\')" src="'+path+'img/modal-close.png" title="Remove from list" />&nbsp;<span class="trade_sel_item" onClick="modalTradeCoin('+selectedItems[i].id_coins_users+','+trade_type+')"><b>'+selectedItems[i].value+'</b></span> | '+selectedItems[i].issued_on;
		
		selectedDiv.appendChild(div);
		var selected_ = selectedItems[i].id_phonecards_users+",";
		
		$("#selected_items").val( $("#selected_items").val()+selected_ );
	}
	
	$("#selected_items").val( $("#selected_items").val().substring(0,$("#selected_items").val().length-1));
}

function refreshCheckbox( p ,id_phonecards_users, checkbox_id ){
	//alert(p+"|"+id_phonecards_users+"|"+checkbox_id);
	var newItem = new Item(p,id_phonecards_users,'','','');
	index = selectedItems.contains(newItem);
	
	if ( index != -1 ){
		checkbox = document.getElementById('checkbox'+checkbox_id);
		checkbox.checked = true;
		selectedItems[index].checkbox = checkbox;
	}
	
}

function miniSearchGo(){
	
	query = $("#mini-explore-search").val();
	
	if ( query.length > 0 ){
		
		if ( selectedCategory != -1 && selectedCountry != -1 && selectedList != -1 ){
			showList_search( selectedCategory , selectedList , selectedCountry , 1 , query ); 
		}
		else{
			alert('Select category and country');
		}
		
	}
}

function setUserLists(){
	
	if ( selectedCategory != -1 ){
		u = $("#trade_user").val();
		$("#mini-explore-lists").load(path+'ajax/mini-explore/coins/user_lists.php',{ cat: selectedCategory+1 , u:u });
	}
	
	$("#mini-explore-lists").prop('disabled',false);
}

function changeToList( dom ){
	
	if ( selectedCategory != -1 ){
		value = $(dom).val();
		value = value.split(',');
		showList( parseInt(value[0])-1 , parseInt(value[1]) , 1 );
	}
}

function miniSearchKey( e ){
	
	if ( e.keyCode == 13 ){
		miniSearchGo();
	}
}

</script>
<?php

$category = $_REQUEST['category'];
$user_id = $_REQUEST['user_id'];
$type = $_REQUEST['type'];
$exchange_step = $_REQUEST['step'];
$pre = $_REQUEST['pre'];
$pre2 = $_REQUEST['pre2'];

$list = 0;

if ( !$user_id || !$type ){
	die('error');
}

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
}

//echo $category.' | '.$user_id.' | '.$type.' | '.$exchange_step.' | '.$pre.' | '.$pre2;

@session_start();

if ( strcmp($type,"exchange") == 0 ){
	
	$list = 3;
	
	if ( !isset($exchange_step) ){
		$exchange_step = 1;
	}
}
else{
	$list = 5;
}

if ( isset($exchange_step) && $exchange_step == 2 ){
	$user_sql = 'SELECT * FROM users WHERE id_users = '.$_SESSION['id_users'];
}
else{
	$user_sql = 'SELECT * FROM users WHERE id_users = '.$user_id;
}

$user_cursor = mysql_query($user_sql);

if ( mysql_num_rows($user_cursor) == 0 ){
	die('error');
}

$user0 = mysql_fetch_array($user_cursor);

if ( isset($pre) ){
	
	$pre_sql = 'SELECT cat.* , val.name as value FROM coins cat , coins_value val WHERE cat.id_coins = '.$pre.' AND cat.id_coins_title = val.id_coins_title';
	$pre_cursor = mysql_query($pre_sql);
	$pre_datos = mysql_fetch_array($pre_cursor);
	?>
	<script>
		var newItem = new Item(<?php echo $pre_datos['id_coins'] ?>, <?php echo $pre2; ?>,'<?php echo utf8_encode($pre_datos['value']); ?>','<?php echo $pre_datos['issued_on']; ?>',null);
		selectedItems.push(newItem);
		refreshSelectedList();
	</script>
	<?php
}


?>


<a id="modalC" style="display:none;" rel="leanModal" href="#modal-coin">a</a>
<div id="modal-coin"></div>
<a id="modalTC" style="display:none;" rel="leanModalTC" href="#modal-trade-coin">a</a>
<div id="modal-trade-coin"></div>

<div id="mini-explore" class="box1">
	<form id="trade-form" action="" method="post" >
		<input type="hidden" name="category" id="category" value="<?php echo $category; ?>" />
		<input type="hidden" id="type" value="<?php echo $type; ?>" />
        <input type="hidden" id="trade_type" value="<?php echo strcmp($type,"exchange") == 0 ? '3':'5'; ?>"/>
		<input type="hidden" name="trade_user" id="trade_user" value="<?php echo $user_id; ?>" />
		<input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_users']; ?>" />
		<input type="hidden" id="step" value="<?php echo $exchange_step; ?>" />
		<input type="hidden" id="list" value="<?php echo $list; ?>" />
		<input type="hidden" name="selected_items" id="selected_items" />
		<input type="hidden" id="trade_username" value="<?php echo $user0['user']; ?>" />
		<?php
		if ( isset($exchange_step) && $exchange_step == 2 ){
			?>
			<input type="hidden" id="selected_items1" name="selected_items1" value="<?php echo $_REQUEST['selected_items1']; ?>" />
			<?php
		}
		?>
	</form>
	<div id="mini-explore-selected2">
		<div id="mini-explore-selected"></div>
		<div style="clear:both;"></div>
	</div>
	<div id="mini-explore-bar">
		<table width="100%">
			<tr>
				<td>
					<span><?php echo $lang['seleccionar_de_los_listados_de']; ?> @<?php echo $user0['user']; ?>&nbsp;</span>
					<select id="mini-explore-lists" disabled="disabled" onchange="changeToList(this);">
						<option value="-1" selected="selected"><?php echo $lang['seleccionar']; ?></option>
					</select>
				</td>
				<td style="text-align:right;">
					<img id="mini-search-go" src="<?php echo $path; ?>img/search2.png" onclick="miniSearchGo();" />
					<input type="text" id="mini-explore-search" onkeyup="miniSearchKey(event)"  />
				</td>
			</tr>
		</table>				
	</div>
	
	<div id="mini-explore-content">
		<div id="mini-explore-content-in">
			<div id="user-collection-list">asd</div>
		</div>
	</div>
	
</div>
<div style="float:right; margin-top:10px;">
	<?php
		if ( strcmp($type,"buy") == 0 ){
		?>
        	<span class="google-button google-button-red" onClick="location.href='javascript:window.history.back();'"><?php echo $lang['cancelar']; ?></span>
			<span class="google-button google-button-blue" onClick="send()"><?php echo $lang['finalizar']; ?></span>
		<?php
		}
		else{
			if ( $exchange_step == 1 ){
			?>
            	<span class="google-button google-button-red" onClick="location.href='javascript:window.history.back();'"><?php echo $lang['cancelar']; ?></span>
				<span class="google-button google-button-blue" onClick="send()"><?php echo $lang['siguiente']; ?></span>
			<?php
			}
			else{
			?>
            	<span class="google-button google-button-red" onClick="location.href='javascript:window.history.back();'"><?php echo $lang['regresar']; ?></span>
				<span class="google-button google-button-blue" onClick="send()"><?php echo $lang['finalizar']; ?></span>
			<?php
			}
		}
	?>
</div>
<div style="clear:both;"></div>
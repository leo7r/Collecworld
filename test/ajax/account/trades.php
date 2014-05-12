<script>

function trade_item_click( dom , text ){
	list = $(dom).find('.trade_items_list');
	list = list[0];
	
	
	if ( $(list).css('display') == 'none' ){
		$(list).css({ display: 'block' });
		$(text).html('Hide details');
	}
	else{
		$(list).css({ display: 'none' });
		$(text).html('View details');
	}
}

</script>
<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 

session_start();

if ( !isset($_SESSION['id_users']) ){
	die('Log in first, please.');
}

$myTrade_sql = 'SELECT t.* , u.name as user_name , u.image , u.user , c.name as country FROM trade t , users u , countries c WHERE t.id_users = '.$_SESSION['id_users'].' AND t.id_trade_users = u.id_users AND u.id_countries = c.id_countries ORDER BY t.date DESC';
$myTrade_cursor = mysql_query($myTrade_sql);


$tradeRequest_sql = 'SELECT t.* , u.name as user_name , u.image , u.user , c.name as country FROM trade t , users u , countries c WHERE t.id_trade_users = '
	.$_SESSION['id_users'].' AND t.id_users = u.id_users AND u.id_countries = c.id_countries ORDER BY t.date DESC';
$tradeRequest_cursor = mysql_query($tradeRequest_sql);

echo '<div class="title4">'.$lang['comercios'].'</div>
	<div id="trade-list"><br />';
	
include 'trades_requests.php';
echo '<br>';
include 'trades_by_me.php';

echo '</div>';
?>
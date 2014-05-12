<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

@session_start();

$option = (int) $_REQUEST['option'];
$id_trade = $_REQUEST['trade'];
$trade_user = $_REQUEST['trade_user'];
$comments = $_REQUEST['comments'];

if ( $id_trade && $trade_user && ( $option == 0 || $option == 1 ) ){

	$verif = 'SELECT * FROM trade_users tu , trade t WHERE t.id_trade = '.$id_trade.' AND t.status = 1 AND t.id_trade = tu.id_trade AND id_users = '.$trade_user;
	$verifC = mysql_query($verif);
	
	if ( mysql_num_rows($verifC) == 0 ){
		$sql = 'INSERT INTO trade_users (id_trade,id_users,calification,status,comments) VALUES ('.$id_trade.','.$trade_user.','.$option.',0,"'.$comments.'")';
		mysql_query($sql);
		
		echo 'OK';
		return;
	}
}

echo 'ERROR';
?>
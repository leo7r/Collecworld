<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

session_start();

if ( !isset($_SESSION['id_users']) ){
	die('Log in first, please.');
}

$id_trade = $_REQUEST['id'];
$type = $_REQUEST['type'];

if ( !$type || !$id_trade ){
	die('error');
}
else{

	$trade_sql = 'SELECT t.* , u.name FROM trade t , users u WHERE id_trade = '.$id_trade.' AND id_trade_users = u.id_users';
	$trade_cursor = mysql_query($trade_sql);
	$trade_datos = mysql_fetch_array($trade_cursor);

	$sql = 'UPDATE trade SET status = '.$type.' WHERE id_trade = '.$id_trade.' LIMIT 1';
	
	try{
		mysql_query($sql);
		
		switch( $type ){
		
		case 1:
			$sql2 = 'INSERT INTO notifications (description,status,date,id_users,type,id_users2,info) VALUES ("'.$desc.'",0,'.time().','
				.$trade_datos['id_users'].',6,'.$trade_datos['id_trade_users'].',"'.$id_trade.'")';
			break;
		case 2:
			$sql2 = 'INSERT INTO notifications (description,status,date,id_users,type,id_users2,info) VALUES ("'.$desc.'",0,'.time().','
				.$trade_datos['id_users'].',7,'.$trade_datos['id_trade_users'].',"'.$id_trade.'")';
			break;
		}
		
		
		mysql_query($sql2);
		
		echo 'OK';
	}
	catch( Exception $e ){
		echo 'error';
	}

}
?>
<?php
	
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$mail = $_REQUEST['mail'];
$date = strval(time());

$verif = 'SELECT * FROM subscribe where mail = "'.$mail.'"';
$verif_cursor = mysql_query($verif);

if ( mysql_num_rows($verif_cursor) == 0 ){
	
	
		$sql = 'INSERT INTO subscribe (mail,date) VALUES ("'.$mail.'","'.$date.'");';
		$result = mysql_query($sql);
		echo 'ok';
	
}
else{
	echo 'duplicated';
}

?>
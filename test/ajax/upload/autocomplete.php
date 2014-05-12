<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$sql = 'SELECT * FROM '.$_REQUEST['table'].' WHERE name LIKE "'.$_REQUEST['term'].'%" GROUP BY name ORDER BY name LIMIT 10';
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) <= 0 )
	return '[]';

$ret = '[ ';

for ($i=0 ; $i< mysql_num_rows($cursor) ; $i++){

	$data = mysql_fetch_array($cursor);	
	$ret = $ret.'"'.$data['name'].'" , ';
}

$ret = substr($ret,0,strlen($ret)-2);
$ret = $ret.' ]';
echo $ret;

?>
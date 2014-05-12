<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$serie = $_REQUEST['id_serie'];

$sql = 'SELECT p.id_phonecards_systems FROM phonecards p , phonecards_series ps WHERE ps.id_phonecards_series = '.$serie.' and ps.id_phonecards_series = p.id_phonecards_series group by p.id_phonecards_systems;';
$cursor = mysql_query($sql);

$ret = '';

for ( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){
	$sys = mysql_fetch_array($cursor);
	$ret = $ret.$sys['id_phonecards_systems'].',';
}

echo substr($ret,0,strlen($ret)-1);

?>
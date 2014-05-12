<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$countries = $_REQUEST['abbr'];

$sql = 'SELECT bt.* , COUNT(bt.id_banknotes_title) as num FROM banknotes ban, banknotes_title bt , countries c WHERE c.abbreviation = "'.$countries.'" AND bt.id_countries = c.id_countries AND ban.id_banknotes_title = bt.id_banknotes_title GROUP BY bt.id_banknotes_title HAVING num > 0 ORDER BY bt.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="ti-'.$datos['id_banknotes_title'].'" onClick="explore_title_banknote(this,\''.$datos['id_banknotes_title']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$companies = $_REQUEST['abbr'];

$sql = 'SELECT ps.* , COUNT(ps.id_phonecards_series) as num FROM phonecards p, phonecards_series ps , phonecards_companies pc WHERE pc.abbreviation = "'.$companies.'" AND ps.id_phonecards_companies = pc.id_phonecards_companies AND ps.name <> "" AND p.id_phonecards_series = ps.id_phonecards_series GROUP BY ps.id_phonecards_series HAVING num > 0 ORDER BY ps.name';
$cursor = mysql_query($sql);

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){
	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="ser-'.$datos['id_phonecards_series'].'" onClick="explore_serie(this,'.$datos['id_phonecards_series'].');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
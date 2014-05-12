<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php'; 
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php'; 
}

$id = $_REQUEST['id'];

if($id==0){
	
	$sql = 'SELECT coun.* , COUNT(b.id_banknotes) as num FROM banknotes b, countries coun  WHERE b.id_countries= coun.id_countries GROUP BY b.id_countries HAVING num > 0 ORDER BY coun.name';
	
}else{

	$sql = 'SELECT coun.* , COUNT(b.id_banknotes) as num FROM banknotes b, countries coun  WHERE b.id_banknotes_circulation = "'.$id.'" AND b.id_countries= coun.id_countries GROUP BY b.id_countries HAVING num > 0 ORDER BY coun.name';
	

}

$cursor = mysql_query($sql);
	
$num = mysql_num_rows($cursor);

if($num){
		
	
	for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){
	
		
		$datos = mysql_fetch_array($cursor);
		echo '<li id="cou-'.$datos['abbreviation'].'" onClick="explore_country_banknote(this,\''.$datos['abbreviation']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
	}
}else{
	
	echo '<li>'.$lang['no_hay_resultados'].'</li>';
	
}
?>
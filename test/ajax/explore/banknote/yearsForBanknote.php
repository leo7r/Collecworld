<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$country = $_REQUEST['country']; 
$title = $_REQUEST['title']; 
$subtitle = $_REQUEST['subtitle']; 
$denomination = $_REQUEST['denomination']; 
$value = $_REQUEST['value']; 

if($value){
	
$sql = 'SELECT b.issued_on_gre FROM banknotes b, countries coun WHERE b.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND b.id_banknotes_title = '.$title.' AND b.id_banknotes_subtitle = '.$subtitle.' AND b.id_banknotes_denomination = '.$denomination.' AND b.id_banknotes_value = '.$value.' group by b.issued_on_gre';
	
}else if( $denomination ){
	
$sql = 'SELECT b.issued_on_gre FROM banknotes b, countries coun WHERE b.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND b.id_banknotes_title = '.$title.' AND b.id_banknotes_subtitle = '.$subtitle.' AND b.id_banknotes_denomination = '.$denomination.' group by b.issued_on_gre';
	
}else if( $subtitle ){
	
$sql = 'SELECT b.issued_on_gre FROM banknotes b, countries coun WHERE b.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND b.id_banknotes_title = '.$title.' AND b.id_banknotes_subtitle = '.$subtitle.' group by b.issued_on_gre';		
	
}else if( $title ){
	
$sql = 'SELECT b.issued_on_gre FROM banknotes b, countries coun WHERE b.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND b.id_banknotes_title = '.$title.' group by b.issued_on_gre';	
	
}else if( $country ){ 

$sql = 'SELECT b.issued_on_gre FROM banknotes b, countries coun WHERE b.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" group by b.issued_on_gre';

}
$cursor = mysql_query($sql);

$years = array();

for( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){
	
	$datos = mysql_fetch_array($cursor);
	$year = $datos['issued_on_gre'];
	
	if ( strcmp($year,"Unknown") != 0 ){
		$year = explode('/',$year);
		$year = $year[0];
		
		if ( !in_array($year, $years)){
			$years[] = $year;
		}
	}
}

$years = array_unique($years);

$years = implode(",",$years);

echo $years;

?>
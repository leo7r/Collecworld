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
	
	
}else if( $denomination ){
	
	
}else if( $subtitle ){
	
	
}else if( $title ){
	
	
}else if($country){

  
$sql = 'SELECT c.issued_on FROM coins c, countries coun WHERE c.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" group by c.issued_on;';


}
$cursor = mysql_query($sql);

$years = array();

for( $i = 0 ; $i < mysql_num_rows($cursor) ; $i++ ){
	
	$datos = mysql_fetch_array($cursor);
	$year = $datos['issued_on'];
	
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
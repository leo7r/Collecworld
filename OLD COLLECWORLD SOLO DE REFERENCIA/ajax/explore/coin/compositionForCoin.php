<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
}

$country = $_REQUEST['country']; 
$title = $_REQUEST['title']; 
$subtitle = $_REQUEST['subtitle']; 
$denomination = $_REQUEST['denomination']; 
$value = $_REQUEST['value']; 

if($value){

$sql = 'SELECT cm.*, COUNT(c.id_coins) as num  FROM coins c, coins_material cm, countries coun WHERE c.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND c.id_coins_title = '.$title.' AND c.id_coins_denomination = '.$denomination.' AND c.id_coins_subtitle = '.$subtitle.' AND c.id_coins_value = '.$value.' AND c.id_coins_composition = cm.id_coins_material group by cm.id_coins_material'; 	 	 
	
}else if( $denomination ){

$sql = 'SELECT cm.*, COUNT(c.id_coins) as num  FROM coins c, coins_material cm, countries coun WHERE c.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND c.id_coins_title = '.$title.' AND c.id_coins_denomination = '.$denomination.' AND c.id_coins_subtitle = '.$subtitle.' AND c.id_coins_composition = cm.id_coins_material group by cm.id_coins_material'; 	 
	
}else if( $subtitle ){

$sql = 'SELECT cm.*, COUNT(c.id_coins) as num  FROM coins c, coins_material cm, countries coun WHERE c.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND c.id_coins_title = '.$title.' AND c.id_coins_subtitle = '.$subtitle.' AND c.id_coins_composition = cm.id_coins_material group by cm.id_coins_material'; 	
 	
}else if( $title ){
	
$sql = 'SELECT cm.*, COUNT(c.id_coins) as num  FROM coins c, coins_material cm, countries coun WHERE c.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND c.id_coins_title = '.$title.' AND c.id_coins_composition = cm.id_coins_material group by cm.id_coins_material'; 
	
}else if( $country ){ 

$sql = 'SELECT cm.*, COUNT(c.id_coins) as num  FROM coins c, coins_material cm, countries coun WHERE c.id_countries = coun.id_countries AND coun.abbreviation = "'.$country.'" AND c.id_coins_composition = cm.id_coins_material group by cm.id_coins_material';

}
$cursor = mysql_query($sql);

echo '<li class="selected">'.$lang['todos_los_materiales'].'</li>';

for ( $i = 0  ; $i < mysql_num_rows($cursor) ; $i++ ){

	
	$datos = mysql_fetch_array($cursor);
	echo '<li id="comp-'.$datos['id_coins_material'].'" onClick="explore_composition_coin(this,\''.$datos['id_coins_material']."'".');" >'.$datos['name'].' ('.$datos['num'].')</li>';
}

?>
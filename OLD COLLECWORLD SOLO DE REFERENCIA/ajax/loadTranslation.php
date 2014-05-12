<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
}

$translations = $_REQUEST['trans'];
$tArray = explode('$',$translations);

$ret = array();

for ( $i = 0 ; $i < count($tArray) ; $i++ ){
	$ret[$tArray[$i]] = $lang[$tArray[$i]];
}

echo json_encode($ret);

<?php

@session_start();

if ( isset($_SESSION['selected_lang']) && strlen($_SESSION['selected_lang']) > 0 ){
	$language = $_SESSION['selected_lang'];	
}
else{
	$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}
 
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
 
	switch($language){
	
	case 'es':
		include $_SERVER['DOCUMENT_ROOT'].'/application/language/spanish/app_lang.php';
		break;
	default:
		include $_SERVER['DOCUMENT_ROOT'].'/application/language/english/app_lang.php';
		break;
	}
	
}else{
	
	switch($language){
		
	case 'es':
		include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/spanish/app_lang.php';
		break;
	default:
		include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/english/app_lang.php';
		break;	
	}
	
} 

?>
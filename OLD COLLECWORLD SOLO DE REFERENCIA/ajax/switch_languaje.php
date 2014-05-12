<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$lang = $_REQUEST['lang'];

@session_start();

if ( $lang == -1 || strcmp($lang,'-1') == 0 ){
	$_SESSION['selected_lang'] = '';
	setcookie("selected_lang", "", time()+(10 * 365 * 24 * 60 * 60));
}
else{
	$_SESSION['selected_lang'] = $lang;
	setcookie("selected_lang", $lang, time()+(10 * 365 * 24 * 60 * 60));
}

?>
<?php

@header('Content-Type: text/html; charset=ISO-8859-15'); 

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
   	$server = 'localhost';
	$bd = 'collecwo_test';
	$bd_user = 'collecwo_beto';
	$bd_pass = 'l12e10o90@l12';
	
	$path = 'http://collecworld.com/';
}
else{
	$server = 'localhost';
	$bd = 'collecworld';
	$bd_user = 'root';
	$bd_pass = '';
	
	$path = 'http://localhost/collecworld/';
}
$link = mysql_connect($server , $bd_user , $bd_pass );
mysql_select_db($bd , $link);	
?>
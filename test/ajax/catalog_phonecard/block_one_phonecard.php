<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	 }

$status = $_REQUEST['status'];

$id_phonecards = $_REQUEST['id_phonecards'];

$result="";

if($_SESSION['status']==1){

if($status==1){
	$sql1=mysql_query("UPDATE `phonecards` SET `edit`='0',`delete`='0' where `id_phonecards`='$id_phonecards'");
	$result=$lang['bloquear'];
}else{
	$sql1=mysql_query("UPDATE `phonecards` SET `edit`='1',`delete`='1' where `id_phonecards`='$id_phonecards'");
	$result=$lang['desbloquear'];
}

}

echo json_encode($result);
?>
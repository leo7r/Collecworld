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

$company = $_REQUEST['company'];

$system = $_REQUEST['system'];

$date = $_REQUEST['date'];

$internal = $_REQUEST['internal'];

$status = $_REQUEST['status'];

$saved = $_REQUEST['saved'];

$result="";
if($_SESSION['status']==1){
$sql1="UPDATE `phonecards` SET `edit`='$status',`delete`='$status' where `id_countries`='$country' and `id_phonecards_companies`='$company' and `id_phonecards_systems`='$system' and `not_emmited`='$internal' ";

if($date==0){
$sql1.="and `order_date`='Unknown'";
}else{
$sql1.="and `order_date`!='Unknown'";
}

$query=mysql_query($sql1);
//se verifica el nivel del usuario Conectado 
/*echo $company." ".$system." ".$date." ".$internal;*/
if($saved==0){

//se obtiene el id del pais del cual depende la compañia
$sql=mysql_query("INSERT INTO `phonecards_done`(`id_phonecards_done`, `id_countries`, `id_phonecards_companies`, `id_phonecards_systems`, `not_emmited`, `order_date`, `status`) VALUES (null,'$country','$company','$system','$internal','$date','1')");

}else{
//se verifica si es tarjeta no vendida al publico
$sql=mysql_query("UPDATE `phonecards_done` SET `status`='$status' WHERE `id_countries`='$country' and `id_phonecards_companies`='$company' and `id_phonecards_systems`='$system' and `order_date`='$date' and `not_emmited`='$internal'");

}
if($status==1){
$result=$lang['bloquear'];
}else{
	$result=$lang['desbloquear'];
}
}
echo json_encode($result);
?>
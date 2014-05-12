<?php



if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	 }

$status = $_SESSION['status'];

$company = $_REQUEST['abbr'];

$system = $_REQUEST['system'];

$date = $_REQUEST['date'];

$internal = $_REQUEST['internal'];

$block="";

//se verifica el nivel del usuario Conectado 
/*echo $company." ".$system." ".$date." ".$internal;*/
if($status==1){

//se obtiene el id del pais del cual depende la compañia
$sql=mysql_query("SELECT  `id_countries`, `id_phonecards_companies`  FROM `phonecards_companies` WHERE `abbreviation`='$company'");
$query=mysql_fetch_array($sql);

//se verifica si es tarjeta no vendida al publico
if($internal==0){
//consulta en caso de ser tarjetas con fecha o sin fecha
$sql1=mysql_query("SELECT * FROM `phonecards_done` WHERE `id_countries`='$query[0]' and `id_phonecards_companies`='$query[1]' and `id_phonecards_systems`='$system' and `order_date`='$date' and `not_emmited`='$internal'");
$id=$date;
}else{
//consulta en caso de ser tarjeta no vendida al publico
$sql1=mysql_query("SELECT * FROM `phonecards_done` WHERE `id_countries`='$query[0]' and `id_phonecards_companies`='$query[1]' and `id_phonecards_systems`='$system' and `not_emmited`='$internal'");
/*echo $company." ".$system." ".$date." ".$internal;*/
$id=2;
}
//imprimir Valores
$query1=mysql_fetch_array($sql1);
$query1_num=mysql_num_rows($sql1);

if(($query1_num==0)||($query1['status']==0)){

$block = "<span class='google-button google-button-red' id='datedCB".$id."' onclick='block_phonecard($query[0],$query[1],$system,$date,$internal,1,$query1_num)' >".$lang['bloquear']."</span>";

}else{

$block = "<span class='google-button google-button-green' id='datedCB".$id."'  onclick='block_phonecard($query[0],$query[1],$system,$date,$internal,0,$query1_num)'>".$lang['desbloquear']."</span>";

}

}

echo json_encode($block);
?>
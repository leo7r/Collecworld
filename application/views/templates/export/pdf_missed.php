

<?php



@session_start();



if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	require_once($_SERVER['DOCUMENT_ROOT']."/dompdf/dompdf_config.inc.php");

}

else{

	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	require_once($_SERVER['DOCUMENT_ROOT']."collecworld/dompdf/dompdf_config.inc.php");

}






//CATALOGO

switch($catalog){



case 1: $catalog2=$lang['tarjetas_fecha']; break;

case 2: $catalog2=$lang['tarjetas_sin_fecha']; break;

case 3: $catalog2=$lang['tarjetas_uso_interno']; break;

case 4: $catalog2=$lang['tarjetas_especiales']; break;

   

}

//LISTA

switch($id_list){

	default: $list_name = $list['name']; break;
	
	case 1: $list_name = $lang['coleccion']; break;
	
	case 2: $list_name = $lang['deseo']; break;
	
	case 3: $list_name = $lang['intercambio']; break;
	
	case 5: $list_name = $lang['venta']; break;
	
}


if($id_list == 5){

$desc = $lang['estado'].'-'.$lang['precio'];

	
}else{

$desc = $lang['notas'];

}


//RECIBIR VARIABLES 



$id_users = $user;



$id_list = $list['id_lists'];



$id_countries = $country;



$id_companies = $company;



$catalog = $catalog;



$system = $system;







//id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$_SESSION['id_users'].' AND id_lists = '.$list.' )



$sql = '
SELECT p.id_phonecards as id, p.name as name , p.code as code, p.id_phonecards_systems , p.id_variation1, p.issued_on, p.print_run, p.face_value, s.name as serie , c.name as country, pc.name as company, cu.name as currency FROM phonecards p , phonecards_series s, countries as c, phonecards_companies pc, currencies cu  WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND cu.id_currencies = p.id_currencies  AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards_companies = '.$id_companies.' AND p.id_countries = '.$id_countries.' AND p.id_phonecards_systems = '.$system.' AND p.id_phonecards NOT IN ( SELECT p.id_phonecards FROM phonecards p , phonecards_series s, countries as c, phonecards_companies pc WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards_companies = '.$id_companies.' AND p.id_countries = '.$id_countries.' AND p.id_phonecards_systems = '.$system.' AND p.id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$id_users.' AND id_lists = '.$id_list.' ) )';


switch ( $catalog ){

case 1:

	$sql = $sql.' AND p.order_date <> "Unknown" AND p.not_emmited = 0 AND p.especial = 0';
	break;

case 2:

	$sql = $sql.' AND p.order_date = "Unknown" AND p.not_emmited = 0 AND p.especial = 0';
	break;

case 3:

	$sql = $sql.' AND p.not_emmited = 1';
	break;

case 4:

	$sql = $sql.' AND p.especial = 1';
	break;

}

if ( isset($variation) && $variation == 1 ){
	$sql = $sql.' GROUP BY p.id_phonecards_companies , p.name, p.face_value, p.print_run';	
}


$sql = $sql.' ORDER BY p.order_n , p.order_date , p.face_value , p.print_run , p.name , p.serie_number , p.id_phonecards';
$cursor = mysql_query($sql);

if ( mysql_num_rows($cursor) > 0 ){

$html ='
<html>
	<head> 
	</head>
	<body>

';



$html = $html .'

	<table id="collections-table" width="600" cellpadding="5" >

	

		<tr>

			<td colspan="8"><h1>Collecworld</h1></td>

		</tr>

		

		<tr>

			<td colspan="8"><h3 style="margin:0; padding:0;">'.$lang['informacion'].'</h3></td>

		</tr>

		<tr>

			<td colspan="8"><strong>'.$lang['usuario'].':</strong> '.$user_info['user'].'</td>

		</tr>

		<tr>

			<td colspan="8"><strong>'.$lang['nombre'].':</strong> '.$user_info['name'].'</td>

		</tr>

		<tr>

			<td colspan="8"><strong>'.$lang['pais'].':</strong> '.$user_info['Country'].'</td>

		</tr>

		

		<tr>

			<td colspan="8">&nbsp;</td>

		</tr>

';



$html = $html .'

		<tr>

			<td colspan="8"><strong>'.$list_name.' > '.$country_info['name'].' > '.$company_info['name'].' > '.$catalog2.'</strong><td>

		</tr>';



$html = $html .'

		<tr class="collections-table-head" valign="middle">

		

			<td width="100"><strong>'.$lang['numero_catalogo'].'</strong></td>			

			<td width="100"><strong>'.$lang['nombre'].'</strong></td>

		

			<td width="100"><strong>'.$lang['serie'].'</strong></td>

		

			<td width="100"><strong>'.$lang['sistema'].'</strong></td>

		

			<td width="100"><strong>'.$lang['fecha_de_emision'].'</strong></td>

			

			<td width="100"><strong>'.$lang['tiraje'].'</strong></td>

			

			<td width="100"><strong>'.$lang['valor_nominal'].'</strong></td>

			

			<td width="100"><strong>'.$lang['moneda_corriente'].'</strong></td>

		

			<td width="100"><strong>'.$desc.'</strong></td>

		

		</tr>';





for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){	



	$datos = mysql_fetch_array($cursor);



	$sql_list = 'SELECT * FROM phonecards_users WHERE id_users = '.$_SESSION['id_users'].' AND id_phonecards = '.$datos['id'];



	$sql_list = $sql_list.' AND id_lists = '.$id_list;



	$cursor_list = mysql_query($sql_list);



	$datos_list = mysql_fetch_array($cursor_list);

	

		

	//SISTEMA

	

	switch ( intval($datos['id_phonecards_systems']) ){

	

	case 1:

	

		$system2 = $lang['chip'];

	

		break;

	

	case 2:

	

		$system2 = $lang['banda_magnetica'];

	

		break;

	

	case 3:

	

		$system2 = $lang['sistema_optico'];

	

		break;

	

	case 4:

	

		$system2 = $lang['memoria_remota'];

	

		break;

	

	case 5:

	

		$system2 = $lang['sistema_inducido'];

	

		break;

	

	default:

	

		$system2 = $lang['desconocido'];

	

		break;

	

	}

		if($datos['id_variation1']!=0){
			

			$syst = 'SELECT * FROM phonecards_systems WHERE id_phonecards_systems = '.$datos['id_variation1'].';';
	
		
	
			$sysc = mysql_query($syst);
	
			
	
			if ( mysql_num_rows($sysc) != 0 ){
	
				$sysd = mysql_fetch_array($sysc);
				echo $system3 = $sysd['name'];

			}
		}else{
			echo $system3 = "Desconocido";
		}
		
		if($datos['code']){

			$code = $datos['code'];

		}else{

			$code = $lang['desconocido'];	

		}


		if($datos['issued_on']){

			$issued_on = $datos['issued_on'];

		}else{

			$issued_on = $lang['desconocido'];	

		}

				

		if($datos['print_run']){

			$print_run = $datos['print_run'];

		}else{

			$print_run = $lang['desconocido'];	

		}

			

		if($datos['face_value']){

			$face_value = $datos['face_value'];

		}else{

			$face_value = $lang['desconocido'];	

		}

			

		if($datos['currency']){

			$currency = $datos['currency'];

		}else{

			$currency = $lang['desconocido'];	

		}


		if($id_list == 5){
			
			if($datos_list['status_phonecard']){
				
				$status = $datos_list['status_phonecard'];
			}else{
				
				$status = $lang['desconocido'];
			}
			
			if($datos_list['price']){
				
				$price = '$'.$datos_list['price'];
			}else{
				
				$price = $lang['desconocido'];
			}
		
		$desc_value = $status.'-'.$price;
		
			
		}else{
			
			if($datos_list['description']){
				
				$description = $datos_list['description'];
			}else{
				
				$description = $lang['desconocido'];
			}
		
		
		$desc_value = $description;
		
		}
					





	$html = $html .'

		<tr >

		

			<td valign="middle">'.$code.'</td>
			

			<td valign="middle">'.$datos["name"].'</td>

	

			<td valign="middle">'.$datos["serie"].'</td>

	

			<td valign="middle">'.$system2.' '.$system3.'</td>

	

			<td valign="middle">'.$issued_on.'</td>

			

			<td valign="middle">'.$print_run.'</td>

			

			<td valign="middle">'.$face_value.'</td>

			

			<td valign="middle">'.$currency.'</td>

	

			<td valign="middle">

	

				'.$desc_value.'

	

			</td>

	

		</tr>';

	

	

}

	



	

$html = $html .'

		</table>

	<body>

</html>

';

}

   

   $dompdf = new DOMPDF();

   $dompdf->set_paper('letter','landscape');

   $dompdf->set_paper('legal','landscape');

   $dompdf->load_html($html);

   $dompdf->render();

   $dompdf->stream($lang['tarjetas_telefonicas']." faltantes-".$user_info['user'].".pdf");

?>
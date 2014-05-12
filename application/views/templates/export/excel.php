<?php
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {

	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';

}else{

	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
}


header("Content-Type: application/vnd.ms-excel");

header("Expires: 0");

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

header("content-disposition: attachment;filename=".$lang['tarjetas_telefonicas']."-".$user_info['user'].".xls");

?>
<html>

<style type="text/css">
@page {

	margin: 2cm;

}
body {

  font-family: sans-serif;

	margin: 0.5cm 0;

	text-align: justify;

}

</style>
</head>

<body>
<?php


@session_start();


$id_users = $user;
$id_list = $list['id_lists'];
$id_countries = $country;
$id_companies = $company;
$catalog = $catalog;
$system = $system;

//id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$_SESSION['id_users'].' AND id_lists = '.$list.' )

$sql = 'SELECT p.id_phonecards as id, p.name as name, p.code as code, p.id_phonecards_systems, p.id_variation1, p.issued_on, p.print_run, p.face_value, s.name as serie , c.name as country, pc.name as company , cu.name as currency FROM phonecards p , phonecards_series s, countries as c, phonecards_companies pc, currencies cu WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND cu.id_currencies = p.id_currencies AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards_companies = '.$id_companies.' AND p.id_countries = '.$id_countries.' AND p.id_phonecards_systems = '.$system.' AND p.id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$id_users.' AND id_lists = '.$id_list.' ) ';

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
	?>

	<table id="collections-table" width="600" cellpadding="10" >
		<tr>
	        <td colspan="6"><h2>Collecworld</h2></td>
        </tr>
    

        <tr>

        <td colspan="6"><h3><?php echo $lang['informacion']; ?></h3></td>

        </tr>

        <tr>

        <td colspan="6"><strong><?php echo $lang['usuario']; ?>:</strong> <?php echo $user_info['user']; ?></td>

        </tr>

        <tr>

        <td colspan="6"><strong><?php echo $lang['nombre']; ?>:</strong> <?php echo $user_info['name']; ?></td>

        </tr>

        <tr>

        <td colspan="6"><strong><?php echo $lang['pais']; ?>:</strong> <?php echo $user_info['Country']; ?></td>

        </tr>

        

        <tr>

        <td colspan="6">&nbsp;</td>

        </tr>
		<?php
        switch($id_list){

			default: $list_name = $list['name']; break;
			
			case 1: $list_name = $lang['coleccion']; break;
			
			case 2: $list_name = $lang['deseo']; break;
			
			case 3: $list_name = $lang['intercambio']; break;
			
			case 5: $list_name = $lang['venta']; break;
			
		}  
		?> 

        <tr>

        <td colspan="5"><strong><?php echo $list_name; ?> > <?php echo $country_info['name']; ?> > <?php echo $company_info['name']; ?> > 

       

       <?php switch($catalog){ 
	   

		case 1: echo $lang['tarjetas_fecha']; break;

		case 2: echo $lang['tarjetas_sin_fecha']; break;

		case 3: echo $lang['tarjetas_uso_interno']; break;

		case 4: echo $lang['tarjetas_especiales']; break;

		   

	   }?> 

        

        </strong></td>

        </tr>

    	



		<tr class="collections-table-head" style="background:#ccc;" valign="middle">



			<!--<td><strong>#</strong></td>-->

            <td width="120"><strong><?php echo $lang['numero_catalogo']; ?></strong></td>

			<td width="120"><strong><?php echo $lang['nombre']; ?></strong></td>



			<td width="120"><strong><?php echo $lang['serie']; ?></strong></td>



			<td width="120"><strong><?php echo $lang['sistema']; ?></strong></td>



			<td width="120"><strong><?php echo $lang['fecha_de_emision']; ?></strong></td>



			<td width="120"><strong><?php echo $lang['tiraje']; ?></strong></td>



			<td width="120"><strong><?php echo $lang['valor_nominal']; ?></strong></td>



			<td width="120"><strong><?php echo $lang['moneda_corriente']; ?></strong></td>



			<td width="180"><strong><?php  if($id_list==5){ echo $lang['estado'].' - '.$lang['precio']; }else{ echo $lang['notas']; } ?></strong></td>



		</tr>



	



	<?php







		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){



			



			$datos = mysql_fetch_array($cursor);



			



			$sql_list = 'SELECT * FROM phonecards_users WHERE id_users = '.$_SESSION['id_users'].' AND id_phonecards = '.$datos['id'];



			$sql_list = $sql_list.' AND id_lists = '.$id_list;



			$cursor_list = mysql_query($sql_list);



			$datos_list = mysql_fetch_array($cursor_list);



			



			?>



				<tr <?php echo $i % 2 != 0 ? 'class="odd"':''; ?> style="border-bottom:1px solid #ccc;" >

                

                	<td>

					<?php

					if($datos['code']){

						echo $datos['code'];

					}else{

						echo $lang['desconocido'];	

					}

						

					?></td>



					<td><?php echo $datos['name']; ?></td>



					<td><?php echo $datos['serie']; ?></td>



					<td>

					

                    <?php 



						switch ( intval($datos['id_phonecards_systems']) ){

		

							case 1:

		

								echo $lang['chip'];

		

								break;

		

							case 2:

		

								echo $lang['banda_magnetica'];

		

								break;

		

							case 3:

		

								echo $lang['sistema_optico'];

		

								break;

		

							case 4:

		

								echo $lang['memoria_remota'];

		

								break;

		

							case 5:

		

								echo $lang['sistema_inducido'];

		

								break;

		

							default:

		

								echo $lang['desconocido'];

		

								break;

		

						}

					

						$syst = 'SELECT * FROM phonecards_systems WHERE id_phonecards_systems = '.$datos['id_variation1'].';';



						$sysc = mysql_query($syst);

						

						if ( mysql_num_rows($sysc) != 0 ){



						$sysd = mysql_fetch_array($sysc);

						

						echo " ".$sysd['name'];

						

						}



		

						

		

					?>

                    </td>



					<td>

					<?php

					if($datos['issued_on']){

						echo $datos['issued_on'];

					}else{

						echo $lang['desconocido'];	

					}

						

					?></td>

                    

                    <td>

					<?php

					if($datos['print_run']){

						echo $datos['print_run'];

					}else{

						echo $lang['desconocido'];	

					}

						

					?></td>

                    

                    <td>

					<?php

					if($datos['face_value']){

						echo $datos['face_value'];

					}else{

						echo $lang['desconocido'];

					}

						

					?></td>

                    

                    <td>

					<?php

					if($datos['currency']){

						echo $datos['currency'];

					}else{

						echo $lang['desconocido'];

					}

						

					?></td>



					<td >



						<?php 
						if($id_list==5){ 
						
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
						
							echo $status.'-'.$price;  
						
						}else{ 
						
						
							if($datos_list['description']){
								$description = '$'.$datos_list['description'];
							}else{
								$description = $lang['desconocido'];
							}
							
							echo $description;
						
						}
						?>



                    </td>



				</tr>


			<?php



		}



	



	?>



	</table>



	<?php



}



?>

<body>

</html>


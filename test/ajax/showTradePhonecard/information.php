<?php
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
}

session_start();
$id = $_REQUEST['id'];
$sql="select * from phonecards where id_phonecards=".$id;
$cursor=mysql_query($sql);
$num=mysql_num_rows($cursor);

if($num){

	$datos=mysql_fetch_array($cursor);

}

else{

	die('Error fetching data');

}

?>



<div class="title4"><?php echo $lang['informacion']; ?></div>



<table cellpadding="4" cellspacing="0" id="info-table">

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['numero_catalogo']; ?>:</strong></td>

		<td><?php echo strtoupper($datos['code']); ?></td>

	</tr>

<?php

					if ( strcmp($datos['reference'],"")  != 0 ){

?>

					<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['catalogo_referencia']; ?>:</strong></td>

		<td><?php echo $datos['reference']; ?></td>

	</tr>

<?php

					}

?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['pais']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from countries where id_countries = ".$datos['id_countries'];

				$cursor2=mysql_query($sql2);

				$datos2=mysql_fetch_array($cursor2);

				echo $datos2['name'];

			?>

		</td>

	</tr>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['compania']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from phonecards_companies where id_phonecards_companies = ".$datos['id_phonecards_companies'];

				$cursor2=mysql_query($sql2);

				$datos2=mysql_fetch_array($cursor2);

				echo $datos2['name'];

				$company_name = $datos2['name'];

			?>

		</td>

	</tr>

	<?php 

		$sql2="select * from phonecards_series where id_phonecards_series = ".$datos['id_phonecards_series'];

		$cursor2=mysql_query($sql2);

		$datos2=mysql_fetch_array($cursor2);

		

		if ( strcmp($datos2['name'],'') != 0 ){

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> <?php if ( $datos['serie_known'] ) echo 'title="Serie2: NOT printed on phonecard, general knowledge."'; ?> >

		<td><strong><?php if ( $datos['serie_known'] ) echo $lang['serie']."2:"; else echo $lang['serie'].":"; ?></strong></td>

		<td>

			<?php 

				echo $datos2['name'];

				$serie_name = $datos2['name']; 

			?>

		</td>

	</tr>

	<?php

		}

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['sistema']; ?>:</strong></td>

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

				

			?>

		</td>

	</tr>

	<?php

		$syst = 'SELECT * FROM phonecards_systems WHERE id_phonecards_systems = '.$datos['id_variation1'].';';

		$sysc = mysql_query($syst);

		

		if ( mysql_num_rows($sysc) != 0 ){

			$sysd = mysql_fetch_array($sysc);

			?>

				<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

					<td><b><?php echo $lang['variacion']; ?> 1:</b></td>

					<td>

						<img src="<?php echo $path; ?>upload/<?php echo $sysd['image']; ?>" onmouseover="showInfo3(this,'asd',2);" class="img_variations" />

						<?php

							echo $sysd['name'];

						?>

					</td>

				</tr>

			<?php

		}

		

		$syst = 'SELECT * FROM phonecards_logos WHERE id_phonecards_logo = '.$datos['id_variation2'].';';

		$sysc = mysql_query($syst);

		

		if ( mysql_num_rows($sysc) != 0 ){

			$sysd = mysql_fetch_array($sysc);

	?>

		<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

			<td><b><?php echo $lang['variacion']; ?> 2:</b></td>

			<td>

				<img src="<?php echo $path; ?>upload/logo/<?php echo $sysd['id_phonecards_logo']; ?>.png" onmouseover="showInfo3(this,'asd',3);" class="img_variations" />

				<?php echo $sysd['name']; ?>

			</td>

		</tr>

	<?php

		}

		else{

			if ( intval($datos['id_phonecards_systems']) != 4 ){

		?>

			<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

				<td><b><?php echo $lang['variacion']; ?> 2:</b></td>

				<td><?php echo $lang['sin_logo']; ?></td>

			</tr>					

		<?php

			}

		}

		

		if ( $datos['descriptive_variation'] ){

		?>

			<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

				<td><b><?php echo $lang['variacion_descriptiva']; ?>:</b></td>

				<td><?php echo $datos['descriptive_variation']; ?></td>

			</tr>

		<?php

		}

	

		if ( $datos['issued_on'] ){

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['emitida']; ?>:</strong></td>

		<td>

			<?php 

				echo $datos['issued_on'];

			?>

		</td>

	</tr>

	<?php

		}

		if ( !$datos['issued_on'] and $datos['known_date'] ){

	?>

	<tr title="<?php echo $lang['fecha_conocida'].': '.$lang['titulo_fecha_conocida'].'.'; ?>" <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['fecha_conocida']; ?>:</strong></td>

		<td>

			<?php 

				echo $datos['known_date'];

			?>

		</td>

	</tr>

	<?php

		}

	?>

	

	<?php

		if ( $datos['exp_date'] ){

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['fecha_ventircimiento']; ?>:</strong></td>

		<td>

			<?php 

				echo $datos['exp_date'];

			?>

		</td>

	</tr>

	<?php

		}

	?>

	<?php

		if ( $datos['print_run'] ){

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> <?php if ( $datos['print_run_known'] ) echo 'title='.$lang['titulo_tiraje'].'.'; ?> >

		<td><strong><?php if ( $datos['print_run_known'] ) echo $lang['tiraje']."2:"; else echo $lang['tiraje'].":"; ?></strong></td>

		<td>

			<?php 

				echo $datos['print_run'];

			?>

		</td>

	</tr>

	<?php

		}

	?>

	<?php

		if ( $datos['face_value'] ){

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['valor_facial']; ?>:</strong></td>

		<td>

			<?php 

				

				$decimals = explode('.',$datos['face_value']);

				$decimals = (int) $decimals[1];

								

				if ( $decimals > 0 ){

					echo number_format($datos['face_value'],2,',','.');

				}

				else{

					echo number_format($datos['face_value'],0);

				}

			

			?>

		</td>

	</tr>

	<?php

		}

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['moneda_corriente'];?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from currencies where id_currencies = ".$datos['id_currencies'];

				$cursor2=mysql_query($sql2);

				$datos2=mysql_fetch_array($cursor2);

				echo $datos2['name'];

			?>

		</td>

	</tr>

	<?php

		if ( strcmp($datos['tags'],'') != 0 ){

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><b><?php echo $lang['tematica'];?>:</b></td>

		<td>
		<?php  
			
			$tags = implode(', ',explode(',',$datos['tags']));
			
			echo $tags ;
		?>
        </td>

	</tr>

	<?php

		}

		if ( $datos['est_price'] ){

	?>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><b><?php echo $lang['precio_estimado'];?>:</b></td>

		<td><?php echo $datos['est_price']; ?> US$</td>

	</tr>

	<?php

		}

	?>

</table>
</div>
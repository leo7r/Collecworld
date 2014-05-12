
<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 

?>

<?php

session_start();



$id = $_REQUEST['id'];



$sql="select * from coins where id_coins=".$id;

$cursor=mysql_query($sql);

$num=mysql_num_rows($cursor);



if($num){

	$datos=mysql_fetch_array($cursor);

}

else{

	die('Error fetching data');

}

?>


<!-- 
<div>

	<ul id="show-tabs">

		<li class="box1 selected" onClick="showCoinTab(0,<?php echo $id; ?>);"><?php echo $lang['informacion']; ?></li>

		<li class="box1" onClick="showCoinTab(1,<?php echo $id; ?>);"><?php echo $lang['coleccionistas']; ?></li>

		<li class="box1" onClick="showCoinTab(2,<?php echo $id; ?>);"><?php echo $lang['relacionadas']; ?></li>

		<li class="box1" onClick="showCoinTab(3,<?php echo $id; ?>);"><?php echo $lang['comentarios']; ?></li>

	</ul>

</div> -->



<table cellpadding="4" cellspacing="0" id="info-table">
<!--
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
-->
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

		<td><strong><?php echo $lang['titulo']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from coins_title where id_coins_title = ".$datos['id_coins_title'];

				$cursor2=mysql_query($sql2);

				$datos2=mysql_fetch_array($cursor2);

				echo $datos2['name'];

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['valor']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from coins_value where id_coins_value = ".$datos['id_coins_value'];

				$cursor2=mysql_query($sql2);

				$datos23=mysql_fetch_array($cursor2);

				echo $datos23['name'];

			?>

		</td>

	</tr>
    
   	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['subtitulo']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from coins_subtitle where id_coins_subtitle = ".$datos['id_coins_subtitle'];

				$cursor2=mysql_query($sql2);

				@$num2 = mysql_num_rows($cursor2);
				
				if($num2){
					
					$datos2=mysql_fetch_array($cursor2);
	
					echo $datos2['name'];
				}else{
				
					echo $lang['desconocido'];	
				}

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['emitida']; ?>:</strong></td>

		<td>

			<?php 

				echo $datos['issued_on'];

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['casa_moneda']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from coins_mint_house  where id_coins_mint_house = ".$datos['id_coins_mint_house'];

				$cursor2=mysql_query($sql2);

				@$num2 = mysql_num_rows($cursor2);
				
				if($num2){
					
					$datos2=mysql_fetch_array($cursor2);
	
					echo $datos2['name'];
				}else{
				
					echo $lang['desconocido'];	
				}
			?>

		</td>

	</tr>

    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['tiraje']; ?>:</strong></td>

		<td>

			<?php 

				echo $datos['print_run'];

			?>

		</td>

	</tr>
    
	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['disenador']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from coins_designer where id_coins_designer = ".$datos['id_coins_designer'];

				$cursor2=mysql_query($sql2);
				
				@$num2 = mysql_num_rows($cursor2);
				
				if($num2){

					$datos2=mysql_fetch_array($cursor2);
	
					echo $datos2['name'];

				}else{
					
					echo $lang['desconocido'];	
					
				}
			?>

		</td>

	</tr>

	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['forma']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from coins_shape where id_coins_shape = ".$datos['id_coins_shape'];

				$cursor2=mysql_query($sql2);

				$datos2=mysql_fetch_array($cursor2);

				echo $datos2['name'];

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['tamano']; ?>:</strong></td>

		<td>

			<?php 

				if($datos['id_coins_edge']==1){
					
					echo $datos['size'];
					
				}else{
					
					echo $datos['size'].' x '.$datos['size2'];
					
				} 

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['canto']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from coins_edge where id_coins_edge = ".$datos['id_coins_edge'];

				$cursor2=mysql_query($sql2);

				$datos2=mysql_fetch_array($cursor2);

				echo $datos2['name'];

			?>

		</td>

	</tr>
	
	<?php
	
	if ( $datos['descriptive_variation'] ){

		?>

			<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

				<td><b><?php echo $lang['variacion_descriptiva']; ?>:</b></td>

				<td><?php echo $datos['descriptive_variation']; ?></td>

			</tr>

		<?php

		}
	?>
    <!--
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
	?>-->

</table>


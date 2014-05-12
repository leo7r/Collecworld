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
<script>

	$(document).ready(function(){

		

		user_rating = parseInt($("#user-rating").val());

		rating_disabled = parseInt($("#rating-disabled").val());

		

		if ( rating_disabled == 1 )

			rating_disabled = true;

		else

			rating_disabled = false;

	

		$('#info-rating').raty({

			noRatedMsg	: '<?php echo $lang['ingresar_para_calificar_tarjeta_telefonica']; ?>',

			readOnly : rating_disabled,

			score	 : user_rating,

			path	 : path+'img/',

			size     : 24,

			starOff  : 'star-off-big.png',

			starOn   : 'star-on-big.png',

			hints	 : [ '<?php echo $lang['informacion_mala']; ?>' , '<?php echo $lang['informacion_pobre']; ?>' , '<?php echo $lang['informacion_regular']; ?>' , '<?php echo $lang['informacion_buena']; ?>' , '<?php echo $lang['informacion_excelente']; ?>' ],

			click: function(score, evt) {

				id = $('#id-pc').val();

				div = document.createElement('div');

				$(div).load(path+'ajax/rating/setRating.php',{cat:1,id_item:id,score:score},function(){

					$("#show-tabs").find('li')[0].click();

				});

			}

		});

		

		$("#info-rating").click(function(){

			if ( rating_disabled ){

				location.href = path+'index.php/login';

			}

		});

		

	});

</script>



<?php

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



<div>

	<ul id="show-tabs">

		<li class="box1 selected" onClick="showPhonecardTab(0,<?php echo $id; ?>);"><?php echo $lang['informacion']; ?></li>

		<li class="box1" onClick="showPhonecardTab(1,<?php echo $id; ?>);"><?php echo $lang['coleccionistas']; ?></li>

		<li class="box1" onClick="showPhonecardTab(2,<?php echo $id; ?>);"><?php echo $lang['relacionadas']; ?></li>

		<li class="box1" onClick="showPhonecardTab(3,<?php echo $id; ?>);"><?php echo $lang['comentarios']; ?></li>

	</ul>

</div>



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

						<img src="<?php echo $path; ?>upload/<?php echo $sysd['image']; ?>" onmouseover="showInfo3(this,2,<?php echo $sysd['id_phonecards_systems']; ?>);" class="img_variations" />

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

				<img src="<?php echo $path; ?>upload/logo/<?php echo $sysd['id_phonecards_logo']; ?>.jpg" onmouseover="showInfo3(this,1,<?php echo $sysd['id_phonecards_logo']; ?>);" class="img_variations" />

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

		<td><strong><?php echo $lang['fecha_vencimiento']; ?>:</strong></td>

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

<?php

	if ( isset($_SESSION['id_users']) ){

		$rating_sql = 'SELECT * FROM ratings WHERE id_categories = 1 AND id_item = '.$datos['id_phonecards'].' AND id_users = '.$_SESSION['id_users'];

		$rating_cur = mysql_query($rating_sql);

		

		if ( mysql_num_rows($rating_cur) == 1 ){

			$rating_dat = mysql_fetch_array($rating_cur);

			$user_rating = intval($rating_dat['rating']);

		}

		else{

			$user_rating = 0;

		}

		

		$rating_disabled = false;

	}

	else{

		$user_rating = 0;

		$rating_disabled = true;

	}

	

	$overall_sql = 'SELECT SUM(rating)/COUNT(rating) as overall , COUNT(rating) as num FROM ratings WHERE id_categories = 1 and id_item = '.$datos['id_phonecards'];

	$overall_cur = mysql_query($overall_sql);

	$overall_dat = mysql_fetch_array($overall_cur);

	

	if ( $overall_dat['overall'] ){

		$overall = number_format($overall_dat['overall'],1);

		$overall_num = $overall_dat['num'];

	}

	else{

		$overall = 0;

	}

	

	if ( $overall > 4 ){

		$rating_class = 'rating-num-excelent';

	}

	elseif ( $overall > 3 ){

		$rating_class = 'rating-num-good';

	}

	elseif ( $overall > 2 ){

		$rating_class = 'rating-num-regular';

	}

	elseif ( $overall > 1 ){

		$rating_class = 'rating-num-poor';

	}

	else{

		$rating_class = 'rating-num-bad';

	}



?>

<div id="show-info-bottom">

	<table id="info-bottom-table">

		<tr>

			<td valign="top">

				<div id="overall-rating">

					<input type="hidden" id="user-rating" value="<?php echo $user_rating; ?>" />

					<input type="hidden" id="rating-disabled" value="<?php if ( $rating_disabled ) echo '1'; else echo '0'; ?>" />

					
				
					<?php echo $lang['calificacion_general']; ?>:

					<span <?php if ( isset($overall_num) ) echo 'title="'.$lang['basado_en'].' '.$overall_num.' '.$lang['calificaciones'].'"'; ?> class="rating-num <?php echo $rating_class; ?>">

						<?php echo $overall; ?>

					</span>

				</div>

				<div id="info-rating"></div>

			</td>

			<td valign="top">

				<div id="show-uploadedby">

					<?php			

						$upby = mysql_query('SELECT * FROM users WHERE user = "'.$datos['user'].'"');

						$upbyd = mysql_fetch_array($upby);

					?>

					<?php echo $lang['cargado_por']; ?> <a href="<?php echo $path.'index.php/'.$upbyd['user']; ?>"><?php echo $upbyd['name']; ?></a>

				</div>

			</td>

		</tr>

	</table>

	<?php

	if ( $_SESSION['status'] == 1 || $_SESSION['status'] == 2 ){

		?>

			<div id="show-edit">

				<span style="float:right;">

                	

                    <?php

					if ( ($_SESSION['status'] == 1)||(($_SESSION['status'] == 2)&&($datos['edit']==0)&& (strlen($datos['image']) == 0 || strlen($datos['image_reverse']) == 0)) ){
					
						?>
						
                        <a href="<?php echo $path; ?>index.php/edit/phonecard/<?php echo $datos['id_phonecards']; ?>?onDone=<?php echo $_REQUEST['url']; ?>" class="google-button"><?php echo $lang['editar_tarjeta_telefonica']; ?></a>

                        <?php						

						}
				/*		echo strlen($datos['image'])." ".strlen($datos['image_reverse']);*/
					?>

                

					

					<a href="<?php echo $path; ?>index.php/upload/?cat=1&cou=<?php echo $datos['id_countries']; ?>&cur=<?php echo $datos['id_currencies']; ?>&com=<?php echo $company_name; ?>&ser<?php echo $datos['serie_known'] ? '2':'' ?>=<?php echo $serie_name; ?>&sys=<?php echo $datos['id_phonecards_systems']; ?>&sen=<?php echo $datos['serie_number']; ?>&nam=<?php echo $datos['name']; ?>&prr<?php echo $datos['print_run_known'] ? '2':'' ?>=<?php echo $datos['print_run']; ?>&iss=<?php echo $datos['issued_on']; ?>&kno=<?php echo $datos['known_date']; ?>&exp=<?php echo $datos['exp_date']; ?>&fav=<?php echo $datos['face_value']; ?>&orn=<?php echo $datos['order_n']; ?>&sav=1&tag=<?php echo $datos['tags']; ?>&noe=<?php echo $datos['not_emmited']; ?>&esp=<?php echo $datos['especial']; ?>" class="google-button"><?php echo $lang['cargar_variacion']; ?></a>

				</span>
                
                <?php

					if ( ($_SESSION['status'] == 1)||(($_SESSION['status'] == 2)&&($datos['delete']==0)) ){
						?>
                        <script>
                        	function deletePc( id ){
								
								if ( confirm('<?php echo $lang['eliminar']." ".$datos['name']; ?>?') ){
									div = document.createElement('div');
									$(div).load(path+'ajax/delete_phonecard.php',{id:id},function(){
										
										if ( div.innerHTML.search('OK') != -1 ){
											alert('Tarjeta eliminada');
											location.reload(true);
										}
										else{
											alert('error');	
										}
									});	
								}									
							}
                        </script>
                        <span class="google-button google-button-red" onClick="deletePc(<?php echo $datos['id_phonecards'] ?>)"><?php echo $lang['eliminar']; ?></span>
                        <?php
					}
					if($_SESSION['status'] == 1){
					 	if(($datos['delete']==0)&&($datos['edit']==0)){ ?>
					 <span class="google-button google-button-red" onClick="block_one_phonecard('<?php echo $datos['id_phonecards'] ?>','<?php echo $datos['delete']; ?>')"> <?php echo $lang['bloquear']; ?> </span>
                        <?php }else{ ?>
                        <span class="google-button google-button-green" onClick="block_one_phonecard('<?php echo $datos['id_phonecards'] ?>','<?php echo $datos['delete']; ?>')"> <?php echo $lang['desbloquear']; ?> </span>
				<?php
					}
					}
				?>

			</div>

		<?php

	}

	?>

</div>
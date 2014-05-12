
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

	//$(document).ready(function(){

		

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

				id = $('#id-bn').val();
				
				div = document.createElement('div');

				$(div).load(path+'ajax/rating/setRating.php',{cat:3,id_item:id,score:score},function(){

					$("#show-tabs").find('li')[0].click();
				});

			}

		});

		

		$("#info-rating").click(function(){

			if ( rating_disabled ){

				location.href = path+'index.php/login';

			}

		});

		

//	});

</script>



<?php

session_start();



$id = $_REQUEST['id'];



$sql="select * from banknotes where id_banknotes=".$id;

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

		<li class="box1 selected" onClick="showBanknotesTab(0,<?php echo $id; ?>);"><?php echo $lang['informacion']; ?></li>

		<li class="box1" onClick="showBanknotesTab(1,<?php echo $id; ?>);"><?php echo $lang['coleccionistas']; ?></li>

		<li class="box1" onClick="showBanknotesTab(2,<?php echo $id; ?>);"><?php echo $lang['relacionadas']; ?></li>

		<li class="box1" onClick="showBanknotesTab(3,<?php echo $id; ?>);"><?php echo $lang['comentarios']; ?></li>

	</ul>

</div>



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

		<td width="180px"><strong><?php echo $lang['pais']; ?>:</strong></td>

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

				$sql2="select * from  banknotes_title where id_banknotes_title = ".$datos['id_banknotes_title'];

				$cursor2=mysql_query($sql2);

				$datos2=mysql_fetch_array($cursor2);

				echo $datos2['name'];

			?>

		</td>

	</tr>
    
    
   	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['subtitulo']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from banknotes_subtitle where id_banknotes_subtitle = ".$datos['id_banknotes_subtitle'];

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

		<td><strong><?php echo $lang['denominacion']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from banknotes_denomination where id_banknotes_denomination = ".$datos['id_banknotes_denomination'];

				$cursor2=mysql_query($sql2);

				$datos23=mysql_fetch_array($cursor2);

				echo $datos23['name'];

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['valor']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from banknotes_value where id_banknotes_value = ".$datos['id_banknotes_value'];

				$cursor2=mysql_query($sql2);

				$datos23=mysql_fetch_array($cursor2);

				echo $datos23['name'];

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['variante_numero_serie']; ?>:</strong></td>

		<td>
			<?php 

				echo $datos['serie_variation'];

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['modelo']; ?>:</strong></td>

		<td>

			<?php 

				echo $datos['model'];

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['emitida_greg']; ?>:</strong></td>

		<td>

			<?php 

				echo $datos['issued_on_gre'];

			?>

		</td>

	</tr>
    
    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['emitida_isla']; ?>:</strong></td>

		<td>

			<?php 

				echo $datos['issued_on_isl'];

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

		<td><strong><?php echo $lang['casa_moneda']; ?>:</strong></td>

		<td>

			<?php 

				$sql2="select * from banknotes_mint_house  where id_banknotes_mint_house = ".$datos['id_banknotes_mint_house'];

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

		<?php 
		if($datos['signature1'] !=""){    
		?>
	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['firma']; ?> 1:</strong></td>

		<td>
			<?php 

				echo $datos['signature1'];

			?>

		</td>

	</tr>
		<?php 
			}
		if($datos['signature2'] !=""){    
		?>
	<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['firma']; ?> 2:</strong></td>

		<td>
			<?php 

				echo $datos['signature2'];

			?>

		</td>

	</tr>
		<?php 
			}
		if($datos['signature3'] !=""){    
		?>
		<tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['firma']; ?> 3:</strong></td>

		<td>
			<?php 

				echo $datos['signature3'];

			?>

		</td>

	</tr>
    <?php 
		}   
		?>

    <tr <?php if ( $odd_n++ % 2 != 0 ) echo 'class="odd"'; ?> >

		<td><strong><?php echo $lang['tamano']; ?>:</strong></td>

		<td>

			<?php 
					
					echo $datos['size'].' mm x '.$datos['size2'].' mm';

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

<?php

	if ( isset($_SESSION['id_users']) ){

		$rating_sql = 'SELECT * FROM ratings WHERE id_categories = 3 AND id_item = '.$datos['id_banknotes'].' AND id_users = '.$_SESSION['id_users'];

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

	

	$overall_sql = 'SELECT SUM(rating)/COUNT(rating) as overall , COUNT(rating) as num FROM ratings WHERE id_categories = 3 and id_item = '.$datos['id_banknotes'];

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

						if ( ($_SESSION['status'] == 1 || ($_SESSION['status'] == 2 )&& strlen($datos['image']) == 0 && strlen($datos['image_reverse']) == 0) ){
					
						?>
						
                        <a href="<?php echo $path; ?>index.php/edit/banknote/<?php echo $datos['id_banknotes']; ?>?onDone=<?php echo $_REQUEST['url']; ?>"  class="google-button"><?php echo $lang['editar_billete']; ?></a>

                        <?php						

						}

					?>

                

					<!-- href="<?php echo $path; ?>index.php/upload/?cat=1&cou=<?php echo $datos['id_countries']; ?>&cur=<?php echo $datos['id_currencies']; ?>&com=<?php echo $company_name; ?>&ser<?php echo $datos['serie_known'] ? '2':'' ?>=<?php echo $serie_name; ?>&sys=<?php echo $datos['id_phonecards_systems']; ?>&sen=<?php echo $datos['serie_number']; ?>&nam=<?php echo $datos['name']; ?>&prr<?php echo $datos['print_run_known'] ? '2':'' ?>=<?php echo $datos['print_run']; ?>&iss=<?php echo $datos['issued_on']; ?>&kno=<?php echo $datos['known_date']; ?>&exp=<?php echo $datos['exp_date']; ?>&fav=<?php echo $datos['face_value']; ?>&orn=<?php echo $datos['order_n']; ?>&sav=1&tag=<?php echo $datos['tags']; ?>&noe=<?php echo $datos['not_emmited']; ?>&esp=<?php echo $datos['especial']; ?>"  -->

					<a class="google-button"><?php echo $lang['cargar_variacion']; ?></a>

				</span>
                
                <?php
/*					$users_allowed = array('antonio','ricardo','leo','victorsrz3');*/
					if ( ($_SESSION['status'] == 1 )|| ($_SESSION['status'] == 2 )  ){
						?>
                        <script>
                        	function deleteBn( id ){
								
								if ( confirm('<?php echo $lang['eliminar']." ".$datos23['name']; ?>?') ){
									div = document.createElement('div');
									$(div).load(path+'ajax/delete_banknote.php',{id:id},function(){
										
										if ( div.innerHTML.search('OK') != -1 ){
											alert("<?php echo $lang['moneda_eliminada'];?>");
											location.reload(true);
										}
										else{
											alert('error');	
										}
									});	
								}									
							}
                        </script>
                        <!--  -->
                        <span class="google-button google-button-red" onClick="deleteBn(<?php echo $datos['id_banknotes'] ?>)"><?php echo $lang['eliminar']; ?></span>
                        <?php
					}
				?>

			</div>

		<?php

	}

	?>

</div>
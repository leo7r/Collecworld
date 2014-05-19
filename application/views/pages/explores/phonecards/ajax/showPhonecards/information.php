<script>

	$(document).ready(function(){

		

		user_rating = parseInt($("#user-rating").val());

		rating_disabled = parseInt($("#rating-disabled").val());

		

		if ( rating_disabled == 1 )

			rating_disabled = true;

		else

			rating_disabled = false;

	

		$('#info-rating').raty({

			noRatedMsg	: '<?php echo $this->lang->line('ingresar_para_calificar_tarjeta_telefonica'); ?>',

			readOnly : rating_disabled,

			score	 : user_rating,

			path	 : path+'img/',

			size     : 24,

			starOff  : 'star-off-big.png',

			starOn   : 'star-on-big.png',

			hints	 : [ '<?php echo $this->lang->line('informacion_mala'); ?>' , '<?php echo $this->lang->line('informacion_pobre'); ?>' , '<?php echo $this->lang->line('informacion_regular'); ?>' , '<?php echo $this->lang->line('informacion_buena'); ?>' , '<?php echo $this->lang->line('informacion_excelente'); ?>' ],

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



<div>

	<ul id="show-tabs">

		<li class="box1 selected" onClick="showPhonecardTab(0,<?php echo $phonecards[0]['id_phonecards']; ?>);"><?php echo $this->lang->line('informacion'); ?></li>

		<li class="box1" onClick="showPhonecardTab(1,<?php echo $phonecards[0]['id_phonecards']; ?>);"><?php echo $this->lang->line('coleccionistas'); ?></li>

		<li class="box1" onClick="showPhonecardTab(2,<?php echo $phonecards[0]['id_phonecards']; ?>);"><?php echo $this->lang->line('relacionadas'); ?></li>

		<li class="box1" onClick="showPhonecardTab(3,<?php echo $phonecards[0]['id_phonecards']; ?>);"><?php echo $this->lang->line('comentarios'); ?></li>

	</ul>

</div>



<table cellpadding="4" cellspacing="0" id="info-table">

	<tr  >

		<td><strong><?php echo $this->lang->line('numero_catalogo'); ?>:</strong></td>

		<td><?php echo strtoupper($phonecards[0]['code']); ?></td>

	</tr>


					<tr  >

		<td><strong><?php echo $this->lang->line('catalogo_referencia'); ?>:</strong></td>

		<td></td>

	</tr>


	<tr  >

		<td><strong><?php echo $this->lang->line('pais'); ?>:</strong></td>

		<td>
					<?php 

				echo $phonecards[0]['countries'];

			?>
		</td>

	</tr>

	<tr  >

		<td><strong><?php echo $this->lang->line('compania'); ?>:</strong></td>

		<td>
					<?php 

				echo $phonecards[0]['companies'];

			?>

		</td>

	</tr>

	<tr  <?php if ( $phonecards[0]['series'] ) echo 'title="Serie2: NOT printed on phonecard, general knowledge."'; ?> >

		<td><strong><?php if ( $phonecards[0]['series'] ) echo $this->lang->line('serie')."2:"; else echo $this->lang->line('serie').":"; ?></strong></td>

		<td>

			<?php 

				echo $phonecards[0]['series'];

				$serie_name = $phonecards[0]['series']; 

			?>

		</td>

	</tr>


	<tr  >

		<td><strong><?php echo $this->lang->line('sistema'); ?>:</strong></td>

		<td>

								<?php 

				echo $phonecards[0]['systems'];

			?>

		</td>

	</tr>



				<tr  >

					<td><b><?php echo $this->lang->line('variacion'); ?> 1:</b></td>

					<td>

						<img src="<?php echo base_url(); ?>upload/<?php echo $phonecards[0]['image']; ?>" onmouseover="showInfo3(this,2,<?php echo $phonecards[0]['id_phonecards_systems']; ?>);" class="img_variations" />

						<?php

							echo $phonecards[0]['phonecards_name'];

						?>

					</td>

				</tr>



		<tr  >

			<td><b><?php echo $this->lang->line('variacion'); ?> 2:</b></td>

			<td>

				<img src="<?php echo base_url(); ?>upload/logo/<?php echo $phonecards[0]['id_phonecards_logos']; ?>.jpg" onmouseover="showInfo3(this,1,<?php echo $phonecards[0]['id_phonecards_logos']; ?>);" class="img_variations" />

				<?php echo $phonecards[0]['logos']; ?>

			</td>

		</tr>

	<?php


			if ( intval($phonecards[0]['id_phonecards_systems']) != 4 ){

		?>

			<tr  >

				<td><b><?php echo $this->lang->line('variacion'); ?> 2:</b></td>

				<td><?php echo $this->lang->line('sin_logo'); ?></td>

			</tr>					

		<?php

			}

		

		

		if ( $phonecards[0]['descriptive_variation'] ){

		?>

			<tr  >

				<td><b><?php echo $this->lang->line('variacion_descriptiva'); ?>:</b></td>

				<td><?php echo $phonecards[0]['descriptive_variation']; ?></td>

			</tr>

		<?php

		}

	

		if ( $phonecards[0]['issued_on'] ){

	?>

	<tr  >

		<td><strong><?php echo $this->lang->line('emitida'); ?>:</strong></td>

		<td>

			<?php 

				echo $phonecards[0]['issued_on'];

			?>

		</td>

	</tr>

	<?php

		}

		if ( !$phonecards[0]['issued_on'] and $phonecards[0]['known_date'] ){

	?>

	<tr title="<?php echo $this->lang->line('fecha_conocida').': '.$this->lang->line('titulo_fecha_conocida').'.'; ?>"  >

		<td><strong><?php echo $this->lang->line('fecha_conocida'); ?>:</strong></td>

		<td>

			<?php 

				echo $phonecards[0]['known_date'];

			?>

		</td>

	</tr>

	<?php

		}

	?>

	

	<?php

		if ( $phonecards[0]['exp_date'] ){

	?>

	<tr  >

		<td><strong><?php echo $this->lang->line('fecha_vencimiento'); ?>:</strong></td>

		<td>

			<?php 

				echo $phonecards[0]['exp_date'];

			?>

		</td>

	</tr>

	<?php

		}

	?>

	<?php

		if ( $phonecards[0]['print_run'] ){

	?>

	<tr  <?php if ( $phonecards[0]['print_run_known'] ) echo 'title='.$this->lang->line('titulo_tiraje').'.'; ?> >

		<td><strong><?php if ( $phonecards[0]['print_run_known'] ) echo $this->lang->line('tiraje')."2:"; else echo $this->lang->line('tiraje').":"; ?></strong></td>

		<td>

			<?php 

				echo $phonecards[0]['print_run'];

			?>

		</td>

	</tr>

	<?php

		}

	?>

	<?php

		if ( $phonecards[0]['face_value'] ){

	?>

	<tr  >

		<td><strong><?php echo $this->lang->line('valor_facial'); ?>:</strong></td>

		<td>

			<?php 

				

				$decimals = explode('.',$phonecards[0]['face_value']);

				$decimals = (int) $decimals[1];

								

				if ( $decimals > 0 ){

					echo number_format($phonecards[0]['face_value'],2,',','.');

				}

				else{

					echo number_format($phonecards[0]['face_value'],0);

				}

			

			?>

		</td>

	</tr>

	<?php

		}

	?>

	<tr  >

		<td><strong><?php echo $this->lang->line('moneda_corriente');?>:</strong></td>

		<td>

		</td>

	</tr>



	<tr  >

		<td><b><?php echo $this->lang->line('tematica');?>:</b></td>

		<td>

        </td>

	</tr>



	<tr  >

		<td><b><?php echo $this->lang->line('precio_estimado');?>:</b></td>

		<td> US$</td>

	</tr>


</table>



<div id="show-info-bottom">

	<table id="info-bottom-table">

		<tr>

			<td valign="top">

				<div id="overall-rating">

					<input type="hidden" id="user-rating" value="" />

					<input type="hidden" id="rating-disabled" value="" />

					
				
					<?php echo $this->lang->line('calificacion_general'); ?>:

					<!-- <span <?php if ( isset($overall_num) ) echo 'title="'.$this->lang->line('basado_en').' '.$overall_num.' '.$this->lang->line('calificaciones').'"'; ?> class="rating-num <?php echo $rating_class; ?>">

						<?php echo $overall; ?>

					</span> -->

				</div>

				<div id="info-rating"></div>

			</td>

			<td valign="top">

				<div id="show-uploadedby">

					<?php echo $this->lang->line('cargado_por'); ?> <a href=""><?php echo "someone"; ?></a>

				</div>

			</td>

		</tr>

	</table>

	
			<div id="show-edit">

				<span style="float:right;">

                	

        
						
                       <!--  <a href="<?php echo base_url(); ?>index.php/edit/phonecard/<?php echo $phonecards[0]['id_phonecards']; ?>?onDone=<?php echo $_REQUEST['url']; ?>" class="google-button"><?php echo $this->lang->line('editar_tarjeta_telefonica'); ?></a>
 -->

                

					

				<!-- 	<a href="<?php echo base_url(); ?>index.php/upload/?cat=1&cou=<?php echo $phonecards[0]['id_countries']; ?>&cur=<?php echo $phonecards[0]['id_currencies']; ?>&com=<?php echo $company_name; ?>&ser<?php echo $phonecards[0]['series'] ? '2':'' ?>=<?php echo $serie_name; ?>&sys=<?php echo $phonecards[0]['id_phonecards_systems']; ?>&sen=<?php echo $phonecards[0]['serie_number']; ?>&nam=<?php echo $phonecards[0]['name']; ?>&prr<?php echo $phonecards[0]['print_run_known'] ? '2':'' ?>=<?php echo $phonecards[0]['print_run']; ?>&iss=<?php echo $phonecards[0]['issued_on']; ?>&kno=<?php echo $phonecards[0]['known_date']; ?>&exp=<?php echo $phonecards[0]['exp_date']; ?>&fav=<?php echo $phonecards[0]['face_value']; ?>&orn=<?php echo $phonecards[0]['order_n']; ?>&sav=1&tag=<?php echo $phonecards[0]['tags']; ?>&noe=<?php echo $phonecards[0]['not_emmited']; ?>&esp=<?php echo $phonecards[0]['especial']; ?>" class="google-button"><?php echo $this->lang->line('cargar_variacion'); ?></a>
 -->
				</span>
                
      
                        <script>
                        	function deletePc( id ){
								
								if ( confirm('<?php echo $this->lang->line('eliminar')." ".$phonecards[0]['name']; ?>?') ){
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

                        </script>
                        <span class="google-button google-button-red" onClick="deletePc(<?php echo $phonecards[0]['id_phonecards'] ?>)"><?php echo $this->lang->line('eliminar'); ?></span>


			</div>

</div>
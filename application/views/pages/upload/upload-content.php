<?php

if ( isset($_SESSION['user']) ){
?>
		
<div id="upload-cat" class="box1">
<table cellspacing="10px">
	<tr>
		<td><?php echo $this->lang->line('categoria'); ?></td>
		<td>
			<select onchange="loadCategory(this);" id="category-sel" >
				<option selected="selected" value="-1"><?php echo $this->lang->line('seleccione'); ?></option>
				<?php
					for ($i=1 ; $i < count($categories) ; $i++){
						
						switch( $categories[$i]['id_categories'] ){
										
							case 1:
								$cat_trad =$this->lang->line('tarjetas_telefonicas');
								break;	
							case 2:
								$cat_trad =$this->lang->line('monedas');
								break;	
							case 3:
								$cat_trad =$this->lang->line('billetes');
								break;	 		
							case 4:
								$cat_trad =$this->lang->line('estampillas');
								break;			
						}
						
						echo '<option value="'.$categories[$i]['id_categories'].'" >'.$cat_trad.'</option>';
					}
				?>
		</td>
	</tr>	
</table>
</div>
<?php
}
else{
	?>
		<div>
			<div id="warning-in">
				<div class="title_warning">
					<img src="<?php echo base_url(); ?>img/alert.png" height="16" width="16" />
					<?php echo $this->lang->line('no_ha_iniciado_sesison'); ?>
				</div>
			</div>
			<div id="warning-info">
				<div>
					<span class="google-button" onclick="$('#go').click();"><?php echo $this->lang->line('iniciar_sesion'); ?></span>
				</div>
				<div>
					or
				</div>
				<div>
					<span class="google-button" onclick="setSignup2();" ><?php echo $this->lang->line('crear_nueva_cuenta'); ?></span>
				</div>
			</div>
		</div>
		
	<?php
}
?>
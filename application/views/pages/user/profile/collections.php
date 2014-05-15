
<div class="title4">
	<?php echo $this->lang->line('mis_colecciones'); ?>
</div>

<div class="account-collections">
	<br />
	<div class="collections-item">
	
		<div class="collections-img">
			<img src="<?php echo base_url(); ?>img/account-pc.png" width="64" height="64" >
		</div>
		
		<div class="collections-title">
			<?php echo $this->lang->line('tarjetas_telefonicas'); ?>
			<br>
            <div id="new_list_frame">
				<div id="new-list-button" class="google-button-blue" onClick="newList(1);"><?php echo $this->lang->line('lista_nueva'); ?></div>
			</div>
            <input type="hidden" name="id_user" id="id_user" value="<?php echo 1; ?>" />
            
			<select id="pc-select" class="collections-input" onChange="viewList(this)">
				<option value="0" selected="selected"><?php echo $this->lang->line('seleccione'); ?></option>
				<option value="collection"><?php echo $this->lang->line('coleccion'); ?></option>
				<option value="wish"><?php echo $this->lang->line('deseo'); ?></option>
				<option value="exchange"><?php echo $this->lang->line('intercambio'); ?></option>
				<option value="sell"><?php echo $this->lang->line('venta'); ?></option> 
                <?php
				foreach($phonecards_list as $phonecard){
					 $default_list = array("collection", "wish", "exchange", "sell");
					 
					 if (!in_array($phonecard['name'], $default_list))
						 echo '<option value="'.$phonecard['id_lists'].'">'.$phonecard['name'].'</option>';				 
				}
				?>
			</select> 
		</div>
		
	</div>
	
	<div class="collections-item">
	
		<div class="collections-img">
			<img src="<?php echo base_url(); ?>img/account-coin.png" width="64" height="64" >
		</div>
		
		<div class="collections-title">
			<?php echo $this->lang->line('monedas'); ?>
			<br>
            <div id="new_list_frame">
				<div id="new-list-button" class="google-button-blue" onClick="newList(2);"><?php echo $this->lang->line('lista_nueva'); ?></div>
			</div>            
			<select id="coin-select" class="collections-input">
				<option value="0" selected="selected"><?php echo $this->lang->line('seleccione'); ?></option>
				<option value="1"><?php echo $this->lang->line('coleccion'); ?></option>
				<option value="2"><?php echo $this->lang->line('deseo'); ?></option>
				<option value="3"><?php echo $this->lang->line('intercambio'); ?></option>
				<option value="5"><?php echo $this->lang->line('venta'); ?></option> 
			</select> 
		</div>
		
	</div>
    
    <div class="collections-item">
	
		<div class="collections-img">
			<img src="<?php echo base_url(); ?>img/account-banknote.png" style="margin-top:15px; margin-left:12px;" width="40" >
		</div>
		
		<div class="collections-title">
			<?php echo $this->lang->line('billetes'); ?>
			<br>
            <div id="new_list_frame">
				<div id="new-list-button" class="google-button-blue" onClick="newList(3);"><?php echo $this->lang->line('lista_nueva'); ?></div>
			</div>            
			<select id="coin-select" class="collections-input">
				<option value="0" selected="selected"><?php echo $this->lang->line('seleccione'); ?></option>
				<option value="1"><?php echo $this->lang->line('coleccion'); ?></option>
				<option value="2"><?php echo $this->lang->line('deseo'); ?></option>
				<option value="3"><?php echo $this->lang->line('intercambio'); ?></option>
				<option value="5"><?php echo $this->lang->line('venta'); ?></option>
			</select> 
		</div>
		
	</div>
	<div class="collections-item">
	
		<div class="collections-img">
			<img src="<?php echo base_url(); ?>img/account-stamp.png" >
		</div>
		
		<div class="collections-title">
			<?php echo $this->lang->line('estampillas'); ?>
			<br>
            <div id="new_list_frame">
				<div id="new-list-button" class="google-button-blue" onClick="newList(4);"><?php echo $this->lang->line('lista_nueva'); ?></div>
			</div>            
			<select id="coin-select" class="collections-input">
				<option value="0" selected="selected"><?php echo $this->lang->line('seleccione'); ?></option>
				<option value="1"><?php echo $this->lang->line('coleccion'); ?></option>
				<option value="2"><?php echo $this->lang->line('deseo'); ?></option>
				<option value="3"><?php echo $this->lang->line('intercambio'); ?></option>
				<option value="5"><?php echo $this->lang->line('venta'); ?></option>
			</select>  
		</div>
		
	</div>
	
</div>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>

<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url().$_SESSION['user'];?>"><?php echo $_SESSION['user']; ?></a>&nbsp;&raquo;&nbsp;<a href="<?php echo base_url().$_SESSION['user'];?>#sec=2"><?php echo $this->lang->line('coleccion'); ?></a>
				</div>
			</div>
			
			<?php
			if ( isset($_SESSION['user']) ){
			?>
			
			<div id="user-in"<?php if ( isset($_SESSION['user']) ) echo 'onclick="launchMenu();"'; ?> >

						<div class="separator-left"></div>

						<img height="16" width="16" alt="drop" id="arrow-down" src="<?php echo base_url(); ?>img/arrow-down.png"  />
				
				<span id="user-name">
					<?php 
						echo $_SESSION['name'];
											
						if ( $notifications ){

								?>

									<span class="notification-out">

								<a href="<?php echo base_url(); ?>account/#sec=6">

											<span title="<?php echo $this->lang->line('nueva_notificacion'); ?>" class="notification"><?php echo count($notifications); ?></span>

										</a>

									</span>

								<?php

								}

					?>
				</span>
				
				<img height="35" width="35" id="user-image" alt="user image" src="<?php echo base_url(); ?>users/img/<?php echo $_SESSION['img']; ?>" />	
			</div>
		<?php
			}
			else{
		?>
			<div id="signin">
				<a id="go" rel="leanModal" href="#modal-signin" class="google-button google-button-blue"><?php echo $this->lang->line('iniciar_sesion'); ?></a>
			</div>
		
		<?php
			}
		?>
			
		</div>
	</div>
						
	<div id="modal-signin">
		<script>
			$("#modal-signin").load('<?php echo base_url(); ?>ajax/signin/index.php',{backs:'../',done:'../account'});
		</script>					
	</div>
	
	<input type="hidden" id="share-url" value="www.collecworld.com/<?php echo $_SESSION['user']; ?>" />
	<?php
		/*				
		if ( $user['num_trades'] > 0 ){
			$user_rating = ($user['good_trades'] / $user['num_trades'])*100;
		}
		else{
			$user_rating = 0;	
		}
		
		if ( $user_rating > 70 ){
			$rating = 'good';
		}
		else{
			if ( $user_rating > 40 ){
				$rating = 'medium';
			}
			else{
				$rating = 'bad';
			}
		}*/		
	?>	
	<div id="content-in">
<?php
 	switch($list_items[0]['phonecards_circulation']){
		case 0 : $circulation = $this->lang->line('c_normal');
		break;
		case 1 : $circulation = $this->lang->line('c_especial');
		break;
			
	}
?>  
	<div class="title42"><?php echo $list_items[0]['countries'].' » Collecworld » '.$circulation.' » '.$list_items[0]['companies'].' » '.ucfirst($list_items[0]['systems']); ?></div>
 
	
    
    
	<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
	<div id="modal-phonecard"></div>
    <a id="modalNote" style="display:none;" rel="leanModal" href="#modal-note">a</a>

	<div id="modal-note"></div>
	
    <table cellpadding="10">
    	<tr>
        	<td>
            	<a href="#" title="<?php echo $this->lang->line('exportar_pdf'); ?>"><img src="<?php echo base_url(); ?>img/pdf-icon.png" /></a>
            </td>
            <td>
            	<a href="#" title="<?php echo $this->lang->line('exportar_excel'); ?>"><img src="<?php echo base_url(); ?>img/excel-icon.png" /></a>
            </td>
            <td>
                <input type="checkbox" onchange="showVariations(this);" <?php if ( isset($no_variations) && $no_variations == 1 ) echo 'checked="checked"'; ?> />
                <?php echo $this->lang->line('no_mostrar_variantes'); ?>
            </td>
            <?php // if($list==1){ ?>
            <td>
                <input type="button" onClick="showMinus()" value="<?php echo $this->lang->line('faltantes_coleccion'); ?>" class="google-button">
            </td>
            <?php // } ?>
        </tr>
    </table>
	<table id="collections-table" cellpadding="10" >
		<tr class="collections-table-head">
			<td><?php echo $this->lang->line('nombre'); ?></td>
			<td><?php echo $this->lang->line('fecha'); ?></td>
			<td><?php echo $this->lang->line('tipo_sistema'); ?></td>
			<td><?php echo $this->lang->line('logo'); ?></td>
			<td><?php echo $this->lang->line('variante_descriptiva'); ?></td>
		</tr>
        <?php
			foreach($list_items as $list_item){
		?>
        <tr>
        	<td>
			<?php 
			if($list_item['phonecards_name'])
				echo $list_item['phonecards_name']; 
			else
				echo '--'
			?>
            </td>
            <td>
			<?php 
			if($list_item['issued_on'])
				echo $list_item['issued_on']; 
			else
				echo '--'
			?>
            </td>
            <td>
			<?php 
			if($list_item['systems_type'])
				echo $list_item['systems_type']; 
			else
				echo '--'
			?>
            </td>
            <td>
			<?php 
			if($list_item['logos'])
				echo $list_item['logos']; 
			else
				echo '--'
			?>
            </td>
            <td>
			<?php 
			if($list_item['descriptive_variation'])
				echo $list_item['descriptive_variation']; 
			else
				echo '--'
			?>
            </td>      
        </tr>
        <?php
			}
		?>
        
     </table>
    </div>
</div>
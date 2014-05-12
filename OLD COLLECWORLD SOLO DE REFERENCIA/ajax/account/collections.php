<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 


@session_start();

?>
<div class="title4">
	<?php echo $lang['mis_colecciones']; ?>
</div>

<div class="account-collections">
	<br />
	<div class="collections-item">
	
		<div class="collections-img">
			<img src="<?php echo $path; ?>img/account-pc.png" width="64" height="64" >
		</div>
		
		<div class="collections-title">
			<?php echo $lang['tarjetas_telefonicas']; ?>
			<br>
            <div id="new_list_frame">
				<div id="new-list-button" class="google-button-blue" onClick="newList(1);"><?php echo $lang['lista_nueva']; ?></div>
			</div>
            <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_users']; ?>" />
            
			<select id="pc-select" class="collections-input">
				<option value="0" selected="selected"><?php echo $lang['seleccione']; ?></option>
				<option value="1"><?php echo $lang['coleccion']; ?></option>
				<option value="2"><?php echo $lang['deseo']; ?></option>
				<option value="3"><?php echo $lang['intercambio']; ?></option>
				<option value="5"><?php echo $lang['venta']; ?></option>
                <?php
                	$sql = 'SELECT * FROM lists WHERE id_users='.$_SESSION['id_users'].' AND id_categories = 1';
					$cursor = mysql_query($sql);
					
					while($datos = mysql_fetch_array($cursor)){
						echo "<option value='".$datos['id_lists']."'>".$datos['name']."</option>";
					}
                ?>
			</select>
			<span class="google-button" onClick="itemCollection(1);" ><?php echo $lang['ir']; ?></span>
		</div>
		
	</div>
	
	<div class="collections-item">
	
		<div class="collections-img">
			<img src="<?php echo $path; ?>img/account-coin.png" width="64" height="64" >
		</div>
		
		<div class="collections-title">
			<?php echo $lang['monedas']; ?>
			<br>
            <div id="new_list_frame">
				<div id="new-list-button" class="google-button-blue" onClick="newList(2);"><?php echo $lang['lista_nueva']; ?></div>
			</div>            
			<select id="coin-select" class="collections-input">
				<option value="0" selected="selected"><?php echo $lang['seleccione']; ?></option>
				<option value="1"><?php echo $lang['coleccion']; ?></option>
				<option value="2"><?php echo $lang['deseo']; ?></option>
				<option value="3"><?php echo $lang['intercambio']; ?></option>
				<option value="5"><?php echo $lang['venta']; ?></option>
                <?php
                	$sql = 'SELECT * FROM lists WHERE id_users='.$_SESSION['id_users'].' AND id_categories = 2';
					$cursor = mysql_query($sql);
					
					while($datos = mysql_fetch_array($cursor)){
						echo "<option value='".$datos['id_lists']."'>".$datos['name']."</option>";
					}
                ?>
			</select>
			<span class="google-button" onClick="itemCollection(2);" ><?php echo $lang['ir']; ?></span>
		</div>
		
	</div>
    
    <div class="collections-item">
	
		<div class="collections-img">
			<img src="<?php echo $path; ?>img/account-banknote.png" style="margin-top:15px; margin-left:12px;" width="40" >
		</div>
		
		<div class="collections-title">
			<?php echo $lang['billetes']; ?>
			<br>
            <div id="new_list_frame">
				<div id="new-list-button" class="google-button-blue" onClick="newList(3);"><?php echo $lang['lista_nueva']; ?></div>
			</div>            
			<select id="coin-select" class="collections-input">
				<option value="0" selected="selected"><?php echo $lang['seleccione']; ?></option>
				<option value="1"><?php echo $lang['coleccion']; ?></option>
				<option value="2"><?php echo $lang['deseo']; ?></option>
				<option value="3"><?php echo $lang['intercambio']; ?></option>
				<option value="5"><?php echo $lang['venta']; ?></option>
                <?php
                	$sql = 'SELECT * FROM lists WHERE id_users='.$_SESSION['id_users'].' AND id_categories = 3';
					$cursor = mysql_query($sql);
					
					while($datos = mysql_fetch_array($cursor)){
						echo "<option value='".$datos['id_lists']."'>".$datos['name']."</option>";
					}
                ?>
			</select>
			<span class="google-button" onClick="itemCollection(3);" ><?php echo $lang['ir']; ?></span>
		</div>
		
	</div>
	<div class="collections-item">
	
		<div class="collections-img">
			<img src="<?php echo $path; ?>img/account-stamp.png" >
		</div>
		
		<div class="collections-title">
			<?php echo $lang['estampillas']; ?>
			<br>
            <div id="new_list_frame">
				<div id="new-list-button" class="google-button-blue" onClick="newList(4);"><?php echo $lang['lista_nueva']; ?></div>
			</div>            
			<select id="coin-select" class="collections-input">
				<option value="0" selected="selected"><?php echo $lang['seleccione']; ?></option>
				<option value="1"><?php echo $lang['coleccion']; ?></option>
				<option value="2"><?php echo $lang['deseo']; ?></option>
				<option value="3"><?php echo $lang['intercambio']; ?></option>
				<option value="5"><?php echo $lang['venta']; ?></option>
                <?php
                	$sql = 'SELECT * FROM lists WHERE id_users='.$_SESSION['id_users'].' AND id_categories = 4';
					$cursor = mysql_query($sql);
					
					while($datos = mysql_fetch_array($cursor)){
						echo "<option value='".$datos['id_lists']."'>".$datos['name']."</option>";
					}
                ?>
			</select>
			<span class="google-button" onClick="itemCollection(4);" ><?php echo $lang['ir']; ?></span>
		</div>
		
	</div>
	
</div>
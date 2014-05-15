<?php
	switch($list['id_categories']){
		
		case '1' : $cat_name = $this->lang->line('tarjetas_telefonicas'); 
		break;	
		case '2' : $cat_name = $this->lang->line('monedas'); 
		break;	
		case '3' : $cat_name = $this->lang->line('billetes'); 
		break;	
		case '4' : $cat_name = $this->lang->line('estampillas'); 
		break;	
	}
	
?>

<div class="title4">
    <?php echo $this->lang->line('mis_colecciones').' - '.$cat_name.' ['.ucfirst($list['name']).']'; ?>    
</div>
<?php

//Verifico que la lista no este entre las predeterminadas para mostrar el formulario editar
$default_list = array("collection", "wish", "exchange", "sell");

if(isset($list['table_name']))
	$nameL = $list['table_name'];
else
	$nameL = $list['name']; 
 
if (!in_array($nameL, $default_list)){
	
	switch($list['privacy']){
		
		case '0' : $priv = $this->lang->line('publico'); 
		break;	
		case '1' : $priv = $this->lang->line('amigos'); 
		break;	
		case '2' : $priv = $this->lang->line('solo_yo'); 
		break;	 
	}
?> 
	<input type="hidden" id="id_lists" value="<?php echo $list['id_lists']; ?>">
    <input type="hidden" id="id_users" value="<?php echo $list['id_users']; ?>">
    <table id="collections-table" cellpadding="2" >
     <?php if($list > 5){ ?>
        <tr>
            <td>Name: &nbsp; <input type="text" name="list_name" id="list_name" value="<?php echo $list['name']; ?>" /></td>
            <td colspan="2">Privacy: &nbsp; 
                <select name="list_priv" id="list_priv">
                    <option value="<?php echo $list['privacy']; ?>"><?php echo $priv; ?></option>
                    <?php if($list['status']!=0){ ?><option value="0"><?php echo $this->lang->line('publico'); ?></option> <?php } ?>
                    <?php if($list['status']!=1){ ?><option value="1"><?php echo $this->lang->line('amigos'); ?></option> <?php } ?>
                    <?php if($list['status']!=2){ ?><option value="2"><?php echo $this->lang->line('solo_yo'); ?></option> <?php } ?>
                </select>
            </td>
            <td><span class="google-button" onClick="editList();" ><?php echo $this->lang->line('editar_lista'); ?></span></td>
        </tr> 
     <?php } ?>
    </table>
<?php
}
?>
<br>
<hr>

<!-- MUESTRO EL EXPLORAR DE LISTAS SI TIENE ARTICULOS-->
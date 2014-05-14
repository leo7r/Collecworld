<script>

$(document).ready(function(){
	$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
	$('#modal-close').click(function(){
		$("#lean_overlay").click();
	});
	
});

function modalPhonecard( _p ){

	$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,backs:'../'},function(){
		$("#modalP").click();
	});

}

function showImg( dom ){
	
	var img = dom.getElementsByTagName('img')[0];
	
	if ( $(img).css('opacity') == 1 ){
		$(img).css({opacity:0});
	}
	else{
		$(img).css({opacity:1});
	}
	
}

</script>

<?php

function trimm( $str , $num ){
	
	if ( strlen($str) > $num ){
		$ret = substr($str,0,$num);
		$ret = $ret.'...';
		return $ret;
	}
	
	return $str;
} 

switch( $category ){

case 1:
	$title = $this->lang->line('nueva_lista_tarjetas_telefonicas');
	$explore = 'phonecard';
	break;
case 2:
	$title = $this->lang->line('nueva_lista_monedas');
	$explore = 'coin';
	break;	
case 3:
	$title = $this->lang->line('nueva_lista_billetes');
	$explore = 'banknote';
	break;	
case 4:
	$title = $this->lang->line('nueva_lista_estampillas');
	$explore = 'stamp';
	break;	
}
 
?>
	<div class="title4">
		<?php echo $this->lang->line('mis_colecciones').' - '.$title; ?>
	</div>
	<?php $_SESSION['id_users'] = 1 ; ?>
	<input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_users']; ?>" />
	<table id="collections-table" cellpadding="2" >
    	<tr>
			<td><?php echo $this->lang->line('nombre'); ?>: &nbsp; <input type="text" name="list_name" id="list_name" /></td>
			<td colspan="2"><?php echo $this->lang->line('privacidad'); ?>: &nbsp; 
                <select name="list_priv" id="list_priv">
                 
					 <option value="0"><?php echo $this->lang->line('publico'); ?></option>
                     <option value="1"><?php echo $this->lang->line('amigos'); ?></option>
                     <option value="2"><?php echo $this->lang->line('solo_yo'); ?></option> 
					 
                </select>
            </td>
            <td>
            	<span class="google-button" onclick="createList(<?php echo $category; ?>);"><?php echo $this->lang->line('crear_nueva_lista'); ?></span>
            </td>
		</tr>
     </table>
<br />


		<div id="info-info">
			<?php echo $this->lang->line('nueva_lista_esta_vacia'); ?>
			<br />
			<?php echo $this->lang->line('tu_puedes'); ?> <a href="<?php echo base_url(); ?>explore/<?php echo $explore; ?>"><?php echo $this->lang->line('explorar'); ?></a> <?php echo $this->lang->line('para_completar_tu_coleccion'); ?>
		</div>

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

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
}

$category = $_REQUEST['category'];

switch( $category ){

case 1:
	$title = $lang['nueva_lista_tarjetas_telefonicas'];
	$explore = 'phonecard';
	break;
case 2:
	$title = $lang['nueva_lista_monedas'];
	$explore = 'coin';
	break;	
case 3:
	$title = $lang['nueva_lista_billetes'];
	$explore = 'banknote';
	break;	
case 4:
	$title = $lang['nueva_lista_estampillas'];
	$explore = 'stamp';
	break;	
}


session_start();
?>
	<div class="title4">
		<?php echo $title; ?>
	</div>

	<input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_users']; ?>" />
	<table id="collections-table" cellpadding="2" >
    	<tr>
			<td><?php echo $lang['nombre']; ?>: &nbsp; <input type="text" name="list_name" id="list_name" value="<?php echo $datos_list['name']; ?>" /></td>
			<td colspan="2"><?php echo $lang['privacidad']; ?>: &nbsp; 
                <select name="list_priv" id="list_priv">
                
            	<?php
					$sql = 'SELECT list_privacy FROM users WHERE id_users='.$_SESSION['id_users'];
					$cursor = mysql_query($sql);
					
					$datos = mysql_fetch_array($cursor);
					
					switch($datos['list_privacy']){
					
					case 0: echo '<option value="0">'.$lang['publico'].'</option><option value="1">'.$lang['amigos'].'</option><option value="2">'.$lang['solo_yo'].'</option>'; break;
					case 1: echo '<option value="1">'.$lang['amigos'].'</option><option value="0">'.$lang['publico'].'</option><option value="2">'.$lang['solo_yo'].'</option>'; break;
					case 2: echo '<option value="2">'.$lang['solo_yo'].'</option><option value="0">'.$lang['publico'].'</option><option value="1">'.$lang['amigos'].'</option>'; break;	
					}
				?>
                </select>
            </td>
            <td>
            	<span class="google-button" onclick="createList(<?php echo $category; ?>);"><?php echo $lang['crear_nueva_lista']; ?></span>
            </td>
		</tr>
     </table>
<br />


		<div id="info-info">
			<?php echo $lang['nueva_lista_esta_vacia']; ?>
			<br />
			<?php echo $lang['tu_puedes']; ?> <a href="<?php echo $path; ?>index.php/explore/<?php echo $explore; ?>"><?php echo $lang['explorar']; ?></a> <?php echo $lang['para_completar_tu_coleccion']; ?>
		</div>

<script>
function modalTradePhonecard( p , trade_type ){
	$("#modal-trade-phonecard").load(path+'ajax/showTradePhonecard.php',{p:p,type:trade_type,button:1},function(){
		$("#modalTP").click();
	});	
}

function modalTradeCoin( p , trade_type ){
	$("#modal-trade-phonecard").load(path+'ajax/showTradeCoin.php',{p:p,type:trade_type,button:1},function(){
		$("#modalTP").click();
	});	
}

$(document).ready(function(){

	$('a[rel*=leanModalTP]').leanModal({ top : 40, closeButton: ".modal-close" });

	$('#modal-close').click(function(){
		$("#lean_overlay").click();

	});
});

</script>
<?php
	@session_start();
	
	if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
}
	
	
	if($_REQUEST['type']=="buy"){
		
		$num_type=5;
		
	}else{
		
		$num_type=3;
	}
	
	$category_var = '';
	$category_id = 0;
	
	switch( $_REQUEST['category'] ){
	
	case 'phonecard':
		$category_var = 'phonecards';
		$category_var2 = 'phonecard';
		$category_id = 1;
		break;
	case 'coin':
		$category_var = 'coins';
		$category_var2 = 'coin';
		$category_id = 2;
		break;
	}
	
	$sql_local = "SELECT p.id_".$category_var."_users , p.id_users, p.id_".$category_var.", p.id_lists, p.status_".$category_var2.", p.price, u.*, c.name as name_country, c.id_countries, SUM(tu.calification)/COUNT(tu.id_users) as cal FROM ".$category_var."_users p, countries c, users u LEFT JOIN trade_users tu ON u.id_users = tu.id_users WHERE p.id_".$category_var."=".$_REQUEST['trade_article']." AND p.id_users=u.id_users AND u.id_countries=".$_REQUEST['user']['id_countries']." AND u.id_countries=c.id_countries AND p.id_lists=".$num_type." AND u.id_users != ".$_SESSION['id_users']." GROUP BY p.id_".$category_var."_users ORDER BY p.price";
	$cursor_local = mysql_query($sql_local);
	$num_local=mysql_num_rows($cursor_local);
	
	$sql_nolocal = "SELECT p.id_users, p.id_".$category_var.", p.id_lists, p.status_".$category_var2.", p.price, u.*, c.name as name_country, c.id_countries, SUM(tu.calification)/COUNT(tu.id_users) as cal FROM ".$category_var."_users p, countries c, users u LEFT JOIN trade_users tu ON u.id_users = tu.id_users WHERE p.id_".$category_var." = ".$_REQUEST['trade_article']." AND p.id_users=u.id_users AND u.id_countries!=".$_REQUEST['user']['id_countries']." AND u.id_countries=c.id_countries AND p.id_lists=".$num_type." AND u.id_users != ".$_SESSION['id_users']." GROUP BY p.id_".$category_var."_users ORDER BY p.price";
	$cursor_nolocal = mysql_query($sql_nolocal);
	$num_nolocal=mysql_num_rows($cursor_nolocal);
	
?>
<a id="modalTP" style="display:none;" rel="leanModalTP" href="#modal-trade-phonecard">a</a>
<div id="modal-trade-phonecard"></div>

<table id="trade-user-table" cellspacing="5">
    <tr>
        <td><?php echo $lang['seleccionar_usuario']; ?></td>
        <td><?php echo $lang['ordenar_por']; ?>:
        	<select id="show_user_trade" onchange="show_user_trade(this);">
                <option value="1"><?php echo $lang['ubicacion']; ?></option>
                <?php if ($num_type==5){?><option value="2"><?php echo $lang['precio']; ?></option><?php } ?>
                <option value="3"><?php echo $lang['reputacion']; ?></option>
        	</select> 
        </td>
    </tr>
    <tr>
        <td colspan="2"><hr style="margin:0;" /></td>
    </tr>
    <tr>
        <td colspan="2">
        <strong><?php echo $lang['en_tu_pais']; ?></strong>
        </td>
    </tr>
    <tr>
        <td colspan="2">
			<?php
            if(!$num_local){
				
				echo $lang['ningun_usuario_tiene_el_articulo'];
                
            }else{
                while($datos_local=mysql_fetch_array($cursor_local)){
                    
					$modalOnClick = '';
					
					switch( $category_id ){
						
						case 1:
							$modalOnClick = 'modalTradePhonecard('.$datos_local['id_'.$category_var.'_users'].','.$num_type.')';
							break;
						case 2:
							$modalOnClick = 'modalTradeCoin('.$datos_local['id_'.$category_var.'_users'].','.$num_type.')';
							break;
							
					}
            ?>
            
                <div id="user-trade" onClick="<?php echo $modalOnClick; ?>" >
                    
                    <img id="user-image-trade" height="100" width="100" src="<?php echo $path.'users/img/'.$datos_local['image']; ?>"/>
                    <?php
					$cal = $datos_local['cal']*100;
					
					if(($cal >= 0) && ($cal <= 30)){
						$color = '#FF0000';
					 }else if(($cal > 30) && ($cal <= 60)){
						$color = '#FF4000';
					 }else if(($cal > 60) && ($cal <= 100)){
						$color = '#04B404';
					 }
					?>
                    <div id="user-info-trade">
                    	<table border="0" width="100">
                       		<tr>
                            	<td><strong><?php echo $datos_local['user']; ?></strong> <span style="color:<?php echo $color; ?>"><?php echo $cal ?></span></td>
                            </tr> 
                            <tr>
                            	<td><?php echo $datos_local['name_country']; ?></td>
                            </tr>
                            <tr>
                            	<td>
								<?php 
								if($datos_local['status_'.$category_var2]){
									
									echo $datos_local['status_'.$category_var2];
								}else{
									echo $lang['no_disponible'];	
								}
								?>
                                </td>
                            </tr>
                           <?php if ( $num_type == 5){?>
                            <tr>
                            	<td>
								<?php 
								if($datos_local['price']){
									
									echo '$ '.$datos_local['price'];
								}else{
									echo $lang['no_disponible'];	
								}
								?>
                                </td>
                            </tr>
                        	<?php } ?>
                        </table>                    
                    </div>
                                  
                </div>
                    
            <?php	
                }
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
        <strong><?php echo $lang['en_otros_paises']; ?></strong>
        </td>
    </tr>
    <tr>
        <td colspan="2">
        <?php
		if(!$num_nolocal){
				
			echo $lang['ningun_usuario_tiene_el_articulo'];
			
		}else{
			while($datos_nolocal=mysql_fetch_array($cursor_nolocal)){
			
			$modalOnClick = '';
			
			switch( $category_id ){
				
				case 1:
					$modalOnClick = 'modalTradePhonecard('.$datos_local['id_'.$category_var.'_users'].','.$num_type.')';
					break;
				case 2:
					$modalOnClick = 'modalTradeCoin('.$datos_local['id_'.$category_var.'_users'].','.$num_type.')';
					break;
					
			}				
		?>
        
        	<div id="user-trade" onClick="<?php echo $modalOnClick; ?>" >
                    
                    <img id="user-image-trade" height="100" width="100" src="<?php echo $path.'users/img/'.$datos_nolocal['image']; ?>"/>
                    <?php
					$cal = $datos_nolocal['cal']*100;
					
					if(($cal >= 0) && ($cal <= 30)){
						$color = '#FF0000';
					 }else if(($cal > 30) && ($cal <= 60)){
						$color = '#FF4000';
					 }else if(($cal > 60) && ($cal <= 100)){
						$color = '#04B404';
					 }
					?>
                    <div id="user-info-trade">
                    	<table border="0" width="100">
                       		<tr>
                            	<td><strong><?php echo $datos_nolocal['user']; ?></strong>  <span style="color:<?php echo $color; ?>"><?php echo $cal ?></span></td>
                            </tr> 
                            <tr>
                            	<td><?php echo $datos_nolocal['name_country']; ?></td>
                            </tr>
                            <tr>
                            	<td>
								<?php 
								if($datos_nolocal['status_'.$category_var2]){
									
									echo $datos_nolocal['status_'.$category_var2];
								}else{
									echo $lang['no_disponible'];	
								}
								?>
                                </td>
                            </tr>
                           <?php if ( $num_type == 5){?>
                            <tr>
                            	<td>
								<?php 
								if($datos_nolocal['price']){
									
									echo '$ '.$datos_nolocal['price'];
								}else{
									echo $lang['no_disponible'];	
								}
								?>
                                </td>
                            </tr>
                        	<?php } ?>
                        
                        </table>                    
                    </div>
                                  
                </div>
        <?php
			}
		}
		?>
        </td>
    </tr>
</table>
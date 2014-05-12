<script>
function modalTradePhonecard( p , trade_type ){
	$("#modal-trade-phonecard").load(path+'ajax/showTradePhonecard.php',{p:p,type:trade_type,button:1},function(){
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
	
	if($_REQUEST['category']='phonecard'){
		$sql_rep = "SELECT p.id_users, p.id_phonecards, p.id_lists, p.status_phonecard, p.price, u.*, c.name as name_country, c.id_countries, SUM(tu.calification)/COUNT(tu.id_users) as cal , p.id_phonecards_users FROM phonecards_users p, countries c , users u LEFT JOIN trade_users tu ON u.id_users = tu.id_users WHERE p.id_phonecards = ".$_REQUEST['trade_article']." AND p.id_users=u.id_users AND u.id_countries=c.id_countries AND p.id_lists=".$num_type." AND u.id_users != ".$_SESSION['id_users']." GROUP BY p.id_phonecards_users ORDER BY SUM(tu.calification)/COUNT(tu.id_users) DESC;";
		
		$cursor_rep = mysql_query($sql_rep);
		$num_rep=mysql_num_rows($cursor_rep);
		
	}else{
			
	}
	
?>
<a id="modalTP" style="display:none;" rel="leanModalTP" href="#modal-trade-phonecard">a</a>
<div id="modal-trade-phonecard"></div>

<table id="trade-user-table" cellspacing="5">
    <tr>
        <td><?php echo $lang['seleccionar_usuario']; ?></td>
        <td><?php echo $lang['ordenar_por']; ?>:
        	<select id="show_user_trade" onchange="show_user_trade(this);">
                <option value="<?php echo $_REQUEST['show']; ?>">
                <?php 
				switch ( $_REQUEST['show'] ){
					
					case 1: echo $lang['ubicacion']; break;
					case 2: echo $lang['precio']; break;
					case 3: echo $lang['reputacion']; break;
					
				}
				?>
                </option>
                <?php if ($_REQUEST['show']!=1){?><option value="1"><?php echo $lang['ubicacion']; ?></option><?php } ?>
                <?php if (($_REQUEST['show']!=2) && ($num_type==5)){?><option value="2"><?php echo $lang['precio']; ?></option><?php } ?>
                <?php if ($_REQUEST['show']!=3){?><option value="3"><?php echo $lang['reputacion']; ?></option><?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2"><hr style="margin:0;" /></td>
    </tr>
    <tr>
        <td colspan="2">
        <strong><?php echo $lang['ordenar_por_reputacion']; ?></strong>
        </td>
    </tr>
    <tr>
        <td colspan="2">
			<?php
            if(!$num_rep){
				
				echo $lang['ningun_usuario_tiene_el_articulo'];
                
            }else{
                while($datos_rep=mysql_fetch_array($cursor_rep)){ 
            ?>
            
                <div id="user-trade" onClick="modalTradePhonecard(<?php echo $datos_rep['id_phonecards_users']; ?>,<?php echo $num_type; ?>)" >
                    
                    <img id="user-image-trade" height="100" width="100" src="<?php echo $path.'users/img/'.$datos_rep['image']; ?>"/>
                    <?php
					$cal = $datos_rep['cal']*100;
					
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
                            	<td><strong><?php echo $datos_rep['user']; ?></strong> <span style="color:<?php echo $color; ?>"><?php echo $cal ?></span></td>
                            </tr> 
                            <tr>
                            	<td><?php echo $datos_rep['name_country']; ?></td>
                            </tr>
                            <tr>
                            	<td>
								<?php 
								if($datos_rep['status_phonecard']){
									
									echo $datos_rep['status_phonecard'];
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
								if($datos_rep['price']){
									echo '$ '.$datos_rep['price'];
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
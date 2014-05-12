
<?php
	
		if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
}
	
	if($_REQUEST['category']='phonecard'){
		
		$sql_local = "SELECT p.id_users, p.id_phonecards, u.* FROM phonecards_users p, users u WHERE p.id_phonecards=".$_REQUEST['trade_article']." AND p.id_users=u.id_users AND u.id_countries=".$_REQUEST['user']['id_countries']." group by u.id_users";
		$cursor_local = mysql_query($sql_local);
		$num_local=mysql_num_rows($cursor_local);
		
		$sql_nolocal = "SELECT p.id_users, p.id_phonecards, u.* FROM phonecards_users p, users u WHERE p.id_phonecards=".$_REQUEST['trade_article']." AND p.id_users=u.id_users AND u.id_countries!=".$_REQUEST['user']['id_countries']." group by u.id_users";
		$cursor_nolocal = mysql_query($sql_nolocal);
		$num_nolocal=mysql_num_rows($cursor_nolocal);
			
	}else{
			
	}
	
?>
<table id="trade-user-table" cellspacing="5">
    <tr>
        <td>Select User</td>
        <td>Sort By: 
            <select id="show_user_trade" onchange="show_user_trade(this);">
                <option value="<?php echo $_REQUEST['show']; ?>">
                <?php 
				switch ( $_REQUEST['show'] ){
					
					case 1: echo "Ubication"; break;
					case 2: echo "Price"; break;
					case 3: echo "Reputation"; break;
					
				}
				?>
                </option>
                <?php if ($_REQUEST['show']!=1){?><option value="1">Ubication</option><?php } ?>
                <?php if ($_REQUEST['show']!=2){?><option value="2">Price</option><?php } ?>
                <?php if ($_REQUEST['show']!=3){?><option value="3">Reputation</option><?php } ?>
            </select> 
        </td>
    </tr>
    <tr>
        <td colspan="2"><hr style="margin:0;" /></td>
    </tr>
    <tr>
        <td colspan="2">
        <strong>In your country</strong>
        </td>
    </tr>
    <tr>
        <td colspan="2">
			<?php
            if(!$num_local){
				
				echo "No users in your country with this article";
                
            }else{
                while($datos_local=mysql_fetch_array($cursor_local)){
                    
            ?>
            
                <div style="float:left; cursor:pointer;" onclick="location.href='<?php echo $path."index.php/trade/".$_REQUEST['trade_article']."/".$_REQUEST['category']."/".$datos_local['user']; ?>';"><img id="user-image" title="<?php echo $datos_local['user']; ?>" height="35" width="35" src="<?php echo $path.'users/img/'.$datos_local['image']; ?>" /></div>
                    
            <?php	
                }
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
        <strong>In other countries</strong>
        </td>
    </tr>
    <tr>
        <td colspan="2">
        <?php
		if(!$num_nolocal){
				
			echo "No users in other countries with this article";
			
		}else{
			while($datos_nolocal=mysql_fetch_array($cursor_nolocal)){
				
		?>
        
        	<div style="float:left; cursor:pointer;" onclick="location.href='';"><img id="user-image" title="<?php echo $datos_nolocal['user']; ?>" height="35" width="35" src="<?php echo $path.'users/img/'.$datos_nolocal['image']; ?>" /></div>
                
        <?php
			}
		}
		?>
        </td>
    </tr>
</table>
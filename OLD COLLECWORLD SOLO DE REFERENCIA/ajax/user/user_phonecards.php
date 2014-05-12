<script>

$(document).ready(function(){
	$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
	$('a[rel*=leanModalTP]').leanModal({ top : 40, closeButton: ".modal-close" });
	$('#modal-close').click(function(){
		$("#lean_overlay").click();
	});
	
	$(".explore-item-info").hover(
		function () {
			$(this).animate({opacity:1},150);
		},
		function () {
			$(this).animate({opacity:0},400);
		}
	);
	
});

function modalPhonecard( _p ){

	$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,backs:'../'},function(){
		$("#modalP").click();
	});

}

function modalTradePhonecard( p , trade_type ){
	$("#modal-trade-phonecard").load(path+'ajax/showTradePhonecard.php',{p:p,type:trade_type,button:1},function(){
		$("#modalTP").click();
	});
	
	
}

</script>

<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>
<div id="modal-phonecard"></div>
<a id="modalTP" style="display:none;" rel="leanModalTP" href="#modal-trade-phonecard">a</a>
<div id="modal-trade-phonecard"></div>

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

function trimm( $str , $num ){
	
	if ( strlen($str) > $num ){
		$ret = substr($str,0,$num);
		$ret = $ret.'...';
		return $ret;
	}
	
	return $str;
}

$list_user = $_REQUEST['list'];
$id_user = $_REQUEST['id'];
$pag = intval($_REQUEST['pag']);
$cou = $_REQUEST['cou'];
$com = $_REQUEST['com'];
$sys = $_REQUEST['sys'];
$catalog = $_REQUEST['catalog'];
$cat = intval($_REQUEST['cat']);
$cat_id = $cat;

switch ( $cat ){
	
	case 0:
		$cat = $lang['tarjetas_telefonicas'];
		break;
	case 1:
		$cat = $lang['monedas'];
		break;
	case 2:
		$cat = $lang['estampillas'];
		break;
	case 3:
		$cat = $lang['tapas_botella'];
		break;
	
}

if ( $list_user and $id_user ){

	switch( $list_user ){
		case 1:
			$list_name = $lang['coleccion'];
			break;
		case 2:
			$list_name = $lang['deseo'];
			break;
		case 3:
			$list_name = $lang['intercambio'];
			break;
		case 5:
			$list_name = $lang['venta'];
			break;	
	}
	
	$sys_name = '';
	
	switch ( $sys ){
		case 1:
			$sys_name = $lang['chip'];
			break;
		case 2:
			$sys_name = $lang['banda_magnetica'];
			break;
		case 3:
			$sys_name = $lang['sistema_optico'];
			break;
		case 4:
			$sys_name = $lang['memoria_remota'];
			break;
		case 4:
			$sys_name = $lang['sistema_inducido'];
			break;
	}
	
	$catalog_name = '';
	switch( $catalog ){
		
		case 1:
			$catalog_name = $lang['tarjetas_fecha'];
			break;
		case 2:
			$catalog_name = $lang['tarjetas_sin_fecha'];
			break;
		case 3:
			$catalog_name = $lang['tarjetas_uso_interno'];
			break;
		case 4:
			$catalog_name = $lang['tarjetas_especiales'];
			break;
		
	}
	
	$info_u = mysql_query('SELECT * FROM users WHERE id_users = '.$id_user);
	$info_u = mysql_fetch_array($info_u);
	
	$country = mysql_query('SELECT * FROM countries WHERE id_countries = '.$cou);
	$country = mysql_fetch_array($country);
	
	$company = mysql_query('SELECT * FROM phonecards_companies WHERE id_phonecards_companies = '.$com);
	$company = mysql_fetch_array($company);
	
	?>
	
	<div id="collection-nav">
		<a href="./?u=<?php echo $info_u['user']; ?>"><?php echo '@'.$info_u['user']; ?></a>
        &nbsp;&raquo;&nbsp;
        <a href="javascript:showUserCollection(<?php echo $cat_id; ?>,document.getElementById('cat<?php echo $cat_id; ?>'))"><?php echo $cat; ?></a>
        &nbsp;&raquo;&nbsp;
        <a href="javascript:showUserCol( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , 1 )"><?php echo $list_name; ?></a>
        &nbsp;&raquo;&nbsp;
        <a href="javascript:showUserCol_step2( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $country['id_countries']; ?> )"><?php echo $country['name']; ?></a>
        &nbsp;&raquo;&nbsp;
        <a href="javascript:showUserCol_step3( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> )"><?php echo $company['name']; ?></a>
        &nbsp;&raquo;&nbsp;
        <a href="javascript:showUserCol_step4( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $sys; ?> )"><?php echo $sys_name; ?></a>
        &nbsp;&raquo;&nbsp;
        <a href="javascript:showUserCol_final( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $sys; ?> , <?php echo $catalog; ?> )"><?php echo $catalog_name; ?></a>
	</div>
	
	<?php

	$catalog_sql = '';

	switch ( $catalog ){
	
	case 1:
		$catalog_sql = ' AND p.order_date <> "Unknown" AND p.not_emmited = 0 AND p.especial = 0';
		break;
	case 2:
		$catalog_sql = ' AND p.order_date = "Unknown" AND p.not_emmited = 0 AND p.especial = 0';
		break;
	case 3:
		$catalog_sql = ' AND p.not_emmited = 1';
		break;
	case 4:
		$catalog_sql = ' AND p.especial = 1';
		break;		
	}

	
	$sql = 'SELECT p.name as Name , s.name as Serie , p.id_phonecards_systems as System , c.name as Company , co.name as Country , p.issued_on , p.face_value , p.print_run , p.id_phonecards , p.image as image , p.image_reverse , p.code , p.vertical_anverse , pu.id_phonecards_users FROM phonecards p , phonecards_companies c , countries co , phonecards_series s , phonecards_systems sy , phonecards_users pu WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_phonecards_companies = c.id_phonecards_companies AND p.id_countries = co.id_countries AND pu.id_lists = '.$list_user.' AND pu.id_users = '.$id_user.' AND pu.id_phonecards = p.id_phonecards AND p.id_countries = '.$cou.' AND p.id_phonecards_companies = '.$com.' AND p.id_phonecards_systems = '.$sys.' '.$catalog_sql.' GROUP BY pu.id_phonecards_users ORDER BY issued_on , face_value , print_run LIMIT '.strval((($pag-1)*12)).' , 12;';
	
	$cursor = mysql_query($sql);
	$num = mysql_num_rows($cursor);
	
	if ( $num == 0 ){
		echo $lang['Listado_vacio'];
		return;
	}
	
	for ( $i=0 ; $i<$num ; $i++ ){
		$datos = mysql_fetch_array($cursor);
		switch( $list_user ){
			case 1:
				$onClick = 'modalPhonecard('.$datos['id_phonecards'].')';
				break;
			case 2:
				$onClick = 'modalPhonecard('.$datos['id_phonecards'].')';
				break;
			case 3:
				$onClick = 'modalTradePhonecard('.$datos['id_phonecards_users'].',3)';
				break;
			case 5:
				$onClick = 'modalTradePhonecard('.$datos['id_phonecards_users'].',5)';
				break;	
		}
		
		//$sql2 = 'SELECT * FROM phonecards_series WHERE id_phonecards_series = '.$datos['id_phonecards_series'];
		//$cursor2 = mysql_query($sql2);
		//$datos2 = mysql_fetch_array($cursor2);
			
		if ( $i % 3 == 0 ){
			?>
			<div class="item-content">
			<?php
		}
		
		if ( $_SESSION['id_users'] ){
			$lists = "select id_lists from phonecards_users WHERE id_users = ".$_SESSION['id_users']." AND id_phonecards = ".$datos['id_phonecards'];
			$cursor4 = mysql_query($lists);
			$list = '';
			for ($j=0 ; $j < mysql_num_rows($cursor4) ; $j++){
				$datos4 = mysql_fetch_row($cursor4);
				$list = $list.' '.$datos4[0].' ';
			}	
		}
		
		?>
			<div class="explore-item" >
				
				<div class="explore-item-title" onclick="<?php echo $onClick; ?>">
					<?php echo trimm($datos['Name'],60); ?>
				</div>
					<div onclick="<?php echo $onClick; ?>">
						<div id="item_i<?php echo $i; ?>" class="explore-item-info" style="opacity:0;">
						<table cellpadding="7">
							<tr>
								<td><strong><?php echo $lang['pais']; ?>:</strong><td>
								<td><?php echo trimm($datos['Country'],17); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo $lang['compania']; ?>:</strong><td>
								<td><?php echo trimm($datos['Company'],17); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo $lang['serie']; ?>:</strong><td>
								<td><?php echo trimm($datos['Serie'],17); ?></td>
							</tr>
							<tr>
								<td><strong><?php echo $lang['emitida']; ?>:</strong><td>
								<td><?php echo $datos['issued_on']; ?></td>
							</tr>
							<tr>
								<td><strong><?php echo $lang['sistema']; ?>:</strong><td>
								<td>
									<?php
										switch ( $datos['System'] ){
											case 1:
												echo $lang['chip'];
												break;
											case 2:
												echo $lang['banda_magnetica'];
												break;
											case 3:
												echo $lang['sistema_optico'];
												break;
											case 4:
												echo $lang['memoria_remota'];
												break;
											case 5:
												echo $lang['sistema_inducido'];
												break;
											default:
												echo $lang['desconocido'];
												break;
										}
									?>
								</td>
							</tr>
						</table>
						</div>
						<div style="text-align:center;">
							<img src="<?php echo $datos['image'] ? $path.'upload/img/'.$datos['image'] : $path.'img/default_phonecard.jpg'; ?>"
							 height="<?php if ($datos['vertical_anverse'] == 1) echo '305'; else echo '194'; ?>"
							 width="<?php if ($datos['vertical_anverse'] == 1) echo '194'; else echo '305'; ?>" />
						</div>
					</div>
					
					<div class="item-foot">
						
						<div class="item-code">
							<span class="code-num"><?php echo $datos['code']; ?></span>
						</div>
						
						<div class="item-control" >
                        
                        	<img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="location.href='<?php echo $path; ?>index.php/trade/phonecard/<?php  echo $phonecards[$i]['id_phonecards'];  ?>'"<?php }else{ ?>onclick="showGlobalInfo('Must be logged');"<?php } ?> src="<?php echo $path; ?>img/trade.png" title="<?php echo $lang['comercio_esta']; ?>" />
                            
                            <div id="wish_cont">
                            <img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,5,<?php echo $phonecards[$i]['id_phonecards']; ?>);"<?php }else{ ?>onclick="showGlobalInfo('Must be logged');"<?php } ?> src="<?php echo $path; ?>img/sell<?php if ( strpos($list,'5') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'5') ) echo 'checked'; ?>" title="<?php echo $lang['vendo_esta']; ?>" />
                            </div>
                            
                           	<div id="swap_cont">
                            <img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,3,<?php echo $phonecards[$i]['id_phonecards']; ?>);"<?php }else{ ?>onclick="showGlobalInfo('Must be logged');"<?php } ?> src="<?php echo $path; ?>img/exchange<?php if ( strpos($list,'3') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'3') ) echo 'checked'; ?>"  title="<?php echo $lang['cambio_esta']; ?>" />
                            </div>
                            
                            <div id="sell_cont">
                            <img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,2,<?php echo $phonecards[$i]['id_phonecards']; ?>);"<?php }else{ ?>onclick="showGlobalInfo('Must be logged');"<?php } ?> src="<?php echo $path; ?>img/seek<?php if ( strpos($list,'2') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'2') ) echo 'checked'; ?>"  title="<?php echo $lang['quiero_esta']; ?>" />
                            </div>
                            
                            <div id="col_cont<?php echo $i; ?>">
                            <img <?php if ( isset($_SESSION['id_users']) ){ ?>onClick="setLists2(this,1,<?php echo $phonecards[$i]['id_phonecards']; ?>);"<?php }else{ ?>onclick="showGlobalInfo('Must be logged');"<?php } ?> src="<?php echo $path; ?>img/own<?php if ( strpos($list,'1') ) echo '2'; ?>.png" class="<?php if ( strpos($list,'1') ) echo 'checked'; ?>"  title="<?php echo $lang['tengo_esta']; ?>" />
                            </div>
						</div>
				</div>
			</div>
		<?php
		
		if ( $i % 3 == 2 or $i == ($num-1)  )
			echo '</div>';
	}

	
}

?>

<div id="pagination">

<?php
$pag_sql = 'SELECT p.name as Name , s.name as Serie , p.id_phonecards_systems as System , c.name as Company , co.name as Country , p.issued_on , p.face_value , p.print_run , p.id_phonecards , p.image as image , p.image_reverse FROM phonecards p , phonecards_companies c , countries co , phonecards_series s , phonecards_systems sy WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_phonecards_companies = c.id_phonecards_companies AND p.id_countries = co.id_countries AND p.id_phonecards IN ( SELECT pu.id_phonecards FROM phonecards_users pu , phonecards p WHERE pu.id_lists = '.$list_user.' AND pu.id_users = '.$id_user.' AND pu.id_phonecards = p.id_phonecards AND p.id_countries = '.$cou.' AND p.id_phonecards_companies = '.$com.' ) GROUP BY p.id_phonecards ORDER BY issued_on , face_value , print_run;';


$pag_cur = mysql_query($pag_sql);
$num_rows = mysql_num_rows($pag_cur);
$num_pags = $num_rows / 12;

if ( $num_pags > intval($num_pags) ){
	$num_pags = $num_pags+1;
}

// antes de la pagina seleccionada

if ( $pag > 1 ){
?>

<a class="pag-button current-page" href="javascript:showUserCol_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo ($pag-1); ?> );" ><?php echo $lang['anterior']; ?></a>
<?php
}

for ($i=($pag-4) ; $i < $pag ; $i++ ){
	
	if ( $i > 0 ){
		?>
			<a class="pag-button" href="javascript:showUserCol_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $i; ?> );" ><?php echo $i; ?></a>
		<?php
	}
}

?>
<a class="pag-button current-page" href="javascript:showUserCol_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $pag; ?> );" ><?php echo $pag; ?></a>
<?php

// despues de la pagina seleccionada
for ($i=($pag+1) ; $i < $pag+5 ; $i++ ){
	
	if ( $i >= $num_pags )
		break;
	
	?>
		<a class="pag-button" href="javascript:showUserCol_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $i; ?> );" ><?php echo $i; ?></a>
	<?php
}

if ( $pag+1 < $num_pags ){
?>
<a class="pag-button current-page" href="javascript:showUserCol_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo ($pag+1); ?> );" ><?php echo $lang['siguiente']; ?></a>
<?php
}
?>	
</div>
<div id="un_pagination">
<?php
$first_pc = (($pag-1)*12)+1;
//echo $pag.' | '.$num;
$last_pc = $first_pc-1+strval($num);

echo $lang['mostrando'].' '.$first_pc.'-'.$last_pc.' '.$lang['de'].' '.strval($num_rows);
?>
</div>

</div>
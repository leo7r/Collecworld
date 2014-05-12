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
$title = $_REQUEST['title'];
$cat_id = intval($_REQUEST['cat']);
$cat = $lang['monedas'];

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
		
		case 5:
			$list_name = $lang['venta'];
			break;
		default:
			$info_list = mysql_query('SELECT * FROM lists WHERE id_lists = '.$list_user);
			$datos = mysql_fetch_array($info_list);
			$list_name = $datos['name'];
			break;
	}
	
	$info_u = mysql_query('SELECT * FROM users WHERE id_users = '.$id_user);
	$info_u = mysql_fetch_array($info_u);
	
	$country = mysql_query('SELECT * FROM countries WHERE id_countries = '.$cou);
	$country = mysql_fetch_array($country);
	
	$title = mysql_query('SELECT * FROM coins_title WHERE id_coins_title = '.$title);
	$title = mysql_fetch_array($title);
	
	?>
	
	<div id="collection-nav">
		<a href="javascript:showCategories()"><?php echo '@'.$info_u['user']; ?></a>
		&nbsp;&raquo;&nbsp;
		<a href="javascript:showList(<?php echo $cat_id; ?>,<?php echo $list_user; ?>,1)"><?php echo $cat; ?></a>
		&nbsp;&raquo;&nbsp;
		<a href="javascript:showList( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , 1 )"><?php echo $list_name; ?></a>
		&nbsp;&raquo;&nbsp;
		<a href="javascript:showList_step2( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $country['id_countries']; ?> )"><?php echo $country['name']; ?></a>
		&nbsp;&raquo;&nbsp;
		<a href="javascript:showList_final( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $title; ?> , 1 )"><?php echo $title['name']; ?></a>
		&nbsp;&raquo;&nbsp;
	</div>
	
	<table id="mini-explore-table">
	<?php
		
	$sql = 'SELECT coun.name as country, c.image as image, c.image_reverse as image_reverse, c.id_coins as id_coins, ct.name as title, cv.name as value, c.issued_on as issued_on , cu.id_coins_users , cu.status , cu.price FROM coins c, countries coun, coins_title ct, coins_value cv , coins_users cu WHERE c.id_countries = '.$country['id_countries'].' AND c.id_coins_title = ct.id_coins_title AND c.id_coins_title = '.$title['id_coins_title'].' AND c.id_coins_value = cv.id_coins_value AND c.id_countries = coun.id_countries AND cu.id_coins = c.id_coins AND cu.id_users = '.$id_user.' AND cu.id_lists = '.$list_user.' LIMIT '.strval((($pag-1)*18)).' , 18;';
	
	$cursor = mysql_query($sql);
	$num = mysql_num_rows($cursor);
	
	if ( $num == 0 ){
		echo $lang['Listado_vacio'];
		return;
	}
	
	for ( $i=0 ; $i<$num ; $i++ ){
		$datos = mysql_fetch_array($cursor);
		
		if ( $i % 3 == 0 )
			echo '<tr>';
		
		?>
			<td>
				<div class="mini-explore-item">
					<input id="checkbox<?php echo $i; ?>" type="checkbox" style=" float:left;" 
						onClick="checkItem(<?php echo $datos['id_coins']; ?> , <?php echo $datos['id_coins_users']; ?> , '<?php echo $datos['value']; ?>' , '<?php echo $datos['issued_on']; ?>',this);" />
					
					<script>
						refreshCheckbox( <?php echo $datos['id_coins']; ?> , <?php echo $datos['id_coins_users']; ?> , <?php echo $i; ?> );
					</script>
					
					<table height="110">
						<tr>
							<td>
											<img src="<?php echo $datos['image'] ? $path.'upload/coins/'.$datos['image'] :$path.'img/default_coin.jpg'; ?>" 

					height="100" width="100" />
							</td>
							<td valign="top">
                            	<?php
									switch( $list_user ){
										case 3:
										case 5:
											$onClick = 'modalTradeCoin('.$datos['id_coins_users'].','.$list_user.')';
											break;
										default:
											$onClick = 'modalCoin('.$datos['id_coins_users'].')';
											break;
									}
								?>
								<table>
									<tr>
										<td class="mini-explore-modal" onClick="<?php echo $onClick; ?>">
											<b><?php echo $datos['value']; ?></b>
										</td>
									</tr>
									<tr>
										<td><?php echo $datos['title']; ?></td>
									</tr>
									<tr>
										<td><?php echo $datos['issued_on']; ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
					<div>
						<span style="float:left;"><?php echo $datos['status_coin'] ? $datos['status_coin'] : 'Not available'; ?></span>
						<span style="float:right;"><?php echo $datos['price'] ? $datos['price'] : 'Not available'; ?></span>
					</div>			
				</div>
			</td>
		<?php
		
		if ( $i % 3 == 2 or $i == ($num-1)  )
			echo '</tr>';
	}

	
}

?>
	</table>

<div id="pagination">

<?php
$pag_sql = 'SELECT coun.name as country, c.image as image, c.image_reverse as image_reverse, c.id_coins as id_coins, ct.name as title, cv.name as value, c.issued_on as issued_on FROM coins c, countries coun, coins_title ct, coins_value cv , coins_users cu WHERE c.id_countries = '.$country['id_countries'].' AND c.id_coins_title = ct.id_coins_title AND c.id_coins_title = '.$title['id_coins_title'].' AND c.id_coins_value = cv.id_coins_value AND c.id_countries = coun.id_countries AND cu.id_coins = c.id_coins AND cu.id_users = '.$id_user.' AND cu.id_lists = '.$list_user;


$pag_cur = mysql_query($pag_sql);
$num_rows = mysql_num_rows($pag_cur);
$num_pags = $num_rows / 18;

if ( $num_pags > intval($num_pags) ){
	$num_pags = $num_pags+1;
}

// antes de la pagina seleccionada

if ( $pag > 1 ){
?>

<a class="pag-button current-page" href="javascript:showList_final( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $title; ?> , <?php echo ($pag-1); ?> );" ><?php echo $lang['anterior']; ?></a>
<?php
}

for ($i=($pag-4) ; $i < $pag ; $i++ ){
	
	if ( $i > 0 ){
		?>
			<a class="pag-button" href="javascript:showList_final( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $title; ?> , <?php echo $i; ?> );" ><?php echo $i; ?></a>
		<?php
	}
}

?>
<a class="pag-button current-page" href="javascript:showList_final( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $title; ?> , <?php echo $pag; ?> );" ><?php echo $pag; ?></a>
<?php

// despues de la pagina seleccionada
for ($i=($pag+1) ; $i < $pag+5 ; $i++ ){
	
	if ( $i >= $num_pags )
		break;
	
	?>
		<a class="pag-button" href="javascript:showList_final( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $title; ?> , <?php echo $i; ?> );" ><?php echo $i; ?></a>
	<?php
}

if ( $pag+1 < $num_pags ){
?>
<a class="pag-button current-page" href="javascript:showList_final( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $title; ?> , <?php echo ($pag+1); ?> );" ><?php echo $lang['siguiente']; ?></a>
<?php
}
?>	
</div>
<div id="un_pagination">
<?php
$first_pc = (($pag-1)*18)+1;
//echo $pag.' | '.$num;
$last_pc = $first_pc-1+strval($num);

echo $lang['mostrando'].':'.' '.$first_pc.'-'.$last_pc.' '.' of '.' '.strval($num_rows);
?>
</div>

</div>
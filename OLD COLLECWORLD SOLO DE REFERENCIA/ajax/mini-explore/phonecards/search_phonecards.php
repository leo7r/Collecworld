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
$cat = intval($_REQUEST['cat']);
$cat_id = $cat;

$query = $_REQUEST['query'];

switch ( $cat ){
	
	case 1:
		$cat = $lang['tarjetas_telefonicas'];
		break;
	case 2:
		$cat = $lang['monedas'];
		break;
	case 3:
		$cat = $lang['estampillas'];
		break;
	case 4:
		$cat = $lang['tapas_botellas'];
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
	
	$info_u = mysql_query('SELECT * FROM users WHERE id_users = '.$id_user);
	$info_u = mysql_fetch_array($info_u);
	
	$country = mysql_query('SELECT * FROM countries WHERE id_countries = '.$cou);
	$country = mysql_fetch_array($country);
	
	//$company = mysql_query('SELECT * FROM phonecards_companies WHERE id_phonecards_companies = '.$com);
	//$company = mysql_fetch_array($company);
	
	?>
	
	<div id="collection-nav">
		<a href="javascript:showCategories()"><?php echo '@'.$info_u['user']; ?></a>
		&nbsp;&raquo;&nbsp;
		<a href="javascript:showList(<?php echo $cat_id; ?>,1,1)"><?php echo $cat; ?></a>
		&nbsp;&raquo;&nbsp;
		<?php
			if ( isset($list_name) ){
			?>
			<a href="javascript:showList( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , 1 )"><?php echo $list_name; ?></a>
			&nbsp;&raquo;&nbsp;
			<?php
			}
		?>
		<a href="javascript:showList_step2( <?php echo $cat_id; ?> , <?php echo $list_user; ?> , <?php echo $country['id_countries']; ?> )"><?php echo $country['name']; ?></a>
		&nbsp;&raquo;&nbsp;
		<?php echo $lang['buscar']; ?> <?php echo $query; ?>
	</div>
	
	<table id="mini-explore-table">
	<?php

	
	$sql = 'SELECT p.name as Name , s.name as Serie , p.id_phonecards_systems as System , c.name as Company , co.name as Country , p.issued_on , p.face_value , p.print_run , p.id_phonecards , p.image as image , p.image_reverse , p.code FROM phonecards p , phonecards_companies c , countries co , phonecards_series s , phonecards_systems sy WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_phonecards_companies = c.id_phonecards_companies AND p.id_countries = co.id_countries AND p.id_phonecards IN ( SELECT pu.id_phonecards FROM phonecards_users pu , phonecards p WHERE p.name like "%'.$query.'%" AND pu.id_lists = '.$list_user.' AND pu.id_users = '.$id_user.' AND pu.id_phonecards = p.id_phonecards AND p.id_countries = '.$cou.' ) GROUP BY p.id_phonecards ORDER BY issued_on , face_value , print_run LIMIT '.strval((($pag-1)*20)).' , 20;';
	
	$cursor = mysql_query($sql);
	$num = mysql_num_rows($cursor);
	
	if ( $num == 0 ){
		echo $lang['no_hay_resultados_para'].' '.'"'.$query.'"'.' '.$lang['en'].' '.$cat;
		return;
	}
	
	for ( $i=0 ; $i<$num ; $i++ ){
		$datos = mysql_fetch_array($cursor);
		$reverse = strcmp($datos['image_reverse'],"1") == 0;
		
		if ( $i % 4 == 0 )
			echo '<tr>';
		
		?>
			<td>
				<div class="mini-explore-item">
					<input id="checkbox<?php echo $i; ?>" type="checkbox" style="position:absolute" 
						onClick="checkItem(<?php echo $datos['id_phonecards']; ?> , '<?php echo $datos['Name']; ?>' , '<?php echo $datos['Company']; ?>',this);" />
					
					<script>
						refreshCheckbox( <?php echo $datos['id_phonecards']; ?> , <?php echo $i; ?> );
					</script>
					
					<table height="110">
						<tr>
							<td>
								<img src="<?php echo $path.'upload/img/'.$datos['image']; ?>"
								 width="<?php echo $reverse ? '64' : '100'; ?>" height="<?php echo $reverse ? '100' : '64'; ?>" />
							</td>
							<td valign="top">
								<table>
									<tr>
										<td class="mini-explore-modal" onClick="modalPhonecard(<?php echo $datos['id_phonecards']; ?>)">
											<b><?php echo $datos['Name']; ?></b>
										</td>
									</tr>
									<tr>
										<td><?php echo $datos['Company']; ?></td>
									</tr>
									<tr>
										<td><?php echo $datos['Serie']; ?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
					<div>
						<span style="float:left;">Buena</span>
						<span style="float:right;">$100</span>
					</div>			
				</div>
			</td>
		<?php
		
		if ( $i % 4 == 3 or $i == ($num-1)  )
			echo '</tr>';
	}

	
}

?>
	</table>

<div id="pagination">

<?php
$pag_sql = 'SELECT p.name as Name , s.name as Serie , p.id_phonecards_systems as System , c.name as Company , co.name as Country , p.issued_on , p.face_value , p.print_run , p.id_phonecards , p.image as image , p.image_reverse FROM phonecards p , phonecards_companies c , countries co , phonecards_series s , phonecards_systems sy WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_phonecards_companies = c.id_phonecards_companies AND p.id_countries = co.id_countries AND p.id_phonecards IN ( SELECT pu.id_phonecards FROM phonecards_users pu , phonecards p WHERE p.name like "%'.$query.'%" AND pu.id_lists = '.$list_user.' AND pu.id_users = '.$id_user.' AND pu.id_phonecards = p.id_phonecards AND p.id_countries = '.$cou.' ) GROUP BY p.id_phonecards ORDER BY issued_on , face_value , print_run;';


$pag_cur = mysql_query($pag_sql);
$num_rows = mysql_num_rows($pag_cur);
$num_pags = $num_rows / 20;

if ( $num_pags > intval($num_pags) ){
	$num_pags = $num_pags+1;
}

// antes de la pagina seleccionada

if ( $pag > 1 ){
?>

<a class="pag-button current-page" href="javascript:showList_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo ($pag-1); ?> );" ><?php echo $lang['anterior']; ?></a>
<?php
}

for ($i=($pag-4) ; $i < $pag ; $i++ ){
	
	if ( $i > 0 ){
		?>
			<a class="pag-button" href="javascript:showList_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $i; ?> );" ><?php echo $i; ?></a>
		<?php
	}
}

?>
<a class="pag-button current-page" href="javascript:showList_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $pag; ?> );" ><?php echo $pag; ?></a>
<?php

// despues de la pagina seleccionada
for ($i=($pag+1) ; $i < $pag+5 ; $i++ ){
	
	if ( $i >= $num_pags )
		break;
	
	?>
		<a class="pag-button" href="javascript:showList_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $i; ?> );" ><?php echo $i; ?></a>
	<?php
}

if ( $pag+1 < $num_pags ){
?>
<a class="pag-button current-page" href="javascript:showList_final( 0 , <?php echo $list_user; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo ($pag+1); ?> );" ><?php echo $lang['siguiente']; ?></a>
<?php
}
?>	
</div>
<div id="un_pagination">
<?php
$first_pc = (($pag-1)*20)+1;
//echo $pag.' | '.$num;
$last_pc = $first_pc-1+strval($num);

echo $lang['mostrando'].': '.$first_pc.'-'.$last_pc.' '.' of '.' '.strval($num_rows);
?>
</div>

</div>
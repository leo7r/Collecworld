<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 

$cat = intval($_REQUEST['cat']);
$cat_id = $cat;

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

$list = $_REQUEST['list'];
$user = $_REQUEST['id'];

switch( $list ){
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
	default:
		$info_list = mysql_query('SELECT * FROM lists WHERE id_lists = '.$list);
		$datos = mysql_fetch_array($info_list);
		$list_name = $datos['name'];
		break;
}

$info_u = mysql_query('SELECT * FROM users WHERE id_users = '.$user);
$info_u = mysql_fetch_array($info_u);

?>

<div id="collection-nav">
	<a href="javascript:showCategories()"><?php echo '@'.$info_u['user']; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showList(<?php echo $cat_id; ?>,<?php echo $list; ?>,1)"><?php echo $cat; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showList( <?php echo $cat_id; ?> , <?php echo $list; ?> , 1 )"><?php echo $list_name; ?></a>
	&nbsp;&raquo;&nbsp;
</div>

<table>
<?php

$sql = 'SELECT c.name , c.id_countries FROM countries c , phonecards p , phonecards_users pu , users u WHERE p.id_phonecards = pu.id_phonecards AND c.id_countries = p.id_countries AND u.id_users = "'.$user.'" AND pu.id_users = u.id_users AND pu.id_lists = '.$list.' GROUP BY c.name';
$cursor = mysql_query($sql);
$num = mysql_num_rows($cursor);

if ( $num == 0 ){
	echo $lang['no_hay_articulos_en_el_listado'].'"'.$list_name.'"'.','.$lang['prueba_otro_listado'];
	return;
}

for ($i=0 ; $i < $num ; $i++){

	if ( $i % 5 == 0 ){
		echo '<tr>';
	}

	$datos = mysql_fetch_array($cursor);
	
	$sql2 = 'SELECT c.name , c.id_countries FROM countries c , phonecards p , phonecards_users pu , users u WHERE p.id_phonecards = pu.id_phonecards AND c.id_countries = p.id_countries AND u.id_users = "'.$user.'" AND c.id_countries = '.$datos['id_countries'].' AND pu.id_users = u.id_users AND pu.id_lists = '.$list;
	$cursor2 = mysql_query($sql2);
	$count = mysql_num_rows($cursor2);
	
	?>
		<td>
			<div class="collection-step" onClick="showList_step2( <?php echo $cat_id; ?> , <?php echo $list; ?> , <?php echo $datos['id_countries']; ?> )">
				<img src="<?php echo $path; ?>img/flag-1.png" />
				<br>
				<?php echo $datos['name']; ?>
				<br>
				(<?php echo $count; ?>)
			</div>
		</td>
	<?php
	
	if ( $i % 5 == 4 ){
		echo '</tr>';
	}
	
}

?>
</table>
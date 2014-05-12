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
$cat2 = $lang['monedas'];

$list = $_REQUEST['list'];
$user = $_REQUEST['u'];
$cou = $_REQUEST['cou'];

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

$country = mysql_query('SELECT * FROM countries WHERE id_countries = '.$cou);
$country = mysql_fetch_array($country);

?>

<div id="collection-nav">
	<a href="javascript:showCategories()"><?php echo '@'.$info_u['user']; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showList(<?php echo $cat_id; ?>,1,1)"><?php echo $cat2; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showList( <?php echo $cat_id; ?> , <?php echo $list; ?> , 1 )"><?php echo $list_name; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showList_step2( <?php echo $cat_id; ?> , <?php echo $list; ?> , <?php echo $country['id_countries']; ?> )"><?php echo $country['name']; ?></a>
	&nbsp;&raquo;&nbsp;
</div>

<?php

$sql = 'SELECT title.name , title.id_coins_title as id_title FROM coins_title title, coins_users cu , coins c WHERE c.id_coins = cu.id_coins AND cu.id_lists = '.$list.' AND c.id_coins_title = title.id_coins_title AND cu.id_users = '.$user.' AND title.id_countries = '.$cou.' GROUP BY title.name';
$cursor = mysql_query($sql);
$num = mysql_num_rows($cursor);
?>

<table>
<?php

if ( $num == 0 ){
	echo $lang['no_hay_articulos_en_el_listado'].'"'.$list_name.'"'.','.$lang['prueba_otro_listado'];
	return;
}

for ($i=0 ; $i < $num ; $i++){
	$datos = mysql_fetch_array($cursor);
	
	$sql2 = 'SELECT title.name , title.id_coins_title as id_title FROM coins_title title , coins_users cu , coins c WHERE c.id_coins = cu.id_coins AND cu.id_lists = '.$list.' AND c.id_coins_title = title.id_coins_title AND id_users = '.$user.' AND title.id_countries = '.$cou.' AND c.id_coins_title = '.$datos['id_title'];
	$cursor2 = mysql_query($sql2);
	$count = mysql_num_rows($cursor2);
	
	if ( $i % 5 == 0 ){
		echo '<tr>';
	}
	
	?>
		<td>
			<div class="collection-step" onClick="showList_final( <?php echo $cat_id; ?> , <?php echo $list; ?> , <?php echo $cou; ?> , <?php echo $datos['id_title']; ?> )">
				<img src="<?php echo $path; ?>img/collection.png" />
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
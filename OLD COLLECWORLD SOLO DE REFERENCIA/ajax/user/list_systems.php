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
	
	case 0:
		$cat = 'phonecards';
		$cat2 = $lang['tarjetas_telefonicas'];
		break;
	case 1:
		$cat = 'coins';
		$cat2 = $lang['monedas'];
		break;
	case 2:
		$cat = 'stamps';
		$cat2 = $lang['estampillas'];
		break;
	case 3:
		$cat = 'caps';
		$cat2 = $lang['tapas_botella'];
		break;
	
}


$list = $_REQUEST['list'];
$user = $_REQUEST['u'];
$cou = $_REQUEST['cou'];
$com = $_REQUEST['com'];

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
		break;
	case 5:
		$list_name = $lang['venta'];
		break;	
}

$info_u = mysql_query('SELECT * FROM users WHERE id_users = '.$user);
$info_u = mysql_fetch_array($info_u);

$country = mysql_query('SELECT * FROM countries WHERE id_countries = '.$cou);
$country = mysql_fetch_array($country);

$company = mysql_query('SELECT * FROM '.$cat.'_companies WHERE id_'.$cat.'_companies = '.$com);
$company = mysql_fetch_array($company);


?>

<div id="collection-nav">
	<a href="./?u=<?php echo $info_u['user']; ?>"><?php echo '@'.$info_u['user']; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showUserCollection(<?php echo $cat_id; ?>,document.getElementById('cat<?php echo $cat_id; ?>'))"><?php echo $cat2; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showUserCol( <?php echo $cat_id; ?> , <?php echo $list; ?> , 1 )"><?php echo $list_name; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showUserCol_step2( <?php echo $cat_id; ?> , <?php echo $list; ?> , <?php echo $country['id_countries']; ?> )"><?php echo $country['name']; ?></a>
	&nbsp;&raquo;&nbsp;
    <a href="javascript:showUserCol_step3( <?php echo $cat_id; ?> , <?php echo $list; ?> , <?php echo $cou; ?> , <?php echo $com; ?> )"><?php echo $company['name']; ?></a>
</div>
<?php

$sql = 'SELECT com.name , p.id_'.$cat.'_systems FROM '.$cat.'_companies com , '.$cat.'_users pu , '.$cat.' p WHERE p.id_'.$cat.' = pu.id_'.$cat.' AND pu.id_lists = '.$list.' AND p.id_'.$cat.'_companies = com.id_'.$cat.'_companies AND id_users = '.$user.' AND com.id_countries = '.$cou.'  AND com.id_'.$cat.'_companies = '.$com.' GROUP BY p.id_'.$cat.'_systems';
$cursor = mysql_query($sql);
$num = mysql_num_rows($cursor);

?>
<table>
<?php

for ($i=0 ; $i < $num ; $i++){
	$datos = mysql_fetch_array($cursor);
	
	$sql2 = 'SELECT p.id_'.$cat.'_systems FROM '.$cat.'_companies com , '.$cat.'_users pu , '.$cat.' p WHERE p.id_'.$cat.' = pu.id_'.$cat.' AND pu.id_lists = '.$list.' AND p.id_'.$cat.'_companies = com.id_'.$cat.'_companies AND id_users = '.$user.' AND com.id_countries = '.$cou.'  AND com.id_'.$cat.'_companies = '.$com.' AND p.id_'.$cat.'_systems = '.$datos['id_phonecards_systems'];
	
	$cursor2 = mysql_query($sql2);
	$count = mysql_num_rows($cursor2);
	
	$name = '';
	
	switch ( $datos['id_phonecards_systems'] ){
		case 1:
			$name = $lang['chip'];
			break;
		case 2:
			$name = $lang['banda_magnetica'];
			break;
		case 3:
			$name = $lang['sistema_optico'];
			break;
		case 4:
			$name = $lang['memoria_remota'];
			break;
		case 4:
			$name = $lang['sistema_inducido'];
			break;
	}
	
	if ( $i % 5 == 0 ){
		echo '<tr>';
	}
	
	?>
		<td>
			<div class="collection-step" onClick="showUserCol_step4( <?php echo $cat_id; ?> , <?php echo $list; ?> , <?php echo $cou; ?> , <?php echo $com; ?>, <?php echo $datos['id_phonecards_systems']; ?> )">
				<img src="<?php echo $path; ?>img/collection.png" />
				<br>
				<?php echo $name; ?>
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
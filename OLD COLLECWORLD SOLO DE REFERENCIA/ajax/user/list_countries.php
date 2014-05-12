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
		$cat = $lang['tarjetas_telefonicas'];
		$cat2="phonecard";
		break;
	case 1:
		$cat = $lang['monedas'];
		$cat2="coin";
		break;
	case 2:
		$cat = $lang['billetes'];
		$cat2="banknote";
		break;
	case 3:
		$cat = $lang['estampillas'];
		$cat2="stamp";
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
}

$info_u = mysql_query('SELECT * FROM users WHERE id_users = '.$user);
$info_u = mysql_fetch_array($info_u);

?>

<div id="collection-nav">
	<a href="<?php echo $path.'index.php/'.$info_u['user']; ?>"><?php echo '@'.$info_u['user']; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showUserCollection(<?php echo $cat_id; ?>,document.getElementById('cat<?php echo $cat_id; ?>'))"><?php echo $cat; ?></a>
	&nbsp;&raquo;&nbsp;
	<a href="javascript:showUserCol( <?php echo $cat_id; ?> , <?php echo $list; ?> , 1 )"><?php echo $list_name; ?></a>
	&nbsp;&raquo;&nbsp;
</div>

<table>
<?php

$sql = 'SELECT c.name , c.id_countries FROM countries c , '.$cat2.'s p , '.$cat2.'s_users pu , users u WHERE p.id_'.$cat2.'s = pu.id_'.$cat2.'s AND c.id_countries = p.id_countries AND u.id_users = "'.$user.'" AND pu.id_users = u.id_users AND pu.id_lists = '.$list.' GROUP BY c.name';
$sql2 = 'SELECT c.name , c.id_countries FROM countries c , '.$cat2.'s p , '.$cat2.'s_users pu , users u WHERE p.id_'.$cat2.'s = pu.id_'.$cat2.'s AND c.id_countries = p.id_countries AND u.id_users = "'.$user.'" AND pu.id_users = u.id_users AND pu.id_lists = '.$list;

$cursor = mysql_query($sql);
$num = mysql_num_rows($cursor);

$cursor2 = mysql_query($sql2);
$count = mysql_num_rows($cursor2);
for ($i=0 ; $i < $num ; $i++){

	if ( $i % 5 == 0 ){
		echo '<tr>';
	}

	$datos = mysql_fetch_array($cursor);
	?>
		<td>
			<div class="collection-step" onClick="showUserCol_step2( <?php echo $cat_id; ?> , <?php echo $list; ?> , <?php echo $datos['id_countries']; ?> )">
				<img src="<?php echo $path; ?>img/flag-1.png" />
				<br>
				<?php echo $datos['name']; ?>
                <br />
				<?php
				$cursor3= mysql_query($sql2);
				echo "(".$count2 = mysql_num_rows($cursor3).")";
				?>
			</div>
		</td>
	<?php
	
	if ( $i % 5 == 4 ){
		echo '</tr>';
	}
	
}

?>
</table>
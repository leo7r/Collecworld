<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$user = $_REQUEST['id'];
$list = $_REQUEST['list'];

$info_u = mysql_query('SELECT * FROM users WHERE id_users = '.$user);
$info_u = mysql_fetch_array($info_u);

?>

<div id="collection-nav">
	<a href="javascript:showCategories()"><?php echo '@'.$info_u['user']; ?></a>
	&nbsp;&raquo;&nbsp;
</div>

<table>
<?php

$sql = 'SELECT * FROM categories';
$cursor = mysql_query($sql);
$num = mysql_num_rows($cursor);

for ($i=0 ; $i < $num ; $i++){

	if ( $i % 5 == 0 ){
		echo '<tr>';
	}
	
	switch( $i ){
	
	case 0:
		$img_name = 'phonecard_icon';
		break;
	case 1:
		$img_name = 'coin_icon';
		break;
	case 2:
		$img_name = 'stamp_icon';
		break;
	}

	$datos = mysql_fetch_array($cursor);
	?>
		<td>
			<div class="collection-step" onClick="showList(<?php echo $i+1; ?>,<?php echo $list; ?>,1)">
				<img src="<?php echo $path; ?>img/<?php echo $img_name; ?>.png" />
				<br>
				<?php echo ucfirst($datos['name']); ?>
			</div>
		</td>
	<?php
	
	if ( $i % 5 == 4 ){
		echo '</tr>';
	}
	
}

?>
</table>
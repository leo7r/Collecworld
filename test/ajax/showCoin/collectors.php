<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 


session_start();

$id = $_REQUEST['id'];
/*
if ( isset($_SESSION['id_users']) ){
$fsql= "SELECT f.*, u.*, pu.* FROM friends f, users u ,phonecards_users pu WHERE   ";
}
*/

$sql = 'SELECT cu.* , u.name , u.user , u.image FROM coins_users cu , users u WHERE cu.id_users = u.id_users AND cu.id_coins = '.$id.' AND u.profile_privacy=0 AND id_lists = ';

if ( isset($_SESSION['id_users']) ){
	$sql_tail = ' AND cu.id_users <> '.$_SESSION['id_users'];
}

$collection = mysql_query($sql.'1'.$sql_tail);
$wish = mysql_query($sql.'2'.$sql_tail);
$swap = mysql_query($sql.'3'.$sql_tail);
$buy = mysql_query($sql.'4'.$sql_tail);
$sell = mysql_query($sql.'5'.$sql_tail);

?>
<div>
	<ul id="show-tabs">
		<li class="box1" onClick="showCoinTab(0,<?php echo $id; ?>);"><?php echo $lang['informacion']; ?></li>
		<li class="box1 selected" onClick="showCoinTab(1,<?php echo $id; ?>);"><?php echo $lang['coleccionistas']; ?></li>
		<li class="box1" onClick="showCoinTab(2,<?php echo $id; ?>);"><?php echo $lang['relacionadas']; ?></li>
		<li class="box1" onClick="showCoinTab(3,<?php echo $id; ?>);"><?php echo $lang['comentarios']; ?></li>
	</ul>
</div>
<div id="collectors-list">
	<?php 
	
	if ( mysql_num_rows($collection) == 0 and mysql_num_rows($wish) == 0 and
	 mysql_num_rows($swap) == 0 and mysql_num_rows($buy) == 0 and mysql_num_rows($sell) == 0 ){
		?>
			<span class="title3"><?php echo $lang['no_coleccionistas_monedas']; ?>.</span>
		<?php
	 }
	 else{
		if ( mysql_num_rows($collection) ){
	?>
	<div id="show-collection">
		<div class="title3"><?php echo $lang['coleccion']; ?> (<?php echo mysql_num_rows($collection); ?>)</div>
		<table class="collectors-table" cellpadding="5px">
		<?php
			for ( $i = 0 ; $i < mysql_num_rows($collection) ; $i++ ){
				
				$datos = mysql_fetch_array($collection);
				
				if ( $i % 5 == 0 ){
					echo '<tr>';
				}
				?>
				<td>
					<a href="<?php echo $path.'index.php/'.$datos['user']; ?>"><img title="<?php echo $datos['name']; ?>" src="<?php echo $path.'users/img/'.$datos['image']; ?>" /></a>
				</td>
				<?php
				
				if ( $i % 5 == 4 ){
					echo '</tr>';
				}
			}
		?>
		</table>
	</div>
	<?php
		}
	?>
	<?php
		if ( mysql_num_rows($wish) ){
	?>
	<div id="show-wish">
		<div class="title3"><?php echo $lang['deseo']; ?> (<?php echo mysql_num_rows($wish); ?>)</div>
		<table class="collectors-table" cellpadding="5px">
		<?php
			for ( $i = 0 ; $i < mysql_num_rows($wish) ; $i++ ){
				
				$datos = mysql_fetch_array($wish);
				
				if ( $i % 5 == 0 ){
					echo '<tr>';
				}
				?>
				<td>
					<a href="<?php echo $path.'index.php/'.$datos['user']; ?>"><img title="<?php echo $datos['name']; ?>" src="<?php echo $path.'users/img/'.$datos['image']; ?>" /></a>
				</td>
				<?php
				
				if ( $i % 5 == 4 ){
					echo '</tr>';
				}
			}
		?>
		</table>
	</div>
	<?php
		}
	?>
	<?php
		if ( mysql_num_rows($swap) ){
	?>
	<div id="show-swap">
		<div class="title3"><?php echo $lang['intercambio']; ?> (<?php echo mysql_num_rows($swap); ?>)</div>
		<table class="collectors-table" cellpadding="5px">
		<?php
			for ( $i = 0 ; $i < mysql_num_rows($swap) ; $i++ ){
				
				$datos = mysql_fetch_array($swap);
				
				if ( $i % 5 == 0 ){
					echo '<tr>';
				}
				?>
				<td>
					<a href="<?php echo $path.'index.php/'.$datos['user']; ?>"><img title="<?php echo $datos['name']; ?>" src="<?php echo $path.'users/img/'.$datos['image']; ?>" /></a>
				</td>
				<?php
				
				if ( $i % 5 == 4 ){
					echo '</tr>';
				}
			}
		?>
		</table>
	</div>
	<?php
		}
	?>
	
	<?php
		if ( mysql_num_rows($sell) ){
	?>
	<div id="show-sell">
		<div class="title3"><?php echo $lang['venta']; ?> (<?php echo mysql_num_rows($sell); ?>)</div>
		<table class="collectors-table" cellpadding="5px">
		<?php
			for ( $i = 0 ; $i < mysql_num_rows($sell) ; $i++ ){
				
				$datos = mysql_fetch_array($sell);
				
				if ( $i % 5 == 0 ){
					echo '<tr>';
				}
				?>
				<td>
					<a href="<?php echo $path.'index.php/'.$datos['user']; ?>"><img title="<?php echo $datos['name']; ?>" src="<?php echo $path.'users/img/'.$datos['image']; ?>" /></a>
				</td>
				<?php
				
				if ( $i % 5 == 4 ){
					echo '</tr>';
				}
			}
		?>
		</table>
	</div>
	<?php
		}
	}
	?>
</div>
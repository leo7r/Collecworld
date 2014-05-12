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



$id_users = $_REQUEST['id_users'];

$list = $_REQUEST['list'];

$id_countries = $_REQUEST['id_countries'];



$titles_sql = 'SELECT ct.name , ct.id_coins_title , count(ct.id_coins_title) as count FROM coins_users cu , coins c , coins_title ct WHERE cu.id_users = '.$id_users.' AND cu.id_lists = '.$list;

$titles_sql = $titles_sql.' AND c.id_coins = cu.id_coins AND ct.id_coins_title= c.id_coins_title AND c.id_countries = '.$id_countries.' GROUP BY ct.id_coins_title';




$titles_cursor = mysql_query($titles_sql);
 
?>
<div class="title42">2. <?php echo $lang['seleccionar_titulo']; ?></div>

<table id="collection_titles" cellpadding="10">

	<?php

	

	for ( $i = 0 ; $i < mysql_num_rows($titles_cursor) ; $i++ ){

		$title = mysql_fetch_array($titles_cursor);

		

		if ( $i % 4 == 0 ){

			echo '<tr>';	

		}

		

		?>

        <td>

            <div class="collection-step2" 

                onClick="coins_collections_select( <?php echo $id_users; ?> ,

                 <?php echo $list; ?> , <?php echo $id_countries; ?> , <?php echo $title['id_coins_title']; ?> )">

                 

                <img src="<?php echo $path; ?>img/flag-1.png" />

                <br>

                <?php echo $title['name']; ?>

                <br>

                (<?php echo $title['count']; ?>)

            </div>

        </td>

        <?php	

		

		if ( $i % 4 == 3 ){

			echo '</tr>';	

		}

	}

	?>

</table>
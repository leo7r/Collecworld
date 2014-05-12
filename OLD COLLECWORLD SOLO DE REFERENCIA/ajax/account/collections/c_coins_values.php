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

$id_title = $_REQUEST['id_title'];



$values_sql = 'SELECT cv.id_coins_value, cv.name , COUNT(cv.id_coins_value) as count FROM coins_value cv, coins_users cu , coins c WHERE cu.id_users = '.$id_users.' AND cu.id_lists = '.$list;

$values_sql = $values_sql.' AND cv.id_coins_title = '.$id_title.' AND c.id_coins = cu.id_coins AND cv.id_coins_value= c.id_coins_value AND c.id_countries = '.$id_countries.' GROUP BY cv.id_coins_value';

$values_cursor = mysql_query($values_sql);

?>

<div class="title42">3. <?php echo $lang['seleccionar_valor']; ?></div>

<table id="collection_catalogs" cellpadding="10">

    <?php

	

	for ( $i = 0 ; $i < mysql_num_rows($values_cursor) ; $i++ ){

		

		$value = mysql_fetch_array($values_cursor);

		

		if ( $i % 4 == 0 ){

			echo '<tr>';	

		}

		

		?>

        <td>

            <div class="collection-step2" 

                onClick="coins_collections_select( <?php echo $id_users; ?> ,

                 <?php echo $list; ?> , <?php echo $id_countries; ?> , <?php echo $id_title; ?> , <?php echo $value['id_coins_value']; ?> )">

                <img src="<?php echo $path; ?>img/flag-1.png" />

                <br>

                <?php echo $value['name']; ?>

                <br>

                (<?php echo $value['count']; ?>)

            </div>

        </td>

        <?php

		

		if ( $i % 4 == 3 ){

			echo '</tr>';	

		}

		

	}

	

	?>

</table>
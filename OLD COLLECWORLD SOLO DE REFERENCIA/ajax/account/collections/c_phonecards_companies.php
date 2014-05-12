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



$companies_sql = 'SELECT pc.name , pc.id_phonecards_companies , count(pc.id_phonecards_companies) as count FROM phonecards_users pu , phonecards p , phonecards_companies pc WHERE pu.id_users = '.$id_users.' AND pu.id_lists = '.$list;

$companies_sql = $companies_sql.' AND p.id_phonecards = pu.id_phonecards AND pc.id_phonecards_companies = p.id_phonecards_companies AND p.id_countries = '.$id_countries.' GROUP BY pc.id_phonecards_companies';



$companies_cursor = mysql_query($companies_sql);
 
?>
<div class="title42">2. <?php echo $lang['seleccionar_compania']; ?></div>

<table id="collection_companies" cellpadding="10">

	<?php

	

	for ( $i = 0 ; $i < mysql_num_rows($companies_cursor) ; $i++ ){

		$company = mysql_fetch_array($companies_cursor);

		

		if ( $i % 4 == 0 ){

			echo '<tr>';	

		}

		

		?>

        <td>

            <div class="collection-step2" 

                onClick="phonecards_collections_select( <?php echo $id_users; ?> ,

                 <?php echo $list; ?> , <?php echo $id_countries; ?> , <?php echo $company['id_phonecards_companies']; ?> )">

                 

                <img src="<?php echo $path; ?>img/flag-1.png" />

                <br>

                <?php echo $company['name']; ?>

                <br>

                (<?php echo $company['count']; ?>)

            </div>

        </td>

        <?php	

		

		if ( $i % 4 == 3 ){

			echo '</tr>';	

		}

	}

	?>

</table>
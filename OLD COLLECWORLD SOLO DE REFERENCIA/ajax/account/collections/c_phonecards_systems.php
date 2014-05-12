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

$id_companies = $_REQUEST['id_companies'];



$system_sql = 'SELECT p.id_phonecards_systems , COUNT(*) as count FROM phonecards_users pu , phonecards p , countries c WHERE pu.id_users = '.$id_users.' AND pu.id_lists = '.$list;

$system_sql = $system_sql.' AND p.id_phonecards = pu.id_phonecards AND p.id_countries = c.id_countries AND p.id_countries = '.$id_countries;

$system_sql = $system_sql.' AND p.id_phonecards_companies = '.$id_companies.' GROUP BY p.id_phonecards_systems';

$systems = mysql_query($system_sql);

?>

<div class="title42">3. <?php echo $lang['seleccionar_sistema']; ?></div>

<table id="collection_catalogs" cellpadding="10">

    <?php

	

	for ( $i = 0 ; $i < mysql_num_rows($systems) ; $i++ ){

		

		$datos = mysql_fetch_array($systems);

		

		if ( $i % 4 == 0 ){

			echo '<tr>';	

		}

		

		?>

        <td>

            <div class="collection-step2" 

                onClick="phonecards_collections_select( <?php echo $id_users; ?> ,

                 <?php echo $list; ?> , <?php echo $id_countries; ?> , <?php echo $id_companies; ?> , <?php echo $datos['id_phonecards_systems']; ?> )">

                 

                <img src="<?php echo $path; ?>img/flag-1.png" />

                <br>

                <?php

                    

                switch ( $datos['id_phonecards_systems'] ){

                

                case 1:

                    echo $lang['chip'];

                    break;

                case 2:

                    echo $lang['banda_magnetica'];

                    break;

                case 3:

                    echo $lang['sistema_optico'];

                    break;

                case 4:

                    echo $lang['memoria_remota'];

                    break;

                case 4:

                    echo $lang['sistema_inducido'];

                    break;

                    

                }

                    

                ?>

                <br>

                (<?php echo $datos['count']; ?>)

            </div>

        </td>

        <?php

		

		if ( mysql_num_rows($systems) == 1 || $i % 4 == 3 ){

			echo '</tr>';	

		}

		

	}

	

	?>

</table>
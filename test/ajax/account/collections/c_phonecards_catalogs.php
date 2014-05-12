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

$system = $_REQUEST['system'];



$catalog_sql = 'SELECT c.name , c.id_countries FROM phonecards_users pu , phonecards p , countries c WHERE pu.id_users = '.$id_users.' AND pu.id_lists = '.$list;

$catalog_sql = $catalog_sql.' AND p.id_phonecards = pu.id_phonecards AND p.id_countries = c.id_countries AND p.id_countries = '.$id_countries;

$catalog_sql = $catalog_sql.' AND p.id_phonecards_companies = '.$id_companies.' AND p.id_phonecards_systems = '.$system;



$dated_c = $catalog_sql.' AND p.order_date <> "Unknown" AND p.not_emmited = 0 AND p.especial = 0';

$undated_c = $catalog_sql.' AND p.order_date = "Unknown" AND p.not_emmited = 0 AND p.especial = 0';

$notE_c = $catalog_sql.' AND p.not_emmited = 1';
 


$dated_cursor = mysql_query($dated_c);

$undated_cursor = mysql_query($undated_c);

$notE_cursor = mysql_query($notE_c);
 
 
?> 
<div class="title42">4. <?php echo $lang['seleccionar_catalogo']; ?></div>

<table id="collection_catalogs" cellpadding="10">

    <tr>

	<?php

	

	if ( mysql_num_rows($dated_cursor) > 0 ){

		?>

        <td>
			<a href="<?php echo $path.'index.php/'.$_SESSION['user'].'/collection/'; ?><?php echo $list; ?>/<?php echo $id_countries; ?>/<?php echo $id_companies; ?>/<?php echo $system; ?>/1/0/0">
                <div class="collection-step2">                  
    
                    <img src="<?php echo $path; ?>img/flag-1.png" />
    
                    <br>
    
                    <?php echo $lang['tarjetas_fecha']; ?>
    
                    <br>
    
                    (<?php echo mysql_num_rows($dated_cursor); ?>)
    
                </div>
			</a>
        </td>

        <?php

	}

	

	if ( mysql_num_rows($undated_cursor) > 0 ){

		?>

        <td>
			<a href="<?php echo $path.'index.php/'.$_SESSION['user'].'/collection/'; ?><?php echo $list; ?>/<?php echo $id_countries; ?>/<?php echo $id_companies; ?>/<?php echo $system; ?>/2/0/0">
                <div class="collection-step2">           
                
                    <img src="<?php echo $path; ?>img/flag-1.png" />
                    <br>
                    <?php echo $lang['tarjetas_sin_fecha']; ?>
                    <br>
                    (<?php echo mysql_num_rows($undated_cursor); ?>)
    
                </div>
            </a>
        </td>

        <?php

	}

	

	if ( mysql_num_rows($notE_cursor) > 0 ){

		?>

        <td>
			<a href="<?php echo $path.'index.php/'.$_SESSION['user'].'/collection/'; ?><?php echo $list; ?>/<?php echo $id_countries; ?>/<?php echo $id_companies; ?>/<?php echo $system; ?>/3/0/0">
                <div class="collection-step2">
                    <img src="<?php echo $path; ?>img/flag-1.png" />
                    <br>
                    <?php echo $lang['tarjetas_uso_interno']; ?>
                    <br>
                    (<?php echo mysql_num_rows($notE_cursor); ?>)
                </div>
			</a>
        </td>

        <?php

	}

	 
	

	?>

	</tr>

</table>
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
$sys = $_REQUEST['sys'];

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

$sys_name = '';
	
switch ( $sys ){
	case 1:
		$sys_name = $lang['chip'];
		break;
	case 2:
		$sys_name = $lang['banda_magnetica'];
		break;
	case 3:
		$sys_name = $lang['sistema_optico'];
		break;
	case 4:
		$sys_name = $lang['memoria_remota'];
		break;
	case 4:
		$sys_name = $lang['sistema_inducido'];
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
    &nbsp;&raquo;&nbsp;
    <a href="javascript:showUserCol_step4( <?php echo $cat_id; ?> , <?php echo $list; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $sys; ?> )"><?php echo $sys_name; ?></a>
</div>
<?php

$catalog_sql = 'SELECT c.name , c.id_countries FROM phonecards_users pu , phonecards p , countries c WHERE pu.id_users = '.$user.' AND pu.id_lists = '.$list;

$catalog_sql = $catalog_sql.' AND p.id_phonecards = pu.id_phonecards AND p.id_countries = c.id_countries AND p.id_countries = '.$cou;

$catalog_sql = $catalog_sql.' AND p.id_phonecards_companies = '.$com.' AND p.id_phonecards_systems = '.$sys;



$dated_c = $catalog_sql.' AND p.order_date <> "Unknown" AND p.not_emmited = 0 AND p.especial = 0';

$undated_c = $catalog_sql.' AND p.order_date = "Unknown" AND p.not_emmited = 0 AND p.especial = 0';

$notE_c = $catalog_sql.' AND p.not_emmited = 1';

$especial_c = $catalog_sql.' AND p.especial = 1';



$dated_cursor = mysql_query($dated_c);

$undated_cursor = mysql_query($undated_c);

$notE_cursor = mysql_query($notE_c);

$especial_cursor = mysql_query($especial_c);

?>
<table id="collection_catalogs" cellpadding="10">

    <tr>

	<?php

	

	if ( mysql_num_rows($dated_cursor) > 0 ){

		?>

        <td>

            <div class="collection-step2" 

                onClick="showUserCol_final( <?php echo $cat_id; ?> ,

                 <?php echo $list; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $sys; ?> , 1 )">

                 

                <img src="<?php echo $path; ?>img/flag-1.png" />

                <br>

                <?php echo $lang['tarjetas_fecha']; ?>

                <br>

                (<?php echo mysql_num_rows($dated_cursor); ?>)

            </div>

        </td>

        <?php

	}

	

	if ( mysql_num_rows($undated_cursor) > 0 ){

		?>

        <td>

            <div class="collection-step2" 

                onClick="showUserCol_final( <?php echo $cat_id; ?> ,

                 <?php echo $list; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $sys; ?> , 2 )">

                 

                <img src="<?php echo $path; ?>img/flag-1.png" />

                <br>

                <?php echo $lang['tarjetas_sin_fecha']; ?>

                <br>

                (<?php echo mysql_num_rows($undated_cursor); ?>)

            </div>

        </td>

        <?php

	}

	

	if ( mysql_num_rows($notE_cursor) > 0 ){

		?>

        <td>

            <div class="collection-step2" 

                onClick="showUserCol_final( <?php echo $cat_id; ?> ,

                 <?php echo $list; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $sys; ?> , 3 )">

                 

                <img src="<?php echo $path; ?>img/flag-1.png" />

                <br>

                <?php echo $lang['tarjetas_uso_interno']; ?>

                <br>

                (<?php echo mysql_num_rows($notE_cursor); ?>)

            </div>

        </td>

        <?php

	}

	

	if ( mysql_num_rows($especial_cursor) > 0 ){

		?>

        <td>

            <div class="collection-step2" 

                onClick="showUserCol_final( <?php echo $cat_id; ?> ,

                 <?php echo $list; ?> , <?php echo $cou; ?> , <?php echo $com; ?> , <?php echo $sys; ?> , 4 )">

                 

                <img src="<?php echo $path; ?>img/flag-1.png" />

                <br>

                <?php echo $lang['tarjetas_especiales']; ?>

                <br>

                (<?php echo mysql_num_rows($especial_cursor); ?>)

            </div>

        </td>

        <?php

	}

	

	?>

	</tr>

</table>
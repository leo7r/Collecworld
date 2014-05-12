<script>



function saveNote(){

	

	var list = parseInt($("#list").val());

	id_list = $("#id_list").val();

	note = $("#note").val();

	status = $("#status").val();

	price = $("#price").val();

	id_countries = $("#id_countries").val();

	id_companies = $("#id_companies").val();

	catalog = $("#catalog").val();

	id_users = $("#id_users").val();

	

	type = -1;

	

	switch( list ){

		case 1:

		case 2:

			type = 1;

			break;

		case 3:

			type = 3;

			break;

		case 5:

			type = 2;

			break;	

	}

	

	//alert('idList: '+id_list+' | type: '+type+' | note: '+note);

	

	div = document.createElement('div');

	$(div).load(path+'ajax/save_note.php',{id:id_list, type:type, note:note, status:status, price:price},function(){

		

		if ( div.innerHTML == "true" ){

			$("#modal-close").click();

			$("#collections_content").load(path+'ajax/account/c_phonecards_list.php'

				,{list:list,id_countries:id_countries,catalog:catalog,id_users:id_users,id_companies:id_companies});

		}

		else{

			alert(div.innerHTML);

		}

			

	});

	

}



</script>



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



$list = $_REQUEST['list'];

$id_item = $_REQUEST['id'];

$id_list = $_REQUEST['id_list'];

$id_countries = $_REQUEST['id_countries'];

$id_companies = $_REQUEST['id_companies'];

$catalog = $_REQUEST['catalog'];



$sql = 'SELECT p.id_phonecards as id, p.name as name , s.name as serie , c.name as country, pc.name as company FROM phonecards p , phonecards_series s, countries as c, phonecards_companies pc WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards = '.$id_item.' AND p.id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$_SESSION['id_users'].' AND id_lists = '.$list.' ) ORDER BY p.name';

//echo $sql;

$cursor = mysql_query($sql);

$datos = mysql_fetch_array($cursor);



$sql_list = 'SELECT * FROM phonecards_users WHERE id_users = '.$_SESSION['id_users'].' AND id_phonecards = '.$id_item;

$sql_list = $sql_list.' AND id_lists = '.$list;

$cursor_list = mysql_query($sql_list);

$datos_list = mysql_fetch_array($cursor_list);



$currencies = mysql_query('SELECT * FROM currencies');



$current_user = mysql_query('SELECT * FROM users where id_users = '.$_SESSION['id_users']);

$current_user = mysql_fetch_array($current_user);



?>



<div id="show-note">

    <div id="modal-close" class="modal-close" onClick="closeSignin();">

        <img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />

    </div>

    

    <div class="title4"><?php echo $lang['editar_notas']; ?></div>

    

    <table cellpadding="10">

    	<tr>

        	<td><?php echo $lang['event_categoria']; ?>:</td>

            <td><?php echo $lang['tarjeta_telefonica']; ?></td>

        </tr>

        <tr>

        	<td><?php echo $lang['nombre']; ?>:</td>

            <td><?php echo $datos['name']; ?></td>

        </tr>

        <tr>

        	<td><?php echo $lang['pais']; ?>:</td>

            <td><?php echo $datos['country']; ?></td>

        </tr>

        <tr>

        	<td><?php echo $lang['compania']; ?>:</td>

            <td><?php echo $datos['company']; ?></td>

        </tr>

        <tr>

        	<td><?php echo $lang['serie']; ?>:</td>

            <td><?php echo $datos['serie']; ?></td>

        </tr>

        <tr>

        	<td><?php echo $lang['nota']; ?>:</td>

            <td>

            	<textarea style="width:300px; height:100px;" id="note"><?php echo $datos_list['description']; ?></textarea>

            </td>

        </tr>

        <?php

	

		if ( $list == 5 ){

			?>

				<tr>

                	<td><?php echo $lang['precio']; ?></td>

                    <td>

                    	<input class="note-input" style="width:60px;" type="text" id="price" value="<?php echo $datos_list['price']; ?>" />

                        <select style="width:200px;" id="currency">

                        	<?php

								for ( $i = 0 ; $i < mysql_num_rows($currencies) ; $i++ ){

									$currency = mysql_fetch_array($currencies);

									?>

                                    <option <?php if ( $currency['id_currencies'] == $current_user['id_currencies'] ) echo 'selected="selected"';?> ><?php echo $currency['name']; ?></option>

                                    <?php	

								}

							?>

                        </select>

                    </td>

                </tr>

			<?php	

		}

		

		if ( $list == 5 || $list == 3 ){

			?>

				<tr>

                	<td><?php echo $lang['estado']; ?></td>

                    <td>

                    	<select id="status"  style="width:100%">

                            <option <?php if ( strcmp($datos_list['status_phonecard'],"New") == 0 ) echo 'selected="selected"'; ?> ><?php echo $lang['nueva']; ?></option>

                            <option <?php if ( strcmp($datos_list['status_phonecard'],"Used (Perfect)") == 0 ) echo 'selected="selected"'; ?> ><?php echo $lang['usada_perfecta']; ?></option>

                            <option <?php if ( strcmp($datos_list['status_phonecard'],"Used (Very Good)") == 0 ) echo 'selected="selected"'; ?> ><?php echo $lang['usada_muy_buena']; ?></option>

                            <option <?php if ( strcmp($datos_list['status_phonecard'],"Used (Good)") == 0 ) echo 'selected="selected"'; ?> ><?php echo $lang['usada_buena']; ?></option>

                            <option <?php if ( strcmp($datos_list['status_phonecard'],"Used (Damaged)") == 0 ) echo 'selected="selected"'; ?>><?php echo $lang['usada_danada']; ?></option>

                        </select>

                    </td>

                </tr>

			<?php	

		}

		

		?>

    </table>

    <input type="hidden" id="list" value="<?php echo $list; ?>" />

    <input type="hidden" id="id_item" value="<?php echo $id_item; ?>" />

    <input type="hidden" id="id_list" value="<?php echo $id_list; ?>" />

    <input type="hidden" id="id_countries" value="<?php echo $id_countries; ?>" />

    <input type="hidden" id="id_companies" value="<?php echo $id_companies; ?>" />

    <input type="hidden" id="catalog" value="<?php echo $catalog; ?>" />

    <input type="hidden" id="id_users" value="<?php echo $_SESSION['id_users']; ?>" />

    <div style="margin-bottom:10px; text-align:center;">

    	<span class="google-button google-button-blue" onClick="saveNote();"><?php echo $lang['guardar_notas']; ?></span>

    </div>

</div>
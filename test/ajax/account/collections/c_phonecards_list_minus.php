<script>

$(document).ready(function(){

	$('a[rel*=leanModal]').leanModal({ top : 40, closeButton: ".modal-close" });
	$('#modal-close').click(function(){

		$("#lean_overlay").click();

	});
});







function modalPhonecard( _p ){







	$("#modal-phonecard").load(path+'ajax/showPhonecard.php',{p:_p,backs:'../'},function(){



		$("#modalP").click();



	});







}







function modalNote( id_list , id_pc , list , id_countries , catalog , id_companies ){







	$("#modal-note").load(path+'ajax/modalNote.php',



		{id_list:id_list,id:id_pc,list:list,id_countries:id_countries,catalog:catalog,id_companies:id_companies},function(){



		$("#modalNote").click();



	});







}

function showVariations( dom ){
 
	id_users = $("#id_users").val();
	list = $("#list").val();
	id_countries = $("#id_countries").val();
	id_companies = $("#id_companies").val();
	system = $("#system").val();
	catalog = $("#catalog").val();
	
	if ( dom.checked ){
		phonecards_collections_select_minus( id_users , list , id_countries , id_companies , system , catalog , 1 );
	}
	else{
		phonecards_collections_select_minus( id_users , list , id_countries , id_companies , system , catalog );
	}
		
}

function showAllCol(  ){
 
	id_users = $("#id_users").val();
	list = $("#list").val();
	id_countries = $("#id_countries").val();
	id_companies = $("#id_companies").val();
	system = $("#system").val();
	catalog = $("#catalog").val();
	 
	phonecards_collections_select( id_users , list , id_countries , id_companies , system , catalog  );
	 	
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



$id_users = $_REQUEST['id_users'];



$list = $_REQUEST['list'];



$id_countries = $_REQUEST['id_countries'];



$id_companies = $_REQUEST['id_companies'];



$system = $_REQUEST['system'];



$catalog = (int) $_REQUEST['catalog'];
$no_variations = $_REQUEST['no_variations'];

if ( !isset($no_variations) ){
	$no_variations = 0;	
}



//id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$_SESSION['id_users'].' AND id_lists = '.$list.' )



$sql = '
SELECT p.id_phonecards as id, p.name as name , p.id_phonecards_systems as system, s.name as serie , c.name as country, pc.name as company FROM phonecards p , phonecards_series s, countries as c, phonecards_companies pc WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards_companies = '.$id_companies.' AND p.id_countries = '.$id_countries.' AND p.id_phonecards_systems = '.$system.' AND p.id_phonecards NOT IN ( SELECT p.id_phonecards FROM phonecards p , phonecards_series s, countries as c, phonecards_companies pc WHERE p.id_phonecards_series = s.id_phonecards_series AND p.id_countries = c.id_countries AND p.id_phonecards_companies = pc.id_phonecards_companies AND p.id_phonecards_companies = '.$id_companies.' AND p.id_countries = '.$id_countries.' AND p.id_phonecards_systems = '.$system.' AND p.id_phonecards IN ( SELECT id_phonecards FROM phonecards_users WHERE id_users = '.$id_users.' AND id_lists = '.$list.' ) )';







switch ( $catalog ){

case 1:



	$sql = $sql.' AND p.order_date <> "Unknown" AND p.not_emmited = 0 AND p.especial = 0';



	break;



case 2:



	$sql = $sql.' AND p.order_date = "Unknown" AND p.not_emmited = 0 AND p.especial = 0';



	break;



case 3:



	$sql = $sql.' AND p.not_emmited = 1';



	break;



case 4:



	$sql = $sql.' AND p.especial = 1';



	break;



	



}

if ( isset($no_variations) && $no_variations == 1 ){
	$sql = $sql.' GROUP BY p.id_phonecards_companies , p.name, p.face_value, p.print_run';	
}






$sql = $sql.' ORDER BY p.order_n , p.order_date , p.face_value , p.print_run , p.name , p.serie_number , p.id_phonecards';



//echo $sql;



$cursor = mysql_query($sql);







if ( mysql_num_rows($cursor) > 0 ){



	?>

    
	<input type="hidden" id="id_users" value="<?php echo $id_users; ?>" />
	<input type="hidden" id="list" value="<?php echo $list; ?>" />
	<input type="hidden" id="id_countries" value="<?php echo $id_countries; ?>" />
	<input type="hidden" id="id_companies" value="<?php echo $id_companies; ?>" />
	<input type="hidden" id="system" value="<?php echo $system; ?>" />
	<input type="hidden" id="catalog" value="<?php echo $catalog; ?>" />
	<input type="hidden" id="no_variations" value="<?php echo $no_variations; ?>" />
    
	<a id="modalP" style="display:none;" rel="leanModal" href="#modal-phonecard">a</a>



	<div id="modal-phonecard"></div>



    <a id="modalNote" style="display:none;" rel="leanModal" href="#modal-note">a</a>



	<div id="modal-note"></div>
    <?php
		switch($list){
			case 1: $name_list = $lang['coleccion'];
			break;	
			case 2: $name_list = $lang['deseo'];
			break;	
			case 3: $name_list = $lang['intercambio'];
			break;	
			case 5: $name_list = $lang['venta'];
			break;	
			
			default: {
		
			$sql_list = 'SELECT * FROM lists WHERE id_lists = '.$list;
			$cursor_list = mysql_query($sql_list);
			
			$datos_list = mysql_fetch_array($cursor_list);
			
			$name_list = $datos_list['name'];
			
		}
		break;
			
		}
	?> 
    <div class="title4">
        <?php echo $lang['faltantes_coleccion']; ?> [<?php echo $name_list; ?>]    
    </div>
    <table cellpadding="10">
    	<tr>
        	<td>
            	<a href="<?php echo $path; ?>index.php/export/pdf/<?php echo $_SESSION['id_users']; ?>/<?php echo $list; ?>/<?php echo $id_countries; ?>/<?php echo $id_companies; ?>/<?php echo $catalog; ?>/<?php echo $system; ?>/<?php echo $no_variations; ?>/1" title="<?php echo $lang['exportar_pdf']; ?>"><img src="<?php echo $path; ?>img/pdf-icon.png" /></a>
            </td>
            <td>
            	<a href="<?php echo $path; ?>index.php/export/excel/<?php echo $_SESSION['id_users']; ?>/<?php echo $list; ?>/<?php echo $id_countries; ?>/<?php echo $id_companies; ?>/<?php echo $catalog; ?>/<?php echo $system; ?>/<?php echo $no_variations; ?>/1" title="<?php echo $lang['exportar_excel']; ?>"><img src="<?php echo $path; ?>img/excel-icon.png" /></a>
            </td>
            <td>
                <input type="checkbox" onchange="showVariations(this);" <?php if ( isset($no_variations) && $no_variations == 1 ) echo 'checked="checked"'; ?> />
                <?php echo $lang['no_mostrar_variantes']; ?>
            </td>
            <td>
                <input type="button" onClick="showAllCol()" value="<?php echo $lang['mostrar_mi_coleccion']; ?>" class="google-button">
            </td>
        </tr>
    </table>


    



	<table id="collections-table" cellpadding="10" >



    	



		<tr class="collections-table-head">



			<td><?php echo $lang['nombre']; ?></td>



			<td><?php echo $lang['pais']; ?></td>



			<td><?php echo $lang['compania']; ?></td>



			<td><?php echo $lang['serie']; ?></td>



			<td><?php echo $lang['notas']; ?></td>



		</tr>



	



	<?php







		for ($i=0 ; $i < mysql_num_rows($cursor) ; $i++){



			



			$datos = mysql_fetch_array($cursor);



			



			$sql_list = 'SELECT * FROM phonecards_users WHERE id_users = '.$_SESSION['id_users'].' AND id_phonecards = '.$datos['id'];



			$sql_list = $sql_list.' AND id_lists = '.$list;



			$cursor_list = mysql_query($sql_list);



			$datos_list = mysql_fetch_array($cursor_list);



			



			?>



				<tr <?php echo $i % 2 != 0 ? 'class="odd"':''; ?> >



					<td onclick="modalPhonecard(<?php echo $datos['id']; ?>);"><?php echo $datos['name']; ?></td>



					<td><?php echo $datos['country']; ?></td>



					<td><?php echo $datos['company']; ?></td>



					<td><?php echo $datos['serie']; ?></td>



					<td 



                    	onClick="modalNote( <?php echo $datos_list['id_phonecards_users']; ?> , <?php echo $datos['id']; ?> ,



                         <?php echo $list; ?> , <?php echo $id_countries; ?> , <?php echo $catalog; ?> , <?php echo $id_companies; ?> )"



                      	 title="<?php echo $lang['has_clic_para_editar_nota']; ?>" >



						<?php echo $datos_list['description']; ?>



                    </td>



				</tr>



			<?php



		}



	



	?>



	</table>



	<?php



}



?>
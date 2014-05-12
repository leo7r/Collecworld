<?php

function trimm( $str , $num ){
	
	if ( strlen($str) > $num ){
		$ret = substr($str,0,$num);
		$ret = $ret.'...';
		return $ret;
	}
	
	return $str;
}

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 

session_start();

$list = $_REQUEST['list'];

$sql_list = "SELECT * FROM lists WHERE id_lists =".$list;
$cursor_list = mysql_query($sql_list);
$datos_list = mysql_fetch_array($cursor_list);

switch($datos_list['status']){
		
	case 0: $priv = "Public";	break;
	case 1: $priv = "Friends";	break;
	case 2: $priv = "Just me";	break;
	
}

switch($datos_list['id_lists']){
	
	case 1: $name_list = $lang['coleccion']; break;
	case 2: $name_list = $lang['deseo']; break;
	case 3: $name_list = $lang['intercambio']; break;
	case 5: $name_list = $lang['venta']; break;
	
	default: $name_list = $datos_list['name'];break;
	
}

?>


<div class="title4">
    <?php echo $lang['profile_mis_colecciones_estampillas']; ?> [<?php echo $name_list; ?>]    
</div>

<input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_users']; ?>" />
<input type="hidden" name="list_name_old" id="list_name_old" value="<?php echo $datos_list['name']; ?>" />
<table id="collections-table" cellpadding="2" >
 <?php if($list > 5){ ?>
    <tr>
        <td>Name: &nbsp; <input type="text" name="list_name" id="list_name" value="<?php echo $datos_list['name']; ?>" /></td>
        <td colspan="2">Privacy: &nbsp; 
            <select name="list_priv" id="list_priv">
                <option value="<?php echo $datos_list['status']; ?>"><?php echo $priv; ?></option>
                <?php if($datos_list['status']!=0){ ?><option value="0">Public</option> <?php } ?>
                <?php if($datos_list['status']!=1){ ?><option value="1">Friends</option> <?php } ?>
                <?php if($datos_list['status']!=2){ ?><option value="2">Just me</option> <?php } ?>
            </select>
        </td>
        <td><span class="google-button" onClick="editlist();" >Edit List</span></td>
    </tr> 
 <?php } ?>
</table>

<div id="collections_content">
<?php

$countries_sql = 'SELECT c.name , c.id_countries , count(p.id_phonecards) as count FROM phonecards_users pu , phonecards p , countries c WHERE pu.id_users = '.$_SESSION['id_users'].' AND pu.id_lists = '.$list;
$countries_sql = $countries_sql.' AND p.id_phonecards = pu.id_phonecards AND p.id_countries = c.id_countries GROUP BY p.id_countries';

$countries_cursor = mysql_query($countries_sql);

if ( mysql_num_rows($countries_cursor) > 0 ){
	?>
        
	<div class="title42">1. <?php echo $lang['seleccionar_pais']; ?></div>
    <table id="collection_countries" cellpadding="10">
    <?php
	
	for ( $i = 0 ; $i < mysql_num_rows($countries_cursor) ; $i++ ){
		$c_datos = mysql_fetch_array($countries_cursor);
		
		if ( $i % 4 == 0 ){
			echo '<tr>';	
		}
		?>
        
        <td>
            <div class="collection-step2" 
            	onClick="phonecards_collections_select( <?php echo $_SESSION['id_users']; ?> ,
                 <?php echo $list; ?> , <?php echo $c_datos['id_countries']; ?> )">
                 
                <img src="<?php echo $path; ?>img/flag-1.png" />
                <br>
                <?php echo $c_datos['name']; ?>
                <br>
                (<?php echo $c_datos['count']; ?>)
            </div>
        </td>
        
        <?php
		
		if ( $i % 4 == 3 ){
			echo '</tr>';	
		}
	}
	?>
    </table>
    <?php
}
else{
	?>
    <div id="info-info">
        <?php echo $lang['tu']; ?> <?php echo $datos_list['name'] ?> <?php echo $lang['profile_lista_esta_vacia']; ?>.
        <br />
        <?php echo $lang['tu_puedes']; ?><a href="<?php echo $path; ?>index.php/explore/phonecard"><?php echo $lang['explorar']; ?></a> <?php echo $lang['o']; ?> <a href="javascript:$('#search').focus();"><?php echo $lang['buscar']; ?></a> <?php echo $lang['para_completar_tu_coleccion']; ?>
    </div>
    <?php
}

?>
</div>
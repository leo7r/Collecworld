<?php 
if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

$category = $_REQUEST['category'];
$name = $_REQUEST['list'];
$priv = $_REQUEST['priv'];
$id_user = $_REQUEST['id_user'];

$buscar = 'SELECT * FROM lists WHERE id_users='.$id_user.' AND id_categories = '.$category.' AND name="'.$name.'" ';
$buscar_cursor = mysql_query($buscar);

$num_buscar = mysql_num_rows($buscar_cursor);

if(!$num_buscar){

$sql = 'INSERT INTO lists (id_users, id_categories, name ,status) values ('.$id_user.', '.$category.' , "'.$name.'", '.$priv.')'; 
mysql_query($sql);

	echo mysql_insert_id();
}else{

	echo 'error';	
	
}

?>
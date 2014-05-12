<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}

@session_start();

$sql= "SELECT u.id_currencies, c.name FROM users u, currencies c WHERE u.id_users=".$_SESSION['id_users']." AND u.id_currencies=c.id_currencies GROUP BY c.name";
$cursor = mysql_query($sql);
$datos = mysql_fetch_array($cursor);

$sql2= "SELECT u.id_currencies, c.id_currencies as currency, c.name FROM users u, currencies c WHERE u.id_currencies!=c.id_currencies GROUP BY c.name";
$cursor2 = mysql_query($sql2);

?>

<input type='text' id='price' class='note-input-price' placeholder='Price' >

<select id='currencies' class='note-select-currency' >
<?php

echo "<option value='".$datos['id_currencies']."'>".$datos['name']."</option>";

while ($datos2 = mysql_fetch_array($cursor2)){
	
	echo "<option value='".$datos2['currency']."'>".$datos2['name']."</option>";
}

?>

</select>
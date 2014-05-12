<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
}
@session_start();


$user = $_SESSION['id_users'];
$category = $_REQUEST['category'];
$id = $_REQUEST['id'];
$list = $_REQUEST['list'];
$note = $_REQUEST['note'];

if($_REQUEST['price']){
	$price = $_REQUEST['price'];
}else{
	$price = 0;
}

if($_REQUEST['currencies']){
	$currencies = $_REQUEST['currencies'];
}else{
	
	$cur_cursor = mysql_query('SELECT * FROM users WHERE id_users = '.$user);
	$cur = mysql_fetch_array($cur_cursor);
	$currencies = $cur['id_currencies'];
}

if($_REQUEST['status']){
	$status = $_REQUEST['status'];
}else{
	$status = '';
}

$category_var = '';
$category_var2 = '';

switch( $category ){
	case 1:
		$category_var = 'phonecards';
		$category_var2 = 'phonecard';
		break;
	case 2:
		$category_var = 'coins';
		$category_var2 = 'coin';
		break;
	case 3:
		$category_var = 'banknotes';
		$category_var2 = 'banknote';
		break;
}

$sql_verifica = 'SELECT * FROM '.$category_var.'_users WHERE id_users = '.$user.' AND id_'.$category_var.' = '.$id.' AND id_lists = '.$list.' AND description = "'.$note.'" ';
$cursor_verifica = mysql_query($sql_verifica);
	
if(!$num = mysql_num_rows($cursor_verifica)){

	switch ($list){
		case 1:{
			
			$sql = 'INSERT INTO '.$category_var.'_users (id_users, id_'.$category_var.', id_lists, description, status_'.$category_var2.') VALUES ('.$user.','.$id.','.$list.',"'.$note.'","'.$status.'")';
			$cursor = mysql_query($sql);
		
				 
			if(!$cursor){ 
		
				echo 'false-Error.';
		 
			}else{ 
		
				echo 'true';
		 
			}
			
		}; break;
		
		case 2:{
			
			$sql = 'INSERT INTO '.$category_var.'_users (id_users, id_'.$category_var.', id_lists, description) VALUES ('.$user.','.$id.','.$list.',"'.$note.'")';
			$cursor = mysql_query($sql);
		
				 
			if(!$cursor){ 
		
				echo 'false-Error.';
		 
			}else{ 
		
				echo 'true';
		 
			}
			
		}; break;
		
		
		case 3:
		case 5:{
			
			if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
				$include_ruta = $_SERVER['DOCUMENT_ROOT'].'upload/trade_'.$category_var.'/';
			}
			else{
				$include_ruta = $_SERVER['DOCUMENT_ROOT'].'collecworld/upload/trade_'.$category_var.'/';
			} 
						
			$image = $_FILES['image'];
		  
		  	echo var_dump($_FILES['image']);
			
			if($image['name'][0]){
				
				$picar = explode('.',$image['name'][0]); 
				$ext = $picar[count($picar)-1];
				
				$mime_filter = array(
					'jpg',
					'png',
					'jpeg'
				);
				
				if(in_array($ext , $mime_filter)) {
				
					$nombre = time().'-'.rand(0,9999).'.'.$ext;
					$temporal = $image['tmp_name'][0]; 
					
					if(move_uploaded_file($temporal, $include_ruta.$nombre)){
					
						$sql = 'INSERT INTO '.$category_var.'_users (id_users, id_'.$category_var.', id_lists, description, id_currencies, price , status_'.$category_var2.', image) VALUES ('.$user.','.$id.','.$list.',"'.$note.'", '.$currencies.' , "'.$price.'" , "'.$status.'", "'.$nombre.'")';
						$cursor = mysql_query($sql);
					
							 
						if(!$cursor){ 
					
							echo 'false-Error.';
					 
						}else{ 
					
							echo 'true';
					 
						}
					
					}else{
						
						echo 'false-Error al cargar.';
						
					}
				}else{
					
					echo 'false-Debe ser una imagen.';
					
				}
				
			}else{
				
				$sql = 'INSERT INTO '.$category_var.'_users (id_users, id_'.$category_var.', id_lists, description, id_currencies, price , status_'.$category_var2.') VALUES ('.$user.','.$id.','.$list.',"'.$note.'", '.$currencies.', "'.$price.'" , "'.$status.'")';
				$cursor = mysql_query($sql);
					 
				if(!$cursor){ 
			
					echo 'false-Error.';
			 
				}else{ 
			
					echo 'true';
			 
				}
				
			}
			
			
						 
		}; break;
	}
}else{
	
	echo 'false-Ya existe.';
	
}

?>
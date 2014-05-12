<?php

function resize($ancho,$alto,$dir,$name){
	
	$ext = split('\.',$name);
	$ext = $ext[1];

	$source=$dir.$name; // archivo de origen
	
	$dest=$dir.$name; // archivo de destino
	$width_d=$ancho; // ancho de salida
	$height_d=$alto; // alto de salida
	
	list($width_s, $height_s, $type, $attr) = getimagesize($source, $info2); // obtengo informaci�n del archivo
	
	if (strcmp($ext,'jpg') == 0 || strcmp($ext,'jpeg') == 0)
		$gd_s = imagecreatefromjpeg($source); // crea el recurso gd para el jpg
	if (strcmp($ext,'png') == 0)
		$gd_s = imagecreatefrompng($source); // crea el recurso gd para el png
	if (strcmp($ext,'gif') == 0)
		$gd_s = imagecreatefromgif($source); // crea el recurso gd para el gif
	
	
	$gd_d = imagecreatetruecolor($width_d, $height_d); // crea el recurso gd para la salida
	// desactivo el procesamiento automatico de alpha
	imagealphablending($gd_d, false);
	// hago que el alpha original se grabe en el archivo destino
	imagesavealpha($gd_d, true);
	imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); // redimensiona
	
	if (strcmp($ext,'jpg') == 0 || strcmp($ext,'jpeg') == 0)
		imagejpeg($gd_d, $dest); // graba
	if (strcmp($ext,'png') == 0)
		imagepng($gd_d, $dest); // graba
	if (strcmp($ext,'gif') == 0)
		imagegif($gd_d,$dest); 
		
	// Se liberan recursos
	imagedestroy($gd_s);
	imagedestroy($gd_d);

}

$path = $_SERVER['DOCUMENT_ROOT'].'upload/img/';

$img0 = $_REQUEST['img0'];
$img1 = $_REQUEST['img1'];

$img0_vars = $_REQUEST['img0_var'];
$img1_vars = $_REQUEST['img1_var'];

$vars0 = split(":",$img0_vars);
$vars1 = split(":",$img1_vars);

$ext0 = strtolower(substr($img0,strlen($img0)-4,4));
$ext1 = strtolower(substr($img1,strlen($img1)-4,4));

if ( strcmp($ext0,'.jpg') == 0 ){
	$img_r = imagecreatefromjpeg($path.$img0);
	}
else{
	if ( strcmp($ext0,'.png') == 0 ){
		$img_r = imagecreatefrompng($path.$img0);
	}
	else{
		$img_r = imagecreatefromgif($path.$img0);
	}
}


$img0_width = intval($vars0[3]);
$img0_height = intval($vars0[2]);

$img1_width = intval($vars1[3]);
$img1_height = intval($vars1[2]);

$dst_r = ImageCreateTrueColor( $vars0[3], $vars0[2] );
imagecopyresampled($dst_r,$img_r,0,0,$vars0[0],$vars0[1],$vars0[3],$vars0[2],$vars0[3],$vars0[2]);
//imagejpeg($dst_r,$l_ruta[$i].$r2.$ext);

if ( strcmp($ext0,'.jpg') == 0 )
	imagejpeg($dst_r,$path.$img0);
else{
	if ( strcmp($ext0,'.png') == 0 )
		imagepng($dst_r,$path.$img0);
	else
		imagegif($dst_r,$path.$img0);
}

// ------------ IMAGE REVERSE ----

if ( strcmp($img1,'') != 0 ){
	if ( strcmp($ext1,'.jpg') == 0 ){
		$img_r = imagecreatefromjpeg($path.$img1);
		}
	else{
		if ( strcmp($ext1,'.png') == 0 ){
			$img_r = imagecreatefrompng($path.$img1);
		}
		else{
			$img_r = imagecreatefromgif($path.$img1);
		}
	}
	
	
	$dst_r = ImageCreateTrueColor( $vars1[3], $vars1[2] );
	imagecopyresampled($dst_r,$img_r,0,0,$vars1[0],$vars1[1],$vars1[3],$vars1[2],$vars1[3],$vars1[2]);
	//imagejpeg($dst_r,$l_ruta[$i].$r2.$ext);
	
	if ( strcmp($ext1,'.jpg') == 0 )
		imagejpeg($dst_r,$path.$img1);
	else{
		if ( strcmp($ext1,'.png') == 0 )
			imagepng($dst_r,$path.$img1);
		else
			imagegif($dst_r,$path.$img1);
	}
}


//$img0_name = str_replace('img/','',$img0);
//$img1_name = str_replace('img/','',$img1);

$img0_vertical = $img0_width < $img0_height;
$img1_vertical = $img1_width < $img1_height;

if ( $img0_vertical ){
	resize(194*2,305*2,$path,$img0);
}
else{
	resize(305*2,194*2,$path,$img0);
}

if ( strcmp($img1,'') != 0 ){
	if ( $img1_vertical ){
		resize(194*2,305*2,$path,$img1);
	}
	else{
		resize(305*2,194*2,$path,$img1);
	}
}

$server = 'collecworldcom.ipagemysql.com';
$bd = 'collecworld';
$bd_user = 'collecworld';
$bd_pass = '';

$link = mysql_connect($server , $bd_user , $bd_pass );
mysql_select_db($bd , $link);

$sql = 'UPDATE coins SET image = "'.$img0.'" , image_reverse = "'.$img1.'" , vertical_anverse = '.($img0_vertical ? '1':'0').' , vertical_reverse = '.($img1_vertical ? '1':'0').'  WHERE id_phonecards = '.$_REQUEST['idPh'];
$res = mysql_query($sql);
echo 'OK';

//echo $name.' | '.$serie.' | '.$companies.' | '.$country.' | '.$system.' | '.$date.' | '.$faceValue.' | '.$currency.' | '.$printRun;

?>
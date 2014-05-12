<?php
function resize($ancho,$alto,$dir,$name){
	
	$ext = split('\.',$name);
	$ext = $ext[1];

	$source=$dir.$name; // archivo de origen
	
	$dest=$dir.$name; // archivo de destino
	$width_d=$ancho; // ancho de salida
	$height_d=$alto; // alto de salida
	
	list($width_s, $height_s, $type, $attr) = getimagesize($source, $info2); // obtengo información del archivo
	
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
?>
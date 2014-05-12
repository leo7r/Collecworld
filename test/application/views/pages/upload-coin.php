<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.Jcrop.min.css" />
<script src="<?php echo base_url(); ?>js/jquery.Jcrop.min.js"></script>

<script>

	var path = "<?php echo base_url(); ?>";

	var img0_x = 0;
	var img0_y = 0;
	var img0_h = 0;
	var img0_w = 0;
	
	var img1_x = 0;
	var img1_y = 0;
	var img1_h = 0;
	var img1_w = 0;

	function updateCoords0(c){
		img0_x = c.x;
		document.getElementById('x_img0').value = img0_x;
		img0_y = c.y;
		document.getElementById('y_img0').value = img0_y;
		img0_w = c.w;
		document.getElementById('w_img0').value = img0_w;
		img0_h = c.h;
		document.getElementById('h_img0').value = img0_h;
	}
	
	function updateCoords1(c){
		img1_x = c.x;
		document.getElementById('x_img1').value = img1_x;
		img1_y = c.y;
		document.getElementById('y_img1').value = img1_y;
		img1_w = c.w;
		document.getElementById('w_img1').value = img1_w;
		img1_h = c.h;
		document.getElementById('h_img1').value = img1_h;
	}
	
	function done(){
		document.getElementById('crop_img').submit();
	}
	
	function done2(){
		
		/*alert('image0 '+img0_x+','+img0_y+','+img0_w+','+img0_h);
		alert('image0 '+img1_x+','+img1_y+','+img1_w+','+img1_h);
		return;
		*/
		
		var img0 = "<?php echo $anverse; ?>";
		var img1 = "<?php echo $reverse; ?>";

		var noImage;
		var noImage2;
		
		
		if ( img0 == "" )
			 noImage = "1";
		
		if ( img1 == "" )
			noImage2 = "1";
		
		if ( !img0_h && !img0_w ){
			img0_h = $("#image").css('height').replace('px','');
			img0_w = $("#image").css('width').replace('px','');
		}
		
		if ( !img1_h && !img1_w ){
			img1_h = $("#image_r").css('height').replace('px','');
			img1_w = $("#image_r").css('width').replace('px','');
		}
				
		var div = document.createElement('div');
		var idPh = document.getElementById('idPh').value;
		
		$(div).load(path+'ajax/upload/coins/crop_img.php',{
			path:path,
			img0:img0,
			img1:img1,
			noImage: noImage,
			noImage2: noImage2,
			idPh:idPh,
			img0_var:img0_x+':'+img0_y+':'+img0_h+':'+img0_w ,
			img1_var:img1_x+':'+img1_y+':'+img1_h+':'+img1_w }
		, function(){
			
			location.href = '../upload/?cat=2&'+document.getElementById('onDone').value;
			//alert(div.innerHTML);
		});
		
	}

	$(document).ready(function(){
		$('#image').Jcrop({ onSelect: updateCoords0 });
		$('#image_r').Jcrop({ onSelect: updateCoords1 });
	});

</script>

<?php

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	$path = $_SERVER['DOCUMENT_ROOT'].'/';
}
else{
	$path = $_SERVER['DOCUMENT_ROOT'].'collecworld/';
}

if ( strcmp($anverse,"") != 0 and file_exists($path.'upload/coins/'.$anverse) )
	$size0 = getimagesize($path.'upload/coins/'.$anverse);
else
	$size0 = 0;

if ( strcmp($reverse,"") != 0 and file_exists($path.'upload/coins/'.$reverse) )
	$size1 = getimagesize($path.'upload/coins/'.$reverse);
else
	$size1 = 0;

	
?>

<form id="crop_img" method="post" action="crop_imgs">
	<input type="hidden" name="img0" value="<?php echo $anverse; ?>" />
	<input type="hidden" name="x_img0" id="x_img0" />
	<input type="hidden" name="y_img0" id="y_img0" />
	<input type="hidden" name="w_img0" id="w_img0" value="<?php echo $size0[0]; ?>" />
	<input type="hidden" name="h_img0" id="h_img0" value="<?php echo $size0[1]; ?>" />
	
	<input type="hidden" name="img1" value="<?php echo $reverse; ?>" />
	<input type="hidden" name="x_img1" id="x_img1" />
	<input type="hidden" name="y_img1" id="y_img1" />
	<input type="hidden" name="w_img1" id="w_img1" value="<?php echo $size1[0]; ?>" />
	<input type="hidden" name="h_img1" id="h_img1" value="<?php echo $size1[1]; ?>" />
	
	<input type="hidden" name="idPh" value="<?php echo $cn['id_coins']; ?>" />
	<input type="hidden" name="cat" value="2" />
	<input type="hidden" name="onFinish" value="<?php if ( isset($onFinish) ) echo $onFinish; ?>" />
    <input type="hidden" name="onDone2" value="<?php echo isset($onDone) ? $onDone : ''; ?>" />
	
	<?php
		$name = trim($cn['id_coins']);
		$name = str_replace(array("  ","(",")","\\","/"),"",$name);
		$name = str_replace(" ","-",$name);
	?>
	<input type="hidden" name="namePc" value="<?php echo $name; ?>" />

	<input type="hidden" name="onDone" value="<?php echo 'don='.$cn['id_coins'].( isset($onDone) ? '&onDone='.$onDone : '' ).'&cou='.$cn['id_countries'].'&com='.$companies.( $saveInfo ? '&sav='.$saveInfo.'&ser'.( $cn['serie_known'] ? '2':'' ).'='.$serie.'&sys='.$cn['id_phonecards_systems'].'&sen'.( $cn['serie_known'] ? '2':'' ).'='.$cn['serie_number'].'&nam='.$cn['name'].'&prr'.( $cn['print_run_known'] ? '2':'' ).'='.$cn['print_run'].'&iss='.$cn['issued_on'].'&kno='.$cn['known_date'].'&exp='.$cn['exp_date'].'&fav='.$cn['face_value'].'&tag='.$cn['tags']:''); ?>" />
	
</form>

<?php
	
	if ( strlen($anverse) == 0  and strlen($reverse) == 0 ){
		?>
			<script>
				$(document).ready(function(){
					done();
				});
			</script>
		<?php
	}
	
?>


<div id="crop_done">
	<span class="google-button google-button-blue" onclick="done()"><?php echo $this->lang->line('hecho'); ?></span>
</div>
<div id="crop_content">
	
	<div id="crop_left">
		<div class="crop_title"><?php echo $this->lang->line('cortar_imagen'); ?>: </div>
		<div class="crop_img">
			<div><img id="image" src="<?php if ( strcmp($anverse,"") != 0 ) echo base_url().'upload/coins/'.$anverse; else echo ''; ?>" /></div>
		</div>
	</div>
	
	<div id="crop_right">
		<div class="crop_title"><?php echo $this->lang->line('cortar_imagen_reverso'); ?>: </div>
		<div class="crop_img">
			<div><img id="image_r" src="<?php if ( strcmp($reverse,"") != 0 ) echo base_url().'upload/coins/'.$reverse; else echo ''; ?>" /></div>
		</div>
	</div>
</div>
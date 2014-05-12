<script>
	
	function sendFb( user ){
		
		text = $("#feedback-content-in").val();
		
		if ( text.length > 10 ){
			url = document.URL.split('?');
			url = url[0];
			$("#onFinish").val(url);
			document.getElementById('feedback-form').submit();
			
		}
		else{
			alert('Feedback too short');
		}
		
	}
</script>

<?php
$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
				

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	
	switch($language){
		
	default : include $_SERVER['DOCUMENT_ROOT'].'/application/language/english/app_lang.php'; break;
	
	case 'es':	include $_SERVER['DOCUMENT_ROOT'].'/application/language/spanish/app_lang.php'; break;
	
		
	}
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	
	switch($language){
		
	default : include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/english/app_lang.php'; break;
	
	case 'es':	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/spanish/app_lang.php'; break;
	
		
	}
	
} 

@session_start();

?>

<div id="modal-close" class="modal-close" onClick="closeSignin();">
	<img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />
</div>
<div id="show-feedback">
	<div class="title4">
		<?php echo $lang['comentario'];?>
	</div>
	<div id="show-feedback-info">
    
		<?php echo $lang['feedback_encontrar_problema'];?>.
		<br>
	</div>
	<div id="feedback-content">
		<form id="feedback-form" action="<?php echo $path; ?>index.php/sendFeedback" method="post" enctype="multipart/form-data" >
        	<table>
            	<tr>
                	<td><?php echo $lang['tu_correo_electronico']; ?></td>
                </tr>
                <tr>
                	<td><input type="text" class="feed-input" id="email" name="email" placeholder="<?php echo $lang['correo_electronico']; ?>" value="<?php echo $_SESSION['email']; ?>" /></td>
                </tr>
                <tr>
                	<td><?php echo $lang['me_siento']; ?></td>
                </tr>
                <tr>
                	<td>
                    <select id="feel" name="feel" class="feed-select" >
                    	<option value=''>---</option>
                        <option><?php echo $lang['molesto']; ?></option>
                        <option><?php echo $lang['confundido']; ?></option>
                        <option><?php echo $lang['feliz']; ?></option>
                        <option><?php echo $lang['entretenido']; ?></option>
                        <option><?php echo $lang['impresionado']; ?></option>
                        <option><?php echo $lang['sorprendido']; ?></option>
                        <option><?php echo $lang['decepcionado']; ?></option>
                        <option><?php echo $lang['frustrado']; ?></option>
                        <option><?php echo $lang['curioso']; ?></option>
                        <option><?php echo $lang['indiferente']; ?></option>
                        
                    </select>
                    </td>
                </tr>
                <tr>
                	<td><?php echo $lang['comentario_es_sobre']; ?></td>
                </tr>
                <tr>
                	<td>
                    <select id="about" name="about" class="feed-select" >
                    	<option value=''>---</option>
                        <option><?php echo $lang['diseno']; ?></option>
                        <option><?php echo $lang['funcionalidad']; ?></option>
                        <option><?php echo $lang['una_idea']; ?></option>
                        <option><?php echo $lang['otro']; ?></option>
                        
                    </select>
                    </td>
                </tr>
                <tr>
                	<td><?php echo $lang['cuentanos_lo_que_piensas']; ?></td>
                </tr>
                <tr>
                	<td>
                    <textarea id="feedback-content-in" name="feedback-content-in"></textarea>
                    <div id="feedback-content-top">
                        <span style="float:right; color:#888;">
                            <?php 
                                if ( isset($_SESSION['user']) ){
                                    echo $_SESSION['name'].' ('.$_SESSION['user'].')';
                                }
                                else{
                                    echo $lang['anonimo'];
                                }
                            ?>
                        </span>
                    </div>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<?php echo $lang['algun_archivo']; ?>
                       	<br />
                        <br />
                        <div id="feedback-content-middle">
                            <span class="google-button" onclick="$('#feedback-file').click();" ><?php echo $lang['feedback_cargalo']; ?></span>
                            <span id="feedback-file-name"></span>
                        </div>
                        &nbsp;
                        <div id="feedback-content-bottom">
                            <span style="" class="google-button google-button-red" onClick="sendFb();"><?php echo $lang['enviar']; ?></span>
                        </div>
                   	</td>
                </tr>
            </table>
			<input style="display:none;" type="file" id="feedback-file" name="feedback-file" onchange="feedback_file(this);" />
			<input type="hidden" name="fb-user" value="<?php echo $_SESSION['user']; ?>" />
			<input type="hidden" id="onFinish" name="onFinish" />
		</form>
        <br />
		
		
		
		
		
		
		
	</div>
</div>
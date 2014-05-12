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

if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
	include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
	
}
else{
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
	include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
	
} 


@session_start();

?>

<div id="modal-close" class="modal-close" onClick="closeSignin();">
	<img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />
</div>
<div id="show-feedback">
	<div class="title4">
		
<?php echo $lang['comentario']; ?>
	</div>
	<div id="show-feedback-info">
		
<?php echo $lang['problemas_con_catalgo_de_referencia']; ?>.
		<br>
	</div>
	<div id="feedback-content">
		<form id="feedback-form" action="<?php echo $path; ?>index.php/sendFeedback" method="post" enctype="multipart/form-data" >
        	<input type="hidden" name="feel" value="" />
            <input type="hidden" name="about" value="Problem with reference catalog" />
        	<table>
            	<tr>
                	<td><?php echo $lang['tu_correo_electronico']; ?></td>
                </tr>
                <tr>
                	<td><input type="text" class="feed-input" id="email" name="email" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" /></td>
                </tr>
                <tr>
                	<td><?php echo $lang['que_problema_tienes_catalogo_de_referencia']; ?></td>
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
                            <span class="google-button" onclick="$('#feedback-file').click();" ><?php echo $lang['cargar']; ?></span>
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
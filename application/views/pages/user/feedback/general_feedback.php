<div id="modal-close" class="modal-close" onClick="closeSignin();">
	<img src="<?php echo base_url(); ?>img/modal-close.png" height="16" width="16" />
</div>
<div id="show-feedback">
	<div class="title4">
		<?php echo $this->lang->line('comentario');?>
	</div>
	<div id="show-feedback-info">
    
		<?php echo $this->lang->line('feedback_encontrar_problema');?>.
		<br>
	</div>
	<div id="feedback-content">
		<form id="feedback-form" action="<?php echo base_url(); ?>index.php/sendFeedback" method="post" enctype="multipart/form-data" >
        	<table>
            	<tr>
                	<td><?php echo $this->lang->line('tu_correo_electronico'); ?></td>
                </tr>
                <tr>
                	<td><input type="text" class="feed-input" id="email" name="email" placeholder="<?php echo $this->lang->line('correo_electronico'); ?>"
                     value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : "" ; ?>" />
                     </td>
                </tr>
                <tr>
                	<td><?php echo $this->lang->line('me_siento'); ?></td>
                </tr>
                <tr>
                	<td>
                    <select id="feel" name="feel" class="feed-select" >
                    	<option value=''>---</option>
                        <option><?php echo $this->lang->line('molesto'); ?></option>
                        <option><?php echo $this->lang->line('confundido'); ?></option>
                        <option><?php echo $this->lang->line('feliz'); ?></option>
                        <option><?php echo $this->lang->line('entretenido'); ?></option>
                        <option><?php echo $this->lang->line('impresionado'); ?></option>
                        <option><?php echo $this->lang->line('sorprendido'); ?></option>
                        <option><?php echo $this->lang->line('decepcionado'); ?></option>
                        <option><?php echo $this->lang->line('frustrado'); ?></option>
                        <option><?php echo $this->lang->line('curioso'); ?></option>
                        <option><?php echo $this->lang->line('indiferente'); ?></option>
                        
                    </select>
                    </td>
                </tr>
                <tr>
                	<td><?php echo $this->lang->line('comentario_es_sobre'); ?></td>
                </tr>
                <tr>
                	<td>
                    <select id="about" name="about" class="feed-select" >
                    	<option value=''>---</option>
                        <option><?php echo $this->lang->line('diseno'); ?></option>
                        <option><?php echo $this->lang->line('funcionalidad'); ?></option>
                        <option><?php echo $this->lang->line('una_idea'); ?></option>
                        <option><?php echo $this->lang->line('otro'); ?></option>
                        
                    </select>
                    </td>
                </tr>
                <tr>
                	<td><?php echo $this->lang->line('cuentanos_lo_que_piensas'); ?></td>
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
                                    echo $this->lang->line('anonimo');
                                }
                            ?>
                        </span>
                    </div>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<?php echo $this->lang->line('algun_archivo'); ?>
                       	<br />
                        <br />
                        <div id="feedback-content-middle">
                            <span class="google-button" onclick="$('#feedback-file').click();" ><?php echo $this->lang->line('feedback_cargalo'); ?></span>
                            <span id="feedback-file-name"></span>
                        </div>
                        &nbsp;
                        <div id="feedback-content-bottom">
                            <span style="" class="google-button google-button-red" onClick="sendFb();"><?php echo $this->lang->line('enviar'); ?></span>
                        </div>
                   	</td>
                </tr>
            </table>
			<input style="display:none;" type="file" id="feedback-file" name="feedback-file" onchange="feedback_file(this);" />
			<input type="hidden" name="fb-user" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user']:""; ?>" />
			<input type="hidden" id="onFinish" name="onFinish" />
		</form>
        <br />
		
		
		
		
		
		
		
	</div>
</div>
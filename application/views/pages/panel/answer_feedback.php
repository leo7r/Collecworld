<script>

function openAnswer( num_feedback ){
	
	tr = $("#feedback_"+num_feedback);
	
	tds = tr.find("td");
	
	$("#answer_user").val(tds[1].innerHTML);
	$("#answer_user_fb").val(tds[4].innerHTML);
	$("#feedback_id").val(tds[0].innerHTML);
	$("#sender").prop("disabled",false);
	
}

function sendFeedback(){
	
	user = $("#answer_user").val();
	text = $("#answer_answer").val();
	
	if ( confirm("Enviar "+text+" a "+user+"?") ){
		document.getElementById("feedback_form").submit();
	}
		
}

</script>

<div id="content">
	<div id="toolbar">
		<div class="in">
			<div id="toolbar-left">
				<div class="item location">
					&nbsp;<a href="<?php echo base_url(); ?>index.php/init"><?php echo $this->lang->line('inicio'); ?></a>&nbsp;&raquo;&nbsp;<a href="">Responder feedbacks</a>&nbsp;&raquo;
				</div>
			</div>
		</div>
	</div>
    
	<div id="content-in">
		<?php
		
		if ( count($feedbacks) == 0 ){
			echo 'No hay feedbacks';
		}
		else{
			?>
            <table class="feedback_table">
            <tr>
            	<td>Id</td>
            	<td>Usuario</td>
                <td>Se siente</td>
                <td>Sobre</td>
                <td>Feedback</td>
                <td>Mando archivo</td>
                <td>Accion</td>
            </tr>
            <?php
			for ( $i = 0 ; $i < count($feedbacks) ; $i++ ){
				?>
                <tr id="feedback_<?php echo $i; ?>">
                	<td><?php echo $feedbacks[$i]['id']; ?></td>
                	<td><?php echo $feedbacks[$i]['user']; ?></td>
                	<td><?php echo $feedbacks[$i]['feel']; ?></td>
                	<td><?php echo $feedbacks[$i]['about']; ?></td>
                	<td><?php echo $feedbacks[$i]['comment']; ?></td>
                	<td><?php echo strlen($feedbacks[$i]['file']) > 0 ? "Si. ".$feedbacks[$i]['file'] : "No"; ?></td>
                    <td>
                    	<input type="button" value="Responder" onClick="openAnswer(<?php echo $i; ?>);" />
                    </td>
                </tr>
                <?php
			}
			?>
            </table>
            
            <form id="feedback_form" action="<?php echo base_url(); ?>index.php/answer_feedback/send" method="post">
            <table id="answer_feedback" class="feedback_table feedback_answer">
            	<tr>
                	<td>Respondiendo a</td>
                    <td>Por feedback</td>
                    <td>Respuesta</td>
                    <td>Accion</td>
                </tr>
                <tr>
                	<td>
                    	<input name="user" type="text" id="answer_user" />
                    </td>
                	<td>
                    	<textarea id="answer_user_fb" style="width:300px; height:70px;" ></textarea>
                    </td>
                	<td>
                    	<textarea name="answer" id="answer_answer" style="width:300px; height:70px;"></textarea>
                    </td>
                    <td>
                    	<input type="hidden" id="feedback_id" name="feedback_id" />
                    	<input id="sender" type="button" value="Enviar" onClick="sendFeedback()" disabled="disabled" />
                    </td>
                </tr>
            </table>
            </form>
			<?php
		}
		?>
	</div>
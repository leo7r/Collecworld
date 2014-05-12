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

<script type="text/javascript" language="javascript" src="<?php echo $path; ?>js/jquery.easing.min.1.3.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $path; ?>js/jquery.jcontent.0.8.js"></script>
<link href="<?php echo $path; ?>css/demo.css" rel="stylesheet" type="text/css"/>  
<link href="<?php echo $path; ?>css/jcontent.css" rel="stylesheet" type="text/css"/> 

<script type="text/javascript" language="javascript">
	$("document").ready(function(){
								 
		//demo7 
		$("div#demo7").jContent({orientation: 'horizontal', 
								 easing: "easeOutCirc", 
								 duration: 500,
								 auto:false,
								 circle: true});
						 
	});
</script>	

<div id="modal-close" class="modal-close" onClick="closeSignin();">
	<img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />
</div>
<div id="show-intro">
	<div class="title4">
		<?php echo $lang['algo_que_deberias_saber']; ?>.
	</div>
	<div id="show-feedback-info" style="text-align:left">
		<strong><?php echo $lang['crear_evento']; ?></strong>
		<br>
        <?php echo $lang['crear_un_evento_es_muy_simple']; ?>
	</div>
	<div id="feedback-content"> 
        	<div id="demo7" class="demo1" style="margin-left:-100px;">
                <a title="Previous" href="#" class="prev-left"></a>
               	
                <a title="Next" href="#" class="next-right"></a>
                <div class="slides" style="padding-top:10px;">
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px"><img src="<?php echo $path; ?>img/introduction/create_ev1.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['1_nombre_del_evento_y_pais']; ?></strong><br />
                                <br />
                                <?php echo $lang['coloque_el_del_evento']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/create_ev2.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['2_lugar']; ?></strong><br />
                                <br />
                                <?php echo $lang['coloca_donde_se_realizara_el_evento']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/create_ev3.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['3_invitar_amigos']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_invitar_a_todos']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/create_ev4.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['4_privado_o_publico']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_crear_eventos_publicos_y_privados']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
            </div>
            <table width="600px" style="margin-left:-100px;">
                <tr>
                	<td>
                   		<br />
                
                        <div id="feedback-content-middle">
                            <span class="google-button" onClick="closeSignin();" ><?php echo $lang['recuerdamelo_mas_tarde']; ?></span>
                        </div>
                        &nbsp;
                        <div id="feedback-content-bottom">
                            <span style="" class="google-button google-button-red" onClick="introViewed(5,'<?php echo $_SESSION['user']; ?>');"><?php echo $lang['no_volver_a_mostrar']; ?></span>
                        </div>
                   	</td>
                </tr>
            </table>
        <br />
				
	</div>
</div>
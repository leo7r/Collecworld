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
		<strong><?php echo $lang['cargar']; ?></strong>
		<br>
        <?php echo $lang['colaborar_cargando_items_variantes']; ?>.
	</div>
	<div id="feedback-content"> 
        	<div id="demo7" class="demo1" style="margin-left:-100px;">
                <a title="Previous" href="#" class="prev-left"></a>
               	
                <a title="Next" href="#" class="next-right"></a>
                <div class="slides" style="padding-top:10px;">
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px"><img src="<?php echo $path; ?>img/introduction/up-phone1.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['1_seleccionar_categoria']; ?></strong><br />
                                <br />
                                <?php echo $lang['selecciona_la_categoria']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/up-phone2.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['2_campos_obligatorios']; ?></strong><br />
                                 <br />
                                <?php echo $lang['campos_obligatorios_para_tarjetas_telefonicas']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/up-phone3.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['3_cargar']; ?></strong><br />
                                 <br />
                                <?php echo $lang['luego_de_rellenar_presione_cargar']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/up-phone4.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['4_cargar_y_salvar_informacion']; ?></strong><br />
                                 <br />
                                <?php echo $lang['no_borrar_informacion_de_los_campos']; ?>.
 </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/up-phone5.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['5_restablecer']; ?></strong><br />
                                 <br />
                                <?php echo $lang['este_boton_limpiara_informacion']; ?>.
 </p>
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
                            <span style="" class="google-button google-button-red" onClick="introViewed(3,'<?php echo $_SESSION['user']; ?>');"><?php echo $lang['no_volver_a_mostrar']; ?></span>
                        </div>
                   	</td>
                </tr>
            </table>
        <br />
				
	</div>
</div>
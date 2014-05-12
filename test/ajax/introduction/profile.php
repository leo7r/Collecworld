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
		<strong> <?php echo $lang['perfil']; ?> </strong>
		<br>
        <?php echo $lang['aqui_puedes_ver_y_editar']; ?>.
	</div>
	<div id="feedback-content"> 
        	<div id="demo7" class="demo1" style="margin-left:-100px;">
                <a title="Previous" href="#" class="prev-left"></a>
               	
                <a title="Next" href="#" class="next-right"></a>
                <div class="slides" style="padding-top:10px;">
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px"><img src="<?php echo $path; ?>img/introduction/profile1.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['1_informacion_general']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_ver_tu_informacion_general']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile2.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['2_editar_perfil']; ?></strong><br />
                                <br />
                                <?php echo $lang['cambiar_tu_informacion_personal_y_foto']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile3.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['3_compartir']; ?></strong><br />
                                <br />
                                <?php echo $lang['comparte_tus_colecciones_con_amigos']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile4.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['4_tus_colecciones']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_ver_tus_listados_y_crear_listados']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile4.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['4_tus_colecciones']; ?></strong><br />
                                <br />
                                <?php echo $lang['para_crear_nuevo_listado_debes']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile4_1.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['5_mas_detalles']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_hacer_clic_para_mas_detalles']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile4_2.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['6_exportar_listados']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_exportar_tus_listados']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile4_3.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['7_sin_variantes']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_elegir_no_ver_variantes']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile5.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['8_amigos']; ?></strong><br />
                                <br />
                               <?php echo $lang['ver_amigos_y_solcitudes']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile6.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['9_confirmar_cancelar_amistad']; ?></strong><br />
                                <br />
                                <?php echo $lang['explicacion_confirmar_cancelar_amistad']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile9.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['10_enviar_mensajes']; ?></strong><br />
                                <br />
                                <?php echo $lang['enviar_mensaje_a_tus_amigos']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile10.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['11_eventos']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_ver_todos_los_eventos']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile11.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['12_comercios']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_ver_todos_tus_comercios']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile12.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['13_mensajes']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_ver_todos_tus_mensajes']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile13.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['14_preferencias_de_correo_electronico']; ?></strong><br />
                                <br />
                                <?php echo $lang['puedes_configurar_las_notificaciones']; ?>. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table width="600px">
                            <tr>
                                <td width="300px" height="180px"><img src="<?php echo $path; ?>img/introduction/profile14.png" class="intro-thumb" /></td>
                                <td width="300px" valign="top">
                                <p style="width:160px; font-size:14px; padding-left:8px;"><strong><?php echo $lang['17_privacidad']; ?></strong><br />
                                <br />
                                <?php echo $lang['preferencias_de_privacidad_de_tu_perfil']; ?>. </p>
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
                            <span style="" class="google-button google-button-red" onClick="introViewed(6,'<?php echo $_SESSION['user']; ?>');"><?php echo $lang['no_volver_a_mostrar']; ?></span>
                        </div>
                   	</td>
                </tr>
            </table>
        <br />
				
	</div>
</div>
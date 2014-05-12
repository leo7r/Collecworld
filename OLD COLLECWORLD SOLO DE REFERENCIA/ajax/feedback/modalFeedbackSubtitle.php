

<?php
$category=$_REQUEST['category'];


if ( strpos($_SERVER['DOCUMENT_ROOT'],'wamp') == false ) {
    include $_SERVER['DOCUMENT_ROOT'].'/ajax/conexion.php';
    include $_SERVER['DOCUMENT_ROOT'].'/application/language/switch_language.php';
    
}
else{
    include $_SERVER['DOCUMENT_ROOT'].'collecworld/ajax/conexion.php';
    include $_SERVER['DOCUMENT_ROOT'].'collecworld/application/language/switch_language.php';
    
} 




@session_start();



$countries = 'SELECT * FROM countries ORDER BY name';

$countries = mysql_query($countries);



?>
<script>

    function setTitlefeed( dom, category ){
    
        index = dom.selectedIndex;
        id_c = dom.options[index].value;
        
        if ( id_c != -1 ){
            $('#ss_title').load(path+'ajax/upload/'+category+'/titleByCountry.php?category='+category, {country:id_c});
            
            $('#ss_mint_house').load(path+'ajax/upload/'+category+'/mintHouseByCountry.php', {country:id_c});
             
        }
        else{
            document.getElementById('s_title').innerHTML = '<select disabled="disabled" id="title" name="title"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
        }
    }


    function setValue( dom, category ){
    //alert(category);
        index = dom.selectedIndex;
        id_t = dom.options[index].value;
        
        if ( id_t != -1 ){
            $('#s_value').load(path+'ajax/upload/'+category+'/valueByTitle.php?category='+category, {title:id_t});
        }
        else{
            document.getElementById('s_value').innerHTML = '<select disabled="disabled" id="value" name="value"><option selected="selected" value="-1"><?php echo $lang['seleccione']; ?></option></select>';
        }
    
    }

    function sendFb( user ){

        

        text = $("#feedback-content-in").val();

        country = $("#country").val();

        title = $("#title").val();

        value = $("#value").val();

        

        if ( text.length > 3 && country != -1 && title!= -1 && value!=-1){

            url = document.URL.split('?');

            url = url[0];

            $("#onFinish").val(url);

            

            $("#feedback-content-in").val($("#feedback-content-in").val()+" | country: "+country+" | title: "+title+" | value: "+value);

            

            document.getElementById('feedback-form').submit();

            

        }

        else{

            showGlobalInfo('<?php echo $lang['feedback_muy_corto_o_pais_titulo_valor_no_seleccionado']; ?>');

        }

        

    }

</script>


<div id="modal-close" class="modal-close" onClick="closeSignin();">

    <img src="<?php echo $path; ?>img/modal-close.png" height="16" width="16" />

</div>

<div id="show-feedback">

    <div class="title4">

        
<?php echo $lang['comentario']; ?>

    </div>

    <div id="show-feedback-info">

                <?php echo $lang['no_aparece_valor']; ?>. <?php echo $lang['nota_recomendamos_cargar_foto']; ?>.

        <br>

    </div>

    <div id="feedback-content">

        <form id="feedback-form" action="<?php echo $path; ?>index.php/sendFeedback" method="post" enctype="multipart/form-data" >

            <input type="hidden" name="feel" value="" />

            <input type="hidden" name="about" value="New Value(<?php echo $category; ?>)" />

            <table>

                <tr>

                    <td>
<?php echo $lang['tu_correo_electronico']; ?></td>

                </tr>

                <tr>

                    <td><input type="text" class="feed-input" id="email" name="email" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" /></td>

                </tr>

                <tr>

                    <td><?php echo $lang['pais']; ?></td>

                </tr>

                <tr>

                    <td>

                        <select id="country" name="country" onchange="setTitlefeed(this,'<?php echo $category; ?>')">

                            <option selected="selected" value="-1" ><?php echo $lang['seleccione']; ?></option>

                            <?php

                                for ($i=0 ; $i < mysql_num_rows($countries) ; $i++){

                                    $datos = mysql_fetch_array($countries);

                                    echo '<option value="'.$datos['id_countries'].'" >'.$datos['name'].'</option>';

                                }

                            ?>                          

                        </select>

                    </td>

                </tr>

                <tr>

                    <td><?php echo $lang['titulo']; ?></td>

                </tr>

                                <tr>

                    <td id="ss_title">

                        <select disabled='disabled'  id="title" name="title">

                            <option selected="selected" value="-1" ><?php echo $lang['seleccione']; ?></option>                        

                        </select>

                    </td>

                </tr>

                                <tr>

                    <td><?php echo $lang['valor']; ?></td>

                </tr>

                                <tr>

                    <td id="s_value">

                        <select disabled='disabled'  id="title" name="title">

                            <option selected="selected" value="-1" ><?php echo $lang['seleccione']; ?></option>                        

                        </select>

                    </td>

                </tr>

                <tr>

                    <td><?php echo $lang['cual_es_el_subtitulo']; ?></td>

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

                                    echo 'Anonymous';

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
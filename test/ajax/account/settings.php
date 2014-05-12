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



$sql = 'SELECT u.* , c.name as Country FROM users u , countries c WHERE u.id_users = '.$_SESSION['id_users'].' AND c.id_countries = u.id_countries';

$cursor = mysql_query($sql);



if ( mysql_num_rows($cursor) == 0 ){

	die('error');

}



$datos = mysql_fetch_array($cursor);



?>

<div id="settings_container">

	<div>

		<span class="title4"><?php echo $lang['configuracion']; ?></span>

	</div>

	<div id="settings_list">

    	<br />

    	<div class="account-separator-min"><strong><?php echo $lang['settings_preferencias_email']; ?></strong></div>

        <div id="user-info">

        	<?php

				$sql_uc = "SELECT * FROM users WHERE id_users = ".$_SESSION['id_users'];

				$cursor_uc = mysql_query($sql_uc);

				$datos_uc = mysql_fetch_array($cursor_uc);

			?>

            <table cellspacing="0" cellpadding="10">

                <tr>

                    <td><?php echo $lang['mensaje_nuevo']; ?>: </td>

                    <td>

                    	<?php 

							if($datos_uc['email_message'] == 1 ){

								$s_class = 'google-button-red';

								$s_value = $lang['desactivado'];

							}

							else{

								$s_class = 'google-button-green';	

								$s_value = $lang['activado'];

							}

						?>

                        <span class="google-button <?php echo $s_class; ?>" onclick="change_email(<?php echo $datos_uc['id_users']; ?>,'message',this)">

                        	<?php echo $s_value; ?>

						</span>		

                    </td>

                </tr>

                <tr>

                    <td><?php echo $lang['solicitudes_amistad']; ?>: </td>

                    <td>

                       	<?php 

							if($datos_uc['email_friend'] == 1 ){

								$s_class = 'google-button-red';

								$s_value = $lang['desactivado'];

							}

							else{

								$s_class = 'google-button-green';	

								$s_value = $lang['activado'];

							}

						?>

                        <span class="google-button <?php echo $s_class; ?>" onclick="change_email(<?php echo $datos_uc['id_users']; ?>,'friend',this)">

                        	<?php echo $s_value; ?>

						</span>	

                    </td>

                </tr>

                <tr>

                    <td><?php echo $lang['invitacion_evento']; ?>: </td>

                    <td>

                    	<?php 

							if($datos_uc['email_event'] == 1 ){

								$s_class = 'google-button-red';

								$s_value = $lang['desactivado'];

							}

							else{

								$s_class = 'google-button-green';	

								$s_value = $lang['activado'];

							}

						?>

                        <span class="google-button <?php echo $s_class; ?>" onclick="change_email(<?php echo $datos_uc['id_users']; ?>,'event',this)">

                        	<?php echo $s_value; ?>

						</span>		

                    </td>

                </tr>

                <tr>

                    <td><?php echo $lang['solicitudes_comercio']; ?> </td>

                    <td>

                    	<?php 

							if($datos_uc['email_trade'] == 1 ){

								$s_class = 'google-button-red';

								$s_value = $lang['desactivado'];

							}

							else{

								$s_class = 'google-button-green';	

								$s_value = $lang['activado'];

							}

						?>

                        <span class="google-button <?php echo $s_class; ?>" onclick="change_email(<?php echo $datos_uc['id_users']; ?>,'trade',this)">

                        	<?php echo $s_value; ?>

						</span>

                    </td>

                </tr>

            </table>

        </div>

		<hr />

    	<div class="account-separator-min"><strong><?php echo $lang['privacidad']; ?></strong></div>

        <div id="user-info">

            <table cellspacing="0" cellpadding="10">

            	<tr>

                    <td><?php echo $lang['settings_who_can_view_profile']; ?></td>

                    <td>

                    	<select id="view-privacy" class="collections-input" onchange="view_privacy(<?php echo $datos_uc['id_users']; ?>)">

							<option <?php if ( $datos_uc['view_privacy'] == 0 ) echo 'selected="selected"'; ?> value="0"><?php echo $lang['publico']; ?></option>

                            <option <?php if ( $datos_uc['view_privacy'] == 1 ) echo 'selected="selected"'; ?> value="1"><?php echo $lang['comunidad_collecworld']; ?></option>

						</select>							

                    </td>

                </tr>

                <tr>

                    <td><?php echo $lang['settings_who_can_look_list']; ?></td>

                    <td>

                    	<select id="list-privacy" class="collections-input" onchange="list_privacy(<?php echo $datos_uc['id_users']; ?>)">

							<option <?php if ( $datos_uc['list_privacy'] == 0 ) echo 'selected="selected"'; ?> value="0"><?php echo $lang['publico']; ?></option>

                            <option <?php if ( $datos_uc['list_privacy'] == 1 ) echo 'selected="selected"'; ?> value="1"><?php echo $lang['amigos']; ?></option>

                            <option <?php if ( $datos_uc['list_privacy'] == 2 ) echo 'selected="selected"'; ?> value="2"><?php echo $lang['solo_yo']; ?></option>

						</select>							

                    </td>

                </tr>

				<tr>

                    <td><?php echo $lang['settings_who_can_contact_me']; ?></td>

                    <td>

                    	<select id="profile-privacy" class="collections-input" onchange="profile_privacy(<?php echo $datos_uc['id_users']; ?>);">

                        	<option <?php if ( $datos_uc['profile_privacy'] == 0 ) echo 'selected="selected"'; ?> ><?php echo $lang['publico']; ?></option>

                            <option <?php if ( $datos_uc['profile_privacy'] == 2 ) echo 'selected="selected"'; ?> ><?php echo $lang['amigos']; ?></option>

						</select>							

                    </td>

                </tr>

            </table>

			

        </div>

        

    	

    </div>
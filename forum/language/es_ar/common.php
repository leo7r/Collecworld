<?php
/** 
*
* common.php [Argentinian Spanish]
*
* @package language
* @version $Id: $
* @copyright (c) 2007 phpBB Group. Modified by nextgen for phpbbargentina.com in 2012-Jul-24
* @author 2007-11-26 - Traducido por Huan Manwe junto con phpbb-es.com (http://www.phpbb-es.com) basado en la version argentina hecha por larveando.com.ar ).
* @author - ImagePack made nextgen (Styles Team Leader of http://www.phpbbargentina.com)
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License 
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » " " …
//

$lang = array_merge($lang, array(
	'TRANSLATION_INFO'	=> 'Traducción al Español Argentino por <a href="http://www.phpbbargentina.com/">phpBB Argentina</a> con la colaboración de <a href="http://www.phpbb-es.com/">phpbb-es.com</a>',
	'DIRECTION'	=> 'ltr',
	'DATE_FORMAT'	=> '|d M Y|',
	'USER_LANG'	=> 'es-ar',
	
	'1_DAY'	=> '1 día',
	'1_MONTH'	=> '1 mes',
	'1_YEAR'	=> '1 año',
	'2_WEEKS'	=> '2 semanas',
	'3_MONTHS'	=> '3 meses',
	'6_MONTHS'	=> '6 meses',
	'7_DAYS'	=> '7 días',
	
	'ACCOUNT_ALREADY_ACTIVATED'	=> 'Tu cuenta ya ha sido activada',
	'ACCOUNT_DEACTIVATED'	=> 'Tu cuenta ha sido desactivada manualmente y solo puede ser reactivada por La Administración.',
	'ACCOUNT_NOT_ACTIVATED'	=> 'Tu cuenta todavía no ha sido activada',
	'ACP'	=> 'Ir al Panel de Administración (ACP)',
	'ACTIVE'	=> 'Activo',
	'ACTIVE_ERROR'	=> 'El usuario especificado está inactivo de momento. Si tenés problemas para activar tu cuenta por favor contacta con La Administración del Sitio.',
	'ADMINISTRATOR'	=> 'Administrador(a)',
	'ADMINISTRATORS'	=> 'Administradores',
	'AGE'	=> 'Edad',
	'AIM'	=> 'AIM',
	'ALLOWED'	=> 'Permitido',
	'ALL_FILES'	=> 'Todos los archivos',
	'ALL_FORUMS'	=> 'Todos los Foros',
	'ALL_MESSAGES'	=> 'Todos los mensajes',
	'ALL_POSTS'	=> 'Todos los mensajes',
	'ALL_TIMES'	=> 'Todos los horarios son %1$s %2$s',
	'ALL_TOPICS'	=> 'Todos los Temas',
	'AND'	=> 'Y',
	'ARE_WATCHING_FORUM'	=> 'Estás suscripto a recibir novedades en este Foro',
	'ARE_WATCHING_TOPIC'	=> 'Estás suscripto a recibir novedades en este Tema.',
	'ASCENDING'	=> 'Ascendente',
	'ATTACHMENTS'	=> 'Adjuntos',
	'ATTACHED_IMAGE_NOT_IMAGE'	=> 'El archivo de imagen que has intentado adjuntar no es válido.',
	'AUTHOR'	=> 'Autor',
	'AUTH_NO_PROFILE_CREATED'	=> 'Falló la creación del perfil de usuario',
	'AVATAR_DISALLOWED_CONTENT'		=> 'La subida fue rechazada porque el archivo a subir fue identificado como un posible vector de ataque.',
	'AVATAR_DISALLOWED_EXTENSION'	=> 'Este archivo no puede ser mostrado porque la extensión <strong>%s</strong> no está permitida',
	'AVATAR_EMPTY_REMOTE_DATA'	=> 'No se puede subir el avatar especificado ya que el archivo remoto parece inválido o corrupto.',
	'AVATAR_EMPTY_FILEUPLOAD'	=> 'El avatar subido está vacío.',
	'AVATAR_INVALID_FILENAME'	=> '%s es un nombre de archivo no válido',
	'AVATAR_NOT_UPLOADED'	=> 'No se puede subir el avatar.',
	'AVATAR_NO_SIZE'	=> 'No se pudo determinar el ancho o el alto del avatar enlazado, por favor ingresá estos datos de forma manual.',
	'AVATAR_PARTIAL_UPLOAD'	=> 'El archivo fue subido solo de forma parcial',
	'AVATAR_PHP_SIZE_NA'	=> 'El tamaño de archivo del avatar es muy grande.<br />No se puede determinar el tamaño máximo definido en php.ini por PHP.',
	'AVATAR_PHP_SIZE_OVERRUN'	=> 'El tamaño del avatar es muy grande. El tamaño máximo de subida es %1$d %2$s.<br />Por favor observa que esto está definido en php.ini y no puede ser cambiado.',
	'AVATAR_URL_INVALID'	=> 'La URL que especificaste no es válida.',
	'AVATAR_URL_NOT_FOUND'	=> 'No se puede encontrar el archivo especificado.',
	'AVATAR_WRONG_FILESIZE'	=> 'El avatar debe estar entre 0 y %1d %2s.',
	'AVATAR_WRONG_SIZE'	=> 'El avatar debe ser al menos %1$d pixels de ancho, %2$d pixels de alto y como máximo %3$d pixels de ancho y %4$d pixels de alto. El avatar enviado es %5$d pixels de ancho y %6$d pixels de alto.',
	
	'BACK_TO_TOP'	=> 'Arriba',
	'BACK_TO_PREV'	=> 'Regresa a la página anterior',
	'BAN_TRIGGERED_BY_EMAIL'	=> 'Esta exclusión ha sido impuesta a tu dirección de email.',
	'BAN_TRIGGERED_BY_IP'	=> 'Esta exclusión ha sido impuesta a tu dirección IP.',
	'BAN_TRIGGERED_BY_USER'	=> 'Esta exclusión ha sido impuesta a tu nombre de Usuario.',
	'BBCODE_GUIDE'	=> 'Guía BBCode',
	'BCC'	=> 'CCO',
	'BIRTHDAYS'	=> 'Cumpleaños',
	'BOARD_BAN_PERM'	=> 'Has sido expulsado <strong>permanentemente</strong> de este Sitio.<br /><br />Por favor contacta con %2$sLa Administración del Sitio%3$s para más información.',
	'BOARD_BAN_REASON'	=> 'Motivo de la exclusión: <strong>%s</strong>',
	'BOARD_BAN_TIME'	=> 'Has sido excluido de este Sitio hasta <strong>%1$s</strong>.<br /><br />Por favor contacta con %2$sLa Administración del Sitio%3$s para más información.',
	'BOARD_DISABLE'	=> 'Disculpe. Este Sitio no está disponible de momento',
	'BOARD_DISABLED'	=> 'Este Sitio está deshabilitado por ahora',
	'BOARD_UNAVAILABLE'	=> 'Disculpa. Este Sitio no está disponible por ahora, por favor intentalo de nuevo en unos minutos',
	'BROWSING_FORUM'      => 'Usuarios navegando por este Foro: %1$s',
	'BROWSING_FORUM_GUEST'	=> 'Usuarios navegando por este Foro: %1$s y %2$d invitado',
	'BROWSING_FORUM_GUESTS'	=> 'Usuarios navegando por este Foro: %1$s y %2$d invitados',
	'BYTES'	=> 'Bytes',
	
	'CANCEL'	=> 'Cancelar',
	'CHANGE'	=> 'Cambiar',
	'CHANGE_FONT_SIZE'	=> 'Cambiar tamaño de la fuente',
	'CHANGING_PREFERENCES'	=> 'Cambiando preferencias del foro',
	'CHANGING_PROFILE'	=> 'Cambiando preferencias del Perfil del Foro',
	'CLICK_VIEW_PRIVMSG'	=> '%sIr a tu Bandeja de Entrada%s',
	'COLLAPSE_VIEW'	=> 'Contraer vista',
	'CLOSE_WINDOW'	=> 'Cerrar ventana',
	'COLOUR_SWATCH'	=> 'Paleta de Colores',
	'COMMA_SEPARATOR'	=> ', ',
	'CONFIRM'	=> 'Confirma',
	'CONFIRM_CODE'	=> 'Código de confirmación',
	'CONFIRM_CODE_EXPLAIN'	=> 'Introduci el código exactamente como lo ve en la imagen. Las letras no son sensibles a las mayúsculas y minúsculas.',
	'CONFIRM_CODE_WRONG'	=> 'El código de confirmación que introdujiste es incorrecto.',
	'CONFIRM_OPERATION'	=> '¿Estás seguro de que deseas realizar esta operación?',
	'CONGRATULATIONS'	=> 'Felicidades para',
	'CONNECTION_FAILED'	=> 'Falló la conexión',
	'CONNECTION_SUCCESS'	=> '¡Conexión realizada correctamente!',
	'COOKIES_DELETED'	=> 'Todas las cookies del Sitio han sido borradas correctamente.',
	'CURRENT_TIME'	=> 'Fecha actual %s',
	
	'DAY'	=> 'Día',
	'DAYS'	=> 'Días',
	'DELETE'	=> 'Borrar',
	'DELETE_ALL'	=> 'Borrar todo',
	'DELETE_COOKIES'	=> 'Borrar todas las cookies del Sitio',
	'DELETE_MARKED'	=> 'Borrar marcados',
	'DELETE_POST'	=> 'Borrar mensaje',
	'DELIMITER'	=> 'Delimitador',
	'DESCENDING'	=> 'Descendente',
	'DISABLED'	=> 'Deshabilitado',
	'DISPLAY'	=> 'Mostrar',
	'DISPLAY_GUESTS'	=> 'Mostrar invitados',
	'DISPLAY_MESSAGES'	=> 'Mostrar mensajes previos',
	'DISPLAY_POSTS'	=> 'Mostrar mensajes previos',
	'DISPLAY_TOPICS'	=> 'Mostrar temas previos',
	'DOWNLOADED'	=> 'Descargado',
	'DOWNLOADING_FILE'	=> 'Descargando archivo',
	'DOWNLOAD_COUNT'	=> '%d vez',
	'DOWNLOAD_COUNTS'	=> '%d veces',
	'DOWNLOAD_COUNT_NONE'	=> 'Aún no descargado',
	'VIEWED_COUNT'	=> 'Visto %d vez',
	'VIEWED_COUNTS'	=> 'Visto %d veces',
	'VIEWED_COUNT_NONE'	=> 'No visto aún',
	
	'EDIT_POST'	=> 'Editar mensaje',
	'EMAIL'	=> 'E-mail', // Forma corta de EMAIL_ADDRESS (dirección de correo electrónico)
	'EMAIL_ADDRESS'	=> 'Dirección de email',
	'EMAIL_SMTP_ERROR_RESPONSE'	=> 'Se produjeron problemas enviando email en la <strong>línea %1$s</strong>. Respuesta: %2$s',
	'EMPTY_SUBJECT'	=> 'Debés especificar un asunto cuando publiques un nuevo tema.',
	'EMPTY_MESSAGE_SUBJECT'	=> 'Tenés que especificar un asunto cuando redactes un nuevo mensaje.',
	'ENABLED'	=> 'Habilitado',
	'ENCLOSURE'	=> 'Adjunto',
	'ENTER_USERNAME'					=> 'Introduci un nombre de usuario',	
	'ERR_CHANGING_DIRECTORY'	=> 'Imposible cambiar de carpeta',
	'ERR_CONNECTING_SERVER'	=> 'Error conectando al servidor',
	'ERR_JAB_AUTH'				=> 'No se puede autenticar en el servidor Jabber.',
	'ERR_JAB_CONNECT'			=> 'No se puede conectar al servidor Jabber.',
	'ERR_UNABLE_TO_LOGIN'	=> 'Error en identificación. El usuario o contraseña insertada es incorrecta.',
	'ERR_UNWATCHING'		=> 'Ocurrió un error al intentar dejar de seguir tema.',
	'ERR_WATCHING'			=> 'Ocurrió un error al intentar suscribirte.',
	'ERR_WRONG_PATH_TO_PHPBB'	=> 'La ruta phpBB introducida parece no ser válida.',
	'EXPAND_VIEW'	=> 'Expandir vista',
	'EXTENSION'	=> 'Extensión',
	'EXTENSION_DISABLED_AFTER_POSTING'	=> 'La extensión <strong>%s</strong> ha sido desactivada y no se mostrará en adelante',
	
	'FAQ'	=> 'FAQ',
	'FAQ_EXPLAIN'	=> 'Preguntas Frecuentes',
	'FILENAME'	=> 'Nombre',
	'FILESIZE'	=> 'Tamaño',
	'FILEDATE'	=> 'Fecha',
	'FILE_COMMENT'	=> 'Comentario',
	'FILE_NOT_FOUND'	=> 'No se puede encontrar el archivo requerido',
	'FIND_USERNAME'	=> 'Buscar un usuario',
	'FOLDER'	=> 'Carpeta',
	'FORGOT_PASS'	=> 'Olvidé mi contraseña',
	'FORM_INVALID'			=> 'El formulario enviado era no válido. Intentá enviarlo de nuevo.',
	'FORUM'	=> 'Foro',
	'FORUMS'	=> 'Foros',
	'FORUMS_MARKED'			=> 'Los foros han sido marcados como leídos.',
	'FORUM_CAT'	=> 'Categoría de Foro',
	'FORUM_INDEX'	=> 'Índice general',
	'FORUM_LINK'	=> 'Enlace al Foro',
	'FORUM_LOCATION'	=> 'Localización del foro',
	'FORUM_LOCKED'	=> 'Foro cerrado',
	'FORUM_RULES'	=> 'Reglas del Foro',
	'FORUM_RULES_LINK'	=> 'Por favor, hace clic para ver las reglas del Foro',
	'FROM'	=> 'De',
	'FSOCK_DISABLED'	=> 'No se puede completar la operación porque las funciones fsock han sido deshabilitadas o el servidor no está disponible.',
	'FSOCK_TIMEOUT'			=> 'Se agotó el tiempo de lectura de la corriente de red.',
	
	'FTP_FSOCK_HOST'	=> 'Servidor FTP Fsock',
	'FTP_FSOCK_HOST_EXPLAIN'	=> 'Servidor FTP Fsock empleado para conectar a tu sitio',
	'FTP_FSOCK_PASSWORD'	=> 'Contraseña FTP Fsock',
	'FTP_FSOCK_PASSWORD_EXPLAIN'	=> 'Contraseña para tu Usuario FTP Fsock',
	'FTP_FSOCK_PORT'	=> 'Puerto FTP Fsock',
	'FTP_FSOCK_PORT_EXPLAIN'	=> 'Puerto usado para conectar Fsock a tu servidor',
	'FTP_FSOCK_ROOT_PATH'	=> 'Ruta Fsock a phpBB',
	'FTP_FSOCK_ROOT_PATH_EXPLAIN'	=> 'Ruta Fsock absoluta (desde root) a tu sitio phpBB',
	'FTP_FSOCK_TIMEOUT'	=> 'FTP Fsock timeout',
	'FTP_FSOCK_TIMEOUT_EXPLAIN'	=> 'La cantidad de tiempo, en segundos, que el sistema espera una respuesta Fsock de tu servidor',
	'FTP_FSOCK_USERNAME'	=> 'Usuario FTP Fsock',
	'FTP_FSOCK_USERNAME_EXPLAIN'	=> 'Usuario para conectar a tu servidor FTP Fsock',
	
	'FTP_HOST'	=> 'Servidor FTP',
	'FTP_HOST_EXPLAIN'	=> 'Servidor FTP empleado para conectar a tu sitio',
	'FTP_PASSWORD'	=> 'Contraseña FTP',
	'FTP_PASSWORD_EXPLAIN'	=> 'Contraseña para tu Usuario FTP',
	'FTP_PORT'	=> 'Puerto FTP',
	'FTP_PORT_EXPLAIN'	=> 'Puerto usado para conectar a tu servidor',
	'FTP_ROOT_PATH'	=> 'Ruta a phpBB',
	'FTP_ROOT_PATH_EXPLAIN'	=> 'Ruta absoluta (desde root) a tu sitio phpBB',
	'FTP_TIMEOUT'	=> 'FTP timeout',
	'FTP_TIMEOUT_EXPLAIN'	=> 'La cantidad de tiempo, en segundos, que el sistema espera una respuesta de tu servidor',
	'FTP_USERNAME'	=> 'Usuario FTP',
	'FTP_USERNAME_EXPLAIN'	=> 'Usuario para identificarte en tu servidor FTP',
	
	'GENERAL_ERROR'	=> 'Error General',	
    'GB'	=> 'GB',
    'GIB'	=> 'GiB',
	'GO'	=> 'Ir',
	'GOTO_PAGE'	=> 'Ir a página',
	'GROUP'	=> 'Grupo',
	'GROUPS'	=> 'Grupos',
	'GROUP_ERR_TYPE'	=> 'Tipo de grupo inapropiado.',
	'GROUP_ERR_USERNAME'	=> 'No se especificó nombre de grupo.',
	'GROUP_ERR_USER_LONG'	=> 'El nombre del grupo es muy largo.',
	'GUEST'	=> 'Invitado',
	'GUEST_USERS_ONLINE'	=> 'Hasy %d invitados identificados',
	'GUEST_USERS_TOTAL'	=> '%d invitados',
	'GUEST_USERS_ZERO_ONLINE'	=> 'Hasy 0 invitados identificados',
	'GUEST_USERS_ZERO_TOTAL'	=> '0 invitados',
	'GUEST_USER_ONLINE'	=> 'Hasy %d invitado identificado',
	'GUEST_USER_TOTAL'	=> '%d invitado',
	'G_ADMINISTRATORS'	=> 'Administradores',
	'G_BOTS'	=> 'Bots',
	'G_GUESTS'	=> 'Invitados',
	'G_REGISTERED'	=> 'Usuarios registrados',
	'G_REGISTERED_COPPA'	=> 'Usuarios APPCO (COPPA) registrados',
	'G_GLOBAL_MODERATORS'	=> 'Moderadores globales',
	'G_NEWLY_REGISTERED'		=> 'Nuevos Usuarios Registrados',
	
	'HIDDEN_USERS_ONLINE'	=> '%d usuarios ocultos identificados',
	'HIDDEN_USERS_TOTAL'	=> '%d ocultos',
	'HIDDEN_USERS_TOTAL_AND'      => '%d ocultos y ',
	'HIDDEN_USERS_ZERO_ONLINE'	=> '0 usuarios ocultos identificados',
	'HIDDEN_USERS_ZERO_TOTAL'	=> '0 ocultos',
	'HIDDEN_USERS_ZERO_TOTAL_AND'   => '0 ocultos y ',
	'HIDDEN_USER_ONLINE'	=> '%d usuario oculto identificado',
	'HIDDEN_USER_TOTAL'	=> '%d oculto',
	'HIDDEN_USER_TOTAL_AND'	=> '%d oculto y ',
	'HIDE_GUESTS'	=> 'Ocultar invitados',
	'HIDE_ME'	=> 'Ocultar mi estado de conexión en esta sesión',
	'HOURS'	=> 'Horas',
	'HOME'	=> 'Home',
	
	'ICQ'	=> 'ICQ',
	'ICQ_STATUS'	=> 'ICQ status',
	'IF'	=> 'si',
	'IMAGE'	=> 'Imagen',
	'IMAGE_FILETYPE_INVALID'	=> 'Tipo de archivo de imagen %d de tipo mime %s no soportado.',
	'IMAGE_FILETYPE_MISMATCH'	=> 'Tipo de archivo no concuerda: se esperaba la extensión %1$s pero se proporciona la extensión %2$s.',
	'IN'	=> 'en',
	'INDEX'	=> 'Página principal',
	'INFORMATION'	=> 'Información',
	'INTERESTS'	=> 'Aficiones',
	'INVALID_DIGEST_CHALLENGE'	=> 'Digest challenge inválido',
	'INVALID_EMAIL_LOG'	=> '¿<strong>%s</strong> posiblemente una dirección de email inválida?',
	'IP'	=> 'IP',
	'IP_BLACKLISTED'	=> 'Tu IP %1$s ha sido bloqueada porque está en la lista negra. Para más detalles por favor leé <a href="%2$s">%2$s</a>.',
	
	'JABBER'	=> 'Jabber',
	'JOINED'	=> 'Registrado',
	'JUMP_PAGE'	=> 'Introducí el número de página al que deseas saltar',
	'JUMP_TO'	=> 'Saltar a',
	'JUMP_TO_PAGE'	=> 'Clic para saltar a página…',
	
	'KB'	=> 'KB',
	'KIB'	=> 'KiB',
	
	'LAST_POST'	=> 'Último mensaje',
	'LAST_UPDATED'	=> 'Ultima actualización',
	'LAST_VISIT'	=> 'La última visita fue',
	'LDAP_NO_LDAP_EXTENSION'	=> 'Extensión LDAP no disponible',
	'LDAP_NO_SERVER_CONNECTION'	=> 'No se puede conectar al servidor LDAP',
	'LDAP_SEARCH_FAILED'            => 'Ocurrió un error mientras se buscaba en el directorio LDAP.',
	'LEGEND'	=> 'Referencia',
	'LOCATION'	=> 'Ubicación',
	'LOCK_POST'	=> 'Mensaje cerrado',
	'LOCK_POST_EXPLAIN'	=> 'Prevenir edición',
	'LOCK_TOPIC'	=> 'Tema cerrado',
	'LOGIN'	=> 'Identificarte',
	'LOGIN_CHECK_PM'	=> 'Autentifícate para leer tus mensajes privados',
	'LOGIN_CONFIRMATION'	=> 'Confirmación de conexión',
	'LOGIN_CONFIRM_EXPLAIN'	=> 'Para prevenir el forzado de cuentas La Administración del Sitio se requiere que introduzcas un código de confirmación después de una cantidad máxima de identificaciones fallidas. El código se muestra en la imagen que deberías ver debajo. Si estás impedido visualmente o por cualquier motivo no podes leer ese código por favor contacta con %sLa Administración del Sitio%s.', //no usado
	'LOGIN_ERROR_ATTEMPTS'	=> 'Has excedido el número máximo permitido de intentos de identificarte. Además de tu nombre de usuario y contraseña ahora también tendrá que resolver el CAPTCHA de abajo.',
	'LOGIN_ERROR_EXTERNAL_AUTH_APACHE'	=> 'No has sido autenticado por Apache.',
	'LOGIN_ERROR_PASSWORD'	=> 'Has especificado una contraseña incorrecta. Por favor verifica tu contraseña e inténtalo de nuevo. Si continúas teniendo problemas, por favor contactá con %sLa Administración del Sitio%s.',
	'LOGIN_ERROR_PASSWORD_CONVERT'	=> 'No fue posible convertir tu contraseña cuando se actualizó el software de este Sitio. Por favor %ssolicitá nueva contraseña%s. Si sigues teniendo problemas por favor contacta con %sLa Administración del Sitio%s.',
	'LOGIN_ERROR_USERNAME'	=> 'Has especificado un nombre de usuario incorrecto. Por favor verifica tu nombre de usuario e inténtalo de nuevo. Si continúas teniendo problemas, por favor contactá con %sLa Administración del Sitio%s.',
	'LOGIN_FORUM'	=> 'Para ver o publicar en este foro debes introducir la contraseña.',
	'LOGIN_INFO'	=> 'Para autenticarte debes estar registrado. Registrarte tomará solo unos pocos segundos y te permitirá un amplio acceso al sistema. La Administración del Sitio puede además otorgar permisos adicionales a los usuarios registrados. Antes de identificarte asegúrate de estar familiarizado con nuestros términos de uso y políticas relacionadas. Por favor lee las reglas de los foros mientras navegás por el Sitio.',
	'LOGIN_VIEWFORUM'	=> 'La Administración del Sitio requiere que estés registrado y te hayas identificado para ver este foro.',
	'LOGIN_EXPLAIN_EDIT'	=> 'Para editar mensajes en este foro debes estar registrado e identificado.',
	'LOGIN_EXPLAIN_VIEWONLINE'	=> 'Para ver la lista en línea debes estar registrado e identificado.',
	'LOGOUT'	=> 'Desconectarte',
	'LOGOUT_USER'	=> 'Desconectarte [ %s ]',
	'LOG_ME_IN'	=> 'Identificarte automáticamente en cada visita',
	
	'MARK'	=> 'Marcar',
	'MARK_ALL'	=> 'Marcar todo',
	'MARK_FORUMS_READ'	=> 'Marcar todos los Foros como leídos',
	'MARK_SUBFORUMS_READ'	=> 'Marcar todos los subforos como leídos',	
	'MB'	=> 'MB',
	'MIB'	=> 'MiB',
	'MCP'	=> 'Panel de Control de Moderador',
	'MEMBERLIST'	=> 'Usuarios',
	'MEMBERLIST_EXPLAIN'	=> 'Ver lista completa de usuarios',
	'MERGE'	=> 'Unir',
	'MERGE_POSTS'			=> 'Mover mensajes',
	'MERGE_TOPIC'	=> 'Unir tema',
	'MESSAGE'	=> 'Mensaje',
	'MESSAGES'	=> 'Mensajes',
	'MESSAGE_BODY'	=> 'Cuerpo del mensaje',
	'MINUTES'	=> 'Minutos',
	'MODERATE'	=> 'Moderar',
	'MODERATOR'	=> 'Moderador',
	'MODERATORS'	=> 'Moderadores',
	'MONTH'	=> 'Mes',
	'MOVE'	=> 'Mover',
	'MSNM'	=> 'MSNM/WLM',
	
	'NA'	=> 'No especificado',
	'NEWEST_USER'	=> 'Nuestro Miembro más reciente es <strong>%s</strong>',
	'NEW_MESSAGE'	=> 'Nuevo mensaje',
	'NEW_MESSAGES'	=> 'Nuevo mensajes',
	'NEW_PM'	=> '<strong>%d</strong> nuevo mensaje privado',
	'NEW_PMS'	=> '<strong>%d</strong> nuevos mensajes privados',
	'NEW_POST'	=> 'Nuevo mensaje',   // No usado más
	'NEW_POSTS'	=> 'Nuevos mensajes',   // No usado más
	'NEXT'	=> 'Siguiente',
	'NEXT_STEP'	=> 'Siguiente',
	'NEVER'	=> 'Nunca',
	'NO'	=> 'No',
	'NOT_ALLOWED_MANAGE_GROUP'	=> 'No tenés permitido administrar este grupo desde el "Panel de Administración (ACP)".',
	'NOT_AUTHORISED'	=> 'No estás autorizado para acceder a este área.',
	'NOT_WATCHING_FORUM'	=> 'Ya no estás suscripto a novedades en este Foro.',
	'NOT_WATCHING_TOPIC'	=> 'Ya no estás suscripto a este tema.',
	'NOTIFY_ADMIN'	=> 'Por favor notificá a La Administración del Sitio o webmaster.',
	'NOTIFY_ADMIN_EMAIL'	=> 'Por favor notifica a La Administración del Sitio o webmaster: <a href="mailto:%1$s">%1$s</a>',
	'NO_ACCESS_ATTACHMENT'	=> 'No te está permitido acceder a este archivo.',
	'NO_ACTION'	=> 'No se especificó ninguna acción.',
	'NO_ADMINISTRATORS'	=> 'No hay administradores.',
	'NO_AUTH_ADMIN'	=> 'No tenés permisos administrativos y por lo tanto no se te permite acceder al Panel de Administración (ACP).',
	'NO_AUTH_ADMIN_USER_DIFFER'	=> 'No podes reidentificarte como un usuario distinto.',
	'NO_AUTH_OPERATION'	=> 'No tenés los permisos necesarios para completar la operación.',
	'NO_CONNECT_TO_SMTP_HOST'	=> 'No se puede conectar al servidor smtp: %s : %s',
	'NO_BIRTHDAYS'	=> 'Hoy sin cumpleaños',
	'NO_EMAIL_MESSAGE'	=> 'El mensaje de email estaba en blanco',
	'NO_EMAIL_RESPONSE_CODE'	=> 'No se puede obtener los códigos de respuesta del servidor de email',
	'NO_EMAIL_SUBJECT'	=> 'Email sin asunto',
	'NO_FEED_ENABLED'	=> 'Los Feeds no están disponibles en este Sitio.',
	'NO_FEED'	=> 'El Feed pedido no está disponible.',
	'NO_FORUM'	=> 'El Foro que seleccionó no existe.',
	'NO_FORUMS'	=> 'Este Sitio no tiene Foros',
	'NO_GROUP'	=> 'El grupo solicitado no existe.',
	'NO_GROUP_MEMBERS'	=> 'Este grupo actualmente no tiene usuarios',
	'NO_IPS_DEFINED'	=> 'No se definieron direcciones IP o nombres de servidor',
	'NO_MEMBERS'	=> 'No se encontraron usuarios para este criterio de búsqueda',
	'NO_MESSAGES'	=> 'No hay mensajes',
	'NO_MODE'	=> 'No se especificó el modo.',
	'NO_MODERATORS'	=> 'No hay moderadores.',
	'NO_NEW_MESSAGES'	=> 'No hay nuevos mensajes',
	'NO_NEW_PM'	=> '<strong>0</strong> mensajes privados',
	'NO_NEW_POSTS'	=> 'No hay nuevos mensajes',   // No usado más
	'NO_ONLINE_USERS'	=> 'No hay usuarios registrados visitando el Foro',
	'NO_POSTS'	=> 'No hay mensajes',
	'NO_POSTS_TIME_FRAME'	=> 'No existen mensajes en este tema dentro del intervalo de tiempo seleccionado.',
	'NO_SUBJECT'	=> 'No se ha especificado el asunto',
	'NO_SUCH_SEARCH_MODULE'	=> 'El módulo de búsqueda especificado no existe',
	'NO_SUPPORTED_AUTH_METHODS'	=> 'Métodos de autentificación no soportados',
	'NO_TOPIC'	=> 'El tema requerido no existe.',
	'NO_TOPIC_FORUM'			=> 'El tema o foro ya no existe.',
	'NO_TOPICS'	=> 'No hay temas o mensajes en este foro.',
	'NO_TOPICS_TIME_FRAME'	=> 'No existen temas en este foro dentro del intervalo de tiempo seleccionado.',
	'NO_UNREAD_PM'	=> '<strong>0</strong> mensajes sin leer',
	'NO_UNREAD_POSTS'         => 'No hay mensajes sin leer',
	'NO_UPLOAD_FORM_FOUND'	=> 'Subida iniciada, pero no se encontró un formulario de subida válido.',
	'NO_USER'	=> 'El Usuario requerido no existe.',
	'NO_USERS'	=> 'Los Usuarios requeridos no existen.',
	'NO_USER_SPECIFIED'	=> 'No se especificó un nombre de usuario',
	// Nullar/Singular/Plural language entry. The key numbers define the number range in which a certain grammatical expression is valid.
	'NUM_POSTS_IN_QUEUE'		=> array(
		0			=> 'Sin mensajes en espera',		// 0
		1			=> '1 mensaje en espera',		// 1
		2			=> '%d mensajes en espera',		// 2+
	),
	
	'OCCUPATION'	=> 'Ocupación',
	'OFFLINE'	=> 'Desconectado',
	'ONLINE'	=> 'Conectado',
	'ONLINE_BUDDIES'	=> 'Amigos identificados',
	'ONLINE_USERS_TOTAL'	=> 'Hasy <strong>%d</strong> Usuarios identificados :: ',
	'ONLINE_USERS_ZERO_TOTAL'	=> 'En total hay <strong>0</strong> Usuarios identificados :: ',
	'ONLINE_USER_TOTAL'	=> 'En total hay <strong>%d</strong> Usuario identificado :: ',
	'OPTIONS'	=> 'Opciones',
	
	'PAGE_OF'	=> 'Página <strong>%1$d</strong> de <strong>%2$d</strong>',
	'PASSWORD'	=> 'Contraseña',
	'PIXEL'					=> 'px',
	'PLAY_QUICKTIME_FILE'	=> 'Reproducir archivo Quicktime',
	'PM'	=> 'MP',
	'PM_REPORTED'	=> 'Hace clic para ver el informe',
	'POSTING_MESSAGE'	=> 'Enviando mensaje en %s',
	'POSTING_PRIVATE_MESSAGE'	=> 'Escribiendo mensaje privado',
	'POST'	=> 'Nota',
	'POST_ANNOUNCEMENT'	=> 'Anuncio',
	'POST_STICKY'	=> 'Fijo',
	'POSTED'	=> 'Publicado',
	'POSTED_IN_FORUM'	=> 'en',
	'POSTED_ON_DATE'	=> 'el',
	'POSTS'	=> 'Mensajes',
	'POSTS_UNAPPROVED'	=> 'Al menos un mensaje en este tema no ha sido aprobado',
	'POST_BY_AUTHOR'	=> 'por',
	'POST_BY_FOE' => 'Este mensaje lo ha escrito <strong>%1$s</strong> que actualmente está en su lista de ignorados. %2$sMostrar este mensaje%3$s.',
	'POST_DAY'	=> '%.2f mensajes por día',
	'POST_DETAILS'	=> 'Detalles del mensaje',
	'POST_NEW_TOPIC'	=> 'Nuevo tema',
	'POST_PCT'	=> '%.2f%% de todos los mensajes',
	'POST_PCT_ACTIVE'	=> '%.2f%% de mensajes de usuarios',
	'POST_PCT_ACTIVE_OWN'	=> '%.2f%% de sus mensajes',
	'POST_REPLY'	=> 'Publicar una respuesta',
	'POST_REPORTED'	=> 'Clic para ver informe',
	'POST_SUBJECT'	=> 'Asunto',
	'POST_TIME'	=> 'Fecha publicación',
	'POST_TOPIC'	=> 'Publicar un nuevo tema',
	'POST_UNAPPROVED'	=> 'Este mensaje espera aprobación',
	'POWERED_BY'			=> 'Powered by %s',
	'PREVIEW'	=> 'Vista previa',
	'PREVIOUS'	=> 'Anterior',
	'PREVIOUS_STEP'	=> 'Anterior',
	'PRIVACY'	=> 'Política de privacidad',
	'PRIVATE_MESSAGE'	=> 'Mensaje privado',
	'PRIVATE_MESSAGES'	=> 'Mensajes privados',
	'PRIVATE_MESSAGING'	=> 'Mensajería privada',
	'PROFILE'	=> 'Panel de Control del Usuario',
	'RANK'						=> 'Rango',
	
	'READING_FORUM'	=> 'Viendo temas en %s',
	'READING_GLOBAL_ANNOUNCE'	=> 'Leyendo anuncios globales',
	'READING_LINK'	=> 'Siguiendo enlace-forum %s',
	'READING_TOPIC'	=> 'Leyendo tema en %s',
	'READ_PROFILE'	=> 'Perfil',
	'REASON'	=> 'Razón',
	'RECORD_ONLINE_USERS'	=> 'La mayor cantidad de usuarios identificados fue <strong>%1$s</strong> el %2$s',
	'REDIRECT'	=> 'Redirección',
	'REDIRECTS'	=> 'Total redirecciones',
	'REGISTER'	=> 'Registrarte',
	'REGISTERED_USERS'	=> 'Usuarios registrados:',
	'REG_USERS_ONLINE'	=> 'Hasy %d usuarios registrados y ',
	'REG_USERS_TOTAL'	=> '%d registrados, ',
	'REG_USERS_TOTAL_AND'      => '%d registrados y ',
	'REG_USERS_ZERO_ONLINE'	=> 'Hasy 0 usuarios registrados y ',
	'REG_USERS_ZERO_TOTAL'	=> '0 registrado, ',
	'REG_USERS_ZERO_TOTAL_AND'	=> '0 registrado y ',
	'REG_USER_ONLINE'	=> 'Hasy %d usuario registrado y ',
	'REG_USER_TOTAL'	=> '%d registrado, ',
	'REG_USER_TOTAL_AND'	=> '%d registrado y ',
	'REMOVE'	=> 'Eliminar',
	'REMOVE_INSTALL'	=> 'Por favor borra, mueve o renombra la carpeta <strong>install</strong> antes de usar tu foro. Si este directorio aún está presente solo será accesible el Panel de Administración (ACP).',
	'REPLIES'	=> 'Respuestas',
	'REPLY_WITH_QUOTE'	=> 'Responder citando',
	'REPLYING_GLOBAL_ANNOUNCE'	=> 'Respondiendo anuncio global',
	'REPLYING_MESSAGE'	=> 'Respondiendo mensaje en %s',
	'REPORT_BY'	=> 'Reportado por',
	'REPORT_POST'	=> 'Reporte este mensaje',
	'REPORTING_POST'	=> 'Reportando mensaje',
	'RESEND_ACTIVATION'	=> 'Reenviar email de activación',
	'RESET'	=> 'Limpiar',
	'RESTORE_PERMISSIONS'	=> 'Restaurar permisos',
	'RETURN_INDEX'	=> '%sVolver a la página principal%s',
	'RETURN_FORUM'	=> '%sVolver al último foro visitado%s',
	'RETURN_PAGE'	=> '%sVolver a la página anterior%s',
	'RETURN_TOPIC'	=> '%sVolver al último tema visitado%s',
	'RETURN_TO'	=> 'Volver a',
	'FEED'						=> 'Feed',
	'FEED_NEWS'					=> 'Noticias',
	'FEED_TOPICS_ACTIVE'		=> 'Temas Activos',
	'FEED_TOPICS_NEW'			=> 'Nuevos Temas',
	'RULES_ATTACH_CAN'	=> '<strong>Podes</strong> enviar adjuntos en este Foro',
	'RULES_ATTACH_CANNOT'	=> '<strong>No podes</strong> enviar adjuntos en este Foro',
	'RULES_DELETE_CAN'	=> '<strong>Podes</strong> borrar tus mensajes en este Foro',
	'RULES_DELETE_CANNOT'	=> '<strong>No podes</strong> borrar tus mensajes en este Foro',
	'RULES_DOWNLOAD_CAN'	=> '<strong>Podes</strong> descargar adjuntos en este Foro',
	'RULES_DOWNLOAD_CANNOT'	=> '<strong>No podes</strong> descargar adjuntos en este Foro',
	'RULES_EDIT_CAN'	=> '<strong>Podés</strong> editar tus mensajes en este Foro',
	'RULES_EDIT_CANNOT'	=> '<strong>No podes</strong> editar tus mensajes en este Foro',
	'RULES_LOCK_CAN'	=> '<strong>Podes</strong> bloquear tus temas en este Foro',
	'RULES_LOCK_CANNOT'	=> '<strong>No podes</strong> bloquear tus temas en este Foro',
	'RULES_POST_CAN'	=> '<strong>Podes</strong> abrir nuevos temas en este Foro',
	'RULES_POST_CANNOT'	=> '<strong>No podes</strong> abrir nuevos temas en este Foro',
	'RULES_REPLY_CAN'	=> '<strong>Podes</strong> responder a temas en este Foro',
	'RULES_REPLY_CANNOT'	=> '<strong>No podes</strong> responder a temas en este Foro',
	'RULES_VOTE_CAN'	=> '<strong>Podes</strong> votar en encuestas en este Foro',
	'RULES_VOTE_CANNOT'	=> '<strong>No podes</strong> votar en encuestas en este Foro',
	
	'SEARCH'	=> 'Buscar',
	'SEARCH_MINI'	=> 'Buscar…',
	'SEARCH_ADV'	=> 'Búsqueda avanzada',
	'SEARCH_ADV_EXPLAIN'	=> 'Ver opciones de búsqueda avanzada',
	'SEARCH_KEYWORDS'	=> 'Buscar palabras clave',
	'SEARCHING_FORUMS'	=> 'Buscando Foros',
	'SEARCH_ACTIVE_TOPICS'	=> 'Ver temas activos',
	'SEARCH_FOR'	=> 'Buscar',
	'SEARCH_FORUM'	=> 'Buscar en este Foro…',
	'SEARCH_NEW'	=> 'Buscar mensajes nuevos',
	'SEARCH_POSTS_BY'	=> 'Buscar mensajes por',
	'SEARCH_SELF'	=> 'Buscar tus mensajes',
	'SEARCH_TOPIC'	=> 'Buscar este tema…',
	'SEARCH_UNANSWERED'	=> 'Buscar temas sin respuesta',
	'SEARCH_UNREAD'				=> 'Ver mensajes no leídos',
    'SEARCH_USER_POSTS'			=> 'Buscar mensajes del usuario',	
	'SECONDS'	=> 'Segundos',
	'SELECT'	=> 'Seleccioná',
	'SELECT_ALL_CODE'	=> 'Seleccionar todo',
	'SELECT_DESTINATION_FORUM'	=> 'Por favor selecciona un Foro de destino',
	'SELECT_FORUM'	=> 'Seleccioná un Foro',
	'SEND_EMAIL'	=> 'Email',		// Usado en los botones de enviar
	'SEND_EMAIL_USER'	=> 'E-mail',
	'SEND_PRIVATE_MESSAGE'	=> 'Enviar mensaje privado',
	'SETTINGS'	=> 'Preferencias',
	'SIGNATURE'	=> 'Firma',
	'SKIP'	=> 'Obviar',
	'SMTP_NO_AUTH_SUPPORT'	=> 'El Servidor SMTP no soporta autentificación',
	'SORRY_AUTH_READ'	=> 'No estás autorizado a leer este foro',
	'SORRY_AUTH_VIEW_ATTACH'	=> 'No estás autorizado a descargar este adjunto',
	'SORT_BY'	=> 'Ordenar por',
	'SORT_JOINED'	=> 'Fecha de ingreso',
	'SORT_LOCATION'	=> 'Ubicación',
	'SORT_POSTS'	=> 'Mensajes',
	'SORT_RANK'	=> 'Rango',
	'SORT_TOPIC_TITLE'	=> 'Título del Tema',
	'SORT_USERNAME'	=> 'Nombre de Usuario',
	'SPLIT_TOPIC'	=> 'Dividir tema',
	'SQL_ERROR_OCCURRED'	=> 'Ocurrió un error SQL mientras recuperaba esta página. Por favor contacta con La Administración del Sitio%s si el problema persiste.',
	'STATISTICS'	=> 'Estadísticas',
	'START_WATCHING_FORUM'	=> 'Suscribir Foro',
	'START_WATCHING_TOPIC'	=> 'Suscribir Tema',
	'STOP_WATCHING_FORUM'	=> 'Cancelar suscripción al Foro',
	'STOP_WATCHING_TOPIC'	=> 'No seguir Tema',
	'SUBFORUM'	=> 'Subforo',
	'SUBFORUMS'	=> 'Subforos',
	'SUBJECT'	=> 'Asunto',
	'SUBMIT'	=> 'Enviar',
	
	'TERMS_USE'	=> 'Condiciones de uso',
	'TEST_CONNECTION'	=> 'Probar conexión',
	'THE_TEAM'	=> 'El Equipo',
	'TIME'	=> 'Hora',
	'TOO_LARGE'		=> 'El valor que has introducido es demasiado grande.',
	'TOO_LARGE_MAX_RECIPIENTS'		=> 'El valor de la configuración de <strong>Número máximo de destinatarios permitidos por mensaje privado</strong> que has introducido es demasiado grande.',
	'TOO_LONG'		=> 'El valor que introdujiste es demasiado largo.',
	
	'TOO_LONG_AIM'	=> 'El apodo AIM que introdujiste es muy largo.',
	'TOO_LONG_CONFIRM_CODE'	=> 'El código de confirmación que introdujiste es muy largo.',
	'TOO_LONG_DATEFORMAT'=> 'El formato de fecha que introdujiste es demasiado largo.',
	'TOO_LONG_ICQ'	=> 'El número de ICQ que introdujiste es muy largo.',
	'TOO_LONG_INTERESTS'	=> 'La lista de aficiones que introdujiste es muy larga.',
	'TOO_LONG_JABBER'	=> 'La cuenta Jabber que introdujiste es muy larga.',
	'TOO_LONG_LOCATION'	=> 'La ubicación que introdujiste es muy larga.',
	'TOO_LONG_MSN'	=> 'El nombre MSNM/WLM que introdujiste es muy largo.',
	'TOO_LONG_NEW_PASSWORD'	=> 'La nueva contraseña que introdujiste es muy larga.',
	'TOO_LONG_OCCUPATION'	=> 'La ocupación que introdujiste es muy larga.',
	'TOO_LONG_PASSWORD_CONFIRM'	=> 'La confirmación de contraseña que introdujiste es muy larga.',
	'TOO_LONG_USER_PASSWORD'	=> 'La contraseña que introdujiste es muy larga.',
	'TOO_LONG_USERNAME'	=> 'El nombre de usuario que introdujiste es muy largo.',
	'TOO_LONG_EMAIL'	=> 'La dirección de email que introdujiste es muy larga.',
	'TOO_LONG_EMAIL_CONFIRM'	=> 'La confirmación de email que introdujiste es muy larga.',
	'TOO_LONG_WEBSITE'	=> 'La dirección de website que introdujiste es muy larga.',
	'TOO_LONG_YIM'	=> 'El nombre de Yahoo! Messenger que introdujiste es muy largo.',
	
	'TOO_MANY_VOTE_OPTIONS'	=> 'Has tratado de votar demasiadas opciones.',
	'TOO_SHORT'			=> 'El valor que introdujiste es demasiado corto.',
	
	'TOO_SHORT_AIM'	=> 'El apodo AIM que introdujiste es muy corto.',
	'TOO_SHORT_CONFIRM_CODE'	=> 'El Código de confirmación que introdujiste es muy corto.',
	'TOO_SHORT_DATEFORMAT'	=> 'El formato de fecha que introdujiste es demasiado corto.',
	'TOO_SHORT_ICQ'	=> 'El número de ICQ que introdujiste es muy corto.',
	'TOO_SHORT_INTERESTS'	=> 'La lista de aficiones que introdujiste es muy corta.',
	'TOO_SHORT_JABBER'	=> 'La cuenta Jabber que introdujiste es muy corta.',
	'TOO_SHORT_LOCATION'	=> 'La ubicación que introdujiste es muy corta.',
	'TOO_SHORT_MSN'	=> 'El nombre MSNM/WLM que introdujiste es muy corto.',
	'TOO_SHORT_NEW_PASSWORD'	=> 'La nueva contraseña que introdujiste es muy corta.',
	'TOO_SHORT_OCCUPATION'	=> 'La ocupación que introdujiste es muy corta.',
	'TOO_SHORT_PASSWORD_CONFIRM'	=> 'La confirmación de contraseña que introdujiste es muy corta.',
	'TOO_SHORT_USER_PASSWORD'	=> 'La contraseña que introdujiste es muy corta.',
	'TOO_SHORT_USERNAME'	=> 'El nombre de usuario que introdujiste es muy corto.',
	'TOO_SHORT_EMAIL'	=> 'La dirección de email que introdujiste es muy corta.',
	'TOO_SHORT_EMAIL_CONFIRM'	=> 'La confirmación de email que introdujiste es muy corta.',
	'TOO_SHORT_WEBSITE'	=> 'La dirección de website que introdujiste es muy corta.',
	'TOO_SHORT_YIM'	=> 'El nombre de Yahoo! Messenger que introdujiste es muy corto.',
	'TOO_SMALL'		=> 'El valor que ha introducido es demasiado pequeño.',
	'TOO_SMALL_MAX_RECIPIENTS'		=> 'El valor de la configuración de <strong>Número máximo de destinatarios permitidos por mensaje privado</strong> que has introducido es demasiado pequeño.',
	
	'TOPIC'	=> 'Tema',
	'TOPICS'	=> 'Temas',
	'TOPICS_UNAPPROVED'	=> 'Al menos un tema en este foro no ha sido aprobado.',
	'TOPIC_ICON'	=> 'Icono del tema',
	'TOPIC_LOCKED'	=> 'Este tema está cerrado, no podes editar mensajes o enviar nuevas respuestas',
	'TOPIC_LOCKED_SHORT'=> 'Tema cerrado',
	'TOPIC_MOVED'	=> 'Tema movido',
	'TOPIC_REVIEW'	=> 'Revisión de tema',
	'TOPIC_TITLE'	=> 'Título del tema',
	'TOPIC_UNAPPROVED'	=> 'Este tema no ha sido aprobado',
	'TOTAL_ATTACHMENTS'	=> 'Adjunto(s)',
	'TOTAL_LOG'	=> '1 registro',
	'TOTAL_LOGS'	=> '%d registros',
	'TOTAL_NO_PM'	=> '0 mensaje privado en total',
	'TOTAL_PM'	=> '1 mensaje privado en total',
	'TOTAL_PMS'	=> '%d mensajes privados en total',
	'TOTAL_POSTS'	=> 'Mensajes totales',
	'TOTAL_POSTS_OTHER'	=> 'Mensajes totales <strong>%d</strong>',
	'TOTAL_POSTS_ZERO'	=> 'Mensajes totales <strong>0</strong>',
	'TOPIC_REPORTED'	=> 'Se ha informado de este tema',
	'TOTAL_TOPICS_OTHER'	=> 'Temas totales <strong>%d</strong>',
	'TOTAL_TOPICS_ZERO'	=> 'Temas totales <strong>0</strong>',
	'TOTAL_USERS_OTHER'	=> 'Usuarios totales <strong>%d</strong>',
	'TOTAL_USERS_ZERO'	=> 'Usuarios totales <strong>0</strong>',
	'TRACKED_PHP_ERROR'	=> 'Tracked PHP errors: %s',
	
	'UNABLE_GET_IMAGE_SIZE'	=> 'El acceso a la imagen no es posible o el archivo no es una imagen válida.',
	'UNABLE_TO_DELIVER_FILE'	=> 'Imposible enviar archivo.',
	'UNKNOWN_BROWSER'	=> 'Navegador desconocido',
	'UNMARK_ALL'	=> 'Desmarcar todos',
	'UNREAD_MESSAGES'	=> 'Mensajes sin leer',
	'UNREAD_PM'	=> '<strong>%d</strong> mensaje sin leer',
	'UNREAD_PMS'	=> '<strong>%d</strong> mensajes sin leer',
	'UNREAD_POST'		=> 'Mensaje sin leer',
	'UNREAD_POSTS'		=> 'Mensajes sin leer',
	'UNWATCH_FORUM_CONFIRM'		=> '¿Seguro que deseas cancelar tu suscripción de este foro?',
	'UNWATCH_FORUM_DETAILED'	=> '¿Seguro que deseas cancelar tu suscripción del foro “%s”?',
	'UNWATCH_TOPIC_CONFIRM'		=> '¿Seguro que deseas cancelar tu suscripción de este tema?',
	'UNWATCH_TOPIC_DETAILED'	=> '¿Seguro que deseas cancelar tu suscripción del tema “%s”?',	
	'UNWATCHED_FORUMS'	=> 'Ya no estás suscripto a los Foros seleccionados.',
	'UNWATCHED_TOPICS'	=> 'Ya no estás suscripto a los Temas seleccionados.',
	'UNWATCHED_FORUMS_TOPICS'	=> 'Ya no estás suscripto a las entradas seleccionadas.',
	'UPDATE'	=> 'Actualizar',
	'UPLOAD_IN_PROGRESS'	=> 'Subida en curso',
	'URL_REDIRECT'	=> 'Si tu navegador no soporta meta redirección, por favor hace clic %sAQUI%s para ser redirigido.',
	'USERGROUPS'	=> 'Grupos',
	'USERNAME'	=> 'Nombre de Usuario',
	'USERNAMES'	=> 'Nombres de Usuario',
	'USER_AVATAR'	=> 'Avatar de Usuario',
	'USER_CANNOT_READ'	=> 'No podes leer mensajes en este Foro',
	'USER_POST'	=> '%d Mensaje',
	'USER_POSTS'	=> '%d Mensajes',
	'USERS'	=> 'Usuarios',
	'USE_PERMISSIONS'	=> 'Transferirme los permisos del Usuario',
	'USER_NEW_PERMISSION_DISALLOWED'	=> 'Lo sentimos pero no estás autorizado a usar esta opción. Puede ser que te hayas registrado hace poco acá y necesités participar más para poder hacer uso de esta opción.',

	'VARIANT_DATE_SEPARATOR'	=> ' / ',	
	'VIEWED'	=> 'Visto',
	'VIEWING_FAQ'	=> 'Viendo FAQ',
	'VIEWING_MEMBERS'	=> 'Viendo detalles de los Usuarios',
	'VIEWING_ONLINE'	=> 'Viendo quién está conectado',
	'VIEWING_MCP'	=> 'Viendo el Panel de Control de Moderador',
	'VIEWING_MEMBER_PROFILE'	=> 'Viendo perfil de Usuario',
	'VIEWING_PRIVATE_MESSAGES'	=> 'Viendo mensajes privados',
	'VIEWING_REGISTER'	=> 'Registrando cuenta',
	'VIEWING_UCP'	=> 'Viendo Panel de Control de Usuario',
	'VIEWS'	=> 'Vistas',
	'VIEW_BOOKMARKS'	=> 'Ver Favoritos',
	'VIEW_FORUM_LOGS'	=> 'Ver registros de Foro',
	'VIEW_LATEST_POST'	=> 'Ver último mensaje',
	'VIEW_NEWEST_POST'	=> 'Ver último mensaje sin leer',
	'VIEW_NOTES'	=> 'Ver notas del usuario',
	'VIEW_ONLINE_TIME'	=> 'basados en usuarios activos en el último %d minuto',
	'VIEW_ONLINE_TIMES'	=> 'basados en usuarios activos en los últimos %d minutos',
	'VIEW_TOPIC'	=> 'Ver Tema',
	'VIEW_TOPIC_ANNOUNCEMENT'	=> 'Anuncio: ',
	'VIEW_TOPIC_GLOBAL'	=> 'Anuncio Global: ',
	'VIEW_TOPIC_LOCKED'	=> 'cerrado: ',
	'VIEW_TOPIC_LOGS'	=> 'Ver registros de tema',
	'VIEW_TOPIC_MOVED'	=> 'Movido: ',
	'VIEW_TOPIC_POLL'	=> 'Encuesta: ',
	'VIEW_TOPIC_STICKY'	=> 'Fijo: ',
	'VISIT_WEBSITE'	=> 'Visitar sitio web',
	
	'WARNINGS'	=> 'Advertencias',
	'WARN_USER'	=> 'Advertencia',
	'WATCH_FORUM_CONFIRM'	=> '¿Seguro que deseas suscribirte a este foro?',
	'WATCH_FORUM_DETAILED'	=> '¿Seguro que deseas suscribirte al foro “%s”?',
	'WATCH_TOPIC_CONFIRM'	=> '¿Seguro que deseas suscribirte a este tema?',
	'WATCH_TOPIC_DETAILED'	=> '¿Seguro que deseas suscribirte al tema “%s”?',	
	'WELCOME_SUBJECT'	=> 'Bienvenido a los foros %s',
	'WEBSITE'	=> 'Sitio web',
	'WHOIS'	=> '¿Quién es?',
	'WHO_IS_ONLINE'	=> '¿Quién está conectado?',
	'WRONG_PASSWORD'	=> 'Introdujiste una contraseña incorrecta.',
	
	'WRONG_DATA_ICQ'	=> 'El número que introdujiste no es un número válido de ICQ.',
	'WRONG_DATA_JABBER'	=> 'El nombre que introdujiste no es un nombre de cuenta Jabber válido.',
	'WRONG_DATA_LANG'	=> 'El idioma que especificaste no es válido.',
	'WRONG_DATA_WEBSITE'	=> 'La dirección del sitio web tiene que ser una URL válida, incluyendo el protocolo, por ejemplo http://www.ejemplo.com/.',
	'WROTE'						=> 'escribiste',
	
	'YEAR'	=> 'Año',
	'YEAR_MONTH_DAY' => '(YYYY-MM-DD)',
	'YES'	=> 'Sí',
	'YIM'	=> 'YIM',
	'YOU_LAST_VISIT'	=> 'Tu última visita fue: %s',
	'YOU_NEW_PM'	=> 'Un nuevo mensaje privado te espera en tu Bandeja de Entrada',
	'YOU_NEW_PMS'	=> 'Nuevos mensajes privados te esperan en tu Bandeja de Entrada',
	'YOU_NO_NEW_PM'	=> 'No hay nuevos mensajes privados esperándote',

	'datetime'	=> array(
		'TODAY'	=> 'Hoy',
		'TOMORROW'	=> 'Mañana',
		'YESTERDAY'	=> 'Ayer',
		'AGO'		=> array(
			0		=> 'hace menos de un minuto',
			1		=> 'hace %d minuto',
			2		=> 'hace %d minutos',
			60		=> 'hace 1 hora',
		),
		
		'Sunday'	=> 'Domingo',
		'Monday'	=> 'Lunes',
		'Tuesday'	=> 'Martes',
		'Wednesday'	=> 'Miércoles',
		'Thursday'	=> 'Jueves',
		'Friday'	=> 'Viernes',
		'Saturday'	=> 'Sábado',
		
		'Sun'	=> 'Dom',
		'Mon'	=> 'Lun',
		'Tue'	=> 'Mar',
		'Wed'	=> 'Mié',
		'Thu'	=> 'Jue',
		'Fri'	=> 'Vie',
		'Sat'	=> 'Sab',
		
		'January'	=> 'Enero',
		'February'	=> 'Febrero',
		'March'	=> 'Marzo',
		'April'	=> 'Abril',
		'May'	=> 'Mayo',
		'June'	=> 'Junio',
		'July'	=> 'Julio',
		'August'	=> 'Agosto',
		'September'	=> 'Septiembre',
		'October'	=> 'Octubre',
		'November'	=> 'Noviembre',
		'December'	=> 'Diciembre',
		
		'Jan'	=> 'Ene',
		'Feb'	=> 'Feb',
		'Mar'	=> 'Mar',
		'Apr'	=> 'Abr',
		'May_short'	=> 'May',
		'Jun'	=> 'Jun',
		'Jul'	=> 'Jul',
		'Aug'	=> 'Ago',
		'Sep'	=> 'Sep',
		'Oct'	=> 'Oct',
		'Nov'	=> 'Nov',
		'Dec'	=> 'Dic',
	),

	'tz'	=> array(
		'-12'	=> 'UTC - 12 horas',
		'-11'	=> 'UTC - 11 horas',
		'-10'	=> 'UTC - 10 horas',
		'-9.5'	=> 'UTC - 9:30 horas',
		'-9'	=> 'UTC - 9 horas',
		'-8'	=> 'UTC - 8 horas',
		'-7'	=> 'UTC - 7 horas',
		'-6'	=> 'UTC - 6 horas',
		'-5'	=> 'UTC - 5 horas',
		'-4.5'	=> 'UTC - 4:30 horas',
		'-4'	=> 'UTC - 4 horas',
		'-3.5'	=> 'UTC - 3:30 horas',
		'-3'	=> 'UTC - 3 horas',
		'-2'	=> 'UTC - 2 horas',
		'-1'	=> 'UTC - 1 hora',
		'0'	=> 'UTC',
		'1'	=> 'UTC + 1 hora',
		'2'	=> 'UTC + 2 horas',
		'3'	=> 'UTC + 3 horas',
		'3.5'	=> 'UTC + 3:30 horas',
		'4'	=> 'UTC + 4 horas',
		'4.5'	=> 'UTC + 4:30 horas',
		'5'	=> 'UTC + 5 horas',
		'5.5'	=> 'UTC + 5:30 horas',
		'5.75'	=> 'UTC + 5:45 horas',
		'6'	=> 'UTC + 6 horas',
		'6.5'	=> 'UTC + 6:30 horas',
		'7'	=> 'UTC + 7 horas',
		'8'	=> 'UTC + 8 horas',
		'8.75'	=> 'UTC + 8:45 horas',
		'9'	=> 'UTC + 9 horas',
		'9.5'	=> 'UTC + 9:30 horas',
		'10'	=> 'UTC + 10 horas',
		'10.5'	=> 'UTC + 10:30 horas',
		'11'	=> 'UTC + 11 horas',
		'11.5'	=> 'UTC + 11:30 horas',
		'12'	=> 'UTC + 12 horas',
		'12.75'	=> 'UTC + 12:45 horas',
		'13'	=> 'UTC + 13 horas',
		'14'	=> 'UTC + 14 horas',
		'dst'	=> '[ <abbr title="Daylight Saving Time">DST</abbr> ]',
	),

	'tz_zones'	=> array(
		'-12'	=> '[UTC - 12] Isla Baker',
		'-11'	=> '[UTC - 11] Niue, Samoa estándar',
		'-10'	=> '[UTC - 10] Haswaii-Aleutian estándar, Isla Cook',
		'-9.5'	=> '[UTC - 9:30] Islas Marquesas',
		'-9'	=> '[UTC - 9] Alaska estándar, Isla Gambier',
		'-8'	=> '[UTC - 8] México (Baja California, Isla Clarión), California (EE.UU)',
		'-7'	=> '[UTC - 7] México (Baja California Sur, Chihuahua, Nayarit), Arizona (EE.UU.), Montañas Rocosas estándar',
		'-6'	=> '[UTC - 6] México (Monterrey, Ciudad de México), Nicaragua, El Salvador, Guatemala, Honduras, Costa Rica, Ecuador (Galápagos)',
		'-5'	=> '[UTC - 5] Florida (EE.UU.), Cuba, Haití, Panamá, Colombia, Ecuador, Perú, Brasil (Acre)',
		'-4.5'	=> '[UTC - 4:30] Venezuela estándar',
		'-4'	=> '[UTC - 4] Puerto Rico, República Dominicana, Bolivia, Paraguay, Chile, Brasil (Amazonas, Manaos), Guayana',
		'-3.5'	=> '[UTC - 3:30] Terranova estándar',
		'-3'	=> '[UTC - 3] estándar: Argentina, Uruguay, Brasil (Brasilia, Bahía, Rio de Janeiro, São Paulo), Surinam, Guayana Francesa',
		'-2'	=> '[UTC - 2] Brasil (Recife), Fernando de Noronha, Georgias del Sur & Islas Sandwich del Sur',
		'-1'	=> '[UTC - 1] Islas Azores, Cabo Verde, Groenlandia Este',
		'0'	=> '[UTC] Islas Canarias (España), Europa Occidental, Marruecos, Mauritania, Senegal, Guinea, Liberia, Ghana',
		'1'	=> '[UTC + 1] España estándar, Europa Central, Argelia, Túnez, Guinea Ecuatorial, África Occidental Central',
		'2'	=> '[UTC + 2] Europa Oriental, África Central',
		'3'	=> '[UTC + 3] Moscú estándar, África Oriental',
		'3.5'	=> '[UTC + 3:30] Irán estándar',
		'4'	=> '[UTC + 4] del Golfo estándar, Samara estándar',
		'4.5'	=> '[UTC + 4:30] Afganistán',
		'5'	=> '[UTC + 5] Pakistan estándar, Yekaterinburg estándar',
		'5.5'	=> '[UTC + 5:30] India estándar, Sri Lanka',
		'5.75'	=> '[UTC + 5:45] Nepal',
		'6'	=> '[UTC + 6] Bangladesh, Bhutan, Novosibirsk estándar',
		'6.5'	=> '[UTC + 6:30] Islas Cocos, Myanmar',
		'7'	=> '[UTC + 7] Indochina, Krasnoyarsk estándar',
		'8'	=> '[UTC + 8] Filipinas, China estándar, Australia Occidental estándar',
		'8.75'	=> '[UTC + 8:45] Sureste Oriental Australia estándar',
		'9'	=> '[UTC + 9] Japón estándar, Corea estándar, China estándar',
		'9.5'	=> '[UTC + 9:30] Australia Central estándar',
		'10'	=> '[UTC + 10] Australia Oriental estándar, Vladivostok estándar',
		'10.5'	=> '[UTC + 10:30] Lord Howe estándar',
		'11'	=> '[UTC + 11] Islas Salomón, Magadan estándar',
		'11.5'	=> '[UTC + 11:30] Islas Norfolk',
		'12'	=> '[UTC + 12] New Zelanda, Fiji, Kamchatka estándar',
		'12.75'	=> '[UTC + 12:45] Islas Chatham',
		'13'	=> '[UTC + 13] Tonga, Islas Fénix',
		'14'	=> '[UTC + 14] Islas Line',
	),

	// The value is only an example and will get replaced by the current time on view
	'dateformats'	=> array(
		'd M Y H:i'			=> '01 Ene 2007 13:37',
		'd M Y, H:i'		=> '01 Ene 2007, 13:37',
		'M jS, y, H:i'		=> 'Ene 1ro, 07, 13:37',
		'D M d, Y g:i a'	=> 'Lun Ene 01, 2007 1:37 pm',
		'F jS, Y, g:i a'	=> 'Enero 1ro, 2007, 1:37 pm',
		'|d M Y|, H:i'		=> 'Hoy, 13:37 / 01 Ene 2007, 13:37',
		'|F jS, Y|, g:i a'	=> 'Hoy, 1:37 pm / 1ro de Enero, 2007, 1:37 pm',
	),

	// The default dateformat which will be used on new installs in this language
	// Translators should change this if a the usual date format is different
	'default_dateformat'	=> 'D, d M Y, H:i', // Mié, 10 Mar 2010, 23:26

));

?>
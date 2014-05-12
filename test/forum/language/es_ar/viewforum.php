<?php
/**
*
* viewforum.php [Argentinian Spanish]
*
* @package language
* @copyright (c) 2007 phpBB Group. Modified by nextgen for phpbbargentina.com in 2012 
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


$lang = array_merge($lang, array(
	'ACTIVE_TOPICS'			=> 'Temas activos',
	'ANNOUNCEMENTS'			=> 'Anuncios',

	'FORUM_PERMISSIONS'		=> 'Permisos del foro',

	'ICON_ANNOUNCEMENT'		=> 'Anuncio',
	'ICON_STICKY'			=> 'Fijo',

	'LOGIN_NOTIFY_FORUM'	=> 'Has sido notificado sobre este foro, por favor identificate para verlo.',

	'MARK_TOPICS_READ'		=> 'Marcar temas como leídos',

	'NEW_POSTS_HOT'			=> 'Mensajes nuevos [ Popular ]',   // No usado más 
	'NEW_POSTS_LOCKED'		=> 'Mensajes nuevos [ Cerrado ]',   // No usado más 
	'NO_NEW_POSTS_HOT'		=> 'No hay mensajes nuevos [ Popular ]',   // No usado más
	'NO_NEW_POSTS_LOCKED'	=> 'No hay mensajes nuevos [ Cerrado ]',   // No usado más
	'NO_READ_ACCESS'		=> 'No tenés los permisos requeridos para leer temas en este foro.',
	'NO_UNREAD_POSTS_HOT'      => 'No hay mensajes sin leer [ Popular ]',
	'NO_UNREAD_POSTS_LOCKED'   => 'No hay mensajes sin leer [ Cerrado ]',

	'POST_FORUM_LOCKED'      => 'El foro está cerrado',

	'TOPICS_MARKED'         => 'Los temas de este foro han sido marcados como leídos.',

	'UNREAD_POSTS_HOT'      => 'Mensajes sin leer [ Popular ]',
	'UNREAD_POSTS_LOCKED'   => 'Mensajes sin leer [ Cerrado ]',

	'VIEW_FORUM'			=> 'Ver foro',
	'VIEW_FORUM_TOPIC'		=> '1 tema',
	'VIEW_FORUM_TOPICS'		=> '%d temas',
));

?>
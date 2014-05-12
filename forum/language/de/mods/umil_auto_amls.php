<?php
/** 
*
* @package Advanced Multi Language Pack Support MOD
* @version $Id: umil_auto_amls.php, german, v 1.001 2012/06/18 Martin Truckenbrodt Exp$
* @copyright (c) 2012 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'INSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'				=> 'Installiere Advanced Multi Language Pack Support MOD',
	'INSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'		=> 'Bist Du bereit den Advanced Multi Language Pack Support MOD zu installieren?',

	'ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'						=> 'Advanced Multi Language Pack Support MOD',
	'ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_EXPLAIN'				=> 'Bessere Unterstützung für mehrsprachige phpBB3 Boards.',

	'UNINSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'			=> 'Entferne Advanced Multi Language Pack Support MOD',
	'UNINSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'	=> 'Bist Du bereit den Advanced Multi Language Pack Support MOD zu entfernen? Alle Einstellungen und Daten zu diesem Mod gehen hierbei verloren!',
	'UPDATE_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'				=> 'Aktualisiere Advanced Multi Language Pack Support MOD',
	'UPDATE_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'		=> 'Bist Du bereit den Advanced Multi Language Pack Support MOD zu aktualisieren?',
));

?>
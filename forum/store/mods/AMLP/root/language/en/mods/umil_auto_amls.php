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
	'INSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'				=> 'Install Advanced Multi Language Pack Support MOD',
	'INSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'		=> 'Are you ready to install the Advanced Multi Language Pack Support MOD?',

	'ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'						=> 'Advanced Multi Language Pack Support MOD',
	'ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_EXPLAIN'				=> 'Improved support for multiple language phpBB3 boards.',

	'UNINSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'			=> 'Uninstall Advanced Multi Language Pack Support MOD',
	'UNINSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'	=> 'Are you ready to uninstall the Advanced Multi Language Pack Support MOD? All settings and data saved by this mod will be removed!',
	'UPDATE_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'				=> 'Update Advanced Multi Language Pack Support MOD',
	'UPDATE_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'		=> 'Are you ready to update the Advanced Multi Language Pack Support MOD?',
));

?>
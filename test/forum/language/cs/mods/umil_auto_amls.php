<?php
/** 
*
* @package Advanced Multi Language Pack Support MOD
* @version $Id: umil_auto_amls.php, czech, v 1.000 2012/06/26 Leschek Exp$
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
	'INSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'				=> 'Instalovat Advanced Multi Language Pack Support MOD',
	'INSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'		=> 'Opravdu chcete nainstalovat Advanced Multi Language Pack Support MOD?',

	'ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'						=> 'Advanced Multi Language Pack Support MOD',
	'ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_EXPLAIN'				=> 'Zlepšená podpora více nainstalovaných jazyků na phpBB3',

	'UNINSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'			=> 'Odinstalovat Advanced Multi Language Pack Support MOD',
	'UNINSTALL_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'	=> 'Opravdu chcete odinstalovat Advanced Multi Language Pack Support MOD? Všechna nastavení a data uložená tímto MODem budou odstraněna!',
	'UPDATE_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT'				=> 'Aktualizovat Advanced Multi Language Pack Support MOD',
	'UPDATE_ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT_CONFIRM'		=> 'Opravdu chcete aktualizovat Advanced Multi Language Pack Support MOD?',
));

?>
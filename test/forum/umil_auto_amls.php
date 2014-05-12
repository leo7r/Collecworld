<?php
/** 
*
* @package Advanced Multi Language Pack Support MOD
* @version $Id: umil_auto_amls.php, v 1.003 2012/12/23 Martin Truckenbrodt Exp$
* @copyright (c) 2012 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

$mod_name = 'ADVANCED_MULTI_LANGUAGE_PACK_SUPPORT';

$version_config_name = 'amls_version';

$language_file = 'mods/umil_auto_amls';

$options = array(
);

$versions = array(
	// Version 1.0.0
	'1.0.0'	=> array(
		'config_add' => array(
			array('inherit_lang', 1, false),
			array('detect_lang_enable', 1, false),
			array('lang_select_enable', 1, false),
			array('lang_click_enable', 1, false),
		),
		'table_column_add' => array(
			array(SESSIONS_TABLE, 'session_lang', array('VCHAR:30', NULL)),
		),
	),
	// Version 1.0.1
	'1.0.1'	=> array(
	),
	// Version 1.0.2
	'1.0.2'	=> array(
		'cache_purge' => array('', 'template', 'imageset'),
	),
	// Version 1.0.3
	'1.0.3'	=> array(
		'cache_purge' => array(),
	),
);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

?>
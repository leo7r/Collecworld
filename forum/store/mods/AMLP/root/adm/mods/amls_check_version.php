<?php
/**
*
* @package acp
* @version $Id: amls_check_version.php 1.001 2012-12-24 Martin Truckenbrodt $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package mod_version_check
*/
class amls_check_version
{
	function version()
	{
		return array(
			'author'	=> 'Martin Truckenbrodt',
			'title'		=> 'Advanced Multi Language Pack Support MOD',
			'tag'		=> 'amls',
			'version'	=> '1.0.3',
			'file'		=> array('martin-truckenbrodt.com', 'phpbb3mods', 'amls.xml'),
		);
	}
}

?>
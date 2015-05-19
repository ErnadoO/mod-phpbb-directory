<?php
/**
*
* @author Erwan NADER (ErnadoO) ernadoo@phpbb-services.com
* @package acp
* @version $Id$
* @copyright (c) 2009 http://www.phpbb-services.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package phpbb_directory
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

class phpbb_directory_version
{
	function version()
	{
		return array(
			'author'	=> 'ErnadoO',
			'title'		=> 'phpBB Directory',
			'tag'		=> 'phpbb_directory',
			'version'	=> '2.0.6',
			'file'		=> array('www.phpbb-services.com', 'updatecheck', 'mods.xml'),
		);
	}
}

?>
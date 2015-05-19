<?php
/**
*
* @package install
* @version $Id: install_uninstall.php 222 2009-01-27 18:56:48Z ErnadoO $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
if (!defined('IN_INSTALL'))
{
	exit;
}

if (!empty($setmodules))
{
	if (!$this->installed_version)
	{
		return;
	}

	$module[] = array(
		'module_type'		=> 'install',
		'module_title'		=> 'UNINSTALL',
		'module_filename'	=> substr(basename(__FILE__), 0, -strlen($phpEx)-1),
		'module_order'		=> 30,
		'module_subs'		=> '',
		'module_stages'		=> array('INTRO', 'UNINSTALL'),
		'module_reqs'		=> ''
	);
}

/**
* Installation
* @package install
*/
class install_uninstall extends module
{
	function install_uninstall(&$p_master)
	{
		$this->p_master = &$p_master;
	}

	function main($mode, $sub)
	{
		global $lang, $template, $language, $phpbb_root_path;

		switch ($sub)
		{
			case 'intro':
				$this->page_title = $lang['SUB_INTRO'];

				$template->assign_vars(array(
					'TITLE'			=> $lang['UNINSTALL_INTRO'],
					'BODY'			=> $lang['UNINSTALL_INTRO_BODY'],
					'L_SUBMIT'		=> $lang['UNINSTALL_START'],
					'U_ACTION'		=> $this->p_master->module_url . "?mode=$mode&amp;sub=uninstall&amp;language=$language",
				));

			break;

			case 'uninstall':
				$this->uninstall($mode, $sub);

			break;
		}

		$this->tpl_name = 'install_dir';
	}

	/**
	* Obtain the information required to connect to the database
	*/
	function uninstall($mode, $sub)
	{
		global $template, $cache, $phpEx, $phpbb_root_path, $umil;
		global $phpbb_db_tools, $db, $mod_config, $lang, $user, $last_version;

		$this->page_title = $lang['STAGE_UNINSTALL_DIR'];

		$umil->run_actions('uninstall', $last_version, 'dir_version');

		// Purge the cache
		$cache->purge();

		$download_file = ($umil->error_file) ? append_sid("{$phpbb_root_path}umil/file.$phpEx", 'file=' . basename($umil->error_file, '.txt')) : '';
		$filename = ($umil->error_file) ? 'umil/error_files/' . basename($umil->error_file) : '';

		$template->assign_vars(array(
		'U_ERROR_FILE'		=> $umil->error_file,

		'L_RESULTS'			=> ($umil->errors) ? $user->lang['FAIL'] : $user->lang['SUCCESS'],
		'L_ERROR_NOTICE'	=> ($umil->errors) ? (($umil->error_file) ? sprintf($user->lang['ERROR_NOTICE'], $download_file, $filename) : $user->lang['ERROR_NOTICE_NO_FILE']) : '',

		'S_RESULTS'			=> $umil->results,
		'S_SUCCESS'			=> ($umil->errors) ? false : true,

		'BODY'		=> $lang['STAGE_UNINSTALL_DIR_EXPLAIN'] . '<br /><br />' . sprintf($lang['UNINSTALL_CONGRATS_EXPLAIN'], $mod_config['mod_version']),
		'L_SUBMIT'	=> $lang['INSTALL_LOGIN'],
		'U_ACTION'	=> append_sid("{$phpbb_root_path}adm/index.$phpEx", false, true, $user->session_id),
	));

	}
}

?>
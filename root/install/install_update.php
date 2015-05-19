<?php
/**
*
* @author Erwan NADER (ErnadoO) ernadoo@phpbb-services.com
* @package install
* @version $Id: install_update.php, v1.0.0 2010/05/17 13:44:32 ErnadoO Exp $
* @copyright (c) 2008 http://www.phpbb-services.com
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
	if (!$this->installed_version || version_compare($this->installed_version, $mod_config['mod_version'], '>='))
	{
		return;
	}

	$module[] = array(
		'module_type'		=> 'install',
		'module_title'		=> 'UPDATE',
		'module_filename'	=> substr(basename(__FILE__), 0, -strlen($phpEx)-1),
		'module_order'		=> 20,
		'module_subs'		=> '',
		'module_stages'		=> array('INTRO', 'REQUIREMENTS', 'UPDATE'),
		'module_reqs'		=> ''
	);
}

/**
* Installation
* @package install
*/

class install_update extends module
{
	function install_update(&$p_master)
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
					'TITLE'			=> $lang['UPDATE_INTRO'],
					'BODY'			=> $lang['UPDATE_INTRO_BODY'],
					'L_SUBMIT'		=> $lang['NEXT_STEP'],
					'U_ACTION'		=> append_sid($this->p_master->module_url . "?mode=$mode&amp;sub=requirements&amp;language=$language"),
				));

			break;

			case 'requirements':
				$this->requirements($mode, $sub);

			break;

			case 'update':
				$this->update($mode, $sub);

			break;
		}

		$this->tpl_name = 'install_dir';
	}

	/**
	 * Checks that the server we are installing on meets the requirements for running directory update
	 */
	function requirements($mode, $sub)
	{
		global $lang, $config, $mod_config, $template;
		global $language, $phpbb_root_path, $phpEx;

		$this->page_title = $lang['STAGE_REQUIREMENTS'];

		$template->assign_vars(array(
			'TITLE'		=> $lang['REQUIREMENTS_TITLE'],
			'BODY'		=> $lang['REQUIREMENTS_EXPLAIN'],
		));

		$passed = array('phpbb' => false, 'php' => false, 'imagesize' => false, 'allow_url_fopen' => false, 'files' => false);

		// Test for basic PHPBB settings
		$template->assign_block_vars('checks', array(
			'S_LEGEND'			=> true,
			'LEGEND'			=> $lang['PHPBB_SETTINGS'],
			'LEGEND_EXPLAIN'	=> sprintf($lang['PHPBB_SETTINGS_EXPLAIN'], $mod_config['phpbb_version']),
		));

		if (version_compare($config['version'], $mod_config['phpbb_version'], '<'))
		{
			$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
		}
		else
		{
			$passed['phpbb'] = true;
			$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
		}

		$template->assign_block_vars('checks', array(
			'TITLE'			=> sprintf($lang['PHPBB_VERSION_REQD'], $mod_config['phpbb_version']),
			'RESULT'		=> $result,

			'S_EXPLAIN'		=> false,
			'S_LEGEND'		=> false,
		));

		// Test for basic PHP settings
		$template->assign_block_vars('checks', array(
			'S_LEGEND'			=> true,
			'LEGEND'			=> $lang['PHP_SETTINGS'],
			'LEGEND_EXPLAIN'	=> sprintf($lang['PHP_SETTINGS_EXPLAIN'], $mod_config['php_version']),
		));

		// Test the minimum PHP version
		$php_version = PHP_VERSION;

		if (version_compare($php_version, $mod_config['php_version']) < 0)
		{
			$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
		}
		else
		{
			$passed['php'] = true;
			$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
		}

		$template->assign_block_vars('checks', array(
			'TITLE'			=> sprintf($lang['PHP_VERSION_REQD'], $mod_config['php_version']),
			'RESULT'		=> $result,

			'S_EXPLAIN'		=> false,
			'S_LEGEND'		=> false,
		));

		// Check for getimagesize
		if (@function_exists('getimagesize'))
		{
			$passed['imagesize'] = true;
			$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
		}
		else
		{
			$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
		}

		$template->assign_block_vars('checks', array(
			'TITLE'			=> $lang['PHP_GETIMAGESIZE_SUPPORT'],
			'TITLE_EXPLAIN'	=> $lang['PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'],
			'RESULT'		=> $result,

			'S_EXPLAIN'		=> true,
			'S_LEGEND'		=> false,
		));

		// Check for allow_url_fopen()
		if (@ini_get('allow_url_fopen'))
		{
			$passed['allow_url_fopen'] = true;
			$result = '<strong style="color:green">' . $lang['YES'] . '</strong>';
		}
		else
		{
			$result = '<strong style="color:red">' . $lang['NO'] . '</strong>';
		}

		$template->assign_block_vars('checks', array(
			'TITLE'			=> $lang['PHP_ALLOW_URL_FOPEN_SUPPORT'],
			'TITLE_EXPLAIN'	=> $lang['PHP_ALLOW_URL_FOPEN_SUPPORT_EXPLAIN'],
			'RESULT'		=> $result,

			'S_EXPLAIN'		=> true,
			'S_LEGEND'		=> false,
		));

		// Check permissions on files/directories we need access to
		$template->assign_block_vars('checks', array(
			'S_LEGEND'			=> true,
			'LEGEND'			=> $lang['FILES_REQUIRED'],
			'LEGEND_EXPLAIN'	=> $lang['FILES_REQUIRED_EXPLAIN'],
		));

		$dir = 'images/directory/banners/';

		umask(0);

		$passed['files'] = true;

		$exists = $write = false;

		// Try to create the directory if it does not exist
		if (!file_exists($phpbb_root_path . $dir))
		{
			@mkdir($phpbb_root_path . $dir, 0777);
			phpbb_chmod($phpbb_root_path . $dir, CHMOD_READ | CHMOD_WRITE);
		}

		// Now really check
		if (file_exists($phpbb_root_path . $dir) && is_dir($phpbb_root_path . $dir))
		{
			phpbb_chmod($phpbb_root_path . $dir, CHMOD_READ | CHMOD_WRITE);
			$exists = true;
		}

		// Now check if it is writable by storing a simple file
		$fp = @fopen($phpbb_root_path . $dir . 'test_lock', 'wb');
		if ($fp !== false)
		{
			$write = true;
		}
		@fclose($fp);

		@unlink($phpbb_root_path . $dir . 'test_lock');

		$passed['files'] = ($exists && $write && $passed['files']) ? true : false;

		$exists = ($exists) ? '<strong style="color:green">' . $lang['FOUND'] . '</strong>' : '<strong style="color:red">' . $lang['NOT_FOUND'] . '</strong>';
		$write = ($write) ? ', <strong style="color:green">' . $lang['WRITABLE'] . '</strong>' : (($exists) ? ', <strong style="color:red">' . $lang['UNWRITABLE'] . '</strong>' : '');

		$template->assign_block_vars('checks', array(
			'TITLE'		=> $dir,
			'RESULT'	=> $exists . $write,

			'S_EXPLAIN'	=> false,
			'S_LEGEND'	=> false,
		));

		$s_hidden_fields = '';
		$url = (!in_array(false, $passed)) ? $this->p_master->module_url . "?mode=$mode&amp;sub=update&amp;language=$language" : $this->p_master->module_url . "?mode=$mode&amp;sub=requirements&amp;language=$language";
		$submit = (!in_array(false, $passed)) ? $lang['UPDATE_START'] : $lang['INSTALL_TEST'];

		$template->assign_vars(array(
			'L_SUBMIT'	=> $submit,
			'S_HIDDEN'	=> $s_hidden_fields,
			'U_ACTION'	=> append_sid($url),
		));
	}

	/**
	* Obtain the information required to connect to the database
	*/
	function update($mode, $sub)
	{
		global $user, $template, $cache, $phpEx, $phpbb_root_path;
		global $lang, $mod_config, $update, $umil;

		$this->page_title = $lang['STAGE_UPDATE_DIR'];

		$umil->run_actions('update', $update, 'dir_version');

		// Purge the cache
		$umil->cache_purge('auth');
		$umil->cache_purge('imageset');
		$umil->cache_purge('template');
		$umil->cache_purge('theme');

		$download_file = ($umil->error_file) ? append_sid("{$phpbb_root_path}umil/file.$phpEx", 'file=' . basename($umil->error_file, '.txt')) : '';
		$filename = ($umil->error_file) ? 'umil/error_files/' . basename($umil->error_file) : '';

		$template->assign_vars(array(
			'U_ERROR_FILE'		=> $umil->error_file,

			'L_RESULTS'			=> ($umil->errors) ? $user->lang['FAIL'] : $user->lang['SUCCESS'],
			'L_ERROR_NOTICE'	=> ($umil->errors) ? (($umil->error_file) ? sprintf($user->lang['ERROR_NOTICE'], $download_file, $filename) : $user->lang['ERROR_NOTICE_NO_FILE']) : '',

			'S_RESULTS'			=> $umil->results,
			'S_SUCCESS'			=> ($umil->errors) ? false : true,
			'S_PERMISSIONS'		=> $umil->permissions_added,

			'TITLE'		=> $lang['INSTALL_CONGRATS'],
			'BODY'		=> $lang['STAGE_UPDATE_DIR_EXPLAIN'] . '<br /><br />' . sprintf($lang['UPDATE_CONGRATS_EXPLAIN'], $mod_config['mod_version']),
			'L_SUBMIT'	=> $lang['INSTALL_LOGIN'],
			'U_ACTION'	=> append_sid("{$phpbb_root_path}adm/index.$phpEx", false, true, $user->session_id),
		));
	}
}

?>
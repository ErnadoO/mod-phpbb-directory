<?php
/**
*
* @package install
* @version $Id: index.php 222 2009-01-07 02:20:21Z ErnadoO $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**#@+
* @ignore
*/
define('IN_PHPBB', true);
define('IN_INSTALL', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './../';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
require($phpbb_root_path . 'common.' . $phpEx);
require($phpbb_root_path . 'install/config.'.$phpEx);
require($phpbb_root_path . 'includes/functions_install.' . $phpEx);

if (!file_exists($phpbb_root_path . 'umil/umil.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// Start session management
$user->session_begin();
$auth->acl($user->data);

// Load a different language if required
$language = basename(request_var('language', $user->data['user_lang']));

//Another choice?
if($language != $user->data['user_lang'])
{
	$user->data['user_lang'] = $language;
}
$user->setup();

include($phpbb_root_path . 'language/' . $language . '/mods/directory_install.' . $phpEx);
include($phpbb_root_path . 'language/' . $language . '/mods/info_acp_directory.' . $phpEx);

if ($user->data['user_type'] != USER_FOUNDER)
{
	trigger_error($lang['INST_ERR_AUTH']);
}

// This is done here so when we add/delete the module we will see the language
// value inside the admin log
if (!class_exists('umil'))
{
	include($phpbb_root_path . 'umil/umil_frontend.' . $phpEx);
}
$force_display_results = defined('DEBUG') ? true : false;
$umil = new umil_frontend($mod_config['mod_title'], true, $force_display_results);

$mode	= request_var('mode', 'overview');
$sub	= request_var('sub', '');
$lang 	= array_merge($user->lang, $lang);

$template->set_custom_template('../adm/style', 'admin');
$template->assign_var('T_TEMPLATE_PATH', '../adm/style');

// Set some standard variables we want to force
$config['load_tplcompile'] = '1';
// the acp template is never stored in the database
$user->theme['template_storedb'] = false;

$install = new module();

$install->create('install', "index.$phpEx", $mode, $sub);
$install->load();

// Generate the page
$install->page_header();
$install->generate_navigation();

$template->set_filenames(array(
	'body' => $install->get_tpl_name())
);

$install->page_footer();

/**
* @package install
*/
class module
{
	var $id = 0;
	var $type = 'install';
	var $module_ary = array();
	var $mod_config = array();
	var $filename;
	var $module_url = '';
	var $tpl_name = '';
	var $mode;
	var $sub;
	var $installed_version = false;

	/**
	* Private methods, should not be overwritten
	*/
	function create($module_type, $module_url, $selected_mod = false, $selected_submod = false)
	{
		global $db, $config, $phpEx, $mod_config, $phpbb_root_path;

		if (isset($config['dir_version']))
		{
			$this->installed_version = $this->format_version((string)$config['dir_version']);
			$this->mod_config['dir_version'] = $config['dir_version'];
		}

		$module = array();

		// Grab module information using Bart's "neat-o-module" system (tm)
		$dir = @opendir('.');

		if (!$dir)
		{
			$this->error('Unable to access the installation directory', __LINE__, __FILE__);
		}

		$setmodules = 1;
		while (($file = readdir($dir)) !== false)
		{
			if (preg_match('#^install_(.*?)\.' . $phpEx . '$#', $file))
			{
				include($file);
			}
		}
		closedir($dir);

		unset($setmodules);

		if (!sizeof($module))
		{
			$this->error('No installation modules found', __LINE__, __FILE__);
		}

		// Order to use and count further if modules get assigned to the same position or not having an order
		$max_module_order = 1000;

		foreach ($module as $row)
		{
			// Module order not specified or module already assigned at this position?
			if (!isset($row['module_order']) || isset($this->module_ary[$row['module_order']]))
			{
				$row['module_order'] = $max_module_order;
				$max_module_order++;
			}

			$this->module_ary[$row['module_order']]['name'] = $row['module_title'];
			$this->module_ary[$row['module_order']]['filename'] = $row['module_filename'];
			$this->module_ary[$row['module_order']]['subs'] = $row['module_subs'];
			$this->module_ary[$row['module_order']]['stages'] = $row['module_stages'];

			if (strtolower($selected_mod) == strtolower($row['module_title']))
			{
				$this->id = (int) $row['module_order'];
				$this->filename = (string) $row['module_filename'];
				$this->module_url = (string) $module_url;
				$this->mode = (string) $selected_mod;
				// Check that the sub-mode specified is valid or set a default if not
				if (is_array($row['module_subs']))
				{
					$this->sub = strtolower((in_array(strtoupper($selected_submod), $row['module_subs'])) ? $selected_submod : $row['module_subs'][0]);
				}
				else if (is_array($row['module_stages']))
				{
					$this->sub = strtolower((in_array(strtoupper($selected_submod), $row['module_stages'])) ? $selected_submod : $row['module_stages'][0]);
				}
				else
				{
					$this->sub = '';
				}
			}
		} // END foreach
	} // END create

	/**
	* Load and run the relevant module if applicable
	*/
	function load($mode = false, $run = true)
	{
		global $phpbb_root_path, $phpEx;

		if ($run)
		{
			if (!empty($mode))
			{
				$this->mode = $mode;
			}

			$module = $this->filename;
			if (!class_exists($module))
			{
				$this->error('Module "' . htmlspecialchars($module) . '" not accessible.', __LINE__, __FILE__);
			}
			$this->module = new $module($this);

			if (method_exists($this->module, 'main'))
			{
				$this->module->main($this->mode, $this->sub);
			}
		}
	}

	/**
	* Output the standard page header
	*/
	function page_header()
	{
		if (defined('HEADER_INC'))
		{
			return;
		}

		define('HEADER_INC', true);
		global $template, $lang, $stage, $phpbb_root_path;

		$template->assign_vars(array(
			'L_CHANGE'				=> $lang['CHANGE'],
			'L_INSTALL_PANEL'		=> $lang['INSTALL_PANEL'],
			'L_SELECT_LANG'			=> $lang['SELECT_LANG'],
			'L_SKIP'				=> $lang['SKIP'],
			'PAGE_TITLE'			=> $this->get_page_title(),
			'T_IMAGE_PATH'			=> $phpbb_root_path . 'adm/images/',

			'S_CONTENT_DIRECTION' 	=> $lang['DIRECTION'],
			'S_CONTENT_FLOW_BEGIN'	=> ($lang['DIRECTION'] == 'ltr') ? 'left' : 'right',
			'S_CONTENT_FLOW_END'	=> ($lang['DIRECTION'] == 'ltr') ? 'right' : 'left',
			'S_CONTENT_ENCODING' 	=> 'UTF-8',

			'S_USER_LANG'			=> $lang['USER_LANG'],
			)
		);

		header('Content-type: text/html; charset=UTF-8');
		header('Cache-Control: private, no-cache="set-cookie"');
		header('Expires: 0');
		header('Pragma: no-cache');

		return;
	}

	/**
	* Output the standard page footer
	*/
	function page_footer()
	{
		global $db, $template;

		$template->display('body');

		// Close our DB connection.
		if (!empty($db) && is_object($db))
		{
			$db->sql_close();
		}

		if (function_exists('exit_handler'))
		{
			exit_handler();
		}
	}

	/**
	* Returns desired template name
	*/
	function get_tpl_name()
	{
		return $this->module->tpl_name . '.html';
	}

	/**
	* Returns the desired page title
	*/
	function get_page_title()
	{
		global $lang;

		if (!isset($this->module->page_title))
		{
			return '';
		}

		return (isset($lang[$this->module->page_title])) ? $lang[$this->module->page_title] : $this->module->page_title;
	}

	/**
	* Generate the navigation tabs
	*/
	function generate_navigation()
	{
		global $lang, $template, $phpEx, $language;

		if (is_array($this->module_ary))
		{
			@ksort($this->module_ary);
			foreach ($this->module_ary as $cat_ary)
			{
				$cat = $cat_ary['name'];
				$l_cat = (!empty($lang['CAT_' . $cat])) ? $lang['CAT_' . $cat] : preg_replace('#_#', ' ', $cat);
				$cat = strtolower($cat);
				$url = $this->module_url . "?mode=$cat&amp;language=$language";

				if ($this->mode == $cat)
				{
					$template->assign_block_vars('t_block1', array(
						'L_TITLE'		=> $l_cat,
						'S_SELECTED'	=> true,
						'U_TITLE'		=> $url,
					));

					if (is_array($this->module_ary[$this->id]['subs']))
					{
						$subs = $this->module_ary[$this->id]['subs'];
						foreach ($subs as $option)
						{
							$l_option = (!empty($lang['SUB_' . $option])) ? $lang['SUB_' . $option] : preg_replace('#_#', ' ', $option);
							$option = strtolower($option);
							$url = $this->module_url . '?mode=' . $this->mode . "&amp;sub=$option&amp;language=$language";

							$template->assign_block_vars('l_block1', array(
								'L_TITLE'		=> $l_option,
								'S_SELECTED'	=> ($this->sub == $option),
								'U_TITLE'		=> $url,
							));
						}
					}

					if (is_array($this->module_ary[$this->id]['stages']))
					{
						$subs = $this->module_ary[$this->id]['stages'];
						$matched = false;
						foreach ($subs as $option)
						{
							$l_option = (!empty($lang['STAGE_' . $option])) ? $lang['STAGE_' . $option] : preg_replace('#_#', ' ', $option);
							$option = strtolower($option);
							$matched = ($this->sub == $option) ? true : $matched;

							$template->assign_block_vars('l_block2', array(
								'L_TITLE'		=> $l_option,
								'S_SELECTED'	=> ($this->sub == $option),
								'S_COMPLETE'	=> !$matched,
							));
						}
					}
				}
				else
				{
					$template->assign_block_vars('t_block1', array(
						'L_TITLE'		=> $l_cat,
						'S_SELECTED'	=> false,
						'U_TITLE'		=> $url,
					));
				}
			}
		}
	}

	/**
	* Output an error message
	* If skip is true, return and continue execution, else exit
	*/
	function error($error, $line, $file, $skip = false)
	{
		global $lang, $db, $template;

		if ($skip)
		{
			$template->assign_block_vars('checks', array(
				'S_LEGEND'	=> true,
				'LEGEND'	=> $lang['INST_ERR'],
			));

			$template->assign_block_vars('checks', array(
				'TITLE'		=> basename($file) . ' [ ' . $line . ' ]',
				'RESULT'	=> '<b style="color:red">' . $error . '</b>',
			));

			return;
		}

		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
		echo '<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">';
		echo '<head>';
		echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
		echo '<title>' . $lang['INST_ERR_FATAL'] . '</title>';
		echo '<link href="../adm/style/admin.css" rel="stylesheet" type="text/css" media="screen" />';
		echo '</head>';
		echo '<body id="errorpage">';
		echo '<div id="wrap">';
		echo '	<div id="page-header">';
		echo '	</div>';
		echo '	<div id="page-body">';
		echo '		<div id="acp">';
		echo '		<div class="panel">';
		echo '			<span class="corners-top"><span></span></span>';
		echo '			<div id="content">';
		echo '				<h1>' . $lang['INST_ERR_FATAL'] . '</h1>';
		echo '		<p>' . $lang['INST_ERR_FATAL'] . "</p>\n";
		echo '		<p>' . basename($file) . ' [ ' . $line . " ]</p>\n";
		echo '		<p><b>' . $error . "</b></p>\n";
		echo '			</div>';
		echo '			<span class="corners-bottom"><span></span></span>';
		echo '		</div>';
		echo '		</div>';
		echo '	</div>';
		echo '	<div id="page-footer">';
		echo '		Powered by <a href="https://www.phpbb.com/">phpBB</a>&reg; Forum Software &copy; phpBB Group';
		echo '	</div>';
		echo '</div>';
		echo '</body>';
		echo '</html>';

		if (!empty($db) && is_object($db))
		{
			$db->sql_close();
		}

		exit_handler();
	}

	/**
	* Generate the relevant HTML for an input field and the associated label and explanatory text
	*/
	function input_field($name, $type, $value='', $options='')
	{
		global $lang;
		$tpl_type = explode(':', $type);
		$tpl = '';

		switch ($tpl_type[0])
		{
			case 'text':
			case 'password':
				$size = (int) $tpl_type[1];
				$maxlength = (int) $tpl_type[2];

				$tpl = '<input id="' . $name . '" type="' . $tpl_type[0] . '"' . (($size) ? ' size="' . $size . '"' : '') . ' maxlength="' . (($maxlength) ? $maxlength : 255) . '" name="' . $name . '" value="' . $value . '" />';
			break;

			case 'textarea':
				$rows = (int) $tpl_type[1];
				$cols = (int) $tpl_type[2];

				$tpl = '<textarea id="' . $name . '" name="' . $name . '" rows="' . $rows . '" cols="' . $cols . '">' . $value . '</textarea>';
			break;

			case 'radio':
				$key_yes	= ($value) ? ' checked="checked" id="' . $name . '"' : '';
				$key_no		= (!$value) ? ' checked="checked" id="' . $name . '"' : '';

				$tpl_type_cond = explode('_', $tpl_type[1]);
				$type_no = ($tpl_type_cond[0] == 'disabled' || $tpl_type_cond[0] == 'enabled') ? false : true;

				$tpl_no = '<label><input type="radio" name="' . $name . '" value="0"' . $key_no . ' class="radio" /> ' . (($type_no) ? $lang['NO'] : $lang['DISABLED']) . '</label>';
				$tpl_yes = '<label><input type="radio" name="' . $name . '" value="1"' . $key_yes . ' class="radio" /> ' . (($type_no) ? $lang['YES'] : $lang['ENABLED']) . '</label>';

				$tpl = ($tpl_type_cond[0] == 'yes' || $tpl_type_cond[0] == 'enabled') ? $tpl_yes . '&nbsp;&nbsp;' . $tpl_no : $tpl_no . '&nbsp;&nbsp;' . $tpl_yes;
			break;

			case 'select':
				eval('$s_options = ' . str_replace('{VALUE}', $value, $options) . ';');
				$tpl = '<select id="' . $name . '" name="' . $name . '">' . $s_options . '</select>';
			break;

			case 'custom':
				eval('$tpl = ' . str_replace('{VALUE}', $value, $options) . ';');
			break;

			default:
			break;
		}

		return $tpl;
	}

	/**
	* Format version strings in correctly to compare
	*/
	function format_version($version)
	{
		$find = array('rc', ' ');
		$replace = array('RC', '.');

		return str_replace($find, $replace, strtolower($version));
	}

	/**
	 * Generate the drop down of available language packs
	 */
	function inst_language_select($default = '')
	{
		global $phpbb_root_path, $phpEx;

		$dir = @opendir($phpbb_root_path . 'language');

		if (!$dir)
		{
			$this->error('Unable to access the language directory', __LINE__, __FILE__);
		}

		while ($file = readdir($dir))
		{
			$path = $phpbb_root_path . 'language/' . $file;

			if ($file == '.' || $file == '..' || is_link($path) || is_file($path) || $file == 'CVS')
			{
				continue;
			}

			if (file_exists($path . '/iso.txt') && file_exists($path . '/mods/directory_install.'.$phpEx))
			{
				list($displayname, $localname) = @file($path . '/iso.txt');
				$lang[$localname] = $file;
			}
		}
		closedir($dir);

		@asort($lang);
		@reset($lang);

		$user_select = '';
		foreach ($lang as $displayname => $filename)
		{
			$selected = (strtolower($default) == strtolower($filename)) ? ' selected="selected"' : '';
			$user_select .= '<option value="' . $filename . '"' . $selected . '>' . ucwords($displayname) . '</option>';
		}

		return $user_select;
	}
}

?>
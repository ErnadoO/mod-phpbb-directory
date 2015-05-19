<?php
/**
*
* @author Erwan NADER (ErnadoO) ernadoo@phpbb-services.com
* @package phpBB3
* @version $Id$
* @copyright (c) 2008 http://www.phpbb-services.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
**/

/**
* @ignore
*/
if (!defined('IN_PHPBB')) {
	exit;
}
/**
* ht_directory Class
*/
class ht_directory {
	/**
	* get_tpl
	*/
	function get_tpl() {
		global $config, $phpbb_admin_path, $phpbb_seo;
		$htaccess_tpl = '';
		$htaccess = array();
		if (!empty($config['dir_activ_rewrite'])) {
			$htaccess_tpl = '<b style="color:blue">#####################################################' . "\n";
			$htaccess_tpl .= '# PHPBB DIRECTORY' . "\n";
			$htaccess_tpl .= '# AUTHOR : ErnadoO http://www.phpbb-services.com/' . "\n";
			$htaccess_tpl .= '# STARTED : 2009/11/03' . "\n";
			$htaccess_tpl .= '# DIRECTORY INDEX</b>' . "\n";
			$htaccess_tpl .= '<b style="color:green">RewriteRule</b> ^{WIERD_SLASH}{PHPBB_LPATH}{STATIC_DIRECTORY_INDEX}{EXT_DIRECTORY_INDEX}$ {DEFAULT_SLASH}{PHPBB_RPATH}directory.{PHP_EX} [QSA,L,NC]' . "\n";

			$htaccess_tpl .= '<b style="color:blue"># DIRECTORY CAT ALL MODES</b>' . "\n";
			$htaccess_tpl .= '<b style="color:green">RewriteRule</b> ^{WIERD_SLASH}{PHPBB_LPATH}({STATIC_DIRECTORY}|[a-z0-9_-]*{DELIM_DIRECTORY})([0-9]+){DIRECTORY_PAGINATION}$ {DEFAULT_SLASH}{PHPBB_RPATH}directory.{PHP_EX}?mode=cat&amp;id=$2&amp;start=$4 [QSA,L,NC]' . "\n";
			$htaccess_tpl .= '<b style="color:blue"># END PHPBB DIRECTORY' . "\n";
			$htaccess_tpl .= '#####################################################</b>' . "\n\n";

			$htaccess['pos1'] = $htaccess_tpl;
		}
		return !empty($htaccess) ? $htaccess : false;
	}
}
?>
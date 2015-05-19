<?php
/**
*
* @author Erwan NADER (ErnadoO) ernadoo@phpbb-services.com
* @package phpBB3
* @version $Id$
* @copyright (c) 2008 http://www.phpbb-services.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
*/

/**
* @ignore
*/
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . 'includes/mods/directory/functions.' . $phpEx);
$directory_root_path = $config['dir_root_path'];

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/directory');

$keyword	= utf8_normalize_nfc(trim(request_var('keyword', '', true)));
$cat		= request_var('cat', 0);
$method		= request_var('search_method', 'any');
$fields		= request_var('sf', 'all');
$categorie	= new categorie();
$start		= request_var('start', 0);

$template->assign_block_vars('navlinks', array(
	'FORUM_NAME'	=> $user->lang['DIRECTORY'],
	'U_VIEW_FORUM'	=> append_sid("{$directory_root_path}directory.$phpEx"))
);

if (!$auth->acl_get('u_search_dir'))
{
	trigger_error('DIR_ERROR_NOT_AUTH');
}

/*
** search form submited
*/
$have_search = false;
$have_result = false;

if (isset($_POST['submit']))
{
	if (!empty($keyword))
	{
		$keytab = explode(' ', $keyword);
		$count_key = sizeof($keytab);

		$ssql = '';
		for ($i = 0; $i < $count_key; $i++)
		{
			// Build some display specific sql strings
			switch ($fields)
			{
				case 'titleonly':
					$ssql .= ' (LOWER(a.link_name) ' . $db->sql_like_expression(str_replace('*', $db->any_char, $db->any_char . strtolower($db->sql_escape($keytab[$i])) . $db->any_char)) .')';
					break;

				case 'desconly':
					$ssql .= ' (LOWER(a.link_description) ' . $db->sql_like_expression(str_replace('*', $db->any_char, $db->any_char . strtolower($db->sql_escape($keytab[$i])) . $db->any_char)) .')';
					break;

				default:
					$ssql .= ' (LOWER(a.link_name) ' . $db->sql_like_expression(str_replace('*', $db->any_char, $db->any_char . strtolower($db->sql_escape($keytab[$i])) . $db->any_char));
					$ssql .= ' OR LOWER(a.link_description) ' . $db->sql_like_expression(str_replace('*', $db->any_char, $db->any_char . strtolower($db->sql_escape($keytab[$i])) . $db->any_char)) .')';
					break;
			}

			$ssql .= ($i < ($count_key - 1) ? (($method == 'all') ? ' AND ' : ' OR ') : '');
		}

		if (!empty($cat))
		{
			$ssql .= ' AND a.link_cat = ' . (int)$cat;
		}

		$sql_array = array(
			'SELECT'	=> 'a.link_name, a.link_description, a.link_url, a.link_uid, a.link_bitfield, a.link_flags, a.link_view, a.link_user_id, a.link_time, a.link_comment, a.link_flag, a.link_id, a.link_thumb, a.link_banner, c.cat_name, u.user_id, u.username, u.user_colour',
			'FROM'		=> array(
					DIR_LINK_TABLE	=> 'a'),
			'LEFT_JOIN'	=> array(
					array(
						'FROM'	=> array(DIR_CAT_TABLE => 'c'),
						'ON'	=> 'a.link_cat = c.cat_id'
					),
					array(
						'FROM'	=> array(USERS_TABLE => 'u'),
						'ON'	=> 'u.user_id = a.link_user_id'
					)
			),
			'WHERE'		=> $ssql . ' AND a.link_active = 1',
			'ORDER_BY'	=> 'a.link_name ASC');

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query_limit($sql, $config['dir_show'], $start);

		$have_search = true;
	}
	else
	{
		trigger_error('DIR_ERROR_KEYWORD');
	}
}

/*
** There was a search
*/
if ($have_search)
{
	$have_result = false;
	while ($data = $db->sql_fetchrow($result))
	{
		$have_result = true;

		$s_banner	= $link->display_bann($data);
		$s_thumb	= $link->display_thumb($data);

		$template->assign_block_vars('result', array(
			'S_SITE'		=> $data['link_name'],
			'S_DESCRIPTION' => generate_text_for_display($data['link_description'], $data['link_uid'], $data['link_bitfield'], $data['link_flags']),
			'S_COUNT'		=> $data['link_view'],
			'S_CAT'			=> $data['cat_name'],
			'S_USER'		=> get_username_string('full', $data['link_user_id'], $data['username'], $data['user_colour']),
			'S_TIME'		=> ($data['link_time'] != 0) ? $user->format_date($data['link_time']) : 'n/a',
			'S_COMMENT'		=> $data['link_comment'],

			'THUMB'		=> '<img src="'.$s_thumb.'" alt="'.$user->lang['DIR_THUMB'].'" title="'.$data['link_name'].'"/>',
			'IMG_BANNER'	=> $s_banner,
			'IMG_FLAG'		=> (($data['link_flag'] == '') ? '' : '&nbsp;<img src="' . $phpbb_root_path . 'images/directory/flags/' . $data['link_flag'] . '" alt="' . $data['link_flag'] . '" title="' . $data['link_flag'] . '" border="0" width="17" height="12" />&nbsp;'),
			'ON_CLICK' 		=> "onclick=\"window.open('".append_sid($directory_root_path.'directory.'.$phpEx, array('mode' => 'view_url', 'u' => $data['link_id']))."');return false;\"",

			'L_DIR_SEARCH_NB_CLIC'	=> ($data['link_view'] > 1) ? $user->lang['DIR_SEARCH_NB_CLICS'] : $user->lang['DIR_SEARCH_NB_CLIC'],
			'L_DIR_SEARCH_NB_COMM'	=> ($data['link_comment'] > 1) ? $user->lang['L_DIR_SEARCH_NB_COMMS']: $user->lang['L_DIR_SEARCH_NB_COMM'],

			'U_SITE'		=> $data['link_url'],
			'LINK_ID'		=> $data['link_id'],
		));

		if ($s_banner)
		{
			$template->assign_block_vars('result.banner', array());
		}

		if ($config['dir_activ_flag'])
		{
			$template->assign_block_vars('result.switch_dir_flag', array());
		}
		$i++;
	}
}

$template->assign_vars( array(
	'AND_SELECT'	=> ($method == 'all') ? 'checked="checked"' : '',
	'OR_SELECT'		=> ($method == 'any') ? 'checked="checked"' : '',
	'ALL_SELECT'	=> ($fields == 'all') ? 'checked="checked"' : '',
	'DESC_SELECT'	=> ($fields == 'desconly') ? 'checked="checked"' : '',
	'TITLE_SELECT'	=> ($fields == 'titleonly') ? 'checked="checked"' : '',

	'S_POST_ACTION'	=> build_url(true),
	'S_KEYWORD'		=> $keyword,
	'S_CATLIST'		=> $categorie->make_cat_select($cat),
	'S_HAVE_SEARCH'	=> $have_search,
	'S_HAVE_RESULT'	=> $have_result,

	'U_SOMMAIRE'	=> append_sid('directory.' . $phpEx)
));

page_header($user->lang['DIR_MAKE_SEARCH'], false);
$template->set_filenames(array('body' => 'mods/directory/search_site.html'));
page_footer();

?>
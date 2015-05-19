<?php
/**
*
* @author Erwan NADER (ErnadoO) ernadoo@phpbb-services.com
* @package phpBB3
* @version $Id$
* @copyright (c) 2009 http://www.phpbb-services.com
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
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
$directory_root_path = $config['dir_root_path'];

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/directory');

$mode 			= request_var('mode', '');
$id				= request_var('id', 0);
$u				= request_var('u', 0);
$start			= request_var('start', 0);
$submit			= (isset($_POST['submit'])) ? true : false;
$refresh		= (isset($_POST['refresh_vc'])) ? true : false;
$timestamp		= request_var('timestamp', 0);

if($timestamp)
{
	echo $user->format_date((int)$timestamp);

	garbage_collection();
	exit_handler();
}

$categorie	= new categorie($id);
$title		= $user->lang['DIRECTORY'];
$s_hidden_fields = array();

$template->assign_block_vars('navlinks', array(
	'FORUM_NAME'	=> $title,
	'U_VIEW_FORUM'	=> append_sid("{$directory_root_path}directory.$phpEx"))
);

if($submit || $refresh || $mode == 'new')
{
	// The CAPTCHA kicks in here. We can't help that the information gets lost on language change.
	if(!$user->data['is_registered'] && $config['dir_visual_confirm'])
	{
		include($phpbb_root_path . 'includes/captcha/captcha_factory.' . $phpEx);
		$captcha =& phpbb_captcha_factory::get_instance($config['captcha_plugin']);
		$captcha->init(CONFIRM_POST);
	}
}

// If we delete a link
if ($mode == 'delete')
{
	if (isset($_POST['cancel']))
	{
		$redirect = append_sid("{$phpbb_root_path}directory.$phpEx", "mode=cat&amp;id=$id");
		redirect($redirect);
	}

	$sql = 'SELECT link_user_id FROM ' . DIR_LINK_TABLE . ' WHERE link_id = ' . (int)$u;
	$result = $db->sql_query($sql);
	$link_data = $db->sql_fetchrow($result);

	if(empty($link_data))
	{
		trigger_error('DIR_ERROR_NO_LINKS');
	}

	$delete_allowed = $user->data['is_registered'] && ($auth->acl_get('m_delete_dir') || ($user->data['user_id'] == $link_data['link_user_id'] && $auth->acl_get('u_delete_dir')));

	if(!$delete_allowed)
	{
		trigger_error('DIR_ERROR_NOT_AUTH');
	}

	$link->del($u, $id);
}

if (isset($_POST['submit_vote']) )
{
	if (!$auth->acl_get('u_vote_dir') || !$categorie->data['cat_allow_votes'])
	{
		trigger_error('DIR_ERROR_NOT_AUTH');
	}
	$link->add_vote($u);
}

// If form is done
if ($submit || $refresh)
{
	if (($mode == 'edit' && !$auth->acl_get('m_edit_dir') && !$auth->acl_get('u_edit_dir')) || ($mode == 'new' && !$auth->acl_get('u_submit_dir')))
	{
		trigger_error('DIR_ERROR_NOT_AUTH');
	}

	if (!check_form_key('dir_form'))
	{
		trigger_error('FORM_INVALID');
	}

	$url			= request_var('url', '');
	$site_name		= utf8_normalize_nfc(request_var('site_name', '', true));
	$description	= utf8_normalize_nfc(request_var('description', '', true));
	$guest_email	= request_var('guest_email', '');
	$rss			= request_var('rss', '');
	$banner 		= request_var('banner', '');
	$back			= request_var('back', '');
	$flag 			= request_var('flag', '');

	include($phpbb_root_path . 'includes/functions_user.' . $phpEx);

	// We define variables to check
	$data = array(
		'email'			=> $guest_email,
		'site_name'		=> $site_name,
		'website'		=> $url,
		'description'	=> $description,
		'rss'			=> $rss,
		'banner'		=> $banner,
		'back'			=> $back,
		'cat'			=> $id,
	);

	// We define verification type for each variable
	$data2 = array(
		'email'			=>		array(
			array('string', $user->data['is_registered'], 6, 60),
			array('email', '')),
		'site_name' =>			array(
			array('string', false, 1, 100)),
		'website'		=>		array(
			array('string',	false, 12, 255),
			array('match',	true, '#^http[s]?://(.*?\.)*?[a-z0-9\-]+\.[a-z]{2,4}#i')),
		'description'	=>		array(
			array('string', !$categorie->data['cat_must_describe'], 1, $config['dir_length_describe'])),
		'rss'			=>		array(
			array('string', true, 12, 255),
			array('match',	empty($rss), '#^http[s]?://(.*?\.)*?[a-z0-9\-]+\.[a-z]{2,4}#i')),
		'banner'		=>		array(
			array('string', true, 5, 255)),
		'back'			=>		array(
			array('string',	!$categorie->data['cat_link_back'], 12, 255),
			array('link_back', true)),
		'cat'			=>		array(
			array('num', '', 1)));

	$user->add_lang('ucp');
	$error = validate_data($data, $data2);
	$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);

	// We check that url have good format
	if(preg_match('/^(http|https):\/\//si', $url) && $config['dir_activ_checkurl'] && !$link->checkurl($url))
	{
		$error[] = $user->lang['DIR_ERROR_CHECK_URL'];
	}

	$wrong_confirm = false;
	if (!$user->data['is_registered'] && $config['dir_visual_confirm'])
	{
		$vc_response = $captcha->validate($data);
		if ($vc_response !== false)
		{
			$error[] = $vc_response;
		}

		if ($config['dir_visual_confirm_max_attempts'] && $captcha->get_attempt_count() > $config['dir_visual_confirm_max_attempts'])
		{
			$error[] = $user->lang['TOO_MANY_ADDS'];
		}
	}

	if(!$error)
	{
		/**
		* No errrors, we execute heavy tasks wich need a valid url
		*/

		// Banner
		$link->banner_process($banner, $error);

		// PageRank
		$pagerank = $link->pagerank_process($url);

		// Thumb ;)
		$thumb = $link->thumb_process($url);
	}

	// Still no errors?? So let's go baby!
	if (!$error)
	{
		$poll			= $uid			= $bitfield			= $options	= '';
		$allow_bbcode	= $allow_urls	= $allow_smilies	= true;
		generate_text_for_storage($description, $uid, $bitfield, $options, $allow_bbcode, $allow_urls, $allow_smilies);

		$banner	= (!$banner && !isset($_POST['delete_banner'])) ? request_var('old_banner', '') : $banner;
		$url	= $link->clean_url($url);

		$data_edit = array(
			'link_guest_email'	=> $guest_email,
			'link_name'			=> $site_name,
			'link_url'			=> $url,
			'link_description'	=> $description,
			'link_cat'			=> (int)$id,
			'link_rss'			=> $rss,
			'link_banner'		=> $banner,
			'link_back'			=> $back,
			'link_uid'			=> $uid,
			'link_flags'		=> $options,
			'link_flag'			=> $flag,
			'link_bitfield'		=> $bitfield,
			'link_pagerank'		=> (int)$pagerank,
			'link_thumb'		=> $thumb,
		);

		$need_approval = (categorie::need_approval($id) && !$auth->acl_get('a_') && !$auth->acl_get('m_')) ? true : false;

		if ($mode == 'edit')
		{
			$data_edit['link_cat_old'] = request_var('old_cat_id', 0);
			$link->edit($data_edit, $u, $need_approval);
		}
		else
		{
			$data_add = array(
				'link_time'			=> time(),
				'link_view'			=> 0,
				'link_active'		=> $need_approval ? false : true,
				'link_user_id'		=> (int)$user->data['user_id'],
			);

			$data_add = array_merge($data_edit, $data_add);

			$link->add($data_add, $u);

			// We check notification for this categorie
			if ($config['email_enable'] && !$need_approval)
			{
				$data_add['cat_name'] = $categorie->data['cat_name'];
				$link->notify_member($data_add);
			}
		}

		$meta_info = append_sid("{$directory_root_path}directory.$phpEx", "mode=cat&amp;id=$id");
		meta_refresh(3, $meta_info);
		$message	= ($need_approval) ? $user->lang['DIR_'.strtoupper($mode).'_SITE_ACTIVE'] : $user->lang['DIR_'.strtoupper($mode).'_SITE_OK'];
		$message	= $message . "<br /><br />" . sprintf($user->lang['DIR_CLICK_RETURN_DIR'], '<a href="' . append_sid("{$directory_root_path}directory.$phpEx") . '">', '</a>') . '<br /><br />' . sprintf($user->lang['DIR_CLICK_RETURN_CAT'], '<a href="' . append_sid("{$directory_root_path}directory.$phpEx", "mode=cat&amp;id=$id") . '">', '</a>');
		trigger_error($message);

	}
	else
	{
		if($mode == 'edit')
		{
			$s_hidden_fields = array(
				'old_cat_id'	=> request_var('old_cat_id', 0),
				'old_banner'	=> request_var('old_banner', '')
			);
		}

		$template->assign_vars( array(
			'ERROR'	=> (isset($error)) ? implode('<br />', $error) : ''
		));
	}
}

// We subscribe or unsubscribe
if ($mode == 'notification')
{
	if ($user->data['is_registered'])
	{
		if (request_var('notif', 0))
		{
			$data = array(
				'n_user_id' => (int)$user->data['user_id'],
				'n_cat_id' 	=> (int)$id,
			);

			$sql = 'INSERT INTO ' . DIR_NOTIFICATION_TABLE . ' ' . $db->sql_build_array('INSERT', $data);
			$db->sql_query($sql);
		}
		else
		{
			$sql = 'DELETE FROM ' . DIR_NOTIFICATION_TABLE . '
						WHERE n_user_id = ' . (int)$user->data['user_id'] . '
							AND n_cat_id = ' . (int)$id;
			$db->sql_query($sql);
		}
	}
	redirect(append_sid("{$directory_root_path}directory.$phpEx", "mode=cat&id=$id"));
}
else if (($mode == 'new' || $mode == 'edit'))
{
	if ($mode == 'new' && !$auth->acl_get('u_submit_dir'))
	{
		trigger_error('DIR_ERROR_NOT_AUTH');
	}

	if ($mode == 'edit')
	{
		$sql = 'SELECT link_user_id FROM ' . DIR_LINK_TABLE . ' WHERE link_id = ' . (int)$u;
		$result = $db->sql_query($sql);
		$link_data = $db->sql_fetchrow($result);

		$edit_allowed = ($user->data['is_registered'] && ($auth->acl_get('m_edit_dir') || ($user->data['user_id'] == $link_data['link_user_id'] && $auth->acl_get('u_edit_dir'))));

		if (!$edit_allowed)
		{
			trigger_error('DIR_ERROR_NOT_AUTH');
		}
	}

	$title = ($mode == 'edit') ? $user->lang['DIR_EDIT_SITE'] : $user->lang['DIR_NEW_SITE'];
	add_form_key('dir_form');

	$template->assign_block_vars('navlinks', array(
		'FORUM_NAME'	=> $title,
		'U_VIEW_FORUM'	=> append_sid("{$directory_root_path}directory.$phpEx"))
	);

	if (!$submit && ($mode == 'edit'))
	{
		$sql = 'SELECT link_id, link_uid, link_flags, link_bitfield, link_cat, link_url, link_description, link_guest_email, link_name, link_rss, link_back, link_banner, link_flag, link_cat, link_time FROM ' . DIR_LINK_TABLE . '
				WHERE link_id = ' . (int)$u;
		$result = $db->sql_query($sql);

		$site = $db->sql_fetchrow($result);

		if (empty($site['link_id']))
		{
			trigger_error('DIR_ERROR_NO_LINKS');
		}

		$s_hidden_fields = array(
			'old_cat_id'	=> $site['link_cat'],
			'old_banner'	=> $site['link_banner'],
		);

		$description = generate_text_for_edit($site['link_description'], $site['link_uid'], $site['link_flags']);
		$site['link_banner'] = (preg_match('/^(http:\/\/|https:\/\/|ftp:\/\/|ftps:\/\/|www\.).+/si', $site['link_banner'])) ? $site['link_banner'] : '';

		$url			= $site['link_url'];
		$site_name		= $site['link_name'];
		$description	= $description['text'];
		$guest_email	= $site['link_guest_email'];
		$rss			= $site['link_rss'];
		$banner 		= $site['link_banner'];
		$back			= $site['link_back'];
		$flag 			= $site['link_flag'];
		$id				= $site['link_cat'];
	}

	if (!$user->data['is_registered'] && $config['dir_visual_confirm'] && $mode == 'new')
	{
		$s_hidden_fields = array_merge($s_hidden_fields, $captcha->get_hidden_fields());

		$user->add_lang('ucp');

		$template->assign_vars(array(
			'CAPTCHA_TEMPLATE'		=> $captcha->get_template(),
		));
	}

	// We get config for display options
	$bbcode_status	= ($config['dir_allow_bbcode'] || $auth->acl_get('a_')) ? true : false;
	$smilies_status	= ($bbcode_status && $config['dir_allow_smilies'] || $auth->acl_get('a_')) ? true : false;
	$img_status		= ($bbcode_status || $auth->acl_get('a_')) ? true : false;
	$url_status		= ($config['dir_allow_links']) ? true : false;

	$s_guest	= (!$user->data['is_registered'] || !empty($guest_email));
	$s_rss		= $config['dir_activ_rss'];
	$s_banner	= $config['dir_activ_banner'];
	$s_back		= $categorie->data['cat_link_back'];
	$s_flag		= $config['dir_activ_flag'];

	$template->set_filenames(array('body' => 'mods/directory/add_site.html'));
	$user->add_lang('posting');
	display_custom_bbcodes();

	$flag_path	= $phpbb_root_path.'images/directory/flags/';
	$flag		= isset($flag) ? $flag : '';

	$template->assign_vars( array(
		'BBCODE_STATUS'			=> ($bbcode_status) ? sprintf($user->lang['BBCODE_IS_ON'], '<a href="' . append_sid($phpbb_root_path."faq.$phpEx", 'mode=bbcode') . '">', '</a>') : sprintf($user->lang['BBCODE_IS_OFF'], '<a href="' . append_sid($phpbb_root_path."faq.$phpEx", 'mode=bbcode') . '">', '</a>'),
		'IMG_STATUS'			=> ($img_status) ? $user->lang['IMAGES_ARE_ON'] : $user->lang['IMAGES_ARE_OFF'],
		'SMILIES_STATUS'		=> ($smilies_status) ? $user->lang['SMILIES_ARE_ON'] : $user->lang['SMILIES_ARE_OFF'],
		'URL_STATUS'			=> ($bbcode_status && $url_status) ? $user->lang['URL_IS_ON'] : $user->lang['URL_IS_OFF'],

		'L_TITLE'				=> $title,
		'L_DIR_DESCRIPTION_EXP'	=> sprintf($user->lang['DIR_DESCRIPTION_EXP'], $config['dir_length_describe']),
		'L_DIR_SUBMIT_TYPE'		=> dir_submit_type($categorie->data['cat_validate']),
		'L_DIR_SITE_BANN_EXP'	=> sprintf($user->lang['DIR_SITE_BANN_EXP'], $config['dir_banner_width'], $config['dir_banner_height']),

		'S_GUEST'				=> $s_guest ? true : false,
		'S_RSS'					=> $s_rss ? true : false,
		'S_BANNER'				=> $s_banner ? true : false,
		'S_BACK'				=> $s_back ? true : false,
		'S_FLAG'				=> $s_flag ? true : false,
		'S_BBCODE_ALLOWED' 		=> (bool)$bbcode_status,

		'DIR_FLAG_PATH'			=> $flag_path,
		'DIR_FLAG_IMAGE'		=> $flag ? $flag_path . $flag : $phpbb_root_path . 'images/spacer.gif',

		'EDIT_MODE'				=> ($mode == 'edit') ? true : false,

		'SITE_NAME'				=> isset($site_name) ? $site_name : '',
		'SITE_URL'				=> isset($url) ? $url : '',
		'DESCRIPTION'			=> isset($description) ? $description : '',
		'GUEST_EMAIL'			=> isset($guest_email) ? $guest_email : '',
		'RSS'					=> isset($rss) ? $rss : '',
		'BANNER'				=> isset($banner) ? $banner : '',
		'BACK'					=> isset($back) ? $back : '',
		'S_POST_ACTION'			=> build_url(),
		'S_CATLIST'				=> $categorie->make_cat_select($id),
		'S_LIST_FLAG'			=> get_dir_flag_list($flag),
		'S_DESC_STAR'			=> (@$categorie->data['cat_must_describe']) ? '*' : '',
		'S_ROOT'				=> $id,
		'S_HIDDEN_FIELDS'		=> build_hidden_fields($s_hidden_fields),

		'U_SOMMAIRE'			=> append_sid("{$directory_root_path}directory.$phpEx"),
	));
}
else if ($mode == 'cat')
{
	if (!$id)
	{
		send_status_line(404, 'Not Found');

		redirect('directory.'.$phpEx);
	}

	$link_list = array();
	$sort_days	= request_var('st', 0);
	$sort_key	= request_var('sk', (string)substr($config['dir_default_order'], 0, 1));
	$sort_dir	= request_var('sd', (string)substr($config['dir_default_order'], 2));

	// We gete notification status

	$data = array(
		'n_user_id' 	=> (int)$user->data['user_id'],
		'n_cat_id' 	=> (int)$id,
	);

	$sql = 'SELECT n_user_id FROM ' . DIR_NOTIFICATION_TABLE . ' WHERE ' . $db->sql_build_array('SELECT', $data);
	$result = $db->sql_query($sql);
	$cat = $db->sql_fetchrow($result);

	// Categorie ordering options
	$limit_days		= array(0 => $user->lang['ALL_TOPICS'], 1 => $user->lang['1_DAY'], 7 => $user->lang['7_DAYS'], 14 => $user->lang['2_WEEKS'], 30 => $user->lang['1_MONTH'], 90 => $user->lang['3_MONTHS'], 180 => $user->lang['6_MONTHS'], 365 => $user->lang['1_YEAR']);
	$sort_by_text	= array('a' => $user->lang['AUTHOR'], 't' => $user->lang['POST_TIME'], 'r' => $user->lang['DIR_COMMENTS_ORDER'], 's' =>  $user->lang['DIR_NAME_ORDER'], 'v' => $user->lang['DIR_NB_CLICS_ORDER'], 'p' => $user->lang['DIR_PR_ORDER']);
	$sort_by_sql	= array('a' => 'u.username', 't' => 'l.link_time', 'r' => 'l.link_comment', 's' => 'l.link_name', 'v' => 'l.link_view', 'p' => 'l.link_pagerank');

	$s_limit_days = $s_sort_key = $s_sort_dir = $u_sort_param = '';
	gen_sort_selects($limit_days, $sort_by_text, $sort_days, $sort_key, $sort_dir, $s_limit_days, $s_sort_key, $s_sort_dir, $u_sort_param);

	$u_sort_param = ($sort_days === 0 && $sort_key == (string)substr($config['dir_default_order'], 0, 1) && $sort_dir == (string)substr($config['dir_default_order'], 2)) ? '' : '&amp;'.$u_sort_param;

	// A deadline has been selected
	if ($sort_days)
	{
		$min_post_time = time() - ($sort_days * 86400);

		$sql = 'SELECT COUNT(link_id) AS nb_links
			FROM ' . DIR_LINK_TABLE . '
			WHERE link_cat = ' . (int)$id . '
				AND link_time >= ' . $min_post_time;
		$result = $db->sql_query($sql);
		$nb_links = (int) $db->sql_fetchfield('nb_links');
		$db->sql_freeresult($result);

		if (isset($_POST['sort']))
		{
			$start = 0;
		}
		$sql_limit_time = " AND l.link_time >= $min_post_time";
	}
	else
	{
		$sql_limit_time = '';
		$nb_links		= $categorie->data['cat_links'];
	}

	// Make sure $start is set to the last page if it exceeds the amount
	if ($start < 0 || $start > $nb_links)
	{
		$start = ($start < 0) ? 0 : floor(($nb_links - 1) / $config['dir_show']) * $config['dir_show'];
	}

	$categorie->display();

	$title .= ' - ' . $categorie->data['cat_name'];

	// Build navigation links
	generate_dir_nav($categorie->data);

	$template->assign_vars(array(
		'L_DIR_CAT_NAME'		=> $user->lang['DIR_CAT_NAME'] . ': ' . $categorie->data['cat_name'],
		'L_DIR_NOTIFICATION'	=> (($cat['n_user_id']) ? $user->lang['DIR_BE_NOT_NOTIFIED'] : $user->lang['DIR_BE_NOTIFIED']),

		'U_PAGE'				=> append_sid("{$directory_root_path}directory.$phpEx", "mode=cat&amp;id=$id{$u_sort_param}", true),
		'U_ORDER'				=> append_sid("{$directory_root_path}directory.$phpEx", array('mode' => 'cat', 'id' => $id, 'cat' => $cat), true),
		'U_NOTIFICATION'		=> append_sid("{$directory_root_path}directory.$phpEx", array('mode' => 'notification', 'id' => $id, 'notif' => ($cat['n_user_id']) ? 0 : 1), true),

		'S_ACTION'				=> append_sid("{$directory_root_path}directory.$phpEx", "mode=cat&amp;id=$id&amp;start=$start", true),
		'S_SELECT_SORT_DIR'		=> $s_sort_dir,
		'S_SELECT_SORT_KEY'		=> $s_sort_key,
		'S_SELECT_SORT_DAYS'	=> $s_limit_days,
		'S_CATLIST'				=> $categorie->make_cat_select($id),
		'S_JUMPBOX_ACTION'		=> append_sid("{$directory_root_path}directory.$phpEx"),

		'S_CAT_ID'				=> $id,
		'S_NOTIFICATION'		=> ($config['email_enable'] && $user->data['is_registered']) ? true : false,

		'PAGE_NUMBER'			=> on_page($nb_links, $config['dir_show'], $start),
		'PAGINATION'			=> generate_pagination(append_sid("{$directory_root_path}directory.$phpEx", "mode=cat&amp;id=$id{$u_sort_param}", true), $nb_links, $config['dir_show'], $start),
		'TOTAL_LINKS'			=> (($nb_links > 1) ? sprintf($user->lang['DIR_NB_LINKS'], $nb_links) : sprintf($user->lang['DIR_NB_LINK'], $nb_links)),
	));

	// If the user is trying to reach late pages, start searching from the end
	$store_reverse = false;
	$sql_limit = $config['dir_show'];
	if ($start > $nb_links / 2)
	{
		$store_reverse = true;

		if ($start + $config['dir_show'] > $nb_links)
		{
			$sql_limit = min($config['dir_show'], max(1, $nb_links - $start));
		}

		// Select the sort order
		$sql_sort_order = $sort_by_sql[$sort_key] . ' ' . (($sort_dir == 'd') ? 'ASC' : 'DESC');
		$sql_start		= max(0, $nb_links - $sql_limit - $start);
	}
	else
	{
		// Select the sort order
		$sql_sort_order	= $sort_by_sql[$sort_key] . ' ' . (($sort_dir == 'd') ? 'DESC' : 'ASC');
		$sql_start		= $start;
	}

	// Grab just the sorted link ids
	$sql_array = array(
		'SELECT'	=> 'l.link_id',
		'FROM'		=> array(
				DIR_LINK_TABLE	=> 'l'),
		'LEFT_JOIN'	=> array(
				array(
					'FROM'	=> array(USERS_TABLE	=> 'u'),
					'ON'	=> 'l.link_user_id = u.user_id'
				),
		),
		'WHERE'		=> "l.link_cat = $id
			AND l.link_active = 1
				$sql_limit_time",
		'ORDER_BY'	=> $sql_sort_order);

	$sql = $db->sql_build_query('SELECT', $sql_array);
	$result = $db->sql_query_limit($sql, $sql_limit, $sql_start);

	while ($row = $db->sql_fetchrow($result))
	{
		$link_list[] = (int) $row['link_id'];
	}
	$db->sql_freeresult($result);

	if (sizeof($link_list))
	{
		/*
		** We get links, informations about poster, votes and number of comments
		*/
		$sql_array = array(
			'SELECT'	=> 'l.link_id, l.link_cat, l.link_url, l.link_user_id, l.link_comment, l. link_description, l.link_banner, l.link_rss, l. link_uid, l.link_bitfield, l.link_flags, l.link_vote, l.link_note, l.link_view, l.link_time, l.link_name, l.link_flag, l.link_pagerank, l.link_thumb, u.user_id, u.username, u.user_colour, v.vote_user_id',
			'FROM'		=> array(
					DIR_LINK_TABLE	=> 'l'),
			'LEFT_JOIN'	=> array(
					array(
						'FROM'	=> array(USERS_TABLE	=> 'u'),
						'ON'	=> 'l.link_user_id = u.user_id'
					),
					array(
						'FROM'	=> array(DIR_VOTE_TABLE => 'v'),
						'ON'	=> 'l.link_id = v.vote_link_id AND v.vote_user_id = ' . $user->data['user_id']
					)
			),
			'WHERE'		=> $db->sql_in_set('l.link_id', $link_list). $sql_limit_time);

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);

		while ($site = $db->sql_fetchrow($result))
		{
			$rowset[$site['link_id']] = $site;
		}
		$db->sql_freeresult($result);

		$link_list = ($store_reverse) ? array_reverse($link_list) : $link_list;

		$votes_status 		= ((int)$categorie->data['cat_allow_votes']) ? true : false;
		$comments_status 	= ((int)$categorie->data['cat_allow_comments']) ? true : false;

		foreach ($link_list as $link_id)
		{
			$site = &$rowset[$link_id];

			$s_flag		= $link->display_flag($site);
			$s_note		= $link->display_note($site['link_note'], $site['link_vote'], $votes_status);
			$s_thumb	= $link->display_thumb($site);
			$s_vote		= $link->display_vote($site, $votes_status);
			$s_comment	= $link->display_comm($site['link_id'], $site['link_comment'], $comments_status);
			$s_banner	= $link->display_bann($site);
			$s_pr		= $link->display_pagerank($site);
			$s_rss		= $site['link_rss'];

			$edit_allowed 	= ($user->data['is_registered'] && ($auth->acl_get('m_edit_dir') || ($user->data['user_id'] == $site['link_user_id'] && $auth->acl_get('u_edit_dir'))));
			$delete_allowed = ($user->data['is_registered'] && ($auth->acl_get('m_delete_dir') || ($user->data['user_id'] == $site['link_user_id'] && $auth->acl_get('u_delete_dir'))));

			$template->assign_block_vars('site', array(
				'LINK_ID'		=> $site['link_id'],
				'USER'			=> get_username_string('full', $site['link_user_id'], $site['username'], $site['user_colour']),
				'DESCRIPTION' 	=> generate_text_for_display($site['link_description'], $site['link_uid'], $site['link_bitfield'], $site['link_flags']),
				'THUMB'			=> '<img src="'.$s_thumb.'" alt="'.$user->lang['DIR_THUMB'].'" title="'.$site['link_name'].'"/>',
				'NOTE'			=> $s_note,
				'NB_VOTE'		=> ($site['link_vote'] > 1) ? $user->lang('DIR_NB_VOTES', $site['link_vote'])  : sprintf($user->lang['DIR_NB_VOTE'], $site['link_vote']),
				'VOTE'			=> $s_vote,
				'PAGERANK'		=> $s_pr,
				'COMMENT'		=> $s_comment,
				'BANNER'		=> $s_banner,
				'RSS'			=> $s_rss,
				'COUNT'			=> ($site['link_view'] > 1) ? sprintf($user->lang['DIR_NB_CLICS'], $site['link_view']) : sprintf($user->lang['DIR_NB_CLIC'], $site['link_view']),
				'TIME'			=> ($site['link_time']) ? $user->format_date($site['link_time']) : '',
				'NAME'			=> $site['link_name'],

				'S_NEW_LINK'	=> (((time() - $site['link_time']) / 86400) <= $config['dir_new_time']) ? true : false,
				'S_HAVE_FLAG'	=> $config['dir_activ_flag'] ? true : false,

				'IMG_FLAG'		=> $s_flag,
				'ON_CLICK' 		=> "onclick=\"window.open('".append_sid($directory_root_path.'directory.'.$phpEx, array('mode' => 'view_url', 'u' => $site['link_id']))."');return false;\"",

				'U_LINK'	=> $site['link_url'],
				'U_EDIT'	=> ($edit_allowed) ? append_sid("{$directory_root_path}directory.$phpEx", "mode=edit&amp;id=$id&amp;u=" . $site['link_id'], true) : '',
				'U_DELETE'	=> ($delete_allowed) ? append_sid("{$directory_root_path}directory.$phpEx", "mode=delete&amp;id=$id&amp;u=" . $site['link_id'], true) : '',
			));
		}

		// Links back verification is on, we do a checkup
		if ($categorie->data['cat_cron_enable'] && $categorie->data['cat_cron_next'] < time())
		{
			$template->assign_var('RUN_CRON_TASK', '<img src="' . append_sid($phpbb_root_path . 'cron.' . $phpEx, 'cron_type=prune_directory&amp;cat=' . $id) . '" alt="cron" width="1" height="1" />');
		}
	}
	else
	{
		$template->assign_block_vars('no_draw_link', array());
	}
}
else if ($mode == 'view_url')
{
	$link->view($u);
}
else
{
	$categorie->display();
	recent_links();
}

page_header($title, false);

$template->assign_var('DIRECTORY_TRANSLATION_INFO', (!empty($user->lang['DIRECTORY_TRANSLATION_INFO'])) ? $user->lang['DIRECTORY_TRANSLATION_INFO'] : '');

page_footer(false);

?>
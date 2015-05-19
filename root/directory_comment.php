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
include($phpbb_root_path . 'includes/functions_posting.' . $phpEx);
include($phpbb_root_path . 'includes/functions_display.' . $phpEx);
$directory_root_path = $config['dir_root_path'];

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/directory');

$mode = request_var('mode', '');
$u = request_var('u', 0);
$id = request_var('id', 0);
$start	= request_var('start', 0);
$view = request_var('view', '');
$s_hidden_fields = array();

$sql = 'SELECT link_cat FROM ' . DIR_LINK_TABLE . ' WHERE link_id = ' . (int)$u;
$result = $db->sql_query($sql);
$cat_id = (int) $db->sql_fetchfield('link_cat');
$db->sql_freeresult($result);

$categorie	= new categorie($cat_id);

if(!$categorie->data['cat_allow_comments'])
{
	trigger_error('DIR_ERROR_NOT_AUTH');
}

$comm = new comment;

// The CAPTCHA kicks in here. We can't help that the information gets lost on language change.
if(!$user->data['is_registered'] && $config['dir_visual_confirm'])
{
	include($phpbb_root_path . 'includes/captcha/captcha_factory.' . $phpEx);
	$captcha =& phpbb_captcha_factory::get_instance($config['captcha_plugin']);
	$captcha->init(CONFIRM_POST);
}

// get config for options
$bbcode_status	= $config['dir_allow_bbcode'] ? true : false;
$smilies_status	= $config['dir_allow_smilies'] ? true : false;
$img_status		= $bbcode_status ? true : false;
$url_status		= $config['dir_allow_links'] ? true : false;

// submit form
if (isset($_POST['submit_comment']) || isset($_POST['update_comment']) || isset($_POST['refresh_vc']))
{
	if (!$auth->acl_get('u_comment_dir'))
	{
		trigger_error('DIR_ERROR_NOT_AUTH');
	}

	if (!check_form_key('dir_form_comment'))
	{
		trigger_error('FORM_INVALID');
	}

	$reply = utf8_normalize_nfc(request_var('message', '', true));
	include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
	$user->add_lang('ucp');

	$error = validate_data(
		array(
			'reply' => $reply),
		array(
			'reply' => array(
				array('string', false, 1, $config['dir_length_comments'])
			)
		)
	);

	$error = preg_replace('#^([A-Z_]+)$#e', "(!empty(\$user->lang['\\1'])) ? \$user->lang['\\1'] : '\\1'", $error);

	if (!$user->data['is_registered'] && $config['dir_visual_confirm'])
	{
		$vc_response = $captcha->validate();
		if ($vc_response !== false)
		{
			$error[] = $vc_response;
		}

		if ($config['dir_visual_confirm_max_attempts'] && $captcha->get_attempt_count() > $config['dir_visual_confirm_max_attempts'])
		{
			$error[] = $user->lang['TOO_MANY_ADDS'];
		}
	}

	if ($error)
	{
		$template->assign_vars( array(
	   		'ERROR'	=> (sizeof($error)) ? implode('<br />', $error) : ''
	   	));
	}
	else
	{
		$poll = $uid = $bitfield = '';
		$flags = (($bbcode_status) ? OPTION_FLAG_BBCODE : 0) + (($smilies_status) ? OPTION_FLAG_SMILIES : 0) + (($url_status) ? OPTION_FLAG_LINKS : 0);
		generate_text_for_storage($reply, $uid, $bitfield, $flags, $config['dir_allow_bbcode'], $config['dir_allow_links'], $config['dir_allow_smilies']);

		$data_edit = array(
			'comment_text'		=> $reply,
			'comment_uid'		=> $uid,
			'comment_flags'		=> $flags,
			'comment_bitfield'	=> $bitfield,
		);

		if (isset($_POST['submit_comment']))
		{
			$data_add = array(
				'comment_link_id'	=> (int)$u,
				'comment_date'		=> time(),
				'comment_user_id'	=> $user->data['user_id'],
				'comment_user_ip'	=> $user->ip,
			);

			$data_add = array_merge($data_edit, $data_add);

			$comm->add($data_add);

		}
		elseif (isset($_POST['update_comment']))
		{
			$comm->edit($data_edit, $id);
		}
	}
}
elseif ($mode == 'edit' || $mode == 'delete')
{
	$sql = 'SELECT * FROM ' . DIR_COMMENT_TABLE . '
			WHERE comment_id = ' . $id;
	$result = $db->sql_query($sql);
	$value = $db->sql_fetchrow($result);

	if($mode == 'edit')
	{
		if (!$auth->acl_get('m_edit_comment_dir') && (!$auth->acl_get('u_edit_comment_dir') || $user->data['user_id'] != $value['comment_user_id']))
		{
			trigger_error('DIR_ERROR_NOT_AUTH');
		}

		$s_comment = generate_text_for_edit($value['comment_text'], $value['comment_uid'], $value['comment_flags']);

		$s_hidden_fields = array(
			'id'	=> (int)$id,
		);
	}
	else
	{
		if (!$auth->acl_get('m_delete_comment_dir') && (!$auth->acl_get('u_delete_comment_dir') || $user->data['user_id'] != $value['comment_user_id']))
		{
			trigger_error('DIR_ERROR_NOT_AUTH');
		}
		$template->assign_vars( array(
			'S_DELETE'			=> true,
		));

		$comm->del($id, $u);
	}
}

//
// main
$sql = 'SELECT COUNT(comment_id) AS nb_comments
			FROM ' . DIR_COMMENT_TABLE . '
			WHERE comment_link_id = ' . (int)$u;
$result = $db->sql_query($sql);
$nb_comments = (int) $db->sql_fetchfield('nb_comments');
$db->sql_freeresult($result);

if ($start < 0 || $start >= $nb_comments)
{
	$start = ($start < 0) ? 0 : floor(($nb_comments - 1) / $config['dir_comments_per_page']) * $config['dir_comments_per_page'];
}

$sql_array = array(
	'SELECT'	=> 'a.comment_id, a.comment_user_id, a. comment_user_ip, a.comment_date, a.comment_text, a.comment_uid, a.comment_bitfield, a.comment_flags, u.username, u.user_id, u.user_colour, z.foe',
	'FROM'		=> array(
			DIR_COMMENT_TABLE	=> 'a'),
	'LEFT_JOIN'	=> array(
			array(
				'FROM'	=> array(USERS_TABLE => 'u'),
				'ON'	=> 'a.comment_user_id = u.user_id'
			),
			array(
				'FROM'	=> array(ZEBRA_TABLE => 'z'),
				'ON'	=> 'z.user_id = ' . $user->data['user_id'] . ' AND z.zebra_id = a.comment_user_id'
			)
	),
	'WHERE'		=> 'a.comment_link_id = ' . $u,
	'ORDER_BY'	=> 'a.comment_date DESC');

$sql = $db->sql_build_query('SELECT', $sql_array);
$result = $db->sql_query_limit($sql, $config['dir_comments_per_page'], $start);

$have_result = false;
$s_admin = ($auth->acl_get('a_')) ? true : false;

while ($comments = $db->sql_fetchrow($result))
{
	$have_result = true;

	$edit_allowed = ($user->data['is_registered'] && ($auth->acl_get('m_edit_comment_dir') || (
		$user->data['user_id'] == $comments['comment_user_id'] &&
		$auth->acl_get('u_edit_comment_dir')
	)));

	$delete_allowed = ($user->data['is_registered'] && ($auth->acl_get('m_delete_comment_dir') || (
		$user->data['user_id'] == $comments['comment_user_id'] &&
		$auth->acl_get('u_delete_comment_dir')
	)));

	$template->assign_block_vars('comment', array(
		'MINI_POST_IMG'		=> $user->img('icon_post_target', 'POST'),
		'S_USER'			=> get_username_string('full', $comments['comment_user_id'], $comments['username'], $comments['user_colour']),
		'S_USER_IP'			=> $comments['comment_user_ip'],
		'S_DATE'			=> $user->format_date($comments['comment_date']),
		'S_COMMENT'			=> generate_text_for_display($comments['comment_text'], $comments['comment_uid'], $comments['comment_bitfield'], $comments['comment_flags']),
		'S_ID'				=> $comments['comment_id'],

		'U_EDIT'			=> ($edit_allowed) ? append_sid("{$directory_root_path}directory_comment.$phpEx", "mode=edit&amp;u={$u}&amp;id={$comments['comment_id']}") : '',
		'U_DELETE'			=> ($delete_allowed) ? append_sid("{$directory_root_path}directory_comment.$phpEx", "mode=delete&amp;u={$u}&amp;id={$comments['comment_id']}") : '',

		'S_IGNORE_POST'		=> ($comments['foe'] && $view != 'show') ? true : false,
		'L_IGNORE_POST'		=> ($comments['foe']) ? sprintf($user->lang['POST_BY_FOE'], get_username_string('full', $comments['comment_user_id'], $comments['username'], $comments['user_colour']), '<a href="'.append_sid("{$directory_root_path}directory_comment.$phpEx", "u={$u}&amp;view=show#c{$comments['comment_id']}").'">', '</a>') : '',
		'S_INFO'			=> $auth->acl_get('m_info'),
	));
}

$user->add_lang(array('ucp', 'posting'));
generate_smilies('inline', 0);
display_custom_bbcodes();
add_form_key('dir_form_comment');

if (!$user->data['is_registered'] && $config['dir_visual_confirm'])
{
	$s_hidden_fields = array_merge($s_hidden_fields, $captcha->get_hidden_fields());

	$template->assign_vars(array(
		'CAPTCHA_TEMPLATE'		=> $captcha->get_template(),
	));
}

$template->assign_vars( array(
	'S_AUTH_COMM' 		=> $auth->acl_get('u_comment_dir'),
	'S_DELETE'			=> ($mode == 'delete') ? true : false,
	'S_DIR_COMMENT'		=> true,

	'BBCODE_STATUS'		=> ($bbcode_status) ? sprintf($user->lang['BBCODE_IS_ON'], '<a href="' . append_sid($phpbb_root_path."faq.$phpEx", 'mode=bbcode') . '">', '</a>') : sprintf($user->lang['BBCODE_IS_OFF'], '<a href="' . append_sid($phpbb_root_path."faq.$phpEx", 'mode=bbcode') . '">', '</a>'),
	'IMG_STATUS'		=> ($img_status) ? $user->lang['IMAGES_ARE_ON'] : $user->lang['IMAGES_ARE_OFF'],
	'SMILIES_STATUS'	=> ($smilies_status) ? $user->lang['SMILIES_ARE_ON'] : $user->lang['SMILIES_ARE_OFF'],
	'URL_STATUS'		=> ($bbcode_status && $url_status) ? $user->lang['URL_IS_ON'] : $user->lang['URL_IS_OFF'],
	'PAGINATION'		=> ($nb_comments / $config['dir_comments_per_page'] > 1) ? generate_pagination(append_sid("{$directory_root_path}directory_comment.$phpEx", "u=$u", true), $nb_comments, $config['dir_comments_per_page'], $start) : '',
	'PAGE_NUMBER'		=> on_page($nb_comments, $config['dir_comments_per_page'], $start),
	'TOTAL_LINKS'		=> (($nb_comments > 1) ? sprintf($user->lang['DIR_SEARCH_NB_COMMS'], $nb_comments) : sprintf($user->lang['DIR_SEARCH_NB_COMM'], $nb_comments)),

	'L_DIR_REPLY_EXP'	=> sprintf($user->lang['DIR_REPLY_EXP'], $config['dir_length_comments']),

	'S_COMMENT' 		=> isset($s_comment['text']) ? $s_comment['text'] : '',
	'S_BBCODE_ALLOWED' 	=> $bbcode_status,
	'S_SMILIES_ALLOWED' => $smilies_status,
	'S_HAVE_RESULT'		=> $have_result ? true : false,
	'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
	'S_BUTTON_NAME'		=> ($mode == 'edit') ? 'update_comment' : 'submit_comment',
	'S_POST_ACTION' 	=> append_sid("{$directory_root_path}directory_comment.$phpEx", array('u' => $u)),

));

page_header($user->lang['DIR_COMMENT_TITLE'], false);
$template->set_filenames(array('body' => 'mods/directory/comment_body.html'));
page_footer(false);

?>
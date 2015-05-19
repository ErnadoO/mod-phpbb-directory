<?php
/**
 *
 * @package install
 * @version $Id: functions_phpbb2_directory.php 2009-08-11 16:56:48Z ErnadoO $
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Helper functions for phpBB 2.0.x to phpBB 3.0.x conversion
*/


/**
* Insert/Convert forums
*/
function phpbb_insert_categories()
{
	global $db, $src_db, $same_db, $convert, $user, $config;

	$db->sql_query($convert->truncate_statement . DIR_CAT_TABLE);

	$sql = 'SELECT *
		FROM ' . $convert->src_table_prefix . 'annuaire_cat
		ORDER BY annu_cat_subid, annu_cat_order';

	if ($convert->mysql_convert && $same_db)
	{
		$src_db->sql_query("SET NAMES 'binary'");
	}

	$result = $src_db->sql_query($sql);

	if ($convert->mysql_convert && $same_db)
	{
		$src_db->sql_query("SET NAMES 'utf8'");
	}

	switch ($db->sql_layer)
	{
		case 'mssql':
		case 'mssql_odbc':
			$db->sql_query('SET IDENTITY_INSERT ' . DIR_CAT_TABLE . ' ON');
		break;
	}

	$cats_added = array();
	$next_right_id = $left_right_id = 0;
	while ($row = $src_db->sql_fetchrow($result))
	{
		$sql_ary = array(
			'cat_id'				=> (int)$row['annu_cat_id'],
			'parent_id'				=> (int)$row['annu_cat_subid'],
			'cat_parents'			=> '',
			'cat_desc'				=> phpbb_set_default_encoding($row['annu_cat_desc'], ENT_COMPAT, 'UTF-8'),
			'cat_desc_uid'			=> '',
			'cat_desc_bitfield'	=> '',
			'cat_desc_options'		=> 7,
			'cat_name'				=> ($row['annu_cat_name']) ? htmlspecialchars(phpbb_set_default_encoding($row['annu_cat_name']), ENT_COMPAT, 'UTF-8') : '',
			'cat_icon'				=> array_pop(explode('/', $row['annu_cat_icon'])),
			'cat_cron_freq'		=> 7,
			'cat_cron_nb_check'	=> 1,
		);

		$sql = 'SELECT annu_cat_id
		FROM ' . $convert->src_table_prefix . 'annuaire_cat
		WHERE annu_cat_id = '.$row['annu_cat_subid'];
		$result2 = $src_db->sql_query($sql);

		$row2 = $db->sql_fetchrow($result2);

		if (!$row2 && $row['annu_cat_subid'])
		{
			continue;
		}

		update_cat_data($sql_ary);
	}
	$src_db->sql_freeresult($result);

	switch ($db->sql_layer)
	{
		case 'postgres':
			$db->sql_query("SELECT SETVAL('" . DIR_CAT_TABLE . "_seq',(select case when max(cat_id)>0 then max(cat_id)+1 else 1 end from " . DIR_CAT_TABLE . '));');
		break;

		case 'mssql':
		case 'mssql_odbc':
			$db->sql_query('SET IDENTITY_INSERT ' . DIR_CAT_TABLE . ' OFF');
		break;

		case 'oracle':
			$result = $db->sql_query('SELECT MAX(cat_id) as max_id FROM ' . DIR_CAT_TABLE);
			$row = $db->sql_fetchrow($result);
			$db->sql_freeresult($result);

			$largest_id = (int) $row['max_id'];

			if ($largest_id)
			{
				$db->sql_query('DROP SEQUENCE ' . DIR_CAT_TABLE . '_seq');
				$db->sql_query('CREATE SEQUENCE ' . DIR_CAT_TABLE . '_seq START WITH ' . ($largest_id + 1));
			}
		break;
	}
}

function update_cat_data(&$cat_data)
{
	global $db, $user, $cache;

	// Unset data that are not database fields
	$cat_data_sql = $cat_data;

	if ($cat_data_sql['parent_id'])
	{
		$sql = 'SELECT left_id, right_id
				FROM ' . $convert->src_table_prefix . 'annuaire_cats
				WHERE annu_cat_id = ' . $cat_data_sql['parent_id'];
		$_result = $db->sql_query($sql);

		$row = $db->sql_fetchrow($_result);
		$db->sql_freeresult($_result);

		if (!$row)
		{
			trigger_error($sql);
		}

		$sql = 'UPDATE ' . DIR_CAT_TABLE . '
				SET left_id = left_id + 2, right_id = right_id + 2
				WHERE left_id > ' . $row['right_id'];
		$db->sql_query($sql);

		$sql = 'UPDATE ' . DIR_CAT_TABLE . '
				SET right_id = right_id + 2
				WHERE ' . $row['left_id'] . ' BETWEEN left_id AND right_id';
		$db->sql_query($sql);

		$cat_data_sql['left_id'] = $row['right_id'];
		$cat_data_sql['right_id'] = $row['right_id'] + 1;
	}
	else
	{
		$sql = 'SELECT MAX(right_id) AS right_id
					FROM ' . DIR_CAT_TABLE;
		$_result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($_result);
		$db->sql_freeresult($_result);

		$cat_data_sql['left_id'] = $row['right_id'] + 1;
		$cat_data_sql['right_id'] = $row['right_id'] + 2;

		$cat_data_sql['display_subcat_list'] = 1;
	}
	$sql = 'INSERT INTO ' . DIR_CAT_TABLE . ' ' . $db->sql_build_array('INSERT', $cat_data_sql);
	$db->sql_query($sql);
}

function sync_cats($mode, $where_ids = '')
{
	global $db;

	switch ($mode)
	{
		case 'cat':

			$sql = 'SELECT *
				FROM ' . DIR_CAT_TABLE;
			$result = $db->sql_query($sql);

			while ($row = $db->sql_fetchrow($result))
			{
				$sql = 'SELECT COUNT(link_id) AS num_links
					FROM ' . DIR_LINK_TABLE . '
					WHERE link_cat = ' . $row['cat_id'] . '
					AND link_active = 1';
				$result2 = $db->sql_query($sql);
				$total_links = (int) $db->sql_fetchfield('num_links');
				$db->sql_freeresult($result2);

				$sql = 'UPDATE ' . DIR_CAT_TABLE . '
					SET cat_links = ' . $total_links . '
					WHERE cat_id = ' . $row['cat_id'];
				$db->sql_query($sql);
			}
			break;

		case 'links':

			$dir_link_id_ary = array();

			$sql_ids = 'SELECT link_id FROM ' . DIR_LINK_TABLE . '
				WHERE ' . $where_ids;
			$result_ids = $db->sql_query($sql_ids);
			while ($tmp = $db->sql_fetchrow($result_ids))
			{
				$link_id = (int)$tmp['link_id'];
				$dir_link_id_ary[$link_id] = $tmp['link_id'];
				$link_data[$link_id]['link_note'] = 0;
				$link_data[$link_id]['link_vote'] = 0;
				$link_data[$link_id]['link_comment'] = 0;
			}
			$db->sql_freeresult($result_ids);


			$sql = 'SELECT vote_link_id, COUNT(vote_note) AS nb_vote, SUM(vote_note) AS total FROM ' . DIR_VOTE_TABLE . '
				WHERE ' . $db->sql_in_set('vote_link_id', $dir_link_id_ary);
			$result = $db->sql_query($sql);
			while ($tmp = $db->sql_fetchrow($result))
			{
				if($tmp['vote_link_id'])
				{
					$link_id = $tmp['vote_link_id'];
					$link_data[$link_id]['link_note'] = $tmp['total'];
					$link_data[$link_id]['link_vote'] = $tmp['nb_vote'];
				}
			}
			$db->sql_freeresult($result);

			$sql = 'SELECT comment_link_id, COUNT(comment_id) AS nb_comment FROM ' . DIR_COMMENT_TABLE . '
				WHERE ' . $db->sql_in_set('comment_link_id', $dir_link_id_ary);
			$result = $db->sql_query($sql);

			while ($tmp = $db->sql_fetchrow($result))
			{
				if($tmp['comment_link_id'])
				{
					$link_id = $tmp['comment_link_id'];
					$link_data[$link_id]['link_comment'] = $tmp['nb_comment'];
				}
			}
			$db->sql_freeresult($result);

			foreach ($link_data as $id => $row)
			{
				$sql = 'UPDATE ' . DIR_LINK_TABLE . '
						SET ' . $db->sql_build_array('UPDATE', $row) . '
						WHERE link_id = ' . $id;
				$db->sql_query($sql);
			}

			break;
	}
}

function insert_ascreen($url)
{
	$details = parse_url($url);

	$root_url		= $details['scheme'].'://'.$details['host'];
	$absolute_url	= isset($details['path']) ? $root_url.$details['path'] : $root_url;

	return 'http://www.apercite.fr/apercite/120x90/oui/oui/'.$absolute_url;
}

function parse_cats_descriptions()
{
	global $db;

	$sql = 'SELECT cat_id, cat_desc, cat_desc_uid, cat_desc_bitfield, cat_desc_options
		FROM ' . DIR_CAT_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if ($row['cat_desc'])
		{
			generate_text_for_storage($row['cat_desc'], $row['cat_desc_uid'], $row['cat_desc_bitfield'], $row['cat_desc_options'], true, true, true);

			$cat_id = $row['cat_id'];
			unset($row['cat_id']);

			$sql = 'UPDATE ' . DIR_CAT_TABLE . '
					SET '. $db->sql_build_array('UPDATE', $row).'
				WHERE cat_id = ' . $cat_id;
			$db->sql_query($sql);
		}
	}
}

function parse_links_descriptions()
{
	global $db;

	$sql = 'SELECT link_id, link_description, link_uid, link_bitfield, link_flags
			FROM ' . DIR_LINK_TABLE;
	$result = $db->sql_query($sql);

	while ($row = $db->sql_fetchrow($result))
	{
		if ($row['link_description'])
		{
			generate_text_for_storage($row['link_description'], $row['link_uid'], $row['link_bitfield'], $row['link_flags'], true, true, true);

			$link_id = $row['link_id'];
			unset($row['link_id']);

			$sql = 'UPDATE ' . DIR_LINK_TABLE . '
					SET '. $db->sql_build_array('UPDATE', $row).'
					WHERE link_id = ' . $link_id;
			$db->sql_query($sql);
		}
	}
}

function update_dir_link_time($id)
{
	return (time()+$id);
}

function update_dir_link_flag($old_filename)
{
	switch(strtolower($old_filename))
	{
		case 'belgium.gif':
			$new_filename = 'be.png';
			break;

		case 'canada.gif':
			$new_filename = 'ca.png';
			break;

		case 'china.gif':
			$new_filename = 'cn.png';
			break;

		case 'england.gif':
			$new_filename = 'gb.png';
			break;

		case 'france.gif':
			$new_filename = 'fr.png';
			break;

		case 'germany.gif':
			$new_filename = 'de.png';
			break;

		case 'italia.gif':
			$new_filename = 'it.png';
			break;

		case 'japan.gif':
			$new_filename = 'jp.png';
			break;

		case 'spain.gif':
			$new_filename = 'es.png';
			break;

		case 'usa.gif':
			$new_filename = 'us.png';
			break;

		default:
			$new_filename = '';
	}

	return $new_filename;

}

/**
* Function for recoding text with the default language
*
* @param string $text text to recode to utf8
* @param bool $grab_user_lang if set to true the function tries to use $convert_row['user_lang'] (and falls back to $convert_row['poster_id']) instead of the boards default language
*/
function phpbb_set_encoding($text, $grab_user_lang = true)
{

	return utf8_recode($text, 'ISO-8859-1');
}

/**
* Same as phpbb_set_encoding, but forcing boards default language
*/
function phpbb_set_default_encoding($text)
{
	return phpbb_set_encoding($text, false);
}

/**
* Return correct user id value
* Everyone's id will be one higher to allow the guest/anonymous user to have a positive id as well
*/
function phpbb_user_id($user_id)
{
	global $config;

	// Increment user id if the old forum is having a user with the id 1
	if (!isset($config['increment_user_id']))
	{
		global $src_db, $same_db, $convert;

		if ($convert->mysql_convert && $same_db)
		{
			$src_db->sql_query("SET NAMES 'binary'");
		}

		// Now let us set a temporary config variable for user id incrementing
		$sql = "SELECT user_id
			FROM {$convert->src_table_prefix}users
			WHERE user_id = 1";
		$result = $src_db->sql_query($sql);
		$id = (int) $src_db->sql_fetchfield('user_id');
		$src_db->sql_freeresult($result);

		// Try to get the maximum user id possible...
		$sql = "SELECT MAX(user_id) AS max_user_id
			FROM {$convert->src_table_prefix}users";
		$result = $src_db->sql_query($sql);
		$max_id = (int) $src_db->sql_fetchfield('max_user_id');
		$src_db->sql_freeresult($result);

		if ($convert->mysql_convert && $same_db)
		{
			$src_db->sql_query("SET NAMES 'utf8'");
		}

		// If there is a user id 1, we need to increment user ids. :/
		if ($id === 1)
		{
			set_config('increment_user_id', ($max_id + 1), true);
			$config['increment_user_id'] = $max_id + 1;
		}
		else
		{
			set_config('increment_user_id', 0, true);
			$config['increment_user_id'] = 0;
		}
	}

	// If the old user id is -1 in 2.0.x it is the anonymous user...
	if ($user_id == -1)
	{
		return ANONYMOUS;
	}

	if (!empty($config['increment_user_id']) && $user_id == 1)
	{
		return $config['increment_user_id'];
	}

	// A user id of 0 can happen, for example within the ban table if no user is banned...
	// Within the posts and topics table this can be "dangerous" but is the fault of the user
	// having mods installed (a poster id of 0 is not possible in 2.0.x).
	// Therefore, we return the user id "as is".

	return (int) $user_id;
}

/**
* Just undos the replacing of '<' and '>'
*/
function phpbb_smilie_html_decode($code)
{
	$code = str_replace('&lt;', '<', $code);
	return str_replace('&gt;', '>', $code);
}

/**
 * Reparse the message stripping out the bbcode_uid values and adding new ones and setting the bitfield
 * @todo What do we want to do about HTML in messages - currently it gets converted to the entities, but there may be some objections to this
 */
function phpbb_prepare_message($message)
{
	global $phpbb_root_path, $phpEx, $db, $convert, $user, $config, $cache, $convert_row, $message_parser;

	if (!$message)
	{
		$convert->row['mp_bbcode_bitfield'] = $convert_row['mp_bbcode_bitfield'] = 0;
		return '';
	}

	// Decode phpBB 2.0.x Message
	if (isset($convert->row['old_bbcode_uid']) && $convert->row['old_bbcode_uid'] != '')
	{
		// Adjust size...
		if (strpos($message, '[size=') !== false)
		{
			$message = preg_replace_callback('/\[size=(\d*):(' . $convert->row['old_bbcode_uid'] . ')\]/', 'phpbb_replace_size', $message);
		}

		$message = preg_replace('/\:(([a-z0-9]:)?)' . $convert->row['old_bbcode_uid'] . '/s', '', $message);
	}

	if (strpos($message, '[quote=') !== false)
	{
		$message = preg_replace('/\[quote="(.*?)"\]/s', '[quote=&quot;\1&quot;]', $message);
		$message = preg_replace('/\[quote=\\\"(.*?)\\\"\]/s', '[quote=&quot;\1&quot;]', $message);

		// let's hope that this solves more problems than it causes. Deal with escaped quotes.
		$message = str_replace('\"', '&quot;', $message);
		$message = str_replace('\&quot;', '&quot;', $message);
	}

	// Already the new user id ;)
	$user_id = $convert->row['annu_comment_membre_id'];

	$message = str_replace('<', '&lt;', $message);
	$message = str_replace('>', '&gt;', $message);
	$message = str_replace('<br />', "\n", $message);

	// make the post UTF-8
	$message = phpbb_set_encoding($message);

	$message_parser->warn_msg = array(); // Reset the errors from the previous message
	$message_parser->bbcode_uid = make_uid($convert->row['annu_comment_date']);
	$message_parser->message = $message;
	unset($message);

	// Make sure options are set.
	//	$enable_html = (!isset($row['enable_html'])) ? false : $row['enable_html'];
	$enable_bbcode = (!isset($convert->row['enable_bbcode'])) ? $config['dir_allow_bbcode'] : $convert->row['enable_bbcode'];
	$enable_smilies = (!isset($convert->row['enable_smilies'])) ? $config['dir_allow_links'] : $convert->row['enable_smilies'];
	$enable_magic_url = (!isset($convert->row['enable_magic_url'])) ? $config['dir_allow_smilies'] : $convert->row['enable_magic_url'];

	// parse($allow_bbcode, $allow_magic_url, $allow_smilies, $allow_img_bbcode = true, $allow_flash_bbcode = true, $allow_quote_bbcode = true, $allow_url_bbcode = true, $update_this_message = true, $mode = 'post')
	$message_parser->parse($enable_bbcode, $enable_magic_url, $enable_smilies);

	if (sizeof($message_parser->warn_msg))
	{
		$msg_id = isset($convert->row['post_id']) ? $convert->row['post_id'] : $convert->row['privmsgs_id'];
		$convert->p_master->error('<span style="color:red">' . $user->lang['POST_ID'] . ': ' . $msg_id . ' ' . $user->lang['CONV_ERROR_MESSAGE_PARSER'] . ': <br /><br />' . implode('<br />', $message_parser->warn_msg), __LINE__, __FILE__, true);
	}

	$convert->row['mp_bbcode_bitfield'] = $convert_row['mp_bbcode_bitfield'] = $message_parser->bbcode_bitfield;

	$message = $message_parser->message;
	unset($message_parser->message);

	return $message;
}

/**
 * Return the bitfield calculated by the previous function
 */
function get_bbcode_bitfield()
{
	global $convert_row;

	return $convert_row['mp_bbcode_bitfield'];
}

?>
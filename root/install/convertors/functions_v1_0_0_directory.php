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

function call_umil_permission_remove()
{
	global $umil;

	$old_auth_option	= array(
			'u_comment_annu',
			'u_search_annu',
			'u_submit_annu',
			'u_vote_annu',
			'u_edit_comment_annu',
			'u_delete_comment_annu',
			'u_edit_annu',
			'u_delete_annu',

			'm_edit_annu',
			'm_delete_annu',
			'm_edit_comment_annu',
			'm_delete_comment_annu',
		);

	$umil->permission_remove($old_auth_option);
}

function call_umil_delete_module()
{
	global $umil;

	$module		= array(
		array('acp', 'ACP_ANNUAIRE', array(
			'module_basename'		=> 'annuaire',
			'modes'					=> array('main', 'settings', 'cat', 'val'),
			),
		),
		array('acp', 'ACP_CAT_DOT_MODS', 'ACP_ANNUAIRE'),
	);

	$umil->module_remove($module);

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
				WHERE ' . $db->sql_in_set('vote_link_id', $dir_link_id_ary) . '
					GROUP BY vote_link_id';
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
				WHERE ' . $db->sql_in_set('comment_link_id', $dir_link_id_ary) . '
					GROUP BY comment_link_id';
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

function parse_cats_descriptions()
{

}

function parse_links_descriptions()
{

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

function import_banners()
{
	global $phpbb_root_path;

	$old_path = $phpbb_root_path. 'images/annuaire/banners/';
	$new_path = $phpbb_root_path. 'images/directory/banners/';

	if ($handle = opendir($old_path))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ($file != '.' && $file != '..' && !preg_match('/^.*?\.html$/', $file))
			{
				@copy($old_path.$file, $new_path.$file);
			}
		}

		closedir($handle);
	}
}

function import_icons()
{
	global $phpbb_root_path;

	$old_path = $phpbb_root_path. 'images/annuaire/icons/';
	$new_path = $phpbb_root_path. 'images/directory/icons/';

	if ($handle = opendir($old_path))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ($file != '.' && $file != '..' && !preg_match('/^.*?\.html$/', $file))
			{
				@copy($old_path.$file, $new_path.$file);
			}
		}

		closedir($handle);
	}
}

?>
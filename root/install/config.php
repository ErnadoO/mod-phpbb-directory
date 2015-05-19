<?php

/**
* Some config values so the script can be used for different mods.
* Currently only setup to add parent modules to .MODS tab in ACP
* then add the mods modules to this new parent.
* EDIT VALUES BELOW
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

$mod_config = array(
	'mod_title'					=> 'phpBB Directory',
	'mod_version'				=> '2.0.6',
	'phpbb_version'				=> '3.0.10',
	'php_version'				=> '4.4.0',
);

$last_version = array(
$mod_config['mod_version']	=> array(
	'table_add' => array(
		array(DIR_CAT_TABLE, array(
			'COLUMNS' => array(
				'cat_id'				=> array('UINT', NULL, 'auto_increment'),
				'parent_id'				=> array('UINT', 0),
				'left_id'				=> array('UINT', 0),
				'right_id'				=> array('UINT', 0),
				'cat_parents'			=> array('MTEXT_UNI', ''),
				'cat_name'				=> array('VCHAR', ''),
				'cat_desc'				=> array('TEXT_UNI', ''),
				'cat_desc_bitfield'		=> array('VCHAR', ''),
				'cat_desc_options'		=> array('TIMESTAMP', 7),
				'cat_desc_uid'			=> array('VCHAR:8', ''),
				'cat_links'				=> array('UINT', 0),
				'cat_icon'				=> array('VCHAR', ''),
				'display_subcat_list'	=> array('BOOL', 1),
				'cat_allow_comments'	=> array('BOOL', 1),
				'cat_allow_votes'		=> array('BOOL', 1),
				'cat_must_describe'		=> array('BOOL', 1),
				'cat_count_all'			=> array('BOOL', 0),
				'cat_validate'			=> array('BOOL', 1),
				'cat_link_back'			=> array('BOOL', 0),
				'cat_cron_enable'		=> array('BOOL', 0),
				'cat_cron_next'			=> array('TIMESTAMP', 0),
				'cat_cron_freq'			=> array('UINT', 7),
				'cat_cron_nb_check'		=> array('UINT', 1),
			),

			'PRIMARY_KEY'	=> array('cat_id'),

			'KEYS'		=> array(
				'left_right_id' => array('INDEX', array('left_id', 'right_id')),
			),
		)),

		array(DIR_COMMENT_TABLE, array(
			'COLUMNS' => array(
				'comment_id' 		=> array('UINT', NULL, 'auto_increment'),
				'comment_date' 		=> array('TIMESTAMP', 0),
				'comment_link_id' 	=> array('UINT', 0),
				'comment_user_id' 	=> array('UINT', 0),
				'comment_user_ip' 	=> array('VCHAR:40', ''),
				'comment_text' 		=> array('MTEXT_UNI', ''),
				'comment_uid' 		=> array('VCHAR:8', 0),
				'comment_flags' 	=> array('TIMESTAMP', 0),
				'comment_bitfield' 	=> array('VCHAR', ''),
			),

			'PRIMARY_KEY'	=> array('comment_id'),
		)),

		array(DIR_LINK_TABLE, array(
			'COLUMNS' => array(
				'link_id'			=> array('UINT', NULL, 'auto_increment'),
				'link_time' 		=> array('TIMESTAMP', 0),
				'link_uid' 			=> array('VCHAR:8', ''),
				'link_flags' 		=> array('TIMESTAMP', 0),
				'link_bitfield' 	=> array('VCHAR', ''),
				'link_url' 			=> array('VCHAR', ''),
				'link_description' 	=> array('MTEXT_UNI', ''),
				'link_view' 		=> array('UINT', 0),
				'link_active' 		=> array('BOOL', 0),
				'link_cat' 			=> array('UINT', 0),
				'link_user_id'		=> array('UINT', 0),
				'link_name' 		=> array('XSTEXT_UNI', ''),
				'link_rss' 			=> array('VCHAR', ''),
				'link_banner' 		=> array('VCHAR', ''),
				'link_back' 		=> array('VCHAR', ''),
				'link_nb_check' 	=> array('TINT:3', 0),
				'link_flag' 		=> array('VCHAR', ''),
				'link_guest_email' 	=> array('XSTEXT_UNI', ''),
				'link_vote' 		=> array('UINT', 0),
				'link_comment' 		=> array('TIMESTAMP', 0),
				'link_note' 		=> array('UINT', 0),
				'link_pagerank' 	=> array('CHAR:2', ''),
				'link_thumb' 		=> array('VCHAR', ''),
			),

			'PRIMARY_KEY'	=> array('link_id'),

			'KEYS'		=> array(
				'link_id'			=> array('UNIQUE', array('link_id')),
				'link_cat_active' 	=> array('INDEX', array('link_cat', 'link_active')),
				'link_time' 		=> array('INDEX', array('link_time')),
				'link_user_id' 		=> array('INDEX', array('link_user_id')),
			),
		)),

		array(DIR_NOTIFICATION_TABLE, array(
			'COLUMNS' => array(
				'n_user_id'		=> array('UINT', 0),
				'n_cat_id'		=> array('UINT', 0),
			),

			'KEYS'		=> array(
				'n_user_id'		=> array('INDEX', array('n_user_id')),
				'n_cat_id'		=> array('INDEX', array('n_cat_id')),
			),
		)),

		array(DIR_VOTE_TABLE, array(
			'COLUMNS' => array(
				'vote_id'			=> array('UINT', NULL, 'auto_increment'),
				'vote_link_id'		=> array('UINT', 0),
				'vote_user_id'		=> array('UINT', 0),
				'vote_note'			=> array('TINT:2', 0),
			),

			'PRIMARY_KEY'	=> array('vote_id'),

			'KEYS'		=> array(
				'vote_link_id'	=> array('INDEX', array('vote_link_id')),
				'vote_user_id'	=> array('INDEX', array('vote_user_id')),
			),
		)),

	),
	'permission_add'		=> array(
		'u_comment_dir',
		'u_search_dir',
		'u_submit_dir',
		'u_vote_dir',
		'u_edit_comment_dir',
		'u_delete_comment_dir',
		'u_edit_dir',
		'u_delete_dir',
		'm_edit_dir',
		'm_delete_dir',
		'm_edit_comment_dir',
		'm_delete_comment_dir',
	),
	'permission_set'		=> array(
		array('ROLE_USER_FULL', array(
			'u_comment_dir',
			'u_search_dir',
			'u_submit_dir',
			'u_vote_dir',
			'u_edit_comment_dir',
			'u_delete_comment_dir',
			'u_edit_dir',
			'u_delete_dir',
			)
		),
		array('ROLE_MOD_FULL', array(
			'm_edit_dir',
			'm_delete_dir',
			'm_edit_comment_dir',
			'm_delete_comment_dir',
			)
		),
	),
	'module_add'		=> array(
		array('acp', 'ACP_CAT_DOT_MODS', 'ACP_DIRECTORY'),

		array('acp', 'ACP_DIRECTORY', array(
			'module_basename'		=> 'directory',
			'modes'					=> array('main', 'settings', 'cat', 'val'),
			),
		),
	),
	'config_add'		=> array(
		array('dir_mail', '1'),
		array('dir_activ_flag', '1'),
		array('dir_show', '10'),
		array('dir_default_order', 't d'),
		array('dir_allow_bbcode', '1'),
		array('dir_allow_links', '1'),
		array('dir_allow_smilies', '1'),
		array('dir_length_describe', '255'),
		array('dir_activ_banner', '1'),
		array('dir_banner_height', '60'),
		array('dir_banner_width', '480'),
		array('dir_activ_checkurl', '1'),
		array('dir_activ_pagerank', '1'),
		array('dir_activ_thumb', '1'),
		array('dir_activ_thumb_remote', '1'),
		array('dir_visual_confirm', '1'),
		array('dir_visual_confirm_max_attempts', '3'),
		array('dir_length_comments', '256'),
		array('dir_new_time', '7'),
		array('dir_comments_per_page', '10'),
		array('dir_storage_banner', '1'),
		array('dir_banner_filesize', '30000'),
		array('dir_thumb_service', 'http://www.apercite.fr/apercite/120x90/oui/oui/'),
		array('dir_thumb_service_reverse', '0'),
		array('dir_activ_rss', '1'),
		array('dir_recent_block', '1'),
		array('dir_recent_exclude', '1'),
		array('dir_recent_rows', '1'),
		array('dir_recent_columns', '5'),
		array('dir_root_path', './'),
		array('dir_activ_rewrite', '0'),
	),
	'cache_purge'		=> array(
		'auth',
		'imageset',
		'template',
		'theme',
		),
)
);

$update = array(
	'2.0.1'	=> array(),
	'2.0.2'	=> array(),
	'2.0.3'	=> array(),
	'2.0.4'	=> array(),
	'2.0.5'	=> array(),
	'2.0.6'	=> array()
);

?>
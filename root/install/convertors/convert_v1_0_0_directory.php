<?php
/**
 *
 * @package install
 * @version $Id: convert_phpbb2_directory.php 2009-08-11 16:56:48Z ErnadoO $
 * @copyright (c) 2005 phpBB Group
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

/**
* NOTE to potential convertor authors. Please use this file to get
* familiar with the structure since we added some bare explanations here.
*
* Since this file gets included more than once on one page you are not able to add functions to it.
* Instead use a functions_ file.
*
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

include($phpbb_root_path . 'config.' . $phpEx);
unset($dbpasswd);

/**
* $convertor_data provides some basic information about this convertor which is
* used on the initial list of convertors and to populate the default settings
*/
$convertor_data = array(
	'directory_name'	=> 'phpBB Directory v1.0.0',
	'version'			=> '1.0.1',
	'phpbb_version'		=> '3.0.8',
	'author'			=> '<a href="http://www.phpbb-services.com/">ErnadoO</a>',
	'dbms'				=> $dbms,
	'dbhost'			=> $dbhost,
	'dbport'			=> $dbport,
	'dbuser'			=> $dbuser,
	'dbpasswd'			=> '',
	'dbname'			=> $dbname,
	'table_prefix'		=> $table_prefix,
	'forum_path'		=> '../forums',
	'author_notes'		=> '',
);

/**
* $tables is a list of the tables (minus prefix) which we expect to find in the
* source forum. It is used to guess the prefix if the specified prefix is incorrect
*/
$tables = array(
	'annuaire_cats',
	'annuaire_comments',
	'annuaire_liens',
	'annuaire_votes',
	'annuaire_notifications'
);

/**
 * $config_schema details how the board configuration information is stored in the source forum.
 *
 * 'table_format' can take the value 'file' to indicate a config file. In this case array_name
 * is set to indicate the name of the array the config values are stored in
 * 'table_format' can be an array if the values are stored in a table which is an assosciative array
 * (as per phpBB 2.0.x)
 * If left empty, values are assumed to be stored in a table where each config setting is
 * a column (as per phpBB 1.x)
 *
 * In either of the latter cases 'table_name' indicates the name of the table in the database
 *
 * 'settings' is an array which maps the name of the config directive in the source forum
 * to the config directive in phpBB3. It can either be a direct mapping or use a function.
 * Please note that the contents of the old config value are passed to the function, therefore
 * an in-built function requiring the variable passed by reference is not able to be used. Since
 * empty() is such a function we created the function is_empty() to be used instead.
 */
$config_schema = array(
	'table_name'	=>	'config',
	'table_format'	=>	array('config_name' => 'config_value'),
	'settings'		=>	array(
		'dir_mail'							=> 'annu_mail',
		'dir_activ_flag'					=> 'annu_activ_flag',
		'dir_show' 							=> 'annu_show',
		'dir_default_order'					=> 'annu_default_order',
		'dir_allow_bbcode'					=> 'annu_allow_bbcode',
		'dir_allow_links'					=> 'annu_allow_links',
		'dir_allow_smilies'					=> 'annu_allow_smilies',
		'dir_length_describe'				=> 'annu_lenght_describe',
		'dir_activ_banner'					=> 'annu_activ_banner',
		'dir_banner_height'					=> 'annu_banner_height',
		'dir_banner_width'					=> 'annu_banner_width',
		'dir_activ_checkurl'				=> 'annu_activ_checkurl',
		'dir_activ_pagerank'				=> 'annu_activ_pagerank',
		'dir_activ_thumb'					=> 'annu_activ_thumb',
		'dir_activ_thumb_remote'			=> 'annu_allow_thumb_remote',
		'dir_visual_confirm'				=> 'annu_visueal_confirm',
		'dir_visual_confirm_max_attempts'	=> 'annu_visual_confirm_max_attempts',
		'dir_length_comments'				=> 'annu_length_comments',
		'dir_new_time'						=> 'annu_new_time',
		'dir_comments_per_page'				=> 'annu_comments_per_page',
		'dir_storage_banner'				=> 'annu_storage_banner',
		'dir_banner_filesize'				=> 'annu_banner_filesize',
		'dir_thumb_service'					=> 'annu_thumb_service',
		'dir_thumb_service_reverse'			=> 'annu_thumb_service_reverse',
		'dir_activ_rss'						=> 'annu_activ_rss',
		'dir_recent_block'					=> 'annu_recent_block',
		'dir_recent_exclude'				=> 'annu_recent_exclude',
		'dir_recent_rows'					=> 'annu_recent_rows',
		'dir_recent_columns'				=> 'annu_recent_columns',
		'dir_root_path'						=> 'annu_root_path',
		'dir_activ_rewrite'					=> 'annu_activ_rewrite',
	)
);

/**
* If this is set then we are not generating the first page of information but getting the conversion information.
*/
if (!$get_info)
{
	/**
	* Tests for further MODs can be included here.
	* Please use constants for this, prefixing them with MOD_
	*/

	$src_db->sql_return_on_error(false);


/**
*	Description on how to use the convertor framework.
*
*	'schema' Syntax Description
*		-> 'target'			=> Target Table. If not specified the next table will be handled
*		-> 'primary'		=> Primary Key. If this is specified then this table is processed in batches
*		-> 'query_first'	=> array('target' or 'src', Query to execute before beginning the process
*								(if more than one then specified as array))
*		-> 'function_first'	=> Function to execute before beginning the process (if more than one then specified as array)
*								(This is mostly useful if variables need to be given to the converting process)
*		-> 'test_file'		=> This is not used at the moment but should be filled with a file from the old installation
*
*		// DB Functions
*		'distinct'	=> Add DISTINCT to the select query
*		'where'		=> Add WHERE to the select query
*		'group_by'	=> Add GROUP BY to the select query
*		'left_join'	=> Add LEFT JOIN to the select query (if more than one joins specified as array)
*		'having'	=> Add HAVING to the select query
*
*		// DB INSERT array
*		This one consist of three parameters
*		First Parameter:
*							The key need to be filled within the target table
*							If this is empty, the target table gets not assigned the source value
*		Second Parameter:
*							Source value. If the first parameter is specified, it will be assigned this value.
*							If the first parameter is empty, this only gets added to the select query
*		Third Parameter:
*							Custom Function. Function to execute while storing source value into target table.
*							The functions return value get stored.
*							The function parameter consist of the value of the second parameter.
*
*							types:
*								- empty string == execute nothing
*								- string == function to execute
*								- array == complex execution instructions
*
*		Complex execution instructions:
*		@todo test complex execution instructions - in theory they will work fine
*
*							By defining an array as the third parameter you are able to define some statements to be executed. The key
*							is defining what to execute, numbers can be appended...
*
*							'function' => execute function
*							'execute' => run code, whereby all occurrences of {VALUE} get replaced by the last returned value.
*										The result *must* be assigned/stored to {RESULT}.
*							'typecast'	=> typecast value
*
*							The returned variables will be made always available to the next function to continue to work with.
*
*							example (variable inputted is an integer of 1):
*
*							array(
*								'function1'		=> 'increment_by_one',		// returned variable is 2
*								'typecast'		=> 'string',				// typecast variable to be a string
*								'execute'		=> '{RESULT} = {VALUE} . ' is good';', // returned variable is '2 is good'
*								'function2'		=> 'replace_good_with_bad',				// returned variable is '2 is bad'
*							),
*
*/

	$convertor = array(
		// We empty some tables to have clean data available
		'query_first'			=> array(),

		'execute_first'	=> '
			call_umil_permission_remove();
			call_umil_delete_module();
		',

		'execute_last'	=> array('
			import_banners();
		','
			import_icons();
		'),

		'schema' => array(

			array(
				'target'		=> DIR_NOTIFICATION_TABLE,
				'query_first'	=> array('target', $convert->truncate_statement .DIR_NOTIFICATION_TABLE),
				'primary'		=> 'annu_n_user_id',

				array('n_user_id',				'annuaire_notifications.annu_n_user_id',		'phpbb_user_id'),
				array('n_cat_id',				'annuaire_notifications.annu_n_cat_id',			''),
			),

			array(
				'target'		=> DIR_VOTE_TABLE,
				'query_first'	=> array('target', $convert->truncate_statement .DIR_VOTE_TABLE),
				'primary'		=> 'annu_vote_id',

				array('vote_id',				'annuaire_votes.annu_vote_id',			''),
				array('vote_link_id',			'annuaire_votes.annu_vote_lien_id',		''),
				array('vote_user_id',			'annuaire_votes.annu_vote_membre_id',	'phpbb_user_id'),
				array('vote_note',				'annuaire_votes.annu_vote_note',		''),
			),

			array(
				'target'		=> DIR_COMMENT_TABLE,
				'query_first'	=> array('target', $convert->truncate_statement .DIR_COMMENT_TABLE),
				'primary'		=> 'annu_comment_id',

				array('comment_id',				'annuaire_comments.annu_comment_id',					''),
				array('comment_date',			'annuaire_comments.annu_comment_date',					''),
				array('comment_link_id',		'annuaire_comments.annu_comment_lien_id',				''),
				array('comment_user_id',		'annuaire_comments.annu_comment_membre_id',				'phpbb_user_id'),
				array('comment_user_ip',		'annuaire_comments.annu_comment_membre_ip',				''),
				array('comment_text',			'annuaire_comments.annu_comment_text',					''),
				array('comment_uid',			'annuaire_comments.annu_comment_uid',					''),
				array('comment_flags',			'annuaire_comments.annu_comment_flags',					''),
				array('comment_bitfield',		'annuaire_comments.annu_comment_bitfield',				''),
			),

			array(
				'target'		=> DIR_LINK_TABLE,
				'query_first'	=> array('target', $convert->truncate_statement . DIR_LINK_TABLE),
				'primary'		=> 'annu_lien_id',

				array('link_id',				'annuaire_liens.annu_lien_id',				''),
				array('link_time',				'annuaire_liens.annu_lien_time',			''),
				array('link_uid',				'annuaire_liens.annu_lien_uid',				''),
				array('link_flags',				'annuaire_liens.annu_lien_flags',			''),
				array('link_bitfield',			'annuaire_liens.annu_lien_bitfield',		''),
				array('link_url',				'annuaire_liens.annu_lien_url',				''),
				array('link_description',		'annuaire_liens.annu_lien_description',		''),
				array('link_view',				'annuaire_liens.annu_lien_vu',				''),
				array('link_active',			'annuaire_liens.annu_lien_active',			''),
				array('link_cat',				'annuaire_liens.annu_lien_cat',				''),
				array('link_user_id',			'annuaire_liens.annu_lien_membre_id',		'phpbb_user_id'),
				array('link_name',				'annuaire_liens.annu_lien_name',			''),
				array('link_rss',				'annuaire_liens.annu_lien_rss',				''),
				array('link_banner',			'annuaire_liens.annu_lien_banner',			''),
				array('link_back',				'annuaire_liens.annu_lien_back',			''),
				array('link_nb_check',			'annuaire_liens.annu_lien_nb_verification',	''),
				array('link_flag',				'annuaire_liens.annu_lien_flag',			''),
				array('link_guest_email',		'annuaire_liens.annu_guest_email',			''),
				array('link_vote',				'annuaire_liens.annu_lien_vote',			''),
				array('link_comment',			'annuaire_liens.annu_lien_comment',			''),
				array('link_note',				'annuaire_liens.annu_lien_note',			''),
				array('link_pagerank',			'annuaire_liens.annu_lien_pagerank',		''),
				array('link_thumb',				'annuaire_liens.annu_lien_thumb',			''),
			),

			array(
				'target'		=> DIR_CAT_TABLE,
				'query_first'	=> array('target', $convert->truncate_statement . DIR_CAT_TABLE),
				'primary'		=> 'annu_cat_id',

				array('cat_id',					'annuaire_cats.annu_cat_id',				''),
				array('parent_id',				'annuaire_cats.parent_id',					''),
				array('left_id',				'annuaire_cats.left_id',					''),
				array('right_id',				'annuaire_cats.right_id',					''),
				array('cat_parents',			'annuaire_cats.annu_cat_parents',			''),
				array('cat_name',				'annuaire_cats.annu_cat_name',				''),
				array('cat_desc',				'annuaire_cats.annu_cat_desc',				''),
				array('cat_desc_bitfield',		'annuaire_cats.annu_cat_desc_bitfield',		''),
				array('cat_desc_options',		'annuaire_cats.annu_cat_desc_options',		''),
				array('cat_desc_uid',			'annuaire_cats.annu_cat_desc_uid',			''),
				array('cat_links',				'annuaire_cats.annu_cat_links',				''),
				array('cat_icon',				'annuaire_cats.annu_cat_icon',				''),
				array('display_subcat_list',	'annuaire_cats.annu_display_subcat_list',	''),
				array('cat_allow_comments',		'annuaire_cats.annu_cat_allow_comments',	''),
				array('cat_allow_votes',		'annuaire_cats.annu_cat_allow_votes',		''),
				array('cat_must_describe',		'annuaire_cats.annu_cat_must_describe',		''),
				array('cat_count_all',			'annuaire_cats.annu_cat_count_all',			''),
				array('cat_validate',			'annuaire_cats.annu_cat_validate',			''),
				array('cat_link_back',			'annuaire_cats.annu_cat_link_back',			''),
				array('cat_cron_enable',		'annuaire_cats.annu_cat_cron_enable',		''),
				array('cat_cron_next',			'annuaire_cats.annu_cat_cron_next',			''),
				array('cat_cron_freq',			'annuaire_cats.annu_cat_cron_freq',			''),
				array('cat_cron_nb_check',		'annuaire_cats.annu_cat_cron_nb_check',		''),
			),
		),
	);
}

?>
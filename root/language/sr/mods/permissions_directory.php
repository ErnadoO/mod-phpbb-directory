<?php
/**
*
* permissions_directory [Serbian]
*
* @package language
* @version $Id$
* @copyright (c) 2011 http://www.phpbb-services.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang['permission_cat']['dir'] = 'Directory';

$lang = array_merge($lang, array(
	'acl_m_delete_dir'			=> array(
		'lang'					=> 'Nemoduce je izbrisati vebsajt',
		'cat'					=> 'dir',
	),

	'acl_m_delete_comment_dir'	=> array(
		'lang'					=> 'Nemoguce je izbrisati komentare',
		'cat'					=> 'dir',
	),

	'acl_m_edit_dir'			=> array(
		'lang'					=> 'Nemoguce je urediti vebsajt',
		'cat'					=> 'dir',
	),

	'acl_m_edit_comment_dir'	=> array(
		'lang'					=> 'Nemoguce je urediti komentare',
		'cat'					=> 'dir',
	),

	'acl_u_comment_dir'		=> array(
		'lang'					=> 'Mozete ostaviti komentar (ako je to dozvoljeno u ovoj kategoriji)',
		'cat'					=> 'dir',
	),

	'acl_u_delete_dir'			=> array(
		'lang'					=> 'Mozete izbrisati sopstvene linkove',
		'cat'					=> 'dir',
	),

	'acl_u_delete_comment_dir'	=> array(
		'lang'					=> 'Mozete izbrisati sopstvene komentare',
		'cat'					=> 'dir',
	),

	'acl_u_edit_dir'			=> array(
		'lang'					=> 'Mozete urediti sopstvene linkove',
		'cat'					=> 'dir',
	),

	'acl_u_edit_comment_dir'	=> array(
		'lang'					=> 'Mozete urediti sopstvene komentare',
		'cat'					=> 'dir',
	),

	'acl_u_search_dir'			=> array(
		'lang'					=> 'Mozete traziti u direktorijumu',
		'cat'					=> 'dir',
	),

	'acl_u_submit_dir'			=> array(
		'lang'					=> 'Mozete uneti vebsajt u direktorijum',
		'cat'					=> 'dir',
	),

	'acl_u_vote_dir'			=> array(
		'lang'					=> 'Mozete glasati za vebsajt u direktorijumu',
		'cat'					=> 'dir',
	),

));

?>

<?php
/**
*
* permissions_directory [German]
* @copyright (c) 2012
* @package language DE
* @author Übersetzung Walter B.
*http://www.digitalfotografie-foren.de 
*@author Übersetzung Magnus (BDSM-Baden.de)
*http://www.BDSM-Baden.de 
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

$lang['permission_cat']['dir'] = 'Linkverzeichnis';

$lang = array_merge($lang, array(
	'acl_m_delete_dir'			=> array(
		'lang'					=> 'Kann einen Link löschen.',
		'cat'					=> 'dir',
	),

	'acl_m_delete_comment_dir'	=> array(
		'lang'					=> 'Kann Kommentare löschen.',
		'cat'					=> 'dir',
	),

	'acl_m_edit_dir'			=> array(
		'lang'					=> 'Kann Links ändern.',
		'cat'					=> 'dir',
	),

	'acl_m_edit_comment_dir'	=> array(
		'lang'					=> 'Kann Kommentare ändern.',
		'cat'					=> 'dir',
	),

	'acl_u_comment_dir'		=> array(
		'lang'					=> 'Kann Kommentare posten (sofern dies in der Kategorie aktiviert wurde).',
		'cat'					=> 'dir',
	),

	'acl_u_delete_dir'			=> array(
		'lang'					=> 'Kann eigene Links löschen.',
		'cat'					=> 'dir',
	),

	'acl_u_delete_comment_dir'	=> array(
		'lang'					=> 'Kann eigene Kommentare löschen.',
		'cat'					=> 'dir',
	),

	'acl_u_edit_dir'			=> array(
		'lang'					=> 'Kann eigene Links ändern.',
		'cat'					=> 'dir',
	),

	'acl_u_edit_comment_dir'	=> array(
		'lang'					=> 'Kann eigene Kommentare ändern.',
		'cat'					=> 'dir',
	),

	'acl_u_search_dir'			=> array(
		'lang'					=> 'Kann das Linkverzeichnis durchsuchen.',
		'cat'					=> 'dir',
	),

	'acl_u_submit_dir'			=> array(
		'lang'					=> 'Kann einen Link vorschlagen.',
		'cat'					=> 'dir',
	),

	'acl_u_vote_dir'			=> array(
		'lang'					=> 'Kann für einen Link abstimmen.',
		'cat'					=> 'dir',
	),

));

?>
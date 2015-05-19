<?php
/**
 *
 * directory_install [English]
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

$lang = array_merge($lang, array(
	'CAT_DESC_CLEAN'						=> 'Cleaning of the category descriptions',
	'CAT_INSTALL'							=> 'Install',
	'CAT_OVERVIEW'							=> 'Intro',
	'CAT_UNINSTALL'							=> 'Uninstall',
	'CAT_UPDATE'							=> 'Update',
	'CONVERT_COMPLETE_EXPLAIN'				=> 'You have converted your directory. Please make sure that the data from your old Directory have been correctly transfered before reactivating your message board by deleting the install directory. You can now log in and <a href="../directory.php">access your directory</a>.',
	'CONVERT_INTRO'							=> 'Welcome to the “phpBB Directory Unified Convertor Framework”',
	'CONVERT_INTRO_BODY'					=> 'From here, you can import datas from other directory systems. The following list shows all the conversion modules currently available.',
	'CONV_OPTIONS_BODY'						=> 'This page collects the required informations to get access to your old directory tables. Enter the informations of your old directory database; The converter will not modify your old directory datas.',

	'DIRECTORY_NOT_INSTALLED_EXPLAIN'		=> 'You must install phpBB Directory',
	'DONE'									=> 'Done',
	'DUPLICATE_AUTH_FOUND'					=> '%s has been found %s times',

	'FOUND'									=> 'Found',

	'GPL'									=> 'General Public License',

	'INSTALL_CONGRATS'						=> 'Congratulations!',
	'INSTALL_CONGRATS_EXPLAIN'				=> '
		<p>You have successfully installed phpBB Directory %1$s</p>
		<p>Click on the button to go to your admin panel</p><p><strong>Now, delete or rename the installation directory before going to your message board. If you don’t do it, the admin panel will be the only thing available.</strong></p>',
	'INSTALL_INTRO'							=> 'Welcome to the installation of the mod phpBB Directory',
	'INSTALL_INTRO_BODY'					=> 'With this option, you can install phpBB Directory on your server.',
	'INSTALL_LOGIN'							=> 'Access to the ACP',
	'INSTALL_PANEL'							=> 'Installation Panel of the mod phpBB Directory',
	'INSTALL_START'							=> 'Start the installation',
	'INSTALL_TEST'							=> 'Try again',
	'INST_ERR'								=> 'Installation Error',
	'INST_ERR_AUTH'							=> 'You must be logged in as admin to execute this script.</strong>.',
	'INST_ERR_FATAL'						=> 'Fatal Installation Error',

	'LINK_DESC_CLEAN'						=> 'Cleaning of the websites descriptions',

	'MODULE_ACP'							=> 'ACP Module',
	'MODULE_MCP'							=> 'MCP Module',
	'MODULE_UCP'							=> 'UCP Module',

	'NEXT_STEP'								=> 'Next Step',

	'OVERVIEW_BODY'							=> 'Welcome to phpBB Directory!<br /><br />phpBB Directory is full of functions, easy to use, and it is completely integrated to phpBB.<br /><br />This installation system will guide you through the installation of phpBB Directory, the update to the latest version of phpBB Directory and the removal of phpBB Directory. To read the Terms of use of phpBB Directoryn or learn more about the support we can provide you, please select the option for the menu on the side. To go on, please select the tab below.',

	'PHPBB_SETTINGS'						=> 'phpBB Version',
	'PHPBB_SETTINGS_EXPLAIN'				=> '<strong>Required</strong> - You must be under phpBB %s or higher to install phpBB Directory.',
	'PHPBB_VERSION_REQD'					=> 'phpBB Version >= %s',
	'PHP_ALLOW_URL_FOPEN_SUPPORT'			=> 'The PHP directive allow_fopen_url is available',
	'PHP_ALLOW_URL_FOPEN_SUPPORT_EXPLAIN'	=> '<strong>Required</strong> - For the phpBB Directory mod works properly, the function allow_fopen_url must be available.',
	'PHP_GETIMAGESIZE_SUPPORT'				=> 'The PHP function getimagesize() is available',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'		=> '<strong>Required</strong> - To make the phpBB Directory mod works properly, the function getimagesize() must be available.',
	'PHP_SETTINGS'							=> 'PHP Version and Parameters',
	'PHP_SETTINGS_EXPLAIN'					=> '<strong>REQUIRED</strong> - You must be under php %s or higher to install phpBB Directory.',
	'PHP_VERSION_REQD'						=> 'Your PHP version must be the %s at least',
	'PRE_CONVERT_COMPLETE'					=> 'All the pre-conversion steps are done. You can begin the conversion process. Please note that you may have to do some manual changes.',

	'REQUIREMENTS_EXPLAIN'					=> 'Before performing a full installation, phpBB Directory will check the configuration of your server files to make sure you can install phpBB Directory. Read the results carefully and do not continue until all tests are done. If you want to activate a feature with optional tests, you must ensure that these tests had also been done.',
	'REQUIREMENTS_TITLE'					=> 'Compatibility of the Installation',

	'SKIP'									=> 'Skip to content',
	'SOFTWARE'								=> 'Directory System',
	'STAGE_INSTALL'							=> 'Install',
	'STAGE_INSTALL_DIR'						=> 'Installation of phpBB Directory',
	'STAGE_INSTALL_DIR_EXPLAIN'				=> 'The tables, modules, permissions and datas used by the mod phpBB Directory have been created.',
	'STAGE_INTRO'							=> 'Introduction',
	'STAGE_REQUIREMENTS'					=> 'Conditions',
	'STAGE_UNINSTALL'						=> 'Removal',
	'STAGE_UNINSTALL_DIR'					=> 'Removal of phpBB Directory',
	'STAGE_UNINSTALL_DIR_EXPLAIN'			=> 'The tables, modules, permissions and datas used by the mod phpBB Directory have been deleted. To complete the removal, you must undo all the file modifications required for the mod and delete all the files from you server.',
	'STAGE_UPDATE'							=> 'Update',
	'STAGE_UPDATE_DIR'						=> 'Update of phpBB Directory',
	'STAGE_UPDATE_DIR_EXPLAIN'				=> 'phpBB Directory has been updated.',
	'SUB_INTRO'								=> 'Introduction',
	'SUB_LICENSE'							=> 'Licence',
	'SUB_SUPPORT'							=> 'Support',
	'SUPPORT_BODY'							=> 'Support can be provided for this mod. It contains:</p><ul><li>installation</li><li>configuration</li><li>technicals questions</li><li>problems linked to potential bugs of the script</li><li>updating from older versions to the latest version</li></ul><p>I recommand to all users running under an old version of phpBB Directory to update their installation with the latest version.</p><h2>To get support:</h2><p><a href="http://redmine.erwan-projects.fr/projects/phpbb-directory/boards">MOD Development Topic</a><br /><a href="http://www.modsphpbb3.fr/viewtopic.php?f=60&t=89">List of the updates</a><br /><br />',
	'SYNC_CATS'								=> 'Category synchronization',
	'SYNC_LINKS'							=> 'Links synchronization',
	'SYNC_LINK_ID'							=> 'Links synchronization <var>link_id</var> %1$s to %2$s.',

	'UNAVAILABLE'							=> 'Unavailable',
	'UNINSTALL_CONGRATS_EXPLAIN'			=> '
		<p>You have successfully remove phpBB Directory %1$s.</p>
		<p>Click on the button below to go to your admin panel.<p><strong>Now, delete or rename the installation directory before going to your board. If you don’t do it, only the admin panel will be available.</strong></p>',
	'UNINSTALL_INTRO'						=> 'Welcome in the removal of phpBB Directory',
	'UNINSTALL_INTRO_BODY'					=> 'With this option, you can delete phpBB Directory from your database.',
	'UNINSTALL_START'						=> 'Start the removal',
	'UNWRITABLE'							=> 'Unwritable',
	'UPDATE_CONGRATS_EXPLAIN'				=> '
		<p>You have successfully updated phpBB Directory %1$s</p>
		<p>Click on the button below to go to your admin panel.<p><strong>Now, delete or rename the installation directory before going to your message board. If you don’t do it, only the admin panel will be available.</strong></p>',
	'UPDATE_INTRO'							=> 'Welcome in the update of phpBB Directory',
	'UPDATE_INTRO_BODY'						=> 'With this option, you can update phpBB Directory to the latest version.',
	'UPDATE_START'							=> 'Start the update',

	'VERSION'								=> 'Version',

	'WELCOME_INSTALL'						=> 'Welcome in the phpBB Directory Installation',
	'WRITABLE'								=> 'Writable',
));

?>
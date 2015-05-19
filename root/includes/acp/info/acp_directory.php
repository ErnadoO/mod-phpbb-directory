<?php
/**
*
* @author Erwan NADER (ErnadoO) ernadoo@phpbb-services.com
* @package acp
* @version $Id$
* @copyright (c) 2008 http://www.phpbb-services.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_directory_info
{
    function module()
    {
        return array(
            'filename'		=> 'acp_directory',
            'title'			=> 'ACP_DIRECTORY',
            'version'		=> '1.0.1',
            'modes'			=> array(
            	''				=> array('title' => 'ACP_DIRECTORY',			'auth'	=> 'acl_a_board', 'cat' => array('')),
            	'main'			=> array('title' => 'ACP_DIRECTORY_MAIN',		'auth'	=> 'acl_a_board', 'cat' => array('ACP_DIRECTORY')),
				'settings'		=> array('title' => 'ACP_DIRECTORY_SETTINGS',	'auth'	=> 'acl_a_board', 'cat' => array('ACP_DIRECTORY')),
				'cat'			=> array('title' => 'ACP_DIRECTORY_CATS',		'auth'	=> 'acl_a_board', 'cat' => array('ACP_DIRECTORY')),
				'val'			=> array('title' => 'ACP_DIRECTORY_VAL',		'auth'	=> 'acl_a_board', 'cat' => array('ACP_DIRECTORY')),
            ),
        );
    }

    function install()
    {
    }

    function uninstall()
    {
    }
}
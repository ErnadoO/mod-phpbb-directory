<?php
/**
*
* directory_install [French]
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
	'CAT_DESC_CLEAN'						=> 'Nettoyage des descriptions des catégories',
	'CAT_INSTALL'							=> 'Installer',
	'CAT_OVERVIEW'							=> 'Préambule',
	'CAT_UNINSTALL'							=> 'Désinstallation',
	'CAT_UPDATE'							=> 'Mise à jour',
	'CONVERT_COMPLETE_EXPLAIN'				=> 'Vous avez converti votre annuaire. Assurez-vous que les données de votre ancien annuaire aient été correctement transférées avant de réactiver votre forum en supprimant le répertoire install. Vous pouvez désormais vous connecter et <a href="../directory.php">accéder à votre annuaire</a>.',
	'CONVERT_INTRO'							=> 'Bienvenue sur la “phpBB Annuaire Unified Convertor Framework”',
	'CONVERT_INTRO_BODY'					=> 'D’ici, vous pouvez importer des données à partir d’autres systèmes d’annuaire. La liste suivante montre tous les modules de conversion actuellement disponibles.',
	'CONV_OPTIONS_BODY'						=> 'Cette page collecte les informations qui sont requises pour accéder aux tables de votre ancien annuaire. Entrez les informations de la base de données de votre ancien annuaire; Le convertisseur ne modifiera en rien les données de votre ancien annuaire.',

	'DIRECTORY_NOT_INSTALLED_EXPLAIN'		=> 'Vous devez installer phpBB Annuaire',
	'DONE'									=> 'Terminé',
	'DUPLICATE_AUTH_FOUND'					=> '%s a été trouvé %s fois',

	'FOUND'									=> 'Trouvé',

	'GPL'									=> 'Licence publique générale',

	'INSTALL_CONGRATS'						=> 'Félicitations !',
	'INSTALL_CONGRATS_EXPLAIN'				=> '
		<p>Vous avez installé phpBB Annuaire %1$s avec succès.</p>
		<p>Cliquez sur le bouton ci-dessous pour accéder à votre panneau d’administration.</p><p><strong>Maintenant, supprimez ou renommez le répertoire d’installation avant d’accéder à votre forum. Si ce répertoire est présent, seul le panneau d’administration sera accessible.</strong></p>',
	'INSTALL_INTRO'							=> 'Bienvenue dans l’installation du mod phpBB Annuaire',
	'INSTALL_INTRO_BODY'					=> 'Avec cette option, il est possible d’installer phpBB Annuaire sur votre serveur.',
	'INSTALL_LOGIN'							=> 'Accéder à l’ACP',
	'INSTALL_PANEL'							=> 'Panneau d’installation du mod phpBB Annuaire',
	'INSTALL_START'							=> 'Commencer l’installation',
	'INSTALL_TEST'							=> 'Tester à nouveau',
	'INST_ERR'								=> 'Erreur d’installation',
	'INST_ERR_AUTH'							=> 'Vous devez être connecté en tant que fondateur pour pouvoir éxécuter ce script.</strong>.',
	'INST_ERR_FATAL'						=> 'Erreur d’installation fatale',

	'LINK_DESC_CLEAN'						=> 'Nettoyage des descriptions des sites',

	'MODULE_ACP'							=> 'ACP Module',
	'MODULE_MCP'							=> 'MCP Module',
	'MODULE_UCP'							=> 'UCP Module',

	'NEXT_STEP'								=> 'Étape suivante',

	'OVERVIEW_BODY'							=> 'Bienvenue dans phpBB Annuaire !<br /><br />phpBB Annuaire est riche en fonctionnalités, facile à utiliser, et il est entièrement intégré à phpBB.<br /><br />Ce système d’installation vous guidera dans l’installation de phpBB Annuaire, la mise à jour vers la dernière version de phpBB Annuaire en date et la désinstallation de phpBB Annuaire. Pour lire la licence d’utilisation de phpBB Annuaire ou en apprendre davantage sur l’obtention de support, veuillez choisir les options du menu latéral. Pour continuer, merci de sélectionnez l’un des onglets ci-dessus.',

	'PHPBB_SETTINGS'						=> 'Version de phpBB',
	'PHPBB_SETTINGS_EXPLAIN'				=> '<strong>Obligatoire</strong> - Vous devez tourner sous phpBB %s ou supérieur pour installer phpBB Annuaire.',
	'PHPBB_VERSION_REQD'					=> 'Version de phpBB >= %s',
	'PHP_ALLOW_URL_FOPEN_SUPPORT'			=> 'Le paramètre PHP <var>allow_url_fopen</var> est activé',
	'PHP_ALLOW_URL_FOPEN_SUPPORT_EXPLAIN'	=> '<strong>Requis</strong> - Pour que phpBB Annuaire fonctionne correctement, la directive <var>allow_fopen_url</var> doit être disponible.',
	'PHP_GETIMAGESIZE_SUPPORT'				=> 'La fonction PHP getimagesize() est disponible',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'		=> '<strong>Requis</strong> - Pour que phpBB Annuaire fonctionne correctement, la fonction getimagesize() doit être disponible.',
	'PHP_SETTINGS'							=> 'Version de PHP et paramètres',
	'PHP_SETTINGS_EXPLAIN'					=> '<strong>Obligatoire</strong> - Vous devez tourner sous php %s ou supérieur pour installer phpBB Annuaire.',
	'PHP_VERSION_REQD'						=> 'Votre version de PHP doit être la %s au minimum',
	'PRE_CONVERT_COMPLETE'					=> 'Toutes les étapes de pré-conversion sont terminées. Vous pouvez commencer le processus de conversion. Notez que vous pouvez avoir à faire et ajuster plusieurs choses manuellement.',

	'REQUIREMENTS_EXPLAIN'					=> 'Avant d’effectuer une installation complète, phpBB Annuaire va vérifier la configuration des fichiers de votre serveur et s’assurer que vous pouvez installer phpBB Annuaire. Lisez attentivement les résultats et ne continuez pas tant que tous les tests ne sont pas validés. Si vous voulez activer une fonctionnalité liée à des tests optionnels, vous devez vous assurer que ces tests soient aussi validés.',
	'REQUIREMENTS_TITLE'					=> 'Compatibilité de l’installation',

	'SKIP'									=> 'Vers le contenu',
	'SOFTWARE'								=> 'Système d’annuaire',
	'STAGE_INSTALL'							=> 'Install',
	'STAGE_INSTALL_DIR'						=> 'Installation de phpBB Annuaire',
	'STAGE_INSTALL_DIR_EXPLAIN'				=> 'Les tables, modules, permissions et données utilisées par le mod phpBB Annuaire ont été créées.',
	'STAGE_INTRO'							=> 'Introduction',
	'STAGE_REQUIREMENTS'					=> 'Conditions',
	'STAGE_UNINSTALL'						=> 'Désinstallation',
	'STAGE_UNINSTALL_DIR'					=> 'Désinstallation de phpBB Annuaire',
	'STAGE_UNINSTALL_DIR_EXPLAIN'			=> 'Les tables, modules, permissions et données utilisées par le mod phpBB Annuaire ont été supprimées. Pour compléter la désinstallation, vous devez annuler toutes les modifications de fichiers requises par le mod et supprimer tous les fichiers du mod de votre serveur.',
	'STAGE_UPDATE'							=> 'Mise à jour',
	'STAGE_UPDATE_DIR'						=> 'Mise à jour de phpBB Annuaire',
	'STAGE_UPDATE_DIR_EXPLAIN'				=> 'phpBB Annuaire a été mis à jour.',
	'SUB_INTRO'								=> 'Introduction',
	'SUB_LICENSE'							=> 'Licence',
	'SUB_SUPPORT'							=> 'Support',
	'SUPPORT_BODY'							=> 'Du support peut être dispensé pour ce MOD. Cela inclus:</p><ul><li>Installation</li><li>Configuration</li><li>Questions techniques</li><li>Problèmes liés à des bugs potentiels du script</li><li>Mise à jour depuis les précédentes versions</li></ul><p>J’encourage les utilisateurs fonctionnant sous une ancienne version de phpBB Annuaire de mettre à jour leur installation avec la dernière version.</p><h2>Pour obtenir du support:</h2><p><a href="http://redmine.erwan-projects.fr/projects/phpbb-directory/boards">Sujet de developpement du MOD</a><br /><a href="http://www.modsphpbb3.fr/viewtopic.php?f=60&t=89">Liste des mises à jour</a><br /><br />',
	'SYNC_CATS'								=> 'Synchronisation des catégories',
	'SYNC_LINKS'							=> 'Synchronisation des liens',
	'SYNC_LINK_ID'							=> 'Synchronisation des liens <var>link_id</var> %1$s à %2$s.',

	'UNAVAILABLE'							=> 'Indisponible',
	'UNINSTALL_CONGRATS_EXPLAIN'			=> '
		<p>Vous avez supprimé phpBB Annuaire %1$s avec succès.</p>
		<p>Cliquez sur le bouton ci-dessous pour accéder à votre panneau d’administration.<p><strong>Maintenant, supprimez ou renommez le répertoire d’installation avant d’accéder à votre forum. Si ce répertoire est présent, seul le panneau d’administration sera accessible.</strong></p>',
	'UNINSTALL_INTRO'						=> 'Bienvenue dans la désinstallation de phpBB Annuaire',
	'UNINSTALL_INTRO_BODY'					=> 'Avec cette option, il vous est possible de supprimer phpBB Annuaire de votre base de données.',
	'UNINSTALL_START'						=> 'Commencer la désinstallation',
	'UNWRITABLE'							=> 'Interdit en écriture',
	'UPDATE_CONGRATS_EXPLAIN'				=> '
		<p>Vous avez mis à jour phpBB Annuaire %1$s avec succès.</p>
		<p>Cliquez sur le bouton ci-dessous pour accéder à votre panneau d’administration.</p><p><strong>Maintenant, supprimez ou renommez le répertoire d’installation avant d’accéder à votre forum. Si ce répertoire est présent, seul le panneau d’administration sera accessible.</strong></p>',
	'UPDATE_INTRO'							=> 'Bienvenue dans la mise à jour de phpBB Annuaire',
	'UPDATE_INTRO_BODY'						=> 'Avec cette option, il vous est possible de mettre à jour phpBB Annuaire à la dernière version.',
	'UPDATE_START'							=> 'Commencer la mise à jour',

	'VERSION'								=> 'Version',

	'WELCOME_INSTALL'						=> 'Bienvenue dans l’installation du mod phpBB Annuaire',
	'WRITABLE'								=> 'Autorisé en écriture',
));

?>
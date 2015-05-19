<?php
/**
*
* directory_install [German]
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

$lang = array_merge($lang, array(
	'CAT_DESC_CLEAN'						=> 'Bereinigung der Beschreibung der Kategorien',
	'CAT_INSTALL'							=> 'Installer',
	'CAT_OVERVIEW'							=> 'Vorwort',
	'CAT_UNINSTALL'							=> 'Deinstallieren',
	'CAT_UPDATE'							=> 'Update',
	'CONVERT_COMPLETE_EXPLAIN'				=> 'Du hast Dein Verzeichnis konvertiert. Vergewissere Dich, das die schon vorher vorhandenen Links korrekt konvertiert wurden, bevor Du das Installationsverzeichnis löscht. Ansonsten kannst Du die neuen Datenbankeinträge wieder löschen. Danach kannst Du dich einzuloggen und <a href="../annuaire.php"> hast nun Zugang zu Deinem Verzeichnis</a>.',
	'CONVERT_INTRO'							=> 'Willkommen auf der “phpBB Annuaire Unified Convertor Framework”',
	'CONVERT_INTRO_BODY'					=> 'Von hier aus kannst Du Daten aus anderen Linkverzeichnissen importieren. Die folgende Liste zeigt alle aktuell verfügbaren Konvertierungs-Module an.',
	'CONV_OPTIONS_BODY'						=> 'Diese Seite sammelt Informationen für den Zugriff auf Deine alten Linkverzeichnis-Tabellen. Trage die SQL-Informationen aus Deinem alten Linkverzeichnis ein. Der Konverter wird Deine alten Verzeichnisdaten in keinster Weise ändern.',

	'DIRECTORY_NOT_INSTALLED_EXPLAIN'		=> 'Du musst das phpBB Linkverzeichnis installieren',
	'DONE'									=> 'Fertig',
	'DUPLICATE_AUTH_FOUND'					=> '%s ist %s mal gefunden worden',

	'FOUND'									=> 'Gefunden',

	'GPL'									=> 'Generallizenz',

	'INSTALL_CONGRATS'						=> 'Herzlichen Glückwunsch!',
	'INSTALL_CONGRATS_EXPLAIN'				=> '<p>Du hast das phpBB Linkverzeichnis %1$s mit Erfolg installiert.</p>
<p>Klicke auf unten stehenden Button, um in Dein Administration-Menü zu gelangen.</p><p><strong>Lösche oder benenne Dein Installations-Verzeiochnis um. Sollten die Datein noch vorhanden sein, ist nur das Administrationsmenü sichtbar.</strong></p>',
	'INSTALL_INTRO'							=> 'Willkommen zur Installation des phpBB Linkverzeichnis',
	'INSTALL_INTRO_BODY'					=> 'Mit dieser Option kannst Du das phpBB Linkverzeichnis auf Deinen Server installieren.',
	'INSTALL_LOGIN'							=> 'Fahre fort mit ACP',
	'INSTALL_PANEL'							=> 'Installationpanel des Linkverzeichnis',
	'INSTALL_START'							=> 'Start Installation',
	'INSTALL_TEST'							=> 'Test wiederholen',
	'INST_ERR'								=> 'Installationsfehler',
	'INST_ERR_AUTH'							=> 'Du musst als Gründer eingeloggt sein, um dieses Skript auszuführen.</strong>.',
	'INST_ERR_FATAL'						=> 'Schwerwiegender Installationsfehler',

	'LINK_DESC_CLEAN'						=> 'Bereinigung der Beschreibungen der Links',

	'MODULE_ACP'							=> 'ACP Module',
	'MODULE_MCP'							=> 'MCP Module',
	'MODULE_UCP'							=> 'UCP Module',

	'NEXT_STEP'								=> 'Nächster Schritt',

	'OVERVIEW_BODY'							=> 'Willkommen im phpBB Linkverzeichnis!<br /><br />Das phpBB Linkverzeichnis ist reich an Funktionen,	einfach zu bedienen und vollständig in phpBB integriert.<br /><br />Dieser Installer führt Dich durch die Installation des phpBB Linkverzeichnis, durch das Update oder das deinstallieren des phpBB Linkverzeichnisses. Wenn Du Begriffe im phpBB Linkverzeichnis nicht verstehst, geben wir Dir gerne Unterstützung. Ansonsten benutze die Auswahl der obenstehenden Tab-Reiter. Um weiter zu gehen, wähle bitte den  unten stehenden Button aus.',

	'PHPBB_SETTINGS'						=> 'phpBB Version',
	'PHPBB_SETTINGS_EXPLAIN'				=> '<strong>Pflicht</strong> - Du musst unter phpBB %s  oder höher sein, um das Linkverzeichnis zu installieren.',
	'PHPBB_VERSION_REQD'					=> 'phpBB Version >= %s',
	'PHP_ALLOW_URL_FOPEN_SUPPORT'			=> 'Die Funktion PHP allow_fopen_url ist verfügbar',
	'PHP_ALLOW_URL_FOPEN_SUPPORT_EXPLAIN'	=> '<strong>Requis</strong> - Damit das phpBB Linkverzeichnis richtig funtioniert, muss die Funktion PHP allow_fopen_url verfügbar sein.',
	'PHP_GETIMAGESIZE_SUPPORT'				=> 'Die Funktion PHP getimagesize() ist verfügbar',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'		=> '<strong>Requis</strong> - Damit das Linkverzeichnis richtig funktioniert, muß die Funktion PHP getimagesize() zur verfügung stehen.',
	'PHP_SETTINGS'							=> 'PHP Version und Parameter',
	'PHP_SETTINGS_EXPLAIN'					=> '<strong>Pflicht</strong> - es muss PHP %s oder höher installiert sein, um das phpBB Linkverzeichnis zu installieren.',
	'PHP_VERSION_REQD'						=> 'Deine PHP Version muss mindestens %s  sein',
	'PRE_CONVERT_COMPLETE'					=> 'Alle Pré-Konvertierung-Schritte sind abgeschlossen. Du kannst mit der Konvertierung beginnen. Beachte bitte, dass Du einige Dinge eventuell manuell anpassen musst.',

	'REQUIREMENTS_EXPLAIN'					=> 'Vor Durchführung einer kompletten Installation, prüft phpBB die Konfiguration der Dateien auf Deinem Server und überzeugt sich, das Du phpBB installieren kannst. Lese die Ergebnisse und fahre nicht fort, bis alle Tests validiert sind. Willst Du eine optionale Funktion aktivieren, musst Du sicherstellen, dass diese Tests auch überprüft und validiert werden.',
	'REQUIREMENTS_TITLE'					=> 'Instalation Kompatibilität',

	'SKIP'									=> 'Zum Inhalt',
	'SOFTWARE'								=> 'System d’annuaire',
	'STAGE_INSTALL'							=> 'Install',
	'STAGE_INSTALL_DIR'						=> 'Installation von phpBB Linkverzeichnis',
	'STAGE_INSTALL_DIR_EXPLAIN'				=> 'Die Tabellen, Module, Berechtigungen und benutzte Daten von phpBB Linkverzeichnis wurden erzeugt.',
	'STAGE_INTRO'							=> 'Einführung',
	'STAGE_REQUIREMENTS'					=> 'Bedingungen',
	'STAGE_UNINSTALL'						=> 'Deinstallation',
	'STAGE_UNINSTALL_DIR'					=> 'Deinstalltion von phpBB Linkverzeichnis',
	'STAGE_UNINSTALL_DIR_EXPLAIN'			=> 'Die Tabellen, Module, Berechtigungen und benutzte Daten von phpBB Linkverzeichnis wurden gelöscht. Zur Vervollständigung der Deinstallation, müssen alle Datein vom phpBB Linkverzeichnis vom Server gelöscht werden.',
	'STAGE_UPDATE'							=> 'Update',
	'STAGE_UPDATE_DIR'						=> 'Update von phpBB Linkverzeichnis',
	'STAGE_UPDATE_DIR_EXPLAIN'				=> 'phpBB Linkverzeichnis ist aktualisiert.',
	'SUB_INTRO'								=> 'Einführung',
	'SUB_LICENSE'							=> 'Lizenz',
	'SUB_SUPPORT'							=> 'Support',
	'SUPPORT_BODY'							=> 'Für diese Mod erfolgt Support. Dies beinhaltet:</p><ul><li>Installation</li><li>Konfiguration</li><li>Technische Fragen</li><li>Probleme im Zusammenhang mit potenziellen Bugs des Scripts</li><li>Update von alter Version zu der neuesten Version</li></ul><p>Ich ermutige jeden Benutzer des Link-Verzeichnis, diesen auf die neueste Version zu aktualisieren.</p><h2>Um Support zu erhalten:</h2><p><a href="http://redmine.erwan-projects.fr/projects/phpbb-directory/boards">Developper Statusdes Mod</a><br /><a href="http://www.modsphpbb3.fr/viewtopic.php?f=60&t=89">Liste der Neuerungen</a><br /><br />',
	'SYNC_CATS'								=> 'Synchronisation der Kategorien',
	'SYNC_LINKS'							=> 'Synchronisation der Links',
	'SYNC_LINK_ID'							=> 'Synchronisation der Links <var>link_id</var> %1$s à %2$s.',

	'UNAVAILABLE'							=> 'Nicht verfügbar',
	'UNINSTALL_CONGRATS_EXPLAIN'			=> '<p>Du hast erfolgreich das phpBB Linkverzeichnis %1$s gelöscht.</p>
		<p>Klicke auf untenstehenden Button, um in Dein Administrationmenü zu gelangen.<p><strong>Lösche oder benenne Dein Installverzeichnis um, bevor Du in Dein Forum auf rufst. Sollte das Installations-Verzeichnis noch vorhanden sein, ist nur das Adminmenü zugänglich.</strong></p>',
	'UNINSTALL_INTRO'						=> 'Willkommen in der Deinstallation von phpBB Linkverzeichnis',
	'UNINSTALL_INTRO_BODY'					=> 'Mit dieser Option ist es möglich, die Datenbankeinträge vom Linkverzeichniss zu löschen.',
	'UNINSTALL_START'						=> 'Beginn der Deinstallation',
	'UNWRITABLE'							=> 'Schreibverbot',
	'UPDATE_CONGRATS_EXPLAIN'				=> '<p>Du hast erfolgreich phpBB Annuaire %1$s aktualisiert.</p>
		<p>Klicke auf untenstehenden Button, um in dein Administrationmenü zu gelangen.</p><p><strong>Lösche oder benenne Dein Installverzeichnis um, bevor Du Dein Forum auf rufst.. Sollte das Installtions-Verzeichnis noch vorhanden sein, ist nur das Adminmenü zugänglich.</strong></p>',
	'UPDATE_INTRO'							=> 'Willkommen im Updatemenü von phpBB Linkverzeichnis',
	'UPDATE_INTRO_BODY'						=> 'Mit dieser Option ist es möglich, das phpBB Linkverzeichnis auf die letzte Version zu aktualisieren.',
	'UPDATE_START'							=> 'Update Beginn',

	'VERSION'								=> 'Version',

	'WELCOME_INSTALL'						=> 'Willkommen in der Installation der Mod phpBB Linkverzeichnis',
	'WRITABLE'								=> 'Schreibberechtigt',
));

?>
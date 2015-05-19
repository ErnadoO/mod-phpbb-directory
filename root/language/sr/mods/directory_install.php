<?php
/**
*
* directory_install [Serbian]
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
	'CAT_DESC_CLEAN'						=> 'Uklanjnje opisa kategorija',
	'CAT_INSTALL'							=> 'Instalirati',
	'CAT_OVERVIEW'							=> 'Intro',
	'CAT_UNINSTALL'							=> 'Dezinstalacija',
	'CAT_UPDATE'							=> 'Azurirati',
	'CONVERT_COMPLETE_EXPLAIN'				=> 'Vas direktorijum je konvertovan. Molimo uverite se da su podaci iz vaseg bivseg Direktorijuma korektno prebaceni pre nego sto reaktivirate vasu oglasnu tablu brisanjem instalacionog direktorijuma. Mozete se ulogovati <a href="../directory.php">access your directory</a>.',
	'CONVERT_INTRO'							=> 'Dobrodosli u ',
	'CONVERT_INTRO_BODY'					=> 'Ovde mozete unositi podatke iz ostalih directory systems. Ova lista prikazuje sve module za konverziju trenutno dostupne.',
	'CONV_OPTIONS_BODY'						=> 'Ova stranica potrebne informacije za pristup tabelama iz vaseg prethodnog direktorijuma. Unesite informacije o bazi podataka vaseg prethodnog direktorijuma; Konverter nece modifikovati podatke iz vaseg prethodnog direktorijuma.',

	'DIRECTORY_NOT_INSTALLED_EXPLAIN'		=> 'Morate instalirati phpBB Direktorijum',
	'DONE'									=> 'Uradjeno',
	'DUPLICATE_AUTH_FOUND'					=> '%s je pronadjen %s puta',

	'FOUND'									=> 'Pronadjen',

	'GPL'									=> 'General Public License',

	'INSTALL_CONGRATS'						=> 'Cestitamo!',
	'INSTALL_CONGRATS_EXPLAIN'				=> '
		<p>Uspesno ste instalirali phpBB Direktorijuma %1$s</p>
		<p>Kliknite da biste bili prebaceni u admin panel</p><p><strong>Sada, izbrisite ili preimenujte instalacioni direktorijum pre nego sto odete na oglasni tablu. Ako to ne uradite admin panel je jedina stvar koja ce biti dostupna. </strong></p>',
	'INSTALL_INTRO'							=> 'Dobrodosli u proces instalacije phpBB Direktorijuma mod-a',
	'INSTALL_INTRO_BODY'					=> 'Pomocu ove opcije mozete instalirati phpBB Direktorijuma na vasem serveru.',
	'INSTALL_LOGIN'							=> 'Pristup ACP-u',
	'INSTALL_PANEL'							=> 'Panel za instalaciju phpBB Direktorijuma mod-a',
	'INSTALL_START'							=> 'Zapoceti instalaciju',
	'INSTALL_TEST'							=> 'Pokusajte ponovo',
	'INST_ERR'								=> 'Greska pri instaliranju',
	'INST_ERR_AUTH'							=> 'Morate biti ulogovani kao admin da biste izvrsili ovaj skript.</strong>.',
	'INST_ERR_FATAL'						=> 'Ozbiljna greska pri instaliranju',

	'LINK_DESC_CLEAN'						=> 'Brisanje opisa vebsajtova',

	'MODULE_ACP'							=> 'ACP Modul',
	'MODULE_MCP'							=> 'MCP Modul',
	'MODULE_UCP'							=> 'UCP Modul',

	'NEXT_STEP'								=> 'Sledeci korak',

	'OVERVIEW_BODY'							=> 'Dobrodosli u phpBB Direktorijum!<br /><br /> u phpBB Direktorijuma-u mozete naci brojne funkcije lake za upotrebu i potpuno je integrisan u phpBB.<br /><br />Ovaj instalacioni sistem ce vas voditi kroz instalaciju phpBB Direktorijuma, azuriranje najnovije verzije phpBB Direktorijuma kao i kroz uklanjanje phpBB Directorijuma. Ako zelite procitati pravila koriscenja  phpBB Direktorijuma ili saznati vise o podrsci koju vam mozemo obezbediti, molimo vas izaberite opciju u meniju sa strane. Da biste nastavili izaberite tab ispod.',

	'PHPBB_SETTINGS'						=> 'phpBB Version',
	'PHPBB_SETTINGS_EXPLAIN'				=> '<strong>Required</strong> - Morate imati phpBB %s ili noviji da biste instalirali phpBB Direktorijum.',
	'PHPBB_VERSION_REQD'					=> 'phpBB Version >= %s',
	'PHP_ALLOW_URL_FOPEN_SUPPORT'			=> 'PHP funkcija allow_fopen_url je dostupna',
	'PHP_ALLOW_URL_FOPEN_SUPPORT_EXPLAIN'	=> '<strong>Required</strong> - Da bi phpBB Direktorijum mod funkcionisao kako treba, funkcija allow_fopen_url mora biti dostupna.',
	'PHP_GETIMAGESIZE_SUPPORT'				=> ' PHP funkcija getimagesize() je dostupna',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'		=> '<strong>Required</strong> - Da bi phpBB Direktorijum mod funkcionisao kako treba, funkcija getimagesize() mora biti dostupna.',
	'PHP_SETTINGS'							=> 'PHP Verzija i podesavanja',
	'PHP_SETTINGS_EXPLAIN'					=> '<strong>REQUIRED</strong> - Morate imati php %s ili noviji da biste instalirali phpBB Direktorijum.',
	'PHP_VERSION_REQD'						=> 'Vasa PHP verzija mora biti bar %s ',
	'PRE_CONVERT_COMPLETE'					=> 'Svi koraci koji prethode konverziji su uspesno zavrseni. Mozete zapoceti  konverziju. Neke promene ce mozda morati da budu rucno izvrsene.',

	'REQUIREMENTS_EXPLAIN'					=> 'Pre zavrsetka instalacije, phpBB Direktorijum ce proveriti konfiguraciju vaseg servera da se uveri da mozete instalirati phpBB Direktorijum. Molimo pazljivo procitajte rezultate i nemojte nastavljati pre zavrsetka svih testova. Ako zelite da aktivirate opciju sa dodatnim testovima morate proveriti da su i oni obavljeni pre nego sto nastavite.',
	'REQUIREMENTS_TITLE'					=> 'Kompatibilnost instalacije',

	'SKIP'									=> 'preci na sadrzaj',
	'SOFTWARE'								=> 'Direktorijuma System',
	'STAGE_INSTALL'							=> 'Instalirati',
	'STAGE_INSTALL_DIR'						=> 'Instalacija phpBB Direktorijuma',
	'STAGE_INSTALL_DIR_EXPLAIN'				=> 'Tabele, module,  dozvole i podaci koje phpBB Direktorijuma mod koristi su kreirani.',
	'STAGE_INTRO'							=> 'Uvod',
	'STAGE_REQUIREMENTS'					=> 'Uslovi',
	'STAGE_UNINSTALL'						=> 'Uklanjanje',
	'STAGE_UNINSTALL_DIR'					=> 'Ukloniti  phpBB Direktorijum',
	'STAGE_UNINSTALL_DIR_EXPLAIN'			=> ' Tabele, module,  dozvole i podaci korisceni od strane phpBB Direktorijuma moda su izbrisani. Da biste uspesno zavrsili uklanjanje, morate ponistiti sve modifikacije fajlova koje mod zahteva i izbrisati sve fajlove sa vaseg servera.',
	'STAGE_UPDATE'							=> 'Azurirati',
	'STAGE_UPDATE_DIR'						=> 'Azurirati phpBB Direktorijum',
	'STAGE_UPDATE_DIR_EXPLAIN'				=> 'phpBB Direktorijum je azuriran.',
	'SUB_INTRO'								=> 'Uvod',
	'SUB_LICENSE'							=> 'Licenca',
	'SUB_SUPPORT'							=> 'Podrska',
	'SUPPORT_BODY'							=> 'Podrska za ovaj mod moze biti obezbedjena. Sadrzi:</p><ul><li>instalacija</li><li>configuracija</li><li>tehnicka pitanja</li><li>problemi vezani za potencijalne bagove skripta</li><li>prebacivanje iz starih u nove verzije</li></ul><p>Preporuka svim korisnicima starih verzija phpBB Direktorijuma da predju na novu verziju.</p><h2>Za podrsku:</h2><p><a href="http://redmine.erwan-projects.fr/projects/phpbb-directory/boards">Development of the Mod Topic</a><br /><a href="http://www.modsphpbb3.fr/viewtopic.php?f=60&t=89">List of the updates</a><br /><br />',
	'SYNC_CATS'								=> 'Sinhronizacija kategorija',
	'SYNC_LINKS'							=> 'sinhronizacija linkova',
	'SYNC_LINK_ID'							=> 'Sinhronizacija linkova <var>link_id</var> %1$s to %2$s.',

	'UNAVAILABLE'							=> 'Nedostupno',
	'UNINSTALL_CONGRATS_EXPLAIN'			=> '
		<p>Uspesno ste uklonili phpBB Direktorijuma %1$s.</p>
		<p>Kliknite na dugme ispod da biste bili prebaceni u admin panel.<p><strong>Sada, izbrisite ili preimenujte instalacioni direktorijum pre nego sto odete na oglasni tablu. Ako to ne uradite admin panel je jedina stvar koja ce biti dostupna.</strong></p>',
	'UNINSTALL_INTRO'						=> 'Dobrdosli u proces dezinstlacije phpBB Direktorijuma',
	'UNINSTALL_INTRO_BODY'					=> 'Ova opcija vam omogucava da izbrisete phpBB Direktorijum iz baze podataka.',
	'UNINSTALL_START'						=> 'Zapoceti dezinstalaciju',
	'UNWRITABLE'							=> 'Unwritable',
	'UPDATE_CONGRATS_EXPLAIN'				=> '
		<p>Uspesno ste azurirali phpBB Direktorijum %1$s</p>
		<p>kliknite na dugme ispod da biste bili prebaceni u admin panel.<p><strong>Sada, izbrisite ili preimenujte instalacioni direktorijum pre nego sto odete na oglasni tablu. Ako to ne uradite admin panel je jedina stvar koja ce biti dostupna.</strong></p>',
	'UPDATE_INTRO'							=> 'Dobrodosli u proces azuriranja phpBB Direktorijuma',
	'UPDATE_INTRO_BODY'						=> 'Ova opcija vam omogucava da predjete na poslednju dostupnu verziju phpBB Direktorijuma.',
	'UPDATE_START'							=> 'Zapoceti azuriranje',

	'VERSION'								=> 'Verzija',

	'WELCOME_INSTALL'						=> 'Dobrodosli u proces instalacije phpBB Direktorijuma',
	'WRITABLE'								=> 'Writable',
));

?>

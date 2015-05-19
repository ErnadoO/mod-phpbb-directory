<?php
/**
*
* directory_install [Italian]
*
* @package language
* @version $Id$
* @copyright (c) 2011 http://www.phpbb-services.com
* @copyright (c) 2013 Translation by Galandas & Salvo Cortesiano (www.phpbb3world.com) (www.netshadows.it/forum)
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
	'CAT_DESC_CLEAN'						=> 'Pulizia delle descrizioni categoria',
	'CAT_INSTALL'							=> 'Installa',
	'CAT_OVERVIEW'							=> 'Intro',
	'CAT_UNINSTALL'							=> 'Disinstalla',
	'CAT_UPDATE'							=> 'Aggiorna',
	'CONVERT_COMPLETE_EXPLAIN'				=> 'Hai convertito la tua directory. Si prega di assicurarsi che i dati dal vecchio directory sono stati trasferiti correttamente prima di riattivare il tuo forum cancellando la directory di installazione. Ora è possibile <a href="../directory.php">accedere alla directory</a>.',
	'CONVERT_INTRO'							=> 'Benvenuti in “phpBB Directory Unified Convertor Framework”',
	'CONVERT_INTRO_BODY'					=> 'Da qui, è possibile importare dati provenienti da altri sistemi di directory. Il seguente elenco mostra tutti i moduli di conversione attualmente disponibili.',
	'CONV_OPTIONS_BODY'						=> 'Questa pagina raccoglie le informazioni necessarie per ottenere l’accesso alla vostra vecchia directory tabelle. Inserisci le informazioni del tuo vecchio directory database; Il convertitore non modificherà i tuoi vecchi dati del directory',

	'DIRECTORY_NOT_INSTALLED_EXPLAIN'		=> 'È necessario installare phpBB Directory',
	'DONE'									=> 'Fatto',
	'DUPLICATE_AUTH_FOUND'					=> '%s è stata trovata %s volte',

	'FOUND'									=> 'Found',

	'GPL'									=> 'General Public License',

	'INSTALL_CONGRATS'						=> 'Congratulazioni!',
	'INSTALL_CONGRATS_EXPLAIN'				=> '
		<p>hai installato con successo phpBB Directory %1$s</p>
		<p>Clicca sul pulsante per andare al tuo pannello di amministrazione</p><p><strong>Ora, eliminare o rinominare la directory di installazione prima di accedere al vostro forum. Se non lo fai, potrai solo accedere al pannello di amministrazione</strong></p>',
	'INSTALL_INTRO'							=> 'Benvenuti alla prima installazione del mod phpBB Directory',
	'INSTALL_INTRO_BODY'					=> 'Con questa opzione, è possibile installare phpBB Directory sul vostro server.',
	'INSTALL_LOGIN'							=> 'Accesso in ACP',
	'INSTALL_PANEL'							=> 'Pannello di installazione del mod phpBB Directory',
	'INSTALL_START'							=> 'Avvia l’installazione',
	'INSTALL_TEST'							=> 'Prova di nuovo',
	'INST_ERR'								=> 'Errore installazione',
	'INST_ERR_AUTH'							=> '<strong>È necessario accedere come amministratore per eseguire questo script.</strong>',
	'INST_ERR_FATAL'						=> 'Fatale Errore installazione',

	'LINK_DESC_CLEAN'						=> 'Pulizia delle descrizioni dei siti web',

	'MODULE_ACP'							=> 'ACP Modulo',
	'MODULE_MCP'							=> 'MCP Modulo',
	'MODULE_UCP'							=> 'UCP Modulo',

	'NEXT_STEP'								=> 'Passo successivo',

	'OVERVIEW_BODY'							=> 'Benvenuti in phpBB Directory!<br /><br />phpBB Directory è pieno di funzioni, facile da usare, ed è completamente integrato con phpBB. <br /><br />Questo sistema di installazione vi guiderà attraverso l’installazione di phpBB Directory, l’aggiornamento alla versione più recente di phpBB Directory e la rimozione di phpBB Directory. Per leggere le condizioni di utilizzo di phpBB Directory è per saperne di più sul supporto che possiamo fornire a voi, si prega di selezionare l’opzione per il menu sul lato. Per continuare, per favore seleziona la scheda sottostante.',

	'PHPBB_SETTINGS'						=> 'Versione phpBB',
	'PHPBB_SETTINGS_EXPLAIN'				=> '<strong>Richiesto</strong> - È necessario cambiare phpBB %s o superiore per installare phpBB Directory.',
	'PHPBB_VERSION_REQD'					=> 'Versione phpBB >= %s',
	'PHP_ALLOW_URL_FOPEN_SUPPORT'			=> 'La direttiva PHP allow_fopen_url è disponibile',
	'PHP_ALLOW_URL_FOPEN_SUPPORT_EXPLAIN'	=> '<strong>Richiesto</strong> - Per far funzionare la Mod phpBB Directory correttamente, la funzione allow_fopen_url deve essere disponibile.',
	'PHP_GETIMAGESIZE_SUPPORT'				=> 'La funzione getimagesize() di PHP è disponibile',
	'PHP_GETIMAGESIZE_SUPPORT_EXPLAIN'		=> '<strong>Richiesto</strong> - Per far funzionare la Mod phpBB Directory correttamente, la funzione getimagesize() deve essere disponibile.',
	'PHP_SETTINGS'							=> 'Versione PHP e parametri',
	'PHP_SETTINGS_EXPLAIN'					=> '<strong>RICHIESTO</strong> - È necessario essere in php %s o superiore per installare phpBB Directory.',
	'PHP_VERSION_REQD'						=> 'La tua versione di PHP deve essere almeno la %s',
	'PRE_CONVERT_COMPLETE'					=> 'Tutte le fasi di pre-conversione sono state fatte. Si può iniziare il processo di conversione. Si prega di notare che potrebbe essere necessario fare alcune modifiche manuali.',

	'REQUIREMENTS_EXPLAIN'					=> 'Prima di eseguire una installazione completa, phpBB Directory controllerà la configurazione dei file del server per assicurarsi la possibilità di installare phpBB Directory. Leggere i risultati con attenzione e non continuare fino a quando tutti i test sono stati eseguiti. Se si desidera attivare una funzione con prove facoltative, è necessario assicurarsi che questi test sono anche stati fatti.',
	'REQUIREMENTS_TITLE'					=> 'Compatibilità installazione',

	'SKIP'									=> 'Vai ai contenuti',
	'SOFTWARE'								=> 'Directory System',
	'STAGE_INSTALL'							=> 'Installa',
	'STAGE_INSTALL_DIR'						=> 'Installazione di phpBB Directory',
	'STAGE_INSTALL_DIR_EXPLAIN'				=> 'Le tabelle, moduli, permessi e set di dati utilizzati dal mod phpBB Directory sono stati creati.',
	'STAGE_INTRO'							=> 'Introduzione',
	'STAGE_REQUIREMENTS'					=> 'Condizioni',
	'STAGE_UNINSTALL'						=> 'Rimozione',
	'STAGE_UNINSTALL_DIR'					=> 'Rimozione di phpBB Directory',
	'STAGE_UNINSTALL_DIR_EXPLAIN'			=> 'Le tabelle, moduli, permessi e dati utilizzati dal mod phpBB Directory sono stati cancellati. Per completare la rimozione, è necessario annullare tutte le modifiche dei file necessari per la mod e cancellare tutti i file dal vostro server.',
	'STAGE_UPDATE'							=> 'Aggiorna',
	'STAGE_UPDATE_DIR'						=> 'Aggiornamento di phpBB Directory',
	'STAGE_UPDATE_DIR_EXPLAIN'				=> 'phpBB Directory è stato aggiornato con successo.',
	'SUB_INTRO'								=> 'Introduzione',
	'SUB_LICENSE'							=> 'Licenza',
	'SUB_SUPPORT'							=> 'Supporto',
	'SUPPORT_BODY'							=> 'Il supporto che può essere fornito per questa mod. Contiene:</p><ul><li>installazione</li><li>configurazione</li><li>domande tecniche</li><li>problemi legati a potenziali bug dello script</li><li>aggiornamento dalle versioni precedenti alla versione più recente</li></ul><p>Raccomando a tutti gli utenti che hanno una vecchia versione di phpBB Directory di aggiornare la propria installazione con la versione più recente.</p><h2>Per ottenere supporto:</h2><p><a href="http://redmine.erwan-projects.fr/projects/phpbb-directory/boards">Sviluppo Topic Mod</a><br /><a href="http://www.modsphpbb3.fr/viewtopic.php?f=60&t=89">Elenco degli aggiornamenti</a><br /><br />',
	'SYNC_CATS'								=> 'Sincronizzazione categoria',
	'SYNC_LINKS'							=> 'Sincronizzazione Link',
	'SYNC_LINK_ID'							=> 'Sincronizzazione Link <var>link_id</var> %1$s to %2$s.',

	'UNAVAILABLE'							=> 'Non disponibile',
	'UNINSTALL_CONGRATS_EXPLAIN'			=> '
		<p>Avete rimosso con successo phpBB Directory %1$s.</p>
		<p>Clicca sul pulsante qui sotto per accedere al tuo pannello di amministrazione.<p><strong>Ora, eliminare o rinominare la directory di installazione prima di accedere sul vostro forum. Se non lo fai, potrai solo accedere al pannello di amministrazione.</strong></p>',
	'UNINSTALL_INTRO'						=> 'Benvenuti nella rimozione di phpBB Directory',
	'UNINSTALL_INTRO_BODY'					=> 'Con questa opzione, è possibile eliminare phpBB Directory dal database.',
	'UNINSTALL_START'						=> 'Avvia la rimozione',
	'UNWRITABLE'							=> 'Non scrivibile',
	'UPDATE_CONGRATS_EXPLAIN'				=> '
		<p>Hai aggiornato correttamente phpBB Directory %1$s</p>
		<p>Clicca sul pulsante qui sotto per accedere al tuo pannello di amministrazione.<p><strong>Ora, eliminare o rinominare la directory di installazione prima di accedere sul vostro forum. Se non lo fai, potrai solo accedere al pannello di amministrazione.</strong></p>',
	'UPDATE_INTRO'							=> 'Benvenuti nell’aggiornamento di phpBB Directory',
	'UPDATE_INTRO_BODY'						=> 'Con questa opzione, è possibile aggiornare phpBB Directory alla versione più recente.',
	'UPDATE_START'							=> 'Avvia l’aggiornamento',

	'VERSION'								=> 'Versione',

	'WELCOME_INSTALL'						=> 'Benvenuti nell’installazione di phpBB Directory',
	'WRITABLE'								=> 'Scrivibile',
));

?>
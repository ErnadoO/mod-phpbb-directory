<?php
/**
*
* directory [Italian]
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
	'DIR_SEARCH_NO_RESULT'					=> 'Nessun risultato per la ricerca effettuata',
	'DIR_BANNER_DISALLOWED_CONTENT'			=> 'Il trasferimento è stato interrotto perché il file è stato identificato come una potenziale minaccia.',
	'DIR_BANNER_DISALLOWED_EXTENSION'		=> 'Questo file non può essere mostrato perche l’estensione <strong>%s</strong> non è permesso.',
	'DIR_BANNER_EMPTY_FILEUPLOAD'			=> 'Il file del banner è vuoto.',
	'DIR_BANNER_EMPTY_REMOTE_DATA'			=> 'Il banner presentato non può essere trasferito, perché i dati sembrano errati o corrotti.',
	'DIR_BANNER_IMAGE_FILETYPE_MISMATCH'	=> 'Banner tipo di file non corrispondente: estensione prevista %1$s ma estensione %2$s dato.',
	'DIR_BANNER_INVALID_FILENAME'			=> '%s è un nome di file non valido.',
	'DIR_BANNER_NOT_UPLOADED'				=> 'Il banner non può essere trasferito',
	'DIR_BANNER_NO_SIZE'					=> 'Errore durante il tentativo di determinare l’altezza e la larghezza dell’avatar. Inserisci manualmente',
	'DIR_BANNER_PARTIAL_UPLOAD'				=> 'Il file non può essere totalmente trasferito.',
	'DIR_BANNER_PHP_SIZE_NA'				=> 'La dimensione del banner è troppo grande.<br />Il set di dimensione massima in php.ini non può essere determinato.',
	'DIR_BANNER_PHP_SIZE_OVERRUN'			=> 'La dimensione del banner è troppo grande. La dimensione massima consentita è di %d Mo.<br />Si prega di notare che questa impostazione è scritto nel file php.ini e non può essere allungato.',
	'DIR_BANNER_UNABLE_GET_IMAGE_SIZE'		=> 'Non è stato possibile determinare le dimensioni del banner',
	'DIR_BANNER_URL_INVALID'				=> 'L’indirizzo del banner non è valido',
	'DIR_BANNER_URL_NOT_FOUND'				=> 'Il file non può essere trovato.',
	'DIR_BANNER_WRONG_FILESIZE'				=> 'La dimensione del banner deve essere tra 0 e %1d %2s.',
	'DIR_BANNER_WRONG_SIZE'					=> 'Il banner specificato ha una larghezza di %5$d pixel e un’altezza di %6$d pixel. Il banner deve essere di almeno %1$d pixel di larghezza e %2$d pixel di altezza, ma non può essere più di %3$d pixel di larghezza e %4$d di altezza.',
	'DIR_BE_NOTIFIED'						=> 'Ricevi una e-mail quando un nuovo sito web viene aggiunto a questa categoria',
	'DIR_BE_NOT_NOTIFIED'					=> 'Stop non ricevere più email quando un nuovo sito web viene aggiunto a questa categoria',
	'DIR_CAT'								=> 'Categoria',
	'DIR_CAT_NAME'							=> 'Nome Categoria',
	'DIR_CAT_TITLE'							=> 'Categorie Directory',
	'DIR_CLICK_RETURN_DIR'					=> 'Clicca %squi%s per tornare all’indice della directory',
	'DIR_CLICK_RETURN_CAT'					=> 'Clicca %squi%s per tornare alla categoria',
	'DIR_CLICK_RETURN_LIEN'					=> 'Clicca %squi%s per tornare al sito',
	'DIR_COMMENT'							=> 'commento',
	'DIR_COMMENTS'							=> 'commenti',
	'DIR_COMMENTS_ORDER'					=> 'Commenti',
	'DIR_COMMENT_TITLE'						=> 'Leggi/Scrivi un commento',
	'DIR_COMMENT_DELETE'					=> 'Elimina il commento',
	'DIR_COMMENT_DELETE_CONFIRM'			=> 'Sei sicuro di voler eliminare il commento?',
	'DIR_COMMENT_EDIT'						=> 'Modifica il commento',
	'DIR_DELETE_BANNER'						=> 'Elimina il banner',
	'DIR_DELETE_OK'							=> 'Il sito è stato correttamente eliminato',
	'DIR_DELETE_SITE'						=> 'Elimina il sito Web',
	'DIR_DELETE_SITE_CONFIRM'				=> 'Sei sicuro di voler eliminare il sito web?',
	'DIR_DESCRIPTION'						=> 'Descrizione',
	'DIR_DESCRIPTION_EXP'					=> 'Una breve descrizione del tuo sito web, massimo %d caratteri.',
	'DIR_DISPLAY_LINKS'						=> 'Mostra link precedenti',
	'DIR_EDIT'								=> 'Modifica',
	'DIR_EDIT_SITE'							=> 'Modifica sito web',
	'DIR_EDIT_SITE_ACTIVE'					=> 'Il tuo sito web è stato modificato, ma deve essere approvato prima di apparire nella directory',
	'DIR_EDIT_SITE_OK'						=> 'Il sito web è stato modificato',
	'DIR_ERROR_AUTH_COMM'					=> 'Non è consentito inserire un commento',
	'DIR_ERROR_CAT'							=> 'Errore durante il tentativo di recuperare i dati dalla categoria corrente.',
	'DIR_ERROR_CHECK_URL'					=> 'Questo URL sembra irraggiungibile',
	'DIR_ERROR_COMM_LOGGED'					=> 'Devi essere loggato per inviare un commento',
	'DIR_ERROR_KEYWORD'						=> 'È necessario immettere una parola chiave per la ricerca.',
	'DIR_ERROR_NOT_AUTH'					=> 'Non ti è permesso di fare questa operazione',
	'DIR_ERROR_NOT_FOUND_BACK'				=> 'La pagina specificata per il collegamento indietro non si trova.',
	'DIR_ERROR_NO_CATS'						=> 'Questa categoria non esiste',
	'DIR_ERROR_NO_LINK'						=> 'Il sito che stai cercando non esiste',
	'DIR_ERROR_NO_LINKS'					=> 'Questo sito non esiste',
	'DIR_ERROR_NO_LINK_BACK'				=> 'Il link di ritorno non è stato trovato sulla pagina che hai specificato',
	'DIR_ERROR_SUBMIT_TYPE'					=> 'Tipo di dati non corretto in funzione dir_submit_type',
	'DIR_ERROR_URL'							=> 'È necessario inserire un URL corretto',
	'DIR_ERROR_VOTE'						=> 'Hai già votato per questo sito',
	'DIR_ERROR_VOTE_LOGGED'					=> 'Devi essere loggato per votare',
	'DIR_ERROR_WRONG_DATA_BACK'				=> 'L’indirizzo per il link deve essere un URL valido, compreso il protocollo. per esempio http://www.example.com/.',
	'DIR_FIELDS'							=> 'Si prega di compilare tutti i campi contrassegnati con *',
	'DIR_FLAG'								=> 'Bandiera',
	'DIR_FLAG_EXP'							=> 'Scegli un Bandiera che indica la nazionalità del sito',
	'DIR_FROM_TEN'							=> '%s/10',
	'DIR_GUEST_EMAIL'						=> 'Il tuo indirizzo e-mail',
	'DIR_KEYWORD'							=> 'Parole chiave ricerca',
	'DIR_KEYWORD_EXP'						=> 'Separare le diverse parole con uno spazio',
	'DIR_MAKE_SEARCH'						=> 'Cerca un sito web',
	'DIR_NAME_ORDER'						=> 'Nome',
	'DIR_NB_CLIC'							=> '%d click',
	'DIR_NB_CLICS'							=> '%d click',
	'DIR_NB_CLICS_ORDER'					=> 'Click',
	'DIR_NB_LINK'							=> '%d link',
	'DIR_NB_LINKS'							=> '%d link',
	'DIR_NB_VOTE'							=> '%d voti',
	'DIR_NB_VOTES'							=> '%d voti',
	'DIR_NEW_SITE'							=> 'Aggiungi un sito nella directory',
	'DIR_NEW_SITE_ACTIVE'					=> 'Il tuo sito web è stato aggiunto, ma deve essere approvato prima di apparire nella directory',
	'DIR_NEW_SITE_OK'						=> 'Il tuo sito è stato aggiunto alla directory',
	'DIR_NONE'								=> 'Nessuna',
	'DIR_NOTE'								=> 'Votazione',
	'DIR_NO_COMMENT'						=> 'Non ci sono commenti per questo sito',
	'DIR_NO_DRAW_CAT'						=> 'Non esiste una categoria',
	'DIR_NO_DRAW_LINK'						=> 'Non vi è alcun sito nella categoria',
	'DIR_NO_NOTE'							=> 'Nessuna',
	'DIR_PAGERANK'							=> 'Pr',
	'DIR_PAGERANK_NOT_AVAILABLE'			=> 'n/a',
	'DIR_PR_ORDER'							=> 'PageRank',
	'DIR_REPLY_EXP'							=> 'Il tuo commento non può essere più lungo di %d caratteri.',
	'DIR_REPLY_TITLE'						=> 'Posta un commento',
	'DIR_RSS'								=> 'RSS of',
	'DIR_SEARCH_AND'						=> 'Cerca tutte le parole',
	'DIR_SEARCH_CATLIST'					=> 'Cerca in una specifica categoria',
	'DIR_SEARCH_DESC_ONLY'					=> 'Solo descrizione',
	'DIR_SEARCH_METHOD'						=> 'Metodo',
	'DIR_SEARCH_NB_CLIC'					=> 'Click',
	'DIR_SEARCH_NB_CLICS'					=> 'Click',
	'DIR_SEARCH_NB_COMM'					=> '%d commento',
	'DIR_SEARCH_NB_COMMS'					=> '%d commenti',
	'DIR_SEARCH_OR'							=> 'Cerca almeno una delle parole',
	'DIR_SEARCH_RESULT'						=> 'Risultati della ricerca',
	'DIR_SEARCH_TITLE_DESC'					=> 'Nome e descrizione',
	'DIR_SEARCH_TITLE_ONLY'					=> 'Solo nome',
	'DIR_SEARCH_WITHIN'						=> 'Cerca in',
	'DIR_SITE_BACK'							=> 'URL della pagina di collegamento Indietro',
	'DIR_SITE_BACK_EXPLAIN'					=> 'In questa categoria, si chiede che il proprietario del sito aggiunge un link di ritorno. Si prega di specificare l’URL della pagina dove possiamo trovare il link',
	'DIR_SITE_BANN'							=> 'Aggiungi un banner',
	'DIR_SITE_BANN_EXP'						=> 'È necessario inserire qui l’URL completo del vostro banner. Si prega di notare che questo campo non è obbligatorio. La dimensione massima consentita è di <b>%d x %d</b> pixel, il banner verrà ridimensionato automaticamente se le dimensioni sono grandi.',
	'DIR_SITE_NAME'							=> 'Nome del sito web',
	'DIR_SITE_RSS'							=> 'RSS feeds',
	'DIR_SITE_RSS_EXPLAIN'					=> 'Si può aggiungere l’indirizzo del feed RSS se ce n’è uno. L’icona RSS verrà visualizzato accanto al tuo sito web, permettendo alle persone di iscriversi ad esso',
	'DIR_SITE_URL'							=> 'URL',
	'DIR_SOMMAIRE'							=> 'Indice della Directory',
	'DIR_SUBMIT_TYPE_1'						=> 'Il tuo Sito Web deve essere approvato da un amministratore.',
	'DIR_SUBMIT_TYPE_2'						=> 'Il tuo sito apparirà immediatamente nella directory.',
	'DIR_SUBMIT_TYPE_3'						=> 'Tu sei l’amministratore, il vostro sito verrà aggiunto automaticamente.',
	'DIR_SUBMIT_TYPE_4'						=> 'Tu sei moderatore, il vostro sito sarà automaticamente aggiunto.',
	'DIR_THUMB'								=> 'Miniatura Sito Web',
	'DIR_USER_PROP'							=> 'Sito presentato da',
	'DIR_VOTE'								=> 'Vota',
	'DIR_VOTE_OK'							=> 'Il vostro voto è stato presentato',
	'DIR_POST'								=> 'Posta',

	'DIRECTORY_TRANSLATION_INFO'			=> 'Translation by Galandas & Salvo Cortesiano (http://www.phpbb3world.com) (http://www.netshadows.it/forum)',

	'L_DIR_SEARCH_NB_COMM'					=> 'Commento',
	'L_DIR_SEARCH_NB_COMMS'					=> 'Commenti',

	'RECENT_LINKS'							=> 'Ultimi siti web aggiunti',

	// Don't translate this line!
	'SEED'									=> 'Mining PageRank is AGAINST GOOGLE’S TERMS OF SERVICE. Yes, I’m talking to you, scammer.',

	'TOO_LONG_BACK'							=> 'L’indirizzo contenente il link di ritorno è troppo lungo (massimo 255 caratteri)',
	'TOO_LONG_DESCRIPTION'					=> 'La tua descrizione è troppo lunga',
	'TOO_LONG_REPLY'						=> 'Il tuo commento è troppo lungo',
	'TOO_LONG_RSS'							=> 'L’URL del feed RSS è troppo lungo',
	'TOO_LONG_SITE_NAME'					=> 'Il nome immesso è troppo lungo (massimo 100 caratteri)',
	'TOO_LONG_URL'							=> 'L’URL che hai inserito è troppo lungo (massimo 255 caratteri)',
	'TOO_MANY_ADDS'							=> 'È stato raggiunto il numero totale di tentativi per una presentazione del sito web. Riprovare più tardi.',
	'TOO_SHORT_BACK'						=> 'È necessario inserire l’indirizzo della pagina in cui il link è.',
	'TOO_SHORT_DESCRIPTION'					=> 'È necessario inserire una descrizione',
	'TOO_SHORT_REPLY'						=> 'Il tuo commento è troppo breve',
	'TOO_SHORT_RSS'							=> 'L’URL del feed RSS è troppo breve',
	'TOO_SHORT_SITE_NAME'					=> 'È necessario inserire un nome per il sito web',
	'TOO_SHORT_URL'							=> 'È necessario inserire un indirizzo per il sito web',
	'TOO_SMALL_CAT'							=> 'È necessario selezionare una categoria',

	'WRONG_DATA_RSS'						=> 'Il feed RSS deve essere un URL valido, compreso il protocollo. per esempio http://www.example.com/.',
));

?>
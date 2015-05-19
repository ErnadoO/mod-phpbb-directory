<?php
/**
*
* info_acp_directory [Italian]
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
// You do not need this when single placeholders are used, e.g. 'Message %d' is fine
// equally when a string contains only two placeholders which are used to wrap text
// in a url once again you do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_DIRECTORY'							=> 'phpBB Directory',
	'ACP_DIRECTORY_CATS'					=> 'Impostazioni Categoria',
	'ACP_DIRECTORY_INDEX_TITLE'				=> 'phpBB Directory',
	'ACP_DIRECTORY_MAIN'					=> 'Informazioni e Strumenti',
	'ACP_DIRECTORY_SETTINGS'				=> 'Settaggi Generali',
	'ACP_DIRECTORY_SETTINGS_EXPLAIN'		=> 'Impostazioni Directory',
	'ACP_DIRECTORY_VAL'						=> 'Convalida Siti Web',
	'DIR_ACTIVE_CHECK'						=> 'Abilita test dei siti Web presentati',
	'DIR_ACTIVE_CHECK_EXPLAIN'				=> 'Cliccando su <i>si</i>, i link  dei siti Web presentati verranno testati. Se non vi sara alcuna risposta nel tempo di un secondo, essi saranno considerati come irraggiungibili.',
	'DIR_ACTIVE_THUMB'						=> 'Abilita le miniature dei siti Web',
	'DIR_ACTIVE_THUMB_REMOTE'				=> 'Abilita la compatibilità AscreeN',
	'DIR_ACTIVE_THUMB_REMOTE_EXPLAIN'		=> 'Cliccando su <i>si</i> nel corso della presentazione di un sito Web, la mod controllerà l’esistenza di una miniatura AscreeN.<br />Una miniatura AscreeN è gestita dal webmaster, e normalmente è quella che più si avvicina al look del sito.',
	'DIR_ACTIV_BANNER'						=> 'Abilita i link del banner',
	'DIR_ACTIV_FLAG'						=> 'Abilita la selezione della lingua',
	'DIR_ACTIV_PAGERANK'					=> 'Abilita il PageRank dei siti web',
	'DIR_ACTIV_PAGERANK_EXPLAIN'			=> 'Il PageRank calcolato verrà visualizzato nella presentazione del sito web.',
	'DIR_ACTIV_REWRITE'						=> 'Abilita riscrittura url della Directory',
	'DIR_ACTIV_REWRITE_EXPLAIN'				=> 'Se si attiva questa opzione, gli URL delle categorie delle directory cosi come pure i collegamenti nella barra di navigazione, verranno riscritti secondo le impostazioni della mod <a href="http://www.phpbb-seo.com/fr/mod-rewrite-phpbb/ultimate-seo-url-t4489.html" target="_blank">Ultimate SEO URL by dcz</a>.<br />Naturalmente una modifica al file .htaccess sarà necessaria.',
	'DIR_ACTIV_RSS'							=> 'Abilita la specifica del feed RSS',
	'DIR_ACTIV_RSS_EXPLAIN'					=> 'L’attivazione di questa opzione consente di specificare l’URL del feed RSS associato durante la presentazione del sito web. <br />Un icona verrà visualizzata ad indicare il link al feed RSS del sito web presentato.',
	'DIR_ADD_GUEST'							=> 'Impostazioni Ospiti',
	'DIR_ALLOW_BBCODE'						=> 'Permetti BBCode nei commenti',
	'DIR_ALLOW_COMMENTS'					=> 'Consenti commenti',
	'DIR_ALLOW_LINKS'						=> 'Consenti link nei commenti',
	'DIR_ALLOW_SMILIES'						=> 'Consenti gli smiley nei commenti',
	'DIR_ALLOW_VOTES'						=> 'Consenti voti',
	'DIR_ANNOUNCEMENT_TOPIC'				=> 'Annuncio Topic',
	'DIR_BANNERS_DIR_SIZE'					=> 'Dimensione dei banner nella directory',
	'DIR_BANN_PARAM'						=> 'Impostazioni Banner',
	'DIR_CAT_ADMIN'							=> 'Impostazioni delle categorie nella directory',
	'DIR_CAT_ADMIN_EXPLAIN'					=> 'Qui è possibile aggiungere, modificare o eliminare le categorie singolarmente. Se le statistiche dei collegamenti (commenti, numero di voti) o una delle categorie sembra non corretta, sarà possibile ri-sincronizzare una categoria.',
	'DIR_CAT_CREATED'						=> 'La categoria è stata creata',
	'DIR_CAT_DATA_NEGATIVE'					=> 'Le impostazioni automatiche di controllo e il numero di verifiche prima della rimozione, non possono contenere valori negativi o non esistenti.',
	'DIR_CAT_DELETE'						=> 'Elimina la categoria',
	'DIR_CAT_DELETED'						=> 'La categoria è stata eliminata',
	'DIR_CAT_DELETE_EXPLAIN'				=> 'Il modulo consente di eliminare una categoria, e di decidere dove si desidera spostare tutti i siti web (o categorie) ad esso associati.',
	'DIR_CAT_DESC'							=> 'Descrizione',
	'DIR_CAT_DESC_EXPLAIN'					=> 'La descrizione della categoria è Opzionale. Se si scrive una descrizione essa apparirà nella categoria sopra i siti web.<br />Il codice HTML scritto apparirà cosi comè.',
	'DIR_CAT_GENERAL_SETTINGS'				=> 'Impostazioni generali della categoria',
	'DIR_CAT_ICON'							=> 'Immagine Categoria',
	'DIR_CAT_NAME'							=> 'Nome Categoria',
	'DIR_CAT_NAME_EMPTY'					=> 'E necessario inserire il nome della categoria',
	'DIR_CAT_PARENT'						=> 'Categoria Madre',
	'DIR_CAT_RESYNCED'						=> 'La categoria è stata risincronizzata',
	'DIR_CAT_SETTINGS'						=> 'Impostazioni Categoria',
	'DIR_CAT_TOO_LONG'						=> 'La descrizione della categoria risulta essere troppo lunga. La descrizione non può contenere più di 4000 caratteri.',
	'DIR_CAT_UPDATED'						=> 'Le informazioni della categoria sono state aggiornate.',
	'DIR_COMM_PARAM'						=> 'Impostazioni Commenti',
	'DIR_COMM_PER_PAGE'						=> 'Numero di commenti per pagina',
	'DIR_CONFIG_SETTINGS'					=> 'Aggiornamento configurazione della directory',
	'DIR_COUNT_ALL'							=> 'Conta le sottocategorie dei siti web',
	'DIR_COUNT_ALL_EXPLAIN'					=> 'Se si attiva questa opzione, il contatore visualizzerà accanto a ciascuna categoria il numero delle sotto-categorie dei siti web.',
	'DIR_CREATE_CAT'						=> 'Crea una nuova categoria',
	'DIR_CRON_ENABLE'						=> 'Abilita la verifica periodica dei link',
	'DIR_CRON_ENABLE_EXPLAIN'				=> 'Se abilitata, questa opzione controllerà periodicamente la validità dei link.',
	'DIR_CRON_EVERY'						=> 'Controlla ogni',
	'DIR_CRON_SETTINGS'						=> 'Impostazioni Back Links',
	'DIR_DEFAULT_ORDER'						=> 'Ordine predefinito della Classifica',
	'DIR_DELETE_ALL_LINKS'					=> 'Elimina tutti i siti web',
	'DIR_DELETE_ORPHANS'					=> 'Elimina i Banner orfani',
	'DIR_DELETE_ORPHANS_CONFIRM'			=> 'Sei sicuro di voler eliminare i banner orfani?',
	'DIR_DELETE_ORPHANS_EXPLAIN'			=> 'I banner orfani sono dei banner che sono stati copiati sul server, ma, per un motivo sconosciuto non sono più associati a un sito web',
	'DIR_DELETE_SUBCATS'					=> 'Elimina i siti web e le categorie',
	'DIR_DOWNLOAD_LATEST'					=> 'Scarica l’ultima versione',
	'DIR_EDIT_CAT'							=> 'Modifica Categoria',
	'DIR_EDIT_EXPLAIN'						=> 'Il seguente modulo permette di personalizzare questa Categoria.',
	'DIR_ERROR_AUTH_COMM'					=> 'Non sei autorizzato ad inserire un commento',
	'DIR_ERROR_CAT'							=> 'Non è possibile recuperare i dati della categoria',
	'DIR_ERROR_COMM_LOGGED'					=> 'Devi essere registrato per postare un commento',
	'DIR_ERROR_KEYWORD'						=> 'E’ necessario inserire una parola chiave per effettuare una ricerca',
	'DIR_ERROR_NOT_AUTH'					=> 'Non ti è permesso di fare questa operazione',
	'DIR_ERROR_NO_LINK'						=> 'Il sito web che stai cercando non esiste',
	'DIR_ERROR_NO_LINKS'					=> 'Questo sito web non esiste',
	'DIR_ERROR_SUBMIT_TYPE'					=> 'Tipo di dati errati nella funzione dir_submit_type',
	'DIR_ERROR_URL'							=> 'E’ necessario inserire un URL valido',
	'DIR_ERROR_VOTE'						=> 'Hai già votato questo sito web',
	'DIR_ERROR_VOTE_LOGGED'					=> 'Devi essere loggato per votare',
	'DIR_INDEX'								=> 'Indice della Directory',
	'DIR_LENGTH_COMMENTS'					=> 'Numero massimo di caratteri per un commento al link',
	'DIR_LINKS'								=> 'Link',
	'DIR_LINK_ACTIVATE'						=> 'Convalida',
	'DIR_LINK_DELETE'						=> 'Elimina',
	'DIR_LIST_INDEX'						=> 'Visualizza la categoria nella leggenda della categoria Madre',
	'DIR_MAIL_NOTIFICATION'					=> 'Un nuovo sito web nella directory',
	'DIR_MAIL_VALIDATION'					=> 'Ricevi una e-mail per un sito web in attesa di approvazione',
	'DIR_MAX_ADD_ATTEMPTS'					=> 'Numero massimo di tentativi di accesso al sito web',
	'DIR_MAX_ADD_ATTEMPTS_EXPLAIN'			=> 'Numero di tentativi per l’inserimento del codice di conferma prima della scadenza della sessione.',
	'DIR_MAX_BANN'							=> 'Dimensione massima del banner',
	'DIR_MAX_BANN_EXPLAIN'					=> 'Dimensione massima del banner. Imposta i due valori su 0px per disattivare l’opzione di controllo.',
	'DIR_MAX_DESC'							=> 'Numero massimo di caratteri per la descrizione del sito web',
	'DIR_MAX_SIZE'							=> 'Dimensione massima del banner',
	'DIR_MAX_SIZE_EXPLAIN'					=> 'Per i banner inviati',
	'DIR_MOVE_LINKS_TO'						=> 'Sposta tutti i siti web di',
	'DIR_MOVE_SUBCATS_TO'					=> 'Sposta le sotto-categorie',
	'DIR_MUST_BACK'							=> 'Richiedi un link di ritorno',
	'DIR_MUST_BACK_EXPLAIN'					=> 'Se abilitata, questa opzione richiede un link di ritorno durante la presentazione del sito web.',
	'DIR_MUST_DESCRIBE'						=> 'Abilita la richiesta di una descrizione durante la presentazione di un sito web',
	'DIR_NB_CHECK'							=> 'Numero di controlli prima della rimozione',
	'DIR_NB_CHECK_EXPLAIN'					=> 'Inserisci il numero di controlli, dopo il quale un sito web verrà rimosso perchè il suo link di ritorno non è più valido; Una e-mail verrà inviata all’utente ad ogni fallimento della verifica per avvisarlo. Digita 0 se desideri rimuovere il sito web dopo il primo controllo fallito.',
	'DIR_NEW_TIME'							=> 'Numero di giorni per i nuovi siti web',
	'DIR_NEW_TIME_EXPLAIN'					=> 'Numero di giorni da considerare un sito web come nuovo. In tal caso, verrà visualizzata l’icona "nuovo". Inserisci 0 per disabilitare questa opzione.',
	'DIR_NEXT_CRON_ACTION'					=> 'Data della prossima verifica',
	'DIR_NO_CAT'							=> 'Nessuna categoria selezionata',
	'DIR_NO_DESTINATION_CAT'				=> 'Destinazione della categoria non specificata',
	'DIR_NO_LINK'							=> 'Non vi è alcun sito in attesa di approvazione',
	'DIR_NO_PARENT'							=> 'Nessun genitore (parent)',
	'DIR_NUMBER_CATS'						=> 'Numero di categorie',
	'DIR_NUMBER_CLICKS'						=> 'Numero di click',
	'DIR_NUMBER_COMMENTS'					=> 'Numero di commenti',
	'DIR_NUMBER_LINKS'						=> 'Numero dei collegamenti attivi',
	'DIR_NUMBER_ORPHANS'					=> 'Numero di banner orfani',
	'DIR_NUMBER_VOTES'						=> 'Numero di voti',
	'DIR_ORDER_A_A'							=> '[Ascendente] Autore',
	'DIR_ORDER_A_D'							=> '[Discendente] Autore',
	'DIR_ORDER_R_A'							=> '[Ascendente] Commenti',
	'DIR_ORDER_R_D'							=> '[Discendente] Commenti',
	'DIR_ORDER_S_A'							=> '[Ascendente] Nome',
	'DIR_ORDER_S_D'							=> '[Discendente] Nome',
	'DIR_ORDER_T_A'							=> '[Ascendente] Data',
	'DIR_ORDER_T_D'							=> '[Discendente] Data',
	'DIR_ORDER_V_A'							=> '[Ascendente] Clik',
	'DIR_ORDER_V_D'							=> '[Discendente] Clik',
	'DIR_PARAM'								=> 'Impostazioni Generali',
	'DIR_RECENT_COLUMNS'					=> 'Numero di colonne nel blocco',
	'DIR_RECENT_ENABLE'						=> 'Attiva "ultimi link aggiunti" nel blocco',
	'DIR_RECENT_ENABLE_EXPLAIN'				=> 'Questa opzione visualizza un blocco che mostra gli ultimi siti web aggiunti alla directory, in fondo alla pagina principale della directory. <br />Il numero di siti web visualizzati può essere impostato nelle seguenti impostazioni.',
	'DIR_RECENT_EXCLUDE'					=> 'ID delle categorie da escludere',
	'DIR_RECENT_EXCLUDE_EXPLAIN'			=> 'Inserire qui gli ID delle cateogorie da escludere separati da virgola.<br />Esempio: 1,4,12',
	'DIR_RECENT_GUEST'						=> 'Impostazioni del blocco degli "Ultimi link aggiunti"',
	'DIR_RECENT_ROWS'						=> 'Numero di righe nel blocco',
	'DIR_RELEASE_ANNOUNCEMENT'				=> 'Annuncio',
	'DIR_RESET_CLICKS'						=> 'Azzera Contatore Click',
	'DIR_RESET_CLICKS_CONFIRM'				=> 'Sei sicuro di voler azzerare il contatore dei click?',
	'DIR_RESET_COMMENTS'					=> 'Azzera Commenti',
	'DIR_RESET_COMMENTS_CONFIRM'			=> 'Sei sicuro di voler azzerare i commenti?',
	'DIR_RESET_COMMENTS_EXPLAIN'			=> 'Elimina tutti i commenti dei link nella directory',
	'DIR_RESET_VOTES'						=> 'Azzera Voti',
	'DIR_RESET_VOTES_CONFIRM'				=> 'Sei sicuro di voler azzerare i voti?',
	'DIR_RESET_VOTES_EXPLAIN'				=> 'Elimina tutti i voti dei link nella directory',
	'DIR_REWRITE_PARAM'						=> 'Impostazioni URL Rewriting',
	'DIR_SELECT_CAT'						=> 'Seleziona una Categoria',
	'DIR_SHOW'								=> 'Numero di siti web per pagina',
	'DIR_STATS'								=> 'Statistiche Directory',
	'DIR_STORAGE_BANNER'					=> 'Copia i banner sul server',
	'DIR_STORAGE_BANNER_EXPLAIN'			=> 'Se si attiva questa opzione, i banner collegati ai siti web verranno copiati su questo server.<br />L’attivazione di questa opzione renderà più veloce il caricamento della pagina.',
	'DIR_SUBCAT'							=> 'Sotto-categoria',
	'DIR_THUMB_PARAM'						=> 'Impostazioni Miniature',
	'DIR_THUMB_SERVICE'						=> 'Servizio miniatura',
	'DIR_THUMB_SERVICE_EXPLAIN'				=> 'Da utilizzare quando la miniatura AscreeN non esiste. A meno che abilitando l’opzione di seguito, la modifica di questa impostazione avrà effetto solo sui futuri siti web presentati',
	'DIR_THUMB_SERVICE_REVERSE'				=> 'Abilita la modifica retroattiva del servizio',
	'DIR_THUMB_SERVICE_REVERSE_EXPLAIN'		=> 'Cliccando su <i>si</i>, tutti i link esistenti prima della modifica del servizio utilizzeranno il nuovo servizio selezionato. Si richiede una query per ciascun sito web durante la prima visualizzazione dopo il cambio del servizio al fine di aggiornare la tabella.',
	'DIR_USER_PROP'							=> 'Inserito da %s in <i>%s</i> %s',
	'DIR_VALIDATE'							=> 'Abilita la convalida tramite l’amministratore',
	'DIR_VALIDATE_EXPLAIN'					=> 'Cliccando su <i>si</i>, i link presentati dovranno prima essere convalidati prima di apparire nella directory. In caso contrario se si clicca su <i>no</i> i link saranno visibili immediatamente.',
	'DIR_VALIDATION'						=> 'Validazione dei siti web',
	'DIR_VALIDATION_EXPLAIN'				=> 'Questa opzione funzionerà solo se nel pannello impostazioni si è scelto di approvare un sito web prima della pubblicazione nella directory. Se abilitata, una e-mail verrà inviata all’autore che ha presentato il sito web.',
	'DIR_VERSION_NOT_UP_TO_DATE_ACP'		=> 'La tua versione di phpBB Directory non è aggiornata.<br />Utilizza il seguente Link per andare all’annuncio della versione più recente e seguire le istruzioni per l’aggiornamento.',
	'DIR_VERSION_UP_TO_DATE_ACP'			=> 'La tua versione di phpBB Directory è aggiornata, nessun nuovo aggiornamento disponibile. Non hai bisogno di aggiornare questa installazione.',
	'DIR_VISUAL_CONFIRM'					=> 'Attiva la conferma visiva per gli ospiti',
	'DIR_VISUAL_CONFIRM_EXPLAIN'			=> 'Cliccando su <i>si</i>, gli ospiti dovranno inserire un codice di conferma. Questo per impedire loro le presentazioni di massa.',
	'DIR_WAITING_LINKS'						=> 'Numero di link in attesa di Approvazione',

	'EMAIL_SUBJECT_ACTIVATE'				=> 'Il tuo sito web è stato approvato',
	'EMAIL_SUBJECT_DELETE'					=> 'Il tuo sito web è stato rifiutato',
	'EMAIL_TEXT_ACTIVATE'					=> 'Siamo lieti di informarti che il sito web da te proposto è stato approvato ed ora fa parte della directory. Riferimento al sito: %s',
	'EMAIL_TEXT_DELETE'						=> 'Siamo spiacenti di informarti che il sito da te proposto non è stato accettato. Riferimento al sito: %s',

	'IMG_BUTTON_LINK_NEW'					=> 'Aggiungi un sito web nella directory',
	'IMG_ICON_LINK_NEW'						=> 'Nuovo Link',

	'LOG_DIR_AUTO_PRUNE'					=> '<strong>Auto prune di una categoria della directory</strong><br />» %s',
	'LOG_DIR_CAT_ADD'						=> '<strong>Creazione di una nuova categoria nella directory</strong><br />» %s',
	'LOG_DIR_CAT_DEL_CAT'					=> '<strong>Rimozione di una categoria</strong><br />» %s',
	'LOG_DIR_CAT_DEL_CATS'					=> '<strong>Rimozione di una categoria e le sue sotto-categorie</strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS'					=> '<strong>Rimozione di una categoria e dei suoi messaggi.</strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS_CATS'			=> '<strong>Rimozione di una categoria, dei suoi messaggi e delle sue sotto-categorie</strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS_MOVE_CATS'		=> '<strong>Rimozione di una categoria e dei suoi messaggi, sotto-categorie spostate</strong> in %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_CATS'				=> '<strong>Rimozione di una categoria e sotto-categorie spostate</strong> in %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS'			=> '<strong>Rimozione di una categoria e messaggi spostate</strong> in %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS_CATS'		=> '<strong>Rimozione di una categoria e le sue sotto-categorie, ed i messaggi spostati</strong> vers %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS_MOVE_CATS'	=> '<strong>Rimozione di una categoria, messaggi spostati </strong> in %1$s <strong>e sotto-categorie spostati</strong> in<br />» %3$s',
	'LOG_DIR_CAT_EDIT'						=> '<strong>Modificata una categoria della directory</strong><br />» %s',
	'LOG_DIR_CAT_MOVE_DOWN'					=> '<strong>Spostata una categoria della directory</strong> %1$s <strong>sotto</strong> %2$s',
	'LOG_DIR_CAT_MOVE_UP'					=> '<strong>Spostata una categoria della directory</strong> %1$s <strong>sopra</strong> %2$s',
	'LOG_DIR_CAT_SYNC'						=> '<strong>Risincronizzazione di una categoria della directory</strong><br />» %s',
	'LOG_LINK_ACTIVE'						=> 'Attivazione di siti web in attesa di approvazione:<br />» %s',
	'LOG_LINK_DELETE'						=> 'Rimozione di siti web in attesa di approvazione:<br />» %s',

	'SYNC_IN_PROGRESS'						=> 'Sincronizzazione della Categoria',
	'SYNC_IN_PROGRESS_EXPLAIN'				=> 'Risincronizzazione dei link %1$d/%2$d in corso.',

	'TOO_LONG_DESCRIPTION'					=> 'La tua descrizione è troppo lunga',
	'TOO_SHORT_DESCRIPTION'					=> 'E’ necessario inserire una descrizione',
	'TOO_SHORT_REPLY'						=> 'Il tuo commento è troppo corto',
	'TOO_SHORT_SITE_NAME'					=> 'E’ necessario inserire un nome per il sito web',
	'TOO_SHORT_URL'							=> 'E’ necessario inserire un URL',
	'TOO_SMALL_CAT'							=> 'E’ necessario selezionare una categoria',
));

?>
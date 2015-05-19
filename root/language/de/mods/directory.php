<?php
/**
*
* directory [German]
*
* @author Übersetzung Magnus (BDSM-Baden.de)
* @package language
* @copyright (c) 2012 http://www.BDSM-Baden.de
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
	'DIR_SEARCH_NO_RESULT'					=> 'Keine Ergebnisse gefunden',
	'DIR_BANNER_DISALLOWED_CONTENT'			=> 'Die Sendung wurde abgelehnt, weil die Datei als einen möglichen Angriff gewertet wurde.',
	'DIR_BANNER_DISALLOWED_EXTENSION'		=> 'Datei kann nicht angehängt werden, weil die Datei-Endung <strong>%s</strong> nicht erlaubt ist.',
	'DIR_BANNER_EMPTY_FILEUPLOAD'			=> 'Übertragene Banner ist leer.',
	'DIR_BANNER_EMPTY_REMOTE_DATA'			=> 'Banner konnte nicht übertragen werden, angegebene Datei scheint unbekannt oder beschädigt zu sein.',
	'DIR_BANNER_IMAGE_FILETYPE_MISMATCH'	=> 'Falscher Banner Typ: Länge %1$s wurde erwartet, aber Länge %2$s wurde gefunden.',
	'DIR_BANNER_INVALID_FILENAME'			=> '%s ungültiger Dateiname.',
	'DIR_BANNER_NOT_UPLOADED'				=> 'Banner konnte nicht übertragen werden.',
	'DIR_BANNER_NO_SIZE'					=> 'Breite oder Höhe des Avatars konnte nicht ermittelt werden, trage ihn bitte manuell ein.',
	'DIR_BANNER_PARTIAL_UPLOAD'				=> 'Datei konnte nur teilweise übertragen werden.',
	'DIR_BANNER_PHP_SIZE_NA'				=> 'Banner ist zu gross.<br />Maximale Grösse in der php.ini konnte nicht ermittelt werden.',
	'DIR_BANNER_PHP_SIZE_OVERRUN'			=> 'Banner ist zu gross. Maximal erlaubte Transfergrösse ist %d Mo.<br />Beachte, das die Grösse in der php.ini festgelegt ist und nicht überschritten werden kann.',
	'DIR_BANNER_UNABLE_GET_IMAGE_SIZE'		=> 'Unmöglich, die Maße des Banners zu ermitteln.',
	'DIR_BANNER_URL_INVALID'				=> 'Invalide Banner URL.',
	'DIR_BANNER_URL_NOT_FOUND'				=> 'Angegebene Datei ist unauffindbar.',
	'DIR_BANNER_WRONG_FILESIZE'				=> 'Bannergrösse muss zwischen 0 und %1d %2s liegen.',
	'DIR_BANNER_WRONG_SIZE'					=> 'Das Banner hat eine Breite von %3$d Pixel und eine Höhe von %4$d Pixel. Banner müssen mindestens %1$d Pixel breit und %2$d Pixel hoch sein.',
	'DIR_BE_NOTIFIED'						=> 'E-Mail erhalten bei Neueinträge in dieser Kategorie',
	'DIR_BE_NOT_NOTIFIED'					=> 'Keine E-Mails mehr erhalten bei Neueinträge in dieser Kategorie',
	'DIR_CAT'								=> 'Kategorie',
	'DIR_CAT_NAME'							=> 'Name der Kategorie',
	'DIR_CAT_TITLE'							=> 'Link-Kategorien',
	'DIR_CLICK_RETURN_DIR'					=> 'Klicke %shier%s, um zum Linkverzeichnis zurückzukehren',
	'DIR_CLICK_RETURN_CAT'					=> 'Klicke %shier%s, um zur Kategorie zurückzukehren',
	'DIR_CLICK_RETURN_LIEN'					=> 'Klicke %shier%s, um zur Seite zurückzukehren',
	'DIR_COMMENT'							=> 'Kommentar',
	'DIR_COMMENTS'							=> 'Kommentare',
	'DIR_COMMENTS_ORDER'					=> 'Kommentare',
	'DIR_COMMENT_TITLE'						=> 'Kommentar anschauen/posten',
	'DIR_COMMENT_DELETE'					=> 'Kommentar löschen',
	'DIR_COMMENT_DELETE_CONFIRM'			=> 'Möchtest Du den Kommentar wirklich löschen ?',
	'DIR_COMMENT_EDIT'						=> 'Editieren kommentare',
	'DIR_DELETE_BANNER'						=> 'Banner entfernen',
	'DIR_DELETE_SITE'						=> 'Webseite löschen',
	'DIR_DELETE_SITE_CONFIRM'				=> 'Bist du sicher, das Du diese Webseite löschen möchtest?',
	'DIR_DELETE_OK'							=> 'Die Webseite wurde gelöscht',
	'DIR_DESCRIPTION'						=> 'Beschreibung',
	'DIR_DESCRIPTION_EXP'					=> 'Eine kurze Beschreibung Deiner Webseite, sie darf nicht mehr als %d Zeichen enthalten.',
	'DIR_DISPLAY_LINKS'						=> 'Vorhergehende Links anheften',
	'DIR_EDIT'								=> 'Editieren',
	'DIR_EDIT_SITE'							=> 'Seite editieren',
	'DIR_EDIT_SITE_ACTIVE'					=> 'Die Webseite wurde geändert und muss noch freigeschaltet werden',
	'DIR_EDIT_SITE_OK'						=> 'Die Webseite wurde geändert',
	'DIR_ERROR_AUTH_COMM'					=> 'Du bist nicht berechtigt, einen Kommentar abzugeben',
	'DIR_ERROR_CAT'							=> 'Kann die aktuellen Daten dieser Kategorie nicht abrufen',
	'DIR_ERROR_CHECK_URL'					=> 'Diese URL ist nicht erreichbar',
	'DIR_ERROR_COMM_LOGGED'					=> 'Du musst eingeloggt sein, um einen Kommentar abzugeben',
	'DIR_ERROR_KEYWORD'						=> 'Du musst Keywords eingeben, um eine Suche zu starten.',
	'DIR_ERROR_NOT_AUTH'					=> 'Du hast nicht die erforderliche Berechtigung für diese Aktion',
	'DIR_ERROR_NOT_FOUND_BACK'				=> 'Die angeforderte Seite für diesen Backlink ist unauffindbar.',
	'DIR_ERROR_NO_CATS'						=> 'Diese Kategorie existiert nicht',
	'DIR_ERROR_NO_LINK'						=> 'Die gesuchte Seite existiert nicht',
	'DIR_ERROR_NO_LINKS'					=> 'Diese Webseite existiert nicht',
	'DIR_ERROR_NO_LINK_BACK'				=> 'Der Backlink wurde auf der von Dir angegebenen Seite nicht gefunden.',
	'DIR_ERROR_SUBMIT_TYPE'					=> 'Falsche Eingabe der Datentyp in der Funktion dir_submit_type',
	'DIR_ERROR_URL'							=> 'Du musst eine gültige URl eingeben.',
	'DIR_ERROR_VOTE'						=> 'Du hast bereits schon abgestimmt',
	'DIR_ERROR_VOTE_LOGGED'					=> 'Um abzustimmen musst Du eingeloggt sein',
	'DIR_ERROR_WRONG_DATA_BACK'				=> 'Der Backlink muß eine gültige URl sein, inclusive Protokoll. Zum Beispiel http://www.example.com/.',
	'DIR_FIELDS'							=> 'Mit Stern * gekennzeichnete Felder müssen ausgefüllt werden',
	'DIR_FLAG'								=> 'Flagge',
	'DIR_FLAG_EXP'							=> 'Wähle eine Flagge, aus denen der Standort des Servers hervor geht.',
	'DIR_FROM_TEN'							=> '%s/10',
	'DIR_GUEST_EMAIL'						=> 'Deine E-Mail-Adresse',
	'DIR_KEYWORD'							=> 'Schlüsselwörter für die Suche',
	'DIR_KEYWORD_EXP'						=> 'Trenne die einzelnen Wörter durch ein Leerzeichen.',
	'DIR_MAKE_SEARCH'						=> 'Einen Link suchen',
	'DIR_NAME_ORDER'						=> 'Name',
	'DIR_NEW_SITE'							=> 'Webseite in das Linkverzeichnis eintragen',
	'DIR_NEW_SITE_ACTIVE'					=> 'Die Webseite wurde hinzugefügt und muss noch freigeschaltet werden',
	'DIR_NEW_SITE_OK'						=> 'Deine Webseite wurde dem Linkverzeichnis hinzugefügt',
	'DIR_NB_CLIC'							=> '%d Klick',
	'DIR_NB_CLICS'							=> '%d Klicks',
	'DIR_NB_CLICS_ORDER'					=> 'Klicks',
	'DIR_NB_LINK'							=> '%d Link',
	'DIR_NB_LINKS'							=> '%d Links',
	'DIR_NB_VOTE'							=> '%d Stimmen',
	'DIR_NB_VOTES'							=> '%d Stimmen',
	'DIR_NONE'								=> 'Keine',
	'DIR_NOTE'								=> 'Bemerkung',
	'DIR_NO_COMMENT'						=> 'Kein Kommentar für diese Seite',
	'DIR_NO_DRAW_CAT'						=> 'Keine Kategorie vorhanden',
	'DIR_NO_DRAW_LINK'						=> 'In dieser Kategorie gibt es keine Einträge',
	'DIR_NO_NOTE'							=> 'Keine',
	'DIR_PAGERANK'							=> 'Pr',
	'DIR_PAGERANK_NOT_AVAILABLE'			=> 'n/a',
	'DIR_PR_ORDER'							=> 'PageRank',
	'DIR_REPLY_EXP'							=> 'Dein Kommentar darf nicht mehr als %d Zeichen enthalten.',
	'DIR_REPLY_TITLE'						=> 'Einen Kommentar abgeben',
	'DIR_RSS'								=> 'RSS von',
	'DIR_SEARCH_AND'						=> 'Nach allen Begriffen suchen',
	'DIR_SEARCH_CATLIST'					=> 'Suche in einer bestimmten Kategorie',
	'DIR_SEARCH_DESC_ONLY'					=> 'Ausschlieslich Beschreiburg',
	'DIR_SEARCH_METHOD'						=> 'Suchmethode',
	'DIR_SEARCH_NB_CLIC'					=> 'Klick',
	'DIR_SEARCH_NB_CLICS'					=> 'Klicks',
	'DIR_SEARCH_NB_COMM'					=> '%d Kommentar',
	'DIR_SEARCH_NB_COMMS'					=> '%d Kommentare',
	'DIR_SEARCH_OR'							=> 'Nach einem Begriff suchen',
	'DIR_SEARCH_RESULT'						=> 'Suchergebnis (se)',
	'DIR_SEARCH_TITLE_DESC'					=> 'Name und Beschreibung',
	'DIR_SEARCH_TITLE_ONLY'					=> 'Ausschliesslich Name',
	'DIR_SEARCH_WITHIN'						=> 'Suchen in',
	'DIR_SITE_BACK'							=> 'URL Deiner Seite, auf der sich der Backlink befindet',
	'DIR_SITE_BACK_EXPLAIN'					=> 'In dieser Kategoriesés wird ein Backlink vorrausgesetzt, gebe bitte hier die Url der Seite an, auf der sich der betreffende Link befindet.',
	'DIR_SITE_BANN'							=> 'Banner-Link ',
	'DIR_SITE_BANN_EXP'						=> 'Vollständige URL des Banner eingeben. Dies ist kein Pflichtfeld. Die maximal zulässige Größe ist <b>%d x %d</b> Pixel. Das Banner wird automatisch skaliert, wenn diese Größe überschritten wird.',

	'DIR_SITE_NAME'							=> 'Name der Webseite',
	'DIR_SITE_RSS'							=> 'RSS Feeds',
	'DIR_SITE_RSS_EXPLAIN'					=> 'Du hast die Möglichkeit, die URL eines RSS Feed anzugeben. Ein RSS-Icon erscheint neben Deiner Seite, das so die Möglichkeit anzeigt, das ein RSS-Feed abonniert werden kann.',
	'DIR_SITE_URL'							=> 'URL',
	'DIR_SOMMAIRE'							=> 'Inhalt des Verzeichnisses',
	'DIR_SUBMIT_TYPE_1'						=> 'Deine Webseite muss noch durch einen Administrator freigeschaltet werden.',
	'DIR_SUBMIT_TYPE_2'						=> 'Deine Webseite erscheint sofort im Linkverzeichnis.',
	'DIR_SUBMIT_TYPE_3'						=> 'Deine Seite wird automatisch hinzugefügt, wenn du ein Adminstrator bist.',
	'DIR_SUBMIT_TYPE_4'						=> 'Deine Seite wird automatisch hinzugefügt, wenn du ein Moderator bist.',
	'DIR_THUMB'								=> 'Miniatur der Seite',
	'DIR_USER_PROP'							=> 'Webseite vorgeschlagen von',
	'DIR_VOTE'								=> 'Abstimmen',
	'DIR_VOTE_OK'							=> 'Deine Stimme wurde gezählt',
	'DIR_POST'								=> 'Poster',

	'DIRECTORY_TRANSLATION_INFO'			=> 'Deutsche Übersetzung durch Walter <a href="http://www.digitalfotografie-foren.de">digitalfotografie-foren.de</a>',

	'L_DIR_SEARCH_NB_COMM'					=> 'Kommentar',
	'L_DIR_SEARCH_NB_COMMS'					=> 'Kommentare',

	'RECENT_LINKS'							=> 'Letzte hinzugefügte Seiten',

	// Don't translate this line!
	'SEED'									=> 'Mining PageRank is AGAINST GOOGLE’S TERMS OF SERVICE. Yes, I’m talking to you, scammer.',

	'TOO_LONG_BACK'							=> 'Die URL der Backlink-Seite ist zu lang (Maximum sind 255 Zeichen )',
	'TOO_LONG_DESCRIPTION'					=> 'Deine Beschreibung ist zu lang',
	'TOO_LONG_REPLY'						=> 'Dein Kommentar ist zu lang',
	'TOO_LONG_RSS'							=> 'Die URL des RSS Feeds ist zu lang',
	'TOO_LONG_SITE_NAME'					=> 'Du hast einen zu langen Namen für die Webseite eingegeben ( Maximum sind 100 Zeichen)',
	'TOO_LONG_URL'							=> 'Du hast für diese Seite eine zu lange URL angegeben(Maximum sind 255 Zeichen).',
	'TOO_MANY_ADDS'							=> 'Du hast die maximale Anzahl an Eingaben überschritten, versuche es später noch einmal.',
	'TOO_SHORT_BACK'						=> 'Du musst die URL des Backlink angeben',
	'TOO_SHORT_DESCRIPTION'					=> 'Du musst eine Beschreibung eingeben',
	'TOO_SHORT_REPLY'						=> 'Dein Kommentar ist zu kurz',
	'TOO_SHORT_RSS'							=> 'Die URL des RSS Feeds ist zu kurz',
	'TOO_SHORT_SITE_NAME'					=> 'Du musst einen Seitennamen eingeben',
	'TOO_SHORT_URL'							=> 'Du musst eine URL eingeben',
	'TOO_SMALL_CAT'							=> 'Du musst eine Kategorie angeben',

	'WRONG_DATA_RSS'						=> 'Der RSS Feed muß eine gültige URL sein, inclusive Protokoll. Zum Beispiel http://www.example.com/.',
));

?>
<?php
/**
*
* info_acp_directory [German]
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
	'ACP_DIRECTORY'							=> 'phpBB Linkverzeichnis',
	'ACP_DIRECTORY_CATS'					=> 'Kategorien verwalten',
	'ACP_DIRECTORY_INDEX_TITLE'				=> 'phpBB Linkverzeichnis',
	'ACP_DIRECTORY_MAIN'					=> 'Informationen und Werkzeuge',
	'ACP_DIRECTORY_SETTINGS'				=> 'Konfiguration',
	'ACP_DIRECTORY_SETTINGS_EXPLAIN'		=> 'Linkverzeichnis konfigurieren',
	'ACP_DIRECTORY_VAL'						=> 'Links freischalten',
	'DIR_ACTIVE_CHECK'						=> 'Webseitentest',
	'DIR_ACTIVE_CHECK_EXPLAIN'				=> 'Beim aktivieren von <strong><em>Ja</em></strong> wird die Webseite auf Erreichbarkeit überprüft. Falls der Server nicht in weniger als eine Sekunde antwortet, wird sie als unerreichbar angesehen.',
	'DIR_ACTIVE_THUMB'						=> 'Aktivierung der Bildvorschau der Webseite',
	'DIR_ACTIVE_THUMB_REMOTE'				=> 'Aktivieren der Kompatibilität von AscreeN',
	'DIR_ACTIVE_THUMB_REMOTE_EXPLAIN'		=> 'Beim aktivieren von <strong><em>Ja</em></strong> prüft die Mod in erster Linie die Erreichbarkeit der Webseite zum Zeitpunkt der Eintragung und ob eine AscreeN-Miniatur auf dem Remote-Server existiert.<br />Eine AscreeN-Miniaturansicht gibt theoretisch das Aussehen der Webseite wieder.',
	'DIR_ACTIV_BANNER'						=> 'Banner <strong><em>hinzufügen</em></strong> erlauben',
	'DIR_ACTIV_FLAG'						=> 'Sprache der Seite/Staatsflagge aktivieren',
	'DIR_ACTIV_PAGERANK'					=> 'Pageranking  aktivieren',
	'DIR_ACTIV_PAGERANK_EXPLAIN'			=> 'Es wird der Pagerank der Webseite zum Zeitpunkt der Eingabe angezeigt.',
	'DIR_ACTIV_REWRITE'						=> 'Aktiviere Wiederbeschreibarkeit der URLs',
	'DIR_ACTIV_REWRITE_EXPLAIN'				=> 'Diese Option bewirkt, das die URL-Adressen der Verzeichnis-Kategorien sowie der Navbar gemäß den Einstellungen dieser Mod umgeschrieben werden können.<a href="http://www.phpbb-seo.com/fr/mod-rewrite-phpbb/ultimate-seo-url-t4489.html" target="_blank">Ultimate SEO URL</a>.<br />Dazu wird auch eine Anpassung der.htaccess nötig sein.',
	'DIR_ACTIV_RSS'							=> 'Activiere die Möglichkeit der Angabe eines RSS-Feeds',
	'DIR_ACTIV_RSS_EXPLAIN'					=> 'Wird diese Option aktiviert, ist es möglich, einen Link zum RSS-Feed während der Link-Eingabe hinzuzufügen.<br />Es wird ein entsprechendes Icon in der Kategorie angezeigt.',
	'DIR_ADD_GUEST'							=> 'Einstellungen für Gäste',
	'DIR_ALLOW_BBCODE'						=> 'Erlaube BBcodes in den Kommentaren',
	'DIR_ALLOW_COMMENTS'					=> 'Kommentare zulassen',
	'DIR_ALLOW_LINKS'						=> 'Erlaube Links in den Kommentaren',
	'DIR_ALLOW_SMILIES'						=> 'Erlaube Smileys in den Kommentaren',
	'DIR_ALLOW_VOTES'						=> 'Votes zulassen',
	'DIR_ANNOUNCEMENT_TOPIC'				=> 'Release-Ankündigung',
	'DIR_BANNERS_DIR_SIZE'					=> 'Größe des Banner-Verzeichnisses',
	'DIR_BANN_PARAM'						=> 'Banner Einstellung',
	'DIR_CAT_ADMIN'							=> 'Kategorien verwalten',
	'DIR_CAT_ADMIN_EXPLAIN'					=> 'Hier kannst Du Kategorien individuell hinzuzufügen, modifizieren und entfernen. Wenn die Link- Statistiken (Kommentare, Anzahl der Votings) oder die Links der Kategorien fehlerhaft dargestellt werden, kannst Du hier die Anzeige  synchronisieren.',
	'DIR_CAT_CREATED'						=> 'Die Kategorie wurde erzeugt.',
	'DIR_CAT_DATA_NEGATIVE'					=> 'Die Einstellungen der automatischen Überprüfung sowie die Anzahl der Löschkontrollen können negativ oder nichtig sein.',
	'DIR_CAT_DELETE'						=> 'Kategorie löschen',
	'DIR_CAT_DELETED'						=> 'Die Kategorie wurde gelöscht',
	'DIR_CAT_DELETE_EXPLAIN'				=> 'Folgende Beschreibung erlaubt Dir, eine Kategorie zu löschen und zu entscheiden, ob Du alle enthaltenen Links oder Kategorien verschieben möchtest.',
	'DIR_CAT_DESC'							=> 'Beschreibung',
	'DIR_CAT_DESC_EXPLAIN'					=> 'Eine Beschreibung ist nicht unbedingt erforderlich. Ist die Beschreibung ausgefüllt, erscheint sie oberhalb der Links in dieser Kategorie.<br />Alle HTML-Tags werden so dargestellt, wie sie sind.',
	'DIR_CAT_GENERAL_SETTINGS'				=> 'Allgemeine Kategorie-Einstellungen',
	'DIR_CAT_ICON'							=> 'Kategorie-Bild',
	'DIR_CAT_NAME'							=> 'Name der Kategorie',
	'DIR_CAT_NAME_EMPTY'					=> 'Du musst der Kategorie einen Namen geben.',
	'DIR_CAT_PARENT'						=> 'Übergeordnete Kategorie',
	'DIR_CAT_RESYNCED'						=> 'Die Kategorie “%s” ist resynchronisiert',
	'DIR_CAT_SETTINGS'						=> 'Kategorie Eigenschaften',
	'DIR_CAT_TOO_LONG'						=> 'Die Beschreibung der Kategorie ist zu lang. Sie darf nicht mehr als 4000 Zeichen enthalten.',
	'DIR_CAT_UPDATED'						=> 'Die Informationen der Kategorie sind auf den neuesten Stand.',
	'DIR_COMM_PARAM'						=> 'Kommentar-Einstellungen',
	'DIR_COMM_PER_PAGE'						=> 'Anzahl der Kommentare pro Seite',
	'DIR_CONFIG_SETTINGS'					=> 'Konfiguration des Linkverzeichnisses aktuallisiert',
	'DIR_COUNT_ALL'							=> 'Berücksichtige die Links in den Unter-Kategorien',
	'DIR_COUNT_ALL_EXPLAIN'					=> 'Wenn diese Option aktiviert ist, wird der Zähler neben jeder Kategorie die Anzahl der vorhandenen Links in den Unter-Kategorien anzeigen',
	'DIR_CREATE_CAT'						=> 'Erstelle eine neue Kategorie',
	'DIR_CRON_ENABLE'						=> 'Periodische Überprüfung des Backlinks',
	'DIR_CRON_ENABLE_EXPLAIN'				=> 'Wenn aktiviert, überprüft diese Option periodisch Backlinks zum Zeitpunkt ihres Eintrages in das Linkverzeichnis.',
	'DIR_CRON_EVERY'						=> 'Überprüfe alle',
	'DIR_CRON_SETTINGS'						=> 'Einstellung der Backlinks',
	'DIR_DEFAULT_ORDER'						=> 'Reihenfolge Standard-Ranking von Webseiten',
	'DIR_DELETE_ALL_LINKS'					=> 'Lösche alle Links',
	'DIR_DELETE_ORPHANS'					=> 'Entferne alle verwaisten Banner',
	'DIR_DELETE_ORPHANS_CONFIRM'			=> 'Willst Du wirklich alle verwaisten Banner entfernen?',
	'DIR_DELETE_ORPHANS_EXPLAIN'			=> 'Die verwaisten Banner wurden auf dem Server geladen und konnten keinem Link im Link-Verzeichnis mehr zugeordnet werden',
	'DIR_DELETE_SUBCATS'					=> 'Lösche Links und Unter-Kategorien',
	'DIR_DOWNLOAD_LATEST'					=> 'Neueste Version herunterladen',
	'DIR_EDIT_CAT'							=> 'Kategorien editieren',
	'DIR_EDIT_EXPLAIN'						=> 'Kategorie-Eigenschaften einstellen.',
	'DIR_ERROR_AUTH_COMM'					=> 'Du hast keine Berechtigung, Kommentare zu posten',
	'DIR_ERROR_CAT'							=> 'Konnte die Daten in der aktuellen Kategorie nicht sammeln ',
	'DIR_ERROR_COMM_LOGGED'					=> 'Du musst eingeloggt sein, um Kommentare abzugeben',
	'DIR_ERROR_KEYWORD'						=> 'Zum <strong><em>suchen</em></strong> musst Du Schlüsselwörter eingeben.',
	'DIR_ERROR_NOT_AUTH'					=> 'Du hast dazu keine Berechtigung',
	'DIR_ERROR_NO_LINK'						=> 'Der gesuchte Link existiert nicht',
	'DIR_ERROR_NO_LINKS'					=> 'Dieser Link existiert nicht',
	'DIR_ERROR_SUBMIT_TYPE'					=> 'Inkorrekter Datentyp in der Funktion dir_submit_type',
	'DIR_ERROR_URL'							=> 'Du musst eine gültige URL eingeben.',
	'DIR_ERROR_VOTE'						=> 'Du hast schon für diese Webseite gevotet',
	'DIR_ERROR_VOTE_LOGGED'					=> 'Zum Voten musst Du eingeloggt sein',
	'DIR_INDEX'								=> 'Inhalt des Linkverzeichnisses',
	'DIR_LENGTH_COMMENTS'					=> 'Maximale Anzahl der Zeichen in einem Link-Kommentar',
	'DIR_LINKS'								=> 'Links',
	'DIR_LINK_ACTIVATE'						=> 'Freischalten',
	'DIR_LINK_DELETE'						=> 'Löschen',
	'DIR_LIST_INDEX'						=> 'Anzeige der Kategorie in der Legende der Kategorie-Übersicht',
	'DIR_MAIL_NOTIFICATION'					=> 'Ein neuer Link im Linkverzeichnis',
	'DIR_MAIL_VALIDATION'					=> 'Bestätigungs-E-Mail nach Linkeingabe versenden',
	'DIR_MAX_ADD_ATTEMPTS'					=> ' Mögliche Anzahl Eintragsversuche zur Übermittlung eines Links',
	'DIR_MAX_ADD_ATTEMPTS_EXPLAIN'			=> 'Anzahl der Versuche, die Benutzer nach Eingabe des Capchas machen können, bevor die Sitzung abläuft.',
	'DIR_MAX_BANN'							=> 'Maximale Bannergröße',
	'DIR_MAX_BANN_EXPLAIN'					=> 'Maximale Größe der eingefügten Banner. Stelle beide Werte auf 0 Px, um die Größenangabe zu deaktivieren.',
	'DIR_MAX_DESC'							=> 'Maximale Anzahl der Zeichen für die Beschreibung der Links',
	'DIR_MAX_SIZE'							=> 'Maximale Größe eines Banners',
	'DIR_MAX_SIZE_EXPLAIN'					=> 'Für die geschickten Banner',
	'DIR_MOVE_LINKS_TO'						=> 'Verschiebe Links nach',
	'DIR_MOVE_SUBCATS_TO'					=> 'Verschiebe Unter-Kategorien',
	'DIR_MUST_BACK'							=> 'Fordere einen Backlink',
	'DIR_MUST_BACK_EXPLAIN'					=> 'Wenn aktiviert, fordert diese Option einen Backlink bei Eintragung eines Links.',
	'DIR_MUST_DESCRIBE'						=> 'Seitenbeschreibung bei Eintragung des Links als Pflichtfeld setzen',
	'DIR_NB_CHECK'							=> 'Anzahl der Überprüfungen vor Löschung',
	'DIR_NB_CHECK_EXPLAIN'					=> 'Gebe hier an, wie viele Überprüfungen nötig sind, bis ein Link gelöscht wird, dessen Backlink nicht mehr erreichbar ist. Eine E-Mail wird an den Eintragenden gesendet, um ihn an seinem Backlink zu errinern. Trage für die sofortige Löschung nach dem ersten fehlgeschlagenen Versuch  eine <strong><em>0</em></strong> ein.',
	'DIR_NEW_TIME'							=> 'Anzahl der Tage für einen neuen Link-Eintrag',
	'DIR_NEW_TIME_EXPLAIN'					=> 'Anzahl der Tage, welcher ein neuer Link als <strong><em>Neu</em></strong> angezeigt wird. Ist dies der Fall, wird ein kleines Icon <strong><em>new</em></strong> angeheftet. Trage eine <strong><em>0</em></strong> ein, um diese Funktion zu deaktivieren.',
	'DIR_NEXT_CRON_ACTION'					=> 'Zeitpunkt der nächsten geplanten Überprüfung',
	'DIR_NO_CAT'							=> 'Keine Kategorie ausgewählt',
	'DIR_NO_DESTINATION_CAT'				=> 'Es wurde keine Ziel-Kategorie ausgewählt',
	'DIR_NO_LINK'							=> 'Keine Links zum freischalten vorhanden.',
	'DIR_NO_PARENT'							=> 'Keine',
	'DIR_NUMBER_CATS'						=> 'Anzahl der Kategorien',
	'DIR_NUMBER_CLICKS'						=> 'Anzahl der Clicks',
	'DIR_NUMBER_COMMENTS'					=> 'Anzahl der Kommentare',
	'DIR_NUMBER_LINKS'						=> 'Anzahl der aktiven Links',
	'DIR_NUMBER_ORPHANS'					=> 'Anzahl der verwaisten Links',
	'DIR_NUMBER_VOTES'						=> 'Anzahl der Votes',
	'DIR_ORDER_A_A'							=> '[Aufsteigend] Poster',
	'DIR_ORDER_A_D'							=> '[Absteigend] Poster',
	'DIR_ORDER_R_A'							=> '[Aufsteigend] Kommentare',
	'DIR_ORDER_R_D'							=> '[Absteigend] Kommentare',
	'DIR_ORDER_S_A'							=> '[Aufsteigend] Name',
	'DIR_ORDER_S_D'							=> '[Absteigend] Name',
	'DIR_ORDER_T_A'							=> '[Aufsteigend] Datum',
	'DIR_ORDER_T_D'							=> '[Absteigend] Datum',
	'DIR_ORDER_V_A'							=> '[Aufsteigend] Klicks',
	'DIR_ORDER_V_D'							=> '[Absteigend] Klicks',
	'DIR_PARAM'								=> 'Allgemeine Einstellungen',
	'DIR_RECENT_COLUMNS'					=> 'Anzahl der Spalten im Block',
	'DIR_RECENT_ENABLE'						=> 'Aktiviere den Block der <strong><em>zuletzt hinzugefügten Links</em></strong>',
	'DIR_RECENT_ENABLE_EXPLAIN'				=> 'Wenn du diese Option aktivierst, wird ein Block mit den zuletzt hinzugefügten Links unten auf der Linkhauptseite angezeigt.<br />Die Anzahl ist von den oberen Einstellungen abhängig.',
	'DIR_RECENT_EXCLUDE'					=> 'ID der auszuschließenden Kategorien',
	'DIR_RECENT_EXCLUDE_EXPLAIN'			=> 'Trage hier die IDs der Kategorien ein, die nicht berücksichtigt werden sollen, bitte durch Komma trennen.<br />Beispiel: 1,4,12 usw.',
	'DIR_RECENT_GUEST'						=> 'Parameter-Block <strong><em>Neue Links hinzugefügt</em></strong>',
	'DIR_RECENT_ROWS'						=> 'Anzahl der Reihen im Block',
	'DIR_RELEASE_ANNOUNCEMENT'				=> 'Bekanntmachung',
	'DIR_RESET_CLICKS'						=> 'Zurücksetzen aller Klick-Zähler',
	'DIR_RESET_CLICKS_CONFIRM'				=> 'Willst Du wirklich alle Klick-Zähler zurücksetzen?',
	'DIR_RESET_COMMENTS'					=> 'Zurücksetzen aller Kommentare',
	'DIR_RESET_COMMENTS_CONFIRM'			=> 'Willst Du wirklich alle Kommentare zurücksetzen?',
	'DIR_RESET_COMMENTS_EXPLAIN'			=> 'Entfernt alle Kommentare aus dem Link-Verzeichnis',
	'DIR_RESET_VOTES'						=> 'Zurücksetzen der Votes',
	'DIR_RESET_VOTES_CONFIRM'				=> 'Willst Du wirklich alle Votes zurücksetzen?',
	'DIR_RESET_VOTES_EXPLAIN'				=> 'Entfernt alle Votes aus dem Link-Verzeichnis',
	'DIR_REWRITE_PARAM'						=> 'Einstellungen zum erneuten schreiben der URL',
	'DIR_SELECT_CAT'						=> 'Wähle eine Kategorie',
	'DIR_SHOW'								=> 'Anzahl der Links pro Seite',
	'DIR_STATS'								=> 'Statistiken des Link-Verzeichnisses',
	'DIR_STORAGE_BANNER'					=> 'Banner auf dem Server kopieren',
	'DIR_STORAGE_BANNER_EXPLAIN'			=> 'Mit dieser Option werden die Banner des Links auf dem Server kopiert.<br />Aktivieren dieser Option macht das Laden der Seiten schneller.',
	'DIR_SUBCAT'							=> 'Unter-Kategorie',
	'DIR_THUMB_PARAM'						=> 'Einstellung der Miniaturen',
	'DIR_THUMB_SERVICE'						=> 'Miniaturansicht-Service verwenden',
	'DIR_THUMB_SERVICE_EXPLAIN'				=> 'Verwendetet Miniaturansicht-Service, wenn der Miniaturdienst AscreeN nicht existiert. Es sei denn, Du aktivierst die Option unten, diese Einstellung wirkt sich nur die zukünftigen freigegebenen Links aus.',
	'DIR_THUMB_SERVICE_REVERSE'				=> 'Den Service rückwirkend ändern',
	'DIR_THUMB_SERVICE_REVERSE_EXPLAIN'		=> 'Beim Aktivieren von <strong><em>Ja</em></strong>, werden die bereits bestehenden Links den neuen Dienst nutzen. Dies erfordert eine Abfrage pro Link ab der ersten Eintragung nach dem Wechsel des Dienstes zwecks Aktualisierung der Datenbank-Tabellen.',
	'DIR_USER_PROP'							=> 'Vorgeschlagen von %s in <em>%s</em> der %s',
	'DIR_VALIDATE'							=> 'Aktiviere die Freischaltung durch einen Administrator',
	'DIR_VALIDATE_EXPLAIN'					=> 'Beim Anklicken von <strong><em>Ja</em></strong> müssen die vorgeschlagenen Links von einem Administrator freigeschaltet werden, andernfalls bein Anklicken von  <strong><em>Nein</em></strong> werden die Links ohne Freischaltung ins Linkverzeichniss übernommen.',
	'DIR_VALIDATION'						=> 'Links nach Überprüfung freischalten',
	'DIR_VALIDATION_EXPLAIN'				=> 'Diese Funktion ist nur vorhanden, wenn Du in den Optionen ausgewählt hast, das die Links durch einen Administrator freigeschaltet werden müssen. Ist dies der Fall, wird eine E-Mail an den Link-Ersteller gesendet, sobald sein Link freigeschaltet wurde. Nach der Freischaltung erscheint der Link sofort im Linkverzeichnis.',
	'DIR_VERSION_NOT_UP_TO_DATE_ACP'		=> 'Deine Version des Link-Verzeichnisses ist nicht mehr aktuell.<br />Weiter unten findest Du einen Link zu der Ankündigung der aktuellen Version und den Update-Anweisungen.',
	'DIR_VERSION_UP_TO_DATE_ACP'			=> 'Deine Version ist aktuell, ein Update ist nicht nötig.',
	'DIR_VISUAL_CONFIRM'					=> 'Captcha-Bestätigung für Gäste aktivieren',
	'DIR_VISUAL_CONFIRM_EXPLAIN'			=> 'Beim Auswählen von <strong><em>Ja</em></strong> müssen Gäste den zufällig generierten Code des Captcha eingeben, um Spam-Bot-Einträge zu verhindern.',
	'DIR_WAITING_LINKS'						=> 'Anzahl der Links, die auf Freischaltung warten',

	'EMAIL_SUBJECT_ACTIVATE'				=> 'Deine Seite wurde freigeschaltet',
	'EMAIL_SUBJECT_DELETE'					=> 'Dein Link wurde nicht freigeschaltet',
	'EMAIL_TEXT_ACTIVATE'					=> 'Es ist uns eine Freude, Dich darüber zu informieren, das Dein vorgeschlagender Link %s  bei uns %s freigeschaltet wurde und nun Teil unseres Linkverzeichnisses ist. Zur Erinnerung hier noch einmal der Link: %s',
	'EMAIL_TEXT_DELETE'						=> 'Zu unserem Bedauern informieren wir Dich, das Dein Link %s, den Du auf %s vorgeschlagen hast, nicht freigeschaltet wurde. Zur Errinerung hier noch einmal der Link: %s',

	'IMG_BUTTON_LINK_NEW'					=> 'Link ins Linkverzeichnis eintragen',
	'IMG_ICON_LINK_NEW'						=> 'Neuer Link',

	'LOG_DIR_AUTO_PRUNE'					=> '<strong>Auto-Trennung einer Kategorie des Linkverzeichnisses</strong><br />» %s',
	'LOG_DIR_CAT_ADD'						=> '<strong>Erstelle eine neue Kategorie im Linkverzeichnis</strong><br />» %s',
	'LOG_DIR_CAT_DEL_CAT'					=> '<strong>Löschen d’einer Kategorie</strong><br />» %s',
	'LOG_DIR_CAT_DEL_CATS'					=> '<strong>Löschen einer Kategorie und Unter-Kategorie</strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS'					=> '<strong>Löschen einer Kategorie und seiner Nachrichten</strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS_CATS'			=> '<strong>Löschen einer Kategorie, seiner Nachrichten und Unter-Kategorien</strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS_MOVE_CATS'		=> '<strong>Löschen einer Kategorie und seiner Nachrichten, Unter-Kategorie verschoben</strong> nach %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_CATS'				=> '<strong>Löschen einer verschobenen Kategorie und Unter-Kategorie</strong> nach %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS'			=> '<strong>Löschen einer Kategorie und verschobene Nachrichten</strong> nach %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS_CATS'		=> '<strong>Löschen einer Kategorie und Unter-Kategorie, Nachrichten verschoben</strong> nach %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS_MOVE_CATS'	=> '<strong>Löschen einer Kategorie, verschieben der Nachrichten</strong> nach %1$s <strong>und der Unter-Kategorien</strong> nach %2$s<br />» %3$s',
	'LOG_DIR_CAT_EDIT'						=> '<strong>Änderung einer Linkverzeichnis-Kategorie</strong><br />» %s',
	'LOG_DIR_CAT_MOVE_DOWN'					=> '<strong>Verschiebe die Kategorie des Linkverzeichnisses</strong> %1$s <strong>unterhalb von</strong> %2$s',
	'LOG_DIR_CAT_MOVE_UP'					=> '<strong>Verschiebe die Kategorie des Linkverzeichnisses</strong> %1$s <strong>oberhalb von</strong> %2$s',
	'LOG_DIR_CAT_SYNC'						=> '<strong>Resynchronisation einer Kategorie des Linkverzeichnis</strong><br />» %s',
	'LOG_LINK_ACTIVE'						=> 'Freischalten der Links, die auf Freischaltung warten:<br />» %s',
	'LOG_LINK_DELETE'						=> 'Löschen der Links, die auf Freischaltung warten:<br />» %s',

	'SYNC_IN_PROGRESS'						=> 'Synchronisation der Kategorie',
	'SYNC_IN_PROGRESS_EXPLAIN'				=> 'Resynchronisation der aktuellen Links alle %1$d/%2$d .',

	'TOO_LONG_DESCRIPTION'					=> 'Deine Beschreibung ist zu lang',
	'TOO_SHORT_DESCRIPTION'					=> 'Du musst ein Beschreibung eingeben',
	'TOO_SHORT_REPLY'						=> 'Dein Kommentar ist zu kurz',
	'TOO_SHORT_SITE_NAME'					=> 'Du musst für die Webseite einen Namen',
	'TOO_SHORT_URL'							=> 'Du musst eine URL angeben',
	'TOO_SMALL_CAT'							=> 'Du musst eine Kategorie wählen',
));

?>
<?php
/**
*
* info_acp_directory [Serbian]
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
// You do not need this when single placeholders are used, e.g. 'Message %d' is fine
// equally when a string contains only two placeholders which are used to wrap text
// in a url once again you do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	'ACP_DIRECTORY'							=> 'phpBB Direktorijum',
	'ACP_DIRECTORY_CATS'					=> 'Podesavanje kategorija',
	'ACP_DIRECTORY_INDEX_TITLE'				=> 'phpBB Direktorijum',
	'ACP_DIRECTORY_MAIN'					=> 'Informacije i alati',
	'ACP_DIRECTORY_SETTINGS'				=> 'Opsta Podesavanja',
	'ACP_DIRECTORY_SETTINGS_EXPLAIN'		=> 'Podesavanja direktorijuma',
	'ACP_DIRECTORY_VAL'						=> 'autorizacija vebsajta',
	'DIR_ACTIVE_CHECK'						=> 'Dozvoliti testiranje unesenog vebsajta',
	'DIR_ACTIVE_CHECK_EXPLAIN'				=> 'Ako stiklirate <i>da</i>, Linkovi ce biti testirani pri unosenju. Ako nema odgovora u roku od 1 sekunde smatrace se nedostupnim.',
	'DIR_ACTIVE_THUMB'						=> 'Dozvoliti umanjeni prikaz vebsajta',
	'DIR_ACTIVE_THUMB_REMOTE'				=> 'Omoguciti AscreeN kompatibilnost',
	'DIR_ACTIVE_THUMB_REMOTE_EXPLAIN'		=> 'Ako stiklirate <i>da</i>, prilikom podnosenja vebsajta, mod ce proveriti da li  AscreeN umanjeni prikaz sajta postoji.<br />Webmaster omogucava AscreeN umanjeni prikaz sajta i obicno preciznije oslikava vebsajt.',
	'DIR_ACTIV_BANNER'						=> 'Dozvoliti link banera',
	'DIR_ACTIV_FLAG'						=> 'Dozvoliti izbor jezika',
	'DIR_ACTIV_PAGERANK'					=> 'Dozvoliti pagerank vebsajtova',
	'DIR_ACTIV_PAGERANK_EXPLAIN'			=> 'Pagerank izarcunat prilikom podnosenja vebsajta ce biti prikazan.',
	'DIR_ACTIV_REWRITE'						=> 'Dozvoliti  rewrite url direktorijuma',
	'DIR_ACTIV_REWRITE_EXPLAIN'				=> 'Ako aktivirate ovu opciju url direktorijuma kategorije kao i link  direktorijuma navbar ce biti ponovo napisani (rewrite)  u skladu sa podesavanjima moda <a href="http://www.phpbb-seo.com/fr/mod-rewrite-phpbb/ultimate-seo-url-t4489.html" target="_blank">Ultimate SEO URL by dcz</a>.<br />Azuriranje .htaccess fajla ce biti potrebno.',
	'DIR_ACTIV_RSS'							=> 'Dozvoliti detaljan opis RSS feed-a',
	'DIR_ACTIV_RSS_EXPLAIN'					=> 'Aktiviranje ove opcije omogucava detaljan opis URL povezanim sa RSS feed-om prilikom unosenja sajta <br />Ikonica ce biti prikazana prilikom pretrage kategorije.',
	'DIR_ADD_GUEST'							=> 'Podesavanja za posetioce',
	'DIR_ALLOW_BBCODE'						=> 'Dozvoliti bbkodove u komentarima',
	'DIR_ALLOW_COMMENTS'					=> 'Dozvoliti komentare',
	'DIR_ALLOW_LINKS'						=> 'Dozvoliti linkove u komentarima',
	'DIR_ALLOW_SMILIES'						=> 'Dozvoliti smajlije u komentarima',
	'DIR_ALLOW_VOTES'						=> 'Dozvoliti glasove',
	'DIR_ANNOUNCEMENT_TOPIC'				=> 'Annoucement Topic',
	'DIR_BANNERS_DIR_SIZE'					=> 'Velicina banners direktorijuma',
	'DIR_BANN_PARAM'						=> 'Podesavanje banera',
	'DIR_CAT_ADMIN'							=> 'podesavanja kategorija direktorijuma',
	'DIR_CAT_ADMIN_EXPLAIN'					=> 'Ovde mozete dodati, modifikovati ili brisati kategorije individualno. Ako statistika linkova (komentari, broj glasova) ili jedna od kategorija deluje neispravno, mozete ponovo sinhronizovati kategoriju.',
	'DIR_CAT_CREATED'						=> 'Kategorija je kreirana.',
	'DIR_CAT_DATA_NEGATIVE'					=> 'Podesavanja automatske provere i broj provera pre uklanjanja ne moze biti negativan ili nepostojeci.',
	'DIR_CAT_DELETE'						=> 'Izbrisati kategoriju',
	'DIR_CAT_DELETED'						=> 'Kategorija je izbrisana',
	'DIR_CAT_DELETE_EXPLAIN'				=> 'Ova opcija vam omogucava da izbrisete kategoriju i da odlucite gde da prebacite sve vebsajtove ili kategorije koje sadrzi.',
	'DIR_CAT_DESC'							=> 'Opis',
	'DIR_CAT_DESC_EXPLAIN'					=> 'Opis kategorije nije obavezan.Ako ga napisete pojavice se iznad vebsajtova u kategoriji.<br />Bilo koji napisani HTML tag ce biti prikazan.',
	'DIR_CAT_GENERAL_SETTINGS'				=> 'Opsta podesavanja kategorije',
	'DIR_CAT_ICON'							=> 'Slika kategorije',
	'DIR_CAT_NAME'							=> 'Ime kategorije',
	'DIR_CAT_NAME_EMPTY'					=> 'Morate uneti ime kategorije',
	'DIR_CAT_PARENT'						=> 'nadredjena kategorija',
	'DIR_CAT_RESYNCED'						=> 'Kategorija “%s” je resinhronizovana',
	'DIR_CAT_SETTINGS'						=> 'Podesavanja kategorije',
	'DIR_CAT_TOO_LONG'						=> 'Opis kategorije je predugacak. Ne sme da sadrzi vise od 4000 karaktera.',
	'DIR_CAT_UPDATED'						=> 'Informacije o kategoriji su azurirane.',
	'DIR_COMM_PARAM'						=> 'Podesavanje komentara',
	'DIR_COMM_PER_PAGE'						=> 'Broj komentara po strani',
	'DIR_CONFIG_SETTINGS'					=> 'Azuriranje konfiguracije direktorijuma',
	'DIR_COUNT_ALL'							=> 'ubrajati vebsajtove u podkategorijama',
	'DIR_COUNT_ALL_EXPLAIN'					=> 'Ako aktivirate ovu opciju brojac koji se nalazi pored svake kategorije ce ubrajati i vebsajtove u podkategorijama',
	'DIR_CREATE_CAT'						=> 'Napraviti novu kategoriju',
	'DIR_CRON_ENABLE'						=> 'Dozvoliti periodicnu proveru povratnih linkova',
	'DIR_CRON_ENABLE_EXPLAIN'				=> 'Ako je aktivirana ova opcija ce periodicno proveravati povratne linkove.',
	'DIR_CRON_EVERY'						=> 'Proveriti svaki',
	'DIR_CRON_SETTINGS'						=> 'Podesavanja povratnih linkova',
	'DIR_DEFAULT_ORDER'						=> ' Ranking default order ',
	'DIR_DELETE_ALL_LINKS'					=> 'izbrisati sve vebsajtove',
	'DIR_DELETE_ORPHANS'					=> 'Izbrisati orphan banere',
	'DIR_DELETE_ORPHANS_CONFIRM'			=> 'Da li ste sigurni da zelite da izbrisete orphan banere?',
	'DIR_DELETE_ORPHANS_EXPLAIN'			=> 'Orphan baneri su baneri koji su kopirani na server ali iz nepoznatog razloga nisu vise povezani sa direktorijumom vebsajta.' ,
	'DIR_DELETE_SUBCATS'					=> 'Izbrisati vebsajtove i kategorije',
	'DIR_DOWNLOAD_LATEST'					=> 'Download poslednju verziju',
	'DIR_EDIT_CAT'							=> 'Izmeniti kategoriju',
	'DIR_EDIT_EXPLAIN'						=> 'Ova opcija vam dozvoljava da personalizujete kategoriju.',
	'DIR_ERROR_AUTH_COMM'					=> 'Nemate dozvolu da ostavite komentar',
	'DIR_ERROR_CAT'							=> 'Nemoguce je povratiti podatke iz kategorije',
	'DIR_ERROR_COMM_LOGGED'					=> 'Morate biti ulogovani da biste ostavili komentar',
	'DIR_ERROR_KEYWORD'						=> 'Morate uneti kljucne reci  da biste otpoceli pretragu',
	'DIR_ERROR_NOT_AUTH'					=> 'Nemate dozvolu da izvrsite ovu operaciju',
	'DIR_ERROR_NO_LINK'						=> 'Vebsajt koji trazite ne postoji',
	'DIR_ERROR_NO_LINKS'					=> 'Vebsajt ne postoji',
	'DIR_ERROR_SUBMIT_TYPE'					=> 'Pogresan tip podatkau funkciji dir_submit_type',
	'DIR_ERROR_URL'							=> 'Morate uneti validan URL',
	'DIR_ERROR_VOTE'						=> 'Vec ste glasali za ovaj vebsajt',
	'DIR_ERROR_VOTE_LOGGED'					=> 'Morate biti ulogovani da biste glasali',
	'DIR_INDEX'								=> 'Indeks direktorijuma',
	'DIR_LENGTH_COMMENTS'					=> 'Maksimalan broj karaktera za komantar linka',
	'DIR_LINKS'								=> 'Linkovi',
	'DIR_LINK_ACTIVATE'						=> 'Validirati',
	'DIR_LINK_DELETE'						=> 'Izbrisati',
	'DIR_LIST_INDEX'						=> 'prikazati kategoriju u nadredjenoj kategoriji',
	'DIR_MAIL_NOTIFICATION'					=> 'Novi vebsajt u direktorijumu',
	'DIR_MAIL_VALIDATION'					=> 'Biti obavesten emailom za autentifikaciju vebsajta na cekanju',
	'DIR_MAX_ADD_ATTEMPTS'					=> 'Pokusaji unosenja vebsajta',
	'DIR_MAX_ADD_ATTEMPTS_EXPLAIN'			=> 'Broj pokusaja za unosenje koda za potvrdu pre kraja sesije.',
	'DIR_MAX_BANN'							=> 'Maksimalna velicina banera',
	'DIR_MAX_BANN_EXPLAIN'					=> 'Maksimalna velicina poslatog banera. Podesite dve vrednosti 0px do 0px da biste onemogucili kontrolu.',
	'DIR_MAX_DESC'							=> 'Maksimalni broj karaktera za opis vebsajta.',
	'DIR_MAX_SIZE'							=> 'Maksimalna velicina banera',
	'DIR_MAX_SIZE_EXPLAIN'					=> 'Za poslate banere',
	'DIR_MOVE_LINKS_TO'						=> 'Prebaciti sve vebsajtove u',
	'DIR_MOVE_SUBCATS_TO'					=> 'Prebaciti podkategorije',
	'DIR_MUST_BACK'							=> 'Zahtevati povratni link',
	'DIR_MUST_BACK_EXPLAIN'					=> 'Ako je aktivirana ova opcija zahteva povratni link prilikom unosenja sajta.',
	'DIR_MUST_DESCRIBE'						=> 'Dozvoliti zahtev opisa prilikom unosenja sajta',
	'DIR_NB_CHECK'							=> 'Broj provera pre uklanjanja',
	'DIR_NB_CHECK_EXPLAIN'					=> 'Unesite broj provera posle kog ce vebsajt biti uklonjen zato sto njegov povratni link nije vise validan; Email ce biti poslat korisniku posle svakog neuspelog pokusaja da bi ga upozorio da povratni link nedostaje. Unesite 0 ako zelite da vebsajt bude uklonjen posle prvog neuspelog pokusaja.',
	'DIR_NEW_TIME'							=> 'Broj dana za nove sajtove.',
	'DIR_NEW_TIME_EXPLAIN'					=> 'Broj dana tokom kojih ce sajt biti smatran za nov. Ako je aktivirana ikonica new ce biti prikazana pored sajta. Unesite 0 da biste dezaktivirali opciju.',
	'DIR_NEXT_CRON_ACTION'					=> 'Datum sledece provere',
	'DIR_NO_CAT'							=> 'Nijedna kategorija nije izabrana',
	'DIR_NO_DESTINATION_CAT'				=> 'Odredisna kategorija nije precizirana',
	'DIR_NO_LINK'							=> 'Nema vebsajtova koji cekaju odobrenje',
	'DIR_NO_PARENT'							=> 'Nema nadredjenih',
	'DIR_NUMBER_CATS'						=> 'Broj kategorija',
	'DIR_NUMBER_CLICKS'						=> 'Broj klikova',
	'DIR_NUMBER_COMMENTS'					=> 'broj komentara',
	'DIR_NUMBER_LINKS'						=> ' broj aktivnih linkova',
	'DIR_NUMBER_ORPHANS'					=> ' broj Orphan banera',
	'DIR_NUMBER_VOTES'						=> ' broj Glasova',
	'DIR_ORDER_A_A'							=> '[Ascending] Autor',
	'DIR_ORDER_A_D'							=> '[Descending] Autor',
	'DIR_ORDER_R_A'							=> '[Ascending] Komentari',
	'DIR_ORDER_R_D'							=> '[Descending] Komentari',
	'DIR_ORDER_S_A'							=> '[Ascending] Ime',
	'DIR_ORDER_S_D'							=> '[Descending] Ime',
	'DIR_ORDER_T_A'							=> '[Ascending] Datum',
	'DIR_ORDER_T_D'							=> '[Descending] Datum',
	'DIR_ORDER_V_A'							=> '[Ascending] Klikovi',
	'DIR_ORDER_V_D'							=> '[Descending] Klikovi',
	'DIR_PARAM'								=> 'General Settings',
	'DIR_RECENT_COLUMNS'					=> 'Broj kolona u bloku',
	'DIR_RECENT_ENABLE'						=> 'Dozvoliti blok "poslednji dodati linkovi"',
	'DIR_RECENT_ENABLE_EXPLAIN'				=> 'Ova opcija prikazuje blok koji pokazuje poslednje vebsajtove dodate u direktorijumna dnu glavne stranice direktorijuma. <br />Broj prikazanih vebsajtova moze biti definisan podesavanjima koji slede.',
	'DIR_RECENT_EXCLUDE'					=> 'ID kategorija koje treba iskljuciti',
	'DIR_RECENT_EXCLUDE_EXPLAIN'			=> 'Unesite ovde ID kategorija koje ne treba uzeti u obzir, rastavljajuci ih zarezima.<br />Ex: 1,4,12',
	'DIR_RECENT_GUEST'						=> 'Podesavanja bloka "poslednji dodati linkovi"',
	'DIR_RECENT_ROWS'						=> 'Broj redova u bloku',
	'DIR_RELEASE_ANNOUNCEMENT'				=> 'Saopstenje',
	'DIR_RESET_CLICKS'						=> 'Resetovati brojac klikova',
	'DIR_RESET_CLICKS_CONFIRM'				=> 'Da li ste sigurni da hocete da resetujete brojac klikova ?',
	'DIR_RESET_COMMENTS'					=> 'Resetovati komentare',
	'DIR_RESET_COMMENTS_CONFIRM'			=> 'Da li ste sigurni da zelite resetovati  komentare?',
	'DIR_RESET_COMMENTS_EXPLAIN'			=> 'Izbrisati sve komentare iz linkova direktorijuma',
	'DIR_RESET_VOTES'						=> 'Resetovati glasove',
	'DIR_RESET_VOTES_CONFIRM'				=> 'Da li ste sigurni da zelite resetovati glasove ?',
	'DIR_RESET_VOTES_EXPLAIN'				=> 'Izbrisati sve glasove iz linka direktorijuma',
	'DIR_REWRITE_PARAM'						=> 'URL Rewriting Podesavanja',
	'DIR_SELECT_CAT'						=> 'Izaberite kategoriju',
	'DIR_SHOW'								=> 'Broj vebsajtova po strani',
	'DIR_STATS'								=> 'statistika direktorijuma',
	'DIR_STORAGE_BANNER'					=> 'kopirati banere na server',
	'DIR_STORAGE_BANNER_EXPLAIN'			=> 'Ako aktivirate ovu opciju, Baneri povezani sa vebsajtovima ce biti kopirani na ovaj server.<br />Aktiviranjem ove opcije omogucavate brze ucitavanje stranice.',
	'DIR_SUBCAT'							=> 'Podkategorija',
	'DIR_THUMB_PARAM'						=> 'Podesavanja umanjenih prikaza sajtova',
	'DIR_THUMB_SERVICE'						=> 'Umanjeni prikaz sajtova Servis za koriscenje',
	'DIR_THUMB_SERVICE_EXPLAIN'				=> ' Umanjeni prikaz sajtova Servis za koriscenje kada Ascreen umanjeni prikaz sajtova ne postoji. Osim ako ne promenite opciju ispod ovo podesavanje je vazece samo za sajtove unete od danas',
	'DIR_THUMB_SERVICE_REVERSE'				=> 'dozvoliti retroaktivnu promenu servisa',
	'DIR_THUMB_SERVICE_REVERSE_EXPLAIN'		=> 'Ako stiklirate <i>da</i>, postojeci linkovi pre promene servisa ce koristiti novi servis koji izaberete. Ovo zahteva upit za svaki vebsajt prilikom prvog prikazivanja posle promene servisa, da bi azurirali tabelu.',
	'DIR_USER_PROP'							=> 'Unet od strane %s u <i>%s</i> the %s',
	'DIR_VALIDATE'							=> 'Dozvoliti validaciju administratoru',
	'DIR_VALIDATE_EXPLAIN'					=> 'Ako stiklirate <i>da</i>, uneti linkovi ce biti autorizovani pre pojavljivanja u direktorijumu. U suprotnom, ako stiklirate  <i>ne</i> linkovi ce biti odmah prikazani.',
	'DIR_VALIDATION'						=> 'Validacija vebsajt direktorijuma',
	'DIR_VALIDATION_EXPLAIN'				=> 'Ova opcija ce raditi samo ako u podesavanjima izaberete  da vebsajt direktorijuma mora biti potvrdjen. U tom slucaju, email ce biti poslat osobi koja je unela sajt I cim validirate sajt on ce se pojaviti u direktorijumu.',
	'DIR_VERSION_NOT_UP_TO_DATE_ACP'		=> 'Vasa verzija phpBB Direktorijuma inije azurirana.<br />Koristeci ovaj link idite na stranicu sa najnovijom verzijom i sledite uputstva za azuriranje.',
	'DIR_VERSION_UP_TO_DATE_ACP'			=> 'Vasa verzija phpBB Direktorijuma je azurirana, ne postoji novija verzija. Azuriranje verzije nije potrebno.',
	'DIR_VISUAL_CONFIRM'					=> 'Dozvoliti vizuelnu konfirmaciju za goste',
	'DIR_VISUAL_CONFIRM_EXPLAIN'			=> 'Ako stiklirate <i>da</i>, gosti ce morati tda unesu nasumican kod koji se poklapa sa slikom da bi sprecili masivno unosenje.',
	'DIR_WAITING_LINKS'						=> ' Broj linkova na cekanju',

	'EMAIL_SUBJECT_ACTIVATE'				=> 'Vas vebsajt je prihvacen',
	'EMAIL_SUBJECT_DELETE'					=> 'vas vebsajt je odbijen',
	'EMAIL_TEXT_ACTIVATE'					=> 'Srecni smo sto mozemo da vam saopstimo da je sajt koji ste uneli prihvacen i da se nalazi u direktorijumu. Podsetnik vebsajta: %s',
	'EMAIL_TEXT_DELETE'						=> 'Zao nam je sto moramo da vam saopstimo da sajt koji ste uneli nije prihvacen. Podsetnik sajta : %s',

	'IMG_BUTTON_LINK_NEW'					=> 'Dodati vebsajt u direktorijum',
	'IMG_ICON_LINK_NEW'						=> 'Novi link',

	'LOG_DIR_AUTO_PRUNE'					=> '<strong>Auto prune of a category of the directory</strong><br />» %s',
	'LOG_DIR_CAT_ADD'						=> '<strong>Kreiranje nove kategorije u direktorijumu</strong><br />» %s',
	'LOG_DIR_CAT_DEL_CAT'					=> '<strong>Uklanjanje kategorije</strong><br />» %s',
	'LOG_DIR_CAT_DEL_CATS'					=> '<strong>Uklanjanje kategorije i njenih podkategorija</strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS'					=> '<strong>Uklanjanje kategorije i poruka koje sadrzi.</strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS_CATS'			=> '<strong>Uklanjanje kategorije, njenih podkategorija i poruka </strong><br />» %s',
	'LOG_DIR_CAT_DEL_LINKS_MOVE_CATS'		=> '<strong>Uklanjanje kategorije i njenih poruka, podkategorije su premestene</strong> to %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_CATS'				=> '<strong>Uklanjanje kategorije podkategorije su premestene</strong> to %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS'			=> '<strong>Uklanjanje kategorije poruke su premestene</strong> to %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS_CATS'		=> '<strong>Uklanjanje kategorije i podkategorija, poruke su premestene</strong> vers %1$s<br />» %2$s',
	'LOG_DIR_CAT_DEL_MOVE_LINKS_MOVE_CATS'	=> '<strong>Uklanjanje kategorije, poruke su premestene </strong> u %1$s <strong>i podkategorije su premestene</strong> u<br />» %3$s',
	'LOG_DIR_CAT_EDIT'						=> '<strong>Modifikovati kategoriju direktorijuma</strong><br />» %s',
	'LOG_DIR_CAT_MOVE_DOWN'					=> '<strong>Premestiti kategoriju u direktorijum</strong> %1$s <strong>under</strong> %2$s',
	'LOG_DIR_CAT_MOVE_UP'					=> '<strong>Premestiti kategoriju iz direktorijuma</strong> %1$s <strong>above</strong> %2$s',
	'LOG_DIR_CAT_SYNC'						=> '<strong>Resinhronizacija kategorije direktorijuma</strong><br />» %s',
	'LOG_LINK_ACTIVE'						=> 'Aktivacija vebsajta koji ceka potvrdu:<br />» %s',
	'LOG_LINK_DELETE'						=> 'Uklanjanje vebsajta koji ceka potvrdu:<br />» %s',

	'SYNC_IN_PROGRESS'						=> 'Sinhronizacija kategorije',
	'SYNC_IN_PROGRESS_EXPLAIN'				=> 'Resinhronizacija linkova %1$d/%2$d u toku.',

	'TOO_LONG_DESCRIPTION'					=> 'Uneti opis je predug',
	'TOO_SHORT_DESCRIPTION'					=> 'Morate uneti opis',
	'TOO_SHORT_REPLY'						=> 'Vas komentar je prekratak',
	'TOO_SHORT_SITE_NAME'					=> 'Morate uneti ime vebsajta',
	'TOO_SHORT_URL'							=> 'Morate uneti URL',
	'TOO_SMALL_CAT'							=> 'Morate izabrati kategoriju',
));

?>
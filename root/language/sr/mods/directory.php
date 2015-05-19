<?php
/**
 *
 * directory [Serbian]
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
	'DIR_SEARCH_NO_RESULT'					=> 'Nema rezultata',
	'DIR_BANNER_DISALLOWED_CONTENT'			=> 'Transfer je prekinut, jer je fajl identifikovan kao potencijalna pretnja.',
	'DIR_BANNER_DISALLOWED_EXTENSION'		=> 'Fajl ne moze biti prikazan jer ekstenzija <strong>%s</strong> nije dozvoljena.',
	'DIR_BANNER_EMPTY_FILEUPLOAD'			=> 'Baner fajl je prazan.',
	'DIR_BANNER_EMPTY_REMOTE_DATA'			=> 'Uneti baner ne moze biti prebacen zato sto su podaci netacni ili osteceni',
	'DIR_BANNER_IMAGE_FILETYPE_MISMATCH'	=> 'tip baner fajla nije odgovarajuci: ocekivana ekstenzija je %1$s a uneta je %2$s.',
	'DIR_BANNER_INVALID_FILENAME'			=> '%s je nevazece ime za fajl.',
	'DIR_BANNER_NOT_UPLOADED'				=> 'Baner ne moze biti prebacen',
	'DIR_BANNER_NO_SIZE'					=> 'Greska prilikom odredjivanja visine i sirine avatara. Molimo vas da ih sami unesete',
	'DIR_BANNER_PARTIAL_UPLOAD'				=> 'Fajl ne moze biti prebacen u potpunosti',
	'DIR_BANNER_PHP_SIZE_NA'				=> 'Velicina banera prevazilazi dozvoljenu.<br />maksimalna velicina postavljena u php.ini ne moze biti utvrdjena".',
	'DIR_BANNER_PHP_SIZE_OVERRUN'			=> 'Velicina banera prevazilazi dozvoljenu. Maksimalna velicina je %d Mo.<br />Velicina vaseg banera ne moze da prelazi velicinu definisanu u php.ini.',
	'DIR_BANNER_UNABLE_GET_IMAGE_SIZE'		=> 'Nemoguce je utvrditi dimenzije banera ',
	'DIR_BANNER_URL_INVALID'				=> 'Uneta baner adressa je nevazeca',
	'DIR_BANNER_URL_NOT_FOUND'				=> 'Nepostojeca stranica',
	'DIR_BANNER_WRONG_FILESIZE'				=> 'Velicina banera mora biti izmedju 0 i %1d %2s.',
	'DIR_BANNER_WRONG_SIZE'					=> 'Uneti baner je sirok %3$d piksela i visok %4$d piksela. Sirina ne sme da prelazi %1$d piksela, a visina %2$d.',
	'DIR_BE_NOTIFIED'						=> 'Obavestenje mailom prilikom dodavanja novog sajta u ovu kategoriju',
	'DIR_BE_NOT_NOTIFIED'					=> 'Desaktivirati obavestenja mailom prilikom dodavanja novog sajta u ovu kategoriju',
	'DIR_CAT'								=> 'Kategorija',
	'DIR_CAT_NAME'							=> 'Ime kategorije',
	'DIR_CAT_TITLE'							=> 'direktorijum kategorija',
	'DIR_CLICK_RETURN_DIR'					=> 'Kliknuti %sovde%s da biste se vratili na pocetnu stranicu direktorijuma',
	'DIR_CLICK_RETURN_CAT'					=> 'Kliknuti %sovde%s da biste se vratili u kategoriju',
	'DIR_CLICK_RETURN_LIEN'					=> 'Kliknuti %sovde%s da biste se vratili na vebsajt',
	'DIR_COMMENT'							=> 'komentar',
	'DIR_COMMENTS'							=> 'komentari',
	'DIR_COMMENTS_ORDER'					=> 'Komentari',
	'DIR_COMMENT_TITLE'						=> 'Procitati/Ostaviti komentar',
	'DIR_COMMENT_DELETE'					=> 'Izbrisati komentar',
	'DIR_COMMENT_DELETE_CONFIRM'			=> 'Da li ste sigurni da zelite da izbrisete komentar?',
	'DIR_COMMENT_EDIT'						=> 'Izmeniti komentari',
	'DIR_DELETE_BANNER'						=> 'Izbrisati baner',
	'DIR_DELETE_OK'							=> 'Vebsajt je izbrisan',
	'DIR_DELETE_SITE'						=> 'Izbrisati vebsajt',
	'DIR_DELETE_SITE_CONFIRM'				=> 'Da li ste sigurni da zelite da izbrisete vebsajt ?',
	'DIR_DESCRIPTION'						=> 'Opis',
	'DIR_DESCRIPTION_EXP'					=> 'Kratak opis vaseg vebsajta, maksimum %d karaktera.',
	'DIR_DISPLAY_LINKS'						=> 'Prikazati prethodne linkove',
	'DIR_EDIT'								=> 'Izmeniti',
	'DIR_EDIT_SITE'							=> 'Izmeniti vebsajt',
	'DIR_EDIT_SITE_ACTIVE'					=> 'Vas vebsajt je modifikovan, ali morate sacekati odobrenje da bi se pojavio u direktorijumu',
	'DIR_EDIT_SITE_OK'						=> 'Vebsajt je modifikovan',
	'DIR_ERROR_AUTH_COMM'					=> 'Nemate dozvolu da ostavite komentar',
	'DIR_ERROR_CAT'							=> 'Greska prilikom pokusaja vracanja kategorije u prethodno stanje.',
	'DIR_ERROR_CHECK_URL'					=> 'Nema odgovora sa unetog URL-a',
	'DIR_ERROR_COMM_LOGGED'					=> 'Morate biti ulogovani da biste ostavili komentar',
	'DIR_ERROR_KEYWORD'						=> 'Morate uneti kljucne reci da biste otpoceli pretragu',
	'DIR_ERROR_NOT_AUTH'					=> 'Nemate dozvolu za ovu operaciju',
	'DIR_ERROR_NOT_FOUND_BACK'				=> 'Uneta stranica sa povratnim linkom (link back) nije pronadjena',
	'DIR_ERROR_NO_CATS'						=> 'Ta kategorija ne postoji.',
	'DIR_ERROR_NO_LINK'						=> 'Trazeni vebsajt ne postoji.',
	'DIR_ERROR_NO_LINKS'					=> 'Taj vebsajt ne postoji',
	'DIR_ERROR_NO_LINK_BACK'				=> 'Povratni link nije pronadjen na unetoj stranici.',
	'DIR_ERROR_SUBMIT_TYPE'					=> 'Netacan tip podataka u dir_submit_type funkciji',
	'DIR_ERROR_URL'							=> 'Morate uneti validan URL',
	'DIR_ERROR_VOTE'						=> 'Vec ste glasali za ovaj vebsajt',
	'DIR_ERROR_VOTE_LOGGED'					=> 'Morate biti ulogovani da biste glasali',
	'DIR_ERROR_WRONG_DATA_BACK'				=> 'Adresa povratnog linka mora biti validan URL, ukljucujuci i protokol. Na primer http://www.example.com/.',
	'DIR_FIELDS'							=> 'Molimo popunite sva polja sa *',
	'DIR_FLAG'								=> 'Zastava',
	'DIR_FLAG_EXP'							=> 'Izaberite zastavu, koja odgovara nacionalnosti sajta',
	'DIR_FROM_TEN'							=> '%s/10',
	'DIR_GUEST_EMAIL'						=> 'Vasa email adresa',
	'DIR_KEYWORD'							=> 'Kljucne reci za potragu',
	'DIR_KEYWORD_EXP'						=> 'Unesite razmak izmedju reci',
	'DIR_MAKE_SEARCH'						=> 'Pretraga vebsajta',
	'DIR_NAME_ORDER'						=> 'Ime',
	'DIR_NEW_SITE'							=> 'Dodati vebsajt u direktorijum',
	'DIR_NEW_SITE_ACTIVE'					=> 'Vas vebsajt je dodat, ali morate sacekati odobrenje da bi se pojavio u direktorijumu',
	'DIR_NEW_SITE_OK'						=> 'Vas vebsajt je dodat',
	'DIR_NB_CLIC'							=> '%d Klik',
	'DIR_NB_CLICS'							=> '%d Klikova',
	'DIR_NB_CLICS_ORDER'					=> 'Klikovi',
	'DIR_NB_LINK'							=> '%d link',
	'DIR_NB_LINKS'							=> '%d linkovi',
	'DIR_NB_VOTE'							=> '%d glas',
	'DIR_NB_VOTES'							=> '%d glasovi',
	'DIR_NONE'								=> 'Nista',
	'DIR_NOTE'								=> 'Notacija',
	'DIR_NO_COMMENT'						=> 'Nema komentara za ovaj vebsajt',
	'DIR_NO_DRAW_CAT'						=> 'Nema kategorija',
	'DIR_NO_DRAW_LINK'						=> 'Nema vebsajtova u ovoj kategoriji',
	'DIR_NO_NOTE'							=> 'Nista',
	'DIR_PAGERANK'							=> 'Pr',
	'DIR_PAGERANK_NOT_AVAILABLE'			=> 'n/a',
	'DIR_PR_ORDER'							=> 'PageRank',
	'DIR_REPLY_EXP'							=> 'Vas komentar ne sme da sadrzi vise od %d karaktera.',
	'DIR_REPLY_TITLE'						=> 'Ostaviti komentar',
	'DIR_RSS'								=> 'RSS of',
	'DIR_SEARCH_AND'						=> 'Traziti sve reci',
	'DIR_SEARCH_CATLIST'					=> 'Traziti u posebnoj kategoriji',
	'DIR_SEARCH_DESC_ONLY'					=> 'Jedino opis',
	'DIR_SEARCH_METHOD'						=> 'Method',
	'DIR_SEARCH_NB_CLIC'					=> 'Klik',
	'DIR_SEARCH_NB_CLICS'					=> 'Klikovi',
	'DIR_SEARCH_NB_COMM'					=> '%d komentar',
	'DIR_SEARCH_NB_COMMS'					=> '%d komentara',
	'DIR_SEARCH_OR'							=> 'Traziti bar jednu od navedenih reci',
	'DIR_SEARCH_RESULT'						=> 'rezultati pretrage',
	'DIR_SEARCH_TITLE_DESC'					=> 'Ime i opis',
	'DIR_SEARCH_TITLE_ONLY'					=> 'Ime',
	'DIR_SEARCH_WITHIN'						=> 'Traziti u',
	'DIR_SITE_BACK'							=> 'URL stranice povratnog linka',
	'DIR_SITE_BACK_EXPLAIN'					=> 'U ovoj ktegoriji potrebno je da vlasnik sajta doda povratni link. Molimo vas da unesete URL stranice na kojoj se nalazi link.',
	'DIR_SITE_BANN'							=> 'Dodati baner ',
	'DIR_SITE_BANN_EXP'						=> 'Ovde morate uneti kompletan URL vaseg banera. Ovo polje nije obavezno. Maksimalna velicina je <b>%d x %d</b> piksela, Baner ce biti automatski umanjen ako prelazi ovu velicinu.',
	'DIR_SITE_NAME'							=> 'Ime vebsajta',
	'DIR_SITE_RSS'							=> 'RSS feeds',
	'DIR_SITE_RSS_EXPLAIN'					=> 'Mozete dodati adresu RSS feeds ako postoji. Ikonica RSS ce biti prikazana pored vaseg vebsajta,da bi omogucila ljudima da se prijave.',
	'DIR_SITE_URL'							=> 'URL',
	'DIR_SOMMAIRE'							=> 'Pocetna stranica direktorijuma',
	'DIR_SUBMIT_TYPE_1'						=> 'Your website need to be approved by an adminsitrator.',
	'DIR_SUBMIT_TYPE_2'						=> 'vas vebsajt ce odmah biti dodat u direktorijum.',
	'DIR_SUBMIT_TYPE_3'						=> 'Vi ste administrator, vas vebsajt ce biti dodat odmah.',
	'DIR_SUBMIT_TYPE_4'						=> 'Vi ste moderator, vas vebsajt ce biti dodat odmah.',
	'DIR_THUMB'								=> 'umanjeni prikaz vebsajta',
	'DIR_USER_PROP'							=> 'vebsajt dodao',
	'DIR_VOTE'								=> 'Glasati',
	'DIR_VOTE_OK'							=> 'Uspesno ste glasali',
	'DIR_POST'								=> 'Post',

	'DIRECTORY_TRANSLATION_INFO'			=> '',

	'L_DIR_SEARCH_NB_COMM'					=> 'Komentar',
	'L_DIR_SEARCH_NB_COMMS'					=> 'Komentari',

	'RECENT_LINKS'							=> 'Poslednji dodati vebsajtovi',

	// Don't translate this line!
	'SEED'									=> 'Mining PageRank is AGAINST GOOGLE’S TERMS OF SERVICE. Yes, I’m talking to you, scammer.',

	'TOO_LONG_BACK'							=> 'Adresa povratnog linka je preduga (maksimum 255 karaktera)',
	'TOO_LONG_DESCRIPTION'					=> 'Vas opis je prekratak',
	'TOO_LONG_REPLY'						=> 'Vas komentar je predug',
	'TOO_LONG_RSS'							=> 'URL za RSS feeds je predug',
	'TOO_LONG_SITE_NAME'					=> 'Uneto ime je predugo (maksimum 100 karaktera)',
	'TOO_LONG_URL'							=> 'Uneti URL je predug (maksimum 255 karaktera)',
	'TOO_MANY_ADDS'							=> 'dostigli ste maksimalan broj pokusaja za unos vebsajta. Pokusajte kasnije.',
	'TOO_SHORT_BACK'						=> 'Morate uneti adresu stranice na kojoj se nalazi povratni link.',
	'TOO_SHORT_DESCRIPTION'					=> 'Morate uneti opis',
	'TOO_SHORT_REPLY'						=> 'Vas komentar je predug',
	'TOO_SHORT_RSS'							=> 'URL za RSS feeds je prekratak',
	'TOO_SHORT_SITE_NAME'					=> 'Morate uneti ime sajta',
	'TOO_SHORT_URL'							=> 'Morate uneti adresu sajta',
	'TOO_SMALL_CAT'							=> 'Morate izabrati kategoriju',

	'WRONG_DATA_RSS'						=> 'RSS feeds mora biti validan URL, ukljucujuci i protokol. Na primer http://www.example.com/.',
));

?>
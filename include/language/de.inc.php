<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * de.inc.php: german language file
 * Im formelleren Sie gehalten.
 *
 * Wenn Sie Texte anpassen möchten, erstellen Sie bitte eine Datei de.custom.php
 * und kopieren Sie die entsprechenden Variablen dorthin. So vermeiden Sie, dass
 * Änderungen verloren gehen bei einem Update.
 * Fehlerkorrekturen hingegen bitte an dbu@users.sourceforge.net senden...
 *
 * -> This application is partially based on phpPowerCards 2.0 by Marc Giombetti <marc@giombetti.com>
 * Please visit the simplEcard webiste to get further information and updates.
 * http://simplecard.sourceforge.net | David Buchmann <dbu@users.sourceforge.net>
 *****************************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * $Id: de.inc.php 7 2006-12-18 17:18:11Z dbu $
 */

/* common */
$se_text['error_configuration'] = 'Fehler in der Konfiguration.';
$se_text['fielderror'] = 'Folgende Fehler sind aufgetreten:';

/* postcard sending interface */
$se_text['header_choose'] = 'Bitte ein Bild auswählen';
$se_text['header_write'] = 'Verschicken Sie Ihre Postkarte';

$se_text['yourname'] = 'Ihr Name:';
$se_text['yourmail'] = 'Ihr Email:';
$se_text['recipientsname'] = 'Name des Empfängers:';
$se_text['recipientsmail'] = 'Email des Empfängers:';
$se_text['recipient_more'] = 'Mehrere Empfänger';
$se_text['recipient_more_hint'] = 'Mehrere Emailadressen eingeben (getrennt durch Zeilenumbrüche oder Kommas)';
$se_text['entermessage'] = 'Ihre Nachricht:';
$se_text['send'] = 'Absenden';

$se_text['error_noimages'] = 'Das Verzeichnis der Bilder für die Postkarten enthält keine Dateien (zumindest nicht mit dem Namen *_tn.*). So können keine Karten versandt werden.';
$se_text['error_nopic'] = 'Es wurde kein Bild ausgewählt.';
$se_text['error_nomessage'] = 'Es wurde keine Nachricht eingegeben.';
$se_text['error_invalidemail_from'] = 'Die Emailadresse des Absenders ist nicht gültig.';
$se_text['error_invalidemail_to'] = 'Die Emailadresse des Empfängers ist nicht gültig.';
$se_text['error_toomanyadresses'] = 'Sie können nicht an so viele Empfänger gleichzeitig Emails versenden.';

/* postcard viewing interface */
$se_text['header_show'] = 'Sie haben folgende Postkarte erhalten';
$se_text['show_from'] = 'Von:';
$se_text['show_to'] = 'Für:';
$se_text['show_message'] = 'Nachricht:';
$se_text['show_answer'] = 'Antwort schreiben';
$se_text['error_nosession'] = 'Sie haben keine Zugangsberechtigung zu dieser Karte.';
$se_text['error_missingparams'] = 'Ungültige URL. Falls Ihr Emailprogramm den Link auf mehrere Zeilen verteilt hat, bitte zusammenfügen.';


/* postcard sending */
$se_text['header_send'] = 'Ihre Postkarte wurde versandt';
$se_text['header_send_failed'] = 'Postkarte senden fehlgeschlagen';

$se_text['newmessage'] = 'Neue Nachricht';

/** confirmation message for web interface. */
$se_text['send_ok'] = 'Postkarte wurde erfolgreich versandt.<br />
<a href="%url%">Karte anschauen</a>';

/* email message */
/** subject for email */
$se_text['mail_subject'] = 'Eine E-Card für Sie';
/** message for text body of email 
 * %url% will be replaced with the url to retreive the postcard.
 * %name_from%, %email_from%, %name_to%, %email_to% and %message% will be 
 * replaced with the appropriate values.
 */
$se_text['mail_message'] = 'Sie bekamen eine Postkarte von %name_from% <%email_from%>

Um Ihre Postkarte abzuholen, besuchen Sie bitte die Adresse:
%url%

(Wenn Sie diesen Link nicht anklicken können, kopieren sie ihn mit Ctrl+C und fügen Sie ihn mit Ctrl+V in den Browser ein)
';
/** Used in the HTML mail, if enabled.
 * The message for html body of email (if $simplecard['send_html'] is true)
 * is created using the specified template and replacing the placeholders.
 */
$se_text['show_web'] = 'Falls diese Nachricht nicht richtig dargestellt wird, folgen sie bitte dem Link.';



/*** don't change anything below this line ***/




/*unused strings. kept for possible use later 
 *
 *$se_text['back'] = 'Zurück'; //needed?
 *
 *we do not test for names, only email
 *$se_text['needyourname'] = 'Sie haben vergessen Ihren Namen einzugeben!';
 *$se_text['needrecipientsname'] = 'Sie haben vergessen den Namen des Empfängers einzugeben!';
 */
?>

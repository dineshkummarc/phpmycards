<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * en.inc.php: english language file
 *
 * If you need to adjust texts to your web site, please create the file 
 * en.custom.php (in the same directory as this file) and copy the variables
 * to change there. This will avoid to loose changes on updates.
 *
 * But please send error corrections to dbu@users.sourceforge.net
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
 * $Id: en.inc.php 10 2007-02-02 12:33:12Z dbu $
 */

/* common */
$se_text['error_configuration'] = 'Configuration Error';
$se_text['fielderror'] = 'The following error(s) occured:';

/* postcard sending interface */
$se_text['header_choose'] = '';
$se_text['header_write'] = '';

$se_text['yourname'] = 'Your name:';
$se_text['yourmail'] = 'Your email:';
$se_text['recipientsname'] = "The recipient's name:";
$se_text['recipientsmail'] = "The recipient's email:";
$se_text['recipient_more'] = 'More recipients';
$se_text['recipient_more_hint'] = 'Enter several target email addresses (separated by newline or comma)';
$se_text['entermessage'] = 'Your message:';
$se_text['send'] = 'Send';

$se_text['error_noimages'] = 'The directory for the postcards pictures is empty (exactly: there are no files named *_tn.*). It is not possible to send cards.';
$se_text['error_nopic'] = 'No picture selected.';
$se_text['error_nomessage'] = 'You need to enter a message.';
$se_text['error_invalidemail_from'] = "The sender's email is incorrect.";
$se_text['error_invalidemail_to'] = "The recipient's email is incorrect.";
$se_text['error_toomanyadresses'] = 'You can not send cards to so many recipients in the same time.';

/* postcard viewing interface */
$se_text['header_show'] = 'You recived the following postcard';
$se_text['show_from'] = 'From:';
$se_text['show_to'] = 'To:';
$se_text['show_message'] = 'Message:';
$se_text['show_answer'] = 'Reply';
$se_text['error_nosession'] = 'You are not allowed to view this card.';
$se_text['error_missingparams'] = 'Invalid URL. If your email program wrapped the link onto several lines, please append the parts.';

/* postcard sending */
$se_text['header_send'] = 'Your postcard has been sent';
$se_text['header_send_failed'] = 'Failed sending postcard';

$se_text['newmessage'] = 'New message';
/** confirmation message for web interface. */
$se_text['send_ok'] = 'Postcard successfully sent.<br />
<a href="%url%">View the card</a>';

/* email message */
/** subject for email */
$se_text['mail_subject'] = 'An E-Card for you';
/** message for text body of email 
 * %url% will be replaced with the url to retreive the postcard.
 * %name_from%, %email_from%, %name_to%, %email_to% and %message% will be 
 * replaced with the appropriate values.
 */
$se_text['mail_message'] = 'You got a postcard from %name_from% <%email_from%>

To view your card, please surf to::
%url%

(If you can not click on the link, copy the URL with CTRL+C
and paste it into your browser using CTRL+V)
';
/** Used in the HTML mail, if enabled.
 * The message for html body of email (if $simplecard['send_html'] is true)
 * is created using the specified template and replacing the placeholders.
 */
$se_text['show_web'] = 'If this message is not displayed properly, please follow this link.';

/*		
$needyourname = "- You need to enter your name!";		 				
$needrecipientsname = "- You need to enter the recipient's name!";
$back = "Back";
*/

?>

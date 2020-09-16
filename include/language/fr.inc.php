<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * fr.inc.php: french language file
 * Formul� pour le poli "Vous".
 *
 * Si vous voulez adapter des phrases, cr�ez un fichier fr.custom.php et copiez
 * les variables correspondant l�. Ainsi vous �vitez de perdre les changements
 * lors d'un update de simplEcard.
 * Si vous trouvez des erreurs � corriger, veuillez m'envoyer un email � dbu@users.sourceforge.net
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
 * $Id: fr.inc.php 8 2006-12-18 17:20:12Z dbu $
 */

/* common */
$se_text['error_configuration'] = "Erreur dans la configuration.";
$se_text['fielderror'] = "Les erreurs suivantes ont survenu:";

/* postcard sending interface */
$se_text['header_choose'] = 'Choisissez une image';
$se_text['header_write'] = 'Envoyez votre carte postale';

$se_text['yourname'] = "Votre nom:";
$se_text['yourmail'] = "Votre email:";
$se_text['recipientsname'] = "Nom du destinataire:";
$se_text['recipientsmail'] = "Email du destinataire:";
$se_text['recipient_more'] = 'Plusieurs destinataires';
$se_text['recipient_more_hint'] = 'Entrer plusieurs adresses email (s�par� par des virgules)';
$se_text['entermessage'] = "Votre message:";
$se_text['send'] = "Envoyer";

$se_text['error_noimages'] = "Le directoire des images pour les cartes postales ne contient pas des donn�es. (En tout cas pas en format *_tn.*). C'est impossible d'envoyer des cartes.";
$se_text['error_nopic'] = "Vous n'avez pas choisit une image.";
$se_text['error_nomessage'] = "Vous n'avez pas entr� une message.";
$se_text['error_invalidemail_from'] = "Votre email n'est pas valide.";
$se_text['error_invalidemail_to'] = "L'email du destinataire n'est pas valide.";
$se_text['error_toomanyadresses'] = 'Sie k�nnen nicht an so viele Empf�nger gleichzeitig Emails versenden.';

/* postcard viewing interface */
$se_text['header_show'] = "Vous avez re�u la carte postale suivante";
$se_text['show_from'] = "De:";
$se_text['show_to'] = "Pour:";
$se_text['show_message'] = "Message:";
$se_text['show_answer'] = "R�pondre";
$se_text['error_nosession'] = "Vous n'avez pas le droit d'acceder cette carte postale.";
$se_text['error_missingparams'] = "La URL n'est pas valid. Si votre programme de messagerie a r�align� le lien sur plusieurs lignes, veulliez l'assembler.";


/* postcard sending */
$se_text['header_send'] = 'Votre carte postale a �t� envoy�';
$se_text['header_send_failed'] = 'Probl�me � envoyer votre carte postale';

$se_text['newmessage'] = "Nouveau message";

/** confirmation message for web interface. */
$se_text['send_ok'] = 'L\'envoi a �t� effectu� avec succ�s.<br />
<a href="%url%">Regarder la carte</a>';

/* email message */
/** subject for email */
$se_text['mail_subject'] = "Une E-Card pour vous";
/** message for text body of email 
 * %url% will be replaced with the url to retreive the postcard.
 * %name_from%, %email_from%, %name_to%, %email_to% and %message% will be 
 * replaced with the appropriate values.
 */
$se_text['mail_message'] = "Vous avez re�u une carte postale de %name_from% <%email_from%>

Pour d�consigner votre carte, veulliez visiter l'adresse:
%url%

(Si vous ne pouvez pas cliquer se lien, veuillez le copier avec Ctrl+C et l'inserer avec Ctrl+V dans la bar d'adresse de votre browser.)
";
/** Used in the HTML mail, if enabled.
 * The message for html body of email (if $simplecard['send_html'] is true)
 * is created using the specified template and replacing the placeholders.
 */
$se_text['show_web'] = "Si ce message n'est pas pr�sent� proprement, veuillez suivre ce lien.";

?>
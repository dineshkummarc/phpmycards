<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * show.inc.php: Display a card.
 * Display an e-card to the user, based on the personal link mailed after 
 * sending cards. The layout is taken from the template specified in $simplecard['postcard_template']
 *
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
 * $Id: show.inc.php 2 2006-12-13 19:22:38Z dbu $
 */

/** Get a layoutet card.
 * The request has to define 
 * card: the card number
 * session: the unique session ID
 * @return HTML code for the card or for the error message.
 */
function simplecard_show() {
  global $simplecard, $se_text;

  $simplecard['header'] = $se_text['header_show'];

  if (! isset($_REQUEST['card']) || ! isset($_REQUEST['session'])) {
    return "<h1>${se_text['header_show']}</h1><div class=\"error\">${se_text['error_missingparams']}</div>";
  }
  
  $card = simplecard_load($_REQUEST['card'], $_REQUEST['session']);
  if (! is_array($card)) {
    return "<h1>${se_text['header_show']}</h1><div class=\"error\">$card</div>";
  }

  $msg = "<h1>${se_text['header_show']}</h1>";

  $msg .= get_postcard_html($simplecard['images_directory'].'/'.$card['picture'], null, $card['message'],
			    htmlentities($card['name_from']), htmlentities($card['email_from']),
			    htmlentities($card['name_to']), htmlentities($card['email_to']));

  return $msg;
}
?>

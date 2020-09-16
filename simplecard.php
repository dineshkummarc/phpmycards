<?php 
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * simplecard.php: Main script to generate content.
 * Used to include simplecard.php in other scripts. Include the script and
 * call simplecard() afterwards, which will return a HTML formatted string
 * containing the simplEcard output for the current request.
 *
 * Send a card by Email, based on the information entered into the form.
 * See README.txt to learn how to configure simplEcard.
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
 * $Id: simplecard.php 5 2006-12-18 16:56:07Z dbu $
 */

require_once('config.default.php'); //configuration, will also include options.custom.php
require_once('include/common.inc.php'); //common functions
simplecard_language(); //language definitions
require_once("include/db/${simplecard['database']}.inc.php"); //database for ecard storage
require_once('include/phpmailer/class.phpmailer.php'); //mailer class (used for write action)

/** Main entry point.
 * @return The HTML string corresponding to the current action.
 */
function simplecard() {
  global $simplecard;

  if (!isset($_REQUEST['action'])) $_REQUEST['action']='write';

  if (! isset($simplecard['url']))
    $simplecard['url'] = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://').
      $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'] . '?';

  $body = '<div class="simplecard">';

  switch($_REQUEST['action']) {
  case 'write':
    require('include/write.inc.php');
    $body .= simplecard_write();
    break;
  case 'send':
    require('include/send.inc.php');
    $body .= simplecard_send();
    break;
  case 'show':
    require('include/show.inc.php');
    $body .= simplecard_show();
    break;
  case 'admin':
    require('include/admin.inc.php');
    $body .= simplecard_admin();
  default:
    $simplecard['header'] = 'Error';
    $body .= '<div class="error">'.$se_text['error_configuration'].
      '<br />Invalid action '.$_REQUEST['action'].'</div>';
  }

  return $body . 
    file_get_contents('banner.inc.htm').
    '</div>';
}

?>

<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * common.inc.php: Common functions to be used in various places.
 *
 * -> This application is partially based on phpPowerCards 2.0 by Marc Giombetti <marc@giombetti.com>
 * Please visit the simplEcard webiste to get further information and updates.
 * http://simplecard.sourceforge.net | David Buchmann <dbu@users.sourceforge.net>
 *******************************************************************************
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
 * $Id: common.inc.php 9 2007-02-02 12:11:16Z dbu $
 */


/* Clean up request: Remove magic quotes, if the setting is enabled. */
if (get_magic_quotes_gpc()) {
  foreach($_REQUEST as $name => $value) 
    $_REQUEST[$name] = stripslashes($value);
}

function simplecard_language() {
  global $simplecard, $se_text;

  require_once("include/language/${simplecard['language']}.inc.php");
  /* Overwrite with custom language settings. */
  if (file_exists("include/language/${simplecard['language']}.custom.php"))
  include("include/language/${simplecard['language']}.custom.php");

  /* HTML encode all strings. */
  foreach($se_text as $field => $value) {
    if (strcmp($field, 'mail_message') &&
	strcmp($field, 'mail_subject') &&
	strcmp($field, 'send_ok'))
      $tmp[$field] = htmlentities($value); 
    else
      $tmp[$field] = $value;
  }
  $se_text = $tmp;
}


/** Load the postcard template and substitute placeholders.
 * @param image_location String for the src attribute of img element (either path or cid:imgid for Email)
 * @param url The url to show the card online (for email only. for web pass null)
 * @return The postcard html.
 */
function get_postcard_html($image_location, $url, $message, 
			   $name_from, $email_from, $name_to, $email_to) {

  global $se_text, $simplecard;

  //todo: choose template based on picture name?
  $htmlmessage = file_get_contents($simplecard['postcard_template'])
    or die('Could not read postcard template '.$template_path);

  $urlpart = $simplecard['url'].
    "action=write&amp;name_from=$name_to&amp;email_from=$email_to";


//todo: show_message for Message/Nachricht label
  $tokens = array('%image_location%', '%message%', 
		  '%show_from%', '%name_from%', '%email_from%',
		  '%show_to%', '%name_to%', '%email_to%', 
		  '%url_reply%', '%txt_reply%', '%url_new%', '%txt_new%',
		  '%show_web%', '%url%');
  $values = array($image_location, $message, 
		  $se_text['show_from'], $name_from, $email_from, 
		  $se_text['show_to'], $name_to, $email_to,
		  $urlpart."&amp;name_to=$name_from&amp;email_to=$email_from", $se_text['show_answer'],
		  $urlpart, $se_text['newmessage']); //show_web and url are decided below

  if ($url != null) {
    $values[] = $se_text['show_web'];
    $values[] = $url;
  } else {
    $values[] = '';
    $values[] = '';
  }
  return str_replace($tokens, $values, $htmlmessage);
}


/* Compatibility */

/**
 * In case mime_content_type function is missing (PHP <= 4.3)
 * You can add mime types if you use other formats.
 * The list is found http://www.duke.edu/websrv/file-extensions.html
 * (Remember: We use it for image attachment. So anything else than image/...
 *  is probably unnecessary.)
 */
if (!function_exists('mime_content_type')) {
  function mime_content_type($filename) {
    $mimetypes = 
      array('gif' =>'image/gif',
	    'jpe' =>'image/jpeg',
	    'jpeg' =>'image/jpeg',
	    'jpg' =>'image/jpeg',
	    'png' =>'image/png',
	    'tif' =>'image/tiff'
	    );
    $idx = strtolower(end( explode( '.', $filename )) );
    
    if (isset( $mimetypes[$idx] )) {
      return $mimetypes[$idx];
    } else {
      return 'application/octet-stream';
    }
  }
}
?>

<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * send.inc.php: Send out a card.
 * Send a card by Email, based on the information entered into the form.
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
 * $Id: send.inc.php 11 2007-02-02 12:34:53Z dbu $
 */

/** Send the card by email.
 * Expects the following values to be set in the _REQUEST
 *  email_to: Email address of the receiver
 *  name_to: Real name of the receiver
 *  email_from: Email address of the sender
 *  name_from: Real name of the sender
 *  picture: Filename of the image file to use, 
 *     relative to $simplecard['images_directory']
 *  message: The postcard text to use
 *
 * If an email address is invalid or anything except real names is missing, 
 * the simplecard_write() method is called with a list of error messages, which
 * will redisplay the form.
 *
 * If all data is present, it is stored using the selected database and an 
 * email is sent to the receiver.
 * If $simplecard['send_html'] is set to true, the card is sent as an email, 
 * including the picture as attachment. If send_html is false, only a 
 * notification text Email is sent, telling the user to surf to the website to 
 * see his card.
 * 
 * @return HTML fragment with confirmation or error message, or redisplays 
 *   write form.
 */
function simplecard_send() {
  global $simplecard, $se_text;

  $simplecard['header'] = $se_text['header_send'];

  $email_to = isset($_REQUEST['email_to']) ? $_REQUEST['email_to'] : null;
  $memail_to = $_REQUEST['memail_to'];
  $name_to = $_REQUEST['name_to'];
  $email_from = $_REQUEST['email_from'];
  $name_from = $_REQUEST['name_from'];
  $picture = isset($_REQUEST['picture']) ? $_REQUEST['picture'] : '';
  $message = $_REQUEST['message'];


  //validation
  $err = '';
  if (empty($email_to)) {
    //scan $memail_to text field for email addresses.
    $memail_to = strtolower($memail_to);
    $emails = array();
    preg_match_all("/[-_a-z0-9]+(\.[-_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+/", $memail_to, $emails);
    $emails = $emails[0]; //array of arrays, [1] is first sub-expression and so on
    $email_to = 'multiple recipients';
    if(count($emails)==0) {
      $err .= '<li>'.$se_text['error_invalidemail_to'].' (no entries)</li>';
      //todo: can we highlight the invalid fields?
    } else if (count($email) > $simplecard['multiaddresses']) {
      $err .= '<li>'.$se_text['error_toomanyadresses'];
    } else {
      foreach($emails as $email) {
	if(! check_email($email)) {
	  $err .= '<li>'.$se_text['error_invalidemail_to'].' &quot;'.$email.'&quot;</li>';
	  break;
	}
      }
    }
  } else {
    if (! check_email($email_to)) {
      $err .= '<li>'.$se_text['error_invalidemail_to'].'</li>';
    }
  }
  if (! check_email($email_from)) {
    $err .= '<li>'.$se_text['error_invalidemail_from'].'</li>';
  }
  if(! strcmp($picture, '')) {
    $err .= '<li>'.$se_text['error_nopic'].'</li>';
  }
  if (! strcmp($message, '')) {
    $err .= '<li>'.$se_text['error_nomessage'].'</li>';
  }

  //on error, redisplay write form
  if (strcmp($err, '')) {
    require_once('write.inc.php');
    return simplecard_write($err);
  }

  //data ok, we can send the card.

  //message must be htmlized for storage
  $message = htmlentities($message);
  $message = str_replace("\r\n", "\n", $message); //fix windows.
  $message = str_replace("\r", "\n", $message); //fix mac.
  $message = str_replace("\n", "<br />", $message); //encode newlines as html br


  $mailer = new PHPMailer();
  $mailer->SetLanguage($simplecard['language'], 'include/phpmailer/language/');
  switch($simplecard['mail']) {
  case 'mail':
    $mailer->isMail();
    break;
  case 'smtp':
    $mailer->isSMTP();
    $mailer->Host = $simplecard['mail_smtpserver'];
    break;
  case 'sendmail':
    $mailer->isSendmail();
    break;
  case 'qmail':
    $mailer->isQmail();
    break;
  default:
    die('Invalid mailer method: '.$simplecard['mail']);
  }  
  $mailer->From = $email_from;
  $mailer->FromName = $name_from;
  $mailer->Sender = $email_from;
  $mailer->Subject = $se_text['mail_subject'];
  $mailer->WordWrap = $simplecard['mail_wordwrap'];

  if ($simplecard['send_html']) {
    $imgpath = $simplecard['images_directory'].'/'.$picture;
    $mailer->AddEmbeddedImage($imgpath, 'imgid',$picture,'base64',mime_content_type($imgpath));
  }

  $se_text['mail_message'] = str_replace('%name_from%', $name_from, $se_text['mail_message']);
  $se_text['mail_message'] = str_replace('%email_from%', $email_from, $se_text['mail_message']);

  if (isset($emails)) {
    $result = '<ul>';
    foreach($emails as $anemail) {
      //name_to has hopefully been set by the user to something like "My Friends"
      $result .= '<li>'.simplecard_sendcard($mailer, $name_from, $email_from, $name_to, $anemail, $picture, $message).'</li>';
    }
    return $result .'</ul>';
  } else {
    return simplecard_sendcard($mailer, $name_from, $email_from, $name_to, $email_to, $picture, $message);
  }
}

/** Send out one card using the mailer (name_from/email_from have to be set already.)
 * Stores and sends the card.
 * Removes the receipients from the mailer before returning.
 * @access private
 */
function simplecard_sendcard($mailer, $name_from, $email_from, $name_to, $email_to, $picture, $message) {
  global $se_text, $simplecard;
  
  $sessionID = uniqid(rand());
  $cardnumber = simplecard_store($name_from, $email_from, $name_to, $email_to, $picture, $message, $sessionID);
  if (! is_numeric($cardnumber)) {
    return $cardnumber;
  }

  $url = $simplecard['url']."action=show&card=$cardnumber&session=$sessionID";

  $mailer->AddAddress($email_to, $name_to);
  
  //prepare the message
  $txt_body = str_replace('%url%', $url, $se_text['mail_message']);
  $txt_body = str_replace('%name_to%', $name_to, $txt_body);
  $txt_body = str_replace('%email_to%', $email_to, $txt_body);

  if ($simplecard['send_html']) {

    //The image inside the email is referenced as <img src="cid:imgid">
    //(cid tells the mail client to use an embedded image, imgid is the id we use for AddEmbeddedImage.)

    $htmlmessage = get_postcard_html('cid:imgid', htmlentities($url), $message, 
				     htmlentities($name_from), htmlentities($email_from),
				     htmlentities($name_to), htmlentities($email_to));

    $mailer->Body = $htmlmessage;
    $mailer->AltBody = $txt_body;
  } else {
    $mailer->Body = $txt_body;
  }

  if ($mailer->Send()) {
    $msg = "<h1>${se_text['header_send']}</h1>
           <p>".str_replace('%url%', $url, $se_text['send_ok']).'</p>
           <p><a href="'. $simplecard['url'].
    "action=write&name_from=$name_from&email_from=$email_from\">".
      $se_text['newmessage'].'</a></p>';
  } else {
    $msg = "<h1>${se_text['header_send_failed']}</h1>
            <div class=\"error\"><h3>${se_text['fielderror']}</h3><ul>".$mailer->ErrorInfo."</ul></div>";
  }
  $mailer->ClearAddresses();
  return $msg;
}

/** Returns true if valid email, false otherwise */
function check_email($candidate) {
  return preg_match("/^[-_a-z0-9]+(\.[-_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/", strtolower($candidate))==1; //todo: can emails contain .. ?
}

?>

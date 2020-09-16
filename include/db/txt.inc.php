<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * txt.inc.php: txt database implementation: inserting data to the text file
 * Uses a naive text file approach to store the messages.
 * Simple to install, but does not scale well.
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
 * $Id: txt.inc.php 2 2006-12-13 19:22:38Z dbu $
 */


/** Store the information for one card.
 * @return The identification number for this card if success, string error message on failure.
 */
function simplecard_store($name_from, $email_from, $name_to, $email_to, $picture, $message, $sessionID) {
  global $simplecard, $se_text;

  $message = eregi_replace("¦"," ",$message); //kicks out any ¦ might present in the message. do we care?

  if (! $fp = @fopen($simplecard['datafile'],"a"))
    return $se_text['error_configuration'] . " (Could not open ${simplecard['datafile']})";
  fputs($fp, $name_from.'¦¦'.$email_from.'¦¦'.$name_to.'¦¦'.$email_to.'¦¦'.$picture.'¦¦'.$message.'¦¦'.$sessionID."\n");
  $cardnumber = count(file($simplecard['datafile'])) - 1;
  fclose($fp);

  return $cardnumber;
}

/** Load the information of a card.
 * The card is only retreived if the sessionID is correct.
 *
 * @return an array with the fields name_from, email_from, name_to, email_to, picture, message or an error string.
 */
function simplecard_load($number, $sessionID) {
  global $simplecard, $se_text;

  $strings = file($simplecard['datafile']);
  
  if (count($strings) <= $number)
    return $se_text['error_nosession'];// .' (Number too large.)';

  $ret = simplecard_build_array($strings[$number]);

  if (strcmp($sessionID, $ret['sessionID'])==0) {
    return $ret;
  } else {
    return $se_text['error_nosession'];// . ' (Invalid session ID)';
  }
}

/** Get an array with $count entries, the last entry being at pos $last.
 */
function simplecard_admin($first, $last) {
  $datapre = file($simplecard['datafile']) 
    or die('Could not open datafile');;
  $rowcount = count($datapre);
  if (strcmp($last, 'ALL') && $last < $rowcount) {
    for($i = $last; $i<$rowcount; $i++) unset($datapre[$i]);
  }
  for($i = 0; $i < $first; $i++) unset($datapre[$i]);

  foreach($datapre as $id => $line) {
    $datapre[$id] = simplecard_build_array($datapre[$id]);
  }
  return $datapre;
}

/**
 * @access: Private
 */
function simplecard_build_array($line) {
  $data = explode ("¦¦", $line);

  $ret['name_from']=$data[0];
  $ret['email_from']=$data[1];
  $ret['name_to']=$data[2];
  $ret['email_to']=$data[3];
  $ret['picture']=$data[4];
  $ret['message']=$data[5];
  $ret['sessionID']=chop($data[6]); //cut trailing newline
  return $ret;
}

?>

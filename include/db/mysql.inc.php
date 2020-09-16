<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * mysql.inc.php: mysql database implementation: inserting data to the database
 * Uses a mysql table to store the messages.
 * A bit more work to install, but scales much better for heavy usage.
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
 * $Id: mysql.inc.php 2 2006-12-13 19:22:38Z dbu $
 */


/** Store the information for one card.
 * @return The identification number for this card if success, string error message on failure.
 */
function simplecard_store($name_from, $email_from, $name_to, $email_to, $picture, $message, $sessionID) {
  $conn = simplecard_dbconnect();
  if (is_string($conn)) {
    return $conn;
  }

  $name_from = mysql_real_escape_string($name_from);
  $email_from = mysql_real_escape_string($email_from);
  $name_to = mysql_real_escape_string($name_to);
  $email_to = mysql_real_escape_string($email_to);
  $picture = mysql_real_escape_string($picture);
  $message = mysql_real_escape_string($message);

  //writing data into the table
  $insert = "INSERT into ${simplecard['table']}(namefrom, emailfrom, nameto, emailto, picture, comment, sessionID, seencard) ";
  $insert .="VALUES ('$name_from', '$email_from', '$name_to', '$email_to', '$picture',";
  $insert .="'$message', '$sessionID', false)";
 
  if(mysql_query($insert, $conn)) {
    $result = mysql_insert_id($conn);
  }else{
    $result = mysql_error($conn);
  }
  mysql_close($conn);
  return $result;
}

/** Load the information of a card.
 * The card is only retreived if the sessionID is correct.
 *
 * @return an array with the fields name_from, email_from, name_to, email_to, picture, message or an error string.
 */
function simplecard_load($number, $sessionID) {
  $conn = simplecard_dbconnect();
  if (is_string($conn)) {
    return $conn;
  }
  /* sessionID and number come from request, clean them. */
  $sessionID = mysql_real_escape_string($sessionID);
  $number = mysql_real_escape_string($number);

  $select = "SELECT namefrom, emailfrom, nameto, emailto, picture, comment, seencard FROM $table ";
  $select .= "FROM ${simplecard['table']} WHERE sessionID = '$sessionID' AND id=$number;";
  $result = mysql_query($select, $conn);
  if (! $result) {
    $ret = mysql_error($conn);
  } else if (mysql_num_rows($result)!=1) {
    return $se_text['error_nosession'];// . ' (Wrong number of result lines. Probably session id is wrong...)';
  } else {
    $row = mysql_fetch_row($result);
    $ret['name_from']=$data[0];
    $ret['email_from']=$data[1];
    $ret['name_to']=$data[2];
    $ret['email_to']=$data[3];
    $ret['picture']=$data[4];
    $ret['message']=$data[5];
    //seencard is not used for now
  }
  mysql_close($conn);
  return $ret; 
}

/**
 * Connect to the database using the parameters from the configuration file.
 * @return Database connection or an error message string.
 *
 * @access: Private
 */
function simplecard_dbconnect() {
  global $simplecard;

  $conn = mysql_connect($simplecard['dbhost'],$simplecard['user'],$simplecard['password']);
  if($conn){
    //select database
    if(! mysql_select_db($simplecard['db'], $conn)) {
      //database not found
      $err = mysql_error($conn);
      mysql_close($conn);
      return $err;
    }
  } else {
    //could not connect
    return mysql_error($conn);
  }
  return $conn;
}
 
?>
<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * options.default.php: Default settings for simplEcard
 * -> DO NEVER EDIT THIS FILE, IT WILL BE OVERWRITTEN WITH EACH UPDATE! <-
 * Rather create a file options.custom.php and copy the settings you need to 
 * change there.
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
 * $Id: config.default.php 9 2007-02-02 12:11:16Z dbu $
 *
 * -> DO NEVER EDIT THIS FILE, IT WILL BE OVERWRITTEN WITH EACH UPDATE! <-
 * Rather create a file options.custom.php and copy the settings you need to 
 * change there.
 */

/*** Language selection ***
 *
 * en = english
 * fr = francais
 * lux = luxemburgish
 * de = Deutsch in Hoeflichkeitsform (Sie)
 */
$simplecard['language'] = "en";


/*** Database selection ***
 * Available are
 *  txt: Text file. Very simple, but does not scale well.
 *  mysql: MySQL database. Very scalable, database has to be prepared.
 */

/* txt database */
$simplecard['database'] = "txt";
/* Data file
 * NOTE: Either make sure the .htaccess file is forbidding http access to postcard.txt
 *   or place the file outside of your web root and change the path below.
 * NOTE: Usually, this file has to be writable by anybody (chmod a+w) for the web server to be able to write entries.
 */ 
$simplecard['datafile'] = "postcard.txt";

/* MySQL database (uncomment to use mysql)*/
/* 
 $simplecard['database'] = "mysql";
 $simplecard['dbhost'] = "localhost";
 $simplecard['user'] = "root";
 $simplecard['password'] = "";
 $simplecard['db'] = "simplecard";
 $simplecard['table'] = "simplecard";
*/


/*** Tweaking ***/

/* Style */
$simplecard['cssfile'] = "templates/default.css";
/* Postcard Layout */
$simplecard['postcard_template'] = "templates/default_postcard.htm";

/* Number of columns for the pictures (after which a new row is started. 
 * Beware: If your images do not all have the same width, it might look a bit funny.
 */
$simplecard['picture_columns'] = 6;

/* How the emails are sent */
/**
 * Whether to send html mails with embedded images.
 * If this is set to true, the selected picture is embedded into the mail.
 * Non-Html mail readers still get the text version with a link to your web site.
 * If it is false, only the text mail with link is sent.
 */
$simplecard['send_html'] = true;

/**
 * Which method to use for sending emails. 
 * Possible values are
 * - mail: Use the php mail function
 * - smtp: Use an smtp server
 * - sendmail: Call the sendmail system command
 * - qmail: Call the qmail system command
 * 
 * If you have to further tweak the smtp behaviour (authentication and so on),
 * please take a look at phpmailer/class.phpmailer.php
 */
$simplecard['mail'] = 'mail';
/* For mail method smtp, uncomment this and set it to your smtp server */
//$simplecard['mail_smtpserver'] = 'localhost';
/** Wrap words in text mail after 80 characters. Set to 0 to disable. */
$simplecard['mail_wordwrap'] = '80';

/**
 * Maximum number for several addresses.
 */
$simplecard['multiaddresses'] = 50;

/** Images directory 
 * Specify directory where the postcards are found. 
 *
 * For now, the directory has to be prepared by hand:
 * The expected format in the dir is having each picture as picture.jpg [the picture]
 * and picture_tn.jpg [a preview]
 * (other images than jpg, i.e. gif or png are ok too)
 *
 * If there is no preview, the image can not be selected to be sent.
 */
$simplecard['images_directory'] = "pictures";

/** Set the scripts own URL.
 * Usually, the script can determine its url correctly. However, you can specify it here.
 * (This is typically necessary when embedding simplecard into an other script.)
 * Do not forget to add a ? at the end, for the parameters will be appended.
 */
//$simplecard['url'] = "http://www.yourhost.net/ecards/?";


/*** Administrator password ***
 * Note: Administration is currently broken.
 */
$simplecard['adminpassword'] = "change";


/* -> DO NEVER EDIT THIS FILE, IT WILL BE OVERWRITTEN WITH EACH UPDATE! <-
 * Rather create a file options.custom.php and copy the settings you need to 
 * change there.
 */

/** Include options.custom.php if existing, to let user
 * define his configuration.
 */
if (file_exists('config.custom.php')) 
  include('config.custom.php');
?>

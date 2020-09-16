<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * write.inc.php: Provide the form to select picture and write E-Card.
 *
 *   
 * -> This application is partially based on phpPowerCards 2.0 by Marc Giombetti <marc@giombetti.com>
 * Please visit the simplEcard webiste to get further information and updates.
 * http://simplecard.sourceforge.net | David Buchmann <dbu@users.sourceforge.net>
 ********************************************************************************
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
 * $Id: write.inc.php 7 2006-12-18 17:18:11Z dbu $
 */

/** 
 * Show the form to write a card.
 * If the following fields are found in the $_REQUEST, the according inputs 
 * display them as default: name_from, email_from, name_to, email_to, message, picture
 * If the $err parameter is set, the error is shown above the form.
 * @return HTML fragment for writing postcard.
 */
function simplecard_write($err=false) {
  global $simplecard, $se_text;
  
  $simplecard['header'] = $se_text['header_write'];

  //javascript to replace the images and show email field
  //todo: copy the email field content to the textfield and empty the email field.
  $msg = '<script type="text/javascript">
   // <![CDATA[
   function setCard(card, extension) {
     var img = document.getElementById(\'card\');
     img.src = \''.$simplecard['images_directory'].'/\'+card+\'.\'+extension;
     var inputradio = document.getElementById(card);
     if (! inputradio.selected) inputradio.click();
   }
   function showMemail() {
     var e = document.getElementById(\'email_to\');
     var m = document.getElementById(\'memail_to\');
     var l = document.getElementById(\'lemail_to\');
     m.text = e.text;
     e.text = \'\';
     m.style.display = \'block\';
     e.style.display = \'none\';
     l.style.display = \'none\';
   }
  // ]]>
  </script>';
  
  //display error message, if any
  if ($err !== false) {
    $msg .= "<div class=\"error\"><h3>${se_text['fielderror']}</h3><ul>$err</ul></div>";
  }
    
  //build form
  $msg .= '<form name="form" method="post" action="'.$simplecard['url'].'action=send">';
  
$msg .= simplecard_choose();
  
  $msg .= "<h2>${se_text['header_write']}</h2>";

  if (! isset($simplecard['picture_selected'])) {
    $simplecard['picture_selected'] = 'img/unknown.jpg';
  }
  $msg .= '<table class="ecard"><tr><td rowspan="4" valign="top"><img id="card" alt="Postcard Picture" src="'.$simplecard['picture_selected'].'" /></td><td>';
  $msg .= $se_text['recipientsname'];
  $msg .= '<br />
            <input type="TEXT" size="20" name="name_to"'.
    (isset($_REQUEST['name_to']) ? ' value="'.htmlentities($_REQUEST['name_to']).'"' : '').
         ' />
         </td><td>';
  $msg .= $se_text['recipientsmail'].'<br />';

  if (isset($_REQUEST['memail_to']) && 
      strcmp(htmlentities($_REQUEST['memail_to']), $se_text['recipient_more_hint'])) {
    $msg .= '<textarea style="width:178px;" id="memail_to" name="memail_to" cols="22" rows="5">'.
      $_REQUEST['memail_to'].
      '</textarea><br />';
  } else {
    $msg .= '<input type="TEXT" size="20" name="email_to" id="email_to" '.
      (isset($_REQUEST['email_to']) ? 'value="'.htmlentities($_REQUEST['email_to']).'"' : '').
      '>
       <textarea style="display:none;width:178px;" id="memail_to" name="memail_to" cols="22" rows="5">'.
       $se_text['recipient_more_hint'] .
      '</textarea><br />
       <a id="lemail_to" href="javascript:showMemail();" title="'.
      $se_text['recipient_more_hint'].'">'.$se_text['recipient_more'].'</a>';
  }
   $msg .= '</td>
      </tr><tr> 
          <td>';
  $msg .= $se_text['yourname'];
  $msg .= '<br />
            <input type="TEXT" size="20" name="name_from" '.
    (isset($_REQUEST['name_from']) ? 'value="'.htmlentities($_REQUEST['name_from']).'"' : '').
         '>
          </td><td>';
  $msg .= $se_text['yourmail'];
  $msg .= '<br />
            <input type="TEXT" size="20" name="email_from" '.
    (isset($_REQUEST['email_from']) ? 'value="'.htmlentities($_REQUEST['email_from']).'"' : '').
         '>
          </td>
        </tr><tr> 
          <td colspan="2">';
  $msg .= $se_text['entermessage'];
  $msg .= '<br /><textarea name="message" cols="50" rows="9">'.
          (isset($_REQUEST['message']) ? htmlentities($_REQUEST['message']) : '').
          '</textarea>
          </td>
        </tr>
        <tr> 
          <td colspan="2">
            <input type="SUBMIT" name="L&ouml;schen" value="'.$se_text['send'].'">
          </td>
        </tr>
      </table>
    </form>';
  return $msg;

}

/** Create the form part to select the right picture. */
function simplecard_choose() {
  global $simplecard, $se_text;

  $ret = "<h2>${se_text['header_choose']}</h2>";

  $cards = list_files($simplecard['images_directory'], "/\_tn\./");
  if (count($cards)==0)
    return $ret.'<div class="error">'.$se_text['error_noimages'].'</div>';

  $ret .= '<table class="choose"><tr>';
  $count = 0;

  foreach($cards as $card) {
    list($cardname, $extension) = preg_split("/\_tn\./", $card); //the first part of the split is the base name
    $picture = "$cardname.$extension";
    $selected = isset($_REQUEST['picture']) && ! strcmp($_REQUEST['picture'], $picture);
    if ($selected) $simplecard['picture_selected'] = $simplecard['images_directory'].'/'.$picture;
    $javascript = "javascript:setCard('$cardname', '$extension')";
    $ret .= "<td valign=\"bottom\"><a href=\"$javascript\"><img src=\"${simplecard['images_directory']}/$card\" border=\"0\" alt=\"$cardname\" /></a><br />
          <input id=\"$cardname\" type=\"radio\" name=\"picture\" value=\"$picture\" onClick=\"$javascript\" ".
      ($selected ? 'checked="checked"' : '') .
      "/><a href=\"$javascript\" class=\"cardname\">".strtr($cardname,"_", " ")."</a></td>";
    if (++$count % $simplecard['picture_columns'] == 0) $ret .= '</tr><tr>';
  }
  return $ret . '</tr></table>';
}

/** Returns a list of the files in the directory. */
function list_files($directory, $exp) {
  $result = array();
  if (! $directoryHandler = @opendir ($directory)) {
    die("Directory $directory not found");
  }
  while (false !== ($fileName = @readdir ($directoryHandler))) {
    if(preg_match($exp, $fileName)) {
      @array_push ($result, $fileName);
    }
  }
  sort ($result);
  return $result;
}

?>

<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * admin.inc.php: Administrate settings and sent E-Cards.
 * todo: implement
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
 * $Id: admin.inc.php 2 2006-12-13 19:22:38Z dbu $
 */



//number of rows to show as default in the admin panel
$stsel = "25";


//bg color for tables in the admin script
$hadcolor = "#999999";
$adcolor = "#E7CEB6";


function simplecard_admin() {
  global $simplecard;
  $simplecard['header'] = 'simplEcard Administration';

  $crypted_admin = base64_encode($simplecard['adminpassword']);

  if(isset($_REQUEST['pass']) &&
     (! strcmp($_REQUEST['pass'], $simplecard['adminpassword']) || 
      ! strcmp($_REQUEST['cpass'], $crypted_admin))) {

    require_once('db/'.$simplecard['database'].'.inc.php');

    $msg = '<p>The database is: '.$simplecard['database'].'</p>';


  //checks how many rows to show

  if(!isset($_REQUEST['selection'])){
	$sel = "$stsel";
  } else {
	if($selection == "ALL"){
	  $sel = "$rows";
	}else{
	  $sel = "$selection";
	}
  
  
  todo: clean up  

if($database == "mysql"){ 
/*starting mysql content */ ?>
<br>
<br>
</span>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
<tr> 
    <td width="35" class="bignewgray" bgcolor="<?php echo"$hadcolor";?>">
      <div align="center"><b>[ID]</b></div>
    </td>
	 <td width="10" class="bignewgray" bgcolor="<?php echo"$hadcolor";?>">
      <div align="center"><b>[?]</b></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$hadcolor"; ?>">
      <div align="center"><b>[Sender's name]</b></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$hadcolor"; ?>">
      <div align="center"><b>[Receipient's name]</b></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$hadcolor"; ?>">
      <div align="center"><b>[Comment]</b></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$hadcolor"; ?>">
      <div align="center"><b>[Options]</b></div>
    </td>
  </tr>

<?php
if($database == "mysql") {
	$conn = mysql_connect($dbhost,$user,$password);
if($conn){
	//selecting table
	$conn = mysql_select_db($db, $conn);

//how many rows are there???
$rows = "SELECT * from $table";
$rows = mysql_query($rows);
$rows = mysql_num_rows($rows);


//checks how many rows to show
if(!isset($selection)){
	$sel = "$stsel";
}else{
	if($selection == "ALL"){
	$sel = "$rows";
	}else{
	$sel = "$selection";
	}
}
for($i=$rows-$show;$i > $rows - $sel -$show ;$i--){
$selectionquery = "SELECT * FROM $table WHERE ID = $i";
$values = mysql_query($selectionquery);
if($values)
	{
$data = mysql_fetch_row($values);
if(empty($data)){break;}
if($data[8] == "true"){
$seencolor = "#33CC33";
}else{
$seencolor = "#CC0000";
}
/*and here */

	} ?>
<tr> 
    <td width="35" class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"$data[0]"; ?></div>
    </td>
		 <td width="10" class="bignewgray" bgcolor="<?php echo"$seencolor";?>">
      <div align="center"><b></b></div>
    </td>
    <td width="170" class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"<a href=\"mailto:$data[2]\" class=\"bignewgray\">$data[4]</a>"; ?></div>
    </td>
    <td width="170" class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"<a href=\"mailto:$data[1]\" class=\"bignewgray\">$data[3]</a>"; ?></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"$data[6]"; ?></div>
    </td>
    <td  width="130" class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"<a href=\"$script_location$data[0]&mode=admin&session=$data[7]\" class=\"bignewgray\"  target=\"_blank\">See this card</a>";?></div>
    </td>
  </tr>
<?php
  }/*endif */
 }/*endif */
 	echo"</table><br>";

	echo"<p class=\"bignewgray\"><center><b>[?]</b> Shows if the receipient has already seen the card (green = seen / red = not seen)</center></p>";
	echo""
	?>
<b>
<?php 
	if($selection !== "ALL" && $rows > $sel){ ?>
		<br><center><p class="bignewgray">Page</b> 
<?php	
		echo"<a href=\"$PHP_SELF?cpass=$cpass&selection=$sel&show=0\" class=\"bignewgray\">[1]</a>";
	$lx = 1;


for($x=0;$x <= $rows;){
	//the page number
	$x = $lx++;
	//the show value
	$x=$x+$sel;
	$mult = $lx*$sel;
//

//$show = $x-1 ;
$show = $lx*$sel-$sel;
if($mult-$sel < $rows){
	echo "<a href=\"$PHP_SELF?cpass=$cpass&selection=$sel&show=$show\" class=\"bignewgray\">[$lx]</a>";
}
}

?>
</p><br></p></center>
		

<?php } ?>
<center><form name="form" method="post" action="<?php echo"$PHP_SELF"; ?>">
  <div align="center">
    <select name="selection">
      <option value="<?php echo"$stsel"; ?>" selected>Show Cards</option>
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="ALL">ALL</option>
    </select>
   <input type="hidden" name="pass" value="<?php echo"$pass"; ?>">
    <input type="submit" name="GO" value="GO">
  </div>
</form></center></b>
<?php
}/*endif - connection*/

include("banner.inc.php");

//ending mysql content

//chosing content
}
elseif($database == "txt"){?>
}
?>
	<br>
<br>
</span>
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center"> 
<tr> 
    <td width="35" class="bignewgray" bgcolor="<?php echo"$hadcolor";?>">
      <div align="center"><b>[ID]</b></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$hadcolor"; ?>">
      <div align="center"><b>[Sender's name]</b></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$hadcolor"; ?>">
      <div align="center"><b>[Receipient's name]</b></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$hadcolor"; ?>">
      <div align="center"><b>[Comment]</b></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$hadcolor"; ?>">
      <div align="center"><b>[Options]</b></div>
    </td>
  </tr>
<?php
//echo"$rows<br>";
	for($q=$rows-$show-1;$q >= $rows-$sel-$show;$q--){
	//for($q=$rows;$q = $q;$q--){
	$data = explode("¦¦",$datapre[$q]);
	if(empty($data[6])){break;}
	
?>
<tr> 
    <td width="35" class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"$q"; ?></div>
    </td>

    <td width="170" class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"<a href=\"mailto:$data[1]\" class=\"bignewgray\">$data[3]</a>"; ?></div>
    </td>
    <td width="170" class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"<a href=\"mailto:$data[0]\" class=\"bignewgray\">$data[2]</a>"; ?></div>
    </td>
    <td class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"$data[5]"; ?></div>
    </td>
    <td  width="130" class="bignewgray" bgcolor="<?php echo"$adcolor"; ?>"> 
      <div align="center"><?php echo"<a href=\"$script_location$q&session=$data[6]\" class=\"bignewgray\"  target=\"_blank\">See this card</a>";?></div>
    </td>
  </tr>

<?php 
}
echo"</table>"; ?>



<br><br><center><form name="form" method="post" action="<?php echo"$PHP_SELF"; ?>">
  <div align="center">
    <select name="selection">
      <option value="<?php echo"$stsel"; ?>" selected>Show Cards</option>
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="ALL">ALL</option>
    </select>
   <input type="hidden" name="pass" value="<?php echo"$pass"; ?>">
    <input type="submit" name="GO" value="GO">
  </div>
</form></center></b><br>
	<?php if($selection !== "ALL" && $rows > $sel){ ?>
	<center><p class="bignewgray"><b>Page</b>

<?php
		echo"<a href=\"$PHP_SELF?cpass=$cpass&selection=$sel&show=0\" class=\"bignewgray\">[1]</a>";

$lx = 1;
for($z=0;$z <= $rows;){	
$z = $lx++;
//the show value
	$z=$z+$sel;
	$mult = $lx*$sel;
	//
$show = $lx*$sel-$sel;
if($mult-$sel < $rows){
	echo "<a href=\"$PHP_SELF?cpass=$cpass&selection=$sel&show=$show\" class=\"bignewgray\">[$lx]</a>";
}
}
}
?>
</p>
<?php
	include("banner.inc.php");
 }//end else for txt content

}//check value to see the include site


  } else {
    //login form
    return '<table class="admin"><tr> 
          <th>phpPowerCards 2.0 - Login</th>
        </tr> 
        <tr>
          <td style="height:120px; text-align:center;">
            <form name="form1" method="post" action="'.$simplecard['url'].'action=admin">
                <input type="password" name="pass">
                <input type="submit" name="Submit2" value="Login">
            </form>
          </td>
        </tr>
        <tr> 
          <th>Please enter your Password</th>
        </tr>
      </table>
    </td>
  </tr>
</table>';
  }
}

?>

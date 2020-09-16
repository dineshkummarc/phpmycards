<?php
die('fixme: reformat');

//luxemburgish language file

//postcard sending interface
$header = "{Verschéck deng Postcard:}";
$yourname = "Däin Numm:";
$yourmail = "Deng Email";
$recipientsname = "Dem Empfänger säin Numm:";
$recipientsmail = "Dem Empfänger seng Email";
$entermessage = "Gef däin Message hei an:"; 								
$needyourname = "- Du hues vergies däin Numm anzegin!";		 					
$needyourmail = "- Du hues vergies déng Email Adress unzegin!";		 				
$needrecipientsname = "- Du hues vergies dem Empfänger säin Numm unzegin!";
$needrecipientsmail = "- Du hues vergies dem Empfänger séng Email Adress unzegin!";
$needentermessage = "- Et gouf keen Message angin"; 								
$syntaxemail[to] = "- Dem Empfänger séng Emails Adress ass net valide  -  <empfänger@sainhost.lu>";		
$syntaxemail[from] = "- Deng Email Adress ass net valide  -  <du@dainhost.lu>";
$back = "Zeréck";

//getting data//
$getheader = "{Deng Postcard:}";
$getyourname = "Fum:";
$getrecipientsname = "Fir den (d'):";
$getentermessage = "Message:";


//errors
$picerror = "Et gouf keen Bild ausgewielt";
$fielderror = "Folgend Fehler sin opgetrueden:";
$nosession = "- Dir hut keng Zougangsberechtegung zu deser Kart!! <br><br> Kuckt d'Url dei am Email steet nach eng Kéier no an gid se nei an, sos kennt der Äer Kart net kucken";

//luxemburgish language file - for sending emails

$mailok = "Den Postcard gouf verschéckt:";
$mailnumber = "- Deng Postcard gouf verschéckt mat der Nummer:";
$mailsubject = "Du krus eng Giombetti.com Postcard - Yuhuu!!!";
$mailmessage = "Du krus eng Postcard fum $name[from] -> $email[from] <-

Fir deng Postcard kucken ze goen surf op:
$script_location$cardnumber&session=$sessionID
andems de op D'Adress clicks!

(Wann dat net geet dann kopeier des URL mat Ctrl+C,
an paste se dann mat Ctrl+V rem an den Browser)


Surf och lanscht op:
SMS - Witzer -Fotoen - LGE News - An nach vill méi!  
http://www.giombetti.com";



/*don't change anything above this line */
$header = htmlentities("$header");
$yourname = htmlentities("$yourname");
$yourmail = htmlentities("$yourmail");
$recipientsname = htmlentities("$recipientsname");							$recipientsmail = htmlentities("$recipientsmail");							$entermessage = htmlentities("$entermessage");
$needyourname = htmlentities("$needyourname");
$needyourmail = htmlentities("$needyourmail");
$needrecipientsname = htmlentities("$needrecipientsname");
$needrecipientsmail = htmlentities("$needrecipientsmail");
$needentermessage = htmlentities("$needentermessage");
$syntaxemail[to] = htmlentities("$syntaxemail[to]");
$syntaxemail[from] = htmlentities("$syntaxemail[from]");	
$back = htmlentities("$back");	
$getheader = htmlentities("$getheader");
$getyourname = htmlentities("$getyourname");
$getrecipientsname = htmlentities("$getrecipientsname");
$getentermessage = htmlentities("$getentermessage");
$picerror = htmlentities("$picerror");
$fielderror = htmlentities("$fielderror");
?>
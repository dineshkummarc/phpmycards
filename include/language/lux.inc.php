<?php
die('fixme: reformat');

//luxemburgish language file

//postcard sending interface
$header = "{Versch�ck deng Postcard:}";
$yourname = "D�in Numm:";
$yourmail = "Deng Email";
$recipientsname = "Dem Empf�nger s�in Numm:";
$recipientsmail = "Dem Empf�nger seng Email";
$entermessage = "Gef d�in Message hei an:"; 								
$needyourname = "- Du hues vergies d�in Numm anzegin!";		 					
$needyourmail = "- Du hues vergies d�ng Email Adress unzegin!";		 				
$needrecipientsname = "- Du hues vergies dem Empf�nger s�in Numm unzegin!";
$needrecipientsmail = "- Du hues vergies dem Empf�nger s�ng Email Adress unzegin!";
$needentermessage = "- Et gouf keen Message angin"; 								
$syntaxemail[to] = "- Dem Empf�nger s�ng Emails Adress ass net valide  -  <empf�nger@sainhost.lu>";		
$syntaxemail[from] = "- Deng Email Adress ass net valide  -  <du@dainhost.lu>";
$back = "Zer�ck";

//getting data//
$getheader = "{Deng Postcard:}";
$getyourname = "Fum:";
$getrecipientsname = "Fir den (d'):";
$getentermessage = "Message:";


//errors
$picerror = "Et gouf keen Bild ausgewielt";
$fielderror = "Folgend Fehler sin opgetrueden:";
$nosession = "- Dir hut keng Zougangsberechtegung zu deser Kart!! <br><br> Kuckt d'Url dei am Email steet nach eng K�ier no an gid se nei an, sos kennt der �er Kart net kucken";

//luxemburgish language file - for sending emails

$mailok = "Den Postcard gouf versch�ckt:";
$mailnumber = "- Deng Postcard gouf versch�ckt mat der Nummer:";
$mailsubject = "Du krus eng Giombetti.com Postcard - Yuhuu!!!";
$mailmessage = "Du krus eng Postcard fum $name[from] -> $email[from] <-

Fir deng Postcard kucken ze goen surf op:
$script_location$cardnumber&session=$sessionID
andems de op D'Adress clicks!

(Wann dat net geet dann kopeier des URL mat Ctrl+C,
an paste se dann mat Ctrl+V rem an den Browser)


Surf och lanscht op:
SMS - Witzer -Fotoen - LGE News - An nach vill m�i!  
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
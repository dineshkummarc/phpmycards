********************************************************
* simplEcard - a simple E-Card system                  *
*                                                      *
* Web site: http://simplecard.sourceforge.net          *
* Author:   David Buchmann <dbu@users.sourceforge.net> *
*                                                      *
* Copyright (c) 2006 David Buchmann                    *
********************************************************
$Id: README.txt 2 2006-12-13 19:22:38Z dbu $


****************
* Introduction *
****************

Send a digital postcard by Email.
simplEcard can send messages as HTML email. The image file is included as 
attachment, as mail clients should not load images in HTML mails from remote
servers. The more traditional E-Card way of sending a link to view the card in 
a web browser is also supported.



****************
* Requirements *
****************

simplEcard should run on any web server providing PHP <= 4.0
Postcard messages can be stored in a file. If you expect heavy traffic, you can
use a MySQL database to store the messages.


****************
* Installation *
****************

- Unpack the archive into a folder in your web site (if you have not already done so)
- See below how to edit the configuration.
- Upload the files.
- Prepare the database (txt or mysql)

# txt database #
The txt database is just a file. This is simple to install, but if your visitor send
lots of E-Cards, performance can get really bad.
There is just two steps to take:
- Make sure the web server can write to the file postcard.txt (usually, this 
means making the file world writable, "touch postcard.txt; chmod a+w postcard.txt")
- Make sure the .htaccess file protects postcard.txt from being accessed by
pointing your browser to the simplEcard folder and adding postcard.txt to the
address. If you get a file, you should fix your apache setup or move 
postcard.txt out of the web root and adjust the $simplecard['datafile'] setting.

# MySQL database #
If you want to use the MySQL database (see below for configuration), you have 
to prepare a table. The SQL code is in simplecard_database.sql
Open the file and past it into your database management application.
If you use the command line, run
mysql -uroot "databasename" -p < linkbase.sql
where "databasename" is the name of the database you want to use.


*****************
* Configuration *
*****************
The file config.default.php holds default configuration. The meaning of the 
settings are described in that file. However, you should never modify 
config.default.php but create a file config.custom.php and copy any settings you
want to change there. (The reason for this is to allow for smoothly updating
simplEcard without lossing your custom configuration.)


********
* Help *
********

Please visit the simplEcard webiste to get further information and updates.
http://simplecard.sourceforge.net | David Buchmann <dbu@users.sourceforge.net>
 

***********
* Credits *
***********
David Buchmann needed an E-Card system for a web site he was working on.
He tried to use an existing project and choose phpPowerCards 2.0.
The code was however difficult to customise and needed register_globals to be 
off. David ended up doing a thourough rewrite of the application, adding in the
process the possibility to choose which image to use.
phpPowerCards 2.0 has been done by Marc Giombetti <marc@giombetti.com>.
He has a lot of interesting stuff on his website: http://giombetti.com/

Besides, David thanks Andi Weibel for his suggestions, Andi Cassee and Oger for
the original images used in the first simplEcard installation.
Thanks also go to the people who wrote Apache, PHP, Xemacs, vi and of course Linux.

If I would not know that she does not like such statements, thanks would also go
to my girlfriend for forgiving me when I was preoccupied with the project for days.


***********
* License *
***********
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or (at
your option) any later version.

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.

See LICENSE.txt

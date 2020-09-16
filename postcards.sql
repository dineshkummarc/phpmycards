# simplEcard - a simple E-Card system
# Copyright (c) 2006 David Buchmann
# 
# postcards.sql: SQL script to prepare the database.
# If you need a different table name, you may change it below.
# In that case, do not forget to change it in options.custom.php too
#
# -> This application is partially based on phpPowerCards 2.0 by Marc Giombetti <marc@giombetti.com>
# Please visit the simplEcard webiste to get further information and updates.
# http://simplecard.sourceforge.net | David Buchmann <dbu@users.sourceforge.net>
#
################################################################################
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or (at
# your option) any later version.
#
# This program is distributed in the hope that it will be useful, but
# WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
# 
# $Id: postcards.sql 2 2006-12-13 19:22:38Z dbu $
# ------------------------------------------------------------------------------


CREATE TABLE simplecard (
   ID mediumint(9) NOT NULL auto_increment,
   emailto VARCHAR(100) NOT NULL,
   emailfrom VARCHAR(100) NOT NULL,
   nameto VARCHAR(100),
   namefrom VARCHAR(100),
   picture VARCHAR(100) NOT NULL,
   comment mediumtext NOT NULL,
   sessionID blob NOT NULL,
   seencard TINYINT DEFAULT 0,
   created TIMESTAMP,
   PRIMARY KEY (ID),
   UNIQUE ID (ID)
);

# ------------------------------------------------------------------------------
#Note that picture is the path to the image file, relative to the 
#$simplecard['images_directory'] setting.
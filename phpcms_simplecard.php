<?php
/* simplEcard - a simple E-Card system
 * Copyright (c) 2006 David Buchmann
 *
 * phpcms_simplecard.php: Plugin to wrap simplEcard for phpcms.
 * For use of simplEcard in the phpcms system. See www.phpcms.de for more 
 * information.
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
 * $Id: phpcms_simplecard.php 2 2006-12-13 19:22:38Z dbu $
 */

/* We are included inside a script. The simplEcard global variables must be 
 * made global for the script to work.
 */
global $simplecard, $se_text;

require('simplecard.php');

$cur = count($Tags);
$Tags[$cur][0] = '<SIMPLECARD>';
$Tags[$cur][1] = simplecard();
?>

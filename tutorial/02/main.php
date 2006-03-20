<?php
/*
main.php - drip tutorial 02
Copyright (C) 2006 Marcus Lunzenauer <mlunzena@uos.de>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

require_once '../../lib/drip.php';

$registry = Drip_Registry::build('package.yml');

$calc = $registry->service('tutorial.Calculator');

printf("%f\n", $calc->add(5, 7);
printf("%f\n", $calc->subtract(5, 7);
printf("%f\n", $calc->multiplay(5, 7);
printf("%f\n", $calc->divide(5, 7);

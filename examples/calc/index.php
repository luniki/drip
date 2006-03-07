<?
/*
index.php - calc example
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

# init rand
srand(23);

###
require_once '../../lib/drip.php';

$registry = Registry::build('package.yml', 'functions/package.yml');
$calc = $registry->service('calc.Calculator');

echo $calc->add(5, 8);
?><hr><?

echo $calc->subtract(5, 8);
?><hr><?

echo $calc->multiply(5, 8);
?><hr><?

echo $calc->divide(5, 8);
?><hr><?

echo $calc->call_function('sin', 0);
?><hr><?

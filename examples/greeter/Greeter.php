<?php
/*
Greeter.php - DI Example
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


class Greeter {

	var $rand, $whom;

	function Greeter($whom = 'world') {
	  $this->rand = rand();
	  $this->whom = $whom;
	  Greeter::count(TRUE);
	}
	
	function count($count = FALSE) {
	  static $counter;
	  if (is_null($counter))
	    $counter = 0;
	  return $count ? $counter++ : $counter;
	}

	function greet($whom = NULL) {
	  printf('<pre>"%d-%d" says: Hello %s!</pre>', $this->rand, $this->count(),
	         $whom ? $whom : $this->whom);
	}
}

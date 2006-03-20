<?php
/*
tutorial.php - drip tutorial 02 class
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

class Adder {
  function add($a, $b) {
    return $a + $b;
  }
}

class Subtractor {
  function subtract($a, $b) {
    return $a - $b;
  }
}

class Multiplier {
  function multiply($a, $b) {
    return $a * $b;
  }
}

class Divider {
  function divide($a, $b) {
    return $a / $b;
  }
}

class Calculator {

  var $adder, $subtractor, $multiplier, $divider;

  function add($a, $b) {
    return $this->adder->add($a, $b);
  }

  function subtract($a, $b) {
    return $this->subtractor->subtract($a, $b);
  }

  function multiply($a, $b) {
    return $this->multiplier->multiply($a, $b);
  }

  function divide($a, $b) {
    return $this->divider->divide($a, $b);
  }
}

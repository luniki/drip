<?php

	/*
	Calculator.php - TODO
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
	
	class Calculator {

    var $adder, $subtractor, $multiplier, $divider, $functions, $memory;
    
    function Calculator($memory = 0) {
      $this->memory = $memory;
    }

    function add($a, $b = NULL) {
      return $this->adder->add($a, is_null($b) ? $this->memory : $b);
    }
    
    function subtract($a, $b = NULL) {
      return $this->subtractor->subtract($a, is_null($b) ? $this->memory : $b);
    }
    
    function multiply($a, $b = NULL) {
      return $this->multiplier->multiply($a, is_null($b) ? $this->memory : $b);
    }
    
    function divide($a, $b = NULL) {
      return $this->divider->divide($a, is_null($b) ? $this->memory : $b);
    }

    function call_function($name) {
      if (!isset($this->functions[$name]))
        return NULL;
      $args = func_get_args();
      array_shift($args);
      return $this->functions[$name]->compute($args);
    }
	}

<?php
/*
ConfigurationPoint.php - Representation of configuration points
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

class ConfigurationPoint {

	#	internal variables
	var $name, $description, $type, $contributions;
	
	#	Constructor
	function ConfigurationPoint($name, $description, $type)	{
    $this->name = $name;
    $this->description = $description;
    $this->type = $type;
    $this->contributions = array();
	}
	
	function add_contributions($array) {
    
    switch ($this->type) {
    	case 'list':
    		foreach ($array as $key => $value)
    		  $this->contributions[] =& $array[$key];
    		break;
    	
    	default:
    	case 'map':
    		foreach ($array as $key => $value)
    		  $this->contributions[$key] =& $array[$key];
        break;
    }
	}
}

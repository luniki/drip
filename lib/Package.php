<?php
/*
Package.php - Representation of packages in the repository
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

class Package {

	#	internal variables
  var $name, $description, $service_points, $configuration_points;

	#	Constructor
  function Package($name, $description) {
    $this->name = $name;
    $this->description = $description;
    $this->service_points = array();
    $this->configuration_points = array();
  }

  function add_configuration_point(&$configuration_point) {
    $this->configuration_points[$configuration_point->name] =& $configuration_point;
  }
  
  function add_service_point(&$service_point) {
    $this->service_points[$service_point->name] =& $service_point;
  }

  # returning configuration points by name
	function &configuration_point($name) {

    if (!isset($this->configuration_points[$name]))
      return NULL;

    return $this->configuration_points[$name];
	}
  
  # returning services by name
	function &service($name) {

    if (!$this->service_exist($name))
      return NULL;

		return $this->service_points[$name]->instance();
	}

  # checks a service's existence
	function service_exist($name) {
	   return isset($this->service_points[$name]);
  }

  # returning service points by name
	function &service_point($name) {

    if (!$this->service_exist($name))
      return NULL;

		return $this->service_points[$name];
	}
}

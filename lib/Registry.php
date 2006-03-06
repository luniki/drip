<?php
/*
Registry.php - Inversion of Control (IoC) container
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

class Registry {

	#	internal variables
	var $packages;

	#	Constructor
	function Registry() {
    $this->packages = array();
	}

	# adding packages
	function add_package(&$pkg) {
    $this->packages[$pkg->name] =& $pkg;
	}

	# building registry from package files
	function &build($dummy_filename) {
		$registry =& new Registry();
    $conf =& new Configuration($registry);
		$conf->process(func_get_args());
		return $registry;
	}

	# returning configuration points by name
	function &configuration_point($name) {

    # check name
    if (!(list($pkg, $cp) = $this->split_name($name)))
      return NULL;
    
    # no such pkg
    if (!isset($this->packages[$pkg]))
      return NULL;
	    
    return $this->packages[$pkg]->configuration_point($cp);
	}

  # returning packages by name
	function &package($name) {

    # no such package
    if (!isset($this->packages[$name]))
      return NULL;
    
    return $this->packages[$name];
	}

  # returning services by name
	function &service($name) {
    if (!$this->service_exist($name))
      return NULL;

    list($pkg, $sp) = $this->split_name($name);
    
		return $this->packages[$pkg]->service($sp);
	}

  # checks a service's existence
	function service_exist($name) {

    # check name
    if (!(list($pkg, $sp) = $this->split_name($name)))
      return FALSE;

    if (!isset($this->packages[$pkg]))
      return FALSE;

    return $this->packages[$pkg]->service_exist($sp);
	}

  # returning service points by name
	function &service_point($name) {
    if (!$this->service_exist($name))
      return NULL;

    list($pkg, $sp) = $this->split_name($name);
    
		return $this->packages[$pkg]->service_point($sp);
	}
	
	# helper function to split fully qualified names
	function split_name($name) {

    if (!preg_match('/^(.+)\.([^.]+)$/', $name, $matches))
      return NULL;

    # remove whole string
    array_shift($matches);
    
    return $matches;
	}
}

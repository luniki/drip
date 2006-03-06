<?php
/*
ServiceModel.php - Representation of service model
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

class ServiceModel {

	#	internal variables
  var $service_point;

	#	Constructor
  function ServiceModel(&$service_point) {
    $this->service_point =& $service_point;
  }

  function &instance() {
    trigger_error('ServiceModel::instance() not implemented', E_USER_ERROR);
		exit;
  }
}

###

class PrototypeServiceModel extends ServiceModel {

  function &instance() {
    return $this->service_point->instantiate();
  }
}

###

class SingletonServiceModel extends ServiceModel {

	#	internal variables
  var $instance = NULL;

  function &instance() {
    if (is_null($this->instance))
      $this->instance = $this->service_point->instantiate();
    return $this->instance;
  }
}

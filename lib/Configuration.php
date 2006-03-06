<?php
/*
Configuration.php - TODO
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

class Configuration {

	#	internal variables
  var $registry;

	#	Constructor
  function Configuration(&$registry) {
    $this->registry =& $registry;
  }

  function process($filenames) {
    
    # load yaml
    $yamls = array();
    foreach ($filenames as $filename) {
      $yaml = Spyc::YAMLLoad($filename);
      if (isset($yaml['id']))
        $yamls[$yaml['id']] = $yaml;
    }

    # create new packages
    foreach ($yamls as $id => $yaml)
      $this->registry->add_package(new Package($id, $yaml['description']));

    # create configuration points
    foreach ($yamls as $id => $yaml) {
      
      # package contains no configuration points
      if (!isset($yaml['configuration-points'])) 
        continue;
      
      # get package
      $package =& $this->registry->package($id);
      
      # add configuration points
      foreach ($yaml['configuration-points'] as $name => $cp)
        $package->add_configuration_point(new ConfigurationPoint($name,
                                            $cp['description'],
                                            $cp['type']));
    }
    

    # create service points
    foreach ($yamls as $id => $yaml) {

      # package contains no service points
      if (!isset($yaml['service-points'])) 
        continue;

      # get package
      $package =& $this->registry->package($id);

      # add configuration points
      foreach ($yaml['service-points'] as $name => $sp) {

        # use tags
        $sp = array_map(array(&$this, '_get_typed_value'), $sp);

        $service_point =& new ServicePoint($name, $sp['description'], $sp['implementor']);
        $package->add_service_point($service_point);

        # choose model
        switch ($sp['model']) {

          default:
          case 'singleton':
            $service_point->service_model =& new SingletonServiceModel($service_point);
            $service_point->service_model->id = uniqid('');
            break;

          case 'prototype':
            $service_point->service_model =& new PrototypeServiceModel($service_point);
            $service_point->service_model->id = uniqid('');
            break;
        }

        #choose implementor
        if (!is_array($sp['implementor']))
          $service_point->instantiator =&
            new SimpleInstantiator($service_point, $sp['implementor']);
        else
          $service_point->instantiator =&
            new ComplexInstantiator($service_point, $sp['implementor']);
      }
    }
    
    # process contributions
    foreach ($yamls as $id => $yaml) {
      
      # package contains no contributions
      if (!isset($yaml['contributions']))
        continue;
      
      # get package
      $package =& $this->registry->package($id);
      
      # add contributions
      foreach ($yaml['contributions'] as $name => $contributions) {

        # use tags
        $contributions = array_map(array(&$this, '_get_typed_value'), $contributions);

        $configuration_point =& $this->registry->configuration_point($name);
        $configuration_point->add_contributions($contributions);
      }
    }
  }
    
  #
  function &_get_typed_value($value) {

    # value is a string
    if (is_string($value)) {

      # tagged value
      if (preg_match('/^!!(service|configuration)\s+(.+)$/', $value, $matches)) {

        switch ($matches[1]) {
        	case 'service':
        		$value =& $this->registry->service($matches[2]);
        		break;

        	case 'configuration':
        	  $point =& $this->registry->configuration_point($matches[2]);
        		$value =& $point->contributions;
        		break;
        }
      }
    }

    # value is an array
    else if (is_array($value)) {
    
      # recurse
      $value =& array_map(array(&$this, '_get_typed_value'), $value);
    }

    return $value;
  }
}

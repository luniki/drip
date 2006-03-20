<?php
/*
Instantiator.php - TODO
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

class Drip_Instantiator {

	#	internal variables
  var $point, $definition;
	
	#	Constructor
  function Drip_Instantiator(&$point, $definition) {
    $this->point =& $point;
    $this->definition = $definition;
  }
  
  function &instantiate() {
    trigger_error('Instantiator::instantiate() not implemented', E_USER_ERROR);
		exit;
  }
  
  function _load_class($string) {
		list($filename, $class) = explode('::', $string);

		if (!is_null($class))
			require_once $filename;
		else
			$class = $filename;

    return $class;  
  }
}

###

class Drip_SimpleInstantiator extends Drip_Instantiator {

  function &instantiate() {
    $class = $this->_load_class($this->definition);
    return new $class(); 
  }
}

###

class Drip_ComplexInstantiator extends Drip_Instantiator {

  function &instantiate() {
    
    # class
    if (!isset($this->definition['class']))
      return NULL;
    $class = $this->_load_class($this->definition['class']);

    # parameters
    $parameters = NULL;
    if (isset($this->definition['parameters']))
    	if (!is_array($parameters = $this->definition['parameters']))
        $parameters = array($parameters);

    # instantiate
    if (!$parameters)
      $instance =& new $class();
    else
      $instance =& $this->_create_obj_array($class, $parameters);

    # properties
    if (isset($this->definition['properties']))
      foreach ($this->definition['properties'] as $name => $value)
        $instance->$name =& $this->definition['properties'][$name];
    
    # invoke
    if (isset($this->definition['invoke']))
      foreach ($this->definition['invoke'] as $name => $value) {
        if (!is_array($value)) $value = array($value);
        call_user_func_array(array(&$instance, $name), $value);
      }
    
    # initialize-method
    if (isset($this->definition['initialize-method']))
      call_user_func(array(&$instance, $this->definition['initialize-method']));

    return $instance; 
  }
  
  function &_create_obj_array($type, $args) {
    $paramstr = array();
    foreach ($args as $key => $arg)
      $paramstr[] = '$args[' . $key . ']';
    $paramstr = join(',', $paramstr);
    return eval("return new $type($paramstr);");
  }
}

<?
require_once '../../lib/drip.php';


$reg = Drip_Registry::build('package.simple.yml', 'package.complex.yml');
$services = array('tutorial.simple.greeter',
                  'tutorial.complex.greeter1',
                  'tutorial.complex.greeter2',
                  'tutorial.complex.greeter3',
                  'tutorial.complex.greeter4');

foreach ($services as $service) {
	echo $service;
  $greeter = $reg->service($service);
  var_dump($greeter);
  if ($greeter)
    $greeter->greet();
  ?><hr /><?
}

var_dump($reg);

<?php

#
#    S P Y C
#      a simple php yaml class
#   v0.2(.3)
#
# author: [chris wanstrath, chris@ozmm.org]
# websites: [http://www.yaml.org, http://spyc.sourceforge.net/]
# license: [MIT License, http://www.opensource.org/licenses/mit-license.php]
# copyright: (c) 2005-2006 Chris Wanstrath
#

include('spyc.php');

$array = Spyc::YAMLLoad('spyc.yml');

echo '<pre><a href="spyc.yml">spyc.yml</a> loaded into PHP:<br/>';
print_r($array);
echo '</pre>';


?>
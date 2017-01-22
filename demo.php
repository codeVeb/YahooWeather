<?php

#add class file in your code.
require_once('vendor/autoload.php');

#initiate class object
$yw = new YahooWeather\Api(55949053);

echo '<pre>';
#get array of all weather report --> {return type : array}
print_r($yw->getAll());

#get title for weather report --> {return type : string}
print_r($yw->title());

#get last updated data/time --> {return type : string}
print_r($yw->lastBuild());

#get location parameters --> {return type : array}
print_r($yw->location());

#get units --> {return type : array}
print_r($yw->units());

#get wind report --> {return type : array}
print_r($yw->wind());

#get atmosphere report --> {return type : array}
print_r($yw->atmosphere());

#get sunset/sunrise report --> {return type : array}
print_r($yw->astronomy());

#get current report --> {return type : array}
print_r($yw->now());

#get forcast for 5 days --> {return type : array}
print_r($yw->forecast());

#get copyright stamp --> {return type : string}
print_r($yw->poweredBy());
?>

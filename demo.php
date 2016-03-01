<?php

#add class file in your code.
require_once('yahoo.weather.api.php');

#initiate class object
$yw = new yahooWeather(55949053);

#get array of all weather report --> {return type : array}
$yw->getAll();

#get title for weather report --> {return type : string}
$yw->title();

#get last updated data/time --> {return type : string}
$yw->lastBuild();

#get location parameters --> {return type : array}
$yw->location();

#get units --> {return type : array}
$yw->units();

#get wind report --> {return type : array}
$yw->wind();

#get atmosphere report --> {return type : array}
$yw->atmosphere();

#get sunset/sunrise report --> {return type : array}
$yw->astronomy();

#get current report --> {return type : array}
$yw->now();

#get forcast for 5 days --> {return type : array}
$yw->forecast();

#get copyright stamp --> {return type : string}
$yw->poweredBy();
?>
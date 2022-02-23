<?php

include("./geoip.inc"); 
$gi = geoip_open("./GeoIP.dat",GEOIP_STANDARD); 

echo geoip_country_code_by_addr($gi, '180.166.210.22')


// us
// cn
// kr
?>


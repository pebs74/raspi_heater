<?php

$temp_humid = explode(';', shell_exec('/opt/heater/get_temp.sh'));

print_r("<div style='text-align:center;'>");
print_r("<h1>Temperature: <b>$temp_humid[0] ºC</b></h1>");
print_r("<h1>Humidity: <b>$temp_humid[1] %</b></h1>");
print_r("</div>");


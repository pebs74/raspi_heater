<?php

$post = file_get_contents('php://input');
$json = json_decode($post);
$token = trim(file_get_contents("/opt/heater/token"));

if($json->token != $token){
    header('HTTP/1.0 403 Forbidden');
    print_r("FORBIDDEN");
    return;
}

file_put_contents("/opt/heater/last_temp_req", $post);

$temp = floatval($json->temp);

file_put_contents("/opt/heater/active_temp", $temp);

print_r($json);

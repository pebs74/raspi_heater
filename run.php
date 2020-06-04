#!/usr/bin/php
<?php

$basePath = dirname(__FILE__);

// scripts
$getTempPath = $basePath."/get_temp.sh";
$onPath = $basePath."/turn_on.sh";
$offPath = $basePath."/turn_off.sh";

// variables and flags
$schedulePath = $basePath."/schedule.json";
$activeTempPath = $basePath."/active_temp";
$inactiveTempPath = $basePath."/inactive_temp";
$currStatePath = $basePath."/curr_state";
$modePath = $basePath."/mode";
$tempMarginPath = $basePath."/temp_margin";

// debug mode
if(in_array("-v", $argv)){
	$debug = true;
} else{
	$debug = false;
}

// log
$printLog = false;
$log = "";

// current time
$currentTime = new DateTime();

$log .= $currentTime->format('Y-m-d H:i:s');

// current heater state (ON/OFF)
$currState = strtoupper(trim(file_get_contents($currStatePath)));

// status depends on schedule
$dow = date("l");
$schedule = json_decode(file_get_contents($schedulePath))->$dow;
$status = "INACTIVE";
foreach($schedule as $segment){
    $startTime = new DateTime($segment->start);
    $endTime = new DateTime($segment->end);
    if ($currentTime >= $startTime && $currentTime <= $endTime) {
        $status = "ACTIVE";
        break;
    }
}
$log .= "\t| SCHEDULE: $status";

// mode
$mode = strtoupper(trim(file_get_contents($modePath)));
switch($mode){
    // permanent override modes (warning: fixed status forever)
    case "ON":
    case "OFF":
        if($currState != $mode){
            $log .= "\t| OVERRIDE: $mode\t| CurrState: $currState\t| -> TURN $mode\n";
            $script = strtolower($mode)."Path";
            shell_exec($$script);
            print_r($log);
        }
        // end
        exit(0);
        break;
    // temporary override modes (end when schedule catches up)
    case "ACTIVE":
    case "INACTIVE":
    	if($status != $mode){
    		$status = $mode;
    		$log .= "\t| OVERRIDE: $mode";
    	} else{ // override ends -> mode = auto
    	    $log .= "\t| END OVERRIDE";
    	    $printLog = true;
    		file_put_contents($modePath, "AUTO");
    	}
		break;
    default:
		break;
}

// target temp
if($status == "ACTIVE"){
	$target = floatval(trim(file_get_contents($activeTempPath)));
} else{
	$target = floatval(trim(file_get_contents($inactiveTempPath)));
}
// temp margin
$tempMargin = floatval(trim(file_get_contents($tempMarginPath)));

// current temperature and humidity values
$TH = explode(";", shell_exec($getTempPath));
$T = floatval($TH[0]);
$H = floatval($TH[1]);

// info
$log .= "\t| Temp: $T ºC"
	. "\t| Humid: $H %"
	. "\t| Target: ".($target-$tempMargin)." ºC <-> ".($target+$tempMargin)." ºC"
	. "\t| CurrState: $currState";

// action if required
if(
    $currState == "OFF" 
    && $T <= ($target - $tempMargin)
){
	$log .= "\t| TURN ON";
	shell_exec($onPath);
	$printLog = true;
} elseif(
    $currState == "ON" 
    && $T >= ($target + $tempMargin)
){
	$log .= "\t| TURN OFF";
	shell_exec($offPath);
	$printLog = true;
} else{
    $log .= "\t| NO ACTION";
}

if($printLog || $debug){
    print_r($log . PHP_EOL);
}

exit(0);


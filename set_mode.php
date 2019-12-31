<?php

$post = file_get_contents('php://input');
$json = json_decode($post);
$token = trim(file_get_contents("/opt/heater/token"));

if($json->token != $token){
    header('HTTP/1.0 403 Forbidden');
    print_r("FORBIDDEN");
    return;
}

file_put_contents("/opt/heater/last_mode_req", $post);

switch(strtoupper($json->mode)){
	case "ENCIENDE LA":
	case "ENCENDIDO":
	case "ENCENDIDA":
	case "ENCENDER":
	case "ENCENDER LA":
		$mode = "ACTIVE";
		break;
	case "APAGA LA":
	case "APAGADO":
	case "APAGADA":
	case "APAGAR":
	case "APAGAR LA":
		$mode = "INACTIVE";
		break;
	case "ACTIVE":
	case "ACTIVO":
	case "ACTIVA":
	case "ACTIVA LA":
	case "ACTIVADO":
	case "ACTIVADA":
	case "ACTIVAR":
		$mode = "ACTIVE";
		break;
	case "INACTIVE":
	case "INACTIVO":
	case "INACTIVA":
	case "INACTIVA LA":
	case "INACTIVADO":
	case "INACTIVADA":
	case "INACTIVAR":
	case "DESACTIVADO":
	case "DESACTIVADA":
	case "DESACTIVAR":
	case "DESACTIVA":
	case "DESACTIVA LA":
		$mode = "OFF";
		break;
	default:
		$mode = "AUTO";
}

file_put_contents("/opt/heater/mode", $mode);

print_r($json);

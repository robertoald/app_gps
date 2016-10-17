<?php

/* * ********************************* */
/* FUNCION DE ENCRIPTACION           */
/* * ********************************* */

function _salt($pass) {
    require("variables_config.php");
    $key = $ecret;
    $pass = md5($pass . $key);
    return $pass;
}

function _bienvenido_mysql() {
    require("variables_config.php");

    $coneccion = mysql_connect($hostdb, $userdb, $passdb);
    mysql_select_db($namedb, $coneccion);
    mysql_set_charset("utf8", $coneccion);
}

function _adios_mysql() {
    mysql_close();
}

/* * ********************************* */
/* FUNCION DE ENCRIPTACION           */
/* * ********************************* */

function _desordenar($string) {

   /* require("variables_config.php");

    $key = $ecret;

    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result.=$char;
    }
    return base64_encode($result);*/
	return $string;
}

function _ordenar($string) {
  /*  require("variables_config.php");
    $key = $ecret;
    $result = '';
    $string = base64_decode($string);
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result.=$char;
    }
    return $result;*/
	return $string;
}

function decode_get2($string, $cantidaddeparametros) {
    $cad = split("[&]", $string); //separo la url desde el ?
    $string = $cad[$cantidaddeparametros]; //capturo la url desde el separador ? en adelante
    $string = _ordenar($string); //decodifico la cadena
    //procedo a dejar cada variable en el $_GET
    $cad_get = split("[&]", $string); //separo la url por &
    foreach ($cad_get as $value) {
        $val_get = split("[=]", $value); //asigno los valosres al GET
        $_GET[$val_get[0]] = utf8_decode($val_get[1]);
    }
}

/* * ********************************* */
/* FUNCION DE ALERTA		 			 */
/* * ********************************* */

function alertadev($mensaje) {
    echo '<script type="text/javascript">prompt("' . $mensaje . '", "' . $mensaje . '");</script>';
}

function sql_to_coordinates($poligono) {
    $poligono = str_replace("POLYGON((", "", $poligono);
    $poligono = str_replace("))", "", $poligono);
    $coords = explode(",", $poligono);
    $coordinates = array();
    foreach ($coords as $coord) {
        $coord_split = explode(" ", $coord);
        $coordinates[] = array("lat" => $coord_split[0], "lng" => $coord_split[1]);
    }
    return $coordinates;
}

function getRealIP() {

    if (isset($_SERVER["HTTP_CLIENT_IP"])) {
        return $_SERVER["HTTP_CLIENT_IP"];
    } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
        return $_SERVER["HTTP_X_FORWARDED"];
    } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
        return $_SERVER["HTTP_FORWARDED"];
    } else {
        return $_SERVER["REMOTE_ADDR"];
    }
}

function getCountryFromIP($ipuser) {
    $geoPlugin_array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ipuser));
    return $geoPlugin_array['geoplugin_countryName'];
}

?>
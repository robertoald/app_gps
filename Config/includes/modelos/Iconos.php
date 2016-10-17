<?php

class Iconos {

    var $idIcono;
    var $Nombre;
    var $Descripcion;
    var $listado = array();

    function __construct($idIcono, $Nombre, $Descripcion) {
        $this->idIcono = $idIcono;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $query = mysql_query("SELECT a.id_icono, a.nombre, a.descripcion FROM iconos a WHERE 1=1");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->listado[$i] = array('idIcono' => $respuesta['id_icono'],
                'Nombre' => $respuesta['nombre'],
                'Descripcion' => $respuesta['descripcion']
            );
            $i++;
        }
        _adios_mysql();
    }

}

?>
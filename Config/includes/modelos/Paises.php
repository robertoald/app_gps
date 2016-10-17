<?php

class Paises {

    var $idPaises;
    var $Pais;
    var $UsoHorario;
    var $respuesta = array(
        'data' => '',
        'mensaje' => ''
    );
    var $listado = array();

    function __construct($idPaises, $Pais, $UsoHorario) {
        $this->idPaises = $idPaises;
        $this->Pais = $Pais;
        $this->UsoHorario = $UsoHorario;
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $query = mysql_query("SELECT a.idpaises, a.pais, a.usohorario FROM paises a WHERE 1=1");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->listado[$i] = array('idPais' => $respuesta['idpaises'],
                'Pais' => $respuesta['pais'],
                'UsoHorario' => $respuesta['usohorario']
                );
            $i++;
        }
        _adios_mysql();
    }

}

?>
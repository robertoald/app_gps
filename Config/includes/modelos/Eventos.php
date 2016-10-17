<?php

include_once 'Clientes.php';

class Eventos {

    var $idEvento;
    var $Descripcion;
    var $Alerta;
    var $listado = array();

    function __construct($idEvento, $Descripcion, $Alerta) {
        $this->idEvento = $idEvento;
        $this->Descripcion = $Descripcion;
        $this->Alerta = $Alerta;
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $query = mysql_query("SELECT a.id,"
                . "a.descripcion,"
                . "a.esalerta "
                . "FROM eventos a "
                . "WHERE 1 = 1");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->listado[$i] = array('id' => $respuesta['id'],
                'Descripcion' => $respuesta['descripcion'],
                'EsAlerta' => $respuesta['esalerta']);
            $i++;
        }
        _adios_mysql();
    }

}

?>
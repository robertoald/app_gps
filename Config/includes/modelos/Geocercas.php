<?php

class Geocercas {

    var $idGeocerca;
    var $Nombre;
    var $Puntos;
    var $Fecha;
    var $idCliente;
    var $Radio;
    var $Tipo;
    var $respuesta = array(
        'data' => '',
        'mensaje' => ''
    );
    var $listado = array();

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setPuntos($Puntos) {
        $this->Puntos = $Puntos;
    }
    
    function setTipo($Tipo) {
        $this->Tipo = $Tipo;
    }
    
    function setRadio($Radio) {
        $this->Radio = $Radio;
    }

    function __construct($idGeocerca, $Nombre, $Puntos, $Fecha, $idCliente, $Radio, $Tipo) {
        $this->idGeocerca = $idGeocerca;
        $this->Nombre = $Nombre;
        $this->Puntos = $Puntos;
        $this->Fecha = $Fecha;
        $this->idCliente = $idCliente;
        $this->Radio= $Radio;
        $this->Tipo = $Tipo;
    }

    function _agregar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("INSERT INTO geocercas(geocercasname,puntos,fechadd,idcliente,radio,tipo) VALUES('$this->Nombre',GeomFromText('POLYGON($this->Puntos)'),NOW(),$this->idCliente, '$this->Radio', $this->Tipo)");

        $this->respuesta['data'] = "Agregar";
        $this->respuesta['mensaje'] = "Geocerca registrada con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _modificar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("UPDATE geocercas SET geocercasname='$this->Nombre',radio='$this->Radio', puntos=GeomFromText('POLYGON($this->Puntos)') WHERE idgeocercas=$this->idGeocerca");
        $this->respuesta['data'] = "Modificar";
        $this->respuesta['mensaje'] = "Geocerca actualizada con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $extra = '';
        if ($this->idCliente) {
            $extra = " AND a.idcliente=$this->idCliente";
        }

        $i = 0;
        $query = mysql_query("SELECT a.idgeocercas,"
                . "a.geocercasname,"
                . "a.fechadd,"
                . "a.tipo,"
                . "a.radio,"
                . "AsText(a.puntos) AS Puntos "
                . "FROM geocercas a "
                . "WHERE 1 = 1" . $extra);

        while ($respuesta = mysql_fetch_array($query)) {
            $parametros = 'geocerca=' . $respuesta['idgeocercas'];
            $parametros .= '&nombre=' . $respuesta['geocercasname'];
            $parametros .= '&modificar=1';
            $parametros = '&' . _desordenar($parametros);

            $this->listado[$i] = array('idgeocercas' => $respuesta['idgeocercas'],
            'Nombre' => $respuesta['geocercasname'],
            'Puntos' => $respuesta['Puntos'],
            'Radio' => $respuesta['radio'],
            'Tipo' => $respuesta['tipo'],
            'coordenadas' => sql_to_coordinates($respuesta['Puntos']),
            'Parametros' => $parametros);
            $i++;
        }
        _adios_mysql();
    }

}

?>
<?php

include_once 'Clientes.php';

class Recorridos {

    var $idPosicion;
    var $idVehiculo;
    var $Lat;
    var $Lng;
    var $Alt;
    var $Grados;
    var $FechaGPS;
    var $FechaServer;
    var $Desde;
    var $Hasta;
    var $respuesta = array(
        'data' => '',
        'mensaje' => ''
    );
    var $listado = array();

    function setDesde($Desde) {
        $this->Desde = $Desde;
    }

    function setHasta($Hasta) {
        $this->Hasta = $Hasta;
    }

    function setVehiculo($idVehiculo) {
        $this->idVehiculo = $idVehiculo;
    }

    function __construct($idPosicion, $idVehiculo, $Lat, $Lng, $Alt, $Grados, $FechaGPS, $FechaServer) {
        $this->idPosicion = $idPosicion;
        $this->idVehiculo = $idVehiculo;
        $this->Lat = $Lat;
        $this->Lng = $Lng;
        $this->Alt = $Alt;
        $this->Grados = $Grados;
        $this->FechaGPS = $FechaGPS;
        $this->FechaServer = $FechaServer;
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $extraDesde = '';
        $extraHasta = '';
        $extra = '';

        $Mes = (int) date('m');
        $Año = date('Y');

        if ($this->Desde && $this->Hasta) {
            $FechaDesde = $this->Desde;
            $FechaHasta = $this->Hasta;
        } else {
            if ($this->Desde && !($this->Hasta)) {
                $FechaDesde = $this->Desde;
                $FechaHasta = strtotime('+1 day', strtotime($FechaDesde));
                $FechaHasta = date('Y-m-d', $FechaHasta);
            }
            if (!($this->Desde) && $this->Hasta) {
                $FechaHasta = $this->Hasta;
                $FechaDesde = strtotime('-1 day', strtotime($FechaHasta));
                $FechaDesde = date('Y-m-d', $FechaDesde);
            }
            if (!($this->Desde) && !($this->Hasta)) {
                $FechaDesde = date('Y-m-d', strtotime('-1 day'));
                $FechaHasta = date('Y-m-d');
            }
        }
        $MesDesde = (int) date('m', strtotime($FechaDesde));
        $MesHasta = (int) date('m', strtotime($FechaHasta));
        $AñoDesde = date('Y', strtotime($FechaDesde));
        $AñoHasta = date('Y', strtotime($FechaHasta));

        $Select = "SELECT idposicion,idvehiculo,lat,log,alt,grados,fechagps,fechaserver ";
        $Where = "WHERE idvehiculo = $this->idVehiculo ";
        $extraDesde = "AND DATE(fechagps) >= '$FechaDesde' ";
        $extraHasta = "AND DATE(fechagps) <= '$FechaHasta' ";

        if ($MesDesde === $MesHasta) {

            $extra = $extraDesde . $extraHasta;
            $From = "FROM gpshistorial.posicion_" . $MesDesde . "_" . $AñoDesde . " ";
            $QuerySelect = $Select . $From . $Where . $extra;
        } else {

            $From = "FROM gpshistorial.posicion_" . $MesDesde . "_" . $AñoDesde . " ";
            $QuerySelect = $Select . $From . $Where . $extraDesde;
            
            $QuerySelect .= " UNION ALL ";
            
            $From = "FROM gpshistorial.posicion_" . $MesHasta . "_" . $AñoHasta . " ";
            $QuerySelect .= $Select . $From . $Where . $extraHasta;
        }

        $i = 0;
        $query = mysql_query($QuerySelect . " GROUP BY concat(lat, log) ORDER BY fechagps ");

        while ($respuesta = mysql_fetch_array($query)) {
            $parametros = 'vehiculo=' . $respuesta['idvehiculo'];
            $parametros = '&' . _desordenar($parametros);

            $this->listado[$i] = array('idVehiculo' => $respuesta['idvehiculo'],
                'Posicion' => $respuesta['idposicion'],
                'Lat' => $respuesta['lat'],
                'Log' => $respuesta['log'],
                'Alt' => $respuesta['alt'],
                'Grados' => $respuesta['grados'],
                'FechaGPS' => $respuesta['fechagps'],
                'Lat' => $respuesta['lat'],
                'Log' => $respuesta['log'],
                'FechaGPS' => $respuesta['fechagps'],
                'FechaServer' => $respuesta['fechaserver'],
                'Parametros' => $parametros);
            $i++;
        }
        //$this->listado[$i] = array('Query' => $QuerySelect . "ORDER BY fechagps DESC ");
        _adios_mysql();
    }

}

?>
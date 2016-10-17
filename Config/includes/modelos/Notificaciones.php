<?php

include_once 'Clientes.php';

class Notificaciones {

    var $idNotificacion;
    var $Destino;
    var $Tipo;
    var $idCliente;
    var $idVehiculo;
    var $UltimoEnviado;
    var $Fecha;
    var $TipoAlerta;
    var $Alerta;
    var $Aux3;
    var $respuesta = array(
        'data' => '',
        'mensaje' => ''
    );
    var $listado = array();

    function setID($idNotificacion) {
        $this->idNotificacion = $idNotificacion;
    }

    function setDestino($Destino) {
        $this->Destino = $Destino;
    }

    function setTipo($Tipo) {
        $this->Tipo = $Tipo;
    }

    function setCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setVehiculo($idVehiculo) {
        $this->idVehiculo = $idVehiculo;
    }

    function setUltimoEnviado($UltimoEnviado) {
        $this->UltimoEnviado = $UltimoEnviado;
    }

    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    function setTipoAlerta($TipoAlerta) {
        $this->TipoAlerta = $TipoAlerta;
    }

    function setAlerta($Alerta) {
        $this->Alerta = $Alerta;
    }

    function setAux3($Aux3) {
        $this->Aux3 = $Aux3;
    }

    function __construct($idNotificacion, $Destino, $Tipo, $idCliente, $idVehiculo, $UltimoEnviado, $Fecha, $TipoAlerta, $Alerta, $Aux3) {
        $this->idNotificacion = $idNotificacion;
        $this->Destino = $Destino;
        $this->Tipo = $Tipo;
        $this->idCliente = $idCliente;
        $this->idVehiculo = $idVehiculo;
        $this->UltimoEnviado = $UltimoEnviado;
        $this->Fecha = $Fecha;
        $this->TipoAlerta = $TipoAlerta;
        $this->Alerta = $Alerta;
        $this->Aux3 = $Aux3;
    }

    function _agregar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("insert into notificacion(destino,tipo,idvehiculo,idcliente,tipoalerta,alerta,dateadd) VALUES('$this->Destino','$this->Tipo',$this->idVehiculo,$this->idCliente,$this->TipoAlerta,$this->Alerta,NOW())");
        $this->respuesta['data'] = "Agregar";
        $this->respuesta['mensaje'] = "Notificación registrada con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }
    function _modificar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        
        mysql_query("UPDATE notificacion SET destino='$this->Destino', tipo=$this->Tipo, idvehiculo=$this->idVehiculo, tipoalerta=$this->TipoAlerta, alerta=$this->Alerta WHERE id=$this->idNotificacion");
        $this->respuesta['data'] = "Modificar";
        $this->respuesta['mensaje'] = "Notificación actualizada con éxito!";

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
        $query = mysql_query("SELECT a.idvehiculo,"
                . "a.id,"
                . "a.dateadd,"
                . "a.idcliente,"
                . "a.destino,"
                . "a.tipo,"
                . "a.tipoalerta,"
                . "a.alerta,"
                . "d.nombre,"
                . "a.aux3,"
                . "a.lastsend "
                . "FROM notificacion a "
                . "INNER JOIN vehiculos c "
                . "ON a.idvehiculo = c.idvehiculo "
                . "INNER JOIN objetos_detalles d "
                . "ON c.idobjeto = d.idobjeto "
                . "WHERE 1 = 1" . $extra);
        while ($respuesta = mysql_fetch_array($query)) {
            $parametros = 'notificacion=' . $respuesta['id'];
            $parametros .= '&vehiculo=' . $respuesta['idvehiculo'];
            $parametros .= '&destino=' . $respuesta['destino'];
            $parametros .= '&tipo=' . $respuesta['tipo'];
            $parametros .= '&tipoalerta=' . $respuesta['tipoalerta'];
            $parametros .= '&alerta=' . $respuesta['alerta'];
            $parametros .= '&modificar=1';
            $parametros .= '&idcliente=' . $this->idCliente;
            $parametros = '&' . _desordenar($parametros);
            
            $this->listado[$i] = array('idVehiculo' => $respuesta['idvehiculo'],
                'Nombre' => $respuesta['nombre'],
                'Destino' => $respuesta['destino'],
                'Alerta' => $respuesta['alerta'],
                'TipoAlerta' => $respuesta['tipoalerta'],
                'Tipo' => $respuesta['tipo'],
                'Tipo_icon' => ($respuesta['tipo'] == 1 ? '<i title="' . $respuesta['tipo'] . '" class="fa fa-internet-explorer"></i>' : ($respuesta['tipo'] == 2 ? '<i title="' . $respuesta['tipo'] . '" class="fa fa-envelope-o"></i>' : '<i title="' . $respuesta['tipo'] . '" class="fa fa-whatsapp"></i>')),
                'Nombre' => $respuesta['nombre'],
                'Fecha' => $respuesta['dateadd'],
                'Parametros' => $parametros);
            $i++;
        }
        _adios_mysql();
    }

}

?>
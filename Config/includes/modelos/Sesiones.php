<?php

class Sesion {

    var $idSesion;
    var $Usuario;
    var $IP;
    var $Fecha;
    var $Fecha_inicial;
    var $Fecha_final;
    var $idEmpresa;
    var $Tipo;
    var $status;
    var $listado = array();

    function setUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }

    function setTipo($Tipo) {
        $this->Tipo = $Tipo;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    function setFechaIni($Fecha) {
        $this->Fecha_inicial = $Fecha;
    }

    function setFechaFin($Fecha) {
        $this->Fecha_final = $Fecha;
    }

    function __construct($idSesion, $Usuario, $IP, $idEmpresa) {
        $this->idSesion = $idSesion;
        $this->Usuario = $Usuario;
        $this->IP = $IP;
        $this->idEmpresa = $idEmpresa;
    }

    function _abrirSesion($a) {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $tabla = 'accesos';
        if ($a) {
            $tabla .= '_clientes';
        }

        mysql_query("UPDATE $tabla SET status=1 WHERE usuario='$this->Usuario'");
        mysql_query("INSERT INTO $tabla(usuario,ip,idempresa,fecha,status) VALUES('$this->Usuario','$this->IP',$this->idEmpresa,NOW(),0)");

        _adios_mysql();
    }

    function _cerrarSesion($a) {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $tabla = 'accesos';
        if ($a) {
            $tabla .= '_clientes';
        }

        mysql_query("UPDATE $tabla SET status=1 WHERE usuario='$this->Usuario'");

        _adios_mysql();
    }

    function _listarClientes($reporte) {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        if ($reporte) {
            $extra = "AND a.fecha >= '$this->Fecha_inicial' AND a.fecha <= '$this->Fecha_final' ORDER BY a.fecha ASC";
        } else {
            $extra = 'AND a.idsesion IN (SELECT MAX(c.idsesion) FROM accesos_clientes c GROUP BY c.usuario) ORDER BY a.status';
        }
        $query = mysql_query("SELECT a.idsesion,"
                . "a.usuario,"
                . "a.ip,"
                . "a.fecha,"
                . "a.status,"
                . "b.nombre as Nombre,"
                . "a.idempresa "
                . "FROM accesos_clientes a "
                . "INNER JOIN cliente b "
                . "ON a.usuario = b.correo "
                . "WHERE a.idempresa=$this->idEmpresa $extra");
        $i = 0;
        while ($respuesta = mysql_fetch_array($query)) {

            $this->listado[$i] = array('Id' => $respuesta['idsesion'],
                'Usuario' => $respuesta['usuario'],
                'Nombre' => $respuesta['Nombre'],
                'IP' => $respuesta['ip'],
                'Inicial' => $this->Fecha_inicial,
                'Final' => $this->Fecha_final,
                'Pais' => getCountryFromIP($respuesta['ip']),
                'Status' => $respuesta['status'],
                'Fecha' => $respuesta['fecha']);
            $i++;
        }
        _adios_mysql();
    }

    function _listarUsers($reporte) {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        if ($reporte) {
            $extra = "AND a.fecha >= '$this->Fecha_inicial' AND a.fecha <= '$this->Fecha_final' ORDER BY a.fecha ASC";
        } else {
            $extra = 'AND a.idsesion IN (SELECT MAX(c.idsesion) FROM accesos c GROUP BY c.usuario) ORDER BY a.status';
        }
        $query = mysql_query("SELECT a.idsesion,"
                . "a.usuario,"
                . "a.ip,"
                . "a.fecha,"
                . "a.status,"
                . "b.name as Nombre,"
                . "a.idempresa "
                . "FROM accesos a "
                . "INNER JOIN usuariosempresas b "
                . "ON a.usuario = b.user "
                . "WHERE b.tipo=2 "
                . "AND a.idempresa<>1 $extra");
        $i = 0;
        while ($respuesta = mysql_fetch_array($query)) {

            $this->listado[$i] = array('Id' => $respuesta['idsesion'],
                'Usuario' => $respuesta['usuario'],
                'Nombre' => $respuesta['Nombre'],
                'IP' => $respuesta['ip'],
                'Pais' => getCountryFromIP($respuesta['ip']),
                'Status' => $respuesta['status'],
                'Fecha' => $respuesta['fecha']);
            $i++;
        }
        _adios_mysql();
    }

}

?>
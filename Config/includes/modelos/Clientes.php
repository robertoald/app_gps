<?php

class Clientes {

    var $idCliente;
    var $Nombre;
    var $Pass;
    var $Correo;
    var $Direccion;
    var $Telefono;
    var $Fecha;
    var $Status;
    var $idEmpresa;
    var $Extra;
    var $Objetos = '';
    var $respuesta = array(
        'data' => '',
        'mensaje' => ''
    );
    var $listado = array();

    function setObjetos($Objeto) {
        $this->Objetos = $Objeto;
    }

    function setExtra($Extra) {
        $this->Extra = $Extra;
    }

    function setIDCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setPass($Pass) {
        $this->Pass = $Pass;
    }

    function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    function setDireccion($Direccion) {
        $this->Direccion = $Direccion;
    }

    function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    function setStatus($Status) {
        $this->Status = $Status;
    }

    function setIDEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    function __construct($idCliente, $Nombre, $Pass, $Correo, $Status, $idEmpresa, $Direccion, $Telefono) {
        $this->idCliente = $idCliente;
        $this->Nombre = $Nombre;
        $this->Pass = $Pass;
        $this->Correo = $Correo;
        $this->Status = $Status;
        $this->idEmpresa = $idEmpresa;
        $this->Direccion = $Direccion;
        $this->Telefono = $Telefono;
    }

    function _agregar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $pass = _salt(mb_strtolower($this->Correo) . $this->Pass);
        mysql_query("INSERT INTO cliente(nombre,correo,direccion,telefono,pass,fechaadd,idempresa) VALUES('$this->Nombre','$this->Correo','$this->Direccion','$this->Telefono','$pass',NOW(),$this->idEmpresa)");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Cliente registrado con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _modificar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("UPDATE cliente SET nombre='$this->Nombre', direccion='$this->Direccion', telefono='$this->Telefono', idempresa=$this->idEmpresa WHERE idcliente=$this->idCliente");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Cliente modificado con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _Status() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        switch ($this->Status) {
            case 1: $msj = 'activado';
                break;
            case 2: $msj = 'desactivado';
                break;
            case 9: $msj = 'eliminado';
                break;
        }

        mysql_query("UPDATE cliente SET status=$this->Status WHERE idcliente=$this->idCliente");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Cliente $msj con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $extra = '';
        if ($this->idEmpresa) {
            $extra = " AND a.idempresa=$this->idEmpresa";
        }
        if ($this->Extra) {
            $extra .= $this->Extra;
        }
        $i = 0;
        $inactivas = 0;
        $activas = 0;
		$sql="SELECT a.*,c.nombre AS Empresa, count(b.idvehiculo) AS vehiculos , sum(CASE WHEN b.status=1 THEN 1 ELSE 0 END) AS Activos, sum(CASE WHEN b.status=2 THEN 1 ELSE 0 END) AS Inactivos FROM cliente a LEFT JOIN vehiculos b ON a.idcliente = b.idcliente $this->Objetos INNER JOIN empresa c ON a.idempresa = c.idempresa WHERE a.Status<>3" . $extra . " GROUP BY a.idcliente ORDER BY a.nombre";
        $query = mysql_query($sql);
        while ($respuesta = mysql_fetch_array($query)) {

            $parametros = 'cliente=' . $respuesta['idcliente'];
            $parametros .= '&nombre=' . $respuesta['nombre'];
            $parametros .= '&correo=' . $respuesta['correo'];
            $parametros .= '&empresa=' . $respuesta['idempresa'];
            $parametros .= '&telefono=' . $respuesta['telefono'];
            $parametros .= '&direccion=' . $respuesta['direccion'];
            $parametros .= '&acc=modificar-Clientes';
            $parametros = '&' . _desordenar($parametros);

            $parametrosStatus = 'cliente=' . $respuesta['idcliente'];
            $parametrosStatus .= '&acc=StatusCliente';

            $icono = '';
            switch ($respuesta['status']) {
                case 1: $icono = 'ban';
                    $parametrosStatus .= '&status=2';
                    $titulo = 'Desactivar';
                    $status = 'success';
                    $text = 'Activo';
                    $activas++;
                    break;
                case 2: $icono = 'check';
                    $parametrosStatus .= '&status=1';
                    $titulo = 'Activar';
                    $status = 'danger';
                    $text = 'Inactivo';
                    $inactivas++;
                    break;
            }

            $parametrosStatus = '&' . _desordenar($parametrosStatus);

            $this->listado[$i] = array('idCliente' => $respuesta['idcliente'],
                'Nombre' => $respuesta['nombre'],
                'Correo' => $respuesta['correo'],
                'Empresa' => $respuesta['Empresa'],
                'Obj_Rastreo' => $respuesta['vehiculos'],
                'Activas' => $activas,
                'Extra' => $this->Extra,
                'Status' => '<span class="badge badge-radius badge-' . $status . '">' . $text . '</span>',
                'Inactivas' => $inactivas,
                'Indicadores' => '<span><i class="oi-radio-tower"></i><span style="font-size: 8px; margin-right: 3px" class="badge up badge-primary">' . $respuesta['vehiculos'] . '</span><span style="font-size: 8px; margin-right: 3px" class="badge up badge-success">' . $respuesta['Activos'] . '</span><span style="font-size: 8px; margin-right: 3px" class="badge up badge-danger">' . $respuesta['Inactivos'] . '</span></span>',
                'Acciones' => '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Edit" onclick="javascript: _Modal(\'Clientes\',\'Modificar Cliente\',\'' . $parametros . '\')"><i class="fa fa-wrench" aria-hidden="true"></i></button>'
                . '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Nuevo Objeto de Rastreo" onclick="javascript: _Modal(\'Clientes\',\'\',\'' . $parametros . '\',true)"><i class="fa fa-signal" aria-hidden="true"></i></button>'
                . '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Activar/Desactivar" onclick="javascript: CambiarStatus(\'' . $parametrosStatus . '\')"><i class="fa fa-' . $icono . '" aria-hidden="true"></i></button>');
            $i++;
        }
        //$this->listado="SELECT a.*,c.nombre AS Empresa, count(b.idvehiculo) AS vehiculos , sum(CASE WHEN b.status=1 THEN 1 ELSE 0 END) AS Activos, sum(CASE WHEN b.status=2 THEN 1 ELSE 0 END) AS Inactivos FROM cliente a LEFT JOIN vehiculos b ON a.idcliente = b.idcliente INNER JOIN empresa c ON a.idempresa = c.idempresa WHERE a.Status<>3" . $extra . " GROUP BY a.idcliente ORDER BY a.nombre";
        _adios_mysql();
    }

    function _Cliente($idCliente) {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        
        $query = mysql_query("SELECT * FROM cliente WHERE idcliente = $idCliente");
        while ($respuesta = mysql_fetch_array($query)) {
            $this->idCliente = $respuesta['idcliente'];
            $this->Nombre = $respuesta['nombre'];
            $this->Correo = $respuesta['correo'];
            $this->Direccion = $respuesta['direccion'];
            $this->Telefono = $respuesta['telefono'];
        }
        _adios_mysql();
    }

    function _logIn() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $resultado = mysql_fetch_array(mysql_query("SELECT * FROM cliente WHERE correo='$this->Correo'"));
        if ($resultado) {
            $pass = _salt($this->Correo . $this->Pass);
            if ($pass == $resultado['pass']) {
                $parametros = 'nombre=' . $resultado['nombre'];
                $parametros .= '&id=' . $resultado['idcliente'];
                $parametros .= '&correo=' . $resultado['correo'];
                $parametros .= '&empresa=' . $resultado['idempresa'];
                $parametros .= '&accion=in_customer&';
                $parametros = _desordenar($parametros);
                $this->respuesta['data'] = $parametros;
                $this->respuesta['mensaje'] = 'LogIn';
            } else {
                $this->respuesta['data'] = 'error';
                $this->respuesta['mensaje'] = 'Password incorrect!';
            }
        } else {
            $this->respuesta['data'] = 'error';
            $this->respuesta['mensaje'] = 'Username incorrect!';
        }
        _adios_mysql();
        return $this->respuesta;
    }

}

?>
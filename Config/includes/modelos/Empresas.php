<?php

class Empresas {
           
    var $idEmpresa;
    var $Nombre;
    var $Logo;
    var $Correo;
    var $Contacto;
    var $Telefono;
    var $Pais;
    var $Direccion;
    var $Fecha;
    var $status;
    var $Usuario;
    var $respuesta = array(
        'data' => '',
        'mensaje' => '',
        'Empresa' => ''
    );
    var $listado = array();

    function setEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    function setUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setPass($Logo) {
        $this->Logo = $Logo;
    }

    function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    function setContacto($Contacto) {
        $this->Contacto = $Contacto;
    }

    function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    function setPais($Pais) {
        $this->Pais = $Pais;
    }

    function setLogo($Logo) {
        $this->Logo = $Logo;
    }

    function setDireccion($Direccion) {
        $this->Direccion = $Direccion;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function __construct($idEmpresa, $Nombre, $Logo, $Correo, $Contacto, $Pais, $Direccion, $Telefono, $status, $Usuario) {
        $this->idEmpresa = $idEmpresa;
        $this->Nombre = $Nombre;
        $this->Logo = $Logo;
        $this->Correo = $Correo;
        $this->Contacto = $Contacto;
        $this->Pais = $Pais;
        $this->Direccion = $Direccion;
        $this->Telefono = $Telefono;
        $this->status = $status;
        $this->Usuario = $Usuario;
    }

    function _agregar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("INSERT INTO empresa(nombre,logo,correo,personacontacto,pais,direccion,telefono,dateadd,status,usuario) VALUES('$this->Nombre','$this->Logo','$this->Correo','$this->Contacto',$this->Pais,'$this->Direccion','$this->Telefono',NOW(),$this->status,'$this->Usuario')");
        $this->respuesta['Empresa'] = mysql_insert_id();
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Empresa registrada con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _modificar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("UPDATE empresa SET nombre='$this->Nombre', correo='$this->Correo', personacontacto='$this->Contacto', telefono='$this->Telefono', direccion='$this->Direccion', pais=$this->Pais WHERE idempresa=$this->idEmpresa");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Empresa modificada con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _modificarLogo() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("UPDATE empresa SET logo='$this->Logo' WHERE idempresa=$this->idEmpresa");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Empresa modificada con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _status() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        switch ($this->status){
            case 1: $msj = 'activada';
                break;
            case 2: $msj = 'desactivada';
                break;
            case 9: $msj = 'eliminada';
                break;
        }

        mysql_query("UPDATE empresa SET status=$this->status WHERE idempresa=$this->idEmpresa");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Empresa $msj con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $extra = '';
        $i = 0;
        $inactivas = 0;
        $activas = 0;
        $query = mysql_query("SELECT * FROM empresa WHERE status <> 9 " . $extra);
        while ($respuesta = mysql_fetch_array($query)) {

            $parametros = 'empresa=' . $respuesta['idempresa'];
            $parametros .= '&nombre=' . $respuesta['nombre'];
            $parametros .= '&logo=' . $respuesta['logo'];
            $parametros .= '&correo=' . $respuesta['correo'];
            $parametros .= '&personacontacto=' . $respuesta['personacontacto'];
            $parametros .= '&telefono=' . $respuesta['telefono'];
            $parametros .= '&direccion=' . $respuesta['direccion'];
            $parametros .= '&pais=' . $respuesta['pais'];
            $parametros .= '&status=' . $respuesta['status'];
            $parametros .= '&fecha=' . $respuesta['dateadd'];
            $parametros .= '&usuario=' . $respuesta['usuario'];
            $parametros .= '&acc=modificar-Empresas';
            $parametros = '&' . _desordenar($parametros);

            $parametros2 = 'usuario=' . $respuesta['usuario'];
            $parametros2 .= '&acc=CambiarUsuario';
            $parametros2 = '&' . _desordenar($parametros2);

            $parametrosStatus = 'empresa=' . $respuesta['idempresa'];
            $parametrosStatus .= '&acc=StatusEmpresa';

            $icono = '';
            switch ($respuesta['status']) {
                case 1: $icono = 'ban';
                    $parametrosStatus .= '&status=2';
                    $titulo = 'Desactivar';
                    $status = 'success';
                    $text = 'Activa';
                    $activas++;
                    break;
                case 2: $icono = 'check';
                    $parametrosStatus .= '&status=1';
                    $titulo = 'Activar';
                    $status = 'danger';
                    $text = 'Inactiva';
                    $inactivas++;
                    break;
            }

            $parametrosStatus = '&' . _desordenar($parametrosStatus);
			$acciones='<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Edit" onclick="javascript: _Modal(\'Empresas\',\'Editar Empresa\',\'' . $parametros . '\')"><i class="fa fa-wrench" aria-hidden="true"></i></button>'
                . '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Logo"  onclick="javascript: _Imagenes(\'Empresas\',\'Logo de Empresa\',\'' . $parametros . '\')"><i class="fa fa-image" aria-hidden="true"></i></button>'
                . '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Activar/Desactivar" onclick="javascript: CambiarStatus(\'' . $parametrosStatus . '\')"><i class="fa fa-' . $icono . '" aria-hidden="true"></i></button>';
            if($status != 'danger')
			$acciones=$acciones. '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Activar/Desactivar" onclick="javascript: CambiarUsuario(\'' . $parametros2 . '\')"><i class="fa fa-user" aria-hidden="true"></i></button>';
            $this->listado[$i] = array('idEmpresa' => $respuesta['idempresa'],
                'Nombre' => $respuesta['nombre'],
                'Logo' => $respuesta['logo'],
                'Correo' => $respuesta['correo'],
                'Contacto' => $respuesta['personacontacto'],
                'Direccion' => $respuesta['direccion'],
                'Telefono' => $respuesta['telefono'],
                'Fecha' => $respuesta['dateadd'],
                'Activas' => $activas,
                'Status' => '<span class="badge badge-radius badge-' . $status . '">' . $text . '</span>',
                'Inactivas' => $inactivas,
                'Acciones' => $acciones);
            $i++;
        }


        _adios_mysql();
    }
    
    function _Empresa($id) {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $query = mysql_query("SELECT * FROM empresa WHERE idempresa=$id");
        $respuesta = mysql_fetch_array($query);
        $this->idEmpresa = $respuesta['idempresa'];
        $this->Nombre = $respuesta['nombre'];
        $this->Logo = $respuesta['logo'];
        $this->Correo = $respuesta['correo'];
        $this->Contacto = $respuesta['personacontacto'];
        $this->Direccion = $respuesta['direccion'];
        $this->Telefono = $respuesta['telefono'];
        $this->Fecha = $respuesta['dateadd'];
        $this->Usuario = $respuesta['usuario'];
        $this->Pais = $respuesta['pais'];
        _adios_mysql();
    }

}

?>
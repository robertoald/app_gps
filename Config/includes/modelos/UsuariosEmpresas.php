<?php

class UsuarioAdmin {
           
    var $idUsuario;
    var $Nombre;
    var $Pass;
    var $Usuario;
    var $idEmpresa;
    var $Tipo;
    var $Status;
    var $Clientes;
    var $Objetos;
    var $respuesta = array(
        'data' => '',
        'clientes' => false,
        'objetos' => false,
        'mensaje' => ''
    );
    var $listado = array();
    var $TipoUsuarios = array();

    function setObjetos($objetos) {
        $this->Objetos = $objetos;
    }

    function setClientes($clientes) {
        $this->Clientes = $clientes;
    }

    function setIdUsuario($id) {
        $this->idUsuario = $id;
    }

    function setTipo($Tipo) {
        $this->Tipo = $Tipo;
    }

    function setPass($Pass) {
        $this->Pass = $Pass;
    }

    function setUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }

    function setEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    function setStatus($status) {
        $this->Status = $status;
    }

    function __construct($Nombre, $Pass, $Usuario, $idEmpresa, $Tipo) {
        $this->Nombre = $Nombre;
        $this->Pass = $Pass;
        $this->Usuario = $Usuario;
        $this->idEmpresa = $idEmpresa;
        $this->Tipo = $Tipo;
    }

    function _agregar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        if ($this->Tipo) {
            $tipo = $this->Tipo;
        } else {
            $tipo = 1;
        }

        $pass = _salt(mb_strtolower($this->Usuario) . $this->Pass);
        mysql_query("INSERT INTO usuariosempresas(user,pass,idempresa,name,status,tipo) VALUES('$this->Usuario','$pass','$this->idEmpresa','$this->Nombre',1,$tipo)");
        if ($tipo === '3') {
            $data = 'Clientes';
            $this->respuesta['clientes'] = '&' . _desordenar('usuario=' . mysql_insert_id());
        } else {
            $data = 'Exito';
        }
        $this->respuesta['data'] = $data;
        $this->respuesta['mensaje'] = "Usuario registrado con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _cambiarClave() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $pass = _salt(mb_strtolower($this->Usuario) . $this->Pass);
        mysql_query("UPDATE usuariosempresas SET pass='$pass' WHERE user='$this->Usuario'");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Contraseña actualizada con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _ClientesSupervisados() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("UPDATE usuariosempresas SET clientes='$this->Clientes' WHERE idusuariosempresas=$this->idUsuario");
        $this->respuesta['data'] = 'Objetos';
        $this->respuesta['objetos'] = '&' . _desordenar('usuario=' . $this->idUsuario);
        $this->respuesta['mensaje'] = "Usuario modificado con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _ObjetosSupervisados() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("UPDATE usuariosempresas SET objetos='$this->Objetos' WHERE idusuariosempresas=$this->idUsuario");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Usuario modificado con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _modificar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $parametros = '';
        if ($this->Nombre) {
            $parametros .= "name='$this->Nombre' ";
        }
        if ($this->idEmpresa) {
            $parametros .= ",idempresa=$this->idEmpresa ";
        }
        if ($this->Tipo) {
            $parametros .= ",tipo=$this->Tipo ";
        }
        mysql_query("UPDATE usuariosempresas SET $parametros WHERE idusuariosempresas=$this->idUsuario");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Usuario modificado con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _status() {
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

        mysql_query("UPDATE usuariosempresas SET status=$this->Status WHERE idusuariosempresas=$this->idUsuario");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Usuario $msj con Éxito";

        _adios_mysql();
        return $this->respuesta;
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $i = 0;
        $extra = '';
        $inactivas = 0;
        $activas = 0;
        if ($this->idEmpresa) {
            $extra = " AND a.idempresa=$this->idEmpresa";
        }
        $query = mysql_query("SELECT a.tipo,a.idusuariosempresas,a.name,a.user,a.status,a.idempresa,b.nombre AS NombreEmpresa FROM gps.usuariosempresas a INNER JOIN gps.empresa b ON a.idempresa = b.idempresa WHERE a.status<3 AND b.status<3" . $extra);
        while ($respuesta = mysql_fetch_array($query)) {

            $parametros = 'usuario=' . $respuesta['idusuariosempresas'];
            $parametros .= '&nombre=' . $respuesta['name'];
            $parametros .= '&user=' . $respuesta['user'];
            $parametros .= '&empresa=' . $respuesta['idempresa'];
            $parametros .= '&status=' . $respuesta['status'];
            $parametros .= '&tipo=' . $respuesta['tipo'];
            $parametros .= '&acc=modificar-Usuarios';
            $parametros = '&' . _desordenar($parametros);
            $icono = '';

            $parametrosStatus = 'usuario=' . $respuesta['idusuariosempresas'];
            $parametrosStatus .= '&acc=StatusUsuario';

            $parametrosEliminar = $parametrosStatus . '&status=9';
            $parametrosEliminar = '&' . _desordenar($parametrosEliminar);
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
            $Acciones = '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Edit" onclick="javascript: _Modal(\'Usuarios\',\'Editar Usuario\',\'' . $parametros . '\')"><i class="fa fa-wrench" aria-hidden="true"></i></button>'
                    . '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Activar/Desactivar" onclick="javascript: CambiarStatus(\'' . $parametrosStatus . '\')"><i class="fa fa-' . $icono . '" aria-hidden="true"></i></button>';

            switch ($respuesta['tipo']) {
                case 1:
                    $tipo = 'General';
                    break;
                case 2:
                    $tipo = 'Administrador';
                    break;
                case 3:
                    $tipo = 'Supervisor';
                    $Acciones.='<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Supervisados" onclick="_menu(\'Supervisor_Clientes\', \'' . $parametros . '\')"><i class="fa fa-users" aria-hidden="true"></i></button>';
                    break;
            }

            $Acciones .= '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Eliminar" onclick="javascript: EliminarCampo(\'' . $parametrosEliminar . '\', \'Usuario\')"><i class="fa fa-trash" aria-hidden="true"></i></button>';

            $this->listado[$i] = array('idUsuario' => $respuesta['idusuariosempresas'],
                'Nombre' => $respuesta['name'],
                'User' => $respuesta['user'],
                'Empresa' => $respuesta['NombreEmpresa'],
                'Activas' => $activas,
                'Tipo' => '<span class="badge badge-radius badge-primary">' . $tipo . '</span>',
                'Status' => '<span class="badge badge-radius badge-' . $status . '">' . $text . '</span>',
                'Inactivas' => $inactivas,
                'Acciones' => $Acciones);
            $i++;
        }
        _adios_mysql();
    }

    function _logIn() {
        require_once '../conexiones_config.php';
        _bienvenido_mysql();
        $resultado = mysql_fetch_array(mysql_query("SELECT a.*,b.nombre as NombreEmpresa,b.logo FROM usuariosempresas a INNER JOIN empresa b ON a.idempresa = b.idempresa WHERE user='$this->Usuario'"));
        if ($resultado) {
            $pass = _salt($this->Usuario . $this->Pass);
            if ($pass == $resultado['pass']) {
                $parametros = 'nombre=' . $resultado['name'];
                $parametros .= '&id=' . $resultado['idusuariosempresas'];
                $parametros .= '&logo=' . $resultado['logo'];
                $parametros .= '&tipo=' . $resultado['tipo'];
                $parametros .= '&user=' . $resultado['user'];
                $parametros .= '&empresa=' . $resultado['idempresa'];
                $parametros .= '&NombreEmpresa=' . $resultado['NombreEmpresa'];
                if ($resultado['idempresa'] == 1) {
                    $parametros .= '&accion=in_SupraAdmin&';
                } else {
                    $parametros .= '&accion=in_admin';
                }
                $parametros = _desordenar($parametros);
                $this->respuesta['data'] = $parametros;
                $this->respuesta['mensaje'] = 'LogIn';
            } else {
                $this->respuesta['data'] = 'error';
                $this->respuesta['mensaje'] = 'Contraseña incorrecta!';
            }
        } else {
            $this->respuesta['data'] = 'error';
            $this->respuesta['mensaje'] = 'Usuario incorrecto!';
        }

        _adios_mysql();
        return $this->respuesta;
    }

    function _CambiarUsuario() {
        require_once '../conexiones_config.php';
        _bienvenido_mysql();
        $resultado = mysql_fetch_array(mysql_query("SELECT a.*,b.nombre as NombreEmpresa, b.logo FROM usuariosempresas a INNER JOIN empresa b ON a.idempresa = b.idempresa WHERE a.user='$this->Usuario' AND a.tipo = 2"));
        if ($resultado) {
            $parametros = 'nombre=' . $resultado['name'];
            $parametros .= '&id=' . $resultado['idusuariosempresas'];
            $parametros .= '&logo=' . $resultado['logo'];
            $parametros .= '&tipo=' . $resultado['tipo'];
            $parametros .= '&user=' . $resultado['user'];
            $parametros .= '&empresa=' . $resultado['idempresa'];
            $parametros .= '&NombreEmpresa=' . $resultado['NombreEmpresa'];
            $parametros .= '&acc=in_admin';
            $parametros = _desordenar($parametros);
            $this->respuesta['data'] = $parametros;
            $this->respuesta['mensaje'] = 'LogIn';
        }
        _adios_mysql();
        return $this->respuesta;
    }
               
    function _Validar($Usuario) {
        require_once '../conexiones_config.php';
        _bienvenido_mysql();

        $query = mysql_query("SELECT a.* FROM usuariosempresas a WHERE a.user='$Usuario' ");
        $rows = mysql_num_rows($query);
        $this->respuesta['data'] = $rows;

        _adios_mysql();
        return $this->respuesta['data'];
    }

    function _Usuario($id) {
        require_once '../conexiones_config.php';
        _bienvenido_mysql();

        $query = mysql_query("SELECT a.* FROM usuariosempresas a WHERE a.idusuariosempresas=$id ");
        $rows = mysql_fetch_array($query);
        $this->Nombre = $rows['name'];
        $this->Usuario = $rows['user'];
        $this->Tipo = $rows['tipo'];
        $this->idUsuario = $rows['idusuariosempresas'];
        $this->idEmpresa = $rows['idempresa'];
        $this->Clientes = $rows['clientes'];
        $this->Objetos = $rows['objetos'];
        _adios_mysql();
    }

    function _TipoUsuarios() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $i = 0;
        $query = mysql_query("SELECT id_tipos,descripcion "
                . "FROM tipos_usuarios "
                . "WHERE id_tipos<>2");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->TipoUsuarios[$i] = array('Tipo' => $respuesta['id_tipos'],
                'Descripcion' => $respuesta['descripcion']);
            $i++;
        }
        _adios_mysql();
    }

}

?>
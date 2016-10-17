<?php

class Vehiculos {

    var $idVehiculo;
    var $IMEI;
    var $Placa;
    var $Nombre;
    var $idCliente;
    var $idEmpresa;
    var $idObjeto;
    var $Fecha;
    var $status;
    var $idIcono;
    var $Direccion;
    var $Telefono;
    var $Contacto;
    var $Comentario;
    var $TipoEspecifico;
    var $Año;
    var $km_Actual;
    var $IP;
    var $ModeloGPS;
    var $SyncE;
    var $TipoVehiculo;
    var $Marca;
    var $Modelo;
    var $Extra;
    var $listado = array();
    var $TiposVehiculos = array();
    var $Animales = array();
    var $Marcas = array();
    var $Modelos = array();
    var $TipoObjeto = array();
    var $respuesta = array(
        'data' => '',
        'mensaje' => ''
    );

    function setExtra($Extra) {
        $this->Extra = $Extra;
    }

    function setObjeto($Objeto) {
        $this->idObjeto = $Objeto;
    }

    function setSyncE($SyncE) {
        $this->SyncE = $SyncE;
    }

    function setModeloGPS($ModeloGPS) {
        $this->ModeloGPS = $ModeloGPS;
    }

    function setIP($IP) {
        $this->IP = $IP;
    }

    function setID($idVehiculo) {
        $this->idVehiculo = $idVehiculo;
    }

    function setKMActual($KMActual) {
        $this->km_Actual = $KMActual;
    }

    function setAño($Año) {
        $this->Año = $Año;
    }

    function setComentario($Comentario) {
        $this->Comentario = $Comentario;
    }

    function setContacto($Contacto) {
        $this->Contacto = $Contacto;
    }

    function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    function setDireccion($Direccion) {
        $this->Direccion = $Direccion;
    }

    function setTipoObjeto($TipoObjeto) {
        $this->TipoObjeto = $TipoObjeto;
    }

    function setTipoEspecifico($TipoEspecifico) {
        $this->TipoEspecifico = $TipoEspecifico;
    }

    function setModelo($Modelo) {
        $this->Modelo = $Modelo;
    }

    function setMarca($Marca) {
        $this->Marca = $Marca;
    }

    function setTipo($Tipo) {
        $this->TipoVehiculo = $Tipo;
    }

    function setIMEI($imei) {
        $this->IMEI = $imei;
    }

    function setPlaca($Placa) {
        $this->Placa = $Placa;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setIDCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    function setIDEmpresa($idEmpresa) {
        $this->idEmpresa = $idEmpresa;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setIcono($idIcono) {
        $this->idIcono = $idIcono;
    }

    function __construct($idVehiculo, $imei, $Placa, $Nombre, $idCliente, $idEmpresa, $idIcono) {
        $this->idVehiculo = $idVehiculo;
        $this->IMEI = $imei;
        $this->Placa = $Placa;
        $this->Nombre = $Nombre;
        $this->idCliente = $idCliente;
        $this->idEmpresa = $idEmpresa;
        $this->idIcono = $idIcono;
    }

    function _agregar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("UPDATE vehiculos SET placa='$this->Placa', nombre='$this->Nombre', idcliente=$this->idCliente, idempresa=$this->idEmpresa, icono=$this->idIcono, fechaadd = NOW(), status = 1 WHERE imei='$this->IMEI'");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Vehículo registrado con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _agregarObjeto() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $bandera = true;
        mysql_query('START TRANSACTION');
        $insert = mysql_query("INSERT INTO objetos_detalles(tipo_objeto,nombre,direccion,telefono,contacto,comentario,tipo_especifico,marca,modelo,placa,año,km_Actual,icono) "
                . "VALUE($this->TipoObjeto,'$this->Nombre','$this->Direccion','$this->Telefono','$this->Contacto','$this->Comentario',"
                . "$this->TipoEspecifico,$this->Marca,$this->Modelo,'$this->Placa','$this->Año','$this->km_Actual',$this->idIcono)");
        if ($insert) {
            $idObjeto = mysql_insert_id();
            $insertV = mysql_query("INSERT INTO vehiculos(idobjeto, modelo, ip, synce, idcliente, idempresa, fechaadd, status, imei) "
                    . "VALUE($idObjeto,'$this->ModeloGPS','$this->IP','$this->SyncE',$this->idCliente,$this->idEmpresa,NOW(),1,'$this->IMEI')");
            if ($insertV) {
                $bandera = true;
            } else {
                $bandera = false;
            }
        } else {
            $bandera = false;
        }
        if ($bandera) {
            mysql_query('COMMIT');
            $this->respuesta['data'] = "Exito";
            $this->respuesta['mensaje'] = "Objeto de Rastreo registrado con éxito!";
        } else {
            mysql_query('ROLLBACK');
            $this->respuesta['data'] = "Error";
            $this->respuesta['mensaje'] = "Error al registrar Objeto de Rastreo, verifique la información suministrada e intentelo de nuevo!";
        }
        _adios_mysql();
        return $this->respuesta;
    }

    function _modificarObjetos() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        mysql_query("UPDATE objetos_detalles SET nombre='$this->Nombre',direccion='$this->Direccion',telefono='$this->Telefono',contacto='$this->Contacto',comentario='$this->Comentario',tipo_especifico=$this->TipoEspecifico,marca=$this->Marca,modelo=$this->Modelo,placa='$this->Placa',año='$this->Año',km_Actual='$this->km_Actual',icono=$this->idIcono WHERE idobjeto=$this->idObjeto ");
        $afectados = mysql_affected_rows();
        if ($afectados > 0) {
            $this->respuesta['data'] = "Exito";
            $this->respuesta['mensaje'] = "Objeto de Rastreo modificado con éxito!";
        } else {
            $this->respuesta['data'] = "Error";
            $this->respuesta['mensaje'] = "Error al actualizar la información del objeto, intentelo más tarde";
        }

        _adios_mysql();
        return $this->respuesta;
    }

    function _modificar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        mysql_query("UPDATE vehiculos SET placa='$this->Placa', nombre='$this->Nombre', icono=$this->idIcono WHERE idvehiculo='$this->idVehiculo'");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Vehículo modificado con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _status() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        switch ($this->status) {
            case 1: $msj = 'activado';
                break;
            case 2: $msj = 'desactivado';
                break;
            case 9: $msj = 'eliminado';
                break;
        }

        mysql_query("UPDATE vehiculos SET status=$this->status WHERE idvehiculo=$this->idVehiculo");
        $this->respuesta['data'] = "Exito";
        $this->respuesta['mensaje'] = "Objeto $msj con éxito!";

        _adios_mysql();
        return $this->respuesta;
    }

    function _Modelos() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $i = 0;
        $query = mysql_query("SELECT a.idModelo,a.descripcion "
                . "FROM vehiculos_modelos a "
                . "WHERE idMarca=$this->Marca");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->Modelos[$i] = array('id' => $respuesta['idModelo'],
                'Descripcion' => $respuesta['descripcion']);
            $i++;
        }
        _adios_mysql();
    }

    function _Marcas() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $i = 0;
        $query = mysql_query("SELECT a.idMarca,a.descripcion "
                . "FROM vehiculos_marcas a "
                . "WHERE tipovehiculo=$this->TipoVehiculo");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->Marcas[$i] = array('id' => $respuesta['idMarca'],
                'Descripcion' => $respuesta['descripcion']);
            $i++;
        }
        _adios_mysql();
    }

    function _Animales() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $i = 0;
        $query = mysql_query("SELECT a.id,a.descripcion "
                . "FROM tipos_animales a "
                . "WHERE 1=1");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->Animales[$i] = array('id' => $respuesta['id'],
                'Descripcion' => $respuesta['descripcion']);
            $i++;
        }
        _adios_mysql();
    }

    function _TiposVehiculos() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $i = 0;
        $query = mysql_query("SELECT a.id,a.descripcion "
                . "FROM tipos_vehiculos a "
                . "WHERE 1=1");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->TiposVehiculos[$i] = array('id' => $respuesta['id'],
                'Descripcion' => $respuesta['descripcion']);
            $i++;
        }
        _adios_mysql();
    }

    function _TipoObjetos() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();

        $i = 0;
        $query = mysql_query("SELECT a.idtipo_objeto,a.descripcion,a.detalle "
                . "FROM tipos_objetos a "
                . "WHERE 1=1");

        while ($respuesta = mysql_fetch_array($query)) {

            $this->TipoObjeto[$i] = array('Tipo' => $respuesta['idtipo_objeto'],
                'Descripcion' => $respuesta['descripcion'],
                'Detalle' => $respuesta['detalle']);
            $i++;
        }
        _adios_mysql();
    }

    function _listar() {
        include_once '../conexiones_config.php';
        _bienvenido_mysql();
        $extra = '';
        if ($this->idCliente) {
            $extra = " AND a.idcliente=$this->idCliente";
        }
        if ($this->Extra) {
            $extra .= $this->Extra;
        }

        $i = 0;
        $inactivas = 0;
        $activas = 0;
        $query = mysql_query("SELECT a.idvehiculo,"
                . "a.imei,"
                . "f.*,"
                . "g.descripcion,"
                . "a.idobjeto as Objeto,"
                . "a.idcliente,"
                . "a.idempresa,"
                . "a.idobjeto,"
                . "a.fechaadd,"
                . "f.icono,"
                . "e.nombre AS IconoNombre,"
                . "c.lat,"
                . "c.log,"
                . "c.fechagps,"
                . "c.grados,"
                . "a.status AS st_vehiculo,"
                . "b.nombre AS nombre_cliente,"
                . "b.status AS st_cliente,"
                . "d.nombre AS Nombre_Emp "
                . "FROM vehiculos a "
                . "INNER JOIN cliente b "
                . "ON a.idcliente = b.idcliente "
                . "LEFT JOIN posicion c "
                . "ON a.idvehiculo = c.idvehiculo "
                . "LEFT JOIN empresa d "
                . "ON a.idempresa = d.idempresa "
                . "LEFT JOIN objetos_detalles f "
                . "ON a.idobjeto = f.idobjeto "
                . "LEFT JOIN iconos e "
                . "ON f.icono = e.id_icono "
                . "LEFT JOIN tipos_objetos g "
                . "ON f.tipo_objeto = g.idtipo_objeto "
                . "WHERE a.status <> 3" . $extra);

        while ($respuesta = mysql_fetch_array($query)) {
            $parametro = 'vehiculo=' . $respuesta['idvehiculo'];
            $parametro .= '&objeto=' . $respuesta['Objeto'];
            $parametro .= '&cliente=' . $respuesta['idcliente'];
            $parametro .= '&empresa=' . $respuesta['idempresa'];
            $parametro .= '&imei=' . $respuesta['imei'];
            $parametro .= '&placa=' . $respuesta['placa'];
            $parametro .= '&nombreV=' . $respuesta['nombre'];
            $parametro .= '&direccion=' . $respuesta['direccion'];
            $parametro .= '&telefono=' . $respuesta['telefono'];
            $parametro .= '&contacto=' . $respuesta['contacto'];
            $parametro .= '&comentario=' . $respuesta['comentario'];
            $parametro .= '&marca=' . $respuesta['marca'];
            $parametro .= '&modelo=' . $respuesta['modelo'];
            $parametro .= '&tipo_especifico=' . $respuesta['tipo_especifico'];
            $parametro .= '&tipo_objeto=' . $respuesta['tipo_objeto'];
            $parametro .= '&km_Actual=' . $respuesta['km_Actual'];
            $parametro .= '&año=' . $respuesta['año'];
            $parametro .= '&empresa=' . $respuesta['Nombre_Emp'];
            $parametro .= '&icono=' . $respuesta['icono'];
            $parametro .= '&foto=' . $respuesta['foto'];

            $parametros = '&' . _desordenar($parametro . '&acc=Recorridos');
            $parametro2 = '&' . _desordenar($parametro . '&acc=modificar-Vehiculos');

            $parametrosStatus = 'vehiculo=' . $respuesta['idvehiculo'];
            $parametrosStatus .= '&acc=StatusVehiculo';

            $icono = '';
            switch ($respuesta['st_vehiculo']) {
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

            $this->listado[$i] = array('idVehiculo' => $respuesta['idvehiculo'],
                'IMEI' => $respuesta['imei'],
                'Placa' => $respuesta['placa'],
                'Nombre' => $respuesta['nombre'],
                'Fecha' => $respuesta['fechaadd'],
                'TipoObjeto' => $respuesta['descripcion'],
                'Cliente' => $respuesta['nombre_cliente'],
                'Lat' => $respuesta['lat'],
                'Log' => $respuesta['log'],
                'FechaGPS' => $respuesta['fechagps'],
                'Grados' => $respuesta['grados'],
                'Empresa' => $respuesta['Nombre_Emp'],
                'Icono' => $respuesta['IconoNombre'],
                'Parametros' => $parametros,
                'Activas' => $activas,
				'Foto' => $respuesta['foto'],
                'Status' => '<span class="badge badge-radius badge-' . $status . '">' . $text . '</span>',
                'Inactivas' => $inactivas,
                'Acciones' => '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Edit" onclick="javascript: _Modal(\'Vehiculos\',\'Modificar Vehiculo\',\'' . $parametro2 . '\')"><i class="fa fa-wrench" aria-hidden="true"></i></button>'
                . '<button type="button" class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Activar/Desactivar" onclick="javascript: CambiarStatus(\'' . $parametrosStatus . '\')"><i class="fa fa-' . $icono . '" aria-hidden="true"></i></button>');
            $i++;
        }
        //$this->listado = $extra;
        _adios_mysql();
    }

    function _Validar($IMEI) {
        require_once '../conexiones_config.php';
        _bienvenido_mysql();

        $query = mysql_query("SELECT a.* FROM vehiculos a WHERE a.imei='$IMEI' ");
        $rows = mysql_num_rows($query);
        $this->respuesta['data'] = $rows;

        _adios_mysql();
        return $this->respuesta['data'];
    }

}

?>
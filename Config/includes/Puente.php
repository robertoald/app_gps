<?php

session_start();
$data = file_get_contents('php://input');
$json = json_decode($data, true);
$respuesta = array(
    'data' => 'error',
    'mensaje' => 'No Action!');

if (isset($json['acc'])) {


    /*     * ******************************** */
    /*      Accines relacionadas a Empresas   */
    /*     * ******************************** */
    if ($json['acc'] == 'agregar-Empresas') {
        require '../includes/modelos/Empresas.php';
        require '../includes/modelos/UsuariosEmpresas.php';

        $empresas = new Empresas($idEmpresa, $json['NombreEmpresa'], $Logo, $json['CorreoEmpresa'], $json['ContactoEmpresa'], $json['PaisEmpresa'], $json['DireccionEmpresa'], $json['TelefonoEmpresa'], 1, $json['UsuarioEmpresa']);
        $respuesta = $empresas->_agregar();
        $usuarioempresa = new UsuarioAdmin($json['NombreEmpresa'], $json['ContraseñaEmpresa'], $json['UsuarioEmpresa'], $respuesta['Empresa']);
        $usuarioempresa->setTipo(2);
        $usuarioempresa->_agregar();
    }
    if ($json['acc'] == 'modificar-Empresas') {
        require '../includes/modelos/Empresas.php';

        $empresas = new Empresas($json['Empresa'], $json['NombreEmpresa'], $Logo, $json['CorreoEmpresa'], $json['ContactoEmpresa'], $json['PaisEmpresa'], $json['DireccionEmpresa'], $json['TelefonoEmpresa']);
        $respuesta = $empresas->_modificar();
    }

    /*     * ******************************** */
    /*      Accines relacionadas a Usuarios   */
    /*     * ******************************** */
    if ($json['acc'] == 'agregar-VehiculosSupervisados') {
        require '../includes/modelos/UsuariosEmpresas.php';

        if (strlen($json['VehiculosSupervisados']) > 1) {
            $Objetos = substr($json['VehiculosSupervisados'], 1);
            $Objetos = substr($Objetos, 0, -1);
            $usuario = new UsuarioAdmin();
            $usuario->setIdUsuario($json['Usuario']);
            $usuario->setObjetos($Objetos);
            $respuesta = $usuario->_ObjetosSupervisados();
        } else {
            $respuesta['mensaje'] = 'No hay Objetos seleccionados';
        }
    }
    if ($json['acc'] == 'agregar-ClientesSupervisados') {
        require '../includes/modelos/UsuariosEmpresas.php';

        if (strlen($json['ClientesSupervisados']) > 1) {
            $Clientes = substr($json['ClientesSupervisados'], 1);
            $Clientes = substr($Clientes, 0, -1);
            $usuario = new UsuarioAdmin();
            $usuario->setIdUsuario($json['Usuario']);
            $usuario->setClientes($Clientes);
            $respuesta = $usuario->_ClientesSupervisados();
        } else {
            $respuesta['mensaje'] = 'No hay clientes seleccionados';
        }
    }
    if ($json['acc'] == 'userPass') {
        require '../includes/modelos/UsuariosEmpresas.php';

        $usuario = new UsuarioAdmin();
        $usuario->setUsuario($json['UserUsuario']);
        $usuario->setPass($json['ClaveUsuario']);
        $respuesta = $usuario->_cambiarClave();
    }
    if ($json['acc'] == 'agregar-Usuarios') {
        require '../includes/modelos/UsuariosEmpresas.php';

        $usuario = new UsuarioAdmin($json['NombreUsuario'], $json['ClaveUsuario'], $json['UserUsuario'], $json['EmpresaUsuario'], $json['TipoUsuario']);
        $respuesta = $usuario->_agregar();
    }
    if ($json['acc'] == 'modificar-Usuarios') {
        require '../includes/modelos/UsuariosEmpresas.php';

        $usuario = new UsuarioAdmin($json['NombreUsuario'], $Pass, $User, $json['EmpresaUsuario']);
        if (isset($json['TipoUsuario']) && $json['TipoUsuario'] !== '') {
            $usuario->setTipo($json['TipoUsuario']);
        }
        $usuario->setIdUsuario($json['Usuario']);
        $respuesta = $usuario->_modificar();
    }

    /*     * ******************************** */
    /*      Accines relacionadas a Clientes   */
    /*     * ******************************** */
    if ($json['acc'] == 'agregar-Clientes') {
        require '../includes/modelos/Clientes.php';

        $clientes = new Clientes('', $json['NombreCliente'], $json['ClaveCliente'], $json['CorreoCliente'], 1, $json['EmpresaCliente'], $json['DireccionCliente'], $json['TelefonoCliente']);
        $respuesta = $clientes->_agregar();
    }
    if ($json['acc'] == 'modificar-Clientes') {
        require '../includes/modelos/Clientes.php';

        $clientes = new Clientes($json['Cliente'], $json['NombreCliente'], $pass, $json['CorreoCliente'], $status, $json['EmpresaCliente'], $json['DireccionCliente'], $json['TelefonoCliente']);
        $respuesta = $clientes->_modificar();
    }

    /*     * ****************************************** */
    /*      Accines relacionadas a Objetos de Rastreo   */
    /*     * ****************************************** */
    if ($json['acc'] == 'agregar-ObjetoRastreo') {
        require '../includes/modelos/Vehiculos.php';

        $vehiculo = new Vehiculos();
        isset($json['NombreObjeto']) ? $vehiculo->setNombre($json['NombreObjeto']) : $vehiculo->setNombre('');
        isset($json['Cliente']) ? $vehiculo->setIDCliente($json['Cliente']) : $vehiculo->setIDCliente('');
        isset($json['Empresa']) ? $vehiculo->setIDEmpresa($json['Empresa']) : $vehiculo->setIDEmpresa('');
        isset($json['TipoObjeto']) ? $vehiculo->setTipoObjeto($json['TipoObjeto']) : $vehiculo->setTipoObjeto(0);
        isset($json['DireccionObjeto']) ? $vehiculo->setDireccion($json['DireccionObjeto']) : $vehiculo->setDireccion('');
        isset($json['TelefonoObjeto']) ? $vehiculo->setTelefono($json['TelefonoObjeto']) : $vehiculo->setTelefono('');
        isset($json['ContactoObjeto']) ? $vehiculo->setContacto($json['ContactoObjeto']) : $vehiculo->setContacto('');
        isset($json['ComentarioObjeto']) ? $vehiculo->setComentario($json['ComentarioObjeto']) : $vehiculo->setComentario('');
        isset($json['TipoCaracteristico']) ? $vehiculo->setTipoEspecifico($json['TipoCaracteristico']) : $vehiculo->setTipoEspecifico(0);
        isset($json['MarcaObjeto']) ? $vehiculo->setMarca($json['MarcaObjeto']) : $vehiculo->setMarca(0);
        isset($json['ModeloObjeto']) ? $vehiculo->setModelo($json['ModeloObjeto']) : $vehiculo->setModelo(0);
        isset($json['PlacaObjeto']) ? $vehiculo->setPlaca($json['PlacaObjeto']) : $vehiculo->setPlaca('');
        isset($json['AnioObjeto']) ? $vehiculo->setAño($json['AnioObjeto']) : $vehiculo->setAño('');
        isset($json['kmActual']) ? $vehiculo->setKMActual($json['kmActual']) : $vehiculo->setKMActual('');
        isset($json['IconoObjeto']) ? $vehiculo->setIcono($json['IconoObjeto']) : $vehiculo->setIcono('');
        isset($json['IMEI']) ? $vehiculo->setIMEI($json['IMEI']) : $vehiculo->setIMEI('');
        isset($json['IP']) ? $vehiculo->setIP($json['IP']) : $vehiculo->setIP('');
        isset($json['ModeloGPS']) ? $vehiculo->setModeloGPS($json['ModeloGPS']) : $vehiculo->setModeloGPS('');
        isset($json['SyncE']) ? $vehiculo->setSyncE($json['SyncE']) : $vehiculo->setSyncE('');
        $respuesta = $vehiculo->_agregarObjeto();
    }
    if ($json['acc'] == 'modificar-ObjetoRastreo') {
        require '../includes/modelos/Vehiculos.php';

        $vehiculo = new Vehiculos();
        isset($json['NombreObjeto']) ? $vehiculo->setNombre($json['NombreObjeto']) : $vehiculo->setNombre('');
        isset($json['DireccionObjeto']) ? $vehiculo->setDireccion($json['DireccionObjeto']) : $vehiculo->setDireccion('');
        isset($json['TelefonoObjeto']) ? $vehiculo->setTelefono($json['TelefonoObjeto']) : $vehiculo->setTelefono('');
        isset($json['ContactoObjeto']) ? $vehiculo->setContacto($json['ContactoObjeto']) : $vehiculo->setContacto('');
        isset($json['ComentarioObjeto']) ? $vehiculo->setComentario($json['ComentarioObjeto']) : $vehiculo->setComentario('');
        isset($json['TipoCaracteristico']) ? $vehiculo->setTipoEspecifico($json['TipoCaracteristico']) : $vehiculo->setTipoEspecifico(0);
        isset($json['MarcaObjeto']) ? $vehiculo->setMarca($json['MarcaObjeto']) : $vehiculo->setMarca(0);
        isset($json['ModeloObjeto']) ? $vehiculo->setModelo($json['ModeloObjeto']) : $vehiculo->setModelo(0);
        isset($json['PlacaObjeto']) ? $vehiculo->setPlaca($json['PlacaObjeto']) : $vehiculo->setPlaca('');
        isset($json['AnioObjeto']) ? $vehiculo->setAño($json['AnioObjeto']) : $vehiculo->setAño('');
        isset($json['kmActual']) ? $vehiculo->setKMActual($json['kmActual']) : $vehiculo->setKMActual('');
        isset($json['IconoObjeto']) ? $vehiculo->setIcono($json['IconoObjeto']) : $vehiculo->setIcono('');
        isset($json['Objeto']) ? $vehiculo->setObjeto($json['Objeto']) : $vehiculo->setObjeto('');
        $respuesta = $vehiculo->_modificarObjetos();
    }

    /*     * ********************************* */
    /*      Accines relacionadas a Geocercas   */
    /*     * ********************************* */
    if ($json['acc'] == 'agregar-Geocercas') {
        require '../includes/modelos/Geocercas.php';
        $geocercas = $json['PuntosGeo'];
        if (isset($json['RadioGeo'])) {
            $Radio = $json['RadioGeo'];
        } else {
            $Radio = '';
        }
        $geocercas = str_replace('\n', '', $geocercas);
        $geocercas = str_replace(',', '', $geocercas);
        $geocercas = str_replace(')(', ',', $geocercas);
        $geocercas = str_replace(')', '', $geocercas);
        $geocercas = str_replace('(', '', $geocercas);
        $array = split(",", $geocercas);

        if ($json['Tipo'] === '1') {
            $array = split(",", $geocercas);
            $geocercas = '(' . $geocercas . ',' . $array[0] . ')';
        } else {
            $geocercas = '(' . $geocercas . ')';
        }
        $geocerca = new Geocercas($idGeocerca, $json['NombreGeo'], $geocercas, $Fecha, $json['Cliente'], $Radio, $json['Tipo']);
        $respuesta = $geocerca->_agregar();
    }
    if ($json['acc'] == 'modificar-Geocercas') {
        require '../includes/modelos/Geocercas.php';
        $geocercas = $json['PuntosGeo'];
        if (isset($json['RadioGeo'])) {
            $Radio = $json['RadioGeo'];
        } else {
            $Radio = '';
        }
        $geocercas = str_replace('\n', '', $geocercas);
        $geocercas = str_replace(',', '', $geocercas);
        $geocercas = str_replace(')(', ',', $geocercas);
        $geocercas = str_replace(')', '', $geocercas);
        $geocercas = str_replace('(', '', $geocercas);

        if ($json['Tipo'] === '1') {
            $array = split(",", $geocercas);
            $geocercas = '(' . $geocercas . ',' . $array[0] . ')';
        } else {
            $geocercas = '(' . $geocercas . ')';
        }
        $geocerca = new Geocercas($json['Geocerca'], $json['NombreGeo'], $geocercas, $Fecha, $idCliente, $Radio, $json['Tipo']);
        $respuesta = $geocerca->_modificar();
    }

    /*     * ********************************* */
    /*      Accines relacionadas a Notificaciones   */
    /*     * ********************************* */

    if ($json['acc'] == 'agregar-Notificaciones') {
        require '../includes/modelos/Notificaciones.php';
        if ($json['TipoAlerta'] === '1') {
            $alerta = $json['EventoNotif'];
        }
        if ($json['TipoAlerta'] === '2') {
            $alerta = $json['GeocercaNotif'];
        }
        if ($json['TipoAlerta'] === '3') {
            $alerta = $json['VelocidadNotif'];
        }

        $notificacion = new Notificaciones($idNotificacion, $json['DestinoNotif'], $json['TipoNotif'], $json['ClienteNotif'], $json['VehiculoNotif'], $UltimoEnviado, $Fecha, $json['TipoAlerta'], $alerta, $Aux3);
        $respuesta = $notificacion->_agregar();
    }
    if ($json['acc'] == 'modificar-Notificaciones') {
        require '../includes/modelos/Notificaciones.php';
        if ($json['TipoAlerta'] === '1') {
            $alerta = $json['EventoNotif'];
        }
        if ($json['TipoAlerta'] === '2') {
            $alerta = $json['GeocercaNotif'];
        }
        if ($json['TipoAlerta'] === '3') {
            $alerta = $json['VelocidadNotif'];
        }
        $notificacion = new Notificaciones();
        $notificacion->setID($json['Notificacion']);
        $notificacion->setDestino($json['DestinoNotif']);
        $notificacion->setTipo($json['TipoNotif']);
        $notificacion->setTipoAlerta($json['TipoAlerta']);
        $notificacion->setAlerta($alerta);
        $notificacion->setVehiculo($json['VehiculoNotif']);
        $respuesta = $notificacion->_modificar();
    }


    /*     * ****************************** */
    /*      Accines relacionadas al LogIn   */
    /*     * ****************************** */
    if ($json['acc'] == 'LogIn-Admin') {
        require '../includes/modelos/UsuariosEmpresas.php';

        $user = mb_strtolower($json['user']);
        if (isset($user) && $user != '' && isset($json['pass']) && $json['pass'] != '') {
            $UsuarioA = new UsuarioAdmin('', $json['pass'], $user, '');
            $UsuarioA->setPass($json['pass']);
            $UsuarioA->setUsuario($user);
            $respuesta = $UsuarioA->_logIn();
        } else {
            $respuesta['data'] = 'error';
            $respuesta['mensaje'] = 'Usuario y Contraseña requeridos';
        }
    }
    if ($json['acc'] == 'LogIn-Customers') {
        require '../includes/modelos/Clientes.php';

        $user = mb_strtolower($json['user']);
        if (isset($user) && $user != '' && isset($json['pass']) && $json['pass'] != '') {
            $UsuarioC = new Clientes();
            $UsuarioC->setCorreo($user);
            $UsuarioC->setPass($json['pass']);
            $respuesta = $UsuarioC->_logIn();
        } else {
            $respuesta['data'] = 'error';
            $respuesta['mensaje'] = 'Username and Password required';
        }
    }
}
echo json_encode($respuesta);
?>
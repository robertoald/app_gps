<?php
session_start();
require_once '../conexiones_config.php';
decode_get2($_SERVER["REQUEST_URI"], 1);
$empresa = $_GET['empresaID'];
$tipoUser = $_GET['tipoUsuario'];
$clientesS = $_GET['clientesS'];
$objetosS = $_GET['objetosS'];
if (isset($_GET['acc']) && $_GET['acc'] != '') {

    if ($_GET['acc'] == 'Accesos') {
        require '../includes/modelos/Sesiones.php';

        $sesion = new Sesion();

        if (isset($_GET['dias'])) {
            $fecha_final = date("Y-m-d");
            if ($_GET['dias'] === '1') {
                $fecha = strtotime('-1 day', strtotime($fecha_final));
                $fecha_inicial = date('Y-m-d H:i:s', $fecha);
            }
            if ($_GET['dias'] === '3') {
                $fecha = strtotime('-3 day', strtotime($fecha_final));
                $fecha_inicial = date('Y-m-d H:i:s', $fecha);
            }
            if ($_GET['dias'] === '7') {
                $fecha = strtotime('-7 day', strtotime($fecha_final));
                $fecha_inicial = date('Y-m-d H:i:s', $fecha);
            }
            $sesion->setFechaIni($fecha_inicial);
            $sesion->setFechaFin(date('Y-m-d H:i:s'));
        }
        
        if ($empresa != 1) {
            $sesion->setEmpresa($empresa);
            $sesion->_listarClientes(true);
        } else {
            $sesion->_listarUsers(true);
        }
        $respuesta = $sesion->listado;
        //$respuesta = array('data' => $empresas->listado);
    }
    if ($_GET['acc'] == 'Empresas') {
        require '../includes/modelos/Empresas.php';

        $empresas = new Empresas();
        $empresas->_listar();
        $respuesta = $empresas->listado;
        //$respuesta = array('data' => $empresas->listado);
    }
    if ($_GET['acc'] == 'Usuarios') {
        require '../includes/modelos/UsuariosEmpresas.php';

        $usuarios = new UsuarioAdmin();
        if ($empresa != 1) {
            $usuarios->setEmpresa($empresa);
        }
        $usuarios->_listar();
        $respuesta = $usuarios->listado;
        //$respuesta = array('data' => $usuarios->listado);
    }
    if ($_GET['acc'] == 'Clientes') {
        $ClientesQuery = '';
        require '../includes/modelos/Clientes.php';

        $clientes = new Clientes();
        if ($empresa != 1) {
            $clientes->setIDEmpresa($empresa);
        }
        if ($tipoUser === '3' && $clientesS !== '') {
            $ClientesQuery = ' AND (';
            $ListaClientes = explode(',', $clientesS);
            $ini = ' ';
            foreach ($ListaClientes as $LC) {
                $ClientesQuery .= $ini . 'a.idcliente=' . $LC;
                $ini = ' OR ';
            }
            $ClientesQuery .= ') ';
            $clientes->setExtra($ClientesQuery);

            $ObjetosQuery = ' AND (';
            if ($objetosS !== '') {
                $ListaObjetos = explode(',', $objetosS);
                $ini = ' ';
                foreach ($ListaObjetos as $LO) {
                    $ObjetosQuery .= $ini . 'b.idvehiculo=' . $LO;
                    $ini = ' OR ';
                }
                $ObjetosQuery .= ') ';
            } else {
                $ObjetosQuery .= 'b.idvehiculo=0 )';
            }
            $clientes->setObjetos($ObjetosQuery);
        }
        $clientes->_listar();
        $respuesta = $clientes->listado;
        //$respuesta = array('data' => $clientes->listado);
    }
    if ($_GET['acc'] == 'Vehiculos') {
        require '../includes/modelos/Vehiculos.php';
        if (isset($_GET['idcliente']) && $_GET['idcliente'] != '') {
            $idCliente = $_GET['idcliente'];
        }
        if (isset($_GET['stlC']) && $_GET['stlC'] != '') {
            $idCliente = $_GET['stlC'];
        }
        $vehiculos = new Vehiculos();
        if ($empresa != 1) {
            $vehiculos->setIDEmpresa($empresa);
        }

        if ($tipoUser === '3') {
            $ObjetosQuery = ' AND (';
            if ($objetosS !== '') {
                $ListaObjetos = explode(',', $objetosS);
                $ini = ' ';
                foreach ($ListaObjetos as $LO) {
                    $ObjetosQuery .= $ini . 'a.idvehiculo=' . $LO;
                    $ini = ' OR ';
                }
                $ObjetosQuery .= ') ';
            } else {
                $ObjetosQuery .= ' a.idvehiculo=0 )';
            }
            $vehiculos->setExtra($ObjetosQuery);
        }

        $vehiculos->setIDCliente($idCliente);
        $vehiculos->_listar();
        $respuesta = array('data' => $vehiculos->listado);
    }

    if ($_GET['acc'] == 'Notificaciones') {
        require '../includes/modelos/Notificaciones.php';
        if (isset($_GET['idcliente']) && $_GET['idcliente'] != '') {
            $idCliente = $_GET['idcliente'];
        }
        $notificaciones = new Notificaciones();
        $notificaciones->setCliente($idCliente);
        $notificaciones->_listar();
        $respuesta = array('data' => $notificaciones->listado);
    }

    if ($_GET['acc'] == 'Geocercas') {
        require '../includes/modelos/Geocercas.php';
        if (isset($_GET['idcliente']) && $_GET['idcliente'] != '') {
            $idCliente = $_GET['idcliente'];
        }
        $geocercas = new Geocercas();
        $geocercas->setCliente($idCliente);
        $geocercas->_listar();
        $respuesta = array('data' => $geocercas->listado);
    }
    if ($_GET['acc'] == 'Recorridos') {
        require '../includes/modelos/Recorridos.php';

        $recorrido = new Recorridos();
        if (isset($_GET['vehiculo']) && $_GET['vehiculo'] != '') {
            $idVehiculo = $_GET['vehiculo'];
            $recorrido->setVehiculo($idVehiculo);
        }
        if (isset($_GET['desde']) && $_GET['desde'] != '') {
            $desde = str_replace('/', '-', $_GET['desde']);
            $recorrido->setDesde($desde);
        }
        if (isset($_GET['hasta']) && $_GET['hasta'] != '') {
            $hasta = str_replace('/', '-', $_GET['hasta']);
            $recorrido->setHasta($hasta);
        }

        $recorrido->_listar();
        $respuesta = array('data' => $recorrido->listado);
    }
    if ($_GET['acc'] == 'CambiarUsuario') {
        require '../includes/modelos/UsuariosEmpresas.php';

        $user = mb_strtolower($_GET['usuario']);
        $UsuarioA = new UsuarioAdmin();
        $UsuarioA->setUsuario($user);
        $respuesta = $UsuarioA->_CambiarUsuario();
    }
    if ($_GET['acc'] == 'StatusVehiculo') {
        require '../includes/modelos/Vehiculos.php';

        $veh = $_GET['vehiculo'];
        $st = $_GET['status'];
        $VehiculoST = new Vehiculos();
        $VehiculoST->setID($veh);
        $VehiculoST->setStatus($st);
        $respuesta = $VehiculoST->_status();
    }
    if ($_GET['acc'] == 'StatusEmpresa') {
        require '../includes/modelos/Empresas.php';

        $emp = $_GET['empresa'];
        $st = $_GET['status'];
        $EmpresaST = new Empresas();
        $EmpresaST->setEmpresa($emp);
        $EmpresaST->setStatus($st);
        $respuesta = $EmpresaST->_status();
    }
    if ($_GET['acc'] == 'StatusUsuario') {
        require '../includes/modelos/UsuariosEmpresas.php';

        $usuarioID = $_GET['usuario'];
        $st = $_GET['status'];
        $UsuarioST = new UsuarioAdmin();
        $UsuarioST->setIdUsuario($usuarioID);
        $UsuarioST->setStatus($st);
        $respuesta = $UsuarioST->_status();
    }
    if ($_GET['acc'] == 'StatusCliente') {
        require '../includes/modelos/Clientes.php';

        $clienteID = $_GET['cliente'];
        $st = $_GET['status'];
        $ClienteST = new Clientes();
        $ClienteST->setIDCliente($clienteID);
        $ClienteST->setStatus($st);
        $respuesta = $ClienteST->_status();
    }
    if ($_GET['acc'] == 'Listados') {
        require '../includes/modelos/Vehiculos.php';
        $Listado = new Vehiculos();

        if ($_GET['TipoListado'] === '1') {
            if ($_GET['TipoObjeto'] === '2') {
                $Listado->_Animales();
                $Lista = $Listado->Animales;
            }
            if ($_GET['TipoObjeto'] === '3') {
                $Listado->_TiposVehiculos();
                $Lista = $Listado->TiposVehiculos;
            }
        }
        if ($_GET['TipoListado'] === '2') {
            $Listado->setTipo($_GET['Valor']);
            $Listado->_Marcas();
            $Lista = $Listado->Marcas;
        }
        if ($_GET['TipoListado'] === '3') {
            $Listado->setMarca($_GET['Valor']);
            $Listado->_Modelos();
            $Lista = $Listado->Modelos;
        }
        $respuesta = $Lista;
        //$respuesta = array('data' => $empresas->listado);
    }

    echo json_encode($respuesta);
}
?>
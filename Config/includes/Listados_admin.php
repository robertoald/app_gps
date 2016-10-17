<?php
session_start();
require_once '../conexiones_config.php';
decode_get2($_SERVER["REQUEST_URI"], 1);
$empresa = $_GET['empresa']; 
$tipoUser = $_GET['tipoUsuario'];
$clientesS = $_GET['clientesS'];
$objetosS = $_GET['objetosS'];
if (isset($_GET['acc']) && $_GET['acc'] != '') {

    
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
        $respuesta = array('data' => $clientes->listado);
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
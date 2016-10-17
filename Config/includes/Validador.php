<?php
session_start();
require_once '../conexiones_config.php';
decode_get2($_SERVER["REQUEST_URI"], 1);


if (isset($_GET['acc']) && $_GET['acc'] != '') {
    
    if ($_GET['acc'] == 'ValidarUsuario') {
        require '../includes/modelos/UsuariosEmpresas.php';

        $user = mb_strtolower($_GET['usuario']);
        $UsuarioA = new UsuarioAdmin();
        $respuesta = $UsuarioA->_Validar($user);
    }
    if ($_GET['acc'] == 'ValidarIMEI') {
        require '../includes/modelos/Vehiculos.php';

        $imei = $_GET['codigo'];
        $VehiculoIMEI = new Vehiculos();
        $respuesta = $VehiculoIMEI->_Validar($imei);
    }
    
    echo $respuesta;
}
?>
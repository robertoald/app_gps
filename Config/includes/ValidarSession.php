<?php
session_start();
require_once '../conexiones_config.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['acc']) && $_GET['acc'] != '') {
    
    if ($_GET['acc'] == 'ValidarSession') {
        require '../includes/modelos/Sesiones.php';

        $sesion = new Sesion('', $_SESSION['user_admin'], '', '');
		$respuesta = $sesion->_ValidarSesion();
    }

    echo $respuesta;
}
?>
<?php

session_start();
require '../includes/modelos/Empresas.php';

if (isset($_POST['data'])) {

    $respuesta = array();

    $empresa = $_POST['empresa'];
    $dataURL = $_POST["data"];
    $parts = explode(',', $dataURL);
    $data = $parts[1];
    $data = base64_decode($data);
    $file = $_SERVER['DOCUMENT_ROOT'] . "/STL-Vision/imagen/empresas/" . $empresa . '.png';
    if (file_put_contents($file, $data)) {
        $Empresa = new Empresas();
        $Empresa->setEmpresa($empresa);
        $Empresa->setLogo($empresa . '.png');
        $Empresa->_modificarLogo();
        $_SESSION['logo_admin'] = $empresa . '.png';
        $respuesta['data'] = 'Exito';
        $respuesta['mensaje'] = 'Logo de Empresa actualizado.';
    } else {
        $respuesta['data'] = 'Error';
        $respuesta['mensaje'] = $nombre;
    }


    echo json_encode($respuesta);
}
?>

<?php

session_start();
require '../includes/modelos/Empresas.php';

if (isset($_FILES["file"]["type"])) {

    $respuesta = array();
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
            ) && ($_FILES["file"]["size"] < 100000) && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            $empresa = $_POST['empresa'];
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/STL-Vision/imagen/empresas/" . $empresa . '.' . $file_extension;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $Empresa = new Empresas();
                $Empresa->setEmpresa($empresa);
                $Empresa->setLogo($empresa . '.' . $file_extension);
                $Empresa->_modificarLogo();
                $respuesta['data'] = 'Exito';
                $respuesta['mensaje'] = 'Logo de Empresa actualizado.';
            } else {
                $respuesta['data'] = 'Error';
                $respuesta['mensaje'] = 'Error al actualizar logo.';
            }
        }
    } else {
        $respuesta['data'] = 'Error';
        $respuesta['mensaje'] = 'Tipo o tamaño de imagen invalido.';
    }
} else {
    $respuesta['data'] = 'Error';
    $respuesta['mensaje'] = 'Error al actualizar logo.';
}
echo json_encode($respuesta);
?>

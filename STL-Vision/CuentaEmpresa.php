<?php
session_start();
require_once '../Config/conexiones_config.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if ($_GET['acc'] == 'in_admin') {
    $_SESSION['name_admin'] = $_GET['nombre'];
    $_SESSION['id_admin'] = $_GET['id'];
    $_SESSION['user_admin'] = $_GET['user'];
    $_SESSION['empresa_admin'] = $_GET['empresa'];
    $_SESSION['tipoUser_admin'] = $_GET['tipo'];
    $_SESSION['logo_admin'] = $_GET['logo'];
    $_SESSION['NombreEmpresa_admin'] = $_GET['NombreEmpresa'];
    $_SESSION['parametros_Admin'] = _desordenar("id=" . $_GET['id'] . "&usuario=" . $_GET['user'] . "&empresa=" . $_GET['empresa'] . "&nombre=" . $_GET['nombre'] . "&acc=userPass");
    //header('location: ../STL-Vision/Admin.php');
    ?>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Admin | Admin STL-Vision</title>
        </head>
        <style>
            html {
                margin: 0px;
                height: 100%;
                width: 100%;
            }

            body {
                margin: 0px;
                min-height: 100%;
                width: 100%;
            }
        </style>
        <body>
            <iframe src="../STL-Vision/Admin.php" style="border: 0; width: 100%; height: 90%"></iframe>
            <div style="text-align: center; vertical-align: middle">
                <p>Presione <a href="../STL-Vision/CuentaEmpresa.php?acc=out_admin">aquí</a> para volver al módulo Supra-Administrador.</p>
            </div>
        </body>

    </html>

    <?php
}

if ($_GET['acc'] == 'out_admin') {
    unset($_SESSION['name_admin']);
    unset($_SESSION['id_admin']);
    unset($_SESSION['user_admin']);
    unset($_SESSION['empresa_admin']);
    unset($_SESSION['NombreEmpresa_admin']);
    unset($_SESSION['tipoUser_admin']);
    unset($_SESSION['parametros_Admin']);
    header('location: ../STL-Vision/SupraAdmin.php');
}
?>
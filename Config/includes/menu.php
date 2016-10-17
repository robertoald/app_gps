<?php
session_start();
$data = file_get_contents('php://input');
$json = json_decode($data, true);
       
if(isset($json['acc']) && $json['acc'] == 'menu') {
    $menu = $json['menu'];
    switch ($menu) {
        case 'Accesos':
            include_once '../../STL-Vision/modulos/Reportes/Accesos.php';
            break;
        case 'Supervisor_Clientes':
            include_once '../../STL-Vision/modulos/Usuarios/Supervisor_Clientes.php';
            break;
        case 'Supervisor_Objetos':
            include_once '../../STL-Vision/modulos/Usuarios/Supervisor_Objetos.php';
            break;
        case 'Perfil':
            include_once '../../STL-Vision/modulos/Usuarios/UsuariosPerfil.php';
            break;
        case 'Logos':
            include_once '../../STL-Vision/modulos/Empresas/Logos.php';
            break;
        case 'Empresas':
            include_once '../../STL-Vision/modulos/Empresas/Empresas.php';
            break;
        case 'Clientes':
            include_once '../../STL-Vision/modulos/Clientes/Clientes.php';
            break;
        case 'Vehiculos':
            include_once '../../STL-Vision/modulos/Vehiculos/Vehiculos.php';
            break;
        case 'Usuarios':
            include_once '../../STL-Vision/modulos/Usuarios/Usuarios.php';
            break;
    }
    //include '../../STL-Vision/profile.php';
    //include '../../admin/modulos/Usuarios/Usuarios.php';
}
?>
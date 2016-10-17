<?php
require_once '../conexiones_config.php';

session_start();
decode_get2($_SERVER["REQUEST_URI"], 1);

/*      LOGIN SUPRA-ADMIN     */
if ($_GET['accion'] == 'in_SupraAdmin') {
    $_SESSION['name_SupraAdmin'] = $_GET['nombre'];
    $_SESSION['id_SupraAdmin'] = $_GET['id'];
    $_SESSION['user_SupraAdmin'] = $_GET['user'];
    $_SESSION['empresa_SupraAdmin'] = $_GET['empresa'];
    $_SESSION['tipoUser_SupraAdmin'] = $_GET['tipo'];
    $_SESSION['logo_SupraAdmin'] = $_GET['logo'];
    $_SESSION['NombreEmpresa_SupraAdmin'] = $_GET['NombreEmpresa'];
    $_SESSION['parametros_SupraAdmin'] = _desordenar("id=" . $_GET['id'] . "&usuario=" . $_GET['user'] . "&empresa=" . $_GET['empresa'] . "&nombre=" . $_GET['nombre'] . "&acc=userPass&ol=2");
    header('location: ../../STL-Vision/SupraAdmin.php');
}
if ($_GET['accion'] == 'out_SupraAdmin') {
    unset($_SESSION['name_SupraAdmin']);
    unset($_SESSION['id_SupraAdmin']);
    unset($_SESSION['user_SupraAdmin']);
    unset($_SESSION['empresa_SupraAdmin']);
    unset($_SESSION['NombreEmpresa_SupraAdmin']);
    unset($_SESSION['tipoUser_SupraAdmin']);
    unset($_SESSION['parametros_SupraAdmin']);
    unset($_SESSION['logo_SupraAdmin']);
    header('location: ../../STL-Vision/LogIn.php');
}

/*      LOGIN ADMIN     */
if ($_GET['accion'] == 'in_admin') {
    include_once '../includes/modelos/Sesiones.php';
    $sesion = new Sesion('', $_GET['user'], getRealIP(), $_GET['empresa']);
    $sesion->_abrirSesion();
    $_SESSION['name_admin'] = $_GET['nombre'];
    $_SESSION['id_admin'] = $_GET['id'];
    $_SESSION['user_admin'] = $_GET['user'];
    $_SESSION['empresa_admin'] = $_GET['empresa'];
    $_SESSION['tipoUser_admin'] = $_GET['tipo'];
    $_SESSION['logo_admin'] = $_GET['logo'];
    $_SESSION['NombreEmpresa_admin'] = $_GET['NombreEmpresa'];
    $_SESSION['parametros_Admin'] = _desordenar("id=" . $_GET['id'] . "&usuario=" . $_GET['user'] . "&empresa=" . $_GET['empresa'] . "&nombre=" . $_GET['nombre'] . "&acc=userPass&ol=1");
    header('location: ../../STL-Vision/Admin.php');
}
if ($_GET['accion'] == 'out_admin') {
    include_once '../includes/modelos/Sesiones.php';
    $sesion = new Sesion('', $_SESSION['user_admin'], '', '');
    $sesion->_cerrarSesion();
    unset($_SESSION['name_admin']);
    unset($_SESSION['id_admin']);
    unset($_SESSION['user_admin']);
    unset($_SESSION['empresa_admin']);
    unset($_SESSION['NombreEmpresa_admin']);
    unset($_SESSION['tipoUser_admin']);
    unset($_SESSION['parametros_Admin']);
    unset($_SESSION['logo_admin']);
    header('location: ../../STL-Vision/LogIn.php');
}

/*      LOGIN CUSTOMERS     */
if ($_GET['accion'] == 'in_customer') {
    include_once '../includes/modelos/Sesiones.php';
    $sesion = new Sesion('', $_GET['correo'], getRealIP(), $_GET['empresa']);
    $sesion->_abrirSesion(true);
    $_SESSION['name_customer'] = $_GET['nombre'];
    $_SESSION['id_customer'] = $_GET['id'];
    $_SESSION['user_customer'] = $_GET['correo'];
    $_SESSION['empresa_customer'] = $_GET['empresa'];
    header('location: ../../STL-Vision/Admin.php');

}
if ($_GET['accion'] == 'out_customer') {
    include_once '../includes/modelos/Sesiones.php';
    $sesion = new Sesion('', $_SESSION['user_customer'], '', '');
    $sesion->_cerrarSesion(true);
    unset($_SESSION['name_customer']);
    unset($_SESSION['id_customer']);
    unset($_SESSION['user_customer']);
    unset($_SESSION['empresa_customer']);
    header('location: ../customers/LogIn.php');
}
?>
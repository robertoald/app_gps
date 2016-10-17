<?php
session_start();
include_once ('../Config/conexiones_config.php');
include_once ('../Config/includes/modelos/Sesiones.php');
decode_get2($_SERVER["REQUEST_URI"], 1);

$sesion = new Sesion();
if ($_GET['ol'] == '2') {
    $sesion->_listarUsers();
}
if ($_GET['ol'] == '1') {
    $sesion->setEmpresa($_GET['empresa']);
    $sesion->_listarClientes();
}
 
?> 

                <?php
				$x=0;
                foreach ($sesion->listado AS $listado) 
				{
					if ($listado['Status'] == 0) {
                        $avatar = 'avatar-online';
                        $sub = 'En Linea';
                    }
                    if ($listado['Status'] == 1) {
                        $avatar = 'avatar-off';
                        $phpdate = strtotime($listado['Fecha']);
                        $sub = date('d-m-Y h:i:s A', $phpdate);
                    }
					$listado_usuario[$x]['Id']=$listado['Id'];
					$listado_usuario[$x]['Usuario']=$listado['Usuario'];
					$listado_usuario[$x]['Nombre']=$listado['Nombre'];
					$listado_usuario[$x]['IP']=$listado['IP'];
					$listado_usuario[$x]['Avatar']=$avatar;;
					$listado_usuario[$x]['Fecha']=$sub;
					$x++;
                } 
				echo json_encode($listado_usuario);
                ?>
            
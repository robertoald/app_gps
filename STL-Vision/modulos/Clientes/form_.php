<?php
session_start();
include_once '../../../Config/conexiones_config.php';
include_once '../../../Config/includes/modelos/Empresas.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['cliente']) && $_GET['cliente'] != '') {
    $Cliente = $_GET['cliente'];
}
if (isset($_GET['correo']) && $_GET['correo'] != '') {
    $Correo = $_GET['correo'];
}
if (isset($_GET['empresa']) && $_GET['empresa'] != '') {
    $Empresa = $_GET['empresa'];
}
if (isset($_GET['direccion']) && $_GET['direccion'] != '') {
    $Direccion = $_GET['direccion'];
}
if (isset($_GET['telefono']) && $_GET['telefono'] != '') {
    $Telefono = $_GET['telefono'];
}
if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
    $Nombre = $_GET['nombre'];
}
if (isset($_GET['acc']) && $_GET['acc'] != '') {
    $acc = $_GET['acc'];
} else {
    $acc = "agregar-Clientes";
}

$Empresas = new Empresas();
$Empresas->_listar();
?>

<div class="row">
    <div class="panel">
        <div class="panel-body container-fluid">
            <form id="Editar-Cliente" autocomplete="off" action="javascript: _Modificar('Cliente')">
                <div class="col-sm-6">
                    <div class="form-group form-material floating">
                        <input type="text" name="NombreCliente" id="nombre" class="form-control" required value="<?php echo $Nombre ?>"/>
                        <label class="floating-label">Nombre</label>
                    </div>
                    <div class="form-group form-material floating">
                        <input type="email" name="CorreoCliente" id="correo" readonly class="form-control" value="<?php echo $Correo ?>" required/>
                        <label class="floating-label">Email</label>
                    </div>                                              
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-material floating">
                        <input type="text" name="DireccionCliente" id="direccion" class="form-control" value="<?php echo $Direccion ?>" required/>
                        <label class="floating-label">Dirección</label>
                    </div>    
                    <div class="form-group form-material floating">
                        <input type="text" name="TelefonoCliente" id="telefono" class="form-control" required value="<?php echo $Telefono ?>" />
                        <label class="floating-label">Teléfono</label>
                    </div> 
                    <?php if (!isset($_SESSION['empresa_admin'])) { ?>
                        <div class="form-group form-material floating">
                            <select id="empresa" name="EmpresaCliente" class="form-control" required>
                                <option value="">  Seleccionar...  </option>
                                <?php
                                foreach ($Empresas->listado AS $listado) {
                                    ?>  
                                    <option value="<?php echo $listado['idEmpresa'] ?>"><?php echo $listado['Nombre'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label class="floating-label">Empresa</label>
                        </div>
                    <?php } else { ?>
                        <input type="text" name="EmpresaCliente" id="empresaInput" class="form-control Static" value="<?php echo $Empresa ?>" style="display: none"/>
                    <?php } ?>
                </div>
                <input name="acc" value="modificar-Clientes" style="display: none"/>
                <input name="Cliente" value="<?php echo $Cliente ?>" style="display: none"/>
                <div class="col-sm-12 center-block">
                    <div class="pull-right">
                        <button type="submit" id="form-submit" class="btn btn-animate btn-animate-vertical btn-primary">
                            <span>
                                <i class="icon wb-edit" aria-hidden="true"></i>
                                Guardar Cambios
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#empresa option[value="<?php echo $Empresa ?>"]').attr('selected', 'selected');
        (function () {
            $('#Editar-Cliente').formValidation({
                framework: "bootstrap",
                button: {
                    selector: '#form-submit',
                    disabled: 'disabled'
                },
                icon: null,
                fields: {
                    NombreCliente: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Nombre</b> es requerido.'
                            }
                        }
                    },
                    CorreoCliente: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Correo</b> es requerido'
                            },
                            emailAddress: {
                                message: 'Correo electrónico <b>Invalido</b>.'
                            }
                        }
                    },
                    DireccionCliente: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Dirrección</b> es requerido'
                            }
                        }
                    },
                    TelefonoCliente: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Teléfono</b> es requerido'
                            }
                        }
                    },
                    EmpresaCliente: {
                        validators: {
                            notEmpty: {
                                message: 'Seleccione una <b>Empresa</b> de la lista.'
                            }
                        }
                    }
                }
            });
        })();
    });
</script>
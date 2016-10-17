<?php
session_start();
include_once '../../../Config/conexiones_config.php';
include_once '../../../Config/includes/modelos/Empresas.php';
include_once '../../../Config/includes/modelos/UsuariosEmpresas.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['user']) && $_GET['user'] != '') {
    $User = $_GET['user'];
}
if (isset($_GET['usuario']) && $_GET['usuario'] != '') {
    $Usuario = $_GET['usuario'];
}
if (isset($_GET['empresa']) && $_GET['empresa'] != '') {
    $Empresa = $_GET['empresa'];
}
if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
    $Nombre = $_GET['nombre'];
}
if (isset($_GET['tipo']) && $_GET['tipo'] != '') {
    $Tipo = $_GET['tipo'];
}

$Usuarios = new UsuarioAdmin();
$Usuarios->_TipoUsuarios();

$Empresas = new Empresas();
$Empresas->_listar();
?>
<div class="row">
    <div class="panel">
        <div class="panel-body container-fluid">
            <form id="Editar-Usuario" autocomplete="off" action="javascript: _Modificar('Usuario')">
                <div class="col-sm-6">
                    <div class="form-group form-material floating">
                        <input type="text" name="NombreUsuario" id="nombre" class="form-control" value="<?php echo $Nombre ?>" required/>
                        <label class="floating-label">Nombre</label>
                    </div>
                    <?php if ($Tipo !== '2') { ?>
                        <div class="form-group form-material floating">
                            <select id="tiposEditar" name="TipoUsuario" class="form-control" required>
                                <?php
                                foreach ($Usuarios->TipoUsuarios AS $TipoUsuarios) {
                                    ?>  
                                    <option value="<?php echo $TipoUsuarios['Tipo'] ?>"><?php echo $TipoUsuarios['Descripcion'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label class="floating-label">Tipo</label>
                        </div>
                        <?php
                    } else {
                        ?>
                        <input type="text" name="TipoUsuario" id="tipoInput" class="form-control Static" required value="<?php echo $Tipo ?>" style="display: none"/>
                        <?php
                    }
                    ?>
                    <?php if (!isset($_SESSION['empresa_admin'])) { ?>
                        <div class="form-group form-material floating">
                            <select id="empresa" name="EmpresaUsuario" class="form-control empty" required>
                                <option value="" selected></option>
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
                        <?php
                    } else {
                        ?>
                        <input type="text" name="EmpresaUsuario" id="empresaInput" class="form-control Static" required value="<?php echo $_SESSION['empresa_admin'] ?>" style="display: none"/>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-material floating">
                        <input type="text" name="UserUsuario" id="user" readonly class="form-control" value="<?php echo $User ?>" required/>
                        <label class="floating-label">Usuario</label>
                    </div>                  
                </div>
                <input name="acc" value="modificar-Usuarios" style="display: none"/>
                <input name="Usuario" value="<?php echo $Usuario ?>" style="display: none"/>
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
        $('#tiposEditar option[value="<?php echo $Tipo ?>"]').attr('selected', 'selected');

        (function () {
            $('#Editar-Usuario').formValidation({
                framework: "bootstrap",
                button: {
                    selector: '#form-submit',
                    disabled: 'disabled'
                },
                icon: null,
                fields: {
                    NombreEmpresa: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Nombre</b> es requerido.'
                            }
                        }
                    },
                    CorreoEmpresa: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Correo</b> es requerido'
                            },
                            emailAddress: {
                                message: 'Correo electrónico <b>Invalido</b>.'
                            }
                        }
                    },
                    TipoUsuario: {
                        validators: {
                            notEmpty: {
                                message: 'Seleccione un <b>Tipo de Usuario</b> de la lista.'
                            }
                        }
                    },
                    ContactoEmpresa: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Contácto</b> es requerido'
                            }
                        }
                    },
                    DireccionEmpresa: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Dirrección</b> es requerido'
                            }
                        }
                    },
                    TelefonoEmpresa: {
                        validators: {
                            notEmpty: {
                                message: 'El campo <b>Teléfono</b> es requerido'
                            }
                        }
                    },
                    PaisEmpresa: {
                        validators: {
                            notEmpty: {
                                message: 'Seleccione un <b>País</b> de la lista.'
                            }
                        }
                    }
                }
            });
        })();
    });
</script>
<?php
session_start();
include_once '../../../Config/conexiones_config.php';
include_once '../../../Config/includes/modelos/Empresas.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['usuario']) && $_GET['usuario'] != '') {
    $Usuario = $_GET['usuario'];
}
if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
    $Nombre = $_GET['nombre'];
}
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = $_GET['id'];
}

$Empresas = new Empresas();
$Empresas->_listar();
?>
<div class="row">
    <div class="panel">
        <div class="panel-body container-fluid">
            <form id="Editar-UsuarioPass" autocomplete="off" action="javascript: _Modificar('UsuarioPass')">
                <div class="col-sm-12">
                    <div class="col-sm-6" style="padding-left: 0px !important">
                        <div class="form-group form-material floating">
                            <input type="text" name="UserUsuario" id="user" readonly class="form-control" value="<?php echo $Usuario ?>" required/>
                            <label class="floating-label">Usuario</label>
                        </div>                  
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-material floating">
                        <input type="password" class="form-control empty" name="ClaveUsuario" data-fv-notempty="true"
                               data-fv-notempty-message="Este campo es requerido."
                               data-fv-identical="true" data-fv-identical-field="ClaveConfirm"
                               data-fv-identical-message="Las contraseñas deben ser iguales."
                               />
                        <label class="floating-label">Contraseña</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-material floating">
                        <input type="password" class="form-control empty" name="ClaveConfirm" data-fv-notempty="true"
                               data-fv-notempty-message="Este campo es requerido."
                               data-fv-identical="true" data-fv-identical-field="ClaveUsuario"
                               data-fv-identical-message="Las contraseñas deben ser iguales."
                               />
                        <label class="floating-label">Confirmar</label>
                    </div>
                </div>
                <input name="acc" value="userPass" style="display: none"/>
                <input name="Usuario" value="<?php echo $id ?>" style="display: none"/>
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
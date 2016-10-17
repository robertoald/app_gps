<?php
session_start();
require_once '../../../Config/conexiones_config.php';
include_once '../../../Config/includes/modelos/Paises.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['fecha']) && $_GET['fecha'] != '') {
    $Fecha = $_GET['fecha'];
}
if (isset($_GET['empresa']) && $_GET['empresa'] != '') {
    $Empresa = $_GET['empresa'];
}
if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
    $Nombre = $_GET['nombre'];
}
if (isset($_GET['correo']) && $_GET['correo'] != '') {
    $Correo = $_GET['correo'];
}
if (isset($_GET['usuario']) && $_GET['usuario'] != '') {
    $Usuario = $_GET['usuario'];
}
if (isset($_GET['pass']) && $_GET['pass'] != '') {
    $Pass = $_GET['pass'];
}
if (isset($_GET['personacontacto']) && $_GET['personacontacto'] != '') {
    $Contacto = $_GET['personacontacto'];
}
if (isset($_GET['pais']) && $_GET['pais'] != '') {
    $Pais = $_GET['pais'];
}
if (isset($_GET['direccion']) && $_GET['direccion'] != '') {
    $Direccion = $_GET['direccion'];
}
if (isset($_GET['telefono']) && $_GET['telefono'] != '') {
    $Telefono = $_GET['telefono'];
}
$Paises = new Paises();
$Paises->_listar();
?>
<div class="row">
    <div class="panel">
        <div class="panel-body container-fluid">
            <form id="Editar-Empresa" autocomplete="off" action="javascript: _Modificar('Empresa')">
                <div class="col-sm-6">
                    <div class="form-group form-material floating">
                        <input type="text" name="NombreEmpresa" id="nombre" class="form-control" value="<?php echo $Nombre ?>" required/>
                        <label class="floating-label">Nombre</label>
                    </div>
                    <div class="form-group form-material floating">
                        <input type="email" name="CorreoEmpresa" id="correo" class="form-control" value="<?php echo $Correo ?>" required/>
                        <label class="floating-label">Email</label>
                    </div>
                    <div class="form-group form-material floating">
                        <input type="text" name="ContactoEmpresa" id="contacto" class="form-control" value="<?php echo $Contacto ?>" required/>
                        <label class="floating-label">Contacto</label>
                    </div>
                    <div class="form-group form-material floating">
                        <input type="text" name="DireccionEmpresa" id="direccion" class="form-control" value="<?php echo $Direccion ?>" required/>
                        <label class="floating-label">Dirección</label>
                    </div>                                                  
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-material floating">
                        <input type="text" name="TelefonoEmpresa" id="telefono" class="form-control" value="<?php echo $Telefono ?>" required/>
                        <label class="floating-label">Teléfono</label>
                    </div>  
                    <div class="form-group form-material floating">
                        <select id="pais" name="PaisEmpresa" class="form-control" required>
                            <?php
                            foreach ($Paises->listado AS $listado) {
                                ?>  
                                <option value="<?php echo $listado['idPais'] ?>"><?php echo $listado['Pais'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label class="floating-label">Pais</label>
                    </div>  
                    <div class="form-group form-material floating">
                        <input type="text" name="UsuarioEmpresa" id="usuario" class="form-control" disabled value="<?php echo $Usuario ?>"/>
                        <label class="floating-label">Usuario</label>
                    </div>
                </div>
                <input name="Empresa" value="<?php echo $Empresa ?>" readonly style="display: none"/>
                <input name="acc" value="modificar-Empresas" style="display: none"/>
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
        $('#pais option[value="<?php echo $Pais ?>"]').attr('selected', 'selected');

        (function () {
            $('#Editar-Empresa').formValidation({
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
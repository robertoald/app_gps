<?php
session_start();
include_once '../../Config/includes/modelos/Paises.php';
if (isset($_SESSION['name_SupraAdmin'])) {

    $Paises = new Paises();
    $Paises->_listar();
    ?>
    <!-- Modal -->
    <div class="modal fade modal-3d-flip-horizontal modal-primary" id="myModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="modal_title">Modal Title</h4>
                </div>
                <div class="modal-body" id="modal_body">
                    <p>One fine body…</p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-6" style="margin-top: -35px">
                <!-- Page Widget -->
                <div class="page-header">
                    <span class="TituloM">Empresas</span><span class="SubTituloM">Módulo Administrativo</span>
                </div>
            </div>
            <div class="col-md-3 pull-right" style="margin-top: -20px">
                <!-- Page Widget -->
                <div class="widget widget-shadow text-center">
                    <div class="widget-footer" style="padding: 10px  !important; background-color: #f6f9fd  !important;;">
                        <div class="row no-space">
                            <div class="col-xs-4">
                                <span id="Total" style="font-size: 16px;" class="badge badge-radius badge-primary">0</span>
                                <br><span style="color: #a3afb7  !important;">Total</span>
                            </div>
                            <div class="col-xs-4">
                                <span id="Activas" style="font-size: 16px;" class="badge badge-radius badge-success">0</span>
                                <br><span style="color: #a3afb7  !important;">Activos</span>
                            </div>
                            <div class="col-xs-4">
                                <span id="Inactivas" style="font-size: 16px;" class="badge badge-radius badge-danger">0</span>
                                <br><span style="color: #a3afb7  !important;">Inactivos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12"  style="margin-top: -20px">
                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li class="active" role="listado">
                                <a data-toggle="tab" href="#listado" aria-controls="activities" role="tab">
                                    Listado
                                </a>
                            </li>
                            <li role="presentation">
                                <a data-toggle="tab" href="#nueva" aria-controls="profile" role="tab">
                                    Nueva
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active animation-slide-left panel" id="listado" role="tabpanel">
                                <table class="Listado-Modelos" data-height="400" data-mobile-responsive="true" data-sort-name="First" data-sort-order="desc" >
                                    <thead>
                                        <tr>
                                            <th data-field="Nombre" data-sortable="true">Nombre</th>
                                            <th data-field="Correo" data-sortable="true">Correo</th>
                                            <th data-field="Contacto" data-sortable="true">Contacto</th>
                                            <th data-field="Status" data-align="center" data-sortable="true">Status</th>
                                            <th data-field="Acciones">Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane animation-slide-left" id="nueva" role="tabpanel">
                                <div class="row">
                                    <div class="panel">
                                        <div class="panel-body container-fluid">
                                            <form id="Nuevo-Empresa" autocomplete="off" action="javascript: _Nuevo('Empresa')">
                                                <div class="col-sm-6">
                                                    <h4 style="color: #62a8ea">Información de la Empresa</h4>
                                                </div>
                                                <div class="col-sm-6" style="text-align: right">
                                                    <button type="reset" class="btn btn-primary btn-pill-left" onclick="_LimpiarFormulario($('#Nuevo-Empresa'))">
                                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                                    </button>
                                                    <button id="form-submit" type="submit" class="btn btn-primary btn-pill-right" disabled>
                                                        <i class="icon wb-check" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="NombreEmpresa" id="nombre" class="form-control empty" required/>
                                                        <label class="floating-label">Nombre</label>
                                                    </div>
                                                    <div class="form-group form-material floating">
                                                        <input type="email" name="CorreoEmpresa" id="correo" class="form-control empty" required/>
                                                        <label class="floating-label">Email</label>
                                                    </div>
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="ContactoEmpresa" id="contacto" class="form-control empty" required/>
                                                        <label class="floating-label">Contácto</label>
                                                    </div>
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="DireccionEmpresa" id="direccion" class="form-control empty" required/>
                                                        <label class="floating-label">Dirección</label>
                                                    </div>                                                  
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="TelefonoEmpresa" id="telefono" class="form-control empty" required/>
                                                        <label class="floating-label">Teléfono</label>
                                                    </div>  
                                                    <div class="form-group form-material floating">
                                                        <select name="PaisEmpresa" class="form-control empty" required>
                                                            <option value="" selected></option>
                                                            <?php
                                                            foreach ($Paises->listado AS $listado) {
                                                                ?>  
                                                                <option value="<?php echo $listado['idPais'] ?>"><?php echo $listado['Pais'] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <label class="floating-label">País</label>
                                                    </div>  
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="UsuarioEmpresa" id="usuario" class="form-control empty" onblur="ValidarUsuario(this, $('#Nuevo-Empresa'))" required/>
                                                        <label class="floating-label">Usuario</label>
                                                    </div>
                                                    <div class="form-group form-material floating">
                                                        <input type="password" name="ContraseñaEmpresa" id="contraseña" class="form-control empty" required/>
                                                        <label class="floating-label">Contraseña</label>
                                                    </div>
                                                </div>
                                                <input name="acc" value="agregar-Empresas" style="display: none"/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            (function () {
                $('.Listado-Modelos').bootstrapTable({
                    url: '../Config/includes/Listados.php?acc=Empresas',
                    search: true,
                    pagination: true,
                    showRefresh: true,
                    showColumns: true,
                    iconSize: 'outline',
                    toolbar: '#ModeloToolbar',
                    icons: {
                        refresh: 'wb-refresh',
                        columns: 'wb-list-bulleted'
                    },
                    responseHandler: function (respuesta) {
                        if (respuesta.length > 0) {
                            $('#Inactivas').html(respuesta[respuesta.length - 1].Inactivas);
                            $('#Activas').html(respuesta[respuesta.length - 1].Activas);
                            $('#Total').html(respuesta.length);
                        }
                        return respuesta;
                    }
                });

            })();

            (function () {
                $('#Nuevo-Empresa').formValidation({
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
                        },
                        UsuarioEmpresa: {
                            validators: {
                                notEmpty: {
                                    message: 'El campo <b>Usuario</b> es requerido'
                                },
                                blank: {}
                            }
                        },
                        ContraseñaEmpresa: {
                            validators: {
                                notEmpty: {
                                    message: 'El campo <b>Contraseña</b> es requerido'
                                }
                            }
                        }
                    }
                });
            })();
        });
    </script>

    <?php
} else {
    header('location: LogIn.php');
}
?>
<?php
session_start();
if ((isset($_SESSION['tipoUser_admin']) && $_SESSION['tipoUser_admin'] == 2) || isset($_SESSION['name_SupraAdmin'])) {
    include_once '../../Config/includes/modelos/Empresas.php';
    include_once '../../Config/includes/modelos/UsuariosEmpresas.php';
    include_once '../../Config/conexiones_config.php';
    decode_get2($_SERVER["REQUEST_URI"], 1);

    $parametrosEmpresa = 'empresaID=' . $_GET['empresa'];
    $parametrosEmpresa = '&' . _desordenar($parametrosEmpresa);

    $Usuarios = new UsuarioAdmin();
    $Usuarios->_TipoUsuarios();
    $Empresas = new Empresas();
    $Empresas->_listar();
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
                    <span class="TituloM">Usuarios</span><span class="SubTituloM">Módulo Administrativo </span>
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
                                    Nuevo
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active animation-slide-left panel" id="listado" role="tabpanel">
                                <table class="Listado-Modelos" data-height="400" data-mobile-responsive="true" data-sort-name="First" data-sort-order="desc" >
                                    <thead>
                                        <tr>
                                            <th data-field="Nombre" data-sortable="true">Nombre</th>
                                            <th data-field="User" data-sortable="true">Usuario</th>
                                            <th data-field="Empresa" data-sortable="true">Empresa</th>
                                            <th data-field="Tipo" data-align="center" data-sortable="true">Tipo</th>
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
                                            <form id="Nuevo-Usuario" autocomplete="off" action="javascript: _Nuevo('Usuario')">
                                                <div class="col-sm-6">
                                                    <h4 style="color: #62a8ea">Información del Usuario</h4>
                                                </div>
                                                <div class="col-sm-6" style="text-align: right">
                                                    <button id="ResetButton" type="reset" class="btn btn-primary btn-pill-left" onclick="_LimpiarFormulario($('#Nuevo-Usuario'))">
                                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                                    </button>
                                                    <button id="form-submit" type="submit" class="btn btn-primary btn-pill-right disabled">
                                                        <i class="icon wb-check" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="NombreUsuario" id="nombre" class="form-control empty" required/>
                                                        <label class="floating-label">Nombre</label>
                                                    </div>
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="UserUsuario" id="user" class="form-control empty" required onblur="ValidarUsuario(this, $('#Nuevo-Usuario'))"/>
                                                        <label class="floating-label">Usuario</label>
                                                    </div>
                                                    <div class="form-group form-material floating">
                                                        <input type="password" name="ClaveUsuario" id="clave" class="form-control empty" required/>
                                                        <label class="floating-label">Contraseña</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-material floating">
                                                        <select id="tiposUsuarios" name="TipoUsuario" class="form-control empty" required>
                                                            <option value="" selected></option>
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
                                                    <?php if (isset($_GET['empresa']) && $_GET['empresa'] === '1') { ?>
                                                        <div class="form-group form-material floating">
                                                            <select id="empresaNueva" name="EmpresaUsuario" class="form-control empty" required>
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
                                                        <input type="text" name="EmpresaUsuario" id="empresaNuevoInput" class="form-control Static" required value="<?php echo $_GET['empresa'] ?>" style="display: none"/>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <input name="acc" value="agregar-Usuarios" style="display: none"/>
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
        function IniciarListado(parametros) {
            $('.Listado-Modelos').bootstrapTable({
                url: '../Config/includes/Listados.php?acc=Usuarios' + parametros,
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
        }
        $(document).ready(function () {

            IniciarListado('<?php echo $parametrosEmpresa ?>');
            (function () {
                $('#Nuevo-Usuario').formValidation({
                    framework: "bootstrap",
                    button: {
                        selector: '#form-submit',
                        disabled: 'disabled'
                    },
                    icon: null,
                    fields: {
                        NombreUsuario: {
                            validators: {
                                notEmpty: {
                                    message: 'El campo <b>Nombre</b> es requerido.'
                                }
                            }
                        },
                        EmpresaUsuario: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione una <b>Empresa</b> de la lista.'
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
                        UserUsuario: {
                            validators: {
                                notEmpty: {
                                    message: 'El campo <b>Usuario</b> es requerido'
                                },
                                blank: {
                                    message: '<b>Usuario</b> invalido'
                                }
                            }
                        },
                        ClaveUsuario: {
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
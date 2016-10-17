<?php
session_start();
if (isset($_SESSION['name_admin'])) {
    include_once  ('../../Config/includes/modelos/Empresas.php');
    include_once  ('../../Config/includes/modelos/UsuariosEmpresas.php');
    include_once  ('../../Config/conexiones_config.php');
    decode_get2($_SERVER["REQUEST_URI"], 1);
    
    $Usuario = new UsuarioAdmin();
    $Usuario->_Usuario($_GET['id']);

    $parametrosEmpresa = 'empresaID=' . $_GET['empresa'];
    $parametrosEmpresa .= '&tipoUsuario=' . $Usuario->Tipo;
    $parametrosEmpresa .= '&clientesS=' . $Usuario->Clientes;
    $parametrosEmpresa .= '&objetosS=' . $Usuario->Objetos;
    $parametrosEmpresa = '&' . _desordenar($parametrosEmpresa);

    $Empresas = new Empresas();
    $Empresas->_listar();
    ?>
    <!-- Modal -->
    <div class="modal fade modal-fill-in" data-keyboard="false" data-backdrop="static" id="myModalWizard" aria-hidden="true" aria-labelledby="exampleFillIn" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="width: 70% !important">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="LimpiarModal($('#myModalWizard'))">
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
                    <span class="TituloM">Clientes</span><span class="SubTituloM">Módulo Administrativo</span>
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
            <div class="col-md-12" style="margin-top: -20px">
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
                                <table class="Listado-Modelos" data-height="400" data-mobile-responsive="true" data-sort-name="First" data-sort-order="desc">
                                    <thead>
                                        <tr>
                                            <th data-field="Indicadores" data-align="center"></th>
                                            <th data-field="Nombre" data-sortable="true">Nombre</th>
                                            <th data-field="Correo" data-sortable="true">Correo</th>
                                            <th data-field="Empresa" data-sortable="true">Empresa</th>
                                            <th data-field="Status" data-sortable="true" data-align="center">Status</th>
                                            <th data-field="Acciones">Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane animation-slide-left" id="nueva" role="tabpanel">
                                <div class="row">
                                    <div class="panel">
                                        <div class="panel-body container-fluid">
                                            <form id="Nuevo-Cliente" autocomplete="off" action="javascript: _Nuevo('Cliente')">
                                                <div class="col-sm-6">
                                                    <h4 style="color: #62a8ea">Información del Cliente</h4>
                                                </div>
                                                <div class="col-sm-6" style="text-align: right">
                                                    <button type="reset" class="btn btn-primary btn-pill-left" onclick="_LimpiarFormulario($('#Nuevo-Cliente'))">
                                                        <i class="icon wb-trash" aria-hidden="true"></i>
                                                    </button>
                                                    <button id="form-submit" type="submit" class="btn btn-primary btn-pill-right" disabled>
                                                        <i class="icon wb-check" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="NombreCliente" id="nombre" class="form-control empty" required/>
                                                        <label class="floating-label">Nombre</label>
                                                    </div>
                                                    <div class="form-group form-material floating">
                                                        <input type="email" name="CorreoCliente" id="correo" class="form-control empty" required/>
                                                        <label class="floating-label">Email</label>
                                                    </div>
                                                    <div class="form-group form-material floating">
                                                        <input type="password" name="ClaveCliente" id="contraseña" class="form-control empty" required/>
                                                        <label class="floating-label">Contraseña</label>
                                                    </div>                                                
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="DireccionCliente" id="direccion" class="form-control empty" required/>
                                                        <label class="floating-label">Dirección</label>
                                                    </div>    
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="TelefonoCliente" id="telefono" class="form-control empty" required/>
                                                        <label class="floating-label">Teléfono</label>
                                                    </div> 
                                                    <?php if (!isset($_GET['empresa']) && $_GET['empresa'] === '1') { ?>
                                                        <div class="form-group form-material floating">
                                                            <select id="empresaNueva" name="EmpresaCliente" class="form-control empty" required>
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
                                                        <input type="text" name="EmpresaCliente" id="empresaNuevaInput" class="form-control Static" required value="<?php echo $_GET['empresa'] ?>" style="display: none"/>
                                                    <?php } ?>
                                                </div>
                                                <input name="acc" value="agregar-Clientes" style="display: none"/>
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
                url: '../Config/includes/Listados.php?acc=Clientes'+parametros,
                search: true,
                pagination: true,
                showRefresh: true,
                showColumns: true,
                iconSize: 'outline',
                toolbar: '#ModeloToolbar',
                onlyInfoPagination: true,
                totalRows: 25,
                pageSize: 50,
                icons: {
                    refresh: 'wb-refresh',
                    columns: 'wb-list-bulleted',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                },
                detailView: true,
                detailFormatter: function (index, row) {
                    var tabla = '<div class="table-responsive">\n\
                            <input type="text" class="form-control input-outline" style="margin-bottom: 5px; float: right;max-width: 200px" id="search-' + index + '" onkeyup="BuscardorInterno(\'' + index + '\',this)" placeholder="Buscar">\n\
                            <table class="table table-hover SubTabla" style="width: 100%">\n\
                                <thead style="height: 30px">\n\
                                    <tr>\n\
                                    <th style="vertical-align: middle">Nombre/Alias</th>\n\
                                    <th style="vertical-align: middle">Icono</th>\n\
                                    <th style="vertical-align: middle">Tipo</th>\n\
                                    <th style="vertical-align: middle">Cod GPS</th>\n\
                                    <th style="vertical-align: middle">Status</th>\n\
                                    <th style="vertical-align: middle">Acciones</th>\n\
                                    </tr>\n\
                                </thead>\n\
                                <tbody id="Tabla-Vehiculos-' + index + '">\n\
                                </tbody>\n\
                        </table>\n\
                    </div>';
                    VehiculosCliente(row.idCliente, index, parametros);
                    return tabla;
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
                $('#Nuevo-Cliente').formValidation({
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
                        },
                        ClaveCliente: {
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

        function BuscardorInterno(index, obj) {
            var $rows = $('#Tabla-Vehiculos-' + index + ' tr');
            var val = $.trim($(obj).val()).replace(/ +/g, ' ').toLowerCase();
            $rows.show().filter(function () {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        }

        function VehiculosCliente(Cliente, index, parametros) {
            var Lista = '';
            $.ajax({
                url: '../Config/includes/Listados.php?acc=Vehiculos'+parametros,
                dataType: 'JSON',
                contentType: 'application/json; charset=utf-8',
                method: 'GET',
                data: {
                    stlC: Cliente
                },
                beforeSend: function () {
                    $("#Tabla-Vehiculos-" + index).html('<tr ><td colspan="5" class="SinRespuesta"> Cargando listado... </td></tr>');
                },
                success: function (respuesta) {
                    if (respuesta) {
                        var aux = 0;
                        while (aux < respuesta.data.length) {
                            Lista += '<tr id="' + aux + '" class="ClientesDesplegable">\n\
                                        <td style="width: 25%; vertical-align: middle">' + respuesta.data[aux].Nombre + '</td>\n\
                                        <td style="width: 10%; vertical-align: middle; text-align: center"><img style="width: 40px" src="../Config/includes/imagenes/iconos/' + respuesta.data[aux].Icono + '"/></td>\n\
                                        <td style="width: 10%; vertical-align: middle; text-align: center">' + respuesta.data[aux].TipoObjeto + '</td>\n\
                                        <td style="width: 25%; vertical-align: middle">' + respuesta.data[aux].IMEI + '</td>\n\
                                        <td style="width: 10%; vertical-align: middle; text-align: center">' + respuesta.data[aux].Status + '</td>\n\
                                        <td style="width: 20%; vertical-align: middle">' + respuesta.data[aux].Acciones + '</td>\n\
                                    </tr>';
                            aux++;
                        }
                        if (Lista === '') {
                            Lista = '<tr ><td colspan="5" class="SinRespuesta"> *** Este Cliente no posee objetos de rastreo registrados *** </td></tr>';
                        }
                        $("#Tabla-Vehiculos-" + index).html(Lista);
                    }
                }
            });
            return Lista;
        }
        function LimpiarModal(Modal) {
            Modal.find('.modal-body').html('');
            Modal.find('.modal-title').html('');
        }
    </script>

    <?php
} else {
    header('location: LogIn.php');
}
?>
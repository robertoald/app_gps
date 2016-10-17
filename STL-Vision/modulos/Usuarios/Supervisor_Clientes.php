<?php
session_start();
include_once '../../Config/conexiones_config.php';
include_once '../../Config/includes/modelos/Clientes.php';
include_once '../../Config/includes/modelos/UsuariosEmpresas.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['usuario']) && $_GET['usuario'] != '') {
    $id = $_GET['usuario'];
}

$parametros = 'usuario=' . $id;
$parametros = _desordenar($parametros);

$Usuario = new UsuarioAdmin();
$Usuario->_Usuario($id);
$ListaClientes = str_replace(",", "','", $Usuario->Clientes);
$Clientes = new Clientes();
$Clientes->setIDEmpresa($Usuario->idEmpresa);
$Clientes->_listar();
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
                <span class="TituloM">Supervisores</span><span class="SubTituloM">Módulo Administrativo</span>
            </div>
        </div>
        <div class="col-md-12"  style="margin-top: -20px">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body nav-tabs-animate">
                    <div class="tab-content">
                        <div class="tab-pane active animation-slide-left panel" id="clientes" role="tabpanel">
                            <div class="row">
                                <div class="panel">
                                    <div class="panel-body container-fluid">
                                        <form id="Editar-UsuarioSuperC" autocomplete="off" action="javascript: _Modificar('UsuarioSuperC')">
                                            <div class="col-sm-9">
                                                <div class="col-sm-12">
                                                    <h4 style="color: #62a8ea">Clientes:</h4>
                                                </div>
                                                <div class="col-sm-12">
                                                    <span class="pull-left" style="font-weight: bold; font-style: italic; font-size: 12px">Todos</span>
                                                    <span class="pull-right" style="font-weight: bold; font-style: italic; font-size: 12px">Supervisados</span>
                                                </div>
                                                <input type="hidden" name="ClientesSupervisados" id="ClientesSupervisados" value="," />
                                                <div class="example-wrap" style="margin-bottom: 20px !important">
                                                    <div class="example">
                                                        <select class="multi-select-methods form-control" id="MultiSelect" multiple="multiple">
                                                            <?php
                                                            foreach ($Clientes->listado AS $listado) {
                                                                ?>  
                                                                <option value="<?php echo $listado['idCliente'] ?>"><?php echo $listado['Nombre'] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="text-align: center">
                                                    <div class="example-buttons">
                                                        <button class="btn btn-primary btn-outline btn-animate btn-animate-side" id="buttonSelectAll" type="button" style="font-size: 12px">
                                                            <span>
                                                                <i class="icon fa fa-share" aria-hidden="true"></i>
                                                                Todos
                                                            </span>
                                                        </button>
                                                        <button class="btn btn-primary btn-outline btn-animate btn-animate-side" id="buttonDeselectAll" type="button" style="font-size: 12px">
                                                            <span>
                                                                <i class="icon fa fa-reply" aria-hidden="true"></i>
                                                                Limpiar
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" style="text-align: center">
                                                <button id="form-submit" type="submit" class="btn btn-primary btn-round btn-block btn-animate btn-animate-side" style="font-size: 12px">
                                                    <span>
                                                        <i class="icon wb-edit" aria-hidden="true"></i>
                                                        Actualizar
                                                    </span>
                                                </button>
                                                <button onclick="_menu('Supervisor_Objetos', '<?php echo '&' . $parametros ?>')" id="form-submit" type="button" class="btn btn-primary btn-round btn-block btn-animate btn-animate-side" style="font-size: 12px">
                                                    <span>
                                                        <i class="icon wb-signal" aria-hidden="true"></i>
                                                        Objetos de Rastreo
                                                    </span>
                                                </button>
                                            </div>
                                            <input name="acc" value="agregar-ClientesSupervisados" style="display: none"/>
                                            <input name="Usuario" value="<?php echo $Usuario->idUsuario ?>" style="display: none"/>
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
            $('#MultiSelect').multiSelect({
                selectableOptgroup: true,
                afterSelect: function (val) {
                    var nuevo = $("#ClientesSupervisados").val() + '' + val;
                    if (nuevo.length !== $("#ClientesSupervisados").val().length) {
                        $("#ClientesSupervisados").val(nuevo + ',');
                    }
                },
                afterDeselect: function (val) {
                    var aux = 0;
                    if (val) {
                        while (aux < val.length) {
                            var nuevo = $("#ClientesSupervisados").val().replace(',' + val[aux] + ',', ',');
                            $("#ClientesSupervisados").val(nuevo);
                            aux++;
                        }
                    }
                }
            });
            $('#MultiSelect').multiSelect('select', ['<?php echo $ListaClientes ?>']);
            $('#buttonSelectAll').click(function () {
                $('#MultiSelect').multiSelect('select_all');
                return false;
            });
            $('#buttonDeselectAll').click(function () {
                $('#MultiSelect').multiSelect('deselect_all');
                $("#ClientesSupervisados").val(',');
                return false;
            });
        })();
    });
</script>
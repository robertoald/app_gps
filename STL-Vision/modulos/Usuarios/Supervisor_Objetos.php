<?php
session_start();
include_once '../../Config/conexiones_config.php';
include_once '../../Config/includes/modelos/Clientes.php';
include_once '../../Config/includes/modelos/Vehiculos.php';
include_once '../../Config/includes/modelos/UsuariosEmpresas.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['usuario']) && $_GET['usuario'] != '') {
    $id = $_GET['usuario'];
}

$Usuario = new UsuarioAdmin();
$Usuario->_Usuario($id);
$ListaClientes = explode(",", $Usuario->Clientes);
$ListaObjeto = str_replace(",", "','", $Usuario->Objetos);
$Clientes = new Clientes();
$Vehiculos = new Vehiculos();

$parametros = 'usuario=' . $id;
$parametros = _desordenar($parametros);
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
                                        <form id="Editar-UsuarioSuperV" autocomplete="off" action="javascript: _Modificar('UsuarioSuperV')">
                                            <div class="col-sm-9">
                                                <div class="col-sm-12">
                                                    <h4 style="color: #62a8ea">Objetos de Rastreo:</h4>
                                                </div>
                                                <div class="col-sm-12">
                                                    <span class="pull-left" style="font-weight: bold; font-style: italic; font-size: 12px">Todos</span>
                                                    <span class="pull-right" style="font-weight: bold; font-style: italic; font-size: 12px">Supervisados</span>
                                                </div>
                                                <input type="hidden" name="VehiculosSupervisados" id="VehiculosSupervisados" value="," />
                                                <div class="example-wrap" style="margin-bottom: 20px !important">
                                                    <div class="example">
                                                        <select class="multi-select-methods form-control" id="MultiSelect" multiple="multiple">
                                                            <?php
                                                            foreach ($ListaClientes AS $listado) {
                                                                $Clientes->_Cliente($listado);
                                                                $Vehiculos->setIDCliente($listado);
                                                                $Vehiculos->_listar();
                                                                ?>
                                                                <optgroup label="<?php echo $Clientes->Nombre ?>">
                                                                    <?php
                                                                    foreach ($Vehiculos->listado AS $listadoObjetos) {
                                                                        ?>  
                                                                        <option value="<?php echo $listadoObjetos['idVehiculo'] ?>"><?php echo $listadoObjetos['Nombre'] . ' (' . $listadoObjetos['TipoObjeto'] . ')' ?></option>
                                                                        <?php
                                                                    }
                                                                    $Vehiculos->listado = '';
                                                                    ?>
                                                                </optgroup>
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
                                                <button onclick="_menu('Supervisor_Clientes', '<?php echo '&' . $parametros ?>')" id="form-submit" type="button" class="btn btn-primary btn-round btn-block btn-animate btn-animate-side" style="font-size: 12px">
                                                    <span>
                                                        <i class="icon wb-users" aria-hidden="true"></i>
                                                        Clientes
                                                    </span>
                                                </button>
                                                <button onclick="_menu('Usuarios', $('#moduloUsuarios').data('extra'))" id="form-submit" type="button" class="btn btn-primary btn-round btn-block btn-animate btn-animate-side" style="font-size: 12px">
                                                    <span>
                                                        <i class="icon wb-user" aria-hidden="true"></i>
                                                        Lista de Usuarios
                                                    </span>
                                                </button>
                                            </div>
                                            <input name="acc" value="agregar-VehiculosSupervisados" style="display: none"/>
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
                    var nuevo = $("#VehiculosSupervisados").val() + '' + val;
                    if (nuevo.length !== $("#VehiculosSupervisados").val().length) {
                        $("#VehiculosSupervisados").val(nuevo + ',');
                    }
                },
                afterDeselect: function (val) {
                    var aux = 0;
                    if (val) {
                        while (aux < val.length) {
                            var nuevo = $("#VehiculosSupervisados").val().replace(',' + val[aux] + ',', ',');
                            $("#VehiculosSupervisados").val(nuevo);
                            aux++;
                        }
                    }
                }
            });
            $('#MultiSelect').multiSelect('select', ['<?php echo $ListaObjeto ?>']);
            $('#buttonSelectAll').click(function () {
                $('#MultiSelect').multiSelect('select_all');
                return false;
            });
            $('#buttonDeselectAll').click(function () {
                $('#MultiSelect').multiSelect('deselect_all');
                $("#VehiculosSupervisados").val(',');
                return false;
            });
        })();
    });
</script>
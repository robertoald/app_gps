<?php
session_start();
if (isset($_SESSION['name_admin']) || isset($_SESSION['name_SupraAdmin'])) {
    include_once ('../../Config/includes/modelos/Empresas.php');
    include_once ('../../Config/includes/modelos/UsuariosEmpresas.php');
    include_once ('../../Config/conexiones_config.php');
    decode_get2($_SERVER["REQUEST_URI"], 1);

    $Usuario = new UsuarioAdmin();
    $Usuario->_Usuario($_GET['id']);

    $parametrosEmpresa = 'empresaID=' . $_GET['empresa'];
    $parametrosEmpresa .= '&tipoUsuario=' . $Usuario->Tipo;
    $parametrosEmpresa .= '&clientesS=' . $Usuario->Clientes;
    $parametrosEmpresa .= '&objetosS=' . $Usuario->Objetos;

    $parametrosEmpresa_1d = '&' . _desordenar($parametrosEmpresa . '&dias=1');
    $parametrosEmpresa_3d = '&' . _desordenar($parametrosEmpresa . '&dias=3');
    $parametrosEmpresa_7d = '&' . _desordenar($parametrosEmpresa . '&dias=7');
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
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-6" style="margin-top: -35px">
                <!-- Page Widget -->
                <div class="page-header">
                    <span class="TituloM">Reportes</span><span class="SubTituloM">Módulo Administrativo</span>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: -20px">
                <!-- Panel -->
                <div class="panel">
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li class="active" role="listado">
                                <a data-toggle="tab" href="#listado" aria-controls="activities" role="tab">
                                    Accesos
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active animation-slide-left panel" id="listado" role="tabpanel">
                                <div style="margin-top: 10px; text-align: right">
                                    <button type="button" class="btn btn-primary btn-outline btn-reporte active" onclick="RecargarTabla('<?php echo $parametrosEmpresa_1d ?>')">
                                        1 Día
                                    </button>
                                    <button type="button" class="btn btn-primary btn-outline btn-reporte" onclick="RecargarTabla('<?php echo $parametrosEmpresa_3d ?>')">
                                        3 Días
                                    </button>
                                    <button type="button" class="btn btn-primary btn-outline btn-reporte" onclick="RecargarTabla('<?php echo $parametrosEmpresa_7d ?>')">
                                        Una Semana
                                    </button>
                                </div>
                                <table class="Listado-Modelos" data-height="400" data-mobile-responsive="true" >
                                    <thead>
                                        <tr>
                                            <th data-field="Usuario" data-sortable="true">Usuario</th>
                                            <th data-field="Nombre" data-sortable="true">Nombre</th>
                                            <th data-field="IP">IP</th>
                                            <th data-field="Pais">País</th>
                                            <th data-field="Fecha" data-sortable="true">Fecha</th>
                                        </tr>
                                    </thead>
                                </table>
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
                url: '../Config/includes/Listados.php?acc=Accesos' + parametros,
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
                }
            });
        }

        function RecargarTabla(parametros) {
            $('.Listado-Modelos').bootstrapTable('refresh', {
                url: '../Config/includes/Listados.php?acc=Accesos' + parametros
            });
        }

        $(document).ready(function () {
            IniciarListado('<?php echo $parametrosEmpresa_1d ?>');
            $(".btn-reporte").on('click', function(){
                $(".btn-reporte").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>

    <?php
} else {
    header('location: LogIn.php');
}
?>
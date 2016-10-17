<?php
session_start();
if (isset($_SESSION['name_admin'])) {
    ?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Vehículos <small>Admin</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-car fa-fw"></i> Lista de Vehículos</h3>
                    </div>
                    <div class="panel-body">
                        <table class="Datatable"></table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <script >
        $(document).ready(function () {

            $('.Datatable').DataTable({
                ajax: '../Config/includes/Listados.php?acc=Vehiculos',
                columns: [
                    {data: "Nombre", title: "Nombre"},
                    {data: "Placa", title: "Placa"},
                    {data: "Cliente", title: "Cliente"},
                    {data: "Empresa", title: "Empresa"},
                    {data: "Acciones", title: "Acciones"}
                ]

            });
        });
    </script>

    <?php
} else {
    header('location: LogIn.php');
}
?>
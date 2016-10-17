<?php
session_start();
include_once '../../../Config/conexiones_config.php';
include_once '../../../Config/includes/modelos/Vehiculos.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['idcliente']) && $_GET['idcliente'] != '') {
    $Cliente = $_GET['idcliente'];
}
if (isset($_GET['tipo']) && $_GET['tipo'] != '') {
    $Tipo = $_GET['tipo'];
}
if (isset($_GET['radio']) && $_GET['radio'] != '') {
    $Radio = $_GET['radio'];
}
if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
    $Nombre = $_GET['nombre'];
}
if (isset($_GET['puntos']) && $_GET['puntos'] != '') {
    $Puntos = $_GET['puntos'];
}
if (isset($_GET['geocerca']) && $_GET['geocerca'] != '') {
    $Geocerca = $_GET['geocerca'];
}
if (isset($_GET['modificar']) && $_GET['modificar'] == '1') {
    $accion = 'modificar-Geocercas';
} else {
    $accion = 'agregar-Geocercas';
}
?>
<form role="form" id="form-Geocercas" class="form-horizontal" action="javascript: Agregar('Geocercas')">
    <div class="form-group">
        <label class="control-label col-sm-4" for="nombre">Nombre</label>
        <div class="col-sm-6">
            <input type="text" name="NombreGeo" id="nombre" class="form-control form-input requerido" placeholder="Nombre" value="<?php echo $Nombre ?>"/>
            <label id="NombreGeo" style="display: none;"> Nombre requerido.</label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="puntos">Puntos</label>
        <div class="col-sm-6">
            <input type="text" name="PuntosGeo" id="puntos" class="form-control form-input requerido" readonly placeholder="Puntos" value="<?php echo $Puntos ?>"/>   
        </div>
    </div>
    <?php
    if ($Radio != '') {
        ?>
        <div class="form-group">
            <label class="control-label col-sm-4" for="radio">Radio</label>
            <div class="col-sm-6">
                <input type="text" name="RadioGeo" id="radio" class="form-control form-input requerido" readonly placeholder="Radio" value="<?php echo $Radio ?>"/>   
            </div>
        </div>
        <?php
    }
    ?>
    <input id="acc" name="acc" value="<?php echo $accion ?>" style="display: none"/>
    <input type="text" name="Tipo" value="<?php echo $Tipo ?>" style="display: none"/>
    <input type="text" name="Cliente" value="<?php echo $Cliente ?>" style="display: none"/>
    <input type="text" name="Geocerca" value="<?php echo $Geocerca ?>" style="display: none"/>
</form>
<script>
    $(document).ready(function () {
        $('.requerido').on('change', function () {
            var id = $(this).attr('name');
            $('#' + id + '').css({'display': 'none'});
        });
    });
</script>
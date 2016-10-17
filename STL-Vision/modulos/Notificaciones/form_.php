<?php
session_start();
include_once '../../../Config/conexiones_config.php';
include_once '../../../Config/includes/modelos/Vehiculos.php';
include_once '../../../Config/includes/modelos/Geocercas.php';
include_once '../../../Config/includes/modelos/Eventos.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['idcliente']) && $_GET['idcliente'] != '') {
    $Cliente = $_GET['idcliente'];
}
if (isset($_GET['notificacion']) && $_GET['notificacion'] != '') {
    $Notificacion = $_GET['notificacion'];
}
if (isset($_GET['vehiculo']) && $_GET['vehiculo'] != '') {
    $Vehiculo = $_GET['vehiculo'];
}
if (isset($_GET['tipo']) && $_GET['tipo'] != '') {
    $Tipo = $_GET['tipo'];
}
if (isset($_GET['tipoalerta']) && $_GET['tipoalerta'] != '') {
    $TipoAlerta = $_GET['tipoalerta'];
}
if (isset($_GET['alerta']) && $_GET['alerta'] != '') {
    $Alerta = $_GET['alerta'];
}
if (isset($_GET['destino']) && $_GET['destino'] != '') {
    $Destino = $_GET['destino'];
}
if (isset($_GET['modificar']) && $_GET['modificar'] == '1') {
    $accion = 'modificar-Notificaciones';
} else {
    $accion = 'agregar-Notificaciones';
}

$vehiculos = new Vehiculos();
$vehiculos->setIDCliente($Cliente);
$vehiculos->_listar();
$geocercas = new Geocercas();
$geocercas->setCliente($Cliente);
$geocercas->_listar();
$eventos = new Eventos();
$eventos->_listar();
?>
<form role="form" id="form-Notificaciones" class="form-horizontal" action="javascript: Agregar('Notificaciones')">
    <div class="form-group">
        <label class="control-label col-sm-4" for="destino">Destino</label>
        <div class="col-sm-6">
            <input type="text" name="DestinoNotif" id="destino" class="form-control form-input requerido" placeholder="Destino" value="<?php echo $Destino ?>"/>
            <label id="DestinoNotif" style="display: none;"> Destino requerido.</label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="tipo">Tipo</label>
        <div class="col-sm-6">
            <select id="tipo" name="TipoNotif" class="form-control form-input requerido">
                <option value="" selected>  Seleccionar...  </option>
                <option value="1"> Correo Electrónico </option>
                <option value="2"> SMS </option>
                <option value="3"> WhatsApp </option>
            </select>
            <label id="TipoNotif" style="display: none;"> Tipo requerido.</label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="tipo">Vehículos</label>
        <div class="col-sm-6">
            <select id="vehiculo" name="VehiculoNotif" class="form-control form-input requerido">
                <option value="">  Seleccionar...  </option>
                <?php
                foreach ($vehiculos->listado AS $listado) {
                    ?>  
                    <option value="<?php echo $listado['idVehiculo'] ?>"><?php echo $listado['Nombre'] . ' - ' . $listado['Placa'] ?></option>
                    <?php
                }
                ?>
            </select>
            <label id="VehiculoNotif" style="display: none;"> Vehículo requerido.</label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="tipoalerta">Tipo de Alerta</label>
        <div class="col-sm-6">
            <select id="tipoalerta" name="TipoAlerta" class="form-control form-input requerido">
                <option value="">  Seleccionar...  </option>
                <option value="1"> Evento </option>
                <option value="2"> Geocerca </option>
                <option value="3"> Velocidad </option>
            </select>
            <label id="TipoAlerta" style="display: none;"> Tipo de Alerta requerido.</label>
        </div>
    </div>
    <div class="form-group" id="2" style="display: none">
        <label class="control-label col-sm-4" for="geocercas">Geocercas</label>
        <div class="col-sm-6">
            <select id="2-campo" name="GeocercaNotif" class="form-control form-input">
                <option value="">  Seleccionar...  </option>
                <?php
                foreach ($geocercas->listado AS $listadoGeo) {
                    ?>  
                    <option value="<?php echo $listadoGeo['idgeocercas'] ?>"><?php echo $listadoGeo['Nombre'] ?></option>
                    <?php
                }
                ?>
            </select>
            <label id="GeocercaNotif" style="display: none;"> Geocerca requerida.</label>
        </div>
    </div>
    <div class="form-group" id="1" style="display: none">
        <label class="control-label col-sm-4" for="eventos">Eventos</label>
        <div class="col-sm-6">
            <select id="1-campo" name="EventoNotif" class="form-control form-input">
                <option value="">  Seleccionar...  </option>
                <?php
                foreach ($eventos->listado AS $listadoEv) {
                    ?>  
                    <option value="<?php echo $listadoEv['id'] ?>"><?php echo $listadoEv['Descripcion'] ?></option>
                    <?php
                }
                ?>
            </select>
            <label id="EventoNotif" style="display: none;"> Evento requerido.</label>
        </div>
    </div>
    <div class="form-group" id="3" style="display: none">
        <label class="control-label col-sm-4" for="velocidad">Velocidad Máxima</label>
        <div class="col-sm-6">
            <input type="text" name="VelocidadNotif" id="3-campo" class="form-control form-input" placeholder="Velocidad Máxima"/>
            <label id="VelocidadNotif" style="display: none;"> Velocidad Máxima requerida.</label>
        </div>
    </div>
    <input id="acc" name="acc" value="<?php echo $accion ?>" style="display: none"/>
    <input type="text" name="ClienteNotif" value="<?php echo $Cliente ?>" style="display: none"/>
    <input type="text" name="Notificacion" value="<?php echo $Notificacion ?>" style="display: none"/>
</form>
<script>
    $('#tipoalerta').on('change', function () {
        var id = $(this).val();
        var i = 1;
        while (i <= 3) {
            $('#' + i + '').css({'display': 'none'});
            $('#' + i + '-campo').removeClass('requerido');
            i++;
        }
        $('#' + id + '').css({'display': ''});
        $('#' + id + '-campo').addClass('requerido');
    });

    $(document).ready(function () {
        $('#vehiculo option[value="<?php echo $Vehiculo ?>"]').attr('selected', 'selected');
        $('#tipo option[value="<?php echo $Tipo ?>"]').attr('selected', 'selected');
        $('#tipoalerta option[value="<?php echo $TipoAlerta ?>"]').attr('selected', 'selected');
        var TipoAlerta = '<?php echo $TipoAlerta ?>';
        if (TipoAlerta != '') {
            if (TipoAlerta === 3) {
                $('#<?php echo $TipoAlerta ?>-campo').val('<?php echo $Alerta ?>');
            } else {
                $('#<?php echo $TipoAlerta ?>-campo option[value="<?php echo $Alerta ?>"]').attr('selected', 'selected');
            }
            $('#tipoalerta').trigger('change');
        }

        $('.requerido').on('change', function () {
            var id = $(this).attr('name');
            $('#' + id + '').css({'display': 'none'});
        });
    });
</script>
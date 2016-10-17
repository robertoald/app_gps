<?php
session_start();
include_once '../../../Config/conexiones_config.php';
include_once '../../../Config/includes/modelos/Vehiculos.php';
include_once '../../../Config/includes/modelos/Iconos.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['cliente']) && $_GET['cliente'] != '') {
    $Cliente = $_GET['cliente'];
}
if (isset($_GET['empresa']) && $_GET['empresa'] != '') {
    $Empresa = $_GET['empresa'];
}
$TipoObjetos = new Vehiculos();
$TipoObjetos->_TipoObjetos();

$ListadeIconos = new Iconos();
$ListadeIconos->_listar();
?>
<style>
    #Especificos > div > div > div{
        height: 50px;
    }
    #FormObjetosRastreo > div{
        min-height: 350px;
    }
    .pearl-title{
        font-size: 12px;
    }
</style>
<div class="row">
    <div class="panel">
        <div class="panel-body container-fluid">
            <div class="col-sm-12">
                <div class="panel" id="exampleWizardFormContainer">
                    <div class="panel-body">
                        <!-- Steps -->
                        <div class="pearls row">
                            <div class="pearl current col-xs-4">
                                <div class="pearl-icon"><i class="oi-list-unordered" aria-hidden="true"></i></div>
                                <span class="pearl-title">Tipos</span>
                            </div>
                            <div class="pearl col-xs-4">
                                <div class="pearl-icon"><i class="oi-radio-tower" aria-hidden="true"></i></div>
                                <span class="pearl-title">GPS</span>
                            </div>
                            <div class="pearl col-xs-4">
                                <div class="pearl-icon"><i class="oi-checklist" aria-hidden="true"></i></div>
                                <span class="pearl-title">Información</span>
                            </div>
                        </div>
                        <!-- End Steps -->
                        <!-- Wizard Content -->
                        <form class="wizard-content" id="FormObjetosRastreo">
                            <div class="wizard-pane active" role="tabpanel">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <input type="hidden" name="acc" value="agregar-ObjetoRastreo" />
                                        <input type="hidden" name="Cliente" value="<?php echo $Cliente ?>" />
                                        <input type="hidden" name="Empresa" value="<?php echo $Empresa ?>" />
                                        <div class="form-group form-material floating">
                                            <select id="TipoObjeto" name="TipoObjeto" class="form-control empty" required onchange="Mostrar(this)">
                                                <option value="" data-detalle="Seleccionar un Objeto de Rastreo">  </option>
                                                <?php
                                                foreach ($TipoObjetos->TipoObjeto AS $listado) {
                                                    ?>  
                                                    <option value="<?php echo $listado['Tipo'] ?>" data-detalle="<?php echo $listado['Detalle'] ?>"><?php echo $listado['Descripcion'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <label class="floating-label">Tipo de Objeto de Rastreo</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div id="TipoDeObjetoDescripcion" style="color: #62a8ea  !important; text-shadow: 2px 2px #D3D3D3;font-weight: bold; font-style: italic;text-align: center; width: 60%; height: 100px; vertical-align: middle; margin: 45px auto;display: flex;justify-content: center; align-items: center; ">
                                            Seleccionar un Objeto de Rastreo
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-pane" role="tabpanel">
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="IP" id="IP" class="form-control" readonly required value="200.214.122.12" />
                                            <label class="floating-label">IP</label>
                                        </div> 
                                        <div class="form-group form-material floating">
                                            <select id="ModeloGPS" name="ModeloGPS" class="form-control empty" required>
                                                <option value="">  </option>
                                                <option value="TK103"> TK103 </option>
                                            </select>
                                            <label class="floating-label">Modelo</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="IMEI" id="IMEI" class="form-control empty" required value="" onblur="ValidarIMEI(this, $('#FormObjetosRastreo'))"/>
                                            <label class="floating-label">Código GPS</label>
                                        </div> 
                                        <div class="form-group form-material floating">
                                            <input type="text" name="SyncE" id="SyncE" class="form-control empty" required value="" />
                                            <label class="floating-label">Sync Every</label>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-pane" id="Especificos" role="tabpanel">
                                <div class="col-sm-12">
                                    <div class="col-sm-6" id="Nombre">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="NombreObjeto" id="NombreObjeto" class="form-control empty" required value="" />
                                            <label class="floating-label">Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="Contacto">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="ContactoObjeto" id="ContactoObjeto" class="form-control empty" required value="" />
                                            <label class="floating-label">Contacto</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="Direccion">
                                        <div class="form-group form-material floating" >
                                            <input type="text" name="DireccionObjeto" id="DireccionObjeto" class="form-control empty" required value="" />
                                            <label class="floating-label">Dirección</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="Telefono">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="TelefonoObjeto" id="TelefonoObjeto" class="form-control empty" required value="" />
                                            <label class="floating-label">Teléfono</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="Tipo">
                                        <div class="form-group form-material floating">
                                            <select id="TipoCaracteristico" name="TipoCaracteristico" class="form-control empty" required onchange="Listados($(this).val(), 2, $('#FormObjetosRastreo'))">
                                                <option value="">  </option>
                                            </select>
                                            <label class="floating-label">Tipos</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="Placa">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="PlacaObjeto" id="PlacaObjeto" class="form-control empty" required value="" />
                                            <label class="floating-label">Placa</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="Marca">
                                        <div class="form-group form-material floating">
                                            <select id="MarcaObjeto" name="MarcaObjeto" class="form-control empty" required onchange="Listados($(this).val(), 3, $('#FormObjetosRastreo'))">
                                                <option value="">  </option>
                                            </select>
                                            <label class="floating-label">Marca</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="Comentario">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="ComentarioObjeto" id="ComentarioObjeto" class="form-control empty" required value="" />
                                            <label class="floating-label">Comentario</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="Modelo">
                                        <div class="form-group form-material floating">
                                            <select id="ModeloObjeto" name="ModeloObjeto" class="form-control empty" required>
                                                <option value="">  </option>
                                            </select>
                                            <label class="floating-label">Modelo</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 Icono">
                                        <div class="form-group form-material floating">
                                            <select id="IconoObjeto" name="IconoObjeto" class="form-control empty" required onchange="MostrarIcono()">
                                                <option value="" data-val2="">  </option>
                                                <?php
                                                foreach ($ListadeIconos->listado AS $listadoIcon) {
                                                    ?>  
                                                    <option value="<?php echo $listadoIcon['idIcono'] ?>" data-val2="<?php echo $listadoIcon['Nombre'] ?>"><?php echo $listadoIcon['Descripcion'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <label class="floating-label">Icono</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 Icono">
                                        <img style="width: 35px; height: 35px;margin-top: 18px; display: none" id="Icono-Preview" src=""/>
                                    </div>
                                    <div class="col-sm-6" id="Año">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="AnioObjeto" id="AnioObjeto" class="form-control empty" required value="" />
                                            <label class="floating-label">Año</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="km">
                                        <div class="form-group form-material floating">
                                            <input type="text" name="kmActual" id="kmActual" class="form-control empty" required value="" />
                                            <label class="floating-label">Km. Actual</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Wizard Content -->
                    </div>
                </div>
                <!-- End Panel Wizard Form Container -->                                            
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        Ocultar();
        $.components.register("wizard", {
            mode: "default",
            defaults: {
                step: ".steps .step, .pearls .pearl",
                templates: {
                    buttons: function () {
                        var options = this.options;
                        return '<div class="wizard-buttons">' +
                                '<a class="btn btn-default btn-outline" href="#' + this.id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a>' +
                                '<a class="btn btn-primary btn-outline pull-right" href="#' + this.id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a>' +
                                '<a id="WizardButton" class="btn btn-success btn-outline pull-right" href="#' + this.id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a>' +
                                '</div>';
                    }
                }
            }
        });
        (function () {
            var defaults = $.components.getDefaults("wizard");
            var options = $.extend(true, {}, defaults, {
                onInit: function () {
                    $('#FormObjetosRastreo').formValidation({
                        framework: 'bootstrap',
                        fields: {
                            NombreObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Nombre</b> es requerido.'
                                    }
                                }
                            },
                            ContactoObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Contacto</b> es requerido.'
                                    }
                                }
                            },
                            DireccionObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Dirección</b> es requerido.'
                                    }
                                }
                            },
                            TelefonoObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Teléfono</b> es requerido.'
                                    }
                                }
                            },
                            TipoCaracteristico: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Tipo</b> es requerido.'
                                    }
                                }
                            },
                            PlacaObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Placa</b> es requerido.'
                                    }
                                }
                            },
                            MarcaObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Marca</b> es requerido.'
                                    }
                                }
                            },
                            ModeloObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Modelo</b> es requerido.'
                                    }
                                }
                            },
                            AnioObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Año</b> es requerido.'
                                    }
                                }
                            },
                            kmActual: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Kilometraje</b> es requerido.'
                                    }
                                }
                            },
                            IconoObjeto: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Icono</b> es requerido.'
                                    }
                                }
                            },
                            ModeloGPS: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>Modelo</b> es requerido.'
                                    }
                                }
                            },
                            SyncE: {
                                validators: {
                                    notEmpty: {
                                        message: 'El campo <b>SyncE</b> es requerido.'
                                    }
                                }
                            },
                            IMEI: {
                                validators: {
                                    notEmpty: {
                                        message: ''
                                    }
                                }
                            }
                        }
                    });
                },
                validator: function () {
                    var fv = $('#FormObjetosRastreo').data('formValidation');
                    fv.updateMessage($("#IMEI"), 'notEmpty', '');
                    var $this = $(this);

                    // Validate the container
                    fv.validateContainer($this);

                    var isValidStep = fv.isValidContainer($this);
                    if (isValidStep === false || isValidStep === null) {
                        return false;
                    }

                    return true;
                },
                onFinish: function () {
                    // $('#FormObjetosRastreo').submit();
                    var form = $('#FormObjetosRastreo');
                    var Datos = DatosFormulario(form);
                    $.ajax({
                        url: '../Config/includes/Puente.php',
                        dataType: 'JSON',
                        contentType: 'application/json; charset=utf-8',
                        method: 'POST',
                        timeout: 30000,
                        error: function () {
                            alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
                        },
                        data: JSON.stringify(Datos),
                        beforeSend: function () {
                            $('#WizardButton').css({'display': 'none'});
                        },
                        success: function (respuesta) {
                            if (respuesta.data === 'Exito') {
                                $("#myModalWizard").find('.modal-body').html('');
                                $("#myModalWizard").find('.modal-title').html('');
                                $("#myModalWizard").modal('hide');
                                alertify.success(respuesta.mensaje);
                                _RefreshDatatable();
                            }
                            if (respuesta.data === 'Error') {
                                alertify.error(respuesta.mensaje);
                                $('#WizardButton').css({'display': ''});
                            }
                        }
                    });
                },
                buttonsAppendTo: '.panel-body'
            });

            $("#exampleWizardFormContainer").wizard(options);
        })();
    });

    function Ocultar() {
        $('#Especificos > div > div').css({display: 'none'});
        $('#Especificos').find('input,select').attr('disabled', true);
    }

    function Mostrar(Tipo) {
        Listados($(Tipo).val(), 1, $("#FormObjetosRastreo"));
        Ocultar();
        var tipoO = $(Tipo).val();
        $('#TipoDeObjetoDescripcion').animate({opacity: 0, height: "hide"},
                {
                    easing: 'swing',
                    duration: 500,
                    complete: function () {
                        $(this).html($(Tipo).find('option:selected').data('detalle'));
                        $('#TipoDeObjetoDescripcion').animate({opacity: 1, height: "show"}, 500);
                    }
                });
        switch (tipoO) {
            case '1':
                $('#Nombre').css({display: 'inherit'});
                $('#Nombre input').removeAttr('disabled');
                $('#Direccion').css({display: 'inherit'});
                $('#Direccion input').removeAttr('disabled');
                $('#Telefono').css({display: 'inherit'});
                $('#Telefono input').removeAttr('disabled');
                $('.Icono').css({display: 'inherit'});
                $('.Icono select').removeAttr('disabled');
                break;
            case '2':
                $('#Nombre').css({display: 'inherit'});
                $('#Nombre input').removeAttr('disabled');
                $('#Direccion').css({display: 'inherit'});
                $('#Direccion input').removeAttr('disabled');
                $('#Telefono').css({display: 'inherit'});
                $('#Telefono input').removeAttr('disabled');
                $('#Tipo').css({display: 'inherit'});
                $('#Tipo select').removeAttr('disabled');
                $('#Contacto').css({display: 'inherit'});
                $('#Contacto input').removeAttr('disabled');
                $('.Icono').css({display: 'inherit'});
                $('.Icono select').removeAttr('disabled');
                break;
            case '3':
                $('#Nombre').css({display: 'inherit'});
                $('#Nombre input').removeAttr('disabled');
                $('#Tipo').css({display: 'inherit'});
                $('#Tipo select').removeAttr('disabled');
                $('#Comentario').css({display: 'inherit'});
                $('#Comentario input').removeAttr('disabled');
                $('#Placa').css({display: 'inherit'});
                $('#Placa input').removeAttr('disabled');
                $('#Año').css({display: 'inherit'});
                $('#Año input').removeAttr('disabled');
                $('#km').css({display: 'inherit'});
                $('#km input').removeAttr('disabled');
                $('.Icono').css({display: 'inherit'});
                $('.Icono select').removeAttr('disabled');
                break;
            case '4':
                $('#Nombre').css({display: 'inherit'});
                $('#Nombre input').removeAttr('disabled');
                $('#Contacto').css({display: 'inherit'});
                $('#Contacto input').removeAttr('disabled');
                $('#Comentario').css({display: 'inherit'});
                $('#Comentario input').removeAttr('disabled');
                $('.Icono').css({display: 'inherit'});
                $('.Icono select').removeAttr('disabled');
                break;

        }
    }
</script>
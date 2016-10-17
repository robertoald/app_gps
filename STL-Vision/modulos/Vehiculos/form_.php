<?php
session_start();
include_once '../../../Config/conexiones_config.php';
include_once '../../../Config/includes/modelos/Iconos.php';
include_once '../../../Config/includes/modelos/Vehiculos.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['objeto']) && $_GET['objeto'] != '') {
    $Objeto = $_GET['objeto'];
}
if (isset($_GET['icono']) && $_GET['icono'] != '') {
    $Icono = $_GET['icono'];
}
if (isset($_GET['tipo_objeto']) && $_GET['tipo_objeto'] != '0') {
    $TipoObjeto = $_GET['tipo_objeto'];
}
$ListadeIconos = new Iconos();
$ListadeIconos->_listar();
?>

<div class="row">
    <div class="panel">
        <div class="panel-body container-fluid">
            <form id="Editar-ObjetoRastreo" autocomplete="off" action="javascript: _Modificar('ObjetoRastreo')">
                <div class="col-sm-12">
                    <?php if (isset($_GET['nombreV']) && $_GET['nombreV'] !== '') { ?>
                        <div class="col-sm-6" id="Nombre">
                            <div class="form-group form-material floating">
                                <input type="text" name="NombreObjeto" id="NombreObjeto" class="form-control" required value="<?php echo $_GET['nombreV'] ?>" />
                                <label class="floating-label">Nombre</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['contacto']) && $_GET['contacto'] !== '') { ?>
                        <div class="col-sm-6" id="Contacto">
                            <div class="form-group form-material floating">
                                <input type="text" name="ContactoObjeto" id="ContactoObjeto" class="form-control" required value="<?php echo $_GET['contacto'] ?>" />
                                <label class="floating-label">Contacto</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['direccion']) && $_GET['direccion'] !== '') { ?>
                        <div class="col-sm-6" id="Direccion">
                            <div class="form-group form-material floating" >
                                <input type="text" name="DireccionObjeto" id="DireccionObjeto" class="form-control" required value="<?php echo $_GET['direccion'] ?>" />
                                <label class="floating-label">Dirección</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['telefono']) && $_GET['telefono'] !== '') { ?>
                        <div class="col-sm-6" id="Telefono">
                            <div class="form-group form-material floating">
                                <input type="text" name="TelefonoObjeto" id="TelefonoObjeto" class="form-control" required value="<?php echo $_GET['telefono'] ?>" />
                                <label class="floating-label">Teléfono</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if (isset($_GET['tipo_especifico']) && $_GET['tipo_especifico'] !== '0') {
                        $ListadeTE = new Vehiculos();
                        if ($TipoObjeto === '2') {
                            $ListadeTE->_Animales();
                            $Lista = $ListadeTE->Animales;
                        }
                        if ($TipoObjeto === '3') {
                            $ListadeTE->_TiposVehiculos();
                            $Lista = $ListadeTE->TiposVehiculos;
                        }
                        ?>
                        <div class="col-sm-6" id="Tipo">
                            <div class="form-group form-material floating">
                                <select id="TipoCaracteristico" name="TipoCaracteristico" class="form-control" required onchange="Listados($(this).val(), 2, $('#Editar-ObjetoRastreo'))">
                                    <?php
                                    foreach ($Lista AS $listado) {
                                        ?>  
                                        <option value="<?php echo $listado['id'] ?>"><?php echo $listado['Descripcion'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <label class="floating-label">Tipos</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['placa']) && $_GET['placa'] !== '') { ?>
                        <div class="col-sm-6" id="Placa">
                            <div class="form-group form-material floating">
                                <input type="text" name="PlacaObjeto" id="PlacaObjeto" class="form-control" required value="<?php echo $_GET['placa'] ?>" />
                                <label class="floating-label">Placa</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if (isset($_GET['tipo_especifico']) && $_GET['tipo_especifico'] !== '0' && ($TipoObjeto === '2' || $TipoObjeto === '3')) {
                        $ListadeMA = new Vehiculos();
                        $ListadeMA->setTipo($_GET['tipo_especifico']);
                        $ListadeMA->_Marcas();
                        ?>
                        <div class="col-sm-6" id="Marca">
                            <div class="form-group form-material floating">
                                <select id="MarcaObjeto" name="MarcaObjeto" class="form-control" required onchange="Listados($(this).val(), 3, $('#Editar-ObjetoRastreo'))">
                                    <?php
                                    foreach ($ListadeMA->Marcas AS $listado) {
                                        ?>  
                                        <option value="<?php echo $listado['id'] ?>"><?php echo $listado['Descripcion'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <label class="floating-label">Marca</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['comentario']) && $_GET['comentario'] !== '') { ?>
                        <div class="col-sm-6" id="Comentario">
                            <div class="form-group form-material floating">
                                <input type="text" name="ComentarioObjeto" id="ComentarioObjeto" class="form-control" required value="<?php echo $_GET['comentario'] ?>" />
                                <label class="floating-label">Comentario</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    if (isset($_GET['tipo_especifico']) && $_GET['tipo_especifico'] !== '0' && ($TipoObjeto === '2' || $TipoObjeto === '3')) {
                        $ListadoMO = new Vehiculos();
                        $ListadoMO->setMarca($_GET['marca']);
                        $ListadoMO->_Modelos();
                        ?>
                        <div class="col-sm-6" id="Modelo">
                            <div class="form-group form-material floating">
                                <select id="ModeloObjeto" name="ModeloObjeto" class="form-control" required>
                                    <?php
                                    foreach ($ListadoMO->Modelos AS $listado) {
                                        ?>  
                                        <option value="<?php echo $listado['id'] ?>"><?php echo $listado['Descripcion'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <label class="floating-label">Modelo</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['año']) && $_GET['año'] !== '') { ?>
                        <div class="col-sm-6" id="Año">
                            <div class="form-group form-material floating">
                                <input type="text" name="AnioObjeto" id="AnioObjeto" class="form-control" required value="<?php echo $_GET['año'] ?>" />
                                <label class="floating-label">Año</label>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['km_Actual']) && $_GET['km_Actual'] !== '0') { ?>
                        <div class="col-sm-6" id="km">
                            <div class="form-group form-material floating">
                                <input type="text" name="kmActual" id="kmActual" class="form-control" required value="<?php echo $_GET['km_Actual'] ?>" />
                                <label class="floating-label">Km. Actual</label>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-sm-5 Icono">
                        <div class="form-group form-material floating">
                            <select id="iconoE" name="IconoObjeto" class="form-control" required>
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
                    <div class="col-sm-1">
                        <img style="width: 35px; height: 35px;margin-top: 18px; display: none" id="iconoE-Preview" src=""/>
                    </div>
                </div>
                <input type="hidden" id="TipoObjeto" value="<?php echo $TipoObjeto ?>"/>
                <input type="hidden" name="Objeto" value="<?php echo $Objeto ?>"/>
                <input name="acc" value="modificar-ObjetoRastreo" style="display: none"/>
                <div class="col-sm-12 center-block">
                    <div class="pull-right">
                        <button type="submit" id="form-submit" class="btn btn-animate btn-animate-vertical btn-primary">
                            <span>
                                <i class="icon wb-edit" aria-hidden="true"></i>
                                Guardar Cambios
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        (function () {
            $('#Editar-ObjetoRastreo').formValidation({
                framework: "bootstrap",
                button: {
                    selector: '#form-submit',
                    disabled: 'disabled'
                },
                icon: null,
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
                    }
                }
            });
        })();

        $('#iconoE').on('change', function () {
            if ($('#iconoE :selected').data('val2') !== '') {
                $('#iconoE-Preview').attr('src', "../../../Config/includes/imagenes/iconos/" + $('#iconoE :selected').data('val2'));
                $('#iconoE-Preview').css({display: ''});
            } else {
                $('#iconoE-Preview').css({display: 'none'});
            }
        });

        $('#iconoE option[value="<?php echo $Icono ?>"]').attr('selected', 'selected');
        if ('<?php echo $TipoObjeto ?>' === '2' || '<?php echo $TipoObjeto ?>' === '3') {
            $('#TipoCaracteristico option[value="<?php echo $_GET['tipo_especifico'] ?>"]').attr('selected', 'selected');
            if (('<?php echo $_GET['tipo_especifico'] ?>' === '1' && '<?php echo $TipoObjeto ?>' === '3') || ('<?php echo $_GET['tipo_especifico'] ?>' === '2'  && '<?php echo $TipoObjeto ?>' === '3')) {
                $('#MarcaObjeto option[value="<?php echo $_GET['marca'] ?>"]').attr('selected', 'selected');
                $('#ModeloObjeto option[value="<?php echo $_GET['modelo'] ?>"]').attr('selected', 'selected');
            } else {
                $("#Marca").css({display: 'none'});
                $("#Marca").find('select').attr('disabled', true);
                $("#Modelo").css({display: 'none'});
                $("#Modelo").find('select').attr('disabled', true);
            }
        }
        $('#iconoE').trigger('change');
    });
</script>
<?php
session_start();
include_once '../../Config/includes/modelos/Empresas.php';
include_once '../../Config/conexiones_config.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

$Empresa = new Empresas();
$Empresa->_Empresa($_GET['empresa']);
$parametrosUsuario = 'id=' . $_GET['usuario'];
$parametrosUsuario .= '&x=gt7';
$parametrosUsuario = _desordenar($parametrosUsuario);
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
<div class="panel">
    <div class="panel-heading">
        <div class="page-header">
            <span class="TituloM">Actualizar Logo de Empresa</span>
        </div>
    </div>
    <div class="panel-body container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="cropper text-center" id="exampleFullCropper">
                    <img src="../STL-Vision/imagen/empresas/<?php echo $Empresa->Logo.'?'.Date('YmdHis') ?>"  alt="...">
                </div>
                <div class="cropper-toolbar text-center">
                    <div class="btn-group margin-bottom-20">
                        <button type="button" class="btn btn-primary" data-cropper-method="zoom" data-option="0.1"
                                data-toggle="tooltip" data-container="body" title="Acercar">
                            <span class="cropper-tooltip" title="Acercar">
                                <i class="wb-zoom-in"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-cropper-method="zoom" data-option="-0.1"
                                data-toggle="tooltip" data-container="body" title="Alejar">
                            <span class="cropper-tooltip" title="Alejar">
                                <i class="wb-zoom-out"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-cropper-method="rotate" data-option="-90"
                                data-toggle="tooltip" data-container="body" title="Rotar a la izquierda 90°">
                            <span class="cropper-tooltip" title="Rotar a la izquierda 90°">
                                <i class="wb-arrow-left cropper-flip-horizontal"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-cropper-method="rotate" data-option="90"
                                data-toggle="tooltip" data-container="body" title="Rotar a la derecha 90°">
                            <span class="cropper-tooltip" title="Rotar a la derecha 90°">
                                <i class="wb-arrow-right"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-cropper-method="rotate" data-option="-10"
                                data-toggle="tooltip" data-container="body" title="Rotar a la izquierda 10°">
                            <span class="cropper-tooltip" title="Rotar a la izquierda 10°">
                                <i class="wb-refresh cropper-flip-horizontal"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-cropper-method="rotate" data-option="10"
                                data-toggle="tooltip" data-container="body" title="Rotar a la derecha 10°">
                            <span class="cropper-tooltip" title="Rotar a la derecha 10°">
                                <i class="icon wb-reload" aria-hidden="true"></i>
                            </span>
                        </button>
                    </div>
                    <div class="btn-group margin-bottom-20">
                        <button type="button" class="btn btn-primary" data-cropper-method="setDragMode"
                                data-option="move" data-toggle="tooltip" data-container="body"
                                title="Mover">
                            <span class="cropper-tooltip" title="Mover">
                                <i class="icon wb-move" aria-hidden="true"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-cropper-method="setDragMode"
                                data-option="crop" data-toggle="tooltip" data-container="body"
                                title="Cortar">
                            <span class="cropper-tooltip" title="Cortar">
                                <i class="icon wb-crop" aria-hidden="true"></i>
                            </span>
                        </button>
                        <button type="button" class="btn btn-primary" data-cropper-method="getCroppedCanvas"
                                data-option='{ "width": 240, "height": 70 }' data-toggle="tooltip"
                                data-container="body" title="Vista Previa">
                            <span class="cropper-tooltip" title="Vista Previa">
                                <i class="icon wb-image" aria-hidden="true"></i>
                            </span>
                        </button>
                        <label class="btn btn-primary" data-toggle="tooltip" for="inputImage" data-container="body"
                               title="Seleccionar Imagen">
                            <input type="file" class="hide" id="inputImage" name="file" accept="image/*">
                            <span class="cropper-tooltip" title="Seleccionar Imagen">
                                <i class="icon wb-upload" aria-hidden="true"></i>
                            </span>
                        </label>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade docs-cropped" id="getDataURLModal" aria-hidden="true" aria-labelledby="getDataURLTitle"
                         role="dialog" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="getDataURLTitle">Vista Previa</h4>
                                </div>
                                <div class="modal-body"></div>
                                <div class="modal-footer">
                                    <button type="button" id="SubirLogo" onclick="subirImagenCortada('<?php echo $Empresa->idEmpresa ?>')" class="btn btn-animate btn-animate-vertical btn-primary">
                                        <span>
                                            <i class="icon wb-upload" aria-hidden="true"></i>
                                            Actualizar Logo
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="cropper-preview clearfix" id="exampleFullCropperPreview">
                    <div class="img-preview preview-lg"></div>
                </div>
            </div>
            <div class="col-md-12">
                <button id="form-submit" onclick="_menu('Perfil', '<?php echo '&' . $parametrosUsuario ?>')" type="button" class="btn btn-primary btn-round btn-animate btn-animate-side" style="font-size: 12px">
                    <span>
                        <i class="icon wb-reply" aria-hidden="true"></i>
                        Regresar
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
<script>

    (function (document, window, $) {

        'use strict';

        var Site = window.Site;

        $(document).ready(function ($) {
            Site.run();
        });

        // Example Cropper Simple
        // ----------------------
        (function () {
            $("#simpleCropper img").cropper({
                preview: "#simpleCropperPreview >.img-preview",
                responsive: true
            });
        })();


        // Example Cropper Full
        // --------------------
        (function () {
            var $exampleFullCropper = $("#exampleFullCropper img"),
                    $inputDataX = $("#inputDataX"),
                    $inputDataY = $("#inputDataY"),
                    $inputDataHeight = $("#inputDataHeight"),
                    $inputDataWidth = $("#inputDataWidth");

            var options = {
                aspectRatio: NaN,
                preview: "#exampleFullCropperPreview > .img-preview",
                responsive: true,
                crop: function () {
                    var data = $(this).data('cropper').getCropBoxData();
                    $inputDataX.val(Math.round(data.left));
                    $inputDataY.val(Math.round(data.top));
                    $inputDataHeight.val(Math.round(data.height));
                    $inputDataWidth.val(Math.round(data.width));
                }
            };
            // set up cropper
            $exampleFullCropper.cropper(options);

            // set up method buttons
            $(document).on("click", "[data-cropper-method]", function () {
                var data = $(this).data(),
                        method = $(this).data('cropper-method'),
                        result;
                if (method) {
                    result = $exampleFullCropper.cropper(method, data.option);
                }

                if (method === 'getCroppedCanvas') {
                    $('#getDataURLModal').modal().find('.modal-body').html(result);
                }

            });

            // deal wtih uploading
            var $inputImage = $("#inputImage");

            if (window.FileReader) {
                $inputImage.change(function () {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $exampleFullCropper.cropper("reset", true).cropper("replace", this.result);
                            $inputImage.val("");
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            // set data
            $("#setCropperData").click(function () {
                var data = {
                    left: parseInt($inputDataX.val()),
                    top: parseInt($inputDataY.val()),
                    width: parseInt($inputDataWidth.val()),
                    height: parseInt($inputDataHeight.val())
                };
                $exampleFullCropper.cropper("setCropBoxData", data);
            });
        })();
    })(document, window, jQuery);


    function subirImagenCortada(empresa) {
        var canvas = document.getElementsByTagName('canvas');
        var image = canvas[0].toDataURL();
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "../Config/includes/UploadImagenCropper.php",
            data: {
                data: image,
                empresa: empresa
            },
            beforeSend: function () {
                $('#SubirLogo').attr('disabled', true);
            },
            success: function (resultado) {
                $('#SubirLogo').removeAttr('disabled');
                if (resultado.data === 'Exito') {
                    alertify.success(resultado.mensaje);
                    $('#getDataURLModal').modal('hide');
                    $(".navbar-brand-logo").attr('src','');
                    setTimeout(function(){
                        $(".navbar-brand-logo").attr('src','../STL-Vision/imagen/empresas/<?php echo $_SESSION['logo_admin'] . '?'?>' + new Date().getTime());
                    },500);
                    _menu('Perfil', '<?php echo '&' . $parametrosUsuario ?>')
                } else {
                    alertify.error(resultado.mensaje);
                }
            }
        });
    }
</script>
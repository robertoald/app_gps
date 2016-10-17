<?php
session_start();

include_once '../../Config/includes/modelos/UsuariosEmpresas.php';
include_once '../../Config/conexiones_config.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

$Usuario = new UsuarioAdmin();
$Usuario->_Usuario($_GET['id']);
$parametros = 'id=' . $Usuario->idUsuario;
$parametros .= '&nombre=' . $Usuario->Nombre;
$parametros .= '&usuario=' . $Usuario->Usuario;
$parametros = _desordenar($parametros);

if (isset($_GET['x'])) {
    $ClassUser = '';
    $ClassEmpresa = 'active';
} else {
    $ClassUser = 'active';
    $ClassEmpresa = '';
}
?>
<div class="modal fade docs-cropped" id="getDataURLModal" aria-hidden="true" aria-labelledby="getDataURLTitle"
     role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="getDataURLTitle">Vista Previa</h4>
            </div>
            <div class="modal-body" style="text-align: center"></div>
            <div class="modal-footer">
                <button type="button" id="SubirLogo" onclick="subirImagenCortada('<?php echo $Usuario->idEmpresa ?>')" class="btn btn-animate btn-animate-vertical btn-primary">
                    <span>
                        <i class="icon wb-upload" aria-hidden="true"></i>
                        Actualizar Logo
                    </span>
                </button>
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
                <span class="TituloM">Perfiles</span><span class="SubTituloM">Módulo Administrativo</span>
            </div>
        </div>
        <div class="col-md-12"  style="margin-top: -20px">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body nav-tabs-animate">
                    <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                        <li class="<?php echo $ClassUser ?>" role="listado">
                            <a data-toggle="tab" href="#usuario" aria-controls="activities" role="tab">
                                Usuario
                            </a>
                        </li>
                        <?php if ($Usuario->Tipo === '2') { ?>
                            <li class="<?php echo $ClassEmpresa ?>" role="presentation">
                                <a data-toggle="tab" href="#empresa" aria-controls="profile" role="tab">
                                    Empresa
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane <?php echo $ClassUser ?> animation-slide-left panel" id="usuario" role="tabpanel">
                            <div class="row">
                                <div class="panel">
                                    <div class="panel-body container-fluid">
                                        <form id="Editar-UsuarioPerfil" autocomplete="off" action="javascript: _Modificar('UsuarioPerfil')">
                                            <div class="col-sm-9">
                                                <div class="col-sm-12">
                                                    <h4 style="color: #62a8ea">Información del Usuario</h4>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="UserUsuario" id="user" readonly class="form-control" value="<?php echo $Usuario->Usuario ?>" required/>
                                                        <label class="floating-label">Usuario</label>
                                                    </div>                  
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group form-material floating">
                                                        <input type="text" name="NombreUsuario" id="nombre" class="form-control" value="<?php echo $Usuario->Nombre ?>" required/>
                                                        <label class="floating-label">Nombre</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" style="text-align: right">
                                                <button id="form-submit" type="submit" class="btn btn-primary btn-round btn-block btn-animate btn-animate-side" style="font-size: 12px">
                                                    <span>
                                                        <i class="icon wb-edit" aria-hidden="true"></i>
                                                        Actualizar
                                                    </span>
                                                </button>
                                                <button id="form-submit" onclick="_Modal('Usuarios', 'Cambiar Contraseña', '<?php echo '&' . $parametros ?>', false, 'form_userPass')" type="button" class="btn btn-primary btn-round btn-block btn-animate btn-animate-side" style="font-size: 12px">
                                                    <span>
                                                        <i class="icon wb-lock" aria-hidden="true"></i>
                                                        Cambiar Contraseña
                                                    </span>
                                                </button>
                                            </div>
                                            <input name="acc" value="modificar-Usuarios" style="display: none"/>
                                            <input name="Usuario" value="<?php echo $Usuario->idUsuario ?>" style="display: none"/>
                                            <input type="text" name="EmpresaUsuario" id="empresaInput" value="<?php echo $Usuario->idEmpresa ?>" style="display: none"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($Usuario->Tipo === '2') {
                            include_once $_SERVER['DOCUMENT_ROOT'] . '/Config/includes/modelos/Empresas.php';
                            include_once $_SERVER['DOCUMENT_ROOT'] . '/Config/includes/modelos/Paises.php';
                            $Paises = new Paises();
                            $Paises->_listar();
                            $Empresa = new Empresas();
                            $Empresa->_Empresa($Usuario->idEmpresa);
                            $parametrosEmpresa = 'empresa=' . $Empresa->idEmpresa;
                            $parametrosEmpresa .= '&usuario=' . $Usuario->idUsuario;
                            $parametrosEmpresa = _desordenar($parametrosEmpresa);
                            ?>
                            <div class="tab-pane <?php echo $ClassEmpresa ?> animation-slide-left" id="empresa" role="tabpanel">
                                <div class="row">
                                    <div class="panel">
                                        <div class="panel-body container-fluid">
                                            <form id="Editar-Empresa" autocomplete="off" action="javascript: _Modificar('Empresa')">
                                                <div class="col-sm-9">
                                                    <div class="col-sm-12">
                                                        <h4 style="color: #62a8ea">Información de la Empresa</h4>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-material floating">
                                                            <input type="text" name="NombreEmpresa" id="nombre" class="form-control" value="<?php echo $Empresa->Nombre ?>" required/>
                                                            <label class="floating-label">Nombre</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-material floating">
                                                            <input type="email" name="CorreoEmpresa" id="correo" class="form-control" value="<?php echo $Empresa->Correo ?>" required/>
                                                            <label class="floating-label">Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-material floating">
                                                            <input type="text" name="ContactoEmpresa" id="contacto" class="form-control" value="<?php echo $Empresa->Contacto ?>" required/>
                                                            <label class="floating-label">Contacto</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-material floating">
                                                            <input type="text" name="DireccionEmpresa" id="direccion" class="form-control" value="<?php echo $Empresa->Direccion ?>" required/>
                                                            <label class="floating-label">Dirección</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-material floating">
                                                            <input type="text" name="TelefonoEmpresa" id="telefono" class="form-control" value="<?php echo $Empresa->Telefono ?>" required/>
                                                            <label class="floating-label">Teléfono</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-material floating">
                                                            <select id="pais" name="PaisEmpresa" class="form-control" required>
                                                                <?php
                                                                foreach ($Paises->listado AS $listado) {
                                                                    ?>  
                                                                    <option value="<?php echo $listado['idPais'] ?>" <?php echo $listado['idPais'] === $Empresa->Pais ? 'selected' : '' ?>><?php echo $listado['Pais'] ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <label class="floating-label">Pais</label>
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
                                                    <button id="form-submit" onclick="_menu('Logos', '<?php echo '&' . $parametrosEmpresa ?>')" type="button" class="btn btn-primary btn-round btn-block btn-animate btn-animate-side" style="font-size: 12px">
                                                        <span>
                                                            <i class="icon wb-image" aria-hidden="true"></i>
                                                            Modificar Logo
                                                        </span>
                                                    </button>
                                                    <div style="background-color: white;max-width: 250px;max-height: 85px; margin: 15px auto; border: 0px solid #62a8ea; text-align: center; vertical-align: middle">
                                                        <img style="width: 100%;height: 100%;margin-top: -1px" src="../STL-Vision/imagen/empresas/<?php echo $Empresa->Logo . '?' . Date('YmdHis') ?>"  alt="...">
                                                    </div>
                                                </div>
                                                <input name="Empresa" value="<?php echo $Empresa->idEmpresa ?>" readonly style="display: none"/>
                                                <input name="acc" value="modificar-Empresas" style="display: none"/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    (function () {
        $("#simpleCropper img").cropper({
            preview: "#simpleCropperPreview >.img-preview",
            responsive: true
        });
    })();

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
                } else {
                    alertify.error(resultado.mensaje);
                }
            }
        });
    }
</script>
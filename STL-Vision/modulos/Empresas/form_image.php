<?php
session_start();
require_once '../../../Config/conexiones_config.php';
decode_get2($_SERVER["REQUEST_URI"], 1);

if (isset($_GET['logo']) && $_GET['logo'] != '') {
    $Logo = $_GET['logo'];
}
if (isset($_GET['empresa']) && $_GET['empresa'] != '') {
    $Empresa = $_GET['empresa'];
}
if (isset($_GET['nombre']) && $_GET['nombre'] != '') {
    $Nombre = $_GET['nombre'];
}
?>

<div class="main">
    <form id="uploadimage-Empresas" action="SubmitFormImagen('Empresas')" method="post" enctype="multipart/form-data">
        <div id="selectImage">
            <label ><b style="color: #62a8ea">Empresa: </b><i><?php echo $Nombre ?></i></label>
            <div style="float: right">
                <button type="submit" class="btn btn-animate btn-animate-vertical btn-primary">
                    <span>
                        <i class="icon wb-upload" aria-hidden="true"></i>
                        Guardar Cambios
                    </span>
                </button>
            </div>
            <div class="form-group form-material floating form-material-file">
                <input type="text" class="form-control empty" readonly="" />
                <input type="file" id="file" name="file" multiple="" required/>
                <label class="floating-label">Seleccionar Logo</label>
            </div>
            <input type="text" name="nombre" readonly value="<?php echo $Nombre ?>" style="display: none"/>
            <input type="text" name="empresa" readonly value="<?php echo $Empresa ?>" style="display: none"/>
        </div>
        <div style="text-align: center; height: 10px">

        </div>
        <div id="image_preview" style="text-align: center">
            <img id="previewing" src="../STL-Vision/imagen/empresas/<?php echo $Logo.'?'.Date('YmdHis') ?>" onerror="src='imagen/No-Imagen.png'" style="width: 250px; height: 100px"/>
        </div>
    </form>
</div>
<script>
    $(document).ready(function (e) {
        $("#uploadimage-Empresas").on('submit', (function (e) {
            e.preventDefault();
            var $modulos = $('#Seccion-Modulos').data('panel-api');
            $.ajax({
                url: "../../../Config/includes/UploadImagen.php", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                dataType: 'JSON',
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                beforeSend: function () {
                    $modulos.load();
                },
                success: function (data)   // A function to be called if request succeeds
                {
                    $modulos.done();
                    if (data.data == 'Exito') {
                        alertify.success(data.mensaje);
                        $('#myModal').modal('hide');
                    } else {
                        alertify.error(data.mensaje);
                    }
                }
            });
        }));

// Function to preview image after validation
        $(function () {
            $("#file").change(function () {
                $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
                {
                    $('#previewing').attr('src', 'imagen/No-Imagen.png');
                    alertify.error("Solo imagenes con extensión .jpeg, .jpg o .png están permitidas!");
                    //$("#message").html("<span id='error_message'> * Solo imagenes con extensión .jpeg, .jpg o .png están permitidas!</span>");
                    return false;
                } else
                {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
        function imageIsLoaded(e) {
            $('#image_preview').css("display", "block");
            $('#previewing').attr('src', e.target.result);
        }
        ;
    });
</script>
function Void() {
}

function _RefreshDatatable() {
    $('.Listado-Modelos').bootstrapTable('refresh');
}

function DatosFormulario(form) {
    var formData = $(form).serializeArray().reduce(function (a, x) {
        a[x.name] = x.value;
        return a;
    }, {});
    return formData;
}

function SubmitForm(modelo) {
    var bandera = true;
    $(".requerido").each(function () {
        var id = $(this).attr('name');
        if ($(this).val() == '') {
            $('#' + id).css({'display': ''});
            bandera = false;
        } else {
            $('#' + id).css({'display': 'none'});
        }
    });
    if (bandera) {
        $("#form-" + modelo).submit();
    }
}

function SubmitFormImagen(modelo) {
    var bandera = true;
    $(".requerido").each(function () {
        var id = $(this).attr('name');
        if ($(this).val() == '') {
            $('#' + id).css({'display': ''});
            bandera = false;
        } else {
            $('#' + id).css({'display': 'none'});
        }
    });
    if (bandera) {
        $("#uploadimage-" + modelo).submit();
    }
}

function _menu(menu, parametros,rt) {
	if(rt==0)
	{
		$('#Mapa-STL2').hide();$('#Seccion-Modulos').show()
	}	
	else
	{
	$('#Mapa-STL2').show();$('#Seccion-Modulos').hide()
	}
	var extra = '';
    if (parametros) {
        extra = parametros;
    }
    var data = JSON.stringify({'acc': 'menu', 'menu': menu});
    var $modulos = $('#Seccion-Modulos').data('panel-api');
    $.ajax({
        url: '../Config/includes/menu.php?flag=1' + extra,
        dataType: 'TEXT',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        data: data,
        timeout: 30000,
        error: function () {
            $modulos.done();
            alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
        },
        beforeSend: function () {
            $modulos.load();
        },
        success: function (respuesta) {
            if (respuesta != 'error') {
                setTimeout(function () {
                    $('#Seccion-Modulos').html(respuesta);
                    $modulos.done();
                }, 2000);
            }
        }
    });
}

function LogIn_STL(accion) {
    var user = $('#login-username').val();
    var pass = $('#login-password').val();
	if(user.indexOf("@")>=0)
       accion='LogIn-Customers';
    var data = JSON.stringify({'acc': accion, 'user': user, 'pass': pass});

    $.ajax({
        url: '../Config/includes/Puente.php',
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        data: data,
        timeout: 30000,
        error: function () {
            $modulos.done();
            alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
        },
        beforeSend: function () {
            $('#btn-login').attr('disabled', true);
        },
        success: function (data) {
            if (data.data != 'error') {
                //alertify.success(data.data);
                window.location = "../Config/includes/LogIn.php?flag=1&" + data.data;
            } else {
                $('#btn-login').removeAttr('disabled');
                $('#login-username').val('');
                $('#login-password').val('');
                alertify.error(data.mensaje);
            }
        }
    });
}

function _LimpiarFormulario(formulario) {
    formulario.find('input:not([name="acc"],.Static)').each(function () {
        formulario.data('formValidation').resetField($(this).attr('name'), true);
        formulario.data('formValidation').updateStatus($(this).attr('name'), 'VALIDATING');
        formulario.formValidation('validateField', $(this).attr('name'));
        $(this).addClass('empty');
    });
    formulario.find('select:not(.Static)').each(function () {
        formulario.data('formValidation').resetField($(this).attr('name'), true);
        formulario.data('formValidation').updateStatus($(this).attr('name'), 'VALIDATING');
        formulario.formValidation('validateField', $(this).attr('name'));
        $(this).addClass('empty');
    });
    formulario.find(".has-error").each(function () {
        $(this).removeClass('has-error');
        $(this).find('small').css({'display': 'none'});
    });
}

function _Nuevo(modelo) {
    var form = $('#Nuevo-' + modelo);
    var Datos = DatosFormulario(form);
    var $modulos = $('#Seccion-Modulos').data('panel-api');
    $.ajax({
        url: '../Config/includes/Puente.php',
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        timeout: 30000,
        error: function () {
            $modulos.done();
            alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
        },
        data: JSON.stringify(Datos),
        beforeSend: function () {
            $modulos.load();
        },
        success: function (respuesta) {
            _LimpiarFormulario(form);
            $modulos.done();
            if (respuesta.data === 'Clientes') {
                _menu('Supervisor_Clientes', respuesta.clientes);
            }
            alertify.success(respuesta.mensaje);
            _RefreshDatatable();
        }
    });
}
function _Modificar(modelo) {
    var form = $('#Editar-' + modelo);
    var Datos = DatosFormulario(form);
    var $modulos = $('#Seccion-Modulos').data('panel-api');
    $.ajax({
        url: '../Config/includes/Puente.php',
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        timeout: 30000,
        error: function () {
            $modulos.done();
            alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
        },
        data: JSON.stringify(Datos),
        beforeSend: function () {
            $('#myModal').modal('hide');
            $modulos.load();
        },
        success: function (respuesta) {
            $modulos.done();
            alertify.success(respuesta.mensaje);
            if (respuesta.data === 'Objetos') {
                _menu('Supervisor_Objetos', respuesta.objetos);
            }
            _RefreshDatatable();
        }
    });
}

function EliminarCampo(extra, modelo) {
    alertify.confirm('Desea eliminar este '+modelo+'?', function () {
        CambiarStatus(extra);
    }, function () {

    });
}

function CambiarStatus(extra) {

    var $modulos = $('#Seccion-Modulos').data('panel-api');
    $.ajax({
        url: '../Config/includes/Listados.php?flag=1' + extra,
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'GET',
        timeout: 30000,
        error: function () {
            $modulos.done();
            alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
        },
        beforeSend: function () {
            $modulos.load();
        },
        success: function (respuesta) {
            $modulos.done();
            alertify.success(respuesta.mensaje);
            _RefreshDatatable();
        }
    });
}
function CambiarUsuario(parametros) {
    if (confirm('Desea entrar a la cuenta de Usuario?')) {
        $.ajax({
            url: '../Config/includes/Listados.php?flag=1' + parametros,
            dataType: 'JSON',
            contentType: 'application/json; charset=utf-8',
            method: 'GET',
            timeout: 30000,
            error: function () {
                alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
            },
            success: function (respuesta) {
                window.location = "../STL-Vision/CuentaEmpresa.php?flag=1&" + respuesta.data;
            }
        });
    }
}
function ValidarIMEI(campo, form) {
    var IMEI = $(campo).val();
    if (IMEI !== '') {
        $.ajax({
            url: '../Config/includes/Validador.php',
            dataType: 'JSON',
            contentType: 'application/json; charset=utf-8',
            method: 'GET',
            timeout: 30000,
            error: function () {
                alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
            },
            data: {
                codigo: IMEI,
                acc: 'ValidarIMEI'
            },
            beforeSend: function () {
                form.data('formValidation').updateStatus($(campo), 'INVALID');
            },
            success: function (respuesta) {
                if (respuesta > 0) {
                    $(campo).val('');
                    form.data('formValidation').updateMessage($(campo), 'notEmpty', 'El <b>Codigo GPS</b> ya esta registrado');
                    form.formValidation('validateField', $(campo));
                    form.data('formValidation').updateStatus($(campo), 'INVALID');
                } else {
                    form.data('formValidation').updateStatus($(campo), 'VALID');
                }
            }
        });
    }
}
function ValidarUsuario(campo, form) {
    var usuario = $(campo).val();
    if (usuario !== '') {
        $.ajax({
            url: '../Config/includes/Validador.php',
            dataType: 'JSON',
            contentType: 'application/json; charset=utf-8',
            method: 'GET',
            timeout: 30000,
            error: function () {
                alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
            },
            data: {
                usuario: usuario,
                acc: 'ValidarUsuario'
            },
            beforeSend: function () {
                form.data('formValidation').updateStatus($(campo), 'VALIDATING');
            },
            success: function (respuesta) {
                if (respuesta > 0) {
                    $(campo).val('');
                    form.data('formValidation').updateMessage($(campo), 'blank', '<b>Usuario</b> invalido, ya está registrado')
                    form.formValidation('validateField', $(campo));
                    form.data('formValidation').updateStatus($(campo), 'INVALID', 'blank');
                } else {
                    form.data('formValidation').updateStatus($(campo), 'VALID');
                }
            }
        });
    }
}
function ValidarSession(campo) {
    var usuario = $(campo).val();
    if (usuario !== '') {
        $.ajax({
            url: '../Config/includes/ValidarSession.php',
            dataType: 'JSON',
            contentType: 'application/json; charset=utf-8',
            method: 'GET',
            timeout: 30000,
           
            data: {
                usuario: usuario,
                acc: 'ValidarSession'
            },
            success: function (respuesta) {
               
            }
        });
    }
}
function ValidarCorreo(campo, form) {
    var correo = $(campo).val();
    if (correo !== '') {
        $.ajax({
            url: '../Config/includes/Validador.php',
            dataType: 'JSON',
            contentType: 'application/json; charset=utf-8',
            method: 'GET',
            timeout: 30000,
            error: function () {
                alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
            },
            data: {
                correo: correo,
                acc: 'ValidarCorreo'
            },
            success: function (respuesta) {
                if (respuesta > 0) {
                    //$(campo).addClass('empty');
                    $(campo).val('');
                    //form.data('formValidation').resetField($(campo));
                    form.data('formValidation').updateMessage($(campo), 'blank', '<b>Correo</b> invalido, ya está registrado')
                    form.data('formValidation').updateStatus($(campo), 'INVALID', 'blank');
                }
            }
        });
    }
}
function _Modal(modelo, title, extra, obj, file_custom) {
    var modal;
    var file;
    if (obj) {
        modal = $('#myModalWizard');
        file = 'form_wizard';
    } else {
        modal = $('#myModal');
        file = 'form_';
    }
    if (file_custom) {
        file = file_custom;
    }
    var $modulos = $('#Seccion-Modulos').data('panel-api');
    $.ajax({
        url: 'modulos/' + modelo + '/' + file + '.php?flag=1' + extra,
        dataType: 'TEXT',
        contentType: 'application/json; charset=utf-8',
        method: 'GET',
        timeout: 30000,
        error: function () {
            $modulos.done();
            alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
        },
        beforeSend: function () {
            $modulos.load();
        },
        success: function (respuesta) {
            setTimeout(function () {
                $modulos.done();
                modal.modal('show');
                modal.find('.modal-body').html(respuesta);
                modal.find('.modal-title').html(title);
            }, 1000);
        }
    });
}
function _Imagenes(modelo, title, extra) {
    var $modulos = $('#Seccion-Modulos').data('panel-api');
    $.ajax({
        url: 'modulos/' + modelo + '/form_image.php?flag=1' + extra,
        dataType: 'TEXT',
        contentType: 'application/json; charset=utf-8',
        method: 'GET',
        timeout: 30000,
        error: function () {
            $modulos.done();
            alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
        },
        beforeSend: function () {
            $modulos.load();
        },
        success: function (respuesta) {
            setTimeout(function () {
                $modulos.done();
                $('#myModal').modal('show');
                $('#modal_body').html(respuesta);
                $('#modal_title').html(title);
                //$('#modal_action').html('<button class="btn BotonSTL" onclick="SubmitFormImagen(\'' + modelo + '\')" type="submit">Guardar Imagen</button>');
                //$('#modal_action').html('<button type="button" onclick="SubmitFormImagen(\'' + modelo + '\')" class="btn btn-animate btn-animate-vertical btn-primary"><span><i class="icon wb-upload" aria-hidden="true"></i>Guardar Cambios</span></button>');
            }, 1000);
        }
    }
    );
}

function MostrarIcono() {
    if ($('#IconoObjeto :selected').data('val2') !== '') {
        $('#Icono-Preview').attr('src', "../../../Config/includes/imagenes/iconos/" + $('#IconoObjeto :selected').data('val2'));
        $('#Icono-Preview').css({display: ''});
    } else {
        $('#Icono-Preview').css({display: 'none'});
    }
}

function Reevaluar(elemento, Opciones, formulario) {
    elemento.html(Opciones);
    elemento.addClass('empty');
    formulario.data('formValidation').resetField(elemento, true);
    formulario.data('formValidation').updateStatus(elemento, 'VALIDATING');
    formulario.formValidation('validateField', elemento);
}
function RecargarPanel(extra) {
	$("#b-sidebar").attr("data-url", "#")
	var	url='site-sidebar_1.php?'+new Date().getTime();
    $.ajax({

        url: url  +extra,
        dataType: 'TEXT',
        timeout: 5000,
        contentType: 'application/json; charset=utf-8',
        method: 'GET',
        success: function (respuesta) 
		{
			var listado=jQuery.parseJSON(respuesta);
			for(var x=0;x<listado.length;x++)
			{
				if ( $("#user-id-"+listado[x]['Id']).length >0) 
				{
				  $('#status-avatar-'+listado[x]['Id']).attr('class', '');
					$('#status-avatar-'+listado[x]['Id']).attr('class', 'avatar avatar-sm '+listado[x]['Avatar']);
				}
				else
				{
					var html='<div class="list-group" id="user-id-'+listado[x]['Id']+'">'; 
						html=html+'<a class="list-group-item" href="javascript:void(0)" data-toggle="show-chat">'
						html=html+'	<div class="media">'
						html=html+'	 <div class="media-left">'
						html=html+'   <div class="avatar avatar-sm '+listado[x]['Avatar']+'" id="status-avatar-'+listado[x]['Id']+'">'
						html=html+'    <img id="user-img-'+listado[x]['Id']+'" src="portraits/2.jpg" alt="..." />'
						html=html+'    <i></i>'
						html=html+'   </div>'
						html=html+'  </div>'
						html=html+'  <div class="media-body">'
						html=html+'   <h4 class="media-heading" id="user-name-'+listado[x]['Id']+'">'+listado[x]['Nombre']+'</h4>'
						html=html+'   <small id="user-date-'+listado[x]['Id']+'>">'+listado[x]['Fecha']+'</small>'
						html=html+'  </div>'
						html=html+' </div>'
						html=html+'</a>'
						html=html+'</div>'
					$("#sidebar_list").append(html);
				}	
			}	
		},		
	});
}
function Listados(valor, Tipo, formulario) {
    var bandera = true;
    var TipoObjeto = formulario.find("#TipoObjeto").val();
    if (Tipo === 2 && TipoObjeto === '3') {
        if (valor < 3) {
            formulario.find('#Marca').css({display: 'inherit'});
            formulario.find('#Marca select').removeAttr('disabled');
            formulario.find('#Modelo').css({display: 'inherit'});
            formulario.find('#Modelo select').removeAttr('disabled');
        } else {
            formulario.find('#Marca').css({display: 'none'});
            formulario.find('#Marca select').attr('disabled', true);
            formulario.find('#Modelo').css({display: 'none'});
            formulario.find('#Modelo select').attr('disabled', true);
            bandera = false;
        }
    }
    if ((TipoObjeto === '2' || TipoObjeto === '3') && bandera === true) {
        $.ajax({
            url: '../Config/includes/Listados.php',
            dataType: 'JSON',
            contentType: 'application/json; charset=utf-8',
            method: 'GET',
            timeout: 30000,
            error: function () {
                alertify.error('Error al conectarse con el servidor, por favor intentelo mas tarde.');
            },
            data: {
                acc: "Listados",
                TipoListado: Tipo,
                TipoObjeto: TipoObjeto,
                Valor: valor
            },
            beforeSend: function () {

            },
            success: function (data) {
                var aux = 0;
                var Opciones = '<option value="" selected> </option>';
                var Opciones2 = '<option value="" selected> </option>';
                while (aux < data.length) {
                    Opciones += '<option value="' + data[aux].id + '"> ' + data[aux].Descripcion + ' </option>';
                    aux++;
                }
                if (Tipo === 1) {
                    Reevaluar(formulario.find("#TipoCaracteristico"), Opciones, formulario);
                }
                if (Tipo === 2) {
                    Reevaluar(formulario.find("#MarcaObjeto"), Opciones, formulario);
                    Reevaluar(formulario.find("#ModeloObjeto"), Opciones2, formulario);
                }
                if (Tipo === 3) {
                    Reevaluar(formulario.find("#ModeloObjeto"), Opciones, formulario);
                }
            }
        });
    }
}
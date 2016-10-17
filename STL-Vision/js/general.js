
$("#OcultarMenu").click(function (e) {
    e.preventDefault();
    $("#wrapper").removeClass("toggled");
});

$(".notif_action").click(function (e) {
    e.preventDefault();
    $('.Notificaciones').toggleClass("Notif_Abierto");
});

$(".data-t").click(function (e) {
    $(".data-t").removeClass("Activa");
    $(this).toggleClass("Activa");
    e.preventDefault();
    if (!$("#wrapper").hasClass("toggled")) {
        $("#wrapper").toggleClass("toggled");
        $("#menu-toggle i").toggleClass("fa fa-forward fa fa-backward");
    }
});

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

function _CargarNotificaciones(parametros,x) {
    $.ajax({
        url: "../Config/includes/Listados.php?flag=1&" + parametros,
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        success: function (data) {
            var lista = '';
            var aux = 0;
            while (aux < data.data.length) {
                lista += "<tr style=\"cursor: pointer\" onclick=\"javascript: _Modal('Notificaciones','Modificar Notificación', 'envelope' ,'" + data.data[aux].Parametros + "' )\">\n\
                            <td style='width: 40%;text-align: center; vertical-align: middle'> " + data.data[aux].Nombre + "</td>\n\
                            <td style='width: 10%;text-align: center; vertical-align: middle'>" + data.data[aux].Tipo_icon + "</td>\n\
                            <td style='width: 50%;text-align: center; vertical-align: middle'>" + data.data[aux].Destino + "</td>\n\
                          </tr>";
                aux++;
            }
            if (lista == '') {
                $('#NotificacionesLista').html('<tr><td colspan="3"><label>** No existen notificaciones registradas! **</label></td></tr>');
            } else {
                $('#NotificacionesLista').html(lista);
            }
            $('.NotificacionesLoading').hide();
        }
    });
}
function _CargarNotificacionesAdmin(parametros,x) {
    $.ajax({
        url: "../Config/includes/Listados.php?flag=1&" + parametros,
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        success: function (data) {
            var lista = '';
            var aux = 0;
            while (aux < data.data.length) {
                lista += "<tr style=\"cursor: pointer\" onclick=\"javascript: _Modal('Notificaciones','Modificar Notificación', 'envelope' ,'" + data.data[aux].Parametros + "' )\">\n\
                            <td style='width: 40%;text-align: center; vertical-align: middle'> " + data.data[aux].Nombre + "</td>\n\
                            <td style='width: 10%;text-align: center; vertical-align: middle'>" + data.data[aux].Tipo_icon + "</td>\n\
                            <td style='width: 50%;text-align: center; vertical-align: middle'>" + data.data[aux].Destino + "</td>\n\
                          </tr>";
                aux++;
            }
            if (lista == '') {
                $('#NotificacionesLista').html('<tr><td colspan="3"><label>** No existen notificaciones registradas! **</label></td></tr>');
            } else {
                $('#NotificacionesLista').html(lista);
            }
            $('.NotificacionesLoading').hide();
        }
    });
}
function _CargarVehiculosAdmin(parametros,x) {
	var parametos_new = parametros.replace("&acc=Clientes", "&acc=Vehiculos");
    $.ajax({
        url: "../Config/includes/Listados_admin.php?flag=1&" + parametros,
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        success: function (mdata){
            var lista = '';
			for(aux = 0;aux < mdata.data.length;aux++) 
			{ 
				////////////////////////////////////////////////////////////////
				$.ajax({
						url: "../Config/includes/Listados_admin.php?flag=1&" + parametros+'&clientesS='+mdata.data[aux].idCliente,
						dataType: 'JSON',
						contentType: 'application/json; charset=utf-8',
						method: 'POST',
						success: function (data){
							var lista = '';
						for(aux = 0;aux < data.data.length;aux++) 
							 {
								var avatar;
								var Fvieja = new Date(data.data[aux].FechaGPS);
								var Fnueva = new Date();
								var segundos = ((Fnueva-Fvieja)/1000);
								if(segundos.toFixed(2)<=600)
									avatar='avatar-online';
								if((segundos.toFixed(2)>600)&&(segundos.toFixed(2)<=14400))
									avatar='avatar-busy';
								if(segundos.toFixed(2)>14400)
									avatar='avatar-away';
								if (  $("#objeto-id-"+data.data[aux].idVehiculo).length >0) 
								{
								  $('#obj-status-avatar-'+data.data[aux].idVehiculo).attr('class', '');
									$('#obj-status-avatar-'+data.data[aux].idVehiculo).attr('class', 'avatar avatar-sm '+avatar);
								}
								else
								{
									var img='../Config/includes/imagenes/'
									if(data.data[aux].Foto=='')
										img=img+'iconos/'+data.data[aux].Icono+'';
									else
										img=img+'/fotos/'+data.data[aux].Foto;
									lista = '<a class="list-group-item" href="javascript:void(0)" data-toggle="show-chat" id="objeto-id-'+data.data[aux].idVehiculo+'">\n\
												<div class="media">\n\
												  <div class="media-left">\n\
													<div class="avatar avatar-sm '+avatar+'" id="obj-status-avatar-'+data.data[aux].idVehiculo+'">\n\
													  <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="..." />\n\
													  <i></i>\n\
													</div>\n\
												  </div>\n\
												  <div class="media-body">\n\
													<h4 class="media-heading" id="obj-name-'+data.data[aux].idVehiculo+'">' + data.data[aux].Nombre + '</h4>\n\
												  <input class="Marcador" id="vehiculo_' + aux + '" value="' + aux + '" onchange="javascript: SeleccionarMarker();" type="checkbox">\n\
													<small style="font-size:14px; color:##4397e6">\n\
														<i class="icon fa-eye" aria-hidden="true" ></i>\n\
														<i class="icon fa-ticket" aria-hidden="true" title="Placa: '+ data.data[aux].Placa + '"></i>\n\
														<i class="icon fa-location-arrow" aria-hidden="true" ></i>\n\
														<i class="icon fa-calendar-o" aria-hidden="true" ></i>\n\
														</small>\n\
												  </div>\n\
												</div>\n\
											  </a>';
									placeMarkers(data);
									$("#ObjetosLista").append(lista);
									SeleccionarMarker();
								}
							}

						}
					});
	///////////////////////////////////////////////////////////////////////////////7
            }

        }
    });
}
function _CargarVehiculos(parametros,x) {
    $.ajax({
        url: "../Config/includes/Listados.php?flag=1&" + parametros,
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        success: function (data){
            var lista = '';
		for(aux = 0;aux < data.data.length;aux++) 
			 {
				var avatar;
				var Fvieja = new Date(data.data[aux].FechaGPS);
				var Fnueva = new Date();
				var segundos = ((Fnueva-Fvieja)/1000);
				if(segundos.toFixed(2)<=600)
					avatar='avatar-online';
				if((segundos.toFixed(2)>600)&&(segundos.toFixed(2)<=14400))
					avatar='avatar-busy';
				if(segundos.toFixed(2)>14400)
					avatar='avatar-away';
				if (  $("#objeto-id-"+data.data[aux].idVehiculo).length >0) 
				{
				  $('#obj-status-avatar-'+data.data[aux].idVehiculo).attr('class', '');
					$('#obj-status-avatar-'+data.data[aux].idVehiculo).attr('class', 'avatar avatar-sm '+avatar);
				}
				else
				{
					var img='../Config/includes/imagenes/'
					if(data.data[aux].Foto=='')
						img=img+'iconos/'+data.data[aux].Icono+'';
					else
						img=img+'/fotos/'+data.data[aux].Foto;
					lista = '<a class="list-group-item" href="javascript:void(0)" data-toggle="show-chat" id="objeto-id-'+data.data[aux].idVehiculo+'">\n\
								<div class="media">\n\
								  <div class="media-left">\n\
									<div class="avatar avatar-sm '+avatar+'" id="obj-status-avatar-'+data.data[aux].idVehiculo+'">\n\
									  <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="..." />\n\
									  <i></i>\n\
									</div>\n\
								  </div>\n\
								  <div class="media-body">\n\
									<h4 class="media-heading" id="obj-name-'+data.data[aux].idVehiculo+'">' + data.data[aux].Nombre + '</h4>\n\
								  <input class="Marcador" id="vehiculo_' + aux + '" value="' + aux + '" onchange="javascript: SeleccionarMarker();" type="checkbox">\n\
									<small style="font-size:14px; color:##4397e6">\n\
										<i class="icon fa-eye" aria-hidden="true" ></i>\n\
										<i class="icon fa-ticket" aria-hidden="true" title="Placa: '+ data.data[aux].Placa + '"></i>\n\
										<i class="icon fa-location-arrow" aria-hidden="true" ></i>\n\
										<i class="icon fa-calendar-o" aria-hidden="true" ></i>\n\
										</small>\n\
								  </div>\n\
								</div>\n\
							  </a>';
					placeMarkers(data);
					$("#ObjetosLista").append(lista);
					SeleccionarMarker();
				}
            }

        }
    });
}

function _CargarGeocercas(parametros,x) {
    $.ajax({
        url: "../Config/includes/Listados.php?flag=1&" + parametros,
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
 success: function (data) {
            var lista = '';
            var aux = 0;
            while (aux < data.data.length) {
                lista += '<li class="timeline-item" id="geo-' + aux + '" onclick="javascript: SeleccionarGeocerca(' + aux + ');">\n\
							<div class="timeline-dot bg-blue-600">\n\
							  <i class="icon fa-crosshairs" aria-hidden="true" onclick="javascript: SeleccionarGeocerca(' + aux + ');"></i>\n\
							</div>\n\
							<div class="timeline-content" onclick="javascript: SeleccionarGeocerca(' + aux + ');">\n\
							  <p>' + data.data[aux].Nombre + '</p>\n\
							</div>\n\
						  </li>'; 
                aux++;
            }
            if (lista == '') {
                $('#GeocercasLista').html('<tr><td colspan="3"><label>** No existen Geocercas registradas! **</label></td></tr>');
            } else {
                $('#GeocercasLista').html(lista);
                placeGeocercas(data);
            }  
        }
    });
}
function _CargarGeocercasAdmin(parametros,x)
 {
    $.ajax({
        url: "../Config/includes/Listados.php?flag=1&" + parametros,
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
		success: function (data) {
            var lista = '';
            var aux = 0;
            while (aux < data.data.length) {
                lista += '<li class="timeline-item" id="geo-' + aux + '" onclick="javascript: SeleccionarGeocerca(' + aux + ');">\n\
							<div class="timeline-dot bg-blue-600">\n\
							  <i class="icon fa-crosshairs" aria-hidden="true" onclick="javascript: SeleccionarGeocerca(' + aux + ');"></i>\n\
							</div>\n\
							<div class="timeline-content" onclick="javascript: SeleccionarGeocerca(' + aux + ');">\n\
							  <p>' + data.data[aux].Nombre + '</p>\n\
							</div>\n\
						  </li>'; 
                aux++;
            }
            if (lista == '') {
                $('#GeocercasLista').html('<tr><td colspan="3"><label>** No existen Geocercas registradas! **</label></td></tr>');
            } else {
                $('#GeocercasLista').html(lista);
                placeGeocercas(data);
            }  
        }
    });
}
function Agregar(modelo) {
    var Datos = DatosFormulario($('#form-' + modelo));

    $.ajax({
        url: '../Config/includes/Puente.php',
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'POST',
        data: JSON.stringify(Datos),
        beforeSend: function () {
            $('#modal_action .BotonSTL').attr('disabled', true);
        },
        success: function (respuesta) {
            alert(respuesta.mensaje);
            $('#modal_action .BotonSTL').removeAttr('disabled');
            if (respuesta.data === 'Agregar') {
                $(".form-input").each(function () {
                    $(this).val('');
                });
            }
            $('#myModal').modal('hide');
            if (modelo !== 'Vehiculos') {
                _Recargar(modelo);
            }
        }
    }
    );
}



function Recorridos(parametros, indice, lat, lng) {
    $('#DibujarR').attr('disabled', true);
    $('#PararR').attr('disabled', true);
    $('.ContentRecorrido').addClass('mostrar');
    $('#BuscarR').unbind('click');
    $('#BuscarR').on('click', function () {
        recorridoVehiculo(parametros, indice, lat, lng);
    });
}

function recorridoVehiculo(parametros, indice, lat, lng) {
    var hasta = $('.Hasta').val();
    var desde = $('.Desde').val();
    $.ajax({
        url: "../Config/includes/Listados.php?flag=1" + parametros,
        dataType: 'JSON',
        contentType: 'application/json; charset=utf-8',
        method: 'GET',
        beforeSend: function () {
            $('#RecorridosLista').html('');
            $('.RecorridosLoading').show();
        },
        data: {
            desde: desde,
            hasta: hasta
        },
        success: function (data) {
            var Coordenadas = [];
            var lista = '';
            var aux = 0;
            while (aux < data.data.length) {
                lista += '<tr style="cursor: pointer !important" class="" id="recorr-' + aux + '" >\n\
                            <td style="width: 5%;text-align: center; vertical-align: middle">' + (aux + 1) + '</td>\n\
                            <td style="width: 15%;text-align: center; vertical-align: middle">' + data.data[aux].Lat + '</td>\n\
                            <td style="width: 15%;text-align: center; vertical-align: middle">' + data.data[aux].Log + '</td>\n\
                            <td style="width: 10%;text-align: center; vertical-align: middle">' + data.data[aux].Alt + '</td>\n\
                            <td style="width: 25%;text-align: center; vertical-align: middle">' + data.data[aux].Grados + '</td>\n\
                            <td style="width: 15%;text-align: center; vertical-align: middle">' + data.data[aux].FechaGPS + '</td>\n\
                            <td style="width: 15%;text-align: center; vertical-align: middle">' + data.data[aux].FechaServer + '</td>\n\
                          </tr>';
                Coordenadas.push(new google.maps.LatLng(data.data[aux].Lat, data.data[aux].Log));
                aux++;
            }
            //Coordenadas.push(new google.maps.LatLng(lat, lng));
            $('#DibujarR').removeAttr('disabled');
            $('#DibujarR').unbind('click');
            $('#PararR').unbind('click');
            $('#DibujarR').on('click', function () {
                $('#DibujarR').attr('disabled', true);
                $('#PararR').removeAttr('disabled');
                PrepararRecorrido(Coordenadas, indice);
            });
            $('#PararR').on('click', function () {
                DetenerRecorrido();
            });

            if (lista == '') {
                $('#RecorridosLista').html('<tr><td colspan="7"><label>** Este vehículo no posee historial registrado **</label></td></tr>');
            } else {
                $('#RecorridosLista').html(lista);
            }
            $('.RecorridosLoading').hide();
        }
    });
}

function OcultarRecorrido() {
    $('.ContentRecorrido').removeClass('mostrar');
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var ampm = h >= 12 ? 'pm' : 'am';
    h = h % 12;
    h = h ? h : 12; // the hour '0' should be '12'
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
	$('#fyh').html(" " + h + ":" + m + '' + ampm +'</br> '+today.getDate() + "/" + (today.getMonth() +1) + "/" + today.getFullYear())
    var t = setTimeout(startTime, 800);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    }
    ;  // add zero in front of numbers < 10
    return i;
}
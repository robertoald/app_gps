var markersArray = [];
var infowindows = [];
var map;
var poligono = [];
var figuras = [];
var Recorrido = [];
var RecorridoMarkers = [];
var drawingManager;
var DobleClick = null;
var Stop = false;

function placeMarkers(vehiculos) {
    deleteOverlays(markersArray);
    var aux = 0;
    var location;
    var contentString;

    while (aux < vehiculos.data.length) {
        location = new google.maps.LatLng(vehiculos.data[aux].Lat, vehiculos.data[aux].Log);
        contentString = '<div class="ContentInfoW">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<h5 id="firstHeading" class="firstHeading"><b>Información del Vehículo</b></h5>' +
                '<div id="bodyContent">' +
                '<p><b>Nombre:   </b>' + vehiculos.data[aux].Nombre + '</p>' +
                '<p><b>Placa:   </b>' + vehiculos.data[aux].Placa + '</p>' +
                '<p><b>Lat:  </b>' + vehiculos.data[aux].Lat + '</p>' +
                '<p><b>Lng:  </b>' + vehiculos.data[aux].Log + '</p>' +
                '<p><b>Recorrido:  </b><a href="javascript: Recorridos(\'' + vehiculos.data[aux].Parametros + '\',' + aux + ',' + vehiculos.data[aux].Lat + ',' + vehiculos.data[aux].Log + ')">Click Aqui</a></p>' +
                '</div>' +
                '<div style="text-align: center"><img style="width: 15px; height: 15px; margin-left:1em" src="../Config/includes/imagenes/iconos/car_battery.png" />' +
                '<img style="width: 15px; height: 15px; margin-left:1em" src="../Config/includes/imagenes/iconos/engine_off.png" />' +
                '<img style="width: 15px; height: 15px; margin-left:1em" src="../Config/includes/imagenes/iconos/satellite_signal.png" />' +
                '<img style="width: 15px; height: 15px; margin-left:1em" src="../Config/includes/imagenes/iconos/nm_signal_75.png" />' +
                '</div>' +
                '</div>';

        var infowindow = new google.maps.InfoWindow();

        var icon = {
            url: "../Config/includes/imagenes/iconos/" + vehiculos.data[aux].Icono, // url
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(25, 25),
            scaledSize: new google.maps.Size(50, 50)
        };

        var marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: icon,
            animation: google.maps.Animation.DROP
        });

        infowindows.push(infowindow);
        google.maps.event.addListener(marker, 'click', (function (marker, contentString, infowindow, location, aux) {
            return function () {
                OcultarRecorrido();
                CerrarInfoWindows();
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
                //map.panTo(location);
            };
        })(marker, contentString, infowindow, location, aux));
        markersArray.push(marker);
        aux++;
    }
}
function placeGeocercas(geocercas) {
    deleteFiguras();
    var aux = 0;
    var aux2 = 0;
    var Coordenadas = [];
    var latlog;
    var radio;
    var tipo;
    var figura;

    while (aux < geocercas.data.length) {
        tipo = geocercas.data[aux].Tipo;
        if (tipo === '1') {
            Coordenadas = [];
            while (aux2 < geocercas.data[aux].coordenadas.length) {
                latlog = new google.maps.LatLng(geocercas.data[aux].coordenadas[aux2].lat, geocercas.data[aux].coordenadas[aux2].lng);
                Coordenadas.push(latlog);
                aux2++;
            }
            figura = new google.maps.Polygon({
                paths: Coordenadas,
                strokeWeight: 2.0,
                fillColor: 'green',
                fillOpacity: 0.35,
                editable: true
            });
        }
        if (tipo === '2') {
            latlog = new google.maps.LatLng(geocercas.data[aux].coordenadas[aux2].lat, geocercas.data[aux].coordenadas[aux2].lng);
            radio = parseFloat(geocercas.data[aux].Radio);

            figura = new google.maps.Circle({
                center: latlog,
                radius: radio,
                editable: true
            });
        }

        google.maps.event.addListener(figura, "dblclick", (function (figura, geocercas, aux) {
            return function (event) {
                event.stop();
                figura.setOptions({strokeWeight: 2.0, fillColor: 'green'});
                if (geocercas.data[aux].Tipo === '1') {
                    _Modal('Geocercas', 'Modificar Geocerca', 'map-o', geocercas.data[aux].Parametros + '&puntos=' + figura.getPath().getArray() + '&tipo=1');
                }
                if (geocercas.data[aux].Tipo === '2') {
                    _Modal('Geocercas', 'Modificar Geocerca', 'map-o', geocercas.data[aux].Parametros + '&puntos=' + figura.getCenter() + '&radio=' + figura.getRadius() + '&tipo=2');
                }

            };
        })(figura, geocercas, aux));
        poligono.push([figura, tipo]);
        aux2 = 0;
        aux++;
    }
}

function Geocercas(parametros, boton) {
    deleteOverlays(figuras);
    if (!($(boton).hasClass('active'))) {
        $(boton).addClass('active');
        $(boton).attr('disabled', true);
        drawingManager.setMap(map);
        google.maps.event.addListener(drawingManager, "overlaycomplete", function (event) {
            var newShape = event.overlay;
            newShape.type = event.type;
            newShape.setOptions({strokeWeight: 1.0, fillColor: 'grey'});
            figuras.push(newShape);
            overlayClickListener(newShape, parametros);
            drawingManager.setMap(null);
            google.maps.event.removeListener(drawingManager);
        });
    }
}

function overlayClickListener(overlay, parametros) {
    if (DobleClick) {
        google.maps.event.removeListener(DobleClick);
        DobleClick = null;
    }
    DobleClick = google.maps.event.addListener(overlay, "dblclick", function (event) {
        event.stop();
        overlay.setOptions({strokeWeight: 2.0, fillColor: 'green'});
        if (overlay.type === 'polygon') {
            _Modal('Geocercas', 'Agregar Geocerca', 'map-o', parametros + '&puntos=' + overlay.getPath().getArray() + '&tipo=1');
        }
        if (overlay.type === 'circle') {
            _Modal('Geocercas', 'Agregar Geocerca', 'map-o', parametros + '&puntos=' + overlay.getCenter() + '&radio=' + overlay.getRadius() + '&tipo=2');
        }
    });
}

function SeleccionarMarker() {
    $('#VehiculoLista tr').removeClass('Vehiculo-Actual');
    Ocultar(markersArray);
    CerrarInfoWindows();
    var bandera = false;
    var bounds = new google.maps.LatLngBounds();
    var boundAll = new google.maps.LatLngBounds();
    $('.Marcador').each(function () {
        boundAll.extend(markersArray[$(this).val()].getPosition());
        if ($(this).is(':checked')) {
            bandera = true;
            markersArray[$(this).val()].setMap(map);
            $('#vh-' + $(this).val()).addClass('Vehiculo-Actual');
            bounds.extend(markersArray[$(this).val()].getPosition());
        }
    });
    if (bandera) {
        map.panTo(bounds.getCenter());
        map.fitBounds(bounds);
    } else {
        $('#VehiculoLista tr').addClass('Vehiculo-Actual');
        DibujarMarkers();
        map.panTo(boundAll.getCenter());
        map.fitBounds(boundAll);
    }

}

function SeleccionarGeocerca(indice) {
    OcultarGeocercas();
    if (poligono[indice][1] === '1') {
        var i;
        var bounds = new google.maps.LatLngBounds();
        var arreglo = poligono[indice][0].getPath().getArray();
        poligono[indice][0].setMap(map);
        for (i = 0; i < arreglo.length; i++) {
            bounds.extend(arreglo[i]);
        }
        map.panTo(bounds.getCenter());
        map.fitBounds(bounds);
    }
    if (poligono[indice][1] === '2') {
        poligono[indice][0].setMap(map);
        map.panTo(new google.maps.LatLng(poligono[indice][0].getCenter().lat(), poligono[indice][0].getCenter().lng()));
    }
}

function deleteOverlays(objetos) {
    if (objetos) {
        for (i in objetos) {
            objetos[i].setMap(null);
        }
        objetos.length = 0;
    }
}

function OcultarGeocercas() {
    $('#agregar-geo').removeClass('active');
    $('#agregar-geo').removeAttr('disabled');
    $('#GeocercasLista tr').removeClass('Geocerca-Actual');
    OcultarFiguras();
    deleteOverlays(figuras);
}

function CerrarInfoWindows() {
    if (infowindows) {
        for (i in infowindows) {
            infowindows[i].close();
        }
    }
}

function Ocultar(objetos) {
    for (i in objetos) {
        objetos[i].setMap(null);
    }
}

function DibujarMarkers() {
    $('#RecorridosLista').html('');
    $('.Desde').val('');
    $('.Hasta').val('');
    $('.Desde').datepicker().trigger('changeDate');
    $('.Hasta').datepicker().trigger('changeDate');
    OcultarRecorrido();
    for (i in markersArray) {
        markersArray[i].setMap(map);
    }
    Ocultar(Recorrido);
}

function limpiarMapa() {
    OcultarFiguras()
    Ocultar(figuras);
    Ocultar(markersArray);
    deleteOverlays(Recorrido);
    deleteOverlays(RecorridoMarkers);
}

function DibujarLinea(inicio, fin, Coordenadas) {
    var punto = [];
    if (inicio === 0) {
        var iconInicio = {
            url: "../Config/includes/imagenes/iconos/inicio.png", // url
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(7, 33),
            scaledSize: new google.maps.Size(35, 35)
        };

        var markerInicio = new google.maps.Marker({
            position: Coordenadas[inicio],
            map: map,
            icon: iconInicio,
            animation: google.maps.Animation.DROP
        });
    }
    if (fin === Coordenadas.length - 1) {
        var iconFin = {
            url: "../Config/includes/imagenes/iconos/fin.png", // url
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(7, 33),
            scaledSize: new google.maps.Size(35, 35)
        };

        var markerFin = new google.maps.Marker({
            position: Coordenadas[fin],
            map: map,
            icon: iconFin,
            animation: google.maps.Animation.DROP
        });
    }
    punto.push(Coordenadas[inicio]);
    punto.push(Coordenadas[fin]);
    var polyline = new google.maps.Polyline({
        path: punto,
        strokeColor: 'blue',
        strokeOpacity: 1.0,
        strokeWeight: 3,
        geodesic: true,
        icons: [{
                icon: {path: google.maps.SymbolPath.CIRCLE},
                offset: '100%'
            }]
    });
    polyline.setMap(map);
    map.panTo(Coordenadas[fin]);
    Recorrido.push(polyline);
    inicio++;
    fin++;
    if (Stop === false && fin < Coordenadas.length) {
        setTimeout(function () {
            DibujarLinea(inicio, fin, Coordenadas);
        }, 1000);
    } else {
        Stop = false;
        $('#PararR').attr('disabled', true);
        $('#DibujarR').removeAttr('disabled');
    }
}

function PrepararRecorrido(Coordenadas, indice) {
    limpiarMapa();
    //markersArray[indice].setMap(map);
    if (Coordenadas.length > 1) {
        DibujarLinea(0, 1, Coordenadas);
    }
}

function DetenerRecorrido() {
    Stop = true;
}

function OcultarFiguras() {
    for (i in poligono) {
        poligono[i][0].setMap(null);
    }
}

function deleteFiguras() {
    for (i in poligono) {
        poligono[i][0].setMap(null);
        poligono[i][1] = null;
    }
    poligono.length = 0;
}

$(document).ready(function () {/* google maps -----------------------------------------------------*/
	

    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {

        /* Maracaibo / Edo. Zulia */
        var latlng = new google.maps.LatLng($('#lat').val(),$('#lng').val());
        var mapOptions = {
            center: latlng,
            scrollWheel: false,
            zoom: 30,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };

        // Mapa
        map = new google.maps.Map(document.getElementById("Mapa-STL2"), mapOptions);

        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: null,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.POLYGON,
                    google.maps.drawing.OverlayType.CIRCLE]
            },
            polygonOptions: {
                editable: true
            }
        });


    }

    /* end google maps -----------------------------------------------------*/
});

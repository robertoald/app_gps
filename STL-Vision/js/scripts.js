
$(document).ready(function () {/* google maps -----------------------------------------------------*/
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {

        /* Maracaibo / Edo. Zulia */
        var latlng = new google.maps.LatLng(10.573040852482304, -71.61706638231408);

        var mapOptions = {
            center: latlng,
            scrollWheel: false,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };

        var marker = new google.maps.Marker({
            position: latlng,
            url: '/',
            animation: google.maps.Animation.DROP
        });

        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        marker.setMap(map);

    }
    ;
    /* end google maps -----------------------------------------------------*/
});
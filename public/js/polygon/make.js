function makePolygon(map) {

    document.querySelector('#area').style.display = "block";

    var map, infoWindow;

    map = new google.maps.Map(document.getElementById('area'), {
        center: {lat: 50.85451938, lng: 4.35601451},
        zoom: 8
    });

    infoWindow = new google.maps.InfoWindow;

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.open(map);
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        }); } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
            }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }

    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon']
        }
    });

    drawingManager.setMap(map);

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (polygon) {
        var coordinatesArray = polygon.overlay.getPath().getArray();

        var myCoords = "[";
        for (var i = 0; i < coordinatesArray.length; i++) {
            myCoords += '{"lat":' + coordinatesArray[i].lat() + ', "lng":' + coordinatesArray[i].lng() + '}';
            if (i < coordinatesArray.length - 1)
                myCoords += ", ";
        }
        myCoords += "]";

        document.querySelector('#coordinates').value = myCoords;
    });

}
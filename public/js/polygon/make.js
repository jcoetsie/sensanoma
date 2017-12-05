function makePolygon() {
    document.querySelector('#area').style.display = "block";

    var map = new google.maps.Map(document.getElementById('area'), {
        center: {lat: 50.85451938, lng: 4.35601451},
        zoom: 8
    });

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

        document.querySelector('#area').style.display = "none";

        document.querySelector('#coordinates').value = myCoords;
    });
}


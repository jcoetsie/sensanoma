function makePolygon(map) {

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
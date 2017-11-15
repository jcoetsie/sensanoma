@section('js')

    @if(!empty($zone->coordinates[0]->lat))
        <script>

            function DrawMapWithPolygon(myCoords) {
                var map = new google.maps.Map(document.getElementById('area'), {
                    zoom: 10,
                    center: {lat: {{ $zone->coordinates[0]->lat }}, lng: {{ $zone->coordinates[0]->lng }} },
                    mapTypeId: 'terrain'
                });

                var myCoords = [
                    @foreach($zone->coordinates as $coordinate)
                    new google.maps.LatLng( {{ $coordinate->lat }}, {{ $coordinate->lng }} ),
                    @endforeach
                ];

                console.log(myCoords);

                // Construct the polygon.
                var bermudaTriangle = new google.maps.Polygon({
                    paths: myCoords,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });

                bermudaTriangle.setMap(map);
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key= {{ env('GOOGLE_KEY') }} &libraries=drawing&callback=DrawMapWithPolygon"
                async defer></script>
    @endif


    @if(!empty($area->coordinates[0]->lat))
        <script>

            function DrawMapWithPolygon(myCoords) {
                var map = new google.maps.Map(document.getElementById('area'), {
                    zoom: 10,
                    center: {lat: {{ $area->coordinates[0]->lat }}, lng: {{ $area->coordinates[0]->lng }} },
                    mapTypeId: 'terrain'
                });

                var myCoords = [
                    @foreach($area->coordinates as $coordinate)
                    new google.maps.LatLng( {{ $coordinate->lat }}, {{ $coordinate->lng }} ),
                    @endforeach
                ];

                console.log(myCoords);

                // Construct the polygon.
                var bermudaTriangle = new google.maps.Polygon({
                    paths: myCoords,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });

                bermudaTriangle.setMap(map);
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key= {{ env('GOOGLE_KEY') }} &libraries=drawing&callback=DrawMapWithPolygon"
                async defer></script>
    @endif

@stop
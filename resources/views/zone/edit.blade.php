@extends('adminlte::page')

@section('css')
    <style>
        #area {
            width: 100%;
            height: 300px;
        }
    </style>
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Zone settings</h1>
@stop

@section('content')
    {{ html()->form('PUT', route('zone.update', $zone))->open() }}

    <div class="box-body">
        <div class="form-group">
            {{ html()->label('Zone name','name')}}
            {{ html()->text('name')->class('form-control')->placeholder('Zone Name')->value($zone->name) }}
        </div>
        <div class="form-group">
            {{ html()->label('Zone crop','crop')}}
            {{ html()->text('crop')->class('form-control')->placeholder('Zone Crop')->value($zone->crop) }}
        </div>

        <div class="form-group">
            {{ html()->label('Area name','area_id') }}

            {{ html()->select('area_id', $areas)->class('form-control') }}
        </div>

        <div class="form-group">
            {{ html()->hidden('coordinates')->placeholder('Zone coordinates')->value( json_encode($zone->coordinates))->id('coordinates') }}

            <button onclick="makePolygon(); event.preventDefault();" class="btn btn-primary">Chose zone</button>

            <div style="display: none" id="area"></div>
        </div>
        <div class="form-group">
            {{ html()->submit('Update')->class('btn btn-primary pull-right') }}
        </div>

        {{ html()->form()->close() }}
    </div>

@stop

@section('js')
    <script>
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
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}&libraries=drawing" async
            defer></script>
@stop


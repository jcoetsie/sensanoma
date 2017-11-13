@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Area settings</h1>
@stop

@section('css')
    <style>
        #area{
            width: 100%;
            height:300px ;
        }
    </style>
@stop


@section('content')
    {{ html()->form('PUT', route('area.update', $area))->open() }}
    <div class="box-body">
        <div class="form-group">
            {{ html()->label('Area name','name')}}
            {{ html()->text('name')->class('form-control')->placeholder('Area Name')->value($area->name) }}
        </div>
        <div class="form-group">
            {{ html()->label('Area address','address')}}
            {{ html()->text('address')->class('form-control')->placeholder('Area address')->value($area->address) }}
        </div>
        <div class="form-group">
            {{ html()->hidden('coordinates')->placeholder('Area coordinates')->value( json_encode($area->coordinates))->id('coordinates') }}

            <button onclick="makePolygon(); event.preventDefault();" class="btn btn-primary">Chose area</button>

            <div id="area"></div>
        </div>
        <div class="form-group">
    {{ html()->submit('Update')->class('btn btn-primary pull-right') }}
        </div>
    {{ html()->form()->close() }}

    @include('layouts.flash')
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

            google.maps.event.addListener(drawingManager, 'overlaycomplete', function(polygon) {
                var coordinatesArray = polygon.overlay.getPath().getArray();

                var myCoords = "[";
                for(var i=0; i < coordinatesArray.length; i++)
                {
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
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}&libraries=drawing" async defer></script>
@stop


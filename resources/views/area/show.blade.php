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


    Area name : {{ $area->name }} <br>
    Area address : {{ $area->address }} <br>
    account owner : {{ $area->account->name }}

    <div id="area"></div>


    <a href="{{ route('area.edit', $area) }}">
        <button>Edit</button>
    </a>
    {{ html()->form('DELETE', route('area.destroy', $area->id))->open() }}

    {{ html()->button('Delete') }}

    {{ html()->form()->close() }}


@stop


@section('js')
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


@stop



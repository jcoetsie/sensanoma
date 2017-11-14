@extends('adminlte::page')

@section('css')
    <style>
        #area{
            width: 100%;
            height:300px ;
        }
    </style>
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Zone settings</h1>
@stop


@section('content')

    <table class="table">
        <tr>
            <th style="width: 20%;">Name</th>
            <th style="width: 40%">Crop</th>
            <th style="width: 20%">Area</th>
        </tr>
        <tr>
            <td>
                {{ $zone->name }}
            </td>
            <td>
                {{ $zone->crop }}
            </td>
            <td>
                {{ $zone->area->name }}
            </td>
            <td>
                <a href="{{ route('zone.edit', $zone) }}">
                    <button type="button" class="btn btn-block btn-info">Edit</button>
                </a>
            </td>
            <td>

                {{ html()->form('DELETE', route('zone.destroy', $zone->id))->open() }}

                {{ html()->submit('Delete')->class('btn btn-danger') }}

                {{ html()->form()->close() }}

            </td>
        </tr>
    </table>
    <div id="area"></div>

@stop


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


@stop



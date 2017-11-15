@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Area settings</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')

    <table class="table borderless">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Account owner</th>
        </tr>
        <tr>
            <td>
                {{ $area->name }}
            </td>
            <td>
                {{ $area->address }}
            </td>
            <td>
                {{ $area->account->name }}
            </td>
            <td class="pull-right">

                {{ html()->form('DELETE', route('area.destroy', $area->id))->open() }}

                {{ html()->submit('Delete')->class('btn custom btn-danger') }}

                {{ html()->form()->close() }}

            </td>

            <td class="pull-right">

                {{ html()->form('GET', route('area.edit', $area->id))->open() }}

                {{ html()->submit('Edit')->class('btn custom btn-info') }}

                {{ html()->form()->close() }}
            </td>
        </tr>
    </table>
    <div id="area"></div>

@stop


@section('js')

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



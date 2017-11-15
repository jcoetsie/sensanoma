@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Zone settings</h1>
@stop


@section('content')

    <table class="table borderless">
        <tr>
            <th>Name</th>
            <th>Crop</th>
            <th>Area</th>
            <th class="pull-right"></th>
            <th class="pull-right"></th>
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
            <td class="pull-right">

                {{ html()->form('DELETE', route('zone.destroy', $zone->id))->open() }}

                {{ html()->submit('Delete')->class('btn custom btn-danger') }}

                {{ html()->form()->close() }}

            </td>

            <td class="pull-right">

                {{ html()->form('GET', route('zone.edit', $zone->id))->open() }}

                {{ html()->submit('Edit')->class('btn custom btn-info') }}

                {{ html()->form()->close() }}
            </td>

        </tr>
    </table>
    <div id="area"></div>

    @include('layouts.showPolygon')

@stop






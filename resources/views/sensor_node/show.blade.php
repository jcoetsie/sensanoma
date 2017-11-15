@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Sensor Node settings</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')
    <table class="table borderless">
        <tr>
            <th>Sensor node name</th>
            <th>Zone name</th>
        </tr>
        <tr>
            <td>
                {{ $sensorNode->name }}
            </td>
            <td>
                {{ $sensorNode->zone->name }}
            </td>
            <td class="pull-right">

                {{ html()->form('DELETE', route('sensor_node.destroy', $sensorNode->id))->open() }}

                {{ html()->submit('Delete')->class('btn custom btn-danger') }}

                {{ html()->form()->close() }}

            </td>

            <td class="pull-right">

                {{ html()->form('GET', route('sensor_node.edit', $sensorNode->id))->open() }}

                {{ html()->submit('Edit')->class('btn custom btn-info') }}

                {{ html()->form()->close() }}
            </td>
        </tr>
    </table>

@stop




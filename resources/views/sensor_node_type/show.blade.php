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
            <th>Sensor node type name</th>
            <th>Sensor node name</th>
        </tr>
        <tr>
            <td>
                {{ $sensorNodeType->name }}
            </td>
            <td>
                <a href="{{ route('sensor_node.show', $sensorNodeType->sensorNodes->id) }}">
                    {{ $sensorNodeType->sensorNodes->name }}</a>
            </td>
            <td class="pull-right">

                {{ html()->form('DELETE', route('sensor_node_type.destroy', $sensorNodeType->id))->open() }}

                {{ html()->submit('Delete')->class('btn custom btn-danger') }}

                {{ html()->form()->close() }}

            </td>

            <td class="pull-right">

                {{ html()->form('GET', route('sensor_node_type.edit', $sensorNodeType->id))->open() }}

                {{ html()->submit('Edit')->class('btn custom btn-info') }}

                {{ html()->form()->close() }}
            </td>
        </tr>
    </table>

@stop
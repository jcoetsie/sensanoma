@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Sensor Node Type settings</h1>
@stop

@section('content')

    {{ html()->form('PUT', route('sensor_node_type.update', $sensorNodeType))->open() }}

    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label('Sensor Node Type name','name')}}

            {{ html()->text('name')->class('form-control')->placeholder('Sensor Node Type Name')->value($sensorNodeType->name) }}
        </div>

        <div class="form-group">
            {{ html()->label('Sensor Node name','sensor_node_id') }}

            {{ html()->select('sensor_node_id', $sensorNodes)->class('form-control')->value($sensorNodeType->sensor_node_id) }}
        </div>

        <div class="form-group">

            {{ html()->submit('Update Sensor Node Type')->class('btn btn-primary pull-right') }}
        </div>
    </div>
    {{ html()->form()->close() }}

@stop





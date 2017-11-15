@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Sensor Node Type settings</h1>
@stop

@section('content')

    {{ html()->form('POST', route('sensor_node_type.store'))->open() }}

    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label('Sensor Node Type name','name')}}

            {{ html()->text('name')->class('form-control')->placeholder('Sensor Node Type Name') }}
        </div>

        <div class="form-group">
            {{ html()->label('Sensor Node name','sensor_node_id') }}

            {{ html()->select('sensor_node_id', $sensorNodes)->class('form-control') }}
        </div>

        <div class="form-group">

            {{ html()->submit('Create Sensor Node Type')->class('btn btn-primary pull-right') }}
        </div>
    </div>
    {{ html()->form()->close() }}

@stop





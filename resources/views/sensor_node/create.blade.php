@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Sensor Node settings</h1>
@stop

@section('content')

    {{ html()->form('POST', route('sensor_node.store'))->open() }}

    <div class="box-body">
        <div class="form-group">
            {{ html()->label('Sensor name','name')}}

            {{ html()->text('name')->class('form-control')->placeholder('Sensor Name') }}
        </div>

        <div class="form-group">
            {{ html()->label('Zone name','zone_id') }}

            {{ html()->select('zone_id', $zones)->class('form-control') }}
        </div>

        <div class="form-group">

            {{ html()->submit('Create Sensor Node')->class('btn btn-primary pull-right') }}
        </div>

        {{ html()->form()->close() }}
    </div>

@stop





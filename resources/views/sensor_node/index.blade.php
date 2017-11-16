@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <div class="col-md-12">
        <h2>All SensorNodes
            <a href="{{ route('sensor_node.create') }}"><button type="button" class="btn btn-flat btn-primary pull-right">Create a SensorNode</button></a>
        </h2>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')
    @foreach($sensorNodes as $node)
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-microchip "></i></span>

            <div class="info-box-content">
            <span>
                <h4><a href="{{ route('sensor_node.show', $node) }}">{{ $node->name }}</a></h4>
            </span>
            <span class="progress-description"> Zone:
                <a href="{{ route('zone.show', $node->zone->id) }}">{{ $node->zone->name }}</a>
            </span>
            <span class="progress-description"> Created by:
                <a href="{{ route('account.show', $node->account->id) }}">{{ $node->account->name }}</a>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-6">

                {{ html()->form('GET', route('sensor_node.edit', $node->id))->open() }}

                {{ html()->submit('Edit')->class('btn btn-block btn-info') }}

                {{ html()->form()->close() }}

            </div>

            <div class="col-md-6 col-sm-6 col-xs-6">

                {{ html()->form('DELETE', route('sensor_node.destroy', $node->id))->open() }}

                {{ html()->submit('Delete')->class('btn btn-block btn-danger') }}

                {{ html()->form()->close() }}

            </div>
        </div>
        <br>
    </div>
    @endforeach

@stop




@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <div class="col-md-12">
        <h2>All zones
            <a href="{{ route('zone.create') }}"><button type="button" class="btn btn-flat btn-primary pull-right">Create a zone</button></a>
        </h2>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')
    @foreach($zones as $zone)
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-flag "></i></span>
                <div class="info-box-content">
                    <h4><a href="{{ route('zone.show', $zone) }}">{{ $zone->name }}</a></h4>
                    <span class="progress-description"> Crop:
                        {{ $zone->crop }}
                    </span>
                    <span class="progress-description"> Area:
                        <a href="{{ route('area.show', $zone->area->id) }}">{{ $zone->area->name }}</a>
                    </span>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-6">

                    {{ html()->form('GET', route('zone.edit', $zone->id))->open() }}

                    {{ html()->submit('Edit')->class('btn btn-block btn-info') }}

                    {{ html()->form()->close() }}

                </div>

                <div class="col-md-6 col-sm-6 col-xs-6">

                    {{ html()->form('DELETE', route('zone.destroy', $zone->id))->open() }}

                    {{ html()->submit('Delete')->class('btn btn-block btn-danger') }}

                    {{ html()->form()->close() }}

                </div>
            </div>
            <br>
        </div>
    @endforeach
@stop




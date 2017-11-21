@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="col-md-12">
            <h2>All areas
                <a href="{{ route('area.create') }}"><button type="button" class="btn btn-flat btn-primary pull-right">Add an area</button></a>
            </h2>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')
    <div class='row'>
        @foreach($areas as $area)
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="info-box">
                <a href="{{ route('area.show', $area) }}">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-map"></i></span>
                </a>
                <div class="info-box-content">
                    <span>
                        <h4><a href="{{ route('area.show', $area) }}">{{ $area->name }}</a></h4>
                    </span>
                    <span class="progress-description"> Address: {{ $area->address }}</span>
                    <span class="progress-description"> Created by:
                       <a href="{{ route('account.show', $area->account->id) }}">{{ $area->account->name }}</a>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <br>
        </div>
        @endforeach
    </div>
@stop




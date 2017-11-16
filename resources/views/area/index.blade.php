@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
        <div class="col-md-12">
            <h2>All areas
                <a href="{{ route('area.create') }}"><button type="button" class="btn btn-flat btn-primary pull-right">Create an area</button></a>
            </h2>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')

    @foreach($areas as $area)
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-map"></i></span>

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
        <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-6">

                {{ html()->form('GET', route('area.edit', $area->id))->open() }}

                {{ html()->submit('Edit')->class('btn btn-block btn-info') }}

                {{ html()->form()->close() }}

            </div>

            <div class="col-md-6 col-sm-6 col-xs-6">

                {{ html()->form('DELETE', route('area.destroy', $area->id))->open() }}

                {{ html()->submit('Delete')->class('btn btn-block btn-danger') }}

                {{ html()->form()->close() }}

            </div>
        </div>
        <br>
    </div>
    @endforeach
@stop




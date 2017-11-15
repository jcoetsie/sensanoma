@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Zone settings</h1>
@stop

@section('content')


    {{ html()->form('POST', route('zone.store'))->open() }}
    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label('Zone name','name')}}

            {{ html()->text('name')->class('form-control')->placeholder('Zone Name') }}
        </div>
        <div class="form-group">
            {{ html()->label('Crop','crop')}}

            {{ html()->text('crop')->class('form-control')->placeholder('Crop') }}
        </div>

        <div class="form-group">
            {{ html()->label('Area name','area_id') }}

            {{ html()->select('area_id', $areas)->class('form-control') }}
        </div>

        <div class="form-group">

            {{ html()->hidden('coordinates')->placeholder('Zone coordinates')->id('coordinates') }}

            <button onclick="makePolygon(); event.preventDefault();" class="btn btn-primary">Chose zone</button>

            <div id="area" style="display: none"></div>
        </div>
        <div class="form-group">

            {{ html()->submit('Create zone')->class('btn btn-primary pull-right') }}
        </div>
    </div>
    {{ html()->form()->close() }}

@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/polygon/make.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}&libraries=drawing" async
            defer></script>
@stop




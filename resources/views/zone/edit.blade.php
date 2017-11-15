@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Zone settings</h1>
@stop

@section('content')
    {{ html()->form('PUT', route('zone.update', $zone))->open() }}
    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label('Zone name','name')}}
            {{ html()->text('name')->class('form-control')->placeholder('Zone Name')->value($zone->name) }}
        </div>
        <div class="form-group">
            {{ html()->label('Zone crop','crop')}}
            {{ html()->text('crop')->class('form-control')->placeholder('Zone Crop')->value($zone->crop) }}
        </div>

        <div class="form-group">
            {{ html()->label('Area name','area_id') }}

            {{ html()->select('area_id', $areas)->class('form-control') }}
        </div>

        <div class="form-group">
            {{ html()->hidden('coordinates')->placeholder('Zone coordinates')->value( json_encode($zone->coordinates))->id('coordinates') }}

            <button onclick="makePolygon(); event.preventDefault();" class="btn btn-primary">Chose zone</button>

            <div style="display: none" id="area"></div>
        </div>
        <div class="form-group">
            {{ html()->submit('Update')->class('btn btn-primary pull-right') }}
        </div>
    </div>
    {{ html()->form()->close() }}

@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/polygon/make.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}&libraries=drawing" async
            defer></script>
@stop


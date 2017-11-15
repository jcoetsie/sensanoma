@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Area settings</h1>
@stop

@section('content')
    {{ html()->form('PUT', route('area.update', $area))->open() }}
    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label('Area name','name')}}
            {{ html()->text('name')->class('form-control')->placeholder('Area Name')->value($area->name) }}
        </div>
        <div class="form-group">
            {{ html()->label('Area address','address')}}
            {{ html()->text('address')->class('form-control')->placeholder('Area address')->value($area->address) }}
        </div>
        <div class="form-group">
            {{ html()->hidden('coordinates')->placeholder('Area coordinates')->value( json_encode($area->coordinates))->id('coordinates') }}

            <button onclick="makePolygon(); event.preventDefault();" class="btn btn-primary">Chose area</button>

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

@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content_header')
    @include('layouts.flash')
    <h1>Area settings</h1>
@stop

@section('content')

    {{ html()->form('POST', route('area.store'))->open() }}

    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label('Area name','name')}}

            {{ html()->text('name')->class('form-control')->placeholder('Area Name') }}
        </div>
        <div class="form-group">
            {{ html()->label('Address','address')}}

            {{ html()->text('address')->class('form-control')->placeholder('Area address') }}
        </div>
        <div class="form-group">

            {{ html()->hidden('coordinates')->placeholder('Area coordinates')->id('coordinates') }}

            <button onclick="makePolygon(); event.preventDefault();" class="btn btn-primary">Chose area</button>

            <div id="area" style="display: none"></div>
        </div>
        <div class="form-group">

            {{ html()->submit('Create area')->class('btn btn-primary pull-right') }}
        </div>
    </div>
    {{ html()->form()->close() }}

@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/polygon/make.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_KEY') }}&libraries=drawing" async
            defer></script>
@stop





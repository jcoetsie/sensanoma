@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')
	@foreach($areas as $area)
		Area name : {{ $area->name }} <br>
		Area address : {{ $area->address }} <br>
		account owner : {{ $area->account->name }}
	@endforeach
@stop




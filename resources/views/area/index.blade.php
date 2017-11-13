@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Area settings</h1>
@stop


@section('content')
	@foreach($areas as $area)

		Area name : {{ $area->name }} <br>
		Area address : {{ $area->address }} <br>
		account owner : {{ $area->account->name }}

		<a href="{{ route('area.edit', $area) }}">
			<button>Edit</button>
		</a>
		{{ html()->form('DELETE', route('area.destroy', $area->id))->open() }}

		{{ html()->button('Delete') }}

		{{ html()->form()->close() }}

	@endforeach

	<a href="{{ route('area.create') }}">
		<button>Add a area</button>
	</a>

@stop




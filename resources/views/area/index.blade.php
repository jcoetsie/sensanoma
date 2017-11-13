@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Area settings</h1>
@stop


@section('content')

	<div class="col-md-12">
		<div class="box">
			<div class="box-body no-padding">
				<table class="table">
					<tr>
						<th style="width: 20%;">Name</th>
						<th style="width: 40%">Address</th>
						<th style="width: 20%">Account owner</th>
					</tr>
					@foreach($areas as $area)
					<tr>
						<td>
							<a href="{{ route('area.show', $area) }}">

								{{ $area->name }}

							</a>
						</td>
						<td>
								{{ $area->address }}
						</td>
						<td>
								{{ $area->account->name }}
						</td>
						<td>
							<a href="{{ route('area.edit', $area) }}">
								<button type="button" class="btn btn-block btn-info">Edit</button>
							</a>
						</td>
						<td>

							{{ html()->form('DELETE', route('area.destroy', $area->id))->open() }}

							{{ html()->submit('Delete')->class('btn btn-danger') }}

							{{ html()->form()->close() }}

						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
	</div>
	<a href="{{ route('area.create') }}">
		<button type="button" class="btn btn-block btn-primary">Create an area</button>
	</a>
	<hr>
	@include('layouts.flash')

@stop




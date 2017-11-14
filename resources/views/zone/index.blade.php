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
                        <th>Name</th>
                        <th>Crop</th>
                        <th>Area</th>
                        <th></th>
                    </tr>
                    @foreach($areas as $area)
                        @foreach($area->zones as $zone)
                        <tr>
                            <td><a href="{{ route('zone.show', $zone) }}">{{ $zone->name }}</a></td>
                            <td>{{ $zone->crop }}</td>
                            <td><a href="{{ route('area.show', $zone->area->id) }}">{{ $zone->area->name }}</a></td>
                            <td>
                                <a href="{{ route('zone.edit', $zone) }}">
                                    <button type="button" class="btn btn-block btn-info">Edit</button>
                                </a>
                            </td>
                            <td>

                                {{ html()->form('DELETE', route('zone.destroy', $zone->id))->open() }}

                                {{ html()->submit('Delete')->class('btn btn-danger') }}

                                {{ html()->form()->close() }}

                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <a href="{{ route('zone.create') }}">
        <button type="button" class="btn btn-block btn-primary">Create a zone</button>
    </a>
    <hr>
    @include('layouts.flash')

@stop




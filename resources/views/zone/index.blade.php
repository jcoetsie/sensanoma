@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Zone settings</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')

    <div class="col-md-12">
        <div class="box">
            <div class="box-body no-padding">
                <table class="table borderless">
                    <tr>
                        <th style="width: 30%;">Name</th>
                        <th style="width: 25%;">Crop</th>
                        <th style="width: 25%;">Area</th>
                    </tr>
                    @foreach($areas as $area)
                        @foreach($area->zones as $zone)
                            <tr>
                                <td><a href="{{ route('zone.show', $zone) }}">{{ $zone->name }}</a></td>
                                <td>{{ $zone->crop }}</td>
                                <td><a href="{{ route('area.show', $zone->area->id) }}">{{ $zone->area->name }}</a></td>
                                <td class="pull-right">

                                    {{ html()->form('DELETE', route('zone.destroy', $zone->id))->open() }}

                                    {{ html()->submit('Delete')->class('btn custom btn-danger') }}

                                    {{ html()->form()->close() }}

                                </td>

                                <td class="pull-right">

                                    {{ html()->form('GET', route('zone.edit', $zone->id))->open() }}

                                    {{ html()->submit('Edit')->class('btn custom btn-info') }}

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

@stop




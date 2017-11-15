@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Sensor Node settings</h1>
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
                        <th>Name</th>
                        <th>Owner</th>
                        <th>Zone</th>
                    </tr>
                    @foreach($sensorNodes as $node)
                        <tr>
                            <td>
                                <a href="{{ route('sensor_node.show', $node) }}">{{ $node->name }}</a>
                            <td>
                                <a href="{{ route('account.show', $node->account->id) }}">{{ $node->account->name }}</a>
                            </td>
                            <td>
                                <a href="{{ route('zone.show', $node->zone->id) }}">{{ $node->zone->name }}</a>
                            </td>
                            <td class="pull-right">

                                {{ html()->form('DELETE', route('sensor_node.destroy', $node->id))->open() }}

                                {{ html()->submit('Delete')->class('btn custom btn-danger') }}

                                {{ html()->form()->close() }}

                            </td>

                            <td class="pull-right">

                                {{ html()->form('GET', route('sensor_node.edit', $node->id))->open() }}

                                {{ html()->submit('Edit')->class('btn custom btn-info') }}

                                {{ html()->form()->close() }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <a href="{{ route('sensor_node.create') }}">
        <button type="button" class="btn btn-block btn-primary">Create a sensor node</button>
    </a>
    <hr>

@stop




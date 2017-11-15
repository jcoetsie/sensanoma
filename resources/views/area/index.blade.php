@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Area settings</h1>
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
                        <th>Address</th>
                        <th>Account owner</th>
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
                            <td class="pull-right">

                                {{ html()->form('DELETE', route('area.destroy', $area->id))->open() }}

                                {{ html()->submit('Delete')->class('btn custom btn-danger') }}

                                {{ html()->form()->close() }}

                            </td>

                            <td class="pull-right">

                                {{ html()->form('GET', route('area.edit', $area->id))->open() }}

                                {{ html()->submit('Edit')->class('btn custom btn-info') }}

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

@stop




@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Area settings</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')

    <table class="table borderless">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Account owner</th>
        </tr>
        <tr>
            <td>
                {{ $area->name }}
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
    </table>
    <div id="area"></div>

    @include('layouts.showPolygon')

@stop




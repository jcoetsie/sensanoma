@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Account</h1>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')

    <table class="table borderless">
        <tr>
            <th style="width: 80%">Name</th>
        </tr>
        <tr>
            <td style="width: 80%">{{ $account->name }}</td>
            <td class="pull-right">

                {{ html()->form('DELETE', route('account.destroy', $account->id))->open() }}

                {{ html()->submit('Delete')->class('btn custom btn-danger') }}

                {{ html()->form()->close() }}

            </td>

            <td class="pull-right">

                {{ html()->form('GET', route('account.edit', $account->id))->open() }}

                {{ html()->submit('Edit')->class('btn custom btn-info') }}

                {{ html()->form()->close() }}
            </td>
        </tr>
    </table>

@stop
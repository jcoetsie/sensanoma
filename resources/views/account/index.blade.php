@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Account settings</h1>
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
                        <th style="width: 80%;">Name</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('account.show', $account) }}">

                                {{ $account->name }}

                            </a>
                        </td>
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
            </div>
        </div>
    </div>
    <a href="{{ route('account.create', $account) }}">
        <button type="button" class="btn btn-block btn-primary" disabled="disabled">Create an account</button>
    </a>
    <hr>

@stop
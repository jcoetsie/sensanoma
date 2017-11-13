@extends('adminlte::page')

@section('title')
    Sensanoma
@stop

@section('content_header')
    <h1>Account</h1>
@stop

@section('content')

    <div class="col-md-12">
        <div class="box">
            <div class="box-body no-padding">
                <table class="table">
                    <tr>
                        <th style="width: 80%">Name</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td style="width: 80%">{{ $account->name }}</td>
                        <td>
                            <a href="{{ route('account.edit', $account) }}">
                                <button type="button" class="btn btn-block btn-info">Update</button>
                            </a>
                        </td>
                        <td>
                            {{ html()->form('DELETE', route('account.destroy', $account))->open() }}

                            {{ html()->submit('Delete')->class('btn btn-danger') }}

                            {{ html()->form()->close() }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@stop
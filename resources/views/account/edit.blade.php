@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <h1>Edit account</h1>
@stop

@section('content')
    {{ html()->form('PUT', route('account.update', $account))->open() }}
    <div class="box-body">
        <div class="form-group">
            {{ html()->label('Account name','name')}}

            {{ html()->text('name')->class('form-control')->value( $account->name ) }}
        </div>
    </div>

    {{ html()->submit('Update')->class('btn btn-primary pull-right') }}

    {{ html()->form()->close() }}

@stop

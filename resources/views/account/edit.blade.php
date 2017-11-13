@extends('adminlte::page')

@section('title')
   Sensanoma edit account
@stop

@section('content_header')
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
    <div class="box-footer">
        {{ html()->submit('submit changes')->class('btn btn-primary pull-right') }}
    </div>
    {{ html()->form()->close() }}

    @include('layouts.flash')
@stop

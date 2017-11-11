@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Account settings</h1>
@stop

@section('content')
    <p>Settings will be coming soon</p>
    <a href="{{ route('account.edit', $account) }}">Edit account</a>
@stop
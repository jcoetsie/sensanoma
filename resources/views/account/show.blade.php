@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="form-group">
            <label id="head_label" class="col-md-4 col-sm-5 col-xs-12 col-md-offset-2 col-sm-offset-1">Account Settings</label>

            <div class="col-md-4 col-sm-5 hidden-xs">

                {{ html()->form('DELETE', route('account.destroy', $account->id))->open() }}

                {{ html()->submit('Delete')->class('btn btn-flat custom btn-danger')->style('float:right; margin-left:2px') }}

                {{ html()->form()->close() }}

                {{ html()->form('GET', route('account.edit', $account->id))->open() }}

                {{ html()->submit('Edit')->class('btn btn-flat custom btn-info')->style('float:right') }}

                {{ html()->form()->close() }}

            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')

    <div class='row'>
        <div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-1">
            <div class="info-box">
                <a href="{{ route('account.show', $account) }}">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                </a>
                <div class="info-box-content">
                    <span>
                        <h4><a href="{{ route('account.show', $account) }}">{{ $account->name }}</a></h4>
                    </span>
                    <span>
                        <h4>Created in: {{  Carbon\Carbon::parse($account->created_at)->toFormattedDateString()  }}</h4>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>

            <div class="row">
                <div class="hidden-lg hidden-md hidden-sm col-xs-6">
                    {{ html()->form('GET', route('account.edit', $account->id))->open() }}

                    {{ html()->submit('Edit')->class('btn btn-flat btn-block btn-info') }}

                    {{ html()->form()->close() }}
                </div>
                <div class="hidden-lg hidden-md hidden-sm col-xs-6">


                    {{ html()->form('DELETE', route('account.destroy', $account->id))->open() }}

                    {{ html()->submit('Delete')->class('btn btn-flat btn-block btn-danger') }}

                    {{ html()->form()->close() }}

                </div>
            </div>
        </div>
    </div>

@stop
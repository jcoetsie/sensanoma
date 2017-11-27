@extends('adminlte::page')

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
            <h2>Account</h2>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('content')
    <div class='row'>
        <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
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
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-10 col-xs-12 col-md-offset-3 col-sm-offset-1">
            <h2 class="text-center">Account users</h2>
        </div>
    </div>
    <div class='row'>
            <div class="col-md-12">
                    @foreach($viewers as $viewer)
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                            <div class="info-box-content">
                                <span>
                                    <h4>{{ $viewer->name }}</h4>
                                </span>
                                <!-- viewer destroy au lieu de user -->
                                    {{ html()->form('DELETE', route('user.destroy', $viewer->id ))->open() }}

                                    {{ html()->submit('Delete')->class('btn btn-danger')->style('float:right;') }}

                                    {{ html()->form()->close() }}
                                <span>
                                    <h4>Created in: {{  Carbon\Carbon::parse($viewer->created_at)->toFormattedDateString()  }}</h4>
                                </span>
                            </div>
                        </div>
                        <br>
                    </div>
                    @endforeach
            </div>
        </div>

@stop
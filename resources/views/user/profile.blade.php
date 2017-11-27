@extends('adminlte::pageUser')

@section('content_header')
    @include('layouts.flash')
    <div class="row">
        <div class="form-group">
            <label id="head_label" class="col-md-4 col-sm-5 col-xs-12 col-md-offset-2 col-sm-offset-1">User Settings</label>

            <div class="col-md-4 col-sm-5 hidden-xs">

                {{ html()->form('DELETE', route('user.delete', Auth::user() ))->open() }}

                {{ html()->submit('Delete')->class('btn btn-flat custom btn-danger')->style('float:right; margin-left:2px') }}

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
            <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username">{{ $user->name }}</h3>
                <h5 class="widget-user-desc">E-mail: {{ $user->email }}</h5>
                <h5 class="widget-user-desc">Created: {{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle user-img" src="/uploads/avatars/{{ $user->avatar }}" alt="User Avatar">
            </div>
            <div class="box-footer">
                <br>
                <div class="row">

                    <div class="col-md-12">

                        {{ html()->form('PUT', url('user'))->acceptsFiles()->open() }}

                        <div class="form-group">
                            {{ html()->label('User name','name')}}

                            {{ html()->text('name')->class('form-control')->value( $user->name ) }}

                            {{ html()->label('User Avatar','avatar')}}

                            {{ html()->file('avatar') }}
                        </div>

                        {{ html()->submit('Update')->class('btn btn-primary pull-right') }}

                        {{ html()->form()->close() }}
                    </div>

                    <div class="hidden-lg hidden-md hidden-sm col-xs-6">

                        {{ html()->form('DELETE', url('profile', Auth::user()->id ))->open() }}

                        {{ html()->submit('Delete')->class('btn btn-danger')->style('float:left;') }}

                        {{ html()->form()->close() }}
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>

@stop
@extends('adminlte::page')

@section('title')

@section('content_header')
    @include('layouts.flash')
    <h1>Dashboard</h1>
@stop

@section('content')
    @include('layouts.flash')
    <div class="small-box bg-green">
        <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Humidity Rate</p>
        </div>
        <div class="icon">
            <i class="ion ion-waterdrop"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>

    <div class="small-box bg-red">
        <div class="inner">
            <h3>15<sup style="font-size: 20px">°</sup></h3>

            <p>Soil Temp</p>
        </div>
        <div class="icon">
            <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>

    <div class="small-box bg-blue">
        <div class="inner">
            <h3>1.762<sup style="font-size: 20px">Lumen</sup></h3>

            <p>Solar energy</p>
        </div>
        <div class="icon">
            <i class="ion ion-android-sunny"></i>
        </div>
        <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>

@stop


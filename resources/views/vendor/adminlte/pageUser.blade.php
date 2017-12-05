@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'red') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    @else
                        <!-- Logo -->
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                                <!-- mini logo for sidebar mini 50x50 pixels -->
                                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                                <!-- logo for regular state and mobile devices -->
                                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
                            </a>

                            <!-- Header Navbar -->
                            <nav class="navbar navbar-static-top" role="navigation">
                                <!-- Sidebar toggle button-->
                            @endif
                            <!-- Navbar Right Menu -->
                                <div class="navbar-custom-menu">

                                    <ul class="nav navbar-nav">
                                        <li class="dropdown notifications-menu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-bell"></i>
                                                <span class="label label-warning">3</span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li class="header">You have 3 notifications</li>
                                                <li>
                                                    <!-- inner menu: contains the actual data -->
                                                    <ul class="menu">
                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-warning text-yellow"></i> Soil Temp too low
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-warning text-yellow"></i> Air Temp too low
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-warning text-red"></i> Sensor Voltage too high
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="footer"><a href="#">View all</a></li>
                                            </ul>
                                        </li>

                                        <li>
                                            <img class="img-circle avatar" src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="User Avatar">
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                                                {{ Auth::user()->name }}<span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" role="menu">

                                                <li><a href="{{ url('/user') }}">
                                                        <i class="fa fa-btn fa-user"></i>User Settings</a>
                                                </li>

                                                <li class="divider"></li>
                                                <li>
                                                    @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                                        <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                            <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                        </a>
                                                    @else
                                                        <a href="#"
                                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                        >
                                                            <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                        </a>
                                                        <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                                            @if(config('adminlte.logout_method'))
                                                                {{ method_field(config('adminlte.logout_method')) }}
                                                            @endif
                                                            {{ csrf_field() }}
                                                        </form>
                                                    @endif
                                                </li>
                                            </ul>
                                        </li>


                                    </ul>
                                </div>
                            @if(config('adminlte.layout') == 'top-nav')
                    </div>
                    @endif
                </nav>
        </header>

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px;">
            @if(config('adminlte.layout') == 'top-nav')
                <div class="container">
                @endif

                <!-- Content Header (Page header) -->
                    <section class="content-header">
                        @yield('content_header')
                    </section>

                    <!-- Main content -->
                    <section class="content">

                        @yield('content')

                    </section>
                    <!-- /.content -->
                    @if(config('adminlte.layout') == 'top-nav')
                </div>
                <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop

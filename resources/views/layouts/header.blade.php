<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta-data')

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-theme.css') }}" rel="stylesheet">


    <!-- Google Fonts & Font-Awesome -->
   {{-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400" rel="stylesheet" type="text/css">--}}

    <!-- Font awesome 4.4.0 -->
    <link rel="stylesheet" href="{{ asset('assets/font-awesome-4.4.0/css/font-awesome.min.css') }}">
    <!-- load page specific css -->

    <!-- main select2.css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <!-- Conditional page load script -->
    @if(request()->segment(1) === 'dashboard')
        <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/metisMenu/dist/metisMenu.min.css') }}">
    @endif
                <!-- main style.css -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @yield('page-css')

        @if(get_option('additional_css'))
            <style type="text/css">
                {{ get_option('additional_css') }}
            </style>
            @endif
                <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        </script>
</head>
<body>

@if( ! request()->cookie('accept_cookie'))
    <div class="alert text-center cookie-notice" style="border-color:black;background-color:black;font-size: 16px; margin: 0; line-height: 25px;">
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <p>{!! get_option('Are you agree with services rules for this app ?') !!}</p>
                    <a href="#" class="cookie-ok-btn btn btn-warning">Accept</a>
                    <a href="{!! get_post_url(get_option('cookie_learn_page')) !!}">Learn More</a>
                </div>
            </div>
        </div>
    </div>
@endif


<div class="top-navbar" style="background-color: #0f0f0f">


    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                                @if(get_option('logo_settings') == 'show_site_name')
                                    {{ get_option('site_name') }}
                                @else
                                    @if(logo_url())

                                    @else
                                        {{ get_option('site_name') }}
                                    @endif
                                @endif


                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><img style="max-width: 42px;margin-left: -135%;" src=https://i.postimg.cc/cH4BT2qn/icon.png"></li>
                                <li><a href="{{route('home')}}"><i class=""></i> @lang('Home')</a></li>


                                <?php
                                $header_menu_pages = \App\Post::whereStatus('1')->where('show_in_header_menu', 1)->get();
                                ?>
                                @if($header_menu_pages->count() > 0)
                                    @foreach($header_menu_pages as $page)
                                        <li><a href="{{ route('single_page', $page->slug) }}">{{ $page->title }} </a></li>
                                    @endforeach
                                @endif

                            </ul>

                            <ul class="nav navbar-nav navbar-right" >
                                <li><a href="{{route('start_campaign')}}" class="top-start-btn-dark" style="color: white">@lang('Start a team')</a></li>


                                <!-- Authentication Links -->
                                @if (Auth::guest())
                                    <li><a href="{{ route('login') }}" style="color: white">@lang('app.login')</a></li>
                                    <li><a href="{{ route('register') }}" style="color: white">@lang('app.register')</a></li>
                                @else
                                    <li> <a href="{{route('messages')}}"> @lang('Messenger')</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle"  data-toggle="dropdown" role="button" aria-expanded="false">

                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu"  role="menu">
                                            <li>
                                                <a href="{{route('profile')}}"> <i class="account_header"></i> @lang('Account') </a>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    <i class="signout_header"></i> @lang('app.logout')
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}

                                                </form>
                                            </li>
                                        </ul>

                                    </li>
                                @endif
                            </ul>

                            <form action="{{route('search')}}"  class="navbar-form navbar-right search-form" method="get">
                                <div class="form-group">
                                    <input style="border-radius: 20px 0 0 20px;" type="text" class="form-control" name="q" placeholder="@lang('app.search')">
                                    <button style="border-radius: 0 20px 20px 0;" type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> </button>
                                </div>
                            </form>


                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>

        </div>

    </div>

</div>

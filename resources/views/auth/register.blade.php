@extends('layouts.app')

@section('content')
    <title>Simstoria | Register</title>
    <section class="auth-form">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">@lang('app.register')</div>
                        <div class="panel-body">

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                            @endif

                            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">@lang('app.name')</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                    <label for="surname" class="col-md-4 control-label">@lang('Surname')</label>

                                    <div class="col-md-6">
                                        <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                                        @if ($errors->has('surname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">@lang('app.email_address')</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">@lang('Your Position')</label>

                                    <div class="col-md-6">
                                        <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" required autofocus>
                                        <alert>What is your job title or who do you want to be?</alert>
                                        @if ($errors->has('position'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>




                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">@lang('app.password')</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-4 control-label">@lang('app.confirm_password')</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>


                                @if(get_option('enable_recaptcha_registration') == 1)
                                    <div class="form-group {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="g-recaptcha" data-sitekey="{{get_option('recaptcha_site_key')}}"></div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn" style="background-color: dimgrey;color: white">
                                            @lang('app.register')
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@if(get_option('enable_recaptcha_registration') == 1)
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endif

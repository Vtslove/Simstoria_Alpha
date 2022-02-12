@extends('layouts.app')

@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css')}}">
@endsection

@section('content')
<title> Simstoria | Team Start</title>

    <div class="dashboard-wrap">
        <div class="container">
            <div id="wrapper">
                <div id="page-wrapper">
                    <div class="main_create_panel"></div>

                    @if( ! empty($title))
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header"> Create your team  </h1>
                            </div>
                        </div>
                    @endif

                    @include('admin.flash_msg')

                    <div class="row">
                        <div class="col-md-10 col-xs-12">

                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <i class="fa fa-info-circle"></i> @lang('app.feature_available_info')
                                    </div>
                                </div>

                            <form action="" id="startCampaignForm" class="form-horizontal" method="post" >
                                <div class="row">
                                @csrf

                                <legend>@lang('app.campaign_info')</legend>



                                <div class="form-group {{ $errors->has('title')? 'has-error':'' }}">
                                    <label for="title" class="col-sm-4 control-label">@lang('Name') <span class="field-required"></span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" value="{{ old('title') }}" name="title" placeholder="@lang('Name your team')">
                                        {!! $errors->has('title')? '<p class="help-block">'.$errors->first('title').'</p>':'' !!}
                                        <p style="color: #787878" class="text-info"> @lang('app.great_title_info')</p>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('short_description')? 'has-error':'' }}">
                                    <label for="short_description" class="col-sm-4 control-label">@lang('Description')</label>
                                    <div class="col-sm-8">
                                        <textarea placeholder="@lang('Describe your command and your purpose')" name="short_description" class="form-control" rows="3">{{ old('short_description') }}</textarea>
                                        {!! $errors->has('short_description')? '<p class="help-block">'.$errors->first('short_description').'</p>':'' !!}
                                    </div>
                                </div>

                                    <div class="form-group {{ $errors->has('feature_image')? 'has-error':'' }}">
                                        <label for="end_date" class="col-sm-4 control-label">@lang('app.feature_image')</label>
                                        <div class="col-sm-8">

                                            <label for="feature_image" class="img_upload"><i class="fa fa-cloud-upload"></i> </label>
                                            <input type="file" id="feature_image" name="feature_image" style="display: none;" />

                                        </div>
                                    </div>


                                <div class="form-group  {{ $errors->has('country_id')? 'has-error':'' }}">
                                    <label for="country_id" class="col-sm-4 control-label">@lang('app.country')<span class="field-required">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" name="country_id">

                                            <option value="">@lang('app.select_a_country')</option>

                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach

                                        </select>
                                        {!! $errors->has('country_id')? '<p class="help-block">'.$errors->first('country_id').'</p>':'' !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('address')? 'has-error':'' }}">
                                    <label for="address" class="col-sm-4 control-label">@lang('app.address')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="address" value="{{ old('address') }}" name="address" placeholder="@lang('app.address')">
                                        {!! $errors->has('address')? '<p class="help-block">'.$errors->first('address').'</p>':'' !!}
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn" style="border-color: darkorange;color: darkorange">@lang('app.submit_new_campaign')</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('page-js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replaceClass = 'description';
        });

        $(function () {
            $('#start_date, #end_date').datetimepicker({format: 'YYYY-MM-DD'});
        });



    </script>
@endsection

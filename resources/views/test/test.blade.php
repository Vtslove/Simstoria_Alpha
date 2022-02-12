@extends('layouts.app')

@section('title') @if(! empty($title)) {{$title}} @endif - @parent @endsection

@section('content')
    <div class="container">
        <div id="main" class="col-lg-6">
            <div class="col-lg-5" >
                <div style="margin-top: 16px;height:241px;border-radius:17px;background-color: #9f9f9f;width: 190px;" class="profile-avatar">
                    <svg style="height: 242px;width: 55px;"  width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-camera-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path fill-rule="evenodd" d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                    </svg>
                    <input type="file" id="feature_image" name="feature_image" style="display: none;" />
                    <img style="width:190px;height: 240px;margin-top: -275px;border-radius: 18px;" src="{{ $user->get_gravatar(500) }}" id="middle-avatar" class="img" />
                </div>
            </div>
            <div class="col-lg-5">
                <table class="profile-info ">
                    <div class="col-lg-4">
                        <div class="d-block" id="middle-name">
                            {{ $user->name }}
                            {{ $user->surname }}

                          <tr>
                            <th>@lang('app.name')</th>
                            <td>{{ $user->name }}</td>
                          </tr>

                          <tr>
                            <th>@lang('app.email')</th>
                            <td>{{ $user->email }}</td>
                          </tr>

                          <tr>
                            <th>@lang('app.gender')</th>
                            <td>{{ ucfirst($user->gender) }}</td>
                          </tr>

                          <tr>
                            <th>@lang('app.address')</th>
                            <td>{{ $user->address }}</td>
                          </tr>

                           <tr>
                            <th>@lang('app.country')</th>
                             <td>
                                @if($user->country)
                                    {{ $user->country->name }}
                                @endif
                             </td>
                           </tr>
                          <tr>
                            <th>@lang('app.status')</th>
                            <td>{{ $user->status_context() }}</td>
                          </tr>
                          <tr>
                            <th>@lang('app.contributed')</th>
                            <td>
                                @php $total_contributed = $user->contributed_amount(); @endphp
                                @if($total_contributed > 0)
                                    {!! get_amount($total_contributed) !!}
                                @endif
                            </td>
                          </tr>
                            </div>
                            @if( ! empty($is_user_id_view))
                                <a  href="{{route('users_edit', $user->id)}}"><i class="fa fa-pencil-square-o"></i> @lang('app.edit') </a>
                            @else
                                <a  href="{{ route('profile_edit') }}"><i class="fa fa-pencil-square-o"></i> @lang('app.edit') </a>
                            @endif
                             </div>
                          </div>
                        </div>
                    </div>
                </table>
    </div>
            </div>
       </div>







@endsection

@section('page-js')

@endsection

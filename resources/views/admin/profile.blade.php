@extends('layouts.app')



@section('content')

    <title>Simstoria | Account</title>

    <div class="container">
        <div class="upper-block ">
            <div class="left_side">
                <div class="col-lg-1">
                    @foreach($my_campaigns as $campaign)
                        <td width="70"><img style="margin-top: 40px" src="{{$campaign->feature_img_url()}}" class="img-responsive" /></td>
                    @endforeach
                </div>
                <div class="col-lg-7 ">
                    @foreach($my_campaigns as $campaign)
                    <h2>{{$campaign->title}}</h2>
                    @endforeach
                </div>
            </div>
            <div class="right_side">
                <div style="margin-top: -13px;" class="col-lg-2">
                    <h3>{{ $user->name }} {{ $user->surname }}</h3>
                    <h4>{{ $user->position }}</h4>
                </div>
                <div class="col-lg-1">
                    <img style="margin-top: 14px;height: 70px;border-radius: 50px;" class="profile_avatar" alt="{{ $user->name }}" src="{{ $user->getAvatarUrl() }}">
                </div>
            </div>
        </div>
     </div>

           <div class="container">
        <main id="main" class="col-lg-6">
            <div class="col-lg-5 text-center" >

                <div style="margin-top: 16px;height:241px;border-radius:17px;background-color: #9f9f9f;width: 190px;" class="profile-avatar">
                    <svg style="height: 242px;width: 55px;"  width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-camera-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path fill-rule="evenodd" d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                    </svg>
                            <input type="file" id="feature_image" name="feature_image" style="display: none;" />



                    <img style="width:190px;height: 240px;margin-top: -275px;border-radius: 18px;" src="{{ $user->get_gravatar(500) }}" id="middle-avatar" class="img" />
                </div>
                <table class="profile-info ">

                    <div class="col-lg-5">
                 

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
                        @if( ! empty($is_user_id_view))
                            <a  href="{{route('users_edit', $user->id)}}"><i class="fa fa-pencil-square-o"></i> @lang('app.edit') </a>
                        @else
                            <a  href="{{ route('profile_edit') }}"><i class="fa fa-pencil-square-o"></i> @lang('app.edit') </a>
                        @endif
                    </tr>
                    </div>
                </table>
            </div>
        </main>

        <div class="col-lg-2" >

        </div>

        <aside id="aside" class="col-lg-4">
            <h3>  <a  href="{{ route('contacts') }}"> Friend list </a> </h3>
            <a class="button" href="{{ route('friends') }}"> Friends</a>

            </form>

            <form action="{{route('search.results')}}" name="query" class="navbar-form navbar-right search-form" method="get">
                <div class="form-group">

                    <input style="border-radius: 20px 0 0 20px" type="text"  class="form-control" name="query" placeholder="@lang('Search friends')">
                </div>

                <button style="border-radius: 0 20px 20px 0"  type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> </button>
            </form>
            <div class="friend-info" >

                @if (Auth::user()->hasFriendRequestPending($user))
                    <p>Waiting for {{ $user->name }}</p> to accept your
                    request.</p>

                @elseif (Auth::user()->hasFriendRequestReceived($user))
                    <a href="{{ route('friend.accept', ['name' => $user->name]) }}" class="btn btn-warning">Accept friend request</a>

                @elseif (Auth::user()->isFriendsWith($user))
                    <p>You and {{ $user -> name }} are friends</p>

                       <form action="{{ route('friend.delete', ['name' => $user->name]) }}" method="post">
                           <input type="submit" value="Delete contact"  class="btn ">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                       </form>


                @elseif(Auth::user()->id !== $user->id)
                    <a href="{{ route('friend.add', ['name' => $user -> name]) }}" > Add as friend</a>

                @endif

                <h4>{{ $user->name }}'s friends</h4>

                @if(!$user->friends()->count())
                    <p>{{ $user->name }} has no friends</p>
              @else
                @foreach($user->friends() as $user)
                    @include('user.userblock')
                @endforeach
              @endif

              </aside>
            </div>
    </div>
           <!-- /#wrapper -->

    <!-- /#container -->
      <!-- /#dashboard wrap -->


    <div class="dashboard-wrap">
        <div class="container">
            <div id="wrapper">


                <div id="page-wrapper">
                    @if( ! empty($title))
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header"> @lang('Team list')  </h1>
                            </div> <!-- /.col-lg-12 -->
                        </div> <!-- /.row -->
                    @endif

                    @include('admin.flash_msg')

                    @if($my_campaigns->count() > 0)
                        <table class="table table-striped table-bordered">

                            @foreach($my_campaigns as $campaign)

                                <tr>

                                    <td width="70"><img src="{{$campaign->feature_img_url()}}" class="img-responsive" /></td>
                                    <td>{{$campaign->title}}</td>

                                    <td>
                                        @if( ! $campaign->is_ended())
                                            <a href="{{route('edit_campaign', $campaign->id)}}" style="background-color: gray;color: white"class="btn btn-md"><i>Edit</i> </a>
                                        @endif

                                        <a href="{{route('campaign_single', [$campaign->id, $campaign->slug])}}"style="background-color: darkorange;color: white" class="btn btn-md"><i>Info</i> </a>

                                    </td>

                                </tr>

                            @endforeach

                        </table>

                    @else
                        <div class="alert"><i class="fa fa-info-circle"></i> @lang('There is no teams to display') </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

@endsection

@section('page-js')

@endsection

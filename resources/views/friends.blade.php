@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')
    <div class="container">
              <div class="row">
                  <div class="col-lg-6">
                      <h3>Your friends</h3>

                      @if(!$friends->count())
                          <p>You have no friends</p>
                      @else
                          @foreach($friends as $user)
                              @include('user.userblock')
                          @endforeach
                      @endif
                  </div>
                  <p class="col-lg-6">
                      <h4>Friend requests</h4>


                      @if (!$requests->count())
                          <p>You have no friends requests</p>
                      @else
                      @foreach ($requests as $user)
                          @include ('user.userblock')
                          @endforeach
                      @endif
                  </div>
              </div>
    </div>



@stop

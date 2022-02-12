@extends('layouts.app')

 @section('content')
     <div class="row">
         <div class="col-lg-6">
             <h3>Your contacts</h3>

             @if(!$contacts->count())
                 <p>You have no friends</p>
             @else
                 @foreach($contacts as $user)
                     @include('user.userblock')
                 @endforeach
             @endif
         </div>
         <div class="col-lg-6">
             <h4>Friend requests</h4>

             @if (!$requests->count())
                 <p>You have no friends requests</p>
             @else
                @foreach($requests as $user)
                     @include('user.userblock')
                    @endforeach
             @endif
         </div>
     </div>
 @stop

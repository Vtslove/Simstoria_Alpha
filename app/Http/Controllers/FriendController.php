<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function getIndex()
    {
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();

        return view('friends')
            ->with('friends', $friends)
            ->with('requests', $requests);
    }
     public function getAdd($name)
     {
         $user = User::where('name', $name)->first();

         if (!$user) {
             return redirect()
                 ->route('admin.profile')
                 ->with('info', 'That user could not be found');
         }

         if (Auth::user()->id === $user->id) {
             return redirect()->route('home');

         }

         if (Auth::user()->hasFriendRequestPending($user) || $user->
             hasFriendRequestPending(Auth::user())) {
             return redirect()
                 ->route('admin.index', ['name' => $user->name])
                 ->with('info', 'Friend request already pending');
         }

         if (Auth::user()->isFriendsWith($user)) {
             return redirect()
                 ->route('admin.profile', ['name' => $user->name])
                 ->with('info', 'You are already friends');
         }
     }

         public function getAccept($name)
     {
         $user = User::where('name', $name)->first();

         if(!$user) {
             return redirect()
                 ->route('home')
                 ->with('info', 'That user could not be found');
         }
         if (!Auth::user()->hasFriendRequestReceived($user)) {
             return redirect()->route('home');

         }
         Auth::user()->acceptFriendRequest($user);

         return redirect()
             ->route('admin.profile', ['name' => $name])
             ->with('info', 'Friend request accepted');
     }

     public function postDelete($name)
     {
         $user = User::where('name', $name)->first();

         if (!Auth::user()->isFriendsWith($user)) {
             return redirect()->back();
         }

         Auth::user()->deleteFriend($user);

         return redirect()->back()->with('info', 'Contact was deleted');
     }

}

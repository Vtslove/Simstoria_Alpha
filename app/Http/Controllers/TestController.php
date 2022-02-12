<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;


class TestController extends Controller
{
    public function myCampaigns()
    {
        $title = trans('app.my_campaigns');
        $user = request()->user();

        $my_campaigns = $user->my_campaigns;

        $my_campaigns = Campaign::whereUserId($user->id)->orderBy('id', 'desc')->get();

        return view('test.test', compact('title', 'my_campaigns'))->with('user', $user );
    }
}

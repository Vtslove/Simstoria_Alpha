<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TeamCreate;

class TeamCreateController extends Controller
{
    public function index()
    {
        return view('SIFunctions/team_create');
    }
    public function submit(TeamRequest $req) {
       $team = new TeamCreate();
       $team->name = $req->input('name');
       $team->description = $req->input('description');

       $team->save();

       return redirect()->route('team');
    }
}

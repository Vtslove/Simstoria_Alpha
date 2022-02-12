<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return redirect()->route('profile');
        }
           $users = User::where(DB::raw("CONCAT(name, ' ')"),
           'LIKE', "%{$query}%")
               ->orWhere('name', 'LIKE', "{$query}")
           ->get();


        return view('search.results')->with('users', $users);
    }
}

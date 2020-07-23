<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $aut_user = $request->user();
        $username = NULL;
        if($aut_user){
            $username = $aut_user->username;
        }

        return view('home', compact('username'));
    }
}

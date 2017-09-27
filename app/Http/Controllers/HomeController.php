<?php

namespace App\Http\Controllers;

use App\Campaigns;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Ads= Campaigns::where('user_id', $request->user()->id)->get();

//        dd(gettype($Ads));

        return view('home',compact('Ads'));


    }
}

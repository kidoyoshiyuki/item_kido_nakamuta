<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Log::info( "----------------------------------" . url()->current() );
        return view('home');
    }
    public function index2()
    {
        Log::info( "-------------xxxxxxxxxxxxxxxxxxxx--------" . url()->current() );
        return view('home');
    }
}

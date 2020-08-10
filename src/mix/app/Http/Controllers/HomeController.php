<?php

namespace App\Http\Controllers;

use UserProfileViewService;
use HomeService;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }
    public function top()
    {
        return view('top');
    }
    public function chat()
    {
        return view('chat');
    }
}

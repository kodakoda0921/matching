<?php

namespace App\Http\Controllers;

use App\Facades\HomeService;
use App\Facades\MeetingViewService;
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
     * 検索画面を表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Log::debug("START");
        Log::debug("END");
        return view('index');
    }

    /**
     * トップページを表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function top()
    {
        Log::debug("START");
        Log::debug("END");
        return view('top');
    }

    /**
     * チャット画面を表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function chat()
    {
        Log::debug("START");
        Log::debug("END");
        return view('chat');
    }

    /**
     * チャット画面を表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function meeting()
    {
        Log::debug("START");
        $login_user = HomeService::getLoginUser();
        $meetings = MeetingViewService::getLoginUsersMeetingList($login_user->id);
        Log::debug($meetings);
        Log::debug("END");
        return view('meeting', compact('login_user', 'meetings'));
    }
}

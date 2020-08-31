<?php

namespace App\Http\Controllers;

use App\Facades\HomeService;
use App\Facades\MeetingViewService;
use App\Facades\UserProfileViewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $languagesList = MeetingViewService::getLanguagesList();
        $areasList = MeetingViewService::getAreasList();
        $count = MeetingViewService::getUnapprovedCount();
        $login_user = Auth::user();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        Log::debug("END");
        return view('index', compact('languagesList', 'areasList', 'count', 'login_user', 'profile'));
    }

    /**
     * トップページを表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function top()
    {
        Log::debug("START");
        $count = MeetingViewService::getUnapprovedCount();
        $login_user = Auth::user();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        Log::debug("END");
        return view('top', compact('count', 'login_user', 'profile'));
    }

    /**
     * チャット画面を表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function meetingChat($id)
    {
        Log::debug("START");
        $count = MeetingViewService::getUnapprovedCount();
        $login_user = Auth::user();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        $comments = MeetingViewService::meetingChatComments($id);
        Log::debug("END");
        return view('meeting_chat', compact('count', 'login_user', 'profile', 'comments'));
    }

    /**
     * 勉強会画面を表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function meeting()
    {
        Log::debug("START");
        $login_user = Auth::user();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        $count = MeetingViewService::getUnapprovedCount();
        $meetings = MeetingViewService::getLoginUsersMeetingList($login_user->id);
        $meetings_joined = MeetingViewService::getLoginUsersJoinedList($login_user->id);
        Log::debug("END");
        return view('meeting', compact('login_user', 'meetings' ,'count' ,'profile', 'meetings_joined'));
    }
}

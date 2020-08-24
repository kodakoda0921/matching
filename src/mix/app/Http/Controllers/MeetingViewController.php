<?php

namespace App\Http\Controllers;

use App\Facades\HomeService;
use App\Facades\MeetingViewService;
use App\Facades\UserProfileViewService;
use App\Models\Meetings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class MeetingViewController extends Controller
{
    /**
     * 勉強会登録画面表示
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function meetingRegistView()
    {
        Log::debug("START");
        $login_user = HomeService::getLoginUser();
        $languagesList = UserProfileViewService::getLanguagesList();
        $areasList = UserProfileViewService::getAreasList();
        Log::debug("END");
        return view('meeting_regist', compact('login_user', 'languagesList', 'areasList'));
    }
    /**
     * 勉強会登録
     *
     */
    public function meetingRegist(Request $request)
    {
        Log::debug("START");
        $request->validate([
            'title' => 'required|max:255',
            'event_date' => 'required',
            'overview' => 'max:1000',
        ]);
        MeetingViewService::regist($request);
        Log::debug("END");
        return redirect()->action('HomeController@meeting')->with(['success' => '勉強会を登録しました。']);
    }

    /**
     * 勉強会詳細画面の表示
     *
     */
    public function meetingView($id,Meetings $meetings)
    {
        Log::debug("START");
        // 認可
        $this->authorize('edit', $meetings->find($id));
        // ログインユーザの取得
        $login_user = HomeService::getLoginUser();

        $meeting = MeetingViewService::view($id);
        $language = MeetingViewService::language($meeting->language);
        $area = MeetingViewService::area($meeting->area);
        Log::debug("END");
        return view('meeting_view', compact('login_user', 'meeting', 'language', 'area'));
    }

    /**
     * 勉強会の削除
     *
     */
    public function meetingDelete($id,Meetings $meetings)
    {
        Log::debug("START");
        // 認可
        $this->authorize('edit', $meetings->find($id));
        
        MeetingViewService::delete($id);
        Log::debug("END");
        return redirect()->action('HomeController@meeting')->with(['success' => '削除しました。']);
    }
}

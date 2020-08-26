<?php

namespace App\Http\Controllers;

use App\Facades\HomeService;
use App\Facades\MeetingViewService;
use App\Facades\UserProfileViewService;
use App\Models\Meetings;
use Illuminate\Http\Request;
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

    /**
     * 勉強会の編集
     *
     */
    public function meetingEditView($id,Meetings $meetings)
    {
        Log::debug("START");
        // 認可
        $this->authorize('edit', $meetings->find($id));
        // ログインユーザの取得
        $login_user = HomeService::getLoginUser();

        $meeting = MeetingViewService::view($id);
        $languagesList = MeetingViewService::getLanguagesList();
        $areasList = MeetingViewService::getAreasList();
        Log::debug("END");
        return view('meeting_edit_view', compact('login_user', 'languagesList', 'areasList', 'meeting'));
    }

    /**
     * 勉強会編集
     *
     */
    public function meetingEdit($id,Request $request)
    {
        Log::debug("START");
        $request->validate([
            'title' => 'required|max:255',
            'language' => 'required',
            'area' => 'required',
            'event_date' => 'required',
            'overview' => 'max:1000',
            'meeting_image' => 'max:1800',
        ]);
        MeetingViewService::edit($id,$request);
        Log::debug("END");
        return redirect()->action('MeetingViewController@meetingView', ['id' => $id])->with(['success' => '勉強会を更新しました。']);
    }

    /**
     * 検索表示処理
     *
     */
    public function search(Request $request)
    {
        Log::debug("START");
        // 一覧表示
        $result = MeetingViewService::search($request);
        Log::debug("END");
        return $result;
    }

    /**
     * モーダルクリック後の処理
     *
     */
    public function searchView($id)
    {
        Log::debug("START");
        // 詳細表示
        $result = MeetingViewService::searchView($id);
        Log::debug("END");
        return $result;
    }
    
}

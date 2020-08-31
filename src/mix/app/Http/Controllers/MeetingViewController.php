<?php

namespace App\Http\Controllers;

use App\Facades\HomeService;
use App\Facades\MeetingViewService;
use App\Facades\UserProfileViewService;
use App\Models\Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $login_user = Auth::user();
        $languagesList = UserProfileViewService::getLanguagesList();
        $areasList = UserProfileViewService::getAreasList();
        $count = MeetingViewService::getUnapprovedCount();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        $meeting_chat_unread_count = MeetingViewService::getUnreadCount();
        Log::debug("END");
        return view('meeting_regist', compact('login_user', 'languagesList', 'areasList' ,'count' ,'profile','meeting_chat_unread_count'));
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
        // ログインユーザの取得
        $login_user = Auth::user();
        $meeting = MeetingViewService::view($id);
        $user = UserProfileViewService::getUser($meeting->user_id);
        $language = MeetingViewService::language($meeting->language);
        $area = MeetingViewService::area($meeting->area);
        $join_count = MeetingViewService::getJoinsCount($id);
        $count = MeetingViewService::getUnapprovedCount();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        $list = MeetingViewService::getJoinedlist($id);
        $unapprovedList = MeetingViewService::getUnapprovedlist($id);
        $meeting_chat_unread_count = MeetingViewService::getUnreadCount();
        Log::debug("END");
        return view('meeting_view', compact('login_user', 'meeting', 'language', 'area', 'count', 'list', 'unapprovedList' , 'profile', 'join_count', 'user', 'meeting_chat_unread_count'));
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
        $login_user = Auth::user();

        $meeting = MeetingViewService::view($id);
        $languagesList = MeetingViewService::getLanguagesList();
        $areasList = MeetingViewService::getAreasList();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        $count = MeetingViewService::getUnapprovedCount();
        $meeting_chat_unread_count = MeetingViewService::getUnreadCount();
        Log::debug("END");
        return view('meeting_edit_view', compact('login_user', 'languagesList', 'areasList', 'meeting', 'profile', 'count', 'meeting_chat_unread_count'));
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
            'meeting_image' => 'max:2000',
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
        $count = MeetingViewService::getJoinsCount($id);
        $exist = MeetingViewService::joinsRequestedConfirm($id);
        Log::debug("END");
        return (["res" =>$result, "count" => $count, "exist" => $exist]);
    }

    /**
     * 勉強会参加申請処理
     *
     */
    public function meetJoinRequest($id)
    {
        Log::debug("START");
        // 申請処理
        $result = MeetingViewService::meetJoinRequest($id);
        Log::debug("END");
        return $result;
    }

    /**
     * 勉強会参加承認処理
     *
     */
    public function meetingApproval($join_id)
    {
        Log::debug("START");
        // 申請処理
        $meeting_id = MeetingViewService::meetingApproval($join_id);
        Log::debug("END");
        return redirect()->action('MeetingViewController@meetingView', ['id' => $meeting_id])->with(['success' => '参加を承認しました。']);
    }
    
    /**
     * 勉強会参加否認処理
     *
     */
    public function meetingUnapproval($join_id)
    {
        Log::debug("START");
        // 申請処理
        $meeting_id = MeetingViewService::meetingUnapproval($join_id);
        Log::debug("END");
        return redirect()->action('MeetingViewController@meetingView', ['id' => $meeting_id])->with(['success' => '参加を否認しました。']);
    }
    
}

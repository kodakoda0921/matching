<?php

namespace App\Services;

use App\Models\Joins;
use App\Repositories\Meetings\MeetingsRepositoryInterface;
use App\Repositories\Languages\LanguagesRepositoryInterface;
use App\Repositories\Areas\AreasRepositoryInterface;
use App\Repositories\Joins\JoinsRepositoryInterface;
use App\Repositories\MeetingComments\MeetingCommentsRepositoryInterface;
use App\Repositories\MeetingReads\MeetingReadsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeetingViewService
{

    public function __construct(
        MeetingsRepositoryInterface $meetings,
        LanguagesRepositoryInterface $languages,
        AreasRepositoryInterface $areas,
        JoinsRepositoryInterface $joins,
        MeetingCommentsRepositoryInterface $meetingComments,
        MeetingReadsRepositoryInterface $meetingReads
    ) {
        $this->meetings = $meetings;
        $this->languages = $languages;
        $this->areas = $areas;
        $this->joins = $joins;
        $this->meetingComments = $meetingComments;
        $this->meetingReads = $meetingReads;
    }

    /**
     * ユーザプロフィールの更新処理
     *
     * @param Request $request
     * @return void
     */
    public function regist(Request $request)
    {
        Log::debug("START");
        $this->meetings->regist($request);
        Log::debug("END");
    }

    /**
     * ログインユーザが主宰の勉強会一覧取得
     *
     * @param int $login_user
     * @return $result
     */
    public function getLoginUsersMeetingList($login_user)
    {
        Log::debug("START");
        $result = $this->meetings->getLoginUsersMeetingList($login_user);
        $array = [];
        $array_read = [];
        foreach ($result as $rec) {
            $a = $this->joins->getUnapprovedCountById($rec->id);
            array_push($array, $a);
        };
        foreach ($result as $rec) {
            $a = $this->meetingReads->getUnreadCountById($rec->id);
            array_push($array_read, $a);
        };
        Log::debug($array_read);
        Log::debug("END");
        return [$result, $array, $array_read];
    }

    /**
     * ログインユーザが参加している勉強会一覧取得
     *
     * @param int $id
     * @return $result
     */
    public function getLoginUsersJoinedList($login_user)
    {
        Log::debug("START");
        $result = $this->joins->getLoginUsersJoinedList($login_user);
        $array_read = [];
        foreach ($result as $rec) {
            $a = $this->meetingReads->getUnreadCountById($rec->meetings->id);
            array_push($array_read, $a);
        };
        Log::debug("END");
        return  [$result, $array_read];
    }

    /**
     * ユーザプロフィールの更新処理
     *
     * @param int $id
     * @return $result
     */
    public function view($id)
    {
        Log::debug("START");
        $result = $this->meetings->view($id);
        Log::debug("END");
        return $result;
    }

    /**
     * 言語取得
     *
     * @param int $language_id
     * @return $result
     */
    public function language($language_id)
    {
        Log::debug("START");
        $result = $this->languages->view($language_id);
        Log::debug("END");
        return $result;
    }

    /**
     * 所在地取得
     *
     * @param int $area_id
     * @return $result
     */
    public function area($area_id)
    {
        Log::debug("START");
        $result = $this->areas->view($area_id);
        Log::debug("END");
        return $result;
    }

    /**
     * 勉強会削除
     *
     * @param int $id
     * @return $result
     */
    public function delete($id)
    {
        Log::debug("START");
        $query = $this->meetings->delete($id);
        Log::debug("END");
    }

    /**
     * 言語一覧取得
     *
     * @return object $result
     */
    public function getLanguagesList()
    {
        Log::debug("START");
        $list = $this->languages->getLanguagesList();
        $languagesList = $list->pluck('language');
        Log::debug("END");
        return $languagesList;
    }

    /**
     * 言語一覧取得
     *
     * @return object $result
     */
    public function getAreasList()
    {
        Log::debug("START");
        $list = $this->areas->getAreasList();
        $areasList = $list->pluck('area');
        Log::debug("END");
        return $areasList;
    }

    /**
     * ユーザプロフィールの更新処理
     *
     * @param Request $request
     * @return void
     */
    public function edit($id, Request $request)
    {
        Log::debug("START");
        $this->meetings->edit($id, $request);
        Log::debug("END");
    }

    /**
     * ユーザテーブルから一覧取得
     *
     * @param Request $request
     * @return object $ret
     */
    public function search(Request $request)
    {
        Log::debug("START");

        // 全件取得
        $records = $this->meetings->findByForm($request);
        $ret = $this->transform($records);
        Log::debug("END");
        return $ret;
    }

    /**
     * taburator出力のため整形
     *
     * @param object $ret_temp
     * @return object $json
     */
    private function transform($ret_temp)
    {
        Log::debug("START");
        $unregistered = '-';
        $result = [];
        foreach ($ret_temp as $rec) {
            //$license_type_validitication = $unregistered;
            array_push(
                $result,
                [
                    'id' => !empty($rec->id) ? $rec->id : $unregistered,
                    'title' => !empty($rec->title) ? $rec->title : $unregistered,
                    'event_date' => !empty($rec->event_date) ? $rec->event_date : $unregistered,
                    'language' => !empty($rec->languages->language) ? $rec->languages->language : $unregistered,
                    'area' => !empty($rec->areas->area) ? $rec->areas->area : $unregistered,
                    'user_name' => !empty($rec->users->name) ? $rec->users->name : $unregistered,
                    'overview' => !empty($rec->overview) ? $rec->overview : $unregistered
                ]
            );
        }
        $json = ['data' => $result];
        Log::debug("END");
        return $json;
    }

    /**
     * ユーザテーブルから一覧取得
     *
     * @param int $id
     * @return object $ret
     */
    public function searchView($id)
    {
        Log::debug("START");

        // 全件取得
        $return = $this->meetings->searchView($id);
        Log::debug("END");
        return $return;
    }

    /**
     * 参加承認済件数を取得
     *
     * @param int $meeting_id
     * @return object $ret
     */
    public function getJoinsCount($meeting_id)
    {
        Log::debug("START");

        // 件数取得
        $return = $this->joins->getJoinsCount($meeting_id);
        Log::debug("END");
        return $return;
    }

    /**
     * 参加承認申請済か確認
     *
     * @param int $meeting_id
     * @return object $ret
     */
    public function joinsRequestedConfirm($meeting_id)
    {
        Log::debug("START");

        // 件数取得
        $return = $this->joins->joinsRequestedConfirm($meeting_id);
        Log::debug("END");
        return $return;
    }

    /**
     * 参加申請を行う
     *
     * @param int $meeting_id
     * @return object $ret
     */
    public function meetJoinRequest($meeting_id)
    {
        Log::debug("START");

        // 件数取得
        $return = $this->joins->meetJoinRequest($meeting_id);
        Log::debug("END");
        return $return;
    }

    /**
     * 参加承認済の一覧取得
     *
     * @param int $meeting_id
     * @return object $ret
     */
    public function getJoinedlist($meeting_id)
    {
        Log::debug("START");

        // 件数取得
        $return = $this->joins->getJoinedlist($meeting_id);
        Log::debug("END");
        return $return;
    }

    /**
     * 未承認件数を取得
     *
     * @return object $ret
     */
    public function getUnapprovedCount()
    {
        Log::debug("START");

        // 件数取得
        $return = $this->joins->getUnapprovedCount();
        Log::debug("END");
        return $return;
    }

    /**
     * 未承認の一覧を取得
     *
     * @param int $meeting_id
     * @return object $ret
     */
    public function getUnapprovedlist($meeting_id)
    {
        Log::debug("START");

        // 未承認のリスト取得
        $return = $this->joins->getUnapprovedlist($meeting_id);
        Log::debug("END");
        return $return;
    }

    /**
     * 承認済ステータスへ変更
     *
     * @param int $join_id
     * @return object $ret
     */
    public function meetingApproval($join_id)
    {
        Log::debug("START");

        // 未承認のリスト取得
        $meeting_id = $this->joins->meetingApproval($join_id);
        Log::debug("END");
        return $meeting_id;
    }

    /**
     * 否認ステータスへ変更
     *
     * @param int $join_id
     * @return object $ret
     */
    public function meetingUnapproval($join_id)
    {
        Log::debug("START");

        // 未承認のリスト取得
        $meeting_id = $this->joins->meetingUnapproval($join_id);
        Log::debug("END");
        return $meeting_id;
    }

    /**
     * チャットIDの取得
     *
     * @param int $meeting_id
     * @return object $ret
     */
    public function meetingChatComments($meeting_id)
    {
        Log::debug("START");

        // 未承認のリスト取得
        $result = $this->meetingComments->meetingChatComments($meeting_id);
        Log::debug("END");
        return $result;
    }


    /**
     * チャットIDの取得
     *
     * @param int $meeting_id
     * @return object $ret
     */
    public function meetingChatCommentsPut(Request $request)
    {
        Log::debug("START");
        // 未承認のリスト取得
        $joined_list = $this->getJoinedlist($request->meeting_id);
        $result = $this->meetingComments->meetingChatCommentsPut($request, $joined_list);
        Log::debug("END");
        return $result;
    }

    /**
     * ログインユーザの勉強会チャットの全体通知
     *
     * @return $result
     */
    public function getUnreadCount()
    {
        Log::debug("START");
        $result = $this->meetingReads->getUnreadCount();
        Log::debug("END");
        return $result;
    }

    /**
     * 勉強会チャットの勉強会別通知
     *
     * @param int $meeting_id
     * @return $result
     */
    public function getUnreadCountById($meeting_id)
    {
        Log::debug("START");
        $result = $this->meetingReads->getUnreadCountById($meeting_id);
        Log::debug("END");
        return $result;
    }

    /**
     * チャット権限有無チェック
     *
     * @param int $id
     * @return $result
     */
    public function authorizedCheck($id)
    {
        $result = $this->joins->authorizedCheck($id);
        return $result;
    }
}

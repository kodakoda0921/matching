<?php

namespace App\Repositories\Joins;

use App\Repositories\Joins\JoinsRepositoryInterface;
use App\Models\Joins;
use App\Models\MeetingComments;
use App\Models\MeetingReads;
use App\Models\Meetings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JoinsRepository implements JoinsRepositoryInterface
{
    public function __construct(Joins $joins, Meetings $meetings, MeetingComments $meeting_comments, MeetingReads $meeting_reads)
    {
        $this->joins = $joins;
        $this->meetings = $meetings;
        $this->meeting_comments = $meeting_comments;
        $this->meeting_reads = $meeting_reads;
    }

    /**
     * 参加承認済件数の取得
     * 
     * @return $result
     */
    public function getJoinsCount($meeting_id)
    {
        Log::debug("START");
        $result = $this->joins->where('meeting_id', '=', $meeting_id)->where('approval', '=', 1)->count();
        Log::debug("END");
        return $result;
    }

    /**
     * 参加承認申請済か確認
     * 
     * @return $result
     */
    public function joinsRequestedConfirm($meeting_id)
    {
        Log::debug("START");
        $id = Auth::id();
        $check = $this->joins->where('user_id', '=', $id)->where('meeting_id', '=', $meeting_id)->exists();
        Log::debug("END");
        return $check;
    }

    /**
     * 参加申込処理
     * 
     * @return $result
     */
    public function meetJoinRequest($meeting_id)
    {
        Log::debug("START");
        $id = Auth::id();
        $check = $this->joins->where('user_id', '=', $id)->where('meeting_id', '=', $meeting_id)->exists();;
        $query = $this->meetings->find($meeting_id);
        if ($check) {
            Log::debug("END");
            return '申請に失敗しました。この勉強会は既に申請済です。';
        } else if ($query->user_id == $id) {
            Log::debug("END");
            return '申請に失敗しました。自分が主宰した勉強会には申請できません。';
        } else {
            $this->joins->create([
                'user_id' => $id,
                'meeting_id' => $meeting_id,
                'approval' => 0,
            ]);
            Log::debug("END");
            return '申請が完了しました。';
        }
    }

    /**
     * 参加承認済の一覧取得
     * 
     * @return $result
     */
    public function getJoinedlist($meeting_id)
    {
        Log::debug("START");
        $result = $this->joins->where('meeting_id', '=', $meeting_id)->where('approval', '=', 1)->with('users')->get();
        Log::debug("END");
        return $result;
    }

    /**
     * 自分が主宰している勉強会の未承認件数の取得
     * 
     * @return $result
     */
    public function getUnapprovedCount()
    {
        Log::debug("START");
        $result = $this->joins->where('approval', '=', 0)->whereHas('meetings', function ($query) {
            $query->where('user_id', '=', Auth::id());
        })->count();
        Log::debug("END");
        return $result;
    }

    /**
     * meeting_id別の未承認件数の取得
     * 
     * @return $result
     */
    public function getUnapprovedCountById($meeting_id)
    {
        Log::debug("START");
        $result = $this->joins->where('meeting_id', '=', $meeting_id)->where('approval', '=', 0)->count();
        Log::debug("END");
        return $result;
    }

    /**
     * 未承認の一覧取得
     * 
     * @return $result
     */
    public function getUnapprovedlist($meeting_id)
    {
        Log::debug("START");
        $result = $this->joins->where('meeting_id', '=', $meeting_id)->where('approval', '=', 0)->with('users')->get();
        Log::debug("END");
        return $result;
    }

    /**
     * 承認済へステータス変更
     * 
     * @return $result
     */
    public function meetingApproval($join_id)
    {
        Log::debug("START");
        $query = $this->joins->find($join_id);
        $query->update([
            'approval' => 1,
        ]);
        $q = $this->meeting_comments->where('meeting_id', '=', $query->meeting_id)->get();
        foreach ($q as $rec) {
            $this->meeting_reads->create([
                'user_id' => $query->user_id,
                'meeting_comment_id' => $rec->id,
                'read_flg' => 0,
            ]);
            Log::debug($query->user_id);
        }
        Log::debug("END");
        return $query->meeting_id;
    }

    /**
     * 否認へステータス変更
     * 
     * @return $result
     */
    public function meetingUnapproval($join_id)
    {
        Log::debug("START");
        $query = $this->joins->find($join_id);
        $query->update([
            'approval' => 2,
        ]);
        Log::debug("END");
        return $query->meeting_id;
    }

    /**
     * ログインユーザが参加している勉強会一覧取得
     * 
     * @param int $login_user
     */
    public function getLoginUsersJoinedList($login_user)
    {
        DB::enableQueryLog();
        $result = $this->joins->where('user_id', '=', $login_user)->where('approval', '=', 1)->with('meetings')->get();
        Log::debug(DB::getQueryLog());
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
        $query = $this->joins->where('meeting_id', '=', $id)->get();
        if ($query->isEmpty()) {
            return false;
        } else {
            foreach ($query as $q) {
                if ($q->user_id == Auth::id()) {
                    return true;
                }
            }
            return false;
        }
    }
}

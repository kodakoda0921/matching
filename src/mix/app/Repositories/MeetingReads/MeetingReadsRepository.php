<?php

namespace App\Repositories\MeetingReads;

use App\Repositories\MeetingReads\MeetingReadsRepositoryInterface;
use App\Models\MeetingReads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MeetingReadsRepository implements MeetingReadsRepositoryInterface
{
    public function __construct(MeetingReads $meetingReads)
    {
        $this->meetingReads = $meetingReads;
    }

    /**
     * 自分が主宰している勉強会の未承認件数の取得
     * 
     * @return $result
     */
    public function getUnreadCount()
    {
        Log::debug("START");
        $result = $this->meetingReads->where('user_id', '=', Auth::id())->where('read_flg', '=', 0)
            ->count();
        Log::debug("END");
        return $result;
    }

    /**
     * meeting_id別の未承認件数の取得
     * 
     * @return $result
     */
    public function getUnreadCountById($meeting_id)
    {
        Log::debug("START");
        $result = $this->meetingReads->where('user_id', '=', Auth::id())
            ->where('read_flg', '=', 0)
            ->whereHas('meeting_comments', function ($query) use ($meeting_id) {
                $query->where('meeting_id', '=', $meeting_id);
                Log::debug($meeting_id);
            })
            ->count();

        Log::debug("END");
        return $result;
    }
}

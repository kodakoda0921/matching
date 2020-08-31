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
        $result = $this->meetingReads->where('user_id', '=', Auth::id())->whereHas('meeting_comments', function ($query) {
            $query->where('read_flg', '=', 0);
        })->count();
        Log::debug("END");
        return $result;
    }
}

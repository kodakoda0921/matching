<?php

namespace App\Repositories\MeetingComments;

use App\Repositories\MeetingComments\MeetingCommentsRepositoryInterface;
use App\Models\MeetingComments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MeetingCommentsRepository implements MeetingCommentsRepositoryInterface
{
    public function __construct(MeetingComments $meetingComments)
    {
        $this->meetingComments = $meetingComments;
    }

    /**
     * チャット情報の取得
     * 
     * @param int $meeting_id
     */
    public function meetingChatComments($meeting_id)
    {
        $result = $this->meetingComments->where('meeting_id', '=', $meeting_id)->with('users')->with('users.userProfiles')->orderBy('update_timestamp', 'desc')->get();
        Log::debug($result);
        return $result;
    }

    /**
     * チャットコメントの追加
     * 
     * @param Request $request
     */
    public function meetingChatCommentsPut(Request $request)
    {
        $this->meetingComments->create([
            'user_id' => Auth::id(),
            'meeting_id' => $request->meeting_id,
            'comment' => $request->comment
        ]);
    }
    
}

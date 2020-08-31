<?php

namespace App\Repositories\MeetingComments;

use App\Repositories\MeetingComments\MeetingCommentsRepositoryInterface;
use App\Models\MeetingComments;
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
        $result = $this->meetingComments->where('meeting_id', '=', $meeting_id)->with('users')->with('users.userProfiles')->orderBy('update_timestamp', 'asc')->get();
        Log::debug($result);
        return $result;
    }

    /**
     * チャットコメントの追加
     * 
     * @param Request $request
     */
    public function meetingChatCommentsPut($request)
    {
        $result = $this->meetingComments->create([
            'user_id' => $request->user_id,
            'meeting_id' => $request->meeting_id,
            'comment' => $request->comment
        ]);
        return redirect()->route('home');
    }
    
}

<?php

namespace App\Repositories\MeetingComments;

use App\Repositories\MeetingComments\MeetingCommentsRepositoryInterface;
use App\Models\MeetingComments;
use App\Models\MeetingReads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MeetingCommentsRepository implements MeetingCommentsRepositoryInterface
{
    public function __construct(MeetingComments $meetingComments, MeetingReads $meetingReads)
    {
        $this->meetingComments = $meetingComments;
        $this->meetingReads = $meetingReads;
    }

    /**
     * チャット情報の取得
     * 
     * @param int $meeting_id
     */
    public function meetingChatComments($meeting_id)
    {
        $result = $this->meetingComments
            ->where('meeting_id', '=', $meeting_id)
            ->with('users')
            ->with('users.userProfiles')
            ->with('meetingReads')
            ->orderBy('update_timestamp', 'desc')
            ->get();
        $read_rec = $this->meetingReads
            ->where('user_id', '=', Auth::id())
            ->whereHas('meeting_comments', function ($q) use ($meeting_id) {
                $q->where('read_flg', '=', 0);
                $q->where('meeting_id', '=', $meeting_id);
            })->get();
        foreach ($read_rec as $rec) {
                $query = $this->meetingReads->find($rec->id);
                $query->update([
                    'read_flg' => 1,
                ]);
        }
        return $result;
    }

    /**
     * チャットコメントの追加
     * 
     * @param Request $request
     */
    public function meetingChatCommentsPut(Request $request, $joined_list)
    {
        if ($request->comment != null) {
            $new = $this->meetingComments->create([
                'user_id' => Auth::id(),
                'meeting_id' => $request->meeting_id,
                'comment' => $request->comment
            ]);
            foreach ($joined_list as $rec) {
                if (Auth::id() != $rec->user_id) {
                    $this->meetingReads->create([
                        'user_id' => $rec->user_id,
                        'meeting_comment_id' => $new->id,
                        'read_flg' => 0,
                    ]);
                }
            }
            return "送信しました";
        } else {
            return "空白の入力はできません";
        }
    }
}

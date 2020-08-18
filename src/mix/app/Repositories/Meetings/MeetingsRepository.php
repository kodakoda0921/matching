<?php

namespace App\Repositories\Meetings;

use App\Repositories\Meetings\MeetingsRepositoryInterface;
use App\Models\Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MeetingsRepository implements MeetingsRepositoryInterface
{
    public function __construct(Meetings $meetings)
    {
        $this->meetings = $meetings;
    }

    /**
     * 勉強会新規登録処理
     * 
     * @param $request
     */
    public function regist($request)
    {
        $user = Auth::user();
        if ($request->file('meeting_image') == null) {
            $picture = null;
        } else {
            $path = $request->file('meeting_image')->store('public/img');
            $picture = basename($path);
        }
        $this->meetings->create(
            [
                'user_id' => $user->id,
                'title' => $request->title,
                'picture' => $picture,
                'language' => $request->language,
                'area' => $request->area,
                'overview' => $request->overview,
                'event_date' => $request->event_date
            ]
        );
    }

    /**
     * ログインユーザ主催の勉強会一覧取得
     * 
     * @param int $login_user
     */
    public function getLoginUsersMeetingList($login_user)
    {
        $result = $this->meetings->where('user_id' , '=', $login_user)->get();
        return $result;
    }
}

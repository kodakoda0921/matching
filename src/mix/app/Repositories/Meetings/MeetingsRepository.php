<?php

namespace App\Repositories\Meetings;

use App\Repositories\Meetings\MeetingsRepositoryInterface;
use App\Models\Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    /**
     * 勉強会の詳細取得
     * 
     * @param int $id
     */
    public function view($id)
    {
        $result = $this->meetings->find($id);
        return $result;
    }

    /**
     * 勉強会の削除
     * 
     * @param int $id
     */
    public function delete($id)
    {
        $query = $this->meetings->find($id);
        if ($query->picture != null) {
            Storage::delete('public/img/' . $query->picture);
        }
        $query->delete();
    }

    /**
     * 勉強会新規編集処理
     * 
     * @param $request
     */
    public function edit($id,$request)
    {
        $query = $this->meetings->find($id);
        if ($request->file('meeting_image') == null) {
            $picture = $query->picture;
        } else {
            Storage::delete('public/img/'.$query->picture);
            $path = $request->file('meeting_image')->store('public/img');
            $picture = basename($path);
        }
        $query=$this->meetings->find($id);
        $query->update(
            [
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
     * 選択されたレコードを取得
     *
     * @return object $result
     */
    public function findByForm($request)
    {
        Log::debug("START");
        $query = $this->meetings->query();

        if ($request->language != null){
            $query->where('language', '=', $request->language);
        }
        if ($request->area != null) {
            $query->where('area', '=', $request->area);
        }
        Log::debug("END");
        DB::enableQueryLog();
        $result = $query->with('users')->with('languages')->with('areas')->get();
        Log::debug(DB::getQueryLog());
        return $result;
    }
    
    /**
     * 選択されたレコードを取得
     *
     * @return object $result
     */
    public function searchView($id)
    {
        Log::debug("START");
        $result = $this->meetings->with('users')->with('languages')->with('areas')->find($id);
        Log::debug("END");
        return $result;
    }
}

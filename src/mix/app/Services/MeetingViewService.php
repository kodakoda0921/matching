<?php

namespace App\Services;

use App\Repositories\Meetings\MeetingsRepositoryInterface;
use App\Repositories\Languages\LanguagesRepositoryInterface;
use App\Repositories\Areas\AreasRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeetingViewService
{

    public function __construct
    (
        MeetingsRepositoryInterface $meetings,
        LanguagesRepositoryInterface $languages,
        AreasRepositoryInterface $areas
    )
    {
        $this->meetings = $meetings;
        $this->languages = $languages;
        $this->areas = $areas;
    }

    /**
     * ユーザプロフィールの更新処理
     *
     * @param Request $request
     * @return void
     */
    public function regist(Request $request)
    {
        $this->meetings->regist($request);
    }

    /**
     * ユーザプロフィールの更新処理
     *
     * @param Request $request
     * @return $result
     */
    public function getLoginUsersMeetingList($login_user)
    {
        $result = $this->meetings->getLoginUsersMeetingList($login_user);
        return $result;
    }
    
}
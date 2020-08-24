<?php

namespace App\Services;

use App\Repositories\Meetings\MeetingsRepositoryInterface;
use App\Repositories\Languages\LanguagesRepositoryInterface;
use App\Repositories\Areas\AreasRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MeetingViewService
{

    public function __construct(
        MeetingsRepositoryInterface $meetings,
        LanguagesRepositoryInterface $languages,
        AreasRepositoryInterface $areas
    ) {
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
        Log::debug("START");
        $this->meetings->regist($request);
        Log::debug("END");
    }

    /**
     * ユーザプロフィールの更新処理
     *
     * @param Request $request
     * @return $result
     */
    public function getLoginUsersMeetingList($login_user)
    {
        Log::debug("START");
        $result = $this->meetings->getLoginUsersMeetingList($login_user);
        Log::debug("END");
        return $result;
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
}

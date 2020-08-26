<?php

namespace App\Services;

use App\Repositories\Meetings\MeetingsRepositoryInterface;
use App\Repositories\Languages\LanguagesRepositoryInterface;
use App\Repositories\Areas\AreasRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

    /**
     * 言語一覧取得
     *
     * @return object $result
     */
    public function getLanguagesList()
    {
        Log::debug("START");
        $list = $this->languages->getLanguagesList();
        $languagesList = $list->pluck('language');
        Log::debug("END");
        return $languagesList;
    }

    /**
     * 言語一覧取得
     *
     * @return object $result
     */
    public function getAreasList()
    {
        Log::debug("START");
        $list = $this->areas->getAreasList();
        $areasList = $list->pluck('area');
        Log::debug("END");
        return $areasList;
    }

    /**
     * ユーザプロフィールの更新処理
     *
     * @param Request $request
     * @return void
     */
    public function edit($id,Request $request)
    {
        Log::debug("START");
        $this->meetings->edit($id,$request);
        Log::debug("END");
    }

    /**
     * ユーザテーブルから一覧取得
     *
     * @param Request $request
     * @return object $ret
     */
    public function search(Request $request)
    {
        Log::debug("START");

        // 全件取得
        $records = $this->meetings->findByForm($request);
        $ret = $this->transform($records);
        Log::debug("END");
        return $ret;
    }

    /**
     * taburator出力のため整形
     *
     * @param object $ret_temp
     * @return object $json
     */
    private function transform($ret_temp)
    {
        Log::debug("START");
        Log::debug($ret_temp);
        $unregistered = '-';
        $result = [];
        foreach ($ret_temp as $rec) {
            //$license_type_validitication = $unregistered;
            array_push(
                $result,
                [
                    'id' => !empty($rec->id) ? $rec->id : $unregistered,
                    'title' => !empty($rec->title) ? $rec->title : $unregistered,
                    'event_date' => !empty($rec->event_date) ? $rec->event_date : $unregistered,
                    'language' => !empty($rec->languages->language) ? $rec->languages->language : $unregistered,
                    'area' => !empty($rec->areas->area) ? $rec->areas->area : $unregistered,
                    'user_name' => !empty($rec->users->name) ? $rec->users->name : $unregistered,
                ]
            );
        }
        $json = ['data' => $result];
        Log::debug("END");
        return $json;
    }

}

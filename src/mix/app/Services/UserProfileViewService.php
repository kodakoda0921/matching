<?php

namespace App\Services;

use App\Repositories\UserProfile\UserProfileRepositoryInterface;
use App\Repositories\Languages\LanguagesRepositoryInterface;
use App\Repositories\Areas\AreasRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserProfileViewService
{

    public function __construct
    (
        UserProfileRepositoryInterface $UserProfile,
        LanguagesRepositoryInterface $languages,
        AreasRepositoryInterface $areas
    )
    {
        $this->userProfile = $UserProfile;
        $this->languages = $languages;
        $this->areas = $areas;
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
        $records = $this->userProfile->findByForm($request);
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
        $unregistered = '-';
        $result = [];
        foreach ($ret_temp as $rec) {
            //$license_type_validitication = $unregistered;
            array_push(
                $result,
                [
                    'id' => !empty($rec->users->id) ? $rec->users->id : $unregistered,
                    'user_name' => !empty($rec->users->name) ? $rec->users->name : $unregistered,
                    'singer' => !empty($rec->singer) ? $rec->singer : $unregistered,
                    'mixer' => !empty($rec->mixer) ? $rec->mixer : $unregistered

                ]
            );
        }
        $json = ['data' => $result];
        Log::debug("END");
        return $json;
    }

    /**
     * ユーザプロフィールの更新処理
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $this->userProfile->update($request);
    }

    /**
     * ユーザプロフィールの取得
     *
     * @param int $id
     * @return object $result
     */
    public function getUserProfile($id)
    {
        Log::debug("START");
        $result = $this->userProfile->getUserProfile($id);
        Log::debug("END");
        return $result;
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
}

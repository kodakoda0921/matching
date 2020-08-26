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

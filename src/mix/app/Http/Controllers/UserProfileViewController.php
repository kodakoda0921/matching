<?php

namespace App\Http\Controllers;

use App\Facades\UserProfileViewService;
use App\Facades\HomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserProfileViewController extends Controller
{
    /**
     * プロフィール表示
     *
     */
    public function UserProfile()
    {
        Log::debug("START");
        $login_user = HomeService::getLoginUser();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        $languagesList = UserProfileViewService::getLanguagesList();
        $areasList = UserProfileViewService::getAreasList();
        Log::debug("END");
        return view('user_profile',compact('login_user', 'profile', 'languagesList', 'areasList'));
    }

    /**
     * 検索表示処理
     *
     */
    public function search(Request $request)
    {
        Log::debug("START");
        // 点呼実績一覧取得
        $result = UserProfileViewService::search($request);
        Log::debug("END");
        return $result;
    }

    /**
     * プロフィールの更新
     *
     */
    public function profileUpdate(Request $request)
    {
        Log::debug("START");
        $request->validate([
            'sex' => 'required',
            'language' => 'required',
            'area' => 'required',
            'introduction' => 'max:1000',
            'profile_image' => 'max:1800',
        ]);
        UserProfileViewService::update($request);
        Log::debug("END");
        return redirect()->action('HomeController@top')->with(['success' => 'プロフィールを更新しました。']);
    }
}

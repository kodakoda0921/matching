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
        $login_user = HomeService::getLoginUser();
        $profile = UserProfileViewService::getUserProfile($login_user->id);
        $languagesList = UserProfileViewService::getLanguagesList();
        $list = $languagesList->pluck('language');
        Log::debug($list);
        return view('user_profile',compact('login_user', 'profile', 'list'));
    }

    /**
     * 検索表示処理
     *
     */
    public function search(Request $request)
    {
        Log::info("START");
        // 点呼実績一覧取得
        $result = UserProfileViewService::search($request);
        Log::info("END");
        return $result;
    }

    /**
     * ジョブ更新
     *
     */
    public function profileUpdate(Request $request)
    {
        Log::debug($request);
        UserProfileViewService::update($request);
        return redirect()->action('HomeController@top');
    }
}

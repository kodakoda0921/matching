<?php

namespace App\Http\Controllers;

use App\Facades\UserProfileViewService;
use App\Facades\HomeService;
use App\Facades\MeetingViewService;
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
        $count = MeetingViewService::getUnapprovedCount();

        Log::debug("END");
        return view('user_profile',compact('login_user', 'profile', 'languagesList', 'areasList', 'count'));
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
            'profile_image' => 'max:2000',
        ]);
        UserProfileViewService::update($request);
        Log::debug("END");
        return redirect()->action('HomeController@top')->with(['success' => 'プロフィールを更新しました。']);
    }
}

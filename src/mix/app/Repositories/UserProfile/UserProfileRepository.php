<?php

namespace App\Repositories\UserProfile;

use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    /**
     * @param object $t_user_plan
     *
     */
    public function __construct(UserProfile $userProfile)
    {
        $this->userProfile = $userProfile;
    }

    /**
     * ジョブの登録または更新
     *
     * @param $request
     * @return void
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $user_profile = $this->userProfile->where('user_id', '=', $user->id)->first();
        $query = $this->userProfile->query();
        if ($request->file('profile_image') == null){
            $picture = $user_profile->picture;
        } else {
            Storage::delete('public/img/'.$user_profile->picture);
            $path = $request->file('profile_image')->store('public/img');
            $picture = basename($path);
        }
        $query->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'user_id' => $user->id,
                'sex' => $request->sex,
                'picture' => $picture,
                'language' => $request->language,
                'introduction' => $request->introduction,
                'area' => $request->area,
            ]
        );
    }

    /**
     * ユーザプロフィールの取得
     *
     * @param int $id
     * @return object $result
     */
    public function getUserProfile($id)
    {
        $result = $this->userProfile->whereNotNull('id')->where('user_id','=',$id)->with('languages')->first();
        return $result;
    }
}

<?php

namespace App\Repositories\UserProfile;

use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    protected $t_user_plan;

    /**
     * @param object $t_user_plan
     *
     */
    public function __construct(UserProfile $userProfile)
    {
        $this->userProfile = $userProfile;
    }

    /**
     * 選択されたレコードを取得
     *
     * @return object $result
     */
    public function findByForm($request)
    {
        Log::debug("START");
        $query = $this->userProfile->query();

        if (!empty($request->singer)) {
            $query->where('singer', '=', true);
        }
        if (!empty($request->mixer)) {
            $query->where('mixer', '=', true);
        }
        Log::debug("END");
        DB::enableQueryLog();
        $result = $query->with('users')->get();
        Log::debug(DB::getQueryLog());
        return $result;
    }

    /**
     * ジョブの登録または更新
     *
     * @param $request
     * @return void
     */
    public function update(Request $request)
    {
        $query = $this->userProfile->query();
        $user = Auth::user();
        $query->updateOrCreate(
            [
                'id' => $user->id,
            ],
            [
                'id' => $user->id,
                'singer' => $request->singer,
                'mixer' => $request->mixer,
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
        $result = $this->userProfile->whereNotNull('id')->where('id','=',$id)->first();
        return $result;
    }
}

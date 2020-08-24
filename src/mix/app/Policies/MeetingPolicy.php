<?php

namespace App\Policies;

use App\Models\Meetings;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class MeetingPolicy
{
    use HandlesAuthorization;

    /**
     * 閲覧権限（ユーザが同じ場合のみ閲覧可能）
     *
     * @param  User  $user
     * @param  Meetings  $meetings
     * @return boolean
     */
    public function edit(User $user, Meetings $meetings)
    {
        return $user->id == $meetings->user_id;
    }
}

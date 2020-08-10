<?php
namespace App\Repositories\User;

use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getLoginUser()
    {
        $user = Auth::user();
        $result = $this->user->find($user->id);
        return $result;
    }
}

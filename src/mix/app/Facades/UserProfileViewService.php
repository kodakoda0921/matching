<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserProfileViewService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserProfileViewService';
    }
}

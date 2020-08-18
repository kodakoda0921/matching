<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MeetingViewService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MeetingViewService';
    }
}

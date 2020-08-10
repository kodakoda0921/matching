<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class HomeService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'HomeService';
    }
}

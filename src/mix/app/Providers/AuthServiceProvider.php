<?php

namespace App\Providers;

use App\Models\Joins;
use App\Models\Meetings;
use App\Policies\JoinPolicy;
use App\Policies\MeetingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
         Meetings::class => MeetingPolicy::class,
         Joins::class => JoinPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserProfileViewService;
use App\Services\HomeService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('UserProfileViewService', UserProfileViewService::class);
        $this->app->bind('HomeService', HomeService::class);
        $this->app->bind(
            \App\Repositories\UserProfile\UserProfileRepositoryInterface::class,
            \App\Repositories\UserProfile\UserProfileRepository::class
        );
        $this->app->bind(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepository::class
        );
        $this->app->bind(
            \App\Repositories\Languages\LanguagesRepositoryInterface::class,
            \App\Repositories\Languages\LanguagesRepository::class
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

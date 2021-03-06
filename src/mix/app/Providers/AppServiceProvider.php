<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserProfileViewService;
use App\Services\HomeService;
use App\Services\MeetingViewService;
use Illuminate\Support\Facades\URL;

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
        $this->app->bind('MeetingViewService', MeetingViewService::class);
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
        $this->app->bind(
            \App\Repositories\Areas\AreasRepositoryInterface::class,
            \App\Repositories\Areas\AreasRepository::class
        );
        $this->app->bind(
            \App\Repositories\Meetings\MeetingsRepositoryInterface::class,
            \App\Repositories\Meetings\MeetingsRepository::class
        );
        $this->app->bind(
            \App\Repositories\Joins\JoinsRepositoryInterface::class,
            \App\Repositories\Joins\JoinsRepository::class
        );
        $this->app->bind(
            \App\Repositories\MeetingComments\MeetingCommentsRepositoryInterface::class,
            \App\Repositories\MeetingComments\MeetingCommentsRepository::class
        );
        $this->app->bind(
            \App\Repositories\MeetingReads\MeetingReadsRepositoryInterface::class,
            \App\Repositories\MeetingReads\MeetingReadsRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');
    }
}

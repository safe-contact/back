<?php

namespace App\Providers;

use App\Repositories\User\UserRepository;
use App\Services\Meet\MeetService;
use App\Services\User\UserService;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //repository
        $this->app->singleton(UserRepository::class, function ($app) {
            return new UserRepository(new User);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('userfacade', UserService::class);
        $this->app->bind('meetfacade', MeetService::class);
    }
}

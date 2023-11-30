<?php

namespace App\Providers;

use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('components.friends-list', function ($view) {
            $uniqueFriendUsers = FriendController::list();
            $view->with('uniqueFriendUsers', $uniqueFriendUsers);
        });
    }
}

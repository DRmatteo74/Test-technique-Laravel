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
            // Appeler la méthode list pour obtenir les valeurs
            $friendListData = FriendController::list();

            // Passer les valeurs à la vue
            $view->with('uniqueFriendUsers', $friendListData['uniqueFriendUsers'])
                ->with('usersWithPendingRequests', $friendListData['usersWithPendingRequests']);
        });
    }
}

<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFive();

        $topUsers = Cache::remember('topUsers1', 60 * 3, function() {
            $topUsers = User::withCount('ideas')->orderBy('created_at', 'desc')->limit(5)->get();
            return $topUsers;
        });

        View::share('topUsers', $topUsers);
    }
}

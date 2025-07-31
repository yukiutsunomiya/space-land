<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Repositories\AdminRepositoryInterface::class,
            \App\Repositories\AdminRepository::class
        );

        $this->app->bind(
            \App\Repositories\MainRepositoryInterface::class,
            \App\Repositories\MainRepository::class
        );
        app()->bind('MainService', 'App\Services\MainService');
        app()->bind('AdminService', 'App\Services\AdminService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // 管理画面用のクッキー
        if (request()->is('admin*')) {
            config(['session.cookie' => config('session.cookie_admin')]);
        }
    
    }
}

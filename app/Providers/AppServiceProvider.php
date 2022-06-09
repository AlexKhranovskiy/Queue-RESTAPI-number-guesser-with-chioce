<?php

namespace App\Providers;

use App\Services\ChainService;
use App\Services\HomeControllerServiceinterface;
use App\Services\SimpleQueueService;
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
        $this->app->bind(HomeControllerServiceinterface::class, SimpleQueueService::class);
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

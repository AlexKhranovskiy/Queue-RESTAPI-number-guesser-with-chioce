<?php

namespace App\Providers;

use App\Http\Controllers\ChainController;
use App\Http\Controllers\SimpleQueueController;
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
        //$this->app->bind(HomeControllerServiceinterface::class, SimpleQueueService::class);

        $this->app->when(ChainController::class)
            ->needs(HomeControllerServiceinterface::class)
            ->give(function () {
                return new ChainService;
            });

        $this->app->when(SimpleQueueController::class)
            ->needs(HomeControllerServiceinterface::class)
            ->give(function () {
                return new SimpleQueueService;
            });
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

<?php

namespace App\Providers;

use App\Http\Controllers\BatchController;
use App\Http\Controllers\ChainController;
use App\Http\Controllers\SimpleQueueController;
use App\Jobs\GuessJobBatch;
use App\Services\BatchService;
use App\Services\ChainService;
use App\Services\HomeControllerService;
use App\Services\HomeControllerServiceInterface;
use App\Services\SimpleQueueService;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $this->app->when(ChainController::class)
            ->needs(HomeControllerServiceInterface::class)
            ->give(function () {
                return new ChainService;
            });

        $this->app->when(SimpleQueueController::class)
            ->needs(HomeControllerServiceInterface::class)
            ->give(function () {
                return new SimpleQueueService;
            });

        $this->app->when(BatchController::class)
            ->needs(HomeControllerServiceInterface::class)
            ->give(function () {
                return new BatchService;
            });

        JsonResource::withoutWrapping();
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

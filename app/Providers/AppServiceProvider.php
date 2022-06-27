<?php

namespace App\Providers;

use App\Http\Controllers\BatchController;
use App\Http\Controllers\ChainController;
use App\Http\Controllers\SimpleQueueController;
use App\Services\BatchService\BatchService;
use App\Services\ChainService\ChainService;
use App\Services\QueueServiceInterface;
use App\Services\SimpleQueueService\SimpleQueueService;
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
            ->needs(QueueServiceInterface::class)
            ->give(function () {
                return new ChainService();
            });

        $this->app->when(SimpleQueueController::class)
            ->needs(QueueServiceInterface::class)
            ->give(function () {
                return new SimpleQueueService();
            });

        $this->app->when(BatchController::class)
            ->needs(QueueServiceInterface::class)
            ->give(function () {
                return new BatchService();
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

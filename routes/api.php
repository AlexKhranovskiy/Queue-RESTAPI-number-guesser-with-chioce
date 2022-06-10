<?php


use App\Http\Controllers\ChainController;
use App\Http\Controllers\SimpleQueueController;
use App\Services\HomeControllerService;
use Illuminate\Support\Facades\Route;

Route::prefix('queue')->group(function () {
    Route::get('/logs', [SimpleQueueController::class, 'show']);
    //Route::get('/logs/clear', [SimpleQueueController::class, 'clear']);
    Route::get('/start', [SimpleQueueController::class, 'start']);
    Route::get('/total', [SimpleQueueController::class, 'total']);
    Route::get('/result', [SimpleQueueController::class, 'result']);
});

Route::prefix('chain')->group(function () {
    Route::get('/start', [ChainController::class, 'start']);
    Route::get('/logs', [ChainController::class, 'show']);
    //Route::get('/logs/clear', [ChainController::class, 'clear']);
    Route::get('/total', [ChainController::class, 'total']);
    Route::get('/result', [ChainController::class, 'result']);
});

Route::get('/logs/clear', function (){
    HomeControllerService::clear();
});

<?php


use App\Http\Controllers\BatchController;
use App\Http\Controllers\ChainController;
use App\Http\Controllers\SimpleQueueController;
use App\Services\HomeControllerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('queue')->group(function () {
    Route::get('/start', [SimpleQueueController::class, 'start']);
});

Route::prefix('chain')->group(function () {
    Route::get('/start', [ChainController::class, 'start']);
    Route::get('/result', [ChainController::class, 'result']);
});

Route::prefix('batch')->group(function () {
    Route::get('/start', [BatchController::class, 'start']);
    Route::get('/result', [BatchController::class, 'result']);
    Route::get('/cancel', [BatchController::class, 'cancel']);
});

Route::get('/logs/clear', function (){
    return HomeControllerService::clear();
});

Route::get('/logs', function(Request $request){
    return HomeControllerService::show($request);
});

Route::get('/total', function(){
   return HomeControllerService::total();
});

<?php


use App\Http\Controllers\ChainController;
use App\Http\Controllers\SimpleQueueController;
use App\Services\HomeControllerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('queue')->group(function () {
    Route::get('/start', [SimpleQueueController::class, 'start']);
    //Route::get('/result', [SimpleQueueController::class, 'result']);
});

Route::prefix('chain')->group(function () {
    Route::get('/start', [ChainController::class, 'start']);
    Route::get('/result', [ChainController::class, 'result']);
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

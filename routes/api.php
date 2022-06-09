<?php


use App\Http\Controllers\ChainController;
use App\Http\Controllers\SimpleQueueController;
use Illuminate\Support\Facades\Route;

Route::get('/queue/logs', [SimpleQueueController::class, 'show']);
Route::get('/queue/logs/clear', [SimpleQueueController::class, 'clear']);
Route::get('/queue/start', [SimpleQueueController::class,'start']);
Route::get('/queue/total', [SimpleQueueController::class,'total']);
Route::get('/queue/result', [SimpleQueueController::class,'result']);

Route::get('/chain/start', [ChainController::class,'start']);
Route::get('/chain/logs', [ChainController::class, 'show']);
Route::get('/chain/logs/clear', [ChainController::class, 'clear']);
Route::get('/chain/total', [ChainController::class,'total']);
Route::get('/chain/result', [ChainController::class,'result']);

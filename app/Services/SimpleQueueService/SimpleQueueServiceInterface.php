<?php


namespace App\Services\SimpleQueueService;


use Illuminate\Http\Request;

interface SimpleQueueServiceInterface
{
    public function show(Request $request);
}

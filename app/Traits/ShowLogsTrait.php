<?php


namespace App\Traits;


use App\Http\Resources\LogsResource;
use App\Models\Log;

trait ShowLogsTrait
{
    public function showLogs($request)
    {
        if ($request->has('transaction')) {
            return LogsResource::collection(Log::where('transaction', '=', $request->get('transaction'))->get());
        }
        return LogsResource::collection(Log::all());
    }
}

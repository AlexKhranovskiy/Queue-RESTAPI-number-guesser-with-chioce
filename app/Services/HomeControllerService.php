<?php


namespace App\Services;

use App\Http\Resources\LogsResource;
use App\Models\Log;
use App\Models\Param;

abstract class HomeControllerService implements HomeControllerServiceInterface
{
    protected array $args;

    public function getConfigParams($request)
    {
        $this->args['tries'] = $request->tries ?? config('guessjob.tries');
        $this->args['guessNumber'] = $request->guess_number ?? config('guessjob.guessNumber');
        $this->args['range'] =
            [
                'start' => $request->range['start'] ?? config('guessjob.rangeStart'),
                'end' => $request->range['end'] ?? config('guessjob.rangeEnd'),
            ];
    }

    public static function show($request)
    {
        if ($request->has('transaction')) {
            return LogsResource::collection(Log::where('transaction', '=', $request->get('transaction'))->get());
        }
        return LogsResource::collection(Log::all());
    }

    public static function total()
    {
        $total = Log::all();
        $transactions = $total->pluck('transaction')->unique();
        $result = [];
        $transactions->each(function ($item, $key) use (&$result, $total) {
            $result[] = [
                'transaction' => $item,
                'guess number' => $total->whereIn('transaction', $item)->pluck('guessNumber')->first(),
                'status' => $total->whereIn('transaction', $item)->pluck('status')->last(),
                'used tries' => $total->whereIn('transaction', $item)->count(),
                'params' => json_decode($total->where('transaction', '=', $item)->first()->param->params),
                'start date' => $total->where('transaction', '=', $item)->first()->param->startDateTime,
                'end date' => $total->where('transaction', '=', $item)->first()->param->endDateTime,
                'completion time' => $total->where('transaction', '=', $item)->first()->param->completionTime,
            ];
        });

        return $result;
    }

    public abstract function clear();

    public abstract function cancel();

    public abstract function result();
}

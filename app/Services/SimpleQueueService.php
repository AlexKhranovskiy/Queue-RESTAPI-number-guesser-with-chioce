<?php

namespace App\Services;

use App\Http\Resources\LogsResource;
use App\Jobs\GuessJob;
use App\Models\Log;
use App\Models\Param;

class SimpleQueueService implements HomeControllerServiceinterface
{
    public function show($request)
    {
        if ($request->has('transaction')) {
            return LogsResource::collection(Log::where('transaction', '=', $request->get('transaction'))->get());
        }
        return LogsResource::collection(Log::all());
    }

    public function start($request)
    {
        $result = '';

        $args['tries'] = $request->tries ?? config('guessjob.tries');
        $args['guessNumber'] = $request->guess_number ?? config('guessjob.guessNumber');
        $args['range'] =
            [
                'start' => $request->range['start'] ?? config('guessjob.rangeStart'),
                'end' => $request->range['end'] ?? config('guessjob.rangeEnd'),
            ];

        //$args['links'] = $request->links ?? config('guessjob.links');

        GuessJob::dispatch($args);
        if (!empty($args)) {
            $result = ' Args:';
            array_walk_recursive($args, function ($item, $key) use (&$result) {
                $result .= ' ' . $key . ' = ' . $item;
            });
        }

        return response('Started, transaction = ' . time() . $result ?? '', 200);
    }

    public function clear()
    {
        Param::where('id', '>', 0)->delete();
        return response('Cleared', 200);
    }

    public function total()
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

    public function result()
    {
       return 'Not supported';
    }
}

<?php

namespace App\Services;

use App\Events\StartBatchEvent;
use App\Http\Resources\BatchLogsResource;
use App\Jobs\GuessJob;
use App\Jobs\GuessJobBatch;
use App\Models\Batch;
use App\Models\Param;
use Illuminate\Support\Facades\Bus;

class BatchService extends QueueService
{
    public function start($request)
    {
        $this->getConfigParams($request);
        $this->args['links'] = $request->links ?? config('guessjob.links');

        for ($i = 1; $i <= $this->args['links']; $i++) {
            $chain[] = new GuessJobBatch($this->args);
        }

        event(new StartBatchEvent($chain));

        \App\Models\Batch::create([
            'id_batch' => session('batchId')
        ]);

        $result = ' Args:';
        array_walk_recursive($this->args, function ($item, $key) use (&$result) {
            $result .= ' ' . $key . ' = ' . $item;
        });

        return response('Started, ' . $result ?? '', 200);
    }

    public static function show($request)
    {
        return 'Not supported';
    }

    public function clear()
    {
        Param::where('id', '>', 0)->delete();
        Batch::where('id', '>', 0)->delete();

        return response('Cleared', 200);
    }

    public function cancel()
    {
        if (!empty(session('batchId'))) {
            $batch = Bus::findBatch(session('batchId'));
            if (!is_null($batch)) {
                $batch->cancel();
                \App\Models\Batch::updateOrCreate([
                    'id_batch' => $batch->id
                ], [
                    'progress' => $batch->progress(),
                    'jobs' => $batch->totalJobs,
                    'successed' => $batch->processedJobs(),
                    'failed' => $batch->failedJobs,
                    'status' => $batch->finished(),
                    'canceled' => true
                ]);
                return BatchLogsResource::collection(\App\Models\Batch::all());
            } else {
                return response('The batch is not started.', 500);
            }
        } else {
            return response('Session is over. Try start.', 500);
        }
    }

    public function result()
    {
        if (!empty(session('batchId'))) {
            $batch = Bus::findBatch(session('batchId'));
            if (!$batch->cancelled()) {
                \App\Models\Batch::updateOrCreate([
                    'id_batch' => $batch->id
                ], [
                    'progress' => $batch->progress(),
                    'jobs' => $batch->totalJobs,
                    'successed' => $batch->processedJobs(),
                    'failed' => $batch->failedJobs,
                    'status' => $batch->finished()
                ]);
            }
            return BatchLogsResource::collection(\App\Models\Batch::all());
        } else {
            return response('Session is over. Try start.', 500);
        }
    }
}

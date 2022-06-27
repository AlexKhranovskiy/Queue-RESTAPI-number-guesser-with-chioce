<?php

namespace App\Services\SimpleQueueService;

use App\Jobs\GuessJob;
use App\Models\Param;
use App\Services\QueueService;
use App\Traits\ShowLogsTrait;

class SimpleQueueService extends QueueService implements SimpleQueueServiceInterface
{
    use ShowLogsTrait;

    public function show($request)
    {
        return $this->showLogs($request);
    }

    public function start($request)
    {
        $result = '';
        $this->getConfigParams($request);
        GuessJob::dispatch($this->args);
        if (!empty($this->args)) {
            $result = ' Args:';
            array_walk_recursive($this->args, function ($item, $key) use (&$result) {
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
}

<?php

namespace App\Services;

use App\Jobs\GuessJob;

class SimpleQueueService extends HomeControllerService
{
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

    public function result()
    {
        return 'Not supported';
    }

    public function cancel()
    {
        return 'Not supported';
    }
}

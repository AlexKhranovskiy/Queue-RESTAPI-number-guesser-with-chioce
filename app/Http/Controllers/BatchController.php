<?php

namespace App\Http\Controllers;

use App\Services\QueueServiceInterface;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    protected $queueControllerService;

    public function __construct(QueueServiceInterface $queueControllerService)
    {
        $this->queueControllerService = $queueControllerService;
    }

    public function show(Request $request)
    {
        return $this->queueControllerService->show($request);
    }

    public function start(Request $request)
    {
        return $this->queueControllerService->start($request);
    }

    public function clear()
    {
        return $this->queueControllerService->clear();
    }

    public function cancel()
    {
        return $this->queueControllerService->cancel();
    }

    public function result()
    {
        return $this->queueControllerService->result();
    }
}

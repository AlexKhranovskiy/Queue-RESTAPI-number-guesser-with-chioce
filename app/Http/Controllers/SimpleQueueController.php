<?php

namespace App\Http\Controllers;

use App\Services\QueueService;
use App\Services\QueueServiceInterface;
use Illuminate\Http\Request;

class SimpleQueueController extends Controller
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

    public function total()
    {
        return $this->queueControllerService->total();
    }

    public function result()
    {
        return $this->queueControllerService->result();
    }
}

<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskSummaryCollection;
use App\Http\Resources\TaskSummaryResource;
use Illuminate\Http\Request;
use Src\TimeTracker\Infrastructure\GetAllTaskController as InfrastructureGetAllTaskController;

class GetAllTaskController extends Controller
{
    /** @var InfrastructureGetAllTaskController */
    private $infrastructureGetAllTaskController;

    public function __construct(InfrastructureGetAllTaskController $infrastructureGetAllTaskController)
    {
        $this->infrastructureGetAllTaskController = $infrastructureGetAllTaskController;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tasksList = (new TaskSummaryCollection($this->infrastructureGetAllTaskController->__invoke()))->resolve();

        return view('tasks-list', compact('tasksList'));
    }
}

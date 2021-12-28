<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskSummaryCollection;
use App\Http\Resources\TaskSummaryResource;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Src\TimeTracker\Infrastructure\GetAllTaskController as InfrastructureGetAllTaskController;
use Src\TimeTracker\Infrastructure\GetTasksTimeByDayController;

class GetAllTaskController extends Controller
{
    /** @var InfrastructureGetAllTaskController */
    private $infrastructureGetAllTaskController;

    /** @var GetTasksTimeByDayController */
    private $getTasksTimeByDayController;

    public function __construct(InfrastructureGetAllTaskController $infrastructureGetAllTaskController,
        GetTasksTimeByDayController $getTasksTimeByDayController
    )
    {
        $this->infrastructureGetAllTaskController   = $infrastructureGetAllTaskController;
        $this->getTasksTimeByDayController          = $getTasksTimeByDayController;
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

        $now = new DateTime();
        $totalTimeToday = $this->getTasksTimeByDayController->__invoke($now);

        return view('tasks-list', compact('tasksList', 'totalTimeToday'));
    }
}

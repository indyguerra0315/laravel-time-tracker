<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Src\TimeTracker\Infrastructure\CreateTaskController as InfrastructureCreateTaskController;

class CreateTaskController extends Controller
{
    /** @var InfrastructureCreateTaskController */
    private $infrastructureCreateTaskController;

    public function __construct(InfrastructureCreateTaskController $infrastructureCreateTaskController)
    {
        $this->infrastructureCreateTaskController = $infrastructureCreateTaskController;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $task = (new TaskResource($this->infrastructureCreateTaskController->__invoke($request)))->resolve();

        return view('task', compact('task'));
    }
}

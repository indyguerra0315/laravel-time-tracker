<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
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
        $tasksList = $this->infrastructureGetAllTaskController->__invoke();

        return view('tasks-list', compact('tasksList'));
    }
}

<?php

namespace App\Http\Controllers\TimeTracker\Task;

use App\Http\Controllers\Controller;
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
        $task = $this->infrastructureCreateTaskController->__invoke($request);

        return view('task', compact('task'));
    }
}
